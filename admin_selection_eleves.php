<?php
include "connexion_bd_gesoraux.php";
	//variables de session
	include "assets_haut_admin.php";
$lst_division=0;
$rbt_natureepreuve="";

if(isset($_POST['btn_valider']) == true){
	extract($_POST);
}
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>

	<meta charset="UTF-8">
	<meta name ="vieuwport" content="width=device-width, initial-scale-1.0">
	<meta name="Sélection" content="Sélection des élèves">
	<link rel="stylesheet" href="bootstrap.min.css">
	<title>Sélection des élèves</title>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	
	<script>

function reset_rbt(){
	document.getElementById("idnatepT").checked=true;
	document.getElementById("idelevesT").checked=true;
}

//appeler Ajax avec Jquery
$(document).ready(function(){
	$("input[name=rbt_natep]").click(function() {
		$(".resultat").load("admin_selection_eleves_crit.php",{
			'idabsence' : $('input[type=radio][name=rbt_absence]:checked').attr('value'),
			'idnatep' : $('input[type=radio][name=rbt_natep]:checked').attr('value'),
			'idDivision' : $("#lst_division").val()}
			);
	});
});
$(document).ready(function(){
	$("input[name=rbt_absence]").click(function() {
		$(".resultat").load("admin_selection_eleves_crit.php",{
			'idabsence' : $('input[type=radio][name=rbt_absence]:checked').attr('value'),
			'idnatep' : $('input[type=radio][name=rbt_natep]:checked').attr('value'),
			'idDivision' : $("#lst_division").val()}
			);
	});
});	
	
			//-----------------------
			//Exécuté au lancement du formulaire
			$(document).ready(function(){	
				$.ajax({
					url : 'admin_selection_eleves_crit.php', // script appelé
					type : 'POST', // Le type de la requête HTTP est POST
					data : 'idDivision='+ 0 +'&idnatep=T'+'&idabsence=T', //l'id sélectionné est passé au script
					dataType :  'html', //resultat sera en HTML
					success : function(code_html, statut){
						//l'appel s'est bien passé : on met le résultat dans la div resultat
						$(".resultat").html (code_html);
					},
					error :function(resultat, statut, erreur){
						//si l'appel ne se passe pas bien on affiche l'erreur
						$(".resultat").html("Erreur :" + resultat.reponseText);
					}
            	});
				
				$("#lst_division").change(function(){ 
					$.ajax({
                url : 'admin_selection_eleves_crit.php', // script appelé
                type : 'POST', // Le type de la requête HTTP est POST
                data : 'idDivision=' + $("#lst_division").val() +
                '&idnatep=' +$(".rbt_natep").val()+ //l'id sélectionné est passé au script
				'&idabsence=' +$(".rbt_absence").val(),
                dataType :  'html', //resultat sera en HTML
                success : function(code_html, statut){
                    //l'appel s'est bien passé : on met le résultat dans la div resultat
                    $(".resultat").html (code_html);
                },
                error :function(resultat, statut, erreur){
                    //si l'appel ne se passe pas bien on affiche l'erreur
                    $(".resultat").html("Erreur :" + resultat.reponseText);
                }
            });
				});

				
			});
		</script>
	</head>
	<body style="text-align: center;">
		<header>
			<h1>Sélection des élèves</h1>
			<br><br>
		</header>

			<!-- *****************************************************************************
				 **************************** Choix de la division ***************************
				 *****************************************************************************-->
				 <label><b>Choix de la division</label></b><br>
				 <select required name="lst_division" id="lst_division" onchange="reset_rbt();">
				 	<option value='0'>Veuillez sélectionner une division</option>
				 	<?php
				 	$msg="";
				 	if(isset ($_GET['msg'])==true){
				 		$msg=$_GET['msg'];
				 	}
							//exécution de la requête (avec la méthode query) pour obtenir le contenu de la table lst_division
							// on récupère le résultat de la requête dans le tableau $lesenregs
				 	try{
				 		$lesEnregs=$bdd->query("SELECT id, libelle from division");
				 	}catch(PDOException $e) {
				 		echo("err BDSelect : erreur de lecture table division dans admin_selection_eleves.php.php<br>
				 			Message d'erreur : ".$e->getMessage());
				 	}
							//on teste si le select a retourné des enregistrement
				 	if($lesEnregs->rowCount() > 0)
				 	{
								//pour chaque enregistrement retourné par la requête SQL, on créé une option dans la liste
								//l'attribut value contiendra l'id (l'identifiant de la division)
								// et le libellé de la division sera affiché
								//on limite le tableau retourné et pour chaque enregistrement, on affiche la division
				 		foreach($lesEnregs as $enreg) {
				 			if($lst_division == $enreg->id){
				 				echo "<option selected value='$enreg->id' id='idDivision'>$enreg->libelle</option>";
				 			}else{
				 				echo"<option value='$enreg->id' id='idDivision'>$enreg->libelle</option>";
				 			}
				 			
				 		}
				 	}
				 	echo("</select>");
				 	?>
				 	<br><br>
			<!-- *****************************************************************************
			**************************** filtrer les élèves absents ou présents **********************************
			********************************************************************************-->
			<label><b>Choix élèves</b></label>
			<br>
			Tous les élèves &nbsp<input type='radio' class='rbt_absence' name='rbt_absence' checked = 'checked' value='T'id="idelevesT"/>
			<br>
			Elèves absents &nbsp<input type='radio' class='rbt_absence' name='rbt_absence' value='O'/>
			<br>
			<br><br>

		<!-- *****************************************************************************
		**************************** filtrer LV1 OU LV2 **********************************
		********************************************************************************-->
		<label for="Toutes les natures d'épreuve "><b>Choix langue vivante</b></label><br>
		<?php
		//execution de la requête qui récupère le contenu de la table 
		// on récupère le résultat de la requête dans le tableau $lesEnregs
		try{
			$lesEnregs=$bdd->query("SELECT id, libelle from natureepreuve");
		}catch(PDOException $e) {
			echo("Err BDSelect : erreur de lecture table natureepreuve dans admin_selection_eleves_crit.php.php<br>
				Message d'erreur :" .$e->getMessage());
		}
		//on teste si le select a retourné des enregistrements 
		if($lesEnregs->rowCount()>0){
			
			//radio bouton pour obtenir si l'epreuve est LV1 ou LV2
			echo("Toutes les natures d'épreuves &nbsp<input type='radio' class='rbt_natep' name='rbt_natep' checked = 'checked' value='T' id='idnatepT'/>");
			echo"<br>";
			//on lit le tableau retourné par la requête SELECT
			//et pour chaque enregistrement génère un radio bouton
			//l'attribut value contient l'id de la nature de l'épreuve
			foreach($lesEnregs as $enreg){
				echo"$enreg->libelle &nbsp<input type='radio' class='rbt_natep' name='rbt_natep' value='".$enreg->id."'/>";
				
				echo"<br>";
			}
		}else{
			echo"<br>Consultation impossible : aucune nature d'épreuve n'a été enregistrée";
		}

		?>
		<div class="form-group">
			

		</div>
		<?php
		if($msg != ""){
		echo"<div class='alert alert-success'>";
		echo $msg;
		echo"</div>";
		}
		?>
		<br>

			<!-- *****************************************************************************
					********* Affichage des élèves dans un tableau avec Ajax *************
					*****************************************************************************-->

					<div class='resultat'>
						<!-- affichage du tableau-->
					</div>

					<?php 
					if($msg != ""){
						echo"<div class='alert alert-success'>";
						echo $msg;
						echo"</div>";	
					}
					?>
				
	<?php
	include "assets_bas.php"
	?>
			