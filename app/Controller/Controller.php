<?php

namespace Controller;

use Model\Articles\Article;
use Model\CurrentUser;
use Repository\ArticleRepository;
use Repository\RightsRepository;

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
		$permissions = [];
		
		if (CurrentUser::getInstance())
			$permissions = (new RightsRepository())->getRoleOperations(
				(CurrentUser::getInstance())->getRoleId()
			);
		
		return [
			'content' => $this->_view->render('articles', [
				'articles' => $articles,
				'permissions' => $permissions
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
		
		$this->_redirect('/articles');
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