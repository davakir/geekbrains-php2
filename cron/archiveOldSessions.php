<?php
/**
 * Крон-скрипт, удаляющий информацию о старых сессиях.
 * Срок хранения сессий указан в классе авторизации.
 */

include __DIR__ . './../autoload.php';

use Blog\Auth;
use Blog\ServiceManager\DbAdapterManager;

function deleteOldSessions ()
{
	$dbAdapter = DbAdapterManager::getDbAdapter();
	$date = date('Y-m-d H:i:s', time() - Auth::$cookieLiveTime);
	
	$dbAdapter->query(
		'DELETE FROM sessions WHERE date_created < ?',
		[$date]
	);
};

deleteOldSessions();