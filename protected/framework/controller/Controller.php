<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 16:00
 */
namespace RMC;

/**
 * Class Controller
 * @package RMC
 *
 * Basic abstract controller. All controllers should extend this class.
 */
abstract class Controller
{
    /**
     * @return mixed
     *
     * Default controller action. Should be realized in every controller.
     */
    abstract public function indexAction();

    /**
     * Renders the view file.
     * @param $viewName - View file name with ".php" extension. By default should be placed in /projectDir/protected/views/controllerName/ folder.
     * @param array $params('propertyName' => 'value' ... ) - properties that would be visible inside the view.
     * @throws RMCException if view file not found.
     */
    protected function render($viewName, $params = array())
    {
        echo $this->renderPartial($viewName, $params);
    }

    /**
     * Renders the view file and returns it as a string.
     * @param $viewName - View file name with ".php" extension. By default should be placed in /projectDir/protected/views/controllerName/ folder.
     * @param array $params('propertyName' => 'value' ... ) - properties that would be visible inside the view.
     * @return string
     * @throws RMCException if view file not found.
     */
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
