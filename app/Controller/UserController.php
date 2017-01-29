<?php

namespace Controller;


use Blog\Rights;
use Model\CurrentUser;
use Model\User;
use Repository\RightsRepository;
use Repository\SessionRepository;
use Repository\UserRepository;

class UserController extends AbstractController
{
	public function getUsers()
	{
		if (!$this->_isAuthorized())
			$this->_redirect('/');
		
		$permissions = (new RightsRepository())->getRoleOperations(CurrentUser::getInstance()->getRoleId());
		
		return [
			'content' => $this->_view->render('users', [
				'users' => (new UserRepository())->getAllUsers(),
				'canDeleteUser' => Rights::hasPermission(Rights::DELETE_USER, $permissions),
				'canChangeRights' => Rights::hasPermission(Rights::CHANGE_USER_RIGHTS, $permissions)
				
			]),
			'title' => 'Пользователи'
		];
	}
	
	/**
	 * Обрабатывает GET-запрос.
	 */
	public function editUser()
	{
		return [
			'content' => $this->_view->render('user-edit', [
				'user' => new User(
					(new UserRepository())->getUserById($_GET['user'])
				),
				'roles' => (new RightsRepository())->getAllRoles()
			]),
			'title' => 'Редактирование пользователя'
		];
	}
	
	/**
	 * Обрабатывает POST-запрос.
	 */
	public function updateUser()
	{
		$data = $_POST;
		
		(new UserRepository())->updateUser(
			new User([
				'login' => $data['login'],
				'names' => $data['names'],
				'surname' => $data['surname'],
				'email' => $data['email'],
				'role_id' => $data['role'],
				'id' => $data['user']
			])
		);
		
		$this->_redirect('/users');
	}
	
	public function deleteUser()
	{
		(new UserRepository())->deleteUser($_POST['user']);
		(new SessionRepository())->removeUserSessions($_POST['user']);
		$this->_redirect('/users');
	}
}