<?php

namespace Controller;

use Blog\Auth;
use Model\User;
use Repository\UserRepository;

class AuthController extends AbstractController
{
	/**
	 * Обрабатывает GET-запрос.
	 *
	 * @Route ("/register")
	 * @return array
	 */
	public function register()
	{
		return [
			'content' => $this->_view->render('registration'),
			'title' => 'Регистрация'
		];
	}
	
	/**
	 * Обрабатывает GET-запрос.
	 *
	 * @Route ("/login")
	 * @return array
	 */
	public function login()
	{
		return [
			'content' => $this->_view->render('auth'),
			'title' => 'Авторизация'
		];
	}
	
	/**
	 * Обрабатывает GET-запрос.
	 *
	 * @Route ("/logout")
	 */
	public function logout()
	{
		(new Auth())->logout();
		$this->_redirect('/');
	}
	
	/**
	 * Обрабатывает POST запрос.
	 * Если пользователя удалось авторизовать, то перенаправляем его на главную страницу,
	 * иначе возвращаем на страницу авторизации с выводом возникших ошибок.
	 *
	 * @return array|void
	 */
	public function doLogin()
	{
		$login = $_POST['login'];
		$pass = $_POST['password'];
		$remember = $_POST['remember'];
		
		$result = (new Auth())->login($login, $pass, $remember);
		
		if ($result)
		{
			$this->_redirect('/');
		}
		else
		{
			return [
				'content' => $this->_view->render('auth', ['errors' => 'Неверный логин или пароль']),
				'title' => 'Авторизация'
			];
		}
	}
	
	public function doRegister()
	{
		$userData = $this->__validateRegisterData($_POST);
		$hasErrors = false;
		foreach ($userData as $field => $info)
		{
			if (!empty($info['error']))
			{
				$hasErrors = true;
				break;
			}
		}
		
		if ($hasErrors)
		{
			return [
				'content' => $this->_view->render('registration', ['userData' => $userData]),
				'title' => 'Регистрация'
			];
		}
		else
		{
			foreach ($userData as $field => $data)
			{
				if (!empty($data['error']))
					unset($data['error']);
				$userData[$field] = $data['value'];
				unset($data['value']);
			}
			$result = (new UserRepository())->createNewUser(new User($userData));
			if ($result)
			{
				$_POST['login'] = $userData['login'];
				$_POST['password'] = $userData['password'];
				$_POST['remember'] = 1;
				return $this->doLogin();
			}
			else
			{
				return [
					'content' => $this->_view->render('registration', [
						'userData' => $userData,
						'mainError' => 'Произошла ошибка создания пользователя...'
					]),
					'title' => 'Регистрация'
				];
			}
		}
	}
	
	private function __validateRegisterData(array $data)
	{
		$result = [];
		
		$login = $data['login'];
		$result['login']['value'] = $login;
		// TODO добавить проверку на существование логина
		if (!preg_match('/^[0-9a-zA-Z_.-]{3,128}$/', $login)) {
			$result['login']['error'] = 'Логин должен содержать только латинские буквы, цифры, 
			-, ., _ и должен быть от 3 до 128 символов';
		}
		$email = $data['email'];
		$result['email']['value'] = $email;
		if (!preg_match('/^\w*@[a-z]*\.[a-z]{2,5}$/i', $email)) {
			$result['email']['error'] = 'E-mail должен соответствовать формату apetrov@domain.com';
		}
		$surname = $data['surname'];
		$result['surname']['value'] = $surname;
		if (mb_strlen($surname, 'UTF-8') < 1 || mb_strlen($surname, 'UTF-8') > 255) {
			$result['surname']['error'] = 'Фамилия должна быть длиной от 1 до 255 символов';
		}
		$names = $data['names'];
		$result['names']['value'] = $names;
		if (mb_strlen($names, 'UTF-8') < 1 || mb_strlen($names, 'UTF-8') > 255) {
			$result['names']['error'] = 'Имя должно быть длиной от 1 до 255 символов';
		}
		$password = $data['password'];
		$passwordRepeat = $data['password-repeat'];
		$result['password']['value'] = $password;
		if ($password !== $passwordRepeat)
			$result['password']['error'] = 'Пароли не совпадают';
		if (mb_strlen($password, 'UTF-8') > 255 || mb_strlen($password, 'UTF-8') < 6)
			$result['password']['error'] = 'Длина пароля должна быть от 6 до 20 символов';
		
		return $result;
	}
}