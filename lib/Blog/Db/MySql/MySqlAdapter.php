<?php

namespace Blog\Db\MySql;

use Blog\App\Logger;
use Blog\Db\IDbAdapter;
use Blog\Db\DbConfiguration;
use Blog\Db\PdoStatementErrorInfo;

class MySqlAdapter implements IDbAdapter
{
	/**
	 * @var array
	 */
	private $__dbConfig;
	/**
	 * Database server name.
	 *
	 * @var string
	 */
	private $__dsn;
	/**
	 * Connect to db.
	 *
	 * @var \PDO
	 */
	private $__connect;
	
	/**
	 * @var PdoStatementErrorInfo
	 */
	private $__pdoErrorInfo;
	/**
	 * @var \PDOStatement
	 */
	private $__pdoStatement;
	
	/**
	 * Initialize adapter with getting db configurations
	 * and dsn for future connections to db.
	 *
	 * MySqlAdapter constructor.
	 */
	public function __construct()
	{
		$this->__dbConfig = DbConfiguration::getConf('localhost');
		
		$this->__dsn = $this->__dbConfig['db_driver'] .
			':host=' . $this->__dbConfig['db_host'] .
			';dbname=' . $this->__dbConfig['db_name'];
	}
	
	public function connect()
	{
		if (!$this->__connect)
		{
			$this->__connect = new \PDO(
				$this->__dsn,
				$this->__dbConfig['db_user'],
				$this->__dbConfig['db_password']
			);
		}
		
		return $this->__connect;
	}
	
	public function closeConnect()
	{
		// TODO: Implement closeConnect() method.
	}
	
	/**
	 * Method for custom user CUDR queries.
	 * Only SELECT requires fetchAll() to be used next.
	 *
	 * @param $query
	 * @param array $bindParams
	 * @return $this
	 */
	public function query($query, $bindParams = [])
	{
		$this->__pdoStatement = $this->connect()->prepare($query);
		$this->__pdoStatement->execute($bindParams);
		
		$info = (new PdoStatementErrorInfo($this->__pdoStatement));
		$this->__log($this->__pdoStatement->queryString, $info);
		
		return $this;
	}
	
	public function fetch()
	{
		return $this->__pdoStatement->fetchAll();
	}
	
	public function fetchColumn()
	{
		// TODO: Implement fetchColumn() method.
	}
	
	public function fetchObject()
	{
		// TODO: Implement fetchObject() method.
	}
	
	public function select($table, array $fields = [])
	{
		return $this;
	}
	
	/**
	 * @param $table
	 * @param array $data
	 * @return mixed
	 */
	public function insert($table, array $data)
	{
		$prepareValues = [];
		foreach (array_values($data) as $item)
			$prepareValues[] = '?';
		
		$stmt = $this->connect()->prepare(
			"INSERT INTO $table (". implode(',', array_keys($data)) .") VALUES (". implode(',', $prepareValues) .")"
		);
		
		$stmt->execute(array_values($data));
		
		$info = (new PdoStatementErrorInfo($stmt));
		$this->__log($stmt->queryString, $info);
		
		return $info->getErrorMessage();
	}
	
	public function update($table, array $options = [])
	{
		// TODO: Implement update() method.
	}
	
	public function where(array $options)
	{
		$where = [];
		foreach ($options as $field => $option)
			$where[] = $field . ' = ' . $option;
		
		$this->__query .= ' WHERE ' . implode(' AND ');
		
		return $this;
	}
	
	public function limit($count)
	{
		// TODO: Implement limit() method.
	}
	
	public function offset($count)
	{
		// TODO: Implement offset() method.
	}
	
	private function __log($query, PdoStatementErrorInfo $info)
	{
		Logger::dbLog($query, $info->getErrorMessage());
	}
}