<?php
	include "connexion_bd_gesoraux.php";
	//variables de session
	include "assets_haut_prof.php";
	$idDiscipline = $_SESSION['idDiscipline'];
	$idProf = $_SESSION['id'];	

	$nbEleveMaxReq = $bdd->query("SELECT sum(nbMaxEleve)as nbMax from plage 
    join plagedemijournee on idPlage = plage.id
    join demijournee on demijournee.id= plagedemijournee.idDemiJournee
    join choixprofdemijournee on choixprofdemijournee.idDemiJournee = demijournee.id
    where idUtilisateur = $idProf");
    $nbEleveMaxs = $nbEleveMaxReq->fetch();
    $nbEleveMax = $nbEleveMaxs->nbMax;
    $lst_division = 0;
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<meta charset="UTF-8">
	<meta name ="vieuwport" content="width=device-width, initial-scale-1.0">
	<meta name="Sélection" content="Sélection des élèves">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>Sélection des élèves</title>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script>

    	function reset_rbt_natep() {
    		document.getElementById("idnatepT").checked = true;
    	}
		function majNbSelectionne(element) {

			value = element.value;
			tabValue = value.split(" ");
			LV = tabValue[1];
			// le nombre maximum est-il atteint ??
			if (Number(document.getElementById("nbTotal").textContent) == Number(document.getElementById("nbMax").textContent) )
			{
				// le nombre maximum est atteint
				// ------------------------------		
				
				// La case a-t'elle été cochée ??
				if (element.checked == true){
					// la case est cochée : on la décoche et on affiche un message d'information
					element.checked = false;
					alert("Vous ne pouvez plus sélectionner d'élève : vous avez atteint votre quota !");
				}
				else
				{
					// la case est décochée : on décrémente le nombre de cases cochées 
					document.getElementById("nbTotal").textContent=Number(document.getElementById("nbTotal").textContent)  - 1;
					if(LV == "LV1"){					
						document.getElementById("nbLV1").textContent=Number(document.getElementById("nbLV1").textContent)  - 1;
					} else {										
						document.getElementById("nbLV2").textContent=Number(document.getElementById("nbLV2").textContent)  - 1;
					}
				}
			}
			else
			{
				// le nombre maximum n'est pas atteint
				// -----------------------------------
				
				// La case a-t'elle été cochée ??
				if (element.checked == true){
					// la case est cochée : on incrémente le nombre de cases cochées 
					//REMARQUE : si le champ à mettre à jour est un input de type textbox, il faut utiliser .value au lieu de .textContent
					document.getElementById("nbTotal").textContent=Number(document.getElementById("nbTotal").textContent)  + 1;
					if(LV == "LV1"){					
						document.getElementById("nbLV1").textContent=Number(document.getElementById("nbLV1").textContent)  + 1;
					} else {										
						document.getElementById("nbLV2").textContent=Number(document.getElementById("nbLV2").textContent)  + 1;
					}
				} else {
					// la case est décochée : on décrémente le nombre de cases cochées 
					document.getElementById("nbTotal").textContent=Number(document.getElementById("nbTotal").textContent)  - 1;
					if(LV== "LV1"){					
						document.getElementById("nbLV1").textContent=Number(document.getElementById("nbLV1").textContent)  - 1;
					} else {										
						document.getElementById("nbLV2").textContent=Number(document.getElementById("nbLV2").textContent)  - 1;
					}
				}
			}
		} 	

	//Ajax pour radio boutton (avec JQuery)
    $(document).ready(function(){
		$("input[name=rbt_natep]").click(function() {
			$(".resultat").load("eleve_selection_crit.php",{
				'idnatep' : $('input[type=radio][name=rbt_natep]:checked').attr('value'),
				'idDivision' : $("#lst_division").val(),
				'idProf' : $("#idProf").val(),
				'idDiscipline' : $("#idDis").val()
			});
		});

		//Ajax pour la liste déroulante
		$("#lst_division").change(function(){
            $.ajax({
                url : 'eleve_selection_crit.php', // script appelé
                type : 'POST', // Le type de la requête HTTP est POST
                data : 'idDivision=' + $("#lst_division").val() +
				'&idDiscipline=' + $("#idDis").val()+
				'&idnatep=' +$(".rbt_natep").val()+
				'&idProf='+$("#idProf").val(), //l'id sélectionné est passé au script
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

	    <input type="hidden" name="idProf" id="idProf" value="<?php echo $idProf;?>" >
		<!-- filtrer LV1 OU LV2 -->
		<label for="Toutes les natures d'épreuve "><b>Choix langue vivante :</b></label>
		<?php
		//execution de la requete qui récupère le contenu de la table fonction 
		// on récupère le résultat de la requête dans le tableau $lesenregs
		try{
			$lesEnregs=$bdd->query("SELECT id, libelle from natureepreuve");
		}catch(PDOException $e) {
			die("Err BDSelect : erreur de lecture table natureepreuve dans eleve_selection.php<br>
			Message d'erreur :" .$e->getMessage());
		}
		//on teste si le select a retourné des enregistrements 
		if($lesEnregs->rowCount()>0){
			//radio bouton pour obtenir si l'epreuve est LV1 ou LV2
			echo("<br>Toutes les natures d'épreuves &nbsp <input type='radio' id='idnatepT' class='rbt_natep' name='rbt_natep' checked value='T'/>");
			//on lit le tableau retourné par la requête SELECT
			//et pour chaque enregistrement génère un radio bouton
			//l'attribut value contient l'id de la nature de l'épreuve
			foreach($lesEnregs as $enreg){
				echo"<br>$enreg->libelle &nbsp <input type='radio' class='rbt_natep' name='rbt_natep' value='$enreg->id'/>";
			}
		}else{
			echo"<br>Consultation impossible : aucune nature épreuve n'a été enregistrée";
		}

		?>

	<div class="form-group" style="float: center;">

		<br>
		<input type="hidden" name="iddisc" id="idDis" value="<?php echo $idDiscipline;?>" >

		<label><b>Choix de la division :</label></b>
		<br>
			<select required name="lst_division" id="lst_division" onchange="reset_rbt_natep();">
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
				die("err BDSelect : erreur de lecture table division dans eleve_selection.php<br>
					Message d'erreur : ".$e->getMessage());
			}
			//on teste si le select a retourné des enregistrement
			if($lesEnregs->rowCount() > 0)
			{
				//pour chaque enregistrement retourné par la requête SQL, on créé une option dans la liste
				//l'attribut value contiendra l'id (l'identifiant de la division)
				// et le libellé de la division sera affiché
				//on lmit le tableau retourné et pour chaque enregistrement, on affiche la division
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


		<?php

			$prof=1;
			$eleve=0;
		?>
		<br>

		<!-- -----------------------------------------------
		 Affichage des élèves dans un tableau avec Ajax
		-------------------------------------------------- -->
		<div class='resultat'>
			<!-- affichage du tableau-->
		</div>
		<?php 
		echo"$msg";
		?>
	</div> 
	<?php
		//Nombre d'élèves en LV1:
		try {
			$lesElevesLV1=$bdd->query("select count(distinct passageepreuve.id) as nb from passageepreuve
			join epreuve on passageepreuve.idEpreuve=epreuve.id
			join natureepreuve on idNatureEpreuve=natureEpreuve.id
			where natureepreuve.libelle='LV1' AND idProfChoix=$idProf");
			if($lesElevesLV1->rowCount()==0){
				echo("aucun élève n'a été selectionné. ");
			}else{
				$elevesLV1=$lesElevesLV1->fetch();
			}
		}catch(PDOException $e){
			die("Err BDALec01Erreur : erreur de SELECT dans eleve_selection.php <br>Message d'erreur :" .$e->getMessage());
		}
		echo("Nombre d'élèves en LV1 : <label id ='nbLV1'>$elevesLV1->nb</label><br>");

		//nombre d'élève en LV2
		try {
			$lesElevesLV2=$bdd->query("select count(distinct passageepreuve.id) as nb from passageepreuve
			join epreuve on passageepreuve.idEpreuve=epreuve.id
			join natureepreuve on idNatureEpreuve=natureEpreuve.id
			where natureepreuve.libelle='LV2' AND idProfChoix=$idProf ");
			if($lesElevesLV2->rowCount()==0){
				echo("aucun élève n'a été selectionné. ");
			}else{
				$elevesLV2=$lesElevesLV2->fetch();
			}
		}catch(PDOException $e){
			die("Err BDALec01Erreur : erreur de SELECT dans eleve_selection.php <br>Message d'erreur :" .$e->getMessage());
		}
		
		echo("<div class='fixed-left'>Nombre d'élèves en LV2 : <label id ='nbLV2'>$elevesLV2->nb</label><br>");


		//nombre d'élève totale
		$nbEleveTotale=$elevesLV1 ->nb + $elevesLV2->nb;
		echo("Nombre d'élèves sélectionnés : <label id ='nbTotal'>$nbEleveTotale</label><br>");
		echo("<br><b>Nombre d'élèves maximum : <label id ='nbMax'>$nbEleveMax</label><br></b>");
		echo("<br>");
		?>
		
		

		<?php
		// calcul de la moyenne des élèves
		try {
			$lesProfs=$bdd->query("select count(*) as nb from utilisateur where idDiscipline=$idDiscipline");
			if($lesProfs->rowCount()== 0){
				echo ("aucun professeur n'a été enregistré.");
			} else {
				$prof=$lesProfs->fetch();
			}
		} catch (PDOException $e) {
			die("Err BDALec01Erreur : erreur de SELECT dans eleve_selection.php <br>Message d'erreur :" .$e->getMessage());
		}
			
		try {
			$lesEleves=$bdd->query(" select count(distinct passageepreuve.id) as nb from passageepreuve 
			join epreuve on passageepreuve.idEpreuve=epreuve.id where epreuve.idDiscipline=$idDiscipline  ");
				if($lesEleves->rowCount () == 0) {
				echo ("Aucun élève n'a été enregistré.");
				} else {
					$eleve=$lesEleves->fetch();
				}
		} catch (PDOException $e) {
			die("Err BDALec01Erreur : erreur de SELECT dans eleve_selection.php <br>Message d'erreur :" .$e->getMessage());
		}

		$nbMoyenEleve=floor($eleve->nb / $prof->nb);

		echo("<i>Nombre d'élèves moyen par professeur est de : $nbMoyenEleve </i></div>");

include "assets_bas.php";
	?>
