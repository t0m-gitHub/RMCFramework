<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 06.06.13
 * Time: 17:28
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class RequestRouter extends StaticClass
{
    public static function run( $actionPath = '' )
    {
        if (empty($actionPath)){
            static::createDefaultModelAndRunDefaultAction();
        }

        if( strpos($actionPath, ROUTE_SEPARATOR_CHAR) ){
            $actionArray = explode(ROUTE_SEPARATOR_CHAR, $actionPath);
            $controller = isset($actionArray[0]) ? $actionArray[0] : null;
            $action = isset($actionArray[1]) ? $actionArray[1] : null;
            $restId = isset($actionArray[2]) ? $actionArray[2] : null;
        } else {
            $controller = $actionPath;
        }

        switch($controller){
            case REMOTE_MODEL_CALL_ACTION_NAME:
                $dataType = !empty($_REQUEST[HTTP_GET_DATA_TYPE_PARAMETER]) ? filter_var($_REQUEST[HTTP_GET_DATA_TYPE_PARAMETER], FILTER_SANITIZE_STRING) : DEFAULT_DATA_TYPE;
                static::remoteModelCall($dataType);
                break;
            case LANGUAGE_CHANGE_ACTION_NAME:
                static::languageChange();
                break;
            case REST_MODEL_CALL_ACTION_NAME:
                Session::setDataContainerType('rest');
                RESTModelCallController::run(isset($action) ? $action : '', isset($restId) ? $restId : null);
                break;
        }

        if(!empty($controller) && empty($action)){
            static::runDefaultAction($controller . CONTROLLERS_SUFFIX);
        } elseif (!empty($controller) && !empty($action)){
            static::createControllerAndRunAction($controller . CONTROLLERS_SUFFIX, $action . ACTIONS_SUFFIX);
        }

    }

    private static function createControllerAndRunAction( $controller, $action )
    {
        $controller = ucfirst($controller);
        if (!class_exists($controller) || !method_exists($controller, $action)){
            throw new FileNotFoundException("Page {$controller}/{$action} not found");
        }
        $controllerObject = new $controller();
        $controllerObject->$action();
        exit;
    }

    private static function createDefaultModelAndRunDefaultAction()
    {
        static::createControllerAndRunAction(\Config::get()->defaultController . CONTROLLERS_SUFFIX, DEFAULT_ACTION_NAME . ACTIONS_SUFFIX);
    }

    private static function runDefaultAction( $controller )
    {
        static::createControllerAndRunAction($controller, DEFAULT_ACTION_NAME . ACTIONS_SUFFIX);
    }

    private static function languageChange()
    {
        $lang = $_REQUEST['lang'];
        Session::set('lang', $lang);
        $location = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        header("location: {$location} ");
        exit;
    }

    private static function remoteModelCall($dataType)
    {
        Session::setDataContainerType($dataType);
        $data = file_get_contents('php://input');
        $remoteModelCallController = isset(\Config::get()->remoteModelCallController) ? \Config::get()->remoteModelCallController : 'RMC\\DefaultRemoteModelCallController';
        if(!class_exists($remoteModelCallController)){
            throw new RMCException("Class {$remoteModelCallController} not found");
        }
        $controller = new $remoteModelCallController();
        $response = $controller->run($dataType,$data);
        echo $response->getSerializedData(Session::getDataContainerType());
        exit;
    }
}