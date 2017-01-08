<?php

define('APP_PATH', __DIR__ . '/app/');
define('LIB_PATH', __DIR__ . '/lib/');

$appAutoload = function ($classname) {
	require APP_PATH . implode(DIRECTORY_SEPARATOR, explode('\\', $classname)) . '.php';
};

$libAutoload = function ($classname) {
	require LIB_PATH . implode(DIRECTORY_SEPARATOR, explode('\\', $classname)) . '.php';
};

//spl_autoload_extensions('.php');

spl_autoload_register($libAutoload);
spl_autoload_register($appAutoload);
