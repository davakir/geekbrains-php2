<?php

namespace Blog;


use Blog\Db\MySql\MySqlAdapter;
use Repository\UserRepository;

class Auth
{
	public function auth($login, $password)
	{
		$result = (new UserRepository(new MySqlAdapter()))->checkAuthData($login, $password);
		
		if ($result)
			setcookie('auth', md5($login), time() + 3600, '/');

		return $result;
	}
}