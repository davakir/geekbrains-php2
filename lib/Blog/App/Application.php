<?php

namespace Blog\App;
use Blog\Auth;
use Layout\ILayout;
use Model\CurrentUser;
use Repository\SessionRepository;

/**
 * Main application class that provides opportunities
 * for working with controllers.
 *
 * Class Application
 * @package Blog\App
 */
class Application
{
	private $__handlers = [];
	
	public function get($route, $handler)
	{
		$this->__append('GET', $route, $handler);
	}
	
	public function post($route, $handler)
	{
		$this->__append('POST', $route, $handler);
	}
	
	public function run(ILayout $layout)
	{
		$uri = $_SERVER['REQUEST_URI'];
		$method = $_SERVER['REQUEST_METHOD'];
		
		foreach ($this->__handlers as $item)
		{
			list($route, $handlerMethod, $handler) = $item;
			
			if ($method == $handlerMethod && preg_match("/^$route$/i", $uri))
			{
				/* Получаем информацию об авторизованном пользователе */
				list($user, $session) = (new Auth())->getAuthInfo();
				/* Инициализируем текущего пользователя, если есть кого */
				if (!empty($user))
					(new CurrentUser())->initCurrentUser($user);
				
				/*
				 * Обновляем время последнего действия пользователя
				 * (для дальнейшего определения его статуса активности на сайте).
				 * До тех пор, пока польз-ль что-то делает, он активен.
				 */
				if (!empty($session))
				{
					$sessionRep = new SessionRepository();
					$sessionRep->updateLastActivityTime($session['sid'], date('Y-m-d H:i:s'));
				}

				$layout->drawLayout(array_merge(
					$handler(),
					['user' => $user]
				));
			}
		}
	}
	
	private function __append($method, $route, $handler)
	{
		$this->__handlers[] = [$route, $method, $handler];
	}
}