<?php 
	require '../class/classMessages.php';
	require '../class/db.php';
	$msg=new Messages();
	$msg->get($_POST,$DB);
?>