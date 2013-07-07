<?php
/**
 * @property mixed id 
 * @property mixed firstName 
 * @property mixed middleName 
 * @property mixed lastName 
 * @property Resume resume
 * @property mixed dayOfBirth
 * @property mixed city
 * @property mixed email
 * @property mixed phone
 * @property Languages[] languages
 * @property Education[] education
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

    /**
     * @return Me
     */
    public function getFullInfo()
    {
        $me = $this->join(array('resume.jobs.tasks','resume.skills', 'resume.technologies', 'resume.experience', 'languages', 'education'))->getByPK(1);
        return $me;
    }

    /**
     * @return Me
     */
    public function getBaseInfo()
    {
        $me = $this->join(array('languages'))->getByPK(1);
        return $me;
    }

    public function getAge()
    {
        if(!isset($this->id)){
            $me = $this->getBaseInfo();
        } else {
            $me = $this;
        }
        $result = DateTime::createFromFormat(DB_DATE_FORMAT, $me->dayOfBirth)->diff(new DateTime())->y;
        return $result;
    }



}