<?php

namespace Blog\Db;

/**
 * Класс, описывающий способы получения конфигураций баз данных.
 *
 * Class DbConfiguration
 * @package Blog\Db
 */
class DbConfiguration
{
	/**
	 * Место расположения конфигураций доступов к базам данных.
	 *
	 * @var string
	 */
	private static $__pathToConfig = APP_PATH . 'config/';
	
	/**
	 * Метод возвращает параметры доступа к БД.
	 *
	 * @param $server
	 * @return array
	 */
	public static function getConf($server)
	{
		return parse_ini_file(self::$__pathToConfig . $server . '/conf.ini');
	}
}
