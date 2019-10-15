
<?php
    // le script est-il appelé lors du clic sur le bouton  Modifier situé sur la page
    //d'affichage des professeur (script gestion_prof_admin.php)
$msg="";
$id="1";
if(isset($_GET['id'])==true && $_GET['id']>0){
            // on récupère l'identifiant du professeur passé avec la méthode GET dans la variable $id
	$id=$_GET['id'];
            //connexion à la base de données
	include "connexion_bd_gesoraux.php";
	try{
                //on récupère les caractéristiques du professeur
                //dont l'identifiant est contenu dans la variable $id
		$lesEnregs=$bdd->query("SELECT nom,prenom,mail,idDiscipline,idSalleAtt,idCivilite FROM utilisateur where id=$id");
		if ($lesEnregs->rowCount() == 0) {
			echo "Aucun enregistrement";
		} else {
			$unEnreg=$lesEnregs->fetch();
                // on stocke les caractéristiques du professeur
                // dans les variables ayant le même nom
                //que les contrôles du formulaire.
                //par exemple : la variable $txt_nom contiendra le nom du professeur
			$txt_nom = $unEnreg->nom;
			$txt_prenom = $unEnreg->prenom;
			$txt_mail = $unEnreg->mail;
			$lst_discipline = $unEnreg->idDiscipline;
			$lst_salle = $unEnreg->idSalleAtt;
			$rbt_civilite =$unEnreg->idCivilite;
		}
	}catch(PDOException $e){
		echo("Err BDALec01Erreur : erreur de SELECT dans admin_gestion_prof_modif.php <br>Message d'erreur :".$e->getMessage());
	}
}
    //si le tableau $_POST contient le bouton valider
    // alors cela signifie que le formulaire a été soumis
    //le traitement de mise à jour va avoir lieu

if(isset($_POST['btn_valider'])==true){
            //on appelle la fonction extract qui créée automatiquement les variables
            //dont les noms sont les index de $_POST
            //et leur affecte la valeur associée
	extract($_POST);
            //si le nom n'existe pas dans le tableau $_POST//ou s'il n'est pas renseigné : on ajoute un message d'erreur
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
            // s'il n'y a pas d'erreur de saisie on va modifier l'enregistrement
	echo $msg;
	if($msg==""){
                //connexion à la base de données
		include "connexion_bd_gesoraux.php";
		try{
                    //on réalise la requête de mise à jour (update)
			$req=$bdd->prepare("UPDATE utilisateur SET nom=:par_nom, prenom=:par_prenom, mail=:par_mail, idSalleAtt=:par_salle,idDiscipline=:par_discipline,
				idCivilite=:par_civilite where id=$id");
				//Mettre la première lettre du prénom et du nom en majuscule 
				$nom_prem_maj = ucfirst($txt_nom);
				$prenom_prem_maj =  ucfirst($txt_prenom);
			$req->bindValue (':par_nom', $nom_prem_maj, PDO::PARAM_STR);
			$req->bindValue (':par_prenom', $prenom_prem_maj, PDO::PARAM_STR);
			$req->bindValue (':par_mail', $txt_mail, PDO::PARAM_STR);

			if($lst_salle==0){
				$req->bindValue (':par_salle', null, PDO::PARAM_INT);
			}
			else{
				$req->bindValue (':par_salle', $lst_salle, PDO::PARAM_INT);
			}

			$req->bindValue (':par_discipline', $lst_discipline, PDO::PARAM_INT);
			$req->bindValue (':par_civilite', $rbt_civilite, PDO::PARAM_INT);

			$req->execute();
                    //on indique dans la variable $msg que tout s'est bien passé
			$msg="la modification a bien été prise en compte";

                    //on se redirige vers l'affichage des employés en fournissant le message d'information
			header('Location: admin_gestion_prof_consultation.php?msg='.$msg);
		}catch(PDOException $e){
			echo("Err BDALec01Erreur : erreur de modification dans admin_gestion_prof_modif.php<br>Message d'erreur :".$e->getMessage());
			

		}

	}
}
?>
<?php include "assets_haut_admin.php"?>

    		<section class="jaune">
    			<div id="container">
    				<!-- formulaire de modification -->
    				<form action ="" method="POST">
    					<br>
    					<h1 class="text-center">Modification d'un professeur</h1>
    					<?php include "admin_gestion_prof_comp_graph.php" ?>
    					<input type="hidden" name="id" value="<?php echo $id;?>">
    				</form>
    			</div>

    		</section>
    <?php include "assets_bas.php"?>
