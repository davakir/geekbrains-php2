<?php

namespace Repository;

use Blog\Db\IDbAdapter;

abstract class BaseRepository
{
	/**
	 * @var IDbAdapter
	 */
	protected $_adapter;
	
	/**
	 * @param IDbAdapter $adapter
	 */
	public function __construct(IDbAdapter $adapter)
	{
		$this->_adapter = $adapter;
	}
}