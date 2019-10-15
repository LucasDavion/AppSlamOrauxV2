<?php
// initialisation de la variable msg
$msg="";
// on recupère id et on verifie si elle existe et qu'elle est supérieur à 0
if($_GET['id']==true && $_GET['id']>0){
  // connexion bdd
	include "connexion_bd_gesoraux.php";
	try{
    // requête delete des salles
		  $req=$bdd->prepare("delete from salle where id=:par_id");
  		$req->bindValue(':par_id', $_GET['id'] , PDO::PARAM_INT);
      	$req->execute();
      	$msg="La suppression c'est bien passé.";
      	header('Location: admin_gestion_salle.php?msg'.$msg);
	}catch(PDOException $e) {
$msg= "Err BDDelete  : erreur de suppression dans la table salle dans admin_gestion_salle_suppression.php<br>
          Message d'erreur :" . $e->getMessage();
    }
}
?>