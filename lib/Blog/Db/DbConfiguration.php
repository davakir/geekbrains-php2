<?php

namespace Blog\Db;

class DbConfiguration
{
	public function getConf($server)
	{
		return parse_ini_file($server . '/conf.ini');
	}
}
