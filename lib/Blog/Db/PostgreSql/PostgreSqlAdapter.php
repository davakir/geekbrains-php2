<?php

namespace Blog\Db\PostgreSql;

use Blog\Db\IDbAdapter;
use Blog\Db\DbConfiguration;

class PostgreSqlAdapter implements IDbAdapter
{
	/**
	 * Конфигуратор для подключения к БД
	 * @var
	 */
	protected $dbConfig;
	
	/**
	 * Database server name
	 * @var string
	 */
	protected $dsn;
	
	/**
	 * Объект PDO для соединения с БД
	 * @var
	 */
	protected $pdo;
	
	/**
	 * Функция считывает конфиг подключения к базе,
	 * формирует переменную dsn для последующего создания подключения к БД.
	 *
	 * PostgreSql constructor.
	 */
	public function __construct()
	{
		$this->dbConfig = (new DbConfiguration())->getConf('localhost');
		$this->dsn = $this->dbConfig['db_driver'] .
			':dbname=' . $this->dbConfig['db_name'] .
			';host=' . $this->dbConfig['db_host'] .
			';port=' . $this->dbConfig['db_port'];
	}
	
	/**
	 * Создает подключение к БД
	 *
	 * @return \PDO
	 */
	public function connect()
	{
		if (!$this->pdo)
		{
			$this->pdo = new \PDO(
					$this->dsn,
					$this->dbConfig['db_user'],
					$this->dbConfig['db_password']
			);
		}
		
		return $this->pdo;
	}
	
	public function closeConnect()
	{
		// TODO: Implement closeConnect() method.
	}
	
	public function select($table)
	{
		// TODO: Implement select() method.
	}
	
	public function insert($table, array $data)
	{
		// TODO: Implement insert() method.
	}
	
	public function update($table, array $options)
	{
		// TODO: Implement update() method.
	}
	
	public function where(array $options)
	{
		// TODO: Implement where() method.
	}
}