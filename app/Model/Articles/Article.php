<?php

namespace Model\Articles;


class Article
{
	private $id;
	
	private $title;
	
	private $content;
	
	private $author;
	
	private $dateCreated;
	
	private $previewText;
	
	private $previewLength = 256;
	
	public function __construct(array $data)
	{
		$this->setContent($data['content']);
		$this->setTitle($data['title']);
		$this->setAuthor($data['author']);
		$this->previewText = substr($this->content, 0, $this->previewLength);
	}
	
	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @param mixed $title
	 */
	private function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * @return mixed
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * @param mixed $content
	 */
	private function setContent($content)
	{
		$this->content = $content;
	}
	
	/**
	 * @return mixed
	 */
	public function getAuthor()
	{
		return $this->author;
	}
	
	/**
	 * @param mixed $author
	 */
	public function setAuthor($author)
	{
		$this->author = $author;
	}
	
	/**
	 * @return mixed
	 */
	public function getDateCreated()
	{
		return $this->dateCreated;
	}
	
	/**
	 * @param mixed $dateCreated
	 */
	private function setDateCreated($dateCreated)
	{
		$this->dateCreated = $dateCreated;
	}
}