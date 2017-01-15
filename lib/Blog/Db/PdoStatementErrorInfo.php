<?php

namespace Blog\Db;


class PdoStatementErrorInfo
{
	/**
	 * @var array
	 */
	private $__errorInfo;
	
	public function __construct(\PDOStatement $stmt)
	{
		$this->__errorInfo = $stmt->errorInfo();
	}
	
	public function getSqlstateError()
	{
		return $this->__errorInfo[0];
	}
	
	public function getDriverError()
	{
		return $this->__errorInfo[1];
	}
	
	public function getErrorMessage()
	{
		return $this->__errorInfo[2];
	}
}