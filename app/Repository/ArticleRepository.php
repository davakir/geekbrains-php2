<?php

namespace Repository;

use Model\Articles\Article;

class ArticleRepository extends BaseRepository
{
	/**
	 * @param $id
	 * @return mixed
	 */
	public function getArticleById ($id)
	{
		return $this->_adapter->query(
			'SELECT * from articles WHERE id = ?',
			[$id]
		)->fetch();
	}
	
	/**
	 * @return mixed
	 */
	public  function getAllArticles()
	{
		return $this->_adapter->query(
			'SELECT * FROM articles'
		)->fetchAll();
	}
	
	/**
	 * @param Article $data
	 * @return bool
	 */
	public function saveArticle(Article $data)
	{
		return $this->_adapter->insert('articles', [
			'title' => $data->getTitle(),
			'content' => $data->getContent(),
			'author' => $data->getAuthor()
		]);
	}
	
	public function updateArticle(Article $data)
	{
		$this->_adapter->query(
			'UPDATE articles SET title = ?, content = ? WHERE id = ?',
			[
				$data->getTitle(), $data->getContent(), $data->getId()
			]
		);
	}
	
	/**
	 * @param integer $id
	 * @return mixed
	 */
	public function deleteArticle($id)
	{
		return $this->_adapter->query(
			'DELETE FROM articles WHERE id = ?',
			[$id]
		);
	}
}