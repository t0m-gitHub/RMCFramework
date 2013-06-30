<?php
/**
 * This model concept is just a tryout. It's pretty ugly, broken and should be rewritten.
 */

namespace RMC;

abstract class ORMModelAbstract extends ModelAbstract
{
    protected $db;
    private $usedRelations;
    private $relationsMap;

    public function __construct()
    {
        parent::__construct();
        $this->usedRelations = array();
        $modelSettingsClass = $this->getModelSettings(get_class($this));
        $this->db = new QueryBuilder($modelSettingsClass::tableName());
    }

    public function __set($field, $value)
    {
//        $settings = $this->getModelSettings(get_class($this));
//        if(!method_exists($settings, 'tableName')){
//            throw new RMCException(get_class($this) . '::tableFields() method not found');
//        }
//        $fields = $settings::tableFields();
//        $fieldSettings = isset($fields[$field]) ?  $fields[$field] : false;
//        if($fieldSettings){
//            $dbType = \Config::get()->database;
//            $dbType = $dbType['dbType'];
//            $ormHelper = 'RMC\\ORMHelper' . $dbType;
//            if (!class_exists($ormHelper)){
//                throw new RMCException("unsupported database type {$dbType}");
//            }
//            $this->$field = $ormHelper::prepareField($field, $value, $fields[$field]);
//        } else {
            $this->$field = $value;
//        }
    }

    protected function setMainTableAlias($alias)
    {
        $this->db->setTableAlias($alias);
        return $this;
    }
    protected function join($relations = array())
    {
        $this->usedRelations = array();
        foreach ($relations as $relation) {
            $relationsArray = explode('.', $relation);
            $modelSettings = $this->getModelSettings(get_class($this));
            foreach($relationsArray as $key => $currentRelation){
                if(in_array($currentRelation, $this->usedRelations)){
                    continue;
                }
                if($key == 0){
                    $this->makeJoin($currentRelation, $modelSettings);
                } else {
                    $oldSettings = $modelSettings::relations();
                    $modelName = $oldSettings[$relationsArray[$key - 1]];
                    $modelSettings = $this->getModelSettings($modelName['model']);
                    $this->makeJoin($currentRelation, $modelSettings);
                }
                $settingsArray = $modelSettings::relations();
                $this->relationsMap[$currentRelation] = array(
                    'pathInModel' => $this->makeRelationsMap($currentRelation, $relationsArray),
                    'modelName' => $settingsArray[$currentRelation]['model']
                );
                $this->usedRelations[] = $currentRelation;
            }

        }
        return $this;
    }

    protected function getByPK($key)
    {

        $settings = $this->getModelSettings(get_class($this));
        if(!method_exists($settings, 'primaryKey')){
            throw new RMCException(get_class($this) . '::primaryKey() method not found');
        }
        $pk = $settings::primaryKey();
        $db = $settings::tableName();
        $fields = $settings::tableFields();
        $this->db->select(array_keys($fields), ($this->db->getTableAlias() !=null) ? $this->db->getTableAlias() : $db);
        $result = $this->makeOutputObject($this->db
            ->where("`{$db}`.`{$pk}` = :RMC_PK", array(':RMC_PK' => $key))
            ->find(), false);
        $modelSettingsClass = $this->getModelSettings(get_class($this));
        $this->db = new QueryBuilder($modelSettingsClass::tableName());
        return $result;
    }

    protected function find($where, $params = array())
    {
        $settings = $this->getModelSettings(get_class($this));
        $db = $settings::tableName();
        $fields = $settings::tableFields();
        $this->db->select(array_keys($fields), ($this->db->getTableAlias() !=null) ? $this->db->getTableAlias() : $db);
        $result =  $this->makeOutputObject($this->db
            ->where($where, $params)
            ->find(), true);
        $modelSettingsClass = $this->getModelSettings(get_class($this));
        $this->db = new QueryBuilder($modelSettingsClass::tableName());
        return $result;
    }

    private function makeRelationsMap($relation, $relationsArray){
        $map = '';
        $found = false;
        foreach($relationsArray as $key => $currentRelation){
            $map .= $currentRelation;
            if(!isset($relationsArray[$key+1])){
                $map = ($key == 0) ? null : $map;
                break;
            }
            if($relation == $relationsArray[$key+1]){
                $found = true;
                break;
            }
            $map .= '.';
        }
        return  $found ? $map : null;
    }


    private function makeJoin($relation, $currentSettings)
    {
        if(!class_exists($currentSettings)){
            throw new RMCException("{$currentSettings} doesn't exist");
        }
        $settings = $currentSettings::relations();
        if(!isset($settings[$relation])){
            throw new RMCException("there's no {$relation} relation in " . $settings);
        }
        $relationSetting = $settings[$relation];
        $joinedModelSettings = $relationSetting['model'] . SETTINGS_SUFFIX;
        if(!class_exists($joinedModelSettings)){
            throw new RMCException('Settings for model ' . $relationSetting['model'] . ' not found');
        }
        $table = $joinedModelSettings::tableName();
        $fields = $joinedModelSettings::tableFields();
        $this->db->select(array_keys($fields), $relation);
        $this->db->join($table, $relationSetting['condition'], $relation, !empty($relationSetting['joinType']) ? $relationSetting['joinType'] : null);
        return $this;
    }

    private function makeOutputObject($pdoAnswer, $makeManyObjects = false)
    {
        $thisClass = get_class($this);
        $mainObject = $thisClass::getInstance();
        $modelSettingsClass = $this->getModelSettings(get_class($this));
        $modelFields = array_keys($modelSettingsClass::tableFields());
        $pk = $modelSettingsClass::primaryKey();
        $alias = ($this->db->getTableAlias() != null) ? $this->db->getTableAlias() : $thisClass;
        if(!$makeManyObjects){
            foreach($modelFields as $field){
                $mainObject->$field = $pdoAnswer[0]["{$alias}_{$field}"];
            }
            return $this->makeOutputObjectHelper($pdoAnswer, $mainObject);
        }

        $modelFiledValues = array();
        foreach($pdoAnswer as $pdoRow){
            $row = array();
            if(isset($modelFiledValues[$pdoRow["{$alias}_{$pk}"]])){
                continue;
            }
            foreach($modelFields as $field){
                $row[$field] = $pdoRow["{$alias}_{$field}"];
            }
            if($row[$pk] != null){
                $modelFiledValues[$row[$pk]] = $row;
            }
        }
        $objectArray = array();
        foreach($modelFiledValues as $modelFieldVal){
            $object = $thisClass::getInstance();
            foreach($modelFieldVal as $property => $value){
                $object->$property = $value;
            }
            $objectArray[] = $this->makeOutputObjectHelper($pdoAnswer, $object);
        }
        return $objectArray;

    }

    private function makeOutputObjectHelper($pdoAnswer, $object)
    {
        $mainObject = $object;
        //var_export($this->relationsMap);die;
        foreach($this->relationsMap as $relation => $map){
            if($map['pathInModel']){
                $modelSettingsClass = $this->getModelSettingsClassByRelationMap($relation, $map['pathInModel']);
            } else {
                $modelSettingsClass = $this->getModelSettings(get_class($this));
            }
            $relationSettings = $modelSettingsClass::relations();

            $relationType = $relationSettings[$relation]['type'];
            $currentRelationClassModelSettings = $this->getModelSettings($map['modelName']);
            $modelFields = array_keys($currentRelationClassModelSettings::tableFields());
            $relationModelPK = $currentRelationClassModelSettings::primaryKey();
            switch($relationType){
                case RELATION_TYPE_ONE:
                    $object = $map['modelName']::getInstance();
                    foreach($modelFields as $field){
                        $object->$field = $pdoAnswer[0]["{$relation}_{$field}"];
                    }
                    $this->setModelPropertyByMap($mainObject,$relation, $object, $map['pathInModel']);
                    break;
                case RELATION_TYPE_MANY:
                    $modelFiledValues = array();
                    foreach($pdoAnswer as $pdoRow){
                        $row = array();
                        if(isset($modelFiledValues[$pdoRow["{$relation}_{$relationModelPK}"]])){
                            continue;
                        }
                        foreach($modelFields as $field){
                            $row[$field] = $pdoRow["{$relation}_{$field}"];
                        }
                        if($row[$relationModelPK] != null){
                            $modelFiledValues[$row[$relationModelPK]] = $row;
                        }
                    }
                    $objectArray = array();
                    foreach($modelFiledValues as $modelFieldVal){
                        $object = $map['modelName']::getInstance();
                        foreach($modelFieldVal as $property => $value){
                            $object->$property = $value;
                        }
                        $objectArray[] = $object;
                    }
                    $this->setModelPropertyByMap($mainObject,$relation, $objectArray, $map['pathInModel']);
                    break;
            }
        }
        return $mainObject;
    }

    private function setModelPropertyByMap($model, $property, $propertyValue, $map)
    {
        if(!$map){
            if(is_array($propertyValue)){
                $resultArray = array();
                foreach($propertyValue as $value){
                    if(isset($value->owner) && $value->owner == $model->id){
                        $resultArray[] = $value;
                    }
                }
                $model->$property = $resultArray;
            } elseif(isset($propertyValue->owner) && $model->id == $propertyValue->owner){
                $model->$property = $propertyValue;
            }

            return $model;
        }
        $internalModel = $model;
        $mapArray = explode('.', $map);
        foreach($mapArray as $relation){
            $internalModel = $internalModel->$relation;
        }
        if(!is_array($internalModel)){
            if (is_object($propertyValue) && $model->id != $propertyValue->owner){
                return $model;
            }
            $internalModel->$property = $propertyValue;
        } else {
            foreach($internalModel as $key=>$object){

                if(is_array($propertyValue)){
                    $resultArray = array();
                    foreach($propertyValue as $value){
                        if ($object->id == $value->owner){
                            $resultArray[] = $value;
                        }
                    }
                    $internalModel[$key]->$property = $resultArray;
                } else {
                    if ($propertyValue->owner == $object->id){
                        $internalModel[$key]->$property = $propertyValue;
                    }
                }


            }
        }

        return $model;
    }

    private function getModelSettingsClassByRelationMap($relation, $map)
    {
        $modelSettingsClass = $this->getModelSettings(get_class($this));
        $modelRelationSettings = $modelSettingsClass::relations();
        $map = explode('.', $map);
        foreach($map as $relation){
            $modelName = $modelRelationSettings[$relation]['model'];
            $modelSettingsClass = $this->getModelSettings($modelName);
            $result = $modelSettingsClass;
            $modelRelationSettings = $modelSettingsClass::relations();
        }
        return $result;
    }

    private function getModelSettings($modelName)
    {
        $modelSettingsClass = $modelName . SETTINGS_SUFFIX;
        if (!class_exists($modelSettingsClass)){
            throw new RMCException('Settings for model ' . $modelName . ' not found');
        }
        if(!method_exists($modelSettingsClass, 'tableName')){
            throw new RMCException($modelName . '::tableName() method not found');
        }
        return $modelSettingsClass;

    }

}