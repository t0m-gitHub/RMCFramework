<?php

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

            'generalModelDecorator' => 'GeneralModelDecorator',

            'exceptionHandler' => 'ExceptionHandler'

        );
    }
}
