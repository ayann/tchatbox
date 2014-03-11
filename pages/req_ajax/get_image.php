<?php 
	if (isset($_POST)) {
		extract($_POST);
		if ($id_em AND $id_rec) {
			require '../class/db.php';
			session_start();
			$_SESSION['image_rec']='';
			$var = array(
				'id_em'  => (int) $id_em,
				'id_rec' => (int) $id_rec
			);
			
			$sql = $DB->prepare("SELECT * FROM photos WHERE (id=:id_em or id=:id_rec) and active=1");
			$sql->execute($var);
			$nr=$sql->rowCount();
			if ($nr>0) {
				while ( $data=$sql->fetch(PDO::FETCH_ASSOC)) {
					extract($data);
					if ($id_users==$id_em) {
						$_SESSION['image_em']=$name;
					}else{
						$_SESSION['image_rec']=$name;
					}
				}
				echo $_SESSION['image_rec'];
			}
		}
	}
?>