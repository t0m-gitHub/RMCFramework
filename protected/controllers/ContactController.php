<?php


class ContactController extends \RMC\Controller
{
    public function indexAction()
    {
        $this->view->setPageTitle('Contact information');
        echo $this->view->render('index');
    }
}