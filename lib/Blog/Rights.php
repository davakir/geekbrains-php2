<?php

namespace Blog;


class Rights
{
	const CREATE_ARTICLE = 'create_article';
	const EDIT_ARTICLE = 'edit_article';
	const DELETE_ARTICLE = 'delete_article';
	
	const DELETE_USER = 'delete_user';
	const CHANGE_USER_RIGHTS = 'change_user_rights';
	
	/**
	 * Проверяет наличие доступа к конкретному праву.
	 *
	 * @param $right
	 * @param array $permissions
	 * @return bool
	 */
	public static function hasPermission($right, array $permissions)
	{
		return in_array($right, $permissions);
	}
}