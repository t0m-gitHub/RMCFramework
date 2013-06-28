<?php
$rmcFrameworkBootstrap = __DIR__ . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'Bootstrap.php' ;
$config = __DIR__ . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'Config.php';

require_once($config);
require_once($rmcFrameworkBootstrap);

RMC\Bootstrap::setAutoLoad();
RMC\Bootstrap::init();
