<?php
/**
 * @property mixed id 
 * @property mixed taskName 
 * @property mixed chalanges 
 * @property mixed solutions 
 * @property mixed owner 
*/

class Experience extends \RMC\ORMModelAbstract
{
    /**
     * @return Experience
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}