<?php

namespace Blog;

use Model\Session;
use Model\User\User;
use Repository\SessionRepository;
use Repository\UserRepository;

class Auth
{
	public static $cookieLiveTime = 3600 * 24;
	
	private $cookieName = 'iamalive';
	
	/**
	 * @param $login
	 * @param $password
	 * @param bool $remember
	 * @return array
	 */
	public function login($login, $password, $remember = false)
	{
		$userRep = new UserRepository();
		
		$result = $userRep->checkAuthData($login, $password);
		$userId = $userRep->getUserIdByLogin($login);
		
		if (!$result)
			return [];
		
		$this->__openSession($userId, $remember);

		return ['user_id' => $userId];
	}
	
	/**
	 * @return array
	 */
	public function getAuthInfo()
	{
		$cookie = !empty($_COOKIE[$this->cookieName]) ? $_COOKIE[$this->cookieName] : null;
		$user = [];
		
		if ($cookie)
		{
			/**
			 * @var $session Session
			 */
			$sessionData = (new SessionRepository())->getSessionBySid($cookie);
			if (!empty($sessionData))
			{
				$session = (new Session($sessionData));
				$user = (new UserRepository())->getUserById($session->getUserId());
			}
		}
		
		return [
			$user, $sessionData
		];
	}
	
	/**
	 * @param int $userId
	 * @param boolean $remember
	 */
	private function __openSession($userId, $remember = false)
	{
		$date = date('Y-m-d H:i:s');
		$sid = md5($date . Session::generateSid());
		
		
		$session = new Session([
			'user_id' => $userId,
			'sid' => $sid,
			'date_created' => $date,
			'date_last_activity' => $date
		]);
		
		(new SessionRepository())->createNewSession($session);
		
		if ($remember)
		{
			setcookie($this->cookieName, $sid, time() + 3600 * 24, '/');
		}
	}
	
	
}