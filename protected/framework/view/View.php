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
    private $context;
    private $title;
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->context = $controller;
    }

    /**
     * Sets page title
     * @param $title - page title
     */
    public function setPageTitle($title)
    {
       $this->title = $title;
    }
    /**
     * Renders the view without layout file and returns it as a string.
     * @return string
     * @throws RMCException if view file not found.
     * @param $viewName - View file name with ".php" extension. By default should be placed in /projectDir/protected/views/controllerName/ folder.
     * @param array $params('propertyName' => 'value' ... ) - properties that would be visible inside the view.
     */
    public function renderWithoutLayout($viewName, $params = array())
    {
        ob_start();
        $controllerName = lcfirst(Tools::getClassName($this->context));
        $paths = \Config::get()->viewsPaths;
        foreach($paths as $path){
            $view = \Config::get()->basePath . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $viewName . '.' . TEMPLATE_EXTENSION;
            if (file_exists($view)){
                extract($params, EXTR_OVERWRITE);
                require($view);
            } else {
                throw new RMCException("View {$viewName} not found");
            }
        }
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }

    /**
     * Renders the view without layout file and returns it as a string.
     * @return string
     * @throws RMCException if view file not found.
     * @param $viewName - View file name with ".php" extension. By default should be placed in /projectDir/protected/views/controllerName/ folder.
     * @param array $params('propertyName' => 'value' ... ) - properties that would be visible inside the view.
     */

    public function render($viewName, $params = array())
    {
        ob_start();
        $_content = $this->renderWithoutLayout($viewName, $params);
        $layoutFile =\Config::get()->basePath . DIRECTORY_SEPARATOR . \Config::get()->viewsPaths[0] . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR .'layout.php';
        if(!file_exists($layoutFile)){
            throw new RMCException('layout not found');
        }
        extract($params, EXTR_OVERWRITE);
        require_once($layoutFile);
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }
}