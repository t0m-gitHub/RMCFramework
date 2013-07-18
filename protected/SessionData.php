<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 7/18/13
 * Time: 5:44 PM
 * To change this template use File | Settings | File Templates.
 */

class SessionData extends \RMC\ClosedConstructor
{
    private static $_instance;
    private $currentRequestParams;

    public static function getInstance()
    {
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function setCurrentRequestParam($param = array())
    {
        $this->currentRequestParams =is_array($this->currentRequestParams) ? array_merge($param, $this->currentRequestParams) : $param;
    }

    public function getCurrentRequestParam($name)
    {
        return $this->currentRequestParams[$name];
    }

}