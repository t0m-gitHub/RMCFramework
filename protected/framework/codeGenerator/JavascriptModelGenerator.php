<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 02.07.13
 * Time: 16:16
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class JavascriptModelGenerator extends StaticClass
{
    public static function generate()
    {
        $jsTemplatePath = \Config::get()->frameworkPath . DIRECTORY_SEPARATOR . 'codeGenerator' . DIRECTORY_SEPARATOR . 'jsTemplates' . DIRECTORY_SEPARATOR;
        $basicTemplateFile = $jsTemplatePath . 'basic.tpl';
        $basicTemplate = file_get_contents($basicTemplateFile);

        $modelFunctionTemplateFile = $jsTemplatePath . 'modelFunction.tpl';
        $modelFunctionTemplate = file_get_contents($modelFunctionTemplateFile);

        $modelPaths = \Config::get()->modelsPaths;
        $models = array();

        foreach($modelPaths as $path){
            $dir = \Config::get()->basePath . DIRECTORY_SEPARATOR . $path;
            if(!is_dir($dir)){
                throw new RMCException('model path not found');
            }

            $dirInput = scandir($dir);

            foreach($dirInput as $instance){
                $fileName = $dir . DIRECTORY_SEPARATOR . $instance;
                if(is_file($fileName) && strpos($instance, '.php')){
                    $models[] = str_replace('.php', '', $instance);
                }
            }
        }

        $modelPrototypes = '';
        $extendsSection = '';
        $modelFunctions = '';
        foreach($models as $model){
            if(class_exists($model)){
                $modelPrototypes .= "\t{$model}: function(){this.modelName = '{$model}'}, \n";
                $extendsSection .= "RMC.extend(RMC.{$model}, RMCModel); \n";
                $modelFunctions .= "/* Functions for model {$model} */ \n";
                $modelFunctions .= self::generateModelFunctions($model, $modelFunctionTemplate) ."\n\n";
            }
        }

        $result = str_replace('{REMOTE_CALL_CONTROLLER_PASS}', \Config::get()->baseUrl . 'index.php?' . HTTP_GET_ACTION_PARAMETER . '=' . REMOTE_MODEL_CALL_ACTION_NAME, $basicTemplate);
        $result = str_replace('{MODEL_PROTOTYPES}', $modelPrototypes, $result);
        $result = str_replace('{EXTENDS_SECTION}', $extendsSection, $result);
        $result = str_replace('{MODELS_DATA}', $modelFunctions, $result);
        $jsFilePath = \Config::get()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'RMC.js';
        file_put_contents($jsFilePath, $result);
    }

    private static function generateModelFunctions($model, $template)
    {
        $modelMethods = get_class_methods($model);
        $result = '';
        foreach($modelMethods as $method){
            if(strpos($method, '__') === false && $method != 'getInstance'){ //TODO: find way to make it better
                $function = str_replace('{MODEL_NAME}', $model, $template);
                $function = str_replace('{METHOD_NAME}', $method, $function) . "\n";
                $result .= $function;
            }
        }
        return $result;
    }
}