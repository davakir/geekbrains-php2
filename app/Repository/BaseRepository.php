<?php

namespace Repository;

use Blog\Db\IDbAdapter;
use Blog\ServiceManager\DbAdapterManager;

abstract class BaseRepository
{
	/**
	 * @var IDbAdapter
	 */
	protected $_adapter;
	
	public function __construct()
	{
		$this->_adapter = DbAdapterManager::getDbAdapter();
	}
}