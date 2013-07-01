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
    protected $view;

    public function __construct()
    {
        $this->view = new View($this);
    }
    /**
     * @return mixed
     *
     * Default controller action. Should be realized in every controller.
     */
    abstract public function indexAction();

    /**
     * Renders the without layout view file.
     * @param $viewName - View file name with ".php" extension. By default should be placed in /projectDir/protected/views/controllerName/ folder.
     * @param array $params('propertyName' => 'value' ... ) - properties that would be visible inside the view.
     * @return string
     */
    protected function renderWithoutLayout($viewName, $params = array())
    {
        return $this->view->renderWithoutLayout($viewName, $params);
    }

    /**
     * Renders the view file.
     * @param $viewName - View file name with ".php" extension. By default should be placed in /projectDir/protected/views/controllerName/ folder.
     * @param array $params('propertyName' => 'value' ... ) - properties that would be visible inside the view.
     * @return string
     */
    protected function render($viewName, $params = array())
    {
        return $this->view->render($viewName, $params);
    }
}
