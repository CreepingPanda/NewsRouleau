<?php


// _________ TOOLS ________
	session_start();

	$database = mysqli_connect('192.168.1.97', 'chien', 'chien', 'news_rouleau');
	if ($database === false)
		die(mysqli_connect_error());

	spl_autoload_register(function ($class)
	{
		require('models/'.$class.'.class.php');
	});

	if ( isset($_SESSION['id']) )
	{
		$userManager = new UserManager($database);
		$currentUser = $userManager->getCurrent();
	}

// ________ HUB ________
	$chemins = array('login', 'register', 'articles', 'article', 'create_article', 'edit_article');
	$traitements = array('login'=>'user', 'register'=>'user', 'create_article'=>'post', 'edit_article'=>'post');

	$page = 'articles';
	$errors = array();

	if ( isset($_GET['page']) )
	{
		if ( isset($traitements[$_GET['page']]) )
		{
			require('apps/traitement_'.$traitements[$_GET['page']].'.php');
		}
		else if ( in_array($_GET['page'], $traitements) )
		{
			require('apps/traitement_'.$_GET['page'].'.php');
		}
		if ( in_array($_GET['page'], $chemins) )
		{
			$page = $_GET['page'];
		}
	}

	require ('apps/skel.php');


?>