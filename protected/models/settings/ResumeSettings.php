<?php


class ResumeSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Resume';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function tableFields()
    {
        return array(
            'id' => array('maxLength' => 3), 
            'isActive' => array('maxLength' => 1), 
            'title' => array('maxLength' => 500), 
            'expectations' => array('maxLength' => 0), 
            'owner' => array('maxLength' => 1), 
        );
    }

    public static function relations()
    {
        return array(
            'jobs' => array(
                'model' => 'Jobs',
                'type'  => 'Many',
                'condition' => 'jobs.owner = resume.id',
                'joinType' => 'LEFT'
            ),
            'me' => array(
                'model' => 'Me',
                'type'  => 'One',
                'condition' => 'me.id = resume.owner',
                'joinType' => 'LEFT'
            ),
            'skills' => array(
                'model' => 'Skills',
                'type'  => 'Many',
                'condition' => 'skills.owner = resume.id',
                'joinType' => 'LEFT'
            )
        );
    }
}