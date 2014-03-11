<?php
	session_start();
	require 'requires/is_log.php';
	notlog();
	loged();
	require 'class/db.php';
	require 'class/classUsers.php';
	$user=new Users();
	$user->login($DB,$_POST);
?>