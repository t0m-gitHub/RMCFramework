<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 15.06.13
 * Time: 20:22
 * To change this template use File | Settings | File Templates.
 */

class MeValidator extends \RMC\DecoratorAbstract
{
    public static function staticFunction()
    {
        echo 'validation';
        $model = self::$_modelStatic->_model;
        $model::staticFunction();
    }
}