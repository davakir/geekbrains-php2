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
$app->get('\/articles\/create\?*', function () use ($mainController) {
	return $mainController->createArticle();
});
$app->post('\/articles\/create\/send', function () use ($mainController) {
	return $mainController->doCreateArticle();
});
$app->post('\/articles\/delete', function () use ($mainController) {
	return $mainController->deleteArticle();
});
$app->get('\/articles\/edit\?.+', function () use ($mainController) {
	return $mainController->editArticle();
});
$app->post('\/articles\/save', function () use ($mainController) {
	return $mainController->updateArticle();
});
$app->get('\/gallery', function () use ($mainController) {
	return $mainController->gallery();
});
$app->get('\/contacts', function () use ($mainController) {
	return $mainController->contacts();
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
$app->get('\/users\/edit\?.+', function () use ($userController) {
	return $userController->editUser();
});
$app->post('\/users\/save', function () use ($userController) {
	return $userController->updateUser();
});
$app->post('\/users\/delete', function () use ($userController) {
	return $userController->deleteUser();
});

$app->run(new \Layout\MainLayout());