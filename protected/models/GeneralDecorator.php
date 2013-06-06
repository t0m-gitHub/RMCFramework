<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 06.06.13
 * Time: 9:19
 * To change this template use File | Settings | File Templates.
 */

class GeneralDecorator extends \RMC\DecoratorAbstract
{
    function __call($method, $data)
    {
        echo 'some general action <br/>';
        return call_user_func_array(array($this->model, $method), $data);
    }
}