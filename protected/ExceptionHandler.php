<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 06.06.13
 * Time: 19:10
 * To change this template use File | Settings | File Templates.
 */

class ExceptionHandler extends RMC\DefaultExceptionHandler
{
    protected function handleUserException( \RMC\UserException $e )
    {
       parent::handleUserException($e);
    }

    protected function handleRMCException( \RMC\RMCException $e )
    {
        echo  $e->getMessage();
        parent::handleRMCException($e);
    }

    protected function handleException( \Exception $e )
    {
        parent::handleException($e);
    }

    protected function handleFileNotFoundException( \RMC\FileNotFoundException $e )
    {
        parent::handleFileNotFoundException($e);
    }
}