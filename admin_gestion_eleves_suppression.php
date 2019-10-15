<?php
	include"connexion_app_verif.php";
	$msg="";
	if(isset($_GET['idElev'])==true && $_GET['idElev']>0 && isset($_GET['idEp'])==true && $_GET['idEp']>0){
		include 'connexion_bd_gesoraux.php';
		try{
			$lesEnregsP=$bdd->prepare("DELETE from passageepreuve where idEleve=:par_idEleve");
			$lesEnregsP->bindValue(":par_idEleve",$_GET['idElev'],PDO::PARAM_INT);
			$lesEnregsP->execute();

		} catch(PDOException $e){
			echo("ErrSuppEpreuve : Erreur lors de la suppression d'une épreuve dans admin_gestion_eleves_suppression.php.
				<br>Message d'erreur :".$e->getMessage());
		}
		try{
			$lesEnregsE=$bdd->prepare("DELETE from eleve where id=:par_id");
			$lesEnregsE->bindValue(":par_id",$_GET['idElev'],PDO::PARAM_INT);
			$lesEnregsE->execute();
		} catch(PDOException $e){
			echo("ErrSuppEleve : Erreur lors de la suppression de l'élève dans admin_gestion_eleves_suppression.php.
				<br>Message d'erreur:".$e->getMessage());
		}
			$msg="La suppression a bien été effectuée.";
			header('Location: admin_gestion_eleves_consultation.php?msg='.$msg);		
	}
?>