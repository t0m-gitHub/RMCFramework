<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 01.07.13
 * Time: 19:48
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class T
{
    public static function get($string, $lang = null)
    {
        if(!isset($lang)){
            $lang = strtoupper(Session::get('lang'));
        }
        $translationArray = self::getTranslationArray($lang);
        return !empty($translationArray[$string]) ? $translationArray[$string] : $string;
    }

    private static function getTranslationArray($lang)
    {
        $translationFile = \Config::get()->basePath . DIRECTORY_SEPARATOR . 'Translation' . $lang . '.php';
        if(!file_exists($translationFile)){
           return array();
        }

        return require_once($translationFile);
    }

}