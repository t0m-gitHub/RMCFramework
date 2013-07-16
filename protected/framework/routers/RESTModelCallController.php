<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 16.07.13
 * Time: 23:24
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class RESTModelCallController extends ClosedConstructor
{
    public static function run($modelClassName, $restId = null)
    {
        if(!class_exists($modelClassName) || !(is_subclass_of($modelClassName, '\RMC\RESTModel'))){
            throw new UserException("Model {$modelClassName} not found");
        }

        $action = strtolower($_SERVER['REQUEST_METHOD']);

        $params = array();
        switch($action){
            case 'get':
                $params = $_GET;
                break;
            case 'post':
                $params = $_POST;
                break;
            case 'delete':
                parse_str(file_get_contents('php://input'), $params);
                break;
            case 'put':
                parse_str(file_get_contents('php://input'), $params);
                break;
            default:
                throw new UserException("Action {$action} not allowed");
                break;
        }

        $model = $modelClassName::getInstance();
        $result = $model->$action($params, $restId);
        $response = new DataContainerResponse();
        $response->success = true;
        $response->data = $result;
        echo $response->getSerializedData('rest');
    }
}