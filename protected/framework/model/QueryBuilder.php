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
    private $tableAlias;
    private $selectCondition;
    private $selectSpecs;
    private $selectAlias;
    private $where;
    private $whereDataArray;
    private $groupBy;
    private $having;
    private $orderBy;
    private $limit;
    private $union;
    private $joinType;
    private $joinTable;
    private $joinCondition;
    private $joinAlias;
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

    public function setTableAlias($alias)
    {
        $this->tableAlias = $alias;
    }

    public function getTableAlias()
    {
        return $this->tableAlias;
    }
    public function find()
    {
        $ormHelper = $this->ormHelper;
        $select = $ormHelper::prepareSelectCondition(isset($this->selectCondition) ? $this->selectCondition : array(), isset($this->selectSpecs) ? $this->selectSpecs : array());
        $from = $ormHelper::prepareFromCondition(isset($this->tableName) ? $this->tableName : null, isset($this->tableAlias) ? $this->tableAlias : null);
        $where = $ormHelper::prepareWhereCondition($this->where);
        $groupBy = $ormHelper::prepareGroupByCondition($this->groupBy);
        $having = $ormHelper::prepareHavingCondition($this->having);
        $orderBy = $ormHelper::prepareOrderByCondition($this->orderBy);
        $limit = $ormHelper::prepareLimitCondition($this->limit);
        $join = $ormHelper::prepareJoinCondition($this->joinTable, $this->joinCondition, $this->joinAlias, $this->joinType);
        $query = $select . $from . $join. $where . $groupBy . $having . $orderBy . $limit  ;
        $db = DatabaseInterface::getInstance();
       // die($query);
        return $db->run($query, $this->whereDataArray);
    }

    public function join( $joinTable, $joinCondition, $alias, $joinType = 'LEFT' )
    {
        $this->joinCondition[] = $joinCondition;
        $this->joinTable[] = $joinTable;
        $this->joinType[] = $joinType;
        $this->joinAlias[] = $alias;
        return $this;
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

    public function select($fields, $alias, array $specs = array() )
    {
        $this->selectSpecs = $specs;
        $this->selectCondition[$alias] =  $fields ;
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