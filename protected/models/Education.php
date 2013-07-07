<?php
/**
 * @property mixed id 
 * @property mixed name 
 * @property mixed description 
 * @property mixed enterDate 
 * @property mixed graduateDate 
 * @property mixed owner 
*/

class Education extends \RMC\ORMModelAbstract
{
    /**
     * @return Education
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}