<?php


class LanguagesSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Languages';
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
            'level' => array('maxLength' => 0),
            'owner' => array('maxLength' => 1), 
        );
    }

    public static function relations()
    {
        return array(
            
        );
    }
}