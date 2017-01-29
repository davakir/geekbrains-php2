<?php

namespace Repository;


use Model\User;

class UserRepository extends BaseRepository
{
	private $offlineTimeout = 60;
	
	/**
	 * @return array
	 */
	public function getAllUsers()
	{
		$users = $this->_adapter->query(
			'SELECT * FROM users'
		)->fetchAll();
		$sessions = $this->_adapter->query(
			'SELECT user_id, MAX(date_last_activity) as date_last_activity FROM sessions GROUP BY user_id'
		)->fetchAll();
		
		foreach ($users as &$user)
		{
			foreach ($sessions as $session)
			{
				if ($session['user_id'] == $user['id'])
				{
					$user['date_last_activity'] = $session['date_last_activity'];
					$user['activity_status'] =
						((time() - strtotime($user['date_last_activity'])) > $this->offlineTimeout)
							? 'offline' : 'online';
					break;
				}
			}
			if (empty($user['activity_status']))
				$user['activity_status'] = 'offline';
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
	 * @return bool
	 */
	public function doesLoginExist($login)
	{
		$result = $this->_adapter->query(
			'SELECT * FROM users WHERE login = ?',
			[$login]
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
	
	/**
	 * Добавляет в базу нового пользователя.
	 * Возвращает ошибку, если таковая будет при добавлении записи в базу.
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function createNewUser(User $user)
	{
		return $this->_adapter->insert('users', [
			'login' => $user->getLogin(),
			'password' => $user->getPassword(),
			'email' => $user->getEmail(),
			'surname' => $user->getSurname(),
			'names' => $user->getNames(),
			'role_id' => $user->getRoleId()
		]);
	}
	
	/**
	 * @param integer $userId
	 */
	public function deleteUser($userId)
	{
		$this->_adapter->query(
			'DELETE FROM users WHERE id = ?',
			[$userId]
		);
	}
	
	/**
	 * @param User $user
	 */
	public function updateUser(User $user)
	{
		$this->_adapter->query(
			'UPDATE users SET login = ?, names = ?, surname = ?, email = ?, role_id = ? WHERE id = ?',
			[
				$user->getLogin(),
				$user->getNames(),
				$user->getSurname(),
				$user->getEmail(),
				$user->getRoleId(),
				$user->getId()
			]
		);
	}
}