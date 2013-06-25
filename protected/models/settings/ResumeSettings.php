<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 25.06.13
 * Time: 20:13
 * To change this template use File | Settings | File Templates.
 */

class ResumeSettings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return 'resume';
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
            'currentJob'  => array(
                'type'      => 'varchar',
                'maxLength' => 10,
            )
        );
    }

    public static function relations(){}

}