<?php

//include "session_admin.php";
include "connexion_bd_gesoraux.php";
$msg ="";
  //on initialise les variables utilisées
  //pour afficher en cas d'erreur les valeurs saisies
  //au préalable dans le formulaire
$txt_nom="";
$txt_prenom="";
$txt_mail="";
$lst_discipline="";
$lst_salle="";
$rbt_civilite="";
  //si le tableau $_POST contient le bouton valider
  //alors cela signifie que le formulaire à été soumis 
if(isset ($_POST['btn_valider'])==true){
    //appel de la fonction extract qui créé automatiquement les variables
    //dont les noms sont les index de $_POST
    // et leurs affecte la valeur associé
	extract($_POST);
    //si le nom n'existe pas dans le tableau $_POST
    //ou s'il n'est pas renseigné : on ajoute un message d'erreur
	if(isset($txt_nom)==false || trim ($txt_nom)==""){
		$msg=$msg."Le nom est obligatoire<br>";
	}
	if(isset($txt_prenom)==false|| trim ($txt_prenom)==""){
		$msg=$msg."Le prénom est obligatoire";
	}
	if(isset ($txt_mail)==false || trim ($txt_mail)==""){
		$msg=$msg."<br> Le mail est obligatoire";
	}
	if(isset ($lst_discipline)==false || trim ($lst_discipline)==""){ 
		$msg=$msg."<br> La discipline est obligatoire";
	}
	if(isset ($rbt_civilite)==false || trim ($rbt_civilite)==""){
		$msg=$msg."<br> La civilité est obligatoire";
	}

    //s'il n'y a pas d'erreur de saisie on va ajouter l'enregistrement
	if($msg=="")
	{
      //on passe le nom et le prénom  en minuscule
		$nom_min = strtolower($txt_nom);
		$prenom_min = strtolower($txt_prenom);

      //on récupère l'année en cours 
		$annee = date("Y");

      //on génère le compte composé du prénom suivi du nom
		$identifiant = $prenom_min.".".$nom_min;
		
      //on génère le mot de passe composé des 2 premiers caractères du nom
      //suivis de l'année en cours suivie de 2 premiers caractères du prénom
		$mot_de_passe_en_clair = substr($nom_min, 0,2).$annee.substr($prenom_min, 0,2);
      //on appelle la fonction sha1 pour crypter le mot de passe avec le grain de sel
      //$mot_de_passe_crypte = sha1($identifiant.$mot_de_passe_en_clair);
		$mot_de_passe_crypte = sha1($mot_de_passe_en_clair);

		//Mettre la première lettre du prénom et du nom en majuscule 
		$nom_prem_maj = ucfirst($txt_nom);
		$prenom_prem_maj =  ucfirst($txt_prenom);

      // on prépare la requête insert
		try {
			$req=$bdd->prepare("INSERT into utilisateur values(0, :par_ident,:par_mdp,:par_mail, :par_nom, :par_prenom, :par_typeUtili,:par_salleAtt, :par_discipline,:par_civilite)");
			$req->bindValue (':par_ident', $identifiant, PDO::PARAM_STR);
			$req->bindValue (':par_mdp',$mot_de_passe_crypte , PDO::PARAM_STR);
			$req->bindValue (':par_mail',$txt_mail, PDO::PARAM_STR);
			$req->bindValue (':par_nom', $nom_prem_maj, PDO::PARAM_STR);
			//$req->bindValue (':par_nom', $nom_min, PDO::PARAM_STR);
			$req->bindValue (':par_prenom', $prenom_prem_maj, PDO::PARAM_STR);
			//$req->bindValue (':par_prenom', $prenom_min, PDO::PARAM_STR);
			$req->bindValue (':par_typeUtili',"2", PDO::PARAM_INT);
			if($lst_salle==0){
				$req->bindValue (':par_salleAtt', null, PDO::PARAM_INT);
			}
			else{
				$req->bindValue (':par_salleAtt', $lst_salle, PDO::PARAM_INT);
			}
			$req->bindValue (':par_discipline', $lst_discipline, PDO::PARAM_INT);
			$req->bindValue (':par_civilite', $rbt_civilite, PDO::PARAM_INT);
			$req->execute();
			$msg="Le professeur a bien été ajouté";

                //on se redirige vers l'affichage des employés en fournissant le message d'information
			header('Location: admin_gestion_prof_consultation.php?msg='.$msg);

		} catch(PDOException $e){
			echo("Err BDInsert  : erreur ajout table utilisateur dans admin_gestion_prof_ajout.php<br>
				Message d'erreur :".$e->getMessage());
				echo $identifiant;
		}
	}
}
?>
<?php include "assets_haut_admin.php"?>
    		<section>

    			<div class="">
    				<form class="" action = "admin_gestion_prof_ajout.php" method="post">
    					<h1 class="text-center">Ajout d'un professeur</h1>
    					<?php include "admin_gestion_prof_comp_graph.php"?>
    				</form>
    				<div class="col">
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</section>
<?php include "assets_bas.php"?>


