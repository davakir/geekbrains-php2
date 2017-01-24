<?php

namespace Controller;


use Blog\App\View;

/**
 * Class AbstractController
 * @package Controller
 */
abstract class AbstractController
{
	const POST_METHOD = 'post';
	const GET_METHOD = 'get';
	
	protected $_view;
	
	public function __construct()
	{
		$this->_view = new View();
	}
	
	protected function _redirect($string)
	{
		$location = 'Location: ' . $string;
		header($location, true, 302);
	}
}