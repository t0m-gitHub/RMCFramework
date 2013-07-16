<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 16.07.13
 * Time: 23:04
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


interface RESTInterface
{
    public function get($params = null, $id = null);
    public function post($params = null, $id = null);
    public function delete($params = null, $id = null);
    public function put($params = null, $id = null);
}