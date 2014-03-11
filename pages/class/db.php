<?php
	try {
	 	$DB = new PDO("mysql:host=mysql.hostinger.fr;dbname=u848926948_tchat", "u848926948_tchat", "bdd-Hostinger");
	 	$DB->exec("SET CHARACTER SET utf8");
	 	$DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
	  	die("Probleme : " . $e->getMessage());
	}
	
	function injection($var)
	{
		return htmlspecialchars(trim($var));
	}
	

