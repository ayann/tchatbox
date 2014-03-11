<?php
	if (isset($_POST)) {
		extract($_POST);
		if ($id_em AND $id_rec AND $msg) {
			require '../class/classMessages.php';
			require '../class/db.php';
			$msg=new Messages($id_em , $id_rec , $msg);
			$msg->send($DB);
		}
	}
?>