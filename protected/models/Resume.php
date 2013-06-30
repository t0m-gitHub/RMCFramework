<?php
/**
 * @property mixed id 
 * @property mixed isActive 
 * @property mixed title 
 * @property mixed expectations 
 * @property mixed owner 
 * @property Jobs[] jobs
 * @property Skills[] skills
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

    /**
     * @return Resume[]
     */
    public function getMyResume()
    {
        return $this->setMainTableAlias('resume')->join(array( 'jobs', 'me'))->find('me.id = 1');
    }
}