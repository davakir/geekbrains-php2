<?php

namespace Model\User;


class User
{
	private $id;
	private $login;
	private $password;
	private $email;
	private $surname;
	private $names;
	private $roleId;
	
	public function __construct(array $data)
	{
		$this->setLogin($data['login']);
		$this->setPassword($data['password']);
		$this->setEmail($data['email']);
		$this->setSurname($data['surname']);
		$this->setNames($data['names']);
		$this->setRoleId($data['role_id']);
	}
	
	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
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