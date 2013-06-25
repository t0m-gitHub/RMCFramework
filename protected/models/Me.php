<?php
/**
* @property string firstName
* @property string secondName
* @property string lastName
* @property DateTime dateOfBirth
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