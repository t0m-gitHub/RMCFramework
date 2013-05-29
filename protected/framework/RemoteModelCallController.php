<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 23:10
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class RemoteModelCallController
{
    public function run($format, $rawData)
    {
        $modelData = new ModelData($format, $rawData);
        $modelName = $modelData->modelName;
        $methodName = $modelData->calledMethod;
        if(!isset($modelData)
            || !isset($modelName)
            || !class_exists($modelName)
            || !method_exists($modelName, $methodName)
        ){
            throw  new UserException('Model or method is invalid');
        }
        if (!is_array($modelData->modelProperties)){
            throw new UserException('invalid model properties');
        }
        $model = $modelName::getInstance();
        if ($modelData->modelProperties){
            foreach ($modelData->modelProperties as $property => $value) {
                $model->$property = $value;
            }
        }
        $methodResponse = $model->$methodName(isset($modelData->methodProperties) ? $modelData->methodProperties : null);
        if(!($methodResponse instanceof DataContainerResponse)){
            throw new RMCException("Model {$modelName} called from remote but response is not instance of RMC\\DataContainerResponse");
        }
        return $methodResponse;
    }
}