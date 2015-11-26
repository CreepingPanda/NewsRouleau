<?php

class UserManager
{


// ________ PROPRIETES ________
	private $database;
// ________________


// ________ CONSTRUCT ________
	public function __construct($database)
	{
		$this->database = $database;
	}
// ________________


// ________ METHODES ________
	public function create($login, $password)
	{
		$user = new User();
		$set = $user->setLogin($login);

		if ( $set === true )
		{
			$set = $user->setPassword($password);
			if ( $set === true )
			{
				$login = mysqli_real_escape_string($this->database, $user->getLogin());
				$password = mysqli_real_escape_string($this->database, $user->getHash());
				
				$query = "INSERT INTO user (login, password) VALUES ('".$login."', '".$password."')";
				
				$result = mysqli_query($this->database, $query);
				if ( $result )
				{
					$id = mysqli_insert_id($this->database);
					if ( $id )
					{
						return $this->findById($id);
					}
					else
					{
						return "Erreur serveur.";
					}
				}
				else
				{
					return mysqli_error();
				}
			}
			else
			{
				return $set;
			}
		}
		else
		{
			return $set;
		}
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id = '".$id."'";
		
		$result = mysqli_query($this->database, $query);
		if ( $result )
		{
			$user = mysqli_fetch_object($result, "User");
			if ( $user )
			{
				return $user;
			}
			else
			{
				return "Utilisateur introuvable.";
			}
		}
	}
	public function findByLogin($login)
	{
		if ( strlen(trim($login)) > 0 )
		{
			$login = mysqli_real_escape_string($this->database, $login);

			$query = "SELECT * FROM user WHERE login = '".$login."'";

			$result = mysqli_query($this->database, $query);
			if ( $result )
			{
				$user = mysqli_fetch_object($result, "User");
				return $user;
			}
			else
			{
				return "Erreur serveur.";
			}
		}
		else
		{
			return "Vous cherchez qui ?";
		}
	}
	public function getCurrent()
	{
		if ( isset($_SESSION['id']) )
		{
			$query = "SELECT * FROM user WHERE id = '".$_SESSION['id']."'";

			$result = mysqli_query($this->database, $query);
			if ( $result )
			{
				$user = mysqli_fetch_object($result, "User");
				if ( $user )
				{
					return $user;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
// ________________


}

?>