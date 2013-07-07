<?php


class ExperienceSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Experience';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function tableFields()
    {
        return array(
            'id' => array('maxLength' => 3), 
            'taskName' => array('maxLength' => 255), 
            'chalanges' => array('maxLength' => 0), 
            'solutions' => array('maxLength' => 0), 
            'owner' => array('maxLength' => 3), 
        );
    }

    public static function relations()
    {
        return array(
            
        );
    }
}