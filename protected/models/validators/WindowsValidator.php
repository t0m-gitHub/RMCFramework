<?php


class WindowsValidator extends \RMC\RESTValidator
{
    public function get()
    {
        return $this->_model->get();
    }

    public function post()
    {
        return $this->_model->post();
    }

    public function put()
    {
        return $this->_model->put();
    }

    public function delete()
    {
        return $this->_model->delete();
    }
}