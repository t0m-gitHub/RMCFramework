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
        //\RMC\ModelGenerator::generate('Education');die;
        $me = Me::getInstance()->getFullInfo();
        $skillsString = '';
        $skillsArray = array();
        foreach($me->resume->skills as $skill){
            $skillsString .= ", {$skill->name}";
            $skillsArray[$skill->level][] = array(
                'name' => $skill->name,
                'description' => $skill->description,
            );
        }

        $this->view->setPageTitle('PHP Developer. Klimenko Alex.');
        echo $this->view->render('index' ,array(
            'skills' => $skillsString,
            'skillsArray' => $skillsArray,
            'age' => $me->getAge(),
            'name' => $me->firstName . ' ' . $me->lastName,
            'city' => $me->city,
            'technologies' => $me->resume->technologies,
            'experience' => $me->resume->experience,
            'jobs' => $me->resume->jobs,
            'education' => $me->education,
            'expectations' => $me->resume->expectations
        ));
    }
}
