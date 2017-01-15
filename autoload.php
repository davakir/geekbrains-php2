<?php

define('APP_PATH', __DIR__ . '/app/');
define('LIB_PATH', __DIR__ . '/lib/');

$paths = [
	APP_PATH, LIB_PATH
];

$autoload = function ($classname) use ($paths) {
	foreach ($paths as $path)
	{
		$file = $path . implode(DIRECTORY_SEPARATOR, explode('\\', $classname)) . '.php';
		
		if (file_exists($file))
		{
			include_once $file;
			break;
		}
	}
};

spl_autoload_register($autoload);
