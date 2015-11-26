<?php

class Article
{


// ________ PROPRIETES ________
	private $id;
	private $id_user;
	private $title;
	private $content;
	private $date;
// ________________


// ________ GETTERS ________
	public function getId()
	{
		return $this->id;
	}
	public function getAuthor()
	{
		return $this->id_user;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function getDate()
	{
		return $this->date;
	}
// ________________


// ________ SETTERS ________
	public function setAuthor(User $user)
	{
		$this->id_user = $user->getId();
		return true;
	}
	public function setTitle($title)
	{
		if ( strlen($title) >= 4 && strlen($title) <= 64 )
		{
			$this->title = $title;
			return true;
		}
		else
		{
			return "Le titre doit comporter entre 4 et 64 caractères.";
		}
	}
	public function setContent($content)
	{
		if ( strlen($content) >= 12 && strlen($content) <= 2048 )
		{
			$this->content = $content;
			return true;
		}
		else
		{
			return "L'article doit comporter entre 12 et 2048 caractères.";
		}
	}
// ________________


}

?>