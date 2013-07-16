<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 08.06.13
 * Time: 15:52
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class RemoteModelCallControllerAbstract
{
    public function run($format, $rawData)
    {
        $modelData = $this->convertRawData($format, $rawData);
        if(!($modelData instanceof ModelData)){
            throw new RMCException(get_class($this) . "::convertRawData should return object instance of ModelData or its child");
        }

        $modelName = $modelData->modelName;
        $methodName = $modelData->calledMethod;

        $model = $this->getModel($modelName);
        if(!($model instanceof DecoratorAbstract) && !($model instanceof Model)){
            throw new RMCException(get_class($this) . "::getModel should return a model");
        }

        if(!method_exists($modelName, $methodName)){
            throw  new UserException('Model method is invalid');
        }

        if ($modelData->modelProperties){
            foreach ($modelData->modelProperties as $property => $value) {
                $model->$property = $value;
            }
        }
        if(!empty($modelData->methodProperties)){
            $methodResponse = call_user_func_array(array($model, $methodName), $modelData->methodProperties);
        } else {
            $methodResponse = call_user_func(array($model, $methodName));
        }

        if(!($methodResponse instanceof DataContainerResponse)){
            $dataContainer = new DataContainerResponse();
            $dataContainer->success = true;
            $dataContainer->data = $methodResponse;
            $methodResponse = $dataContainer;
        }
        return $methodResponse;
    }

    abstract protected function convertRawData($format, $rawData);

    abstract protected function getModel($modelName);
}