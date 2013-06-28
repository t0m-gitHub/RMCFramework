<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 22:19
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


interface SerializerInterface
{
    public function serialize(DataContainerResponse $data);
    public function unserialize($data);
}