<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 04.06.13
 * Time: 17:30
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class ExceptionRouter extends StaticClass
{
    public static function process( \Exception $e )
    {
        $exceptionHandler = !empty(\Config::get()->exceptionHandler) ? \Config::get()->exceptionHandler : false;

        if (!$exceptionHandler){
            DefaultExceptionHandler::process($e);
        } elseif (class_exists($exceptionHandler)){
            $exceptionHandler::process($e);
        } else {
            throw $e;
        }
    }
}