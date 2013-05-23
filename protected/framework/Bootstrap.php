<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 10:42
 */
namespace RMC;

class Bootstrap
{
    static function setAutoLoad()
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
            '',
        );
        $frameworkPath = \Config::get()->frameworkPath;

        $basePath = \Config::get()->basePath;
        $includePaths = \Config::get()->includePaths;
        $controllersPaths = \Config::get()->controllersPaths;
        $modelsPaths = \Config::get()->modelsPaths;
        $modelValidatorsPaths = \Config::get()->modelValidatorsPaths;

        $paths = array_merge($includePaths, $controllersPaths, $modelsPaths, $frameworkFolders, $modelValidatorsPaths);
        foreach($paths as $key => $path){
            $file =  $path . DIRECTORY_SEPARATOR . $class . '.php';
            if (file_exists($basePath . DIRECTORY_SEPARATOR  .$file)){

                require_once($basePath . DIRECTORY_SEPARATOR  .$file);
                break;

            } elseif (file_exists($frameworkPath . DIRECTORY_SEPARATOR  .$file)){

                require_once($frameworkPath . DIRECTORY_SEPARATOR  .$file);
                break;

            } elseif(count($paths) + 1 == $key) {
                throw new \RMC\FileNotFoundException("Class {$class} not found");
            }
        }
    }

    static function init()
    {
        require_once(\Config::get()->frameworkPath . DIRECTORY_SEPARATOR . 'Constants.php');
        if (!empty($_REQUEST['action'])){
            if (strpos($_REQUEST['action'], '/')){
                list($controller, $action) = explode('/', $_REQUEST['action']);
                $action = !empty($action) ? filter_var($action, FILTER_SANITIZE_STRING) . ACTIONS_SUFFIX : DEFAULT_ACTION_NAME;
                $controller = !empty($controller) ? ucfirst(filter_var($controller, FILTER_SANITIZE_STRING)) . CONTROLLERS_SUFFIX : \Config::get()->defaultController;
            } else {
                $controller = ucfirst(trim(filter_var($_REQUEST['action'], FILTER_SANITIZE_STRING))) . CONTROLLERS_SUFFIX;
                $action = DEFAULT_ACTION_NAME . ACTIONS_SUFFIX;
            }
        } else {
            $controller = \Config::get()->defaultController . CONTROLLERS_SUFFIX;
            $action = DEFAULT_ACTION_NAME . ACTIONS_SUFFIX;
        }
        $controllerObject = new $controller();
        $controllerObject->$action();
    }
}
