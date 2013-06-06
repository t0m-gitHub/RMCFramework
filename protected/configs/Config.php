<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 11:13
 */
class Config
{
    public static function get()
    {
        return (object) array(
            'basePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',

            'frameworkPath' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'framework',

            'includePaths' => array(),

            'controllersPaths' => array(
                'controllers'
            ),

            'viewsPaths' => array(
                'views',
            ),

            'modelValidatorsPaths' => array (
                'models'. DIRECTORY_SEPARATOR . 'validators',
            ),

            'modelsPaths' => array(
                'models',
            ),

            'defaultController' => 'Index',

            'database' => array(
                'dbType' => 'mysql',
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'port' => '3306',
            ),
            'generalDecorator' => 'GeneralDecorator'
        );
    }
}
