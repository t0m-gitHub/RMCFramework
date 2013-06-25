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
//        $me = Me::getInstance();
//        $me->firstName = 'Alex';
//        $me->lastName = 'Klimenko';
//        $me->dateOfBirth = DateTime::createFromFormat('d.m.Y', '07.12.1990');
        $me = Me::getInstance();
        $me->getByPK(1);
    }
}
