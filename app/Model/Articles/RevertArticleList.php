<?php

namespace Model\Articles;


class RevertArticleList extends ArticleList
{
	/**
	 * @return array
	 */
	public function getArticlesList()
	{
		return array_reverse($this->articleList);
	}
}