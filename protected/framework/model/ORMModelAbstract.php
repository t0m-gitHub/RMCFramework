<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 15.06.13
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class ORMModelAbstract extends ModelAbstract
{
    protected $db;
    protected $modelSettings;


    public function __construct()
    {
        parent::__construct();
        $modelSettingsClass = get_class($this) . SETTINGS_SUFFIX;
        if (!class_exists($modelSettingsClass)){
            throw new RMCException('Settings for model ' . __CLASS__ . ' not found');
        }
        $this->modelSettings = $modelSettingsClass;
        if(!method_exists($modelSettingsClass, 'tableName')){
            throw new RMCException(__CLASS__ . '::tableName() method not found');
        }
        $this->db = new QueryBuilder($modelSettingsClass::tableName());

    }

    public function __set($field, $value)
    {
        $settings = $this->modelSettings;
        if(!method_exists($settings, 'tableName')){
            throw new RMCException(__CLASS__ . '::tableFields() method not found');
        }
        $fields = $settings::tableFields();
        $fieldSettings = isset($fields[$field]) ?  $fields[$field] : false;
        if($fieldSettings){
            $dbType = \Config::get()->database;
            $dbType = $dbType['dbType'];
            $ormHelper = 'RMC\\ORMHelper' . $dbType;
            if (!class_exists($ormHelper)){
                throw new RMCException("unsupported database type {$dbType}");
            }
            $this->$field = $ormHelper::prepareField($field, $value, $fields[$field]);
        } else {
            $this->$field = $value;
        }
    }

    public function getByPK($key)
    {
        $settings = $this->modelSettings;
        if(!method_exists($settings, 'primaryKey')){
            throw new RMCException(__CLASS__ . '::primaryKey() method not found');
        }
        $pk = $settings::primaryKey();
        echo $this->db
            ->where("{$pk} = :RMC_PK", array('RMC_PK' => $key))
            ->limit(1)
            ->find();
    }

}