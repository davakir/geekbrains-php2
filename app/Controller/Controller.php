<?php

namespace Controller;

use Blog\Rights;
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
		$articles = [];
		foreach ((new ArticleRepository())->getAllArticles() as $rawArticle)
		{
			$articles[] = new Article($rawArticle);
		}
		
		$permissions = [];
		
		if (CurrentUser::getInstance())
			$permissions = (new RightsRepository())->getRoleOperations(
				(CurrentUser::getInstance())->getRoleId()
			);
		
		return [
			'content' => $this->_view->render('articles', [
				'articles' => $articles,
				'canDelete' => Rights::hasPermission(Rights::DELETE_ARTICLE, $permissions),
				'canEdit' => Rights::hasPermission(Rights::EDIT_ARTICLE, $permissions)
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
			'content' => $this->_view->render('article-create'),
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
	
	public function deleteArticle()
	{
		$articleId = $_POST['article'];
		(new ArticleRepository())->deleteArticle($articleId);
		$this->_redirect('/articles');
	}
	
	public function editArticle()
	{
		return [
			'content' => $this->_view->render('article-edit', [
				'article' => (new ArticleRepository())->getArticleById($_GET['article'])
			]),
			'title' => 'Редактирование статьи'
		];
	}
	
	public function updateArticle()
	{
		$this->__updateArticle($_POST);
		
		$this->_redirect('/articles');
	}
	
	private function __saveArticle(array $data)
	{
		(new ArticleRepository())->saveArticle(
			new Article([
				'title' => $data['title'],
				'content' => $data['content'],
				'author' => CurrentUser::getInstance()->getId()
			])
		);
	}
	
	private function __updateArticle(array $data)
	{
		(new ArticleRepository())->updateArticle(
			new Article([
				'id' => $data['article'],
				'title' => $data['title'],
				'content' => $data['content']
			])
		);
	}
}