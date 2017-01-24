<?php

namespace Blog\Db;

/**
 * Interface for all db adapters.
 * These methods are easy and simple way to contribute with DB.
 * Here is basic set of methods, any other methods will be a part of
 * specific realization.
 *
 * Interface IDbAdapter
 * @package Blog\Db
 */
interface IDbAdapter
{
	public function connect();
	
	public function closeConnect();
	
	public function query($query, $bindParams = []);
	
	public function fetch();
	
	public function fetchColumn();
	
	public function fetchObject($className);
	
	public function select($table, array $fields = []);
	
	public function insert($table, array $data);
	
	public function update($table, array $data = []);
	
	public function where(array $options);
	
	public function limit($count);
	
	public function offset($count);
}
