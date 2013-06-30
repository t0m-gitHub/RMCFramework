<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 21:00
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class DecoratorAbstract
{
    protected $_model;
    protected static $_modelStatic;

    public function __construct($model)
    {
        $this->_model = $model;
        static::$_modelStatic = $model;
    }

    public function __call($method, $params)
    {
        $model = $this->getModel();
        if(!method_exists($model, $method)){
            throw new RMCException("Method {$method} not found in model " . get_class($model));
        }
        return call_user_func_array(array($this->_model, $method), $params);
    }

    public function __get($property)
    {
        return $this->_model->$property;
    }

    public static function __callStatic($method, $params)
    {
        return call_user_func_array(array(static::$_modelStatic, $method), $params);
    }

    public function __set($property, $value)
    {
        $model = $this->getModel();
        $model->$property = $value;
    }

    public function getModel()
    {
        $model = isset($this->_model) ? $this->_model : null;
        while(isset($model->_model)){
            $model = isset($model->_model) ? $model->_model : null;
        }
        return $model;
    }
}