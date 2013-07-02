<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 28.06.13
 * Time: 17:56
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class ModelGenerator extends StaticClass
{
    public static function generate($tableName)
    {
        $db = DatabaseInterface::getInstance();
        $tableName = mysql_real_escape_string($tableName);
        $modelTemplatesPath = \Config::get()->frameworkPath . DIRECTORY_SEPARATOR . 'codeGenerator' . DIRECTORY_SEPARATOR . 'modelTemplates' . DIRECTORY_SEPARATOR;
        $model = file_get_contents($modelTemplatesPath . 'model.tpl');
        $model = str_replace('{ModelName}', $tableName, $model);
        $tableInfo = $db->run("DESCRIBE `{$tableName}`");

        $modelProperties = "/**\n";
        $pk = '';
        $tableFields = '';
        foreach($tableInfo as $property){
            $modelProperties .= " * @property mixed {$property['Field']} \n";
            $charEntrance = strpos($property['Type'],'(');
            $maxLength = 0;
            if($charEntrance !== false){
                $closeCharEntrance = strpos($property['Type'],')');
                $maxLength = substr($property['Type'], $charEntrance+1, ($closeCharEntrance - $charEntrance)-1 );
            }
            $tableFields .= "\n            '{$property['Field']}' => array('maxLength' => {$maxLength}), ";
            if($property['Key'] == 'PRI'){
                $pk = $property['Field'];
            }
        }
        $modelProperties .= '*/';
        $model = str_replace('{ModelProperties}', $modelProperties, $model);

        $modelSettings = file_get_contents($modelTemplatesPath . 'modelSettings.tpl');
        $modelSettings = str_replace('{ModelName}', $tableName, $modelSettings);
        $modelSettings = str_replace('{TableName}', $tableName, $modelSettings);
        $modelSettings = str_replace('{PK}', $pk, $modelSettings);
        $modelSettings = str_replace('{TableFields}', $tableFields, $modelSettings);
        $modelSettings = str_replace('{Relations}', '', $modelSettings);

        $modelValidator = file_get_contents($modelTemplatesPath . 'modelValidator.tpl');
        $modelValidator = str_replace('{ModelName}', $tableName, $modelValidator);

        $modelValidatorsPath = \Config::get()->modelValidatorsPaths;
        $modelSettingsPaths = \Config::get()->modelSettingsPaths;
        $modelsPaths = \Config::get()->modelsPaths;

        file_put_contents(\Config::get()->basePath . DIRECTORY_SEPARATOR . $modelsPaths[0] . DIRECTORY_SEPARATOR . $tableName . '.php', $model);
        file_put_contents(\Config::get()->basePath . DIRECTORY_SEPARATOR . $modelSettingsPaths[0] . DIRECTORY_SEPARATOR . $tableName . SETTINGS_SUFFIX . '.php', $modelSettings);
        file_put_contents(\Config::get()->basePath . DIRECTORY_SEPARATOR . $modelValidatorsPath[0] . DIRECTORY_SEPARATOR . $tableName . VALIDATORS_SUFFIX . '.php', $modelValidator);
        //echo $modelValidator;
    }
}