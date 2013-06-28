<?php
/**
 * @property mixed id 
 * @property mixed firstName 
 * @property mixed middleName 
 * @property mixed lastName 
 * @property mixed dayOfBirth 
*/

class Me extends \RMC\ORMModelAbstract
{
    /**
     * @return Me
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}