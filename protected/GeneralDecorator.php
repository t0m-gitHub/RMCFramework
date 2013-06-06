<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 06.06.13
 * Time: 9:19
 * To change this template use File | Settings | File Templates.
 */

class GeneralDecorator extends \RMC\GeneralDecoratorAbstract
{
    protected function beforeMethodRun($method, $data)
    {
        ob_start();
    }

    protected function afterMethodRun($method, $data, \RMC\DataContainerResponse $result)
    {
        $modelTextOutput = ob_get_clean();
        $result->warnings .= $modelTextOutput . '; ';
        return $result;
    }
}