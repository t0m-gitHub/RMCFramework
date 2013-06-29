<?php


class JobsSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Jobs';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function tableFields()
    {
        return array(
            'id' => array('maxLength' => 3), 
            'name' => array('maxLength' => 100), 
            'description' => array('maxLength' => 0), 
            'startDate' => array('maxLength' => 0), 
            'quitDate' => array('maxLength' => 0), 
            'owner' => array('maxLength' => 1), 
        );
    }

    public static function relations()
    {
        return array(
            'tasks' => array(
                'model' => 'Tasks',
                'type'  => 'Many',
                'condition' => 'tasks.owner = jobs.id',
                'joinType' => 'LEFT'
            ),
        );
    }
}