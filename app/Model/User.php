<?php

namespace Model;


class User
{
	private $id;
	private $login;
	private $password;
	private $email = '';
	private $surname = '';
	private $names = '';
	private $roleId = 0;
	
	/**
	 * User constructor.
	 * @param array $data
	 */
	public function __construct(array $data = [])
	{
		if (!empty($data['id'])) $this->setId($data['id']);
		if (!empty($data['login'])) $this->setLogin($data['login']);
		if (!empty($data['password'])) $this->setPassword($data['password']);
		if (!empty($data['email'])) $this->setEmail($data['email']);
		if (!empty($data['surname'])) $this->setSurname($data['surname']);
		if (!empty($data['names'])) $this->setNames($data['names']);
		if (!empty($data['role_id'])) $this->setRoleId($data['role_id']);
	}
	
	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param $id
	 */
	private function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * @return mixed
	 */
	public function getLogin()
	{
		return $this->login;
	}
	
	/**
	 * @param mixed $login
	 */
	private function setLogin($login)
	{
		$this->login = $login;
	}
	
	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}
	
	/**
	 * @param mixed $password
	 */
	private function setPassword($password)
	{
		$this->password = $password;
	}
	
	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * @param mixed $email
	 */
	private function setEmail($email)
	{
		$this->email = $email;
	}
	
	/**
	 * @return mixed
	 */
	public function getSurname()
	{
		return $this->surname;
	}
	
	/**
	 * @param mixed $surname
	 */
	private function setSurname($surname)
	{
		$this->surname = $surname;
	}
	
	/**
	 * @return mixed
	 */
	public function getNames()
	{
		return $this->names;
	}
	
	/**
	 * @param mixed $names
	 */
	private function setNames($names)
	{
		$this->names = $names;
	}
	
	/**
	 * @return mixed
	 */
	public function getRoleId()
	{
		return $this->roleId;
	}
	
	/**
	 * @param mixed $roleId
	 */
	private function setRoleId($roleId)
	{
		$this->roleId = $roleId;
	}
}