<?php
/**
 * @property mixed id 
 * @property mixed name 
 * @property mixed description 
 * @property mixed owner 
 * @property mixed level 
*/

class Skills extends \RMC\ORMModelAbstract
{
    /**
     * @return Skills
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    public function getMySkills()
    {
        //$this->setMainTableAlias('skills')->join(array(''))
    }
}