<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 15.06.13
 * Time: 17:10
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class ORMHelperMySQL extends StaticClass
{
    public static function prepareField($field, $value, $settings)
    {
        if(isset($settings['maxLength']) && (mb_strlen($value) > $settings['maxLength']) && $settings['maxLength'] != 0){
            throw new RMCException("{$field} max allowed length is {$settings['maxLength']}");
        }
        return $field;
    }

    public static function prepareSelectCondition(array $condition, array $specs = array())
    {
        $select = 'SELECT ';
        foreach($specs as $spec){
            $select .= $spec . ' ';
        }
        if(!$condition){
            return $select . " * ";
        }
        foreach($condition as $alias => $fields){
            foreach($fields as $field){
                $select .= "`{$alias}`.`{$field}` AS `{$alias}_{$field}`,";
            }
        }
        $select[strlen($select) - 1] = ' ';
        return $select;
    }

    public static function prepareFromCondition($tableName, $tableAlias = null)
    {
        $from = "FROM `$tableName` " . (isset($tableAlias) ? "AS `$tableAlias` " : '');
        return $from;
    }

    public static function prepareWhereCondition($condition = null)
    {
        if(!$condition) {
            return null;
        }
        $where = "WHERE $condition ";
        return $where;
    }

    public static function prepareGroupByCondition($condition = null)
    {
        if(!$condition) {
            return null;
        }
        $result = "GROUP BY $condition ";
        return $result;
    }

    public static function prepareOrderByCondition($condition = null)
    {
        if(!$condition) {
            return null;
        }
        $result = "ORDER BY $condition ";
        return $result;
    }

    public static function prepareHavingCondition($condition = null)
    {
        if(!$condition) {
            return null;
        }
        $result = "HAVING $condition ";
        return $result;
    }


    public static function prepareLimitCondition($condition = null)
    {
        if(!$condition) {
            return null;
        }
        $result = "LIMIT $condition ";
        return $result;
    }

    public static function prepareJoinCondition($joinTable, $joinCondition, $alias, $joinType)
    {
        if(!$joinTable || !($joinCondition) || !($joinType)){
            return null;
        }
        $result = '';
        foreach($joinTable as $key => $table){
            $result .= "{$joinType[$key]} JOIN `{$table}` AS `{$alias[$key]}` ON ({$joinCondition[$key]}) ";
        }

        return $result;
    }



}