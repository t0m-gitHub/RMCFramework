<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 06.06.13
 * Time: 9:12
 * To change this template use File | Settings | File Templates.
 */

class AnotherTestModelValidator extends RMC\DecoratorAbstract
{
    public function testMethod()
    {
        echo 'Test Method 2 Validator <br />';
        return $this->model->testMethod();
    }
}