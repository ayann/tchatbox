<?php 
	function notlog()
	{
		if (!isset($_SESSION['pseudo'])) {
			$_SESSION['error']="Veillez vous connecter !";
			header('location:/discussion_instantanee');
			die();
		}
	}	
	function loged()
	{
		if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) {
			header('location:/discussion_instantanee/pages/message.php');
			die();
		}
	}
?>