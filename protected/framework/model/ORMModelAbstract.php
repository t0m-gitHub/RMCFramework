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
            throw new RMCException('Settings for model ' . get_class($this) . ' not found');
        }
        $this->modelSettings = $modelSettingsClass;
        if(!method_exists($modelSettingsClass, 'tableName')){
            throw new RMCException(get_class($this) . '::tableName() method not found');
        }
        $this->db = new QueryBuilder($modelSettingsClass::tableName());

    }

    public function __set($field, $value)
    {
        $settings = $this->modelSettings;
        if(!method_exists($settings, 'tableName')){
            throw new RMCException(get_class($this) . '::tableFields() method not found');
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

    public function join($relation)
    {
        $settings = $this->modelSettings;
        $settings = $settings::relations();
        if(!isset($settings[$relation])){
            throw new RMCException('there\'s no relation for model ' . get_class($this));
        }
        $relationSetting = $settings[$relation];
        $joinedModelSettings = $relationSetting['model'] . SETTINGS_SUFFIX;
        if(!class_exists($joinedModelSettings)){
            throw new RMCException('Settings for model ' . $relationSetting['model'] . ' not found');
        }
        $table = $joinedModelSettings::tableName();

        $this->db->join($table, $relationSetting['condition'], $relation, !empty($relationSetting['joinType']) ? $relationSetting['joinType'] : null);
        return $this;
    }

    public function getByPK($key)
    {
        $settings = $this->modelSettings;
        if(!method_exists($settings, 'primaryKey')){
            throw new RMCException(get_class($this) . '::primaryKey() method not found');
        }
        $pk = $settings::primaryKey();
        echo $this->db
            ->where("{$pk} = :RMC_PK", array('RMC_PK' => $key))
            ->limit(1)
            ->find();
    }

}