<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 29.05.13
 * Time: 22:53
 * To change this template use File | Settings | File Templates.
 */

namespace RMC;


class DataContainerResponse extends DataContainerAbstract
{
    public $success;
    public $data;
    public $errors;
    public $warnings;
}