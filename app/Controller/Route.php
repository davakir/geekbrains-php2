<?php

namespace Controller;

use Blog\App\View;
use Blog\Auth;
use Blog\Db\MySql\MySqlAdapter;
use Model\Articles\Article;
use Repository\ArticleRepository;

class Route
{
	const POST_METHOD = 'post';
	const GET_METHOD = 'get';
	
	private $__view;
	
	public function __construct()
	{
		$this->__view = new View();
	}
	
	public function index()
	{
		return $this->__view->render('index');
	}
	
	public function about()
	{
		return $this->__view->render('about');
	}
	
	public function createArticle()
	{
		return $this->__view->render('new-article');
	}
	
	public function doCreateArticle()
	{
		$this->__saveArticle($_POST);
		
		return $this->__redirect('/');
	}
	
	public function login()
	{
		return $this->__view->render('auth');
	}
	
	public function doLogin()
	{
		$login = $_POST['login'];
		$pass = $_POST['password'];
		
		$result = (new Auth())->auth($login, $pass);
		
		if ($result)
		{
			return $this->__redirect('/');
		}
		else
		{
			return $this->__view->render('auth', ['login' => $login, 'error' => 'Неверный логин или пароль']);
		}
	}
	
	private function __saveArticle(array $data)
	{
		$title = $data['title'];
		$content = $data['content'];
		$author = 0;
		
		$article = new Article([
			'title' => $title,
			'content' => $content,
			'author' => $author
		]);
		
		(new ArticleRepository(new MySqlAdapter()))
			->saveArticle($article);
	}
	
	private function __redirect($string)
	{
		$location = 'Location: ' . $string;
		header($location, true, 302);
//		exit();
	}
}