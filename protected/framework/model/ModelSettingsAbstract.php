<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 25.06.13
 * Time: 11:30
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


abstract class ModelSettingsAbstract extends StaticClass
{
    abstract static function tableName();
    abstract static function tableFields();
    abstract static function primaryKey();
    abstract static function relations();
}