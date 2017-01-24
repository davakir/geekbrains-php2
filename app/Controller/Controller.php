<?php

namespace Controller;

use Blog\Auth;
use Model\Articles\Article;
use Model\User\User;
use Repository\ArticleRepository;
use Repository\UserRepository;

/**
 * Class Controller
 * @package Controller
 */
class Controller extends AbstractController
{
	/**
	 * @Route ("/" || "/home")
	 * @return array
	 */
	public function index()
	{
		return [
			'content' => $this->_view->render('index'),
			'title' => 'Главная страница'
		];
	}
	
	/**
	 * @Route ("/articles")
	 * @return array
	 */
	public function articles()
	{
		$articles = (new ArticleRepository())->getAllArticles();
		
		return [
			'content' => $this->_view->render('articles', [
				'articles' => $articles
			]),
			'title' => 'Статьи'
		];
	}
	
	/**
	 * @Route ("/gallery")
	 * @return array
	 */
	public function gallery()
	{
		return [
			'content' => $this->_view->render('gallery'),
			'title' => 'Галерея'
		];
	}
	
	/**
	 * @Route ("/contacts")
	 * @return array
	 */
	public function contacts()
	{
		return [
			'content' => $this->_view->render('contacts'),
			'title' => 'Мои контакты'
		];
	}
	
	/**
	 * @Route ("/register")
	 * @return array
	 */
	public function register()
	{
		return [
			'content' => $this->_view->render('registration'),
			'title' => 'Регистрация'
		];
	}
	
	/**
	 * @Route ("/login")
	 * @return array
	 */
	public function login()
	{
		return [
			'content' => $this->_view->render('auth'),
			'title' => 'Авторизация'
		];
	}
	
	/**
	 * @Route ("/article/create")
	 * @return array
	 */
	public function createArticle()
	{
		return [
			'content' => $this->_view->render('new-article'),
			'title' => 'Создание статьи'
		];
	}
	
	/**
	 * Обрабатывает POST запрос.
	 * Перенаправляет пользователя на страницу всех статей.
	 */
	public function doCreateArticle()
	{
		$this->__saveArticle($_POST);
		
		return $this->_redirect('/articles');
	}
	
	/**
	 * Обрабатывает POST запрос.
	 * Если пользователя удалось авторизовать, то перенаправляем его на главную страницу,
	 * иначе возвращаем на страницу авторизации с выводом возникших ошибок.
	 *
	 * @return array|void
	 */
	public function doLogin()
	{
		$login = $_POST['login'];
		$pass = $_POST['password'];
		$remember = $_POST['remember'];
		
		$result = (new Auth())->login($login, $pass, $remember);
		
		if ($result)
		{
			$this->_redirect('/');
		}
		else
		{
			return [
				'content' => $this->_view->render('auth', ['errors' => 'Неверный логин или пароль']),
				'title' => 'Авторизация'
			];
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
		
		(new ArticleRepository())->saveArticle($article);
	}
}