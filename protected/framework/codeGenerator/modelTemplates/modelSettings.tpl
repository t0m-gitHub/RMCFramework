<?php


class {ModelName}Settings extends \RMC\ModelSettingsAbstract
{
    public static function tableName()
    {
        return '{TableName}';
    }

    public static function primaryKey()
    {
        return '{PK}';
    }

    public static function tableFields()
    {
        return array({TableFields}
        );
    }

    public static function relations()
    {
        return array(
            {Relations}
        );
    }
}