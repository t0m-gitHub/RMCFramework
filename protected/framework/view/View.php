<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 25.06.13
 * Time: 10:48
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class View
{
    private $viewName;
    private $params;
    private $context;
    /**
     * @param Controller $controller
     * @param $viewName - View file name with ".php" extension. By default should be placed in /projectDir/protected/views/controllerName/ folder.
     * @param array $params('propertyName' => 'value' ... ) - properties that would be visible inside the view.
     */
    public function __construct(Controller $controller, $viewName, $params = array())
    {
        $this->params = $params;
        $this->viewName = $viewName;
        $this->context = $controller;
    }
    /**
     * Renders the view file and returns it as a string.
     * @return string
     * @throws RMCException if view file not found.
     */
    public function render()
    {
        ob_start();
        $controllerName = lcfirst(Tools::getClassName($this->context));
        $paths = \Config::get()->viewsPaths;
        foreach($paths as $path){
            $view = \Config::get()->basePath . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $this->viewName . '.' . TEMPLATE_EXTENSION;
            extract($this->params,EXTR_OVERWRITE);
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