<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-framework/yii.php';

require_once($yii);

// Config base dir
$base = dirname(__FILE__).DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;

// Get the domain
$domain = $_SERVER['SERVER_NAME'];
if (strpos($domain, 'www.') !== false) {
	$domain = str_replace('www.', '', $domain);
}

// You could show here something else, we just use the dev server configuration
// Or even remove this check in production at all - it will save stat operations
if (!file_exists($base.'sites'.DIRECTORY_SEPARATOR.$domain.'.php')) {
	$domain = 'default';
}

$main = include($base.'main.php');
$domain_config = include($base.DIRECTORY_SEPARATOR.'sites'.DIRECTORY_SEPARATOR.$domain.'.php');

// Merge configs
$config = array_merge($main, $domain_config);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// check environment dev or production
if (strpos(getenv("SERVER_SOFTWARE"), 'Development') === 0) {
    define('ENV_DEV', true); // we are on development machine
} else {
    define('ENV_DEV', false); // we are on production server
}

Yii::createWebApplication($config)->run();