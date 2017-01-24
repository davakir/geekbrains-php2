<?php

namespace Blog\App;
use Blog\Auth;
use Layout\ILayout;
use Layout\Main;
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
			$preparedRoute = preg_quote($route, '/');
			
			if ($method == $handlerMethod && preg_match("/^$preparedRoute$/i", $uri))
			{
				/* Получаем информацию об авторизованном пользователе */
				list($user, $session) = (new Auth())->getAuthInfo();
				
				/*
				 * Обновляем время последнего действия пользователя
				 * (для дальнейшего определения его статус активности на сайте).
				 * До тех пор, пока польз-ль что-то делает, он активен.
				 */
				$sessionRep = new SessionRepository();
				$sessionRep->updateLastActivityTime($session['sid'], date('Y-m-d H:i:s'));

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