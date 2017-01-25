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
	 * @var \PDOStatement
	 */
	private $__pdoStatement;
	/**
	 * Query made of select(), update() or delete() adapter methods.
	 * @var string
	 */
	private $__query;
	/**
	 * No comments.
	 * @var string
	 */
	private $__where;
	
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
	
	/**
	 * MySqlAdapter destructor.
	 */
	public function __destruct()
	{
		$this->closeConnect();
	}
	
	/**
	 * @return \PDO
	 */
	public function connect()
	{
		if (!$this->__connect)
		{
			$this->__connect = new \PDO(
				$this->__dsn,
				$this->__dbConfig['db_user'],
				$this->__dbConfig['db_password'],
				array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
			);
		}
		
		return $this->__connect;
	}
	
	public function closeConnect()
	{
		$this->__pdoStatement = null;
		$this->__connect = null;
	}
	
	/**
	 * Method for custom user CUDR queries.
	 * Only SELECT requires fetchAll() to be used next.
	 *
	 * @param string $query
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
	
	/**
	 * @return array
	 */
	public function fetch()
	{
		return $this->__pdoStatement->fetch(\PDO::FETCH_ASSOC);
	}
	
	/**
	 * @return array
	 */
	public function fetchAll()
	{
		return $this->__pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	/**
	 * @return string
	 */
	public function fetchColumn()
	{
		return $this->__pdoStatement->fetchColumn();
	}
	
	/**
	 * @param $className
	 * @return mixed
	 */
	public function fetchObject($className)
	{
		return $this->__pdoStatement->fetchObject($className);
	}
	
	public function select($table, array $fields = [])
	{
		// TODO: implement method
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
	
	/**
	 * @param $table -- Название таблицы
	 * @param array $options -- Данные для обновления
	 */
	public function update($table, array $options = [])
	{
		// TODO: Implement update() method.
	}
	
	/**
	 * Нужно принимать $options в формате:
	 * [
	 *      'and' = ['key' => 'val', 'key1' => 'val1', 'key2' => 'val2'],
	 *      'or' = ['key' => 'val', 'key1' => 'val1', 'key2' => 'val2']
	 * ]
	 *
	 * @param array $options
	 * @return $this
	 */
	public function where(array $options)
	{
		$where = [];
		foreach ($options as $field => $option)
			$where[] = $field . ' = ' . $option;
		
		$this->__query .= ' WHERE ' . implode(' AND ');
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getLastInsertedId()
	{
		return $this->__connect->lastInsertId();
	}
	
	public function limit($count)
	{
		// TODO: Implement limit() method.
	}
	
	public function offset($count)
	{
		// TODO: Implement offset() method.
	}
	
	/**
	 * @param $query
	 * @param PdoStatementErrorInfo $info
	 */
	private function __log($query, PdoStatementErrorInfo $info)
	{
		Logger::dbLog($query, $info->getErrorMessage());
	}
}