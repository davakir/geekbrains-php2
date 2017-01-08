<?php

include './../autoload.php';

use Blog\App\View;

$uri = $_SERVER['REQUEST_URI'];
$view = new View();

switch ($uri)
{
	case '/':
		echo $view->render('index');
		break;

	case '/about':
		echo $view->render('about');
		break;
}
