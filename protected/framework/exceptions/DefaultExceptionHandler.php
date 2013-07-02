<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 06.06.13
 * Time: 18:59
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class DefaultExceptionHandler extends ExceptionHandlerAbstract
{
    protected function handleUserException(UserException $e)
    {
        if(!static::handlerExceptionIfModelCalledFromRemote($e)){
            static::generalAction($e);
        }
    }

    protected function handleRMCException(RMCException $e)
    {
        if(!static::handlerExceptionIfModelCalledFromRemote(new \Exception('Internal Error'))){
            static::generalAction($e);
        }
    }


    protected function handleException(\Exception $e)
    {
        if(!static::handlerExceptionIfModelCalledFromRemote(new \Exception('Internal Error'))){
            static::generalAction($e);
        }
    }

    protected function handleFileNotFoundException(FileNotFoundException $e)
    {
        if(!static::handlerExceptionIfModelCalledFromRemote($e)){
            static::generalAction($e);
        }
    }

    protected function handlerExceptionIfModelCalledFromRemote(\Exception $e)
    {
        $currentDataContainer = Session::getDataContainerType();
        if(!$currentDataContainer){
            return false;
        }
        $response = new DataContainerResponse($currentDataContainer);
        $response->success = false;
        $response->errors = $e->getMessage();
        echo $response->getSerializedData();
        return true;
    }

    protected function generalAction(\Exception $e)
    {
        echo '<b>'.$e->getMessage().'</b> <br />';
        //echo ((print_r(\debug_backtrace(), 1))) ;
    }
}