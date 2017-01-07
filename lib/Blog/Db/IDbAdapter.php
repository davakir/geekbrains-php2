<?php

namespace Blog\Db;

interface IDbAdapter
{
	public function __construct();
	
	public function connect();
	
	public function closeConnect();
}
