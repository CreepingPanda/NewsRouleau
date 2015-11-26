<?php

class User
{


// ________ PROPRIETES ________
	private $id;
	private $login;
	private $password;
// ________________


// ________ GETTERS ________
	public function getId()
	{
		return $this->id;
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getHash()
	{
		return $this->password;
	}
// ________________


// ________ SETTERS ________
	public function setLogin($login)
	{
		if ( strlen($login) > 0 && strlen($login) <= 16 )
		{
			$this->login = $login;
			return true;
		}
		else
		{
			return "Entre 1 et 16 caractères.";
		}
	}
	public function setPassword($password)
	{
		if ( strlen($password) >= 6 && strlen($password) <= 512 )
		{
			$hash = password_hash($password, PASSWORD_BCRYPT, array("cost"=>10));
			$this->password = $hash;
			return true;
		}
		else
		{
			return "Entre 6 et 512 caractères";
		}
	}
	public function checkPassword($password)
	{
		return (password_verify($pass, $this->password));
	}
// ________________


}

?>