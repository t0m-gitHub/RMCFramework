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
        $resume = Resume::getInstance();

        print_r($resume->getMyResume()[0]->jobs[1]->name);
        //echo $this->render('index');
    }

    public function createModelAction()
    {

        $tableName = $_POST['tableName'];
        RMC\ModelGenerator::generate($tableName);
    }
}
