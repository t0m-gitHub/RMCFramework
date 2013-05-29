<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 16:00
 */
namespace RMC;

abstract class Controller
{
    abstract public function indexAction();

    protected function render($viewName, $params = array())
    {
        echo $this->renderPartial($viewName, $params);
    }

    protected function renderPartial($viewName, $params = array())
    {
        ob_start();
        $controllerName = lcfirst(Tools::getClassName($this));
        $paths = \Config::get()->viewsPaths;
        foreach($paths as $path){
            $view = \Config::get()->basePath . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $viewName . '.' . TEMPLATE_EXTENSION;
            extract($params,EXTR_OVERWRITE);
            if (file_exists($view)){
                require($view);
            } else {
                throw new RMCException("View {$viewName} not found");
            }
        }
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }
}
