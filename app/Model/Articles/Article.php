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
		if (!empty($data['id'])) $this->setId($data['id']);
		$this->setContent($data['content']);
		$this->setTitle($data['title']);
		$this->setAuthor($data['author']);
		$this->setPreviewText();
	}
	
	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param $id
	 */
	public function setId($id)
	{
		$this->id = $id;
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
	 * @return string
	 */
	public function getPreviewText()
	{
		return $this->previewText;
	}

	public function setPreviewText()
	{
		$this->previewText = mb_substr($this->content, 0, $this->previewLength);
	}
}