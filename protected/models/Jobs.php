<?php
/**
 * @property mixed id 
 * @property mixed name 
 * @property mixed description 
 * @property mixed startDate 
 * @property mixed quitDate 
 * @property mixed owner 
 * @property Tasks[] tasks
*/

class Jobs extends \RMC\ORMModelAbstract
{
    /**
     * @return Jobs
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}