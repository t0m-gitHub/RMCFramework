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
        $response = new \RMC\DataContainerResponse();
        $response->success = true;
        $response->data = 'hello world';
        return $response;
    }

    /**
     * @return TestModel
     */
    public static function getInstance()
    {
       return parent::getInstance();
    }
}