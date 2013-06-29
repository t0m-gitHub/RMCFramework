<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 28.06.13
 * Time: 18:18
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class DatabaseInterface extends ClosedConstructor
{
    private static $instance;

    protected function __construct()
    {
        $dbSettings = \Config::get()->database;
        $dbType = \strtolower($dbSettings['dbType']);
        $this->pdo = new \PDO("$dbType:host={$dbSettings['host']};dbname={$dbSettings['dbName']}", $dbSettings['user'], $dbSettings['password']);
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdoObject()
    {
        return $this->pdo;
    }

    public function run($sql, $params = array())
    {
        die($sql);
        $statement = $this->pdo->prepare($sql);
        foreach($params as $key => $value){
            $statement->bindParam($key, $value);
        }
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}