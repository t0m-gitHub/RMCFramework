<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 10:42
 */
namespace RMC;

class Bootstrap
{
    private static $externalAutoLoaders;

    static function registerExternalAutoLoader($autoLoader)
    {
        self::$externalAutoLoaders[] = $autoLoader;
    }

    static function registerAutoLoad()
    {
        spl_autoload_register('self::autoLoad');
    }

    static function autoLoad($class)
    {
        $class = explode('\\', $class);
        $class = end($class);
        $frameworkFolders = array(
            'exceptions',
            'controller',
            'model',
            'codeGenerator',
            'serializers',
            'dataContainer',
            'abstractTemplates',
            'routers',
            'view',
            'buildinViews',
            'buildinControllers',
            '',
        );
        $frameworkPath = \Config::get()->frameworkPath;

        $basePath = \Config::get()->basePath;
        $includePaths = \Config::get()->includePaths;
        $controllersPaths = \Config::get()->controllersPaths;
        $modelsPaths = \Config::get()->modelsPaths;
        $modelsSettingsPaths = \Config::get()->modelSettingsPaths;
        $modelsValidatorsPaths = \Config::get()->modelValidatorsPaths;

        $paths = array_merge($includePaths, $controllersPaths, $modelsPaths, $frameworkFolders, $modelsSettingsPaths, $modelsValidatorsPaths);
        foreach($paths as $key => $path){
            $file =  $path . DIRECTORY_SEPARATOR . $class . '.php';
            if (file_exists($basePath . DIRECTORY_SEPARATOR  .$file)){

                require_once($basePath . DIRECTORY_SEPARATOR  .$file);
                break;

            } elseif (file_exists($frameworkPath . DIRECTORY_SEPARATOR  .$file)){

                require_once($frameworkPath . DIRECTORY_SEPARATOR  .$file);
                break;

            } elseif(count($paths) + 1 == $key) {
                foreach(static::$externalAutoLoaders as $autoLoader){
                    call_user_func($autoLoader, $class);
                }
            }
        }
    }

    static function init()
    {
        try
        {
            require_once(\Config::get()->frameworkPath . DIRECTORY_SEPARATOR . 'Constants.php');
            Session::getInstance();
            if (isset(\Config::get()->database)){
                DatabaseInterface::getInstance();
            }
            RequestRouter::run(!empty($_REQUEST[HTTP_GET_ACTION_PARAMETER]) ? $_REQUEST[HTTP_GET_ACTION_PARAMETER] : null);

        } catch (\Exception $e) {
            ExceptionRouter::process($e);
            exit;
        }

    }
    

}
