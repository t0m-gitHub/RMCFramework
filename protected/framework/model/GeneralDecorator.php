<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 06.06.13
 * Time: 19:46
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class GeneralDecorator extends DecoratorAbstract
{
    private $stopMethod;
    protected static $staticStopMethod;

    public function __call($method, $data)
    {
        $returnedData = $this->beforeMethodRun($method, $data);
        if($this->stopMethod){
            return $returnedData;
        }
        $methodOutput = call_user_func_array(array($this->_model, $method), $returnedData ? $returnedData : $data);
        return $this->afterMethodRun($method, $data, $methodOutput);
    }
    public static function __callStatic($method, $data)
    {
        $returnedData = static::beforeMethodRun($method, $data);
        if(static::$staticStopMethod){
            return $returnedData;
        }
        $methodOutput = call_user_func_array(array(static::$_modelStatic, $method), $returnedData ? $returnedData : $data);
        return static::afterMethodRun($method, $data, $methodOutput);
    }

    public function __isset($prop)
    {
        $model = $this->getModel();
        return isset($model->$prop);
    }

    protected function afterMethodRun($method, $data, $methodOutput){
        return $methodOutput;
    }

    protected function stopMethod()
    {
        $this->stopMethod = true;
    }

    abstract protected function beforeMethodRun($method, $data);
}