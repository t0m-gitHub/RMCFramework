<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 22:40
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class DataContainerAbstract
{
    protected $serializer;

    public function __construct($format = null)
    {
        if(isset($format)){
            $serializerName = 'RMC\\'.$format . SERIALIZERS_SUFFIX;
            if(!class_exists($serializerName)){
                throw new RMCException("Unsupported format {$format}");
            }
            $this->serializer = new $serializerName();
        }
    }

    public function getSerializedData($format = null)
    {
        if(isset($format)){
            $serializerName =  'RMC\\'.$format . SERIALIZERS_SUFFIX;
            if(!class_exists($serializerName)){
                throw new RMCException("Unsupported format {$format}");
            }
            $serializer = new $serializerName();
        } else {
            if(!isset($this->serializer)){
                throw new RMCException("Unsupported format {$format}");
            }
            $serializer = $this->serializer;
        }
        return $serializer->serialize($this);
    }
}