<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 06.06.13
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class ExceptionHandlerAbstract extends StaticClass
{
    public static function process( \Exception $e )
    {
        $class = get_class($e);
        if(strpos($class,'\\')){
            list($namespace, $class) = explode('\\', $class);
        }

        $handleMethod = 'handle' . $class;
        if (method_exists(get_called_class(), $handleMethod)){
            static::$handleMethod($e);
        } else {
            throw $e;
        }
    }
    abstract protected function handleUserException( \RMC\UserException $e );
    abstract protected function handleFileNotFoundException( \RMC\FileNotFoundException $e );
    abstract protected function handleRMCException( \RMC\RMCException $e );
    abstract protected function handleException( \Exception $e );
}