<?php 
$msg="";
session_start();
/*---------------------------------
vérification que l'identifiant et le mot de passe existe 
dans la base de donnée et correspondent
-----------------------------------*/
if (isset($_POST ["ident"]) && isset($_POST["mdp"]))
{
	include "connexion_bd_gesoraux.php";

	extract($_POST);
	if(empty($_POST)==false){
		try{
			/*--------------------------------------
			décrypte le mot de passe qui est en sha1
			---------------------------------------*/
			$mdp_crypte=sha1($mdp);
			$req= $bdd->prepare("SELECT nom, prenom, idTypeUtilisateur, id, idDiscipline, mail FROM utilisateur WHERE identifiant= :par_identifiant AND motDePasse= :par_motDePasse");
			$req->bindValue(':par_identifiant', $ident, PDO::PARAM_STR);
			$req->bindValue(':par_motDePasse', $mdp_crypte, PDO::PARAM_STR);
			$req->execute();
			$enreg=$req->fetch();	
		}catch (PDOException $e){
			die("Err BDSelect : erreur select table utilisateur dans connexion_verif_app.php<br>
				Message d'erreur :" .$e->getMessage());
		}
		if($enreg==false){
			$msg="Veuillez saisir un identifiant et un mot de passe correct";
		}else{
			/*------------------------------
			création des variables de session
			--------------------------------*/
			$_SESSION['nom_prenom'] = $enreg->nom." ".$enreg->prenom;
			$_SESSION['idTypeUtilisateur'] = $enreg->idTypeUtilisateur;
			$_SESSION['id'] = $enreg->id;
			$_SESSION['idDiscipline']=$enreg->idDiscipline;
			$_SESSION['mail']=$enreg->mail;
			$_SESSION['nom'] = $enreg->nom;
			/*-----------------------------------------------------
			affiche le panel en fonction de notre type d'utilisateur
			-------------------------------------------------------*/
			if($enreg->idTypeUtilisateur=='1'){
				header('Location: panel_admin_gesoraux.php');
			}else{
				if($enreg->idTypeUtilisateur=='2'){
					header('Location: panel_prof_gesoraux.php');
				}else{
					if($enreg->idTypeUtilisateur=='3'){
						header('Location: panel_scolarite_gesoraux.php');
					}	
				}
			}
		}
	}
}else{

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Connexion</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/chantilly.png');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Connexion
				</span>
			
				<!--formulaire de connexion-->
				
				<form class="login100-form validate-form p-b-33 p-t-5" action="connexion_app.php" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Entrer votre identifiant">
						<input class="input100" type="text" name="ident" placeholder="Identifiant">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Entrer votre mot de passe">
						<input class="input100" type="password" name="mdp" placeholder="Mot de passe">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
					<br>
						<a class="input100" href="#"><h6>Mot de passe oublié ?</h6></a>
					<div class="container-login100-form-btn m-t-32">
							<input class="login100-form-btn" type="submit" name="valider" id="valider" value="Se connecter" />
							<br><?php  
								echo $msg;
							?>
						
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
