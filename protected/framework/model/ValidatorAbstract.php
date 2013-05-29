<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 21:00
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class ValidatorAbstract
{
    protected $model;

    public function __construct(ModelAbstract $model)
    {
        $this->model = $model;
    }

    public function __call($method, $params){
        if(!method_exists($this->model, $method)){
            throw new RMCException("Method {$method} not found in model " . get_class($this->model));
        }
        return call_user_func_array(array($this->model, $method), $params);
    }
}