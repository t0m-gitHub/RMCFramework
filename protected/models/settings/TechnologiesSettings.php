<?php


class TechnologiesSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Technologies';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function tableFields()
    {
        return array(
            'id' => array('maxLength' => 3), 
            'name' => array('maxLength' => 255), 
            'description' => array('maxLength' => 0),
            'owner' => array('maxLength' => 3), 
        );
    }

    public static function relations()
    {
        return array(
            
        );
    }
}