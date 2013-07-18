<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 22:28
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class ModelData extends DataContainerAbstract
{
    public $modelName;
    public $modelProperties;
    public $calledMethod;
    public $methodProperties;

    public function __construct($format, $rawData)
    {
        parent::__construct($format);
        $unserializedData = $this->serializer->unserialize($rawData);
        if(!$unserializedData || !isset($unserializedData['method']) || (strpos($unserializedData['method'], '_') === false)){
            throw new UserException('invalid data format');
        }
        list($modelName, $methodName) = explode('_', $unserializedData['method']);
        $this->modelName = $modelName;
        $this->modelProperties = isset($unserializedData['modelProperties']) ? $unserializedData['modelProperties'] : null;
        $this->calledMethod = $methodName;
        $this->methodProperties = isset($unserializedData['params']) ? $unserializedData['params'] : null;
    }

}