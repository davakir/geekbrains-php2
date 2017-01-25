<?php

session_start();

header('Content-Type: text/html; charset=utf-8');

include __DIR__ . './../autoload.php';

use Blog\App\Application;
use Controller\Controller;

$app = new Application();
$route = new Controller();

$app->get('/', function () use ($route) {
	return $route->index();
});

$app->get('/home', function () use ($route) {
	return $route->index();
});

$app->get('/articles', function () use ($route) {
	return $route->articles();
});

$app->get('/gallery', function () use ($route) {
	return $route->gallery();
});

$app->get('/register', function () use ($route) {
	return $route->register();
});

$app->get('/contacts', function () use ($route) {
	return $route->contacts();
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

$app->get('/logout', function () use ($route) {
	return $route->logout();
});

$app->post('/login/send', function () use ($route) {
	return $route->doLogin();
});

$app->get('/users', function () use ($route) {
	return $route->users();
});

$app->run(new \Layout\MainLayout());