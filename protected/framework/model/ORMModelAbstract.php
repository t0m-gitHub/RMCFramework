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

    public function __construct()
    {
        parent::__construct();
        $modelSettingsClass = $this->getModelSettings(get_class($this));
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

    public function join($relation, $currentSettings = null)
    {
        if (strpos($relation, '.') !== false){
            $relations = explode('.', $relation);
            $relationsString = '';
            $relation = end($relations);
            unset($relations[count($relations) - 1]);
            foreach ($relations as $key => $rel) {
                $relationsString .= $rel . ( ($key < count($relations) - 1) ? '.' : '' );
            }

            $settingsClassThis = $this->getModelSettings(get_class($this));
            $settingsClass = isset($currentSettings) ?  $currentSettings::relations() : $settingsClassThis::relations();
            if(!isset($settingsClass[$relation])){
                throw new RMCException("there's no {$relation} relation for model1 " . $settingsClassThis);
            }
            $settingsClass = $settingsClass[$relation]['model'] . SETTINGS_SUFFIX;
            $this->join($relationsString, $settingsClass);

        }
        $thisSettings = $this->getModelSettings(get_class($this));
        $settings = isset($currentSettings) ? $currentSettings::relations() : $thisSettings::relations();
        if(!isset($settings[$relation])){
            throw new RMCException("there's no {$relation} relation for model " . $settingsClass);
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
        $settings = $this->getModelSettings(get_class($this));
        if(!method_exists($settings, 'primaryKey')){
            throw new RMCException(get_class($this) . '::primaryKey() method not found');
        }
        $pk = $settings::primaryKey();
        echo $this->db
            ->where("{$pk} = :RMC_PK", array('RMC_PK' => $key))
            ->limit(1)
            ->find();
    }

    private function getModelSettings($modelName)
    {
        $modelSettingsClass = $modelName . SETTINGS_SUFFIX;
        if (!class_exists($modelSettingsClass)){
            throw new RMCException('Settings for model ' . get_class($this) . ' not found');
        }
        if(!method_exists($modelSettingsClass, 'tableName')){
            throw new RMCException($modelName . '::tableName() method not found');
        }
        return $modelSettingsClass;

    }

}