<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 15:26
 */
class IndexController extends \RMC\Controller
{
    public function indexAction()
    {
        $model = TestModel::getInstance();
        $model->testMethod();
        $model = AnotherTestModel::getInstance();
        $model->testMethod();
    }
}
