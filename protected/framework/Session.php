<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 04.06.13
 * Time: 17:39
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class Session extends ClosedConstructor
{
    private static $instance;
    private static $dataContainerType;

    public static function setDataContainerType($dataContainerType)
    {
        static::$dataContainerType = $dataContainerType;
    }

    public static function getDataContainerType()
    {
        return isset(static::$dataContainerType) ? static::$dataContainerType : false;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}