<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 06.06.13
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class ExceptionHandlerAbstract
{
    abstract public function process( \Exception $e);
}