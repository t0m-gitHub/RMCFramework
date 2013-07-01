<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 22:24
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class JSONSerializer implements SerializerInterface
{
    public function serialize(DataContainerResponse $data)
    {
        $responseArray = $this->serializeObjectRecursive($data);
        var_export($responseArray);die;
        $return  = json_encode($responseArray);
        return $return;
    }

    public function unserialize($data)
    {
        $array = json_decode($data, true);
        return (array)$array;
    }

    private function serializeObjectRecursive($object)
    {
        $result = array();
        if($object instanceof DecoratorAbstract){
            $object = $object->getModel();
        }
        foreach($object as $key => $objectProperty){
            if(is_object($objectProperty) || is_array($objectProperty)){
                $objectProperty = $this->serializeObjectRecursive($objectProperty);
            }
            $result[$key] = $objectProperty;
        }
        return $result;
    }
}