<?php

namespace Repository;


use Blog\Db\IDbAdapter;

class UserRepository extends BaseRepository
{
	/**
	 * @param $login
	 * @param $pass
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
}