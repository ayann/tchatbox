<?php 
	session_start();
	require 'requires/is_log.php';
	notlog();
	if(isset($_SESSION['pseudo']))
	{
		require 'class/db.php';
		$pseudo=$DB->quote(injection($_SESSION['pseudo']));
	    $query = "UPDATE users
	              SET sign_in=0
	    		  WHERE pseudo=$pseudo";
		$resul=$DB->exec($query);
		if ($resul>0) {
			session_destroy();
			session_start();
			$_SESSION['success']='Vous êtes déconnecté';
			header('Location:/discussion_instantanee');
			die();
		}else{
			$_SESSION['error']='Une erreur s\'est produite lors de la deconnection !!!';
			header('Location:/discussion_instantanee/pages/message.php');
			die();
		}
	}
	else{
		$_SESSION['error']='Veillez vous connecter !!!';
		header('location:/discussion_instantanee');
	}
?>