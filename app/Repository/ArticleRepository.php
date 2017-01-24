<?php

namespace Repository;

use Model\Articles\Article;

class ArticleRepository extends BaseRepository
{
	public function getArticleById ($id)
	{
		return $this->_adapter->query(
			'SELECT * from articles WHERE id = ?',
			[$id]
		)->fetch();
	}
	
	public  function getAllArticles()
	{
		return $this->_adapter->query(
			'SELECT * FROM articles'
		)->fetchAll();
	}
	
	public function saveArticle(Article $data)
	{
		return $this->_adapter->insert('articles', [
			'title' => $data->getTitle(),
			'content' => $data->getContent(),
			'author' => $data->getAuthor()
		]);
	}
}