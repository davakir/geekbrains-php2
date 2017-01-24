<?php

namespace Repository;


use Model\Session;

class SessionRepository extends BaseRepository
{
	/**
	 * Создание новой пользовательской сессии
	 * @param Session $session
	 */
	public function createNewSession(Session $session)
	{
		$this->_adapter->insert('sessions', [
			'sid' => $session->getSid(),
			'user_id' => $session->getUserId(),
			'date_created' => $session->getDateCreated(),
			'date_last_activity' => $session->getDateLastActivity(),
		]);
	}
	
	public function removePreviousUserSessions($userId)
	{
		return $this->_adapter->query(
			'DELETE FROM sessions WHERE user_id = ?',
			[$userId]
		);
	}
	
	/**
	 * @param string $sid
	 * @param string $date
	 * @return mixed
	 */
	public function updateLastActivityTime($sid, $date)
	{
		return $this->_adapter->query(
			'UPDATE sessions SET date_last_activity = ? WHERE sid = ?',
			[$date, $sid]
		);
	}
	
	public function getSessionBySid($sid)
	{
		return $this->_adapter->query(
			'SELECT * FROM sessions WHERE sid = ?',
			[$sid]
		)->fetch();
	}
}