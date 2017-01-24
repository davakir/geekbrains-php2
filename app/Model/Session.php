<?php

namespace Model;


class Session
{
	private $session_id;
	private $sid;
	private $user_id;
	private $date_created;
	private $date_last_activity;
	
	private static $sidLength = 30;
	
	public function __construct(array $data)
	{
		$this->setSid($data['sid']);
		$this->setUserId($data['user_id']);
		$this->setDateCreated($data['date_created']);
		$this->setDateLastActivity($data['date_last_activity']);
	}
	
	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->session_id;
	}
	
	/**
	 * @return mixed
	 */
	public function getSid()
	{
		return $this->sid;
	}
	
	/**
	 * @param mixed $sid
	 */
	private function setSid($sid)
	{
		$this->sid = $sid;
	}
	
	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->user_id;
	}
	
	/**
	 * @param mixed $userId
	 */
	private function setUserId($userId)
	{
		$this->user_id = $userId;
	}
	
	/**
	 * @return mixed
	 */
	public function getDateCreated()
	{
		return $this->date_created;
	}
	
	/**
	 * @param mixed $dateCreated
	 */
	private function setDateCreated($dateCreated)
	{
		$this->date_created = $dateCreated;
	}
	
	/**
	 * @return mixed
	 */
	public function getDateLastActivity()
	{
		return $this->date_last_activity;
	}
	
	/**
	 * @param mixed $dateLastActivity
	 */
	private function setDateLastActivity($dateLastActivity)
	{
		$this->date_last_activity = $dateLastActivity;
	}
	
	/**
	 * Метод генерации session ID.
	 *
	 * @return string
	 */
	public static function generateSid()
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$charsLength = strlen($chars) - 1;
		
		$sid = '';
		while (strlen($sid) < self::$sidLength)
		{
			$sid .= substr($chars, rand(0, $charsLength), 1);
		}
		return $sid;
	}
	
	/**
	 * Метод генерации некоторого токена.
	 *
	 * @param string $length
	 * @return string
	 */
	public static function generateToken($length)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$charsLength = strlen($chars) - 1;
		
		$token = '';
		while (strlen($token) < $length)
		{
			$token .= substr($chars, rand(0, $charsLength), 1);
		}
		return $token;
	}
}