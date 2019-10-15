<?php
	
	$hote = '10.1.3.252';
	$utilisateur = 'compte_application'; //identifiant de connexion à la base de données
	$mdp = 'application';   			  //mot de passe de l'identifiant
	$nombdd = 'bd_gesoraux'; 			//nom de la base de données
	try{	
	$bdd = new PDO("mysql:host=$hote;dbname=$nombdd; charset=utf8", $utilisateur, $mdp);
	// mode de fetch :   FETCH_OBJ	
		$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$bdd->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo("Err BDAcc01Erreur : erreur de connexion dans dans la base de données<br>Message d'erreur :" . $e->getMessage());
	}
?> 
