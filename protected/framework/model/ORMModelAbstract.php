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

    abstract protected function tableName();
    abstract protected function tableFields();

    public function __set($field, $value)
    {
        $fields = $this->tableFields();
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

}