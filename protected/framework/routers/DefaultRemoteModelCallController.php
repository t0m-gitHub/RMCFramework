<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 23:10
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class DefaultRemoteModelCallController extends RemoteModelCallControllerAbstract
{
    protected function convertRawData($format, $rawData)
    {
        return $modelData = new ModelData($format, $rawData);
    }

    protected function getModel($modelName)
    {
        if (!class_exists($modelName)){
            throw new UserException('Model doesn\'t exist');
        }
        return $modelName::getInstance();
    }
}