<? php

class ArticleManager
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
	public function create($title, $content)
	{
		$article = new Article();

		$set = $article->setTitle($title);
		if ( $set === true )
		{
			$set = $article ->setContent($content);
			if ( $set === true )
			{
				$set = $article->setAuthor($currentUser->getId());
				if ( $set === true )
				{
					$id_user = intval($user->getAuthor);
					$title = mysqli_real_escape_string($this->database, $article->getTitle());
					$content = mysqli_real_escape_string($this->database, $article->getContent());

					$query = "INSERT INTO article (id_user, title, content) VALUES ('".$id_user."', '".$title."', '".$content."')";

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
		else
		{
			return $set;
		}
	}
	public function update($title, $content)
	{


	}
	public function findById($id)
	{
		$id = intval($id);

		$query = "SELECT * FROM article WHERE id = '".$id."'";

		$result = mysqli_query($this->database, $query);
		if ( $result )
		{
			$article = mysqli_fetch_object($result, "Article");
			if ( $article )
			{
				return $article;
			}
			else
			{
				return "Article introuvable.";
			}
		}
		else
		{
			return mysqli_error();
		}
	}
	public function findByTitle($title)
	{
		$title = mysqli_real_escape_string($title);

		$query = "SELECT * FROM article WHERE title = '".$title."'";

		$result = mysqli_query($this->database, $query);
		if ( $result )
		{
			$article = mysqli_fetch_object($result, "Article");
			if ( $article )
			{
				return $article;
			}
			else
			{
				return "Article introuvable";
			}
		}
		else
		{
			return mysqli_error();
		}
	}
	public function getLastOnes()
	{

	}
// ________________


}

?>