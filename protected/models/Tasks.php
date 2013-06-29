<?php
/**
 * @property mixed id 
 * @property mixed job 
 * @property mixed taskDescription 
 * @property mixed taskName 
*/

class Tasks extends \RMC\ORMModelAbstract
{
    /**
     * @return Tasks
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}