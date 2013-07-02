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

            'baseUrl'  => 'http://127.0.0.1/RMCFramework/',

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

            'modelSettingsPaths' => array (
                'models'. DIRECTORY_SEPARATOR . 'settings',
            ),

            'modelsPaths' => array(
                'models',
            ),

            'defaultController' => 'Index',

            'database' => array(
                'dbType' => 'MySQL',
                'user' => 'root',
                'password' => 'root',
                'host' => 'localhost',
                'port' => '3306',
                'dbName' => 'resume',
            ),

            'generalModelDecorator' => 'GeneralDecorator',

            'exceptionHandler' => 'ExceptionHandler'

        );
    }
}
