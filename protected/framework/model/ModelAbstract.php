<?php
/**
 * User: t0m
 * Date: 17.05.13
 * Time: 10:55
 */
namespace RMC;

abstract class ModelAbstract extends ClosedConstructor
{
    public static function getInstance()
    {
        $className = get_called_class();
        $validatorName = $className . VALIDATORS_SUFFIX;
        $generalDecorator = !empty(\Config::get()->generalDecorator) ? \Config::get()->generalDecorator : false;
        if(class_exists($validatorName)){
            if($generalDecorator && class_exists($validatorName)){
                return new $generalDecorator( new $validatorName( new $className ) );
            }
            return new $validatorName( new $className );
        }
        return new $className;
    }
}
