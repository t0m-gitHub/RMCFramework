<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 25.06.13
 * Time: 11:25
 * To change this template use File | Settings | File Templates.
 */

class MeSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'me';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function tableFields()
    {
        return array(
            'id'         => array(
                'type' => 'int'
            ),
            'firstName'  => array(
                'type'      => 'varchar',
                'maxLength' => 10,
            ),
            'secondName' => array(
                'type'      => 'varchar',
                'maxLength' => 100,
            ),
            'lastName'   => array(
                'type'      => 'varchar',
                'maxLength' => 100,
            ),
            'dateOfBirth'=> array(
                'type'      => 'dateTime'
            ),
            'resumeId' => array(
                'type' => 'int'
            )
        );
    }

    public static function relations()
    {
        return array(
            'resume' => array(
                'model' => 'Resume',
                'type'  => 'hasOne',
                'condition' => 'resume.id = me.resumeId',
                'joinType' => 'LEFT'
            )
        );
    }
}