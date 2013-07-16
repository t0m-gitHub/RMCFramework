<?php


class WindowsValidator extends \RMC\RESTValidator
{
    public function get($params = null, $id = null)
    {
        return $this->_model->get($params, $id);
    }

    public function post($params = null, $id = null)
    {
        return $this->_model->post($params, $id);
    }

    public function put($params = null, $id = null)
    {
        return $this->_model->put($params, $id);
    }

    public function delete($params = null, $id = null)
    {
        return $this->_model->delete($params, $id);
    }
}