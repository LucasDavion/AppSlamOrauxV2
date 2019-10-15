<?php 
// initialisation de la variable msg 
$msg="";
// connexion bdd
include "connexion_bd_gesoraux.php";
// on recupère id et on verifie si elle existe et qu'elle est supérieur à 0
if(isset($_GET['id'])==true && $_GET['id']>0){
	$id=$_GET['id'];
	try{
		// requête de récupération des plages
		$lesEnregs=$bdd->prepare("select * from plage where id=:par_id");
		$lesEnregs->bindValue(':par_id', $id, PDO::PARAM_INT);
		$lesEnregs->execute();
		$enregE=$lesEnregs->fetch();
		// initialisation des variables
		$heureDebut=$enregE->heureDebut;
		$heureFin=$enregE->heureFin;
		$nbMaxEleve=$enregE->nbMaxEleve;

	}catch (PDOException $e) {
		die("Err BDSelect dans admin_gestion_plageinterrogation_modification.php");
	}
}
// on vérifie si le bouton à bien été utilisé
if(isset($_POST['btn_valider'])==true){
	// extraction des saisies du formulaire
	extract($_POST);
	// on verifie si heureDebut à bien été saisie
	if(isset($heureDebut)==false || trim($heureDebut)==""){
		$msg=$msg."La plage d'interrogation est obligatoire<br>";
	}
	// on verifie si heureFin à bien été saisie
	if(isset($heureFin)==false || trim($heureFin)==""){
		$msg=$msg."La plage d'interrogation est obligatoire<br>";
	}
	// on verifie si nbMaxEleve à bien été saisie
	if(isset($nbMaxEleve)==false || trim($nbMaxEleve)==""){
		$msg=$msg."La plage d'interrogation est obligatoire<br>";
	}
	// si il n'y a pas de méssage d'erreur on fait la requête
	if($msg==""){
		// requête update dans la bdd
		try{
			$req=$bdd->prepare("update plage set heureDebut=:par_heureDebut, heureFin=:par_heureFin, nbMaxEleve=:par_nbMaxEleve where id=:par_id");
			$req->bindValue(':par_id', $id, PDO::PARAM_INT);
			$req->bindValue(':par_heureDebut', $heureDebut, PDO::PARAM_STR);
			$req->bindValue(':par_heureFin', $heureFin, PDO::PARAM_STR);
			$req->bindValue(':par_nbMaxEleve', $nbMaxEleve, PDO::PARAM_INT);
			$req->execute();
			$msg="la modification s'est bien dérouler";
			header('Location: admin_gestion_plageinterrogation.php?msg'.$msg);
		}catch(PDOException $e) {
			$msg="Err BDUpdate  : erreur modification de la table plage dans admin_gestion_plageinterrogation_modification.php.php<br>
			Message d'erreur :" . $e->getMessage();
		}
	}
}
?>
<!-- inclusion des assets -->
<?php include "assets_haut_admin.php"?>
<?php
include "connexion_bd_gesoraux.php";
?>
<br><br>
<div class="container text-center">
	<h1>Modification d'une plage d'interrogation</h1><hr>
	<br />
	<div class="container text-center">
	<div class="row">
		<div class="col">
		</div>
		<div class="col-6"><br><br><br>
			<div class="shadow-lg p-3 mb-5 bg-white rounded">
				<div class="form-group">
					<!-- formulaire -->
					<form class="form" action="admin_gestion_plageinterrogation_modification.php" method ="POST">

						HeureDebut :&nbsp;&nbsp;<input type='time'name='heureDebut' value="<?php echo $heureDebut ?>" size='20'/> <br><br> 
						HeureFin :&nbsp;&nbsp;<input type='time'name='heureFin' value="<?php echo $heureFin ?>" size='20'/> <br><br> 
						nbMaxEleve :&nbsp;&nbsp;<input type='text'name='nbMaxEleve' value="<?php echo $nbMaxEleve ?>" size='20'/> <br><br> 

						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="submit" class="btn btn-success" name="btn_valider" value="Envoyer" />
						<!-- affichage des possibles messages -->
						<?php echo $msg;?>

					</form>
				</div>
			</div>
		</div>
		<div class="col">
		</div>
	</div>
</div>
 <!-- inclusion des assets -->
 <?php include "assets_bas.php"?>
