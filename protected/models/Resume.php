<?php
/**
 * @property mixed id 
 * @property mixed isActive 
 * @property mixed title 
 * @property mixed expectations 
 * @property mixed owner 
 * @property Jobs[] jobs
 * @property Skills[] skills
 * @property Technologies[] technologies
 * @property Experience[] experience
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
     * @return Resume
     */
    public function getBaseResumeInfo()
    {
        $resume = $this->setMainTableAlias('resume')
            ->join(array('me'))
            ->find('me.id = 1 and resume.id = 1');
        return $resume[0];
    }

    /**
     * @return Skills[]
     */
    public function getMySkills()
    {
        $skills = $this->setMainTableAlias('resume')
            ->join(array('me', 'skills'))
            ->find('me.id = 1 and resume.id = 1');
        $skills = $skills[0];
        return $skills->skills;
    }

    /**
     * @return Jobs[]
     */
    public function getMyJobPlaces()
    {
        $jobs = $this->setMainTableAlias('resume')
            ->join(array('me', 'jobs'))
            ->find('me.id = 1 and resume.id = 1');
        $jobs = $jobs[0];
        return $jobs->jobs;
    }

    /**
     * @return Jobs[]
     */
    public function getMyJobsFullInfo()
    {
        $jobs = $this->setMainTableAlias('resume')
            ->join(array('me', 'jobs.tasks'))
            ->find('me.id = 1 and resume.id = 1');
        $jobs = $jobs[0];
        return $jobs->jobs;
    }
}