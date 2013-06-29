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
        $me = Me::getInstance();
        var_export($me->join(array('resume.jobs.tasks','resume.skills', 'languages'))->getByPK(1));
        //echo $this->render('index');
    }

    public function createModelAction()
    {

        $tableName = $_POST['tableName'];
        RMC\ModelGenerator::generate($tableName);
    }
}
