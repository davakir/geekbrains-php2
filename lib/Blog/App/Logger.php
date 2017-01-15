<?php

namespace Blog\App;


class Logger
{
	private static $__logsPath = APP_PATH . '../log/';
	
	private static $__logFile = 'logger.txt';
	
	/**
	 * Логируем действия с базой.
	 *
	 * @param $query string
	 * @param $error string
	 */
	public static function dbLog($query, $error)
	{
		if (!file_exists(self::$__logsPath))
			mkdir(self::$__logsPath, 0777, true);
		
		if (!file_exists(self::$__logsPath . self::$__logFile))
			touch(self::$__logsPath . self::$__logFile);
		
		$handler = fopen(self::$__logsPath . self::$__logFile, 'a');
		fwrite($handler, "query: $query\nerror: $error \n");
		fclose($handler);
	}
}