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
        $model->testMethod(1,2);
        $this->render('index', array('string' => 'hi'));
    }
}
