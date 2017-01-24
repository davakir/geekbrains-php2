<?php

namespace Repository;


class UserRepository extends BaseRepository
{
	/**
	 * @param string $login
	 * @param string $pass
	 * @return boolean
	 */
	public function checkAuthData($login, $pass)
	{
		$result = $this->_adapter->query(
			'SELECT * FROM users WHERE login = ? and password = ?',
			[$login, $pass]
		)->fetch();
		
		return $result ? true : false;
	}
	
	/**
	 * @param string $login
	 * @return int
	 */
	public function getUserIdByLogin($login)
	{
		return $this->_adapter->query(
			'SELECT id FROM users WHERE login = ?',
			[$login]
		)->fetchColumn();
	}
	
	/**
	 * @param $userId
	 * @return array
	 */
	public function getUserById($userId)
	{
		return $this->_adapter->query(
			'SELECT * FROM users WHERE id = ?',
			[$userId]
		)->fetch();
	}
	
	/**
	 * @param integer $userId
	 * @return string
	 */
	public function getLastActivityStatus($userId)
	{
		return $this->_adapter->query(
			'SELECT date_last_activity FROM sessions WHERE user_id = ? ORDER BY date_last_activity DESC LIMIT 1',
			[$userId]
		)->fetchColumn();
	}
}