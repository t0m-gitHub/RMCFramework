<?php


class TasksSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Tasks';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function tableFields()
    {
        return array(
            'id' => array('maxLength' => 11), 
            'owner' => array('maxLength' => 3),
            'taskDescription' => array('maxLength' => 0), 
            'taskName' => array('maxLength' => 255), 
        );
    }

    public static function relations()
    {
        return array(
            
        );
    }
}