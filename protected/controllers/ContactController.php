<?php


class ContactController extends \RMC\Controller
{
    public function indexAction()
    {
        $me = Me::getInstance()->getBaseInfo();

    }
}