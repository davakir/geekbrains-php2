<?php

include './../autoload.php';

use Blog\App\Application;
use Controller\Route;

$uri = $_SERVER['REQUEST_URI'];
$app = new Application();
$route = new Route();

$app->get('/', function () use ($route) {
	return $route->index();
});

$app->get('/about', function () use ($route) {
	return $route->about();
});

$app->get('/article/create', function () use ($route) {
	return $route->createArticle();
});

$app->post('/article/create/send', function () use ($route) {
	return $route->doCreateArticle();
});

$app->get('/login', function () use ($route) {
	return $route->login();
});

$app->post('/login/send', function () use ($route) {
	return $route->doLogin();
});

$app->run();