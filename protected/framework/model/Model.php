<?php
/**
 * User: t0m
 * Date: 17.05.13
 * Time: 10:55
 */
namespace RMC;

abstract class Model extends ClosedConstructor
{
    public static function getInstance()
    {
        $className = get_called_class();
        $validatorName = $className . VALIDATORS_SUFFIX;
        $generalDecorator = !empty(\Config::get()->generalModelDecorator) ? \Config::get()->generalModelDecorator : false;
        if(class_exists($validatorName)){
            if(class_exists($generalDecorator) && class_exists($validatorName)){
                return new $generalDecorator( new $validatorName( new $className ) );
            }
            return new $validatorName( new $className );
        }
        if(class_exists($generalDecorator)){
            return new $generalDecorator(  new $className  );
        }
        return new $className;
    }

}
