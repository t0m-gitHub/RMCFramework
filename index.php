<?php
$rmcFramework = __DIR__ . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR ;
$config = __DIR__ . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'Config.php';

require_once($config);
require_once($rmcFramework . 'Bootstrap.php');

require_once $rmcFramework . DIRECTORY_SEPARATOR .'vendor'. DIRECTORY_SEPARATOR . 'propelorm' . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .'Propel.php';

$build = Config::get()->basePath . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR;

//RMC\Bootstrap::registerExternalAutoLoader(array('Propel', 'autoload'));
RMC\Bootstrap::registerAutoLoad();

Propel::init($build . 'conf' . DIRECTORY_SEPARATOR . 'home-conf.php');

set_include_path($build . 'classes' . DIRECTORY_SEPARATOR . get_include_path());

$session = SessionData::getInstance();
$session->setCurrentRequestParam(array('clientId' => 1));// We don't know how exactly we will auth

RMC\Bootstrap::init();
