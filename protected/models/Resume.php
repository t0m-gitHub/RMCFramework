<?php
/**
 * @property mixed id 
 * @property mixed isActive 
 * @property mixed title 
 * @property mixed expectations 
 * @property mixed owner 
*/

class Resume extends \RMC\ORMModelAbstract
{
    /**
     * @return Resume
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}