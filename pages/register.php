<?php  
	session_start();
	require 'requires/is_log.php';
	notlog();
	loged();
	require 'class/db.php';
	require 'class/classUsers.php';
	if (isset($_POST['email'])) {
		extract($_POST);
		if ($email && $pseudo && $mp && $cmp) {
			if ($mp!=$cmp) {
				header('location:/discussion_instantanee');
				$_SESSION['error']="Erreur !!! Mot de passe non identique";
				die();
			} else {
				$cemail=$DB->quote(injection($email));
				$query="SELECT id FROM users WHERE email=$cemail";
				$res=$DB->query($query);
				$nb=$res->rowCount();
				if ($nb>0) {
					$_SESSION['error']="Ce email existe déjà !!!";
					header('location:/discussion_instantanee');
					die();
				}else{
					$res=null;
					$cpseudo=$DB->quote(injection($pseudo));
					$query="SELECT id FROM users WHERE pseudo=$cpseudo";
					$res=$DB->query($query);
					$nb=$res->rowCount();
					if ($nb>0) {
						$_SESSION['error']="Ce pseudo existe déjà !!!";
						header('location:/discussion_instantanee');
						die();
					}else{
						$user=new Users(injection($email),injection($pseudo),$mp,$_FILES['photo']);
						$user->create($DB);
					}
				}
			}
		}
	}else{
		$_SESSION['error']="ERREUR !!! Veillez remplir le formulaire d'inscription";
		header('location:/discussion_instantanee');
		die();
	}
?>