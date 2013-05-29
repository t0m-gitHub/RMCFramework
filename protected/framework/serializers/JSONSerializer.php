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
        $return  = json_encode((array) $data);
        return $return;
    }

    public function unserialize($data)
    {
        $array = json_decode($data, true);
        return (array)$array;
    }
}