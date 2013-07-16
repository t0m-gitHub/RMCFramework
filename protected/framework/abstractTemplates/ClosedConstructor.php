<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 21:05
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;

/**
 *
*/
abstract class ClosedConstructor
{
    protected function __construct() {}
    private function __sleep() {}
    private function __clone() {}
    private function __wakeup() {}
}