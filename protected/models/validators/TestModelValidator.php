<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 21:26
 * To change this template use File | Settings | File Templates.
 */

class TestModelValidator extends RMC\DecoratorAbstract
{
    public function testMethod()
    {
        echo 'Test Method 1 Validator';
        return $this->_model->testMethod();
    }
}