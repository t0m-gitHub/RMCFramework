<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 06.06.13
 * Time: 19:46
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class GeneralDecoratorAbstract extends DecoratorAbstract
{
    private $stopMethod;

    function __call($method, $data)
    {
        $returnedData = $this->beforeMethodRun($method, $data);
        if($this->stopMethod){
            return $returnedData;
        }
        $methodOutput = call_user_func_array(array($this->_model, $method), $returnedData ? $returnedData : $data);
        return $this->afterMethodRun($method, $data, $methodOutput);
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