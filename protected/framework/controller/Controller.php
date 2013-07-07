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

    public function getControllerName()
    {
        return Tools::getClassName($this);
    }

    /**
     * @return mixed
     *
     * Default controller action. Should be realized in every controller.
     */
    abstract public function indexAction();
}
