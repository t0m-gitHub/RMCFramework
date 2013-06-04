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
            'serializers',
            'dataContainer',
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
        try
        {
            require_once(\Config::get()->frameworkPath . DIRECTORY_SEPARATOR . 'Constants.php');

            Session::getInstance();

            if (!empty($_REQUEST[HTTP_GET_ACTION_PARAMETER])){

                if ($_REQUEST[HTTP_GET_ACTION_PARAMETER] == REMOTE_MODEL_CALL_ACTION_NAME){
                    static::remoteModelCall();
                    exit;
                }

                if (strpos($_REQUEST[HTTP_GET_ACTION_PARAMETER], '/')){
                    list($controller, $action) = explode('/', $_REQUEST[HTTP_GET_ACTION_PARAMETER]);
                    $action = !empty($action) ? filter_var($action, FILTER_SANITIZE_STRING) . ACTIONS_SUFFIX : DEFAULT_ACTION_NAME;
                    $controller = !empty($controller) ? ucfirst(filter_var($controller, FILTER_SANITIZE_STRING)) . CONTROLLERS_SUFFIX : \Config::get()->defaultController;
                } else {
                    $controller = ucfirst(trim(filter_var($_REQUEST[HTTP_GET_ACTION_PARAMETER], FILTER_SANITIZE_STRING))) . CONTROLLERS_SUFFIX;
                    $action = DEFAULT_ACTION_NAME . ACTIONS_SUFFIX;
                }

            } else {
                $controller = \Config::get()->defaultController . CONTROLLERS_SUFFIX;
                $action = DEFAULT_ACTION_NAME . ACTIONS_SUFFIX;
            }

            $controllerObject = new $controller();
            $controllerObject->$action();

        } catch (\Exception $e) {
            ExceptionHandler::process($e);
            exit;
        }

    }
    
    private function remoteModelCall()
    {
        $dataType = !empty($_REQUEST[HTTP_GET_DATA_TYPE_PARAMETER]) ? filter_var($_REQUEST[HTTP_GET_DATA_TYPE_PARAMETER], FILTER_SANITIZE_STRING) : DEFAULT_DATA_TYPE.'de';
        Session::setDataContainerType($dataType);
        $jsonData = '{
                        "modelName": "TestModel",
                        "calledMethod": "testMethod",
                        "modelProperties":
                            {
                                "testProperty": "Hello World"
                            }

                    }';
        $controller = new RemoteModelCallController();
        $response = $controller->run($dataType,$jsonData);
        echo $response->getSerializedData('JSON');
        exit;
    }
}
