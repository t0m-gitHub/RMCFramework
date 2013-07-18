<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 7/18/13
 * Time: 5:42 PM
 * To change this template use File | Settings | File Templates.
 */

class ClientModelValidator extends RMC\DecoratorAbstract
{
    public function getBaseInfo($params = null)
    {
        return $this->_model->getBaseInfo($params);
    }
}