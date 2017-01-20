<?php

namespace Blog\App;


class View
{
	private $__viewsPath;
	
	private $__title;
	
	public function __construct()
	{
		$this->__viewsPath = dirname(__FILE__, 4) . '/app/views/';
	}
	
	public function render($template, array $params = [])
	{
		extract($params);
		ob_start();
		include $this->__findTemplate($template);
		return ob_get_clean();
	}
	
	public function setTitle($title)
	{
		$this->__title = $title;
	}
	
	public function getTitle()
	{
		return $this->__title;
	}
	
	private function __findTemplate($template)
	{
		$files = scandir($this->__viewsPath);
		foreach ($files as $file)
		{
			preg_match("/$template/", $file, $matches);
			
			if (!empty($matches))
			{
				$template = $this->__viewsPath . DIRECTORY_SEPARATOR . $file;
				break;
			}
		}
		
		return $template;
	}
}