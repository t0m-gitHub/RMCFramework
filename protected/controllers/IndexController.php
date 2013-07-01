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
        $this->view->setPageTitle('PHP Developer. Klimenko Alex.');
        $resume = Resume::getInstance();
        $skills = $resume->getMySkills();
        $skillsString = '';
        foreach($skills as $skill){
            $skillsString .= ", {$skill->name}";
        }
        echo $this->render('index' ,array('skills' => $skillsString));
    }
}
