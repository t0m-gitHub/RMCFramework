<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 21:23
 * To change this template use File | Settings | File Templates.
 */

class TestModel extends RMC\ModelAbstract
{
    public function testMethod()
    {
        echo 'model 1 test method<br /><br />';
    }

    /**
     * @return TestModel
     */
    public static function getInstance()
    {
       return parent::getInstance();
    }
}