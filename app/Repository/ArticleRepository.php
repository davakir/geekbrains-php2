<?php

namespace Repository;

use Blog\Db\IDbAdapter;
use Model\Articles\Article;

class ArticleRepository extends BaseRepository
{
	public function getArticleById ($id)
	{
		$this->_adapter->select('articles', ['id' => $id]);
	}
	
	public function getAllArticles()
	{
		$this->_adapter->select('articles', []);
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