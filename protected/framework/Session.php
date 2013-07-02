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

    public static function setDataContainerType($dataContainerType)
    {
        static::$instance->dataContainerType = $dataContainerType;
    }

    public static function getDataContainerType()
    {
        return isset(static::$instance->dataContainerType) ? static::$instance->dataContainerType : false;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)){
            self::$instance = new self();
            session_start();
        }
        self::$instance->params = $_SESSION;
        return self::$instance;
    }

    public static function get($param)
    {
        if (!isset(self::$instance)){
            return false;
        }
        return isset(self::$instance->params[$param]) ? self::$instance->params[$param] : false;;

    }

    public static function set($param, $value)
    {
        if (!isset(self::$instance)){
            return false;
        }
        $_SESSION[$param] = $value;
    }
}