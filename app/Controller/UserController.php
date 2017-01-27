<?php

namespace Controller;


use Repository\UserRepository;

class UserController extends AbstractController
{
	public function getUsers()
	{
		return [
			'content' => $this->_view->render('users', ['users' => (new UserRepository())->getAllUsers()]),
			'title' => 'Пользователи'
		];
	}
}