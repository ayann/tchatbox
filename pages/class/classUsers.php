<?php  
	class Users
	{
		private $email;
		private $pseudo;
		private $mp;
		private $photo;
		
		function __construct($e='',$p='',$m='',$ph='')
		{
			$this->email  =$e;
			$this->pseudo =$p;
			$this->mp     =md5($m);
			$this->photo  =$ph;
		}
		public function create($db)
		{
			$var = array(
				'email'  => $this->email,
				'pseudo' => $this->pseudo,
				'mp'     => $this->mp
			);
			
			$req = $db->prepare("INSERT INTO users (email, pseudo, mp) 
								VALUES (:email, :pseudo, :mp)");
			if ($req->execute($var)) {
				$id=$db->lastInsertId();
				if(!empty($this->photo['name'])){
					$name=injection(strtolower(basename($this->photo['name'])));
					$verif= getimagesize($this->photo['tmp_name']);
					$racine=$_SERVER['DOCUMENT_ROOT'].'/';

					if ($verif && $verif[2] < 4){
						
						require 'crope.php';
						
						if(!is_dir($racine.'discussion_instantanee/pages/photos/'.$id)){
							mkdir ($racine.'discussion_instantanee/pages/photos/'.$id, 0700,true);
						}
						move_uploaded_file($this->photo['tmp_name'],$racine.'discussion_instantanee/pages/photos/'.$id.'/'.$name);
			
						$img=$racine.'discussion_instantanee/pages/photos/'.$id.'/'.$name;
						crop($img,$img,'171');

						$name=$db->quote($name);

						$query  =  "INSERT INTO photos(name, id_users)
								    VALUES ($name,$id)";
					    $query_maj =  "UPDATE photos
					                SET active=0
					    			WHERE id_users=$id";
						$resul=$db->exec($query_maj);
						$resul=$db->exec($query);
						if($resul==0){
							unlink($img);
							$_SESSION['error']="Erreur lors du telechargement de l'image";
							header('location:/discussion_instantanee');
							die();
						}
					}else{
						$_SESSION['error']="Le format de l'image n'est pris en charge";
						header('location:/discussion_instantanee');
						die();
					} 
				}
				$_SESSION['success']="Inscription reussie ! Veillez vous connecter";
				header('location:/discussion_instantanee');
				die();
			}else{
				$_SESSION['error']="Erreur lors de l'inscription ! Veillez réessayer";
				header('location:/discussion_instantanee');
				die();
			}
		}
		public function login($db,$post)
		{
			extract($post);
			if($email && $mp){

				$var = array(
					'email'  => injection($email),
					'mp'     => md5($mp)
				);
				
				$req = $db->prepare("SELECT * FROM users 
									WHERE email=:email AND mp=:mp");
				$req->execute($var);
				$nr=$req->rowCount();
				if ($nr>0) {
					$data=$req->fetch(PDO::FETCH_ASSOC);
					extract($data);
					$_SESSION['id']=$id;
					$_SESSION['email']=$email;
					$_SESSION['pseudo']=$pseudo;
				    $query = "UPDATE users
				                SET sign_in=1,date_connect=current_timestamp
				    			WHERE id=$id";
					$resul=$db->exec($query);
					$resul=NULL;
					header('location:/discussion_instantanee/pages/message.php');
					die();
				}else{
					$req=NULL;
					$_SESSION['error']='ERREUR !!! Identifiant ou Mot de passe incorrect';
					header('location:/discussion_instantanee');
					die();
				}
			}else{
				$_SESSION['error']="ERREUR !!! Veuillez remplir tous les champs";
				header('location:/discussion_instantanee');
			}
		}
	}