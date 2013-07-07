<?php


class EducationSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Education';
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
            'description' => array('maxLength' => 255), 
            'enterDate' => array('maxLength' => 0), 
            'graduateDate' => array('maxLength' => 0), 
            'owner' => array('maxLength' => 1), 
        );
    }

    public static function relations()
    {
        return array(
            
        );
    }
}