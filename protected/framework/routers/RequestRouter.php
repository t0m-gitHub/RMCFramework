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

        if ($actionPath == REMOTE_MODEL_CALL_ACTION_NAME){
            $dataType = !empty($_REQUEST[HTTP_GET_DATA_TYPE_PARAMETER]) ? filter_var($_REQUEST[HTTP_GET_DATA_TYPE_PARAMETER], FILTER_SANITIZE_STRING) : DEFAULT_DATA_TYPE;
            static::remoteModelCall($dataType);
        }
        if( strpos($actionPath, ROTE_SEPARATOR_CHAR) ){
            list($controller, $action) = explode(ROTE_SEPARATOR_CHAR, $actionPath);
        } else {
            $controller = $actionPath;
        }


        if(!empty($controller) && empty($action)){
            static::runDefaultAction($controller . CONTROLLERS_SUFFIX);
        } elseif (!empty($controller) && !empty($action)){
            static::createControllerAndRunAction($controller . CONTROLLERS_SUFFIX, $action . ACTIONS_SUFFIX);
        }

    }

    private function createControllerAndRunAction( $controller, $action )
    {
        if (!class_exists($controller) || !method_exists($controller, $action)){
            throw new FileNotFoundException("Page {$controller}/{$action} not found");
        }
        $controllerObject = new $controller();
        $controllerObject->$action();
        exit;
    }

    private function createDefaultModelAndRunDefaultAction()
    {
        static::createControllerAndRunAction(\Config::get()->defaultController . CONTROLLERS_SUFFIX, DEFAULT_ACTION_NAME . ACTIONS_SUFFIX);
    }

    private function runDefaultAction( $controller )
    {
        static::createControllerAndRunAction($controller, DEFAULT_ACTION_NAME . ACTIONS_SUFFIX);
    }

    private function remoteModelCall($dataType)
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