<?php

namespace Model;

class CurrentUser
{
	/**
	 * @var \Model\User
	 */
	private static $currentUser;
	
	public static function getInstance()
	{
		return self::$currentUser;
	}
	
	public function initCurrentUser(array $data)
	{
		if (!self::$currentUser)
		{
			self::$currentUser = new User($data);
		}
	}
}