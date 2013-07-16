<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 16.07.13
 * Time: 23:10
 * To change this template use File | Settings | File Templates.
 */

class Windows extends \RMC\RESTModel
{
    public function get($params = null, $id = null)
    {
        if (!empty($id)){
            return $this->getWindowById($params, $id);
        }
        return $this->getWindowsList($params);
    }

    public function post($params = null, $id = null)
    {

    }

    public function put($params = null, $id = null)
    {

    }

    public function delete($params = null, $id = null)
    {

    }

    private function getWindowsList($params)
    {
        return array(
            0 => array('closed' => true, 'name' => 'kitchen'),
            1 => array('closed' => false, 'name' => 'bedroom')
        );
    }

    private function getWindowById($params, $id)
    {
        return array('closed' => true, 'name' => 'kitchen');
    }

    /**
     * @return Windows
     */
    public static function getInstance()
    {
        parent::getInstance();
    }


}