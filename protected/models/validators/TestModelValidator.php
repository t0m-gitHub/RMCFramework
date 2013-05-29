<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 21:26
 * To change this template use File | Settings | File Templates.
 */

class TestModelValidator extends RMC\ValidatorAbstract
{
    public function testMethod()
    {
        echo 'TestMethodValidator'."\n";
        return $this->model->testMethod();
    }
}