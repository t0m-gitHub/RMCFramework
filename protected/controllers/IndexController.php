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
        $qb = new RMC\QueryBuilder('Me');
        echo $qb
            ->select(array('firstName', 'lastName'))
            ->where('id = :id', array('id' => 1))
            ->groupBy('firstName')
            ->limit('1')
            ->having('1')
            ->orderBy('id')
            ->find();
    }
}
