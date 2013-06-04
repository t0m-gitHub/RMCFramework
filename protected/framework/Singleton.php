<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 04.06.13
 * Time: 17:43
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class Singleton extends ClosedConstructor
{
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}