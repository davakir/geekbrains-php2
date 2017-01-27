<?php

session_start();

header('Content-Type: text/html; charset=utf-8');

include __DIR__ . './../autoload.php';

use Blog\App\Application;
use Controller\Controller;
use Controller\UserController;
use Controller\AuthController;

$app = new Application();
$mainController = new Controller();
$userController = new UserController();
$authController = new AuthController();

$app->get('\/', function () use ($mainController) {
	return $mainController->index();
});
$app->get('\/home', function () use ($mainController) {
	return $mainController->index();
});
$app->get('\/articles', function () use ($mainController) {
	return $mainController->articles();
});
$app->get('\/gallery', function () use ($mainController) {
	return $mainController->gallery();
});
$app->get('\/contacts', function () use ($mainController) {
	return $mainController->contacts();
});
$app->get('\/article\/create\?*', function () use ($mainController) {
	return $mainController->createArticle();
});
$app->post('\/article\/create\/send', function () use ($mainController) {
	return $mainController->doCreateArticle();
});
$app->get('\/login', function () use ($authController) {
	return $authController->login();
});
$app->get('\/logout', function () use ($authController) {
	return $authController->logout();
});
$app->post('\/login\/send', function () use ($authController) {
	return $authController->doLogin();
});
$app->get('\/register', function () use ($authController) {
	return $authController->register();
});
$app->post('\/register\/send', function () use ($authController) {
	return $authController->doRegister();
});
$app->get('\/users', function () use ($userController) {
	return $userController->getUsers();
});

$app->run(new \Layout\MainLayout());