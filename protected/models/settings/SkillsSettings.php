<?php


class SkillsSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Skills';
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
            'owner' => array('maxLength' => 3), 
            'level' => array('maxLength' => 0),
        );
    }

    public static function relations()
    {
        return array(
            
        );
    }
}