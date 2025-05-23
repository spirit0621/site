<?php
	try{
		$user = "root";
		$pass = "";
		$bdd = new PDO('mysql:host=localhost;dbname=recrute_DB', $user, $pass);
		
	}catch(PDOException $e){
		print "Erreur! :" . $e->getMessage() .
		"<br/>";
		die();
	}




?>