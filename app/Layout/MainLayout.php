<?php

namespace Layout;


use Blog\App\View;

class MainLayout implements ILayout
{
	private $__template = 'base';
	
	public function drawLayout(array $params)
	{
		$view = new View();
		
		echo $view->render($this->__template, $params);
	}
}