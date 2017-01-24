<?php

namespace Repository\Articles;


use Model\Articles\Article;

class ArticleListRepository
{
	protected $articleList = [];
	
	/**
	 * @return array
	 */
	public function getArticleList()
	{
		return $this->articleList;
	}
	
	/**
	 * @param Article $article
	 * @return $this
	 */
	public function add(Article $article)
	{
		array_push($this->articleList, $article);
		return $this;
	}
	
	/**
	 * @param int $id
	 */
	public function delete($id)
	{
		foreach ($this->articleList as $index => $value)
		{
			if ($id == $value->getId())
			{
				unset($this->articleList[$index]);
				return;
			}
		}
	}
}