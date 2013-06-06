<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 16:10
 */
namespace RMC;
class Tools extends StaticClass
{
    static function getClassName(Controller $class)
    {
        return str_replace(CONTROLLERS_SUFFIX, '', get_class($class));
    }
}
