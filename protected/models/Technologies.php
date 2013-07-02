<?php
/**
 * @property mixed id 
 * @property mixed name 
 * @property mixed description
 * @property mixed owner 
*/

class Technologies extends \RMC\ORMModelAbstract
{
    /**
     * @return Technologies
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}