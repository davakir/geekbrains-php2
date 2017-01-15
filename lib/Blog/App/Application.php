<?php

namespace Blog\App;

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
		$this->append('GET', $route, $handler);
	}
	
	public function post($route, $handler)
	{
		$this->append('POST', $route, $handler);
	}
	
	public function run()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$method = $_SERVER['REQUEST_METHOD'];
		
		foreach ($this->__handlers as $item)
		{
			list($route, $handlerMethod, $handler) = $item;
			$preparedRoute = preg_quote($route, '/');
			
			if ($method == $handlerMethod && preg_match("/^$preparedRoute$/i", $uri))
			{
				echo $handler();
			}
		}
	}
	
	private function append($method, $route, $handler)
	{
		$this->__handlers[] = [$route, $method, $handler];
	}
}