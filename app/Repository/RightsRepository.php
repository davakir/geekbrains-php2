<?php

namespace Repository;


class RightsRepository extends BaseRepository
{
	/**
	 * @param int $roleId
	 * @return array
	 */
	public function getRoleOperations($roleId)
	{
		$operations = $this->_adapter->query(
			'SELECT * FROM operations WHERE id IN(SELECT operation_id FROM role_operations WHERE role_id = ?)',
			[$roleId]
		)->fetchAll();
		
		$result = [];
		foreach ($operations as $o)
		{
			$result[] = $o['name'];
		}
		return $result;
	}
	
	/**
	 * @return array
	 */
	public function getAllRoles()
	{
		return $this->_adapter->query(
			'SELECT * FROM roles'
		)->fetchAll();
	}
}