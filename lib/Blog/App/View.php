<?php

namespace Blog\App;


class View
{
	private $__viewsPath;
	
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