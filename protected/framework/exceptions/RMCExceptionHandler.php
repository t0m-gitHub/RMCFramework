<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 04.06.13
 * Time: 17:30
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class RMCExceptionHandler extends StaticClass
{

    private function handleUserException(UserException $e)
    {
        $currentDataContainer = Session::getDataContainerType();
        if ($currentDataContainer){
            $response = new DataContainerResponse($currentDataContainer);
            $response->success = false;
            $response->errors = $e->getMessage();
            echo $response->getSerializedData();
            exit;
        }
        echo $e->getMessage();

    }

    private function handleRMCException(RMCException $e)
    {
        echo $e->getMessage();
    }


    private function handleException(\Exception $e)
    {
        echo $e->getMessage();
    }

    private function handleFileNotFoundException(FileNotFoundException $e)
    {
        echo $e->getMessage();
    }
}