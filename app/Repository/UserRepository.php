<?php

namespace Repository;


class UserRepository extends BaseRepository
{
	private $offlineTimeout = 60;
	
	/**
	 * @return array
	 */
	public function getAllUsers()
	{
		$users = $this->_adapter->query(
			'SELECT u.*, MAX(s.date_last_activity) as date_last_activity 
				FROM sessions s
				LEFT JOIN users u
				ON u.id = s.user_id
				GROUP BY s.user_id'
		)->fetchAll();
		
		foreach ($users as &$user)
		{
			$user['activity_status'] =
				((time() - strtotime($user['date_last_activity'])) > $this->offlineTimeout)
				? 'offline' : 'online';
		}
		
		return $users;
	}
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