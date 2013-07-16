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
    public function get();
    public function post();
    public function delete();
    public function put();
}