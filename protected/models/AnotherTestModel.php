<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 06.06.13
 * Time: 9:12
 * To change this template use File | Settings | File Templates.
 */

class AnotherTestModel extends RMC\ModelAbstract
{

    public function testMethod()
    {
        echo 'model 2 test method<br /><br />';
    }

    /**
     * @return AnotherTestModel
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}