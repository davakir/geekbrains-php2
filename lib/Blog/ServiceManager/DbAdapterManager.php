<?php

namespace Blog\ServiceManager;


use Blog\Db\MySql\MySqlAdapter;

/**
 * Сервис менеджер для получения экземпляра адаптера к БД,
 * который должен использоваться во всем проекте.
 *
 * Class DbAdapterManager
 * @package Blog\ServiceManager
 */
class DbAdapterManager
{
	private static $dbAdapter;
	
	private function __construct() {}
	
	private function __clone() {}
	
	private function __wakeUp() {}
	
	public static function getDbAdapter()
	{
		if (empty(self::$dbAdapter))
		{
			self::$dbAdapter = new MySqlAdapter();
		}
		
		return self::$dbAdapter;
	}
}