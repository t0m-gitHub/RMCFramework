<?php


class MeSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'Me';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function tableFields()
    {
        return array(
            'id' => array('maxLength' => 1), 
            'firstName' => array('maxLength' => 50), 
            'middleName' => array('maxLength' => 50), 
            'lastName' => array('maxLength' => 50), 
            'dayOfBirth' => array('maxLength' => 0), 
            'city' => array('maxLength' => 255),
            'email' => array('maxLength' => 100),
            'phone' => array('maxLength' => 100)
        );
    }

    public static function relations()
    {
        return array(
            'resume' => array (
                'model' => 'Resume',
                'type'  => 'One',
                'condition' => 'resume.owner = Me.id',
                'joinType' => 'LEFT'
            ),
            'languages' => array (
                'model' => 'Languages',
                'type'  => 'Many',
                'condition' => 'languages.owner = Me.id',
                'joinType' => 'LEFT'
            ),
            'education' => array (
                'model' => 'Education',
                'type'  => 'Many',
                'condition' => 'education.owner = Me.id',
                'joinType' => 'LEFT'
            )
        );
    }
}