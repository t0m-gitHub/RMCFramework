<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 15.06.13
 * Time: 18:27
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class QueryBuilder
{
    private $tableName;
    private $selectCondition;
    private $selectSpecs;
    private $where;
    private $whereDataArray;
    private $groupBy;
    private $having;
    private $orderBy;
    private $limit;
    private $union;
    private $join;
    private $insertCondition;
    private $insertData;
    private $updateData;
    private $updateSpecs;
    private $ormHelper;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $dbType = \Config::get()->database;
        $dbType = $dbType['dbType'];
        $ormHelper = 'RMC\\ORMHelper' . $dbType;
        if (!class_exists($ormHelper)){
            throw new RMCException("unsupported database type {$dbType}");
        }
        $this->ormHelper = $ormHelper;
    }

    public function find()
    {
        $ormHelper = $this->ormHelper;
        $select = $ormHelper::prepareSelectCondition($this->tableName, $this->selectCondition, $this->selectSpecs);
        $from = $ormHelper::prepareFromCondition($this->tableName);
        $where = $ormHelper::prepareWhereCondition($this->where);
        $groupBy = $ormHelper::prepareGroupByCondition($this->groupBy);
        $having = $ormHelper::prepareHavingCondition($this->having);
        $orderBy = $ormHelper::prepareOrderByCondition($this->orderBy);
        $limit = $ormHelper::prepareLimitCondition($this->limit);
        return $select . $from . $where . $groupBy . $having . $orderBy . $limit  ;
    }

    public function orderBy( $orderBy )
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function limit( $limit )
    {
        $this->limit = $limit;
        return $this;
    }

    public function update( array $data, $specs = array() )
    {
        $this->updateSpecs = $specs;
        $this->updateData = $data;
        return $this;
    }

    public function insert($insertCondition = '', array $insertData)
    {
        $this->insertCondition = $insertCondition;
        $this->insertData = $insertData;
        return $this;
    }

    public function from( $table )
    {
        $this->tableName = $table;
        return $this;
    }

    public function select( array $fields, array $specs = array() )
    {
        $this->selectCondition = $fields;
        $this->selectSpecs = $specs;
        return $this;
    }

    public function where( $where, $whereDataArray )
    {
        $this->where = $where;
        $this->whereDataArray = $whereDataArray;
        return $this;
    }

    public function groupBy( $groupBy )
    {
        $this->groupBy = $groupBy;
        return $this;
    }


    public function having( $having )
    {
        $this->having = $having;
        return $this;
    }



}