
<?php 
	$msg="";
	$txt_nom="";
	$txt_prenom="";
	$txt_dateNai="";
	$rbt_tiersTemps="";
	$lst_civilite="";
	$lst_division="";
	$rbt_benef="";
	$rbt_derog="";
	if(count($_POST)==0 && isset($_GET['idElev'])==true && $_GET['idElev']>0 && isset($_GET['idEp'])==true && $_GET['idEp']>0){

		$idEle=$_GET['idElev'];
		$idEpre=$_GET['idEp'];
		include"connexion_bd_gesoraux.php";
		try{
			// select des infos de l'élève
			$lesEnregsE=$bdd->prepare("SELECT nom,prenom,dateNaissance,tiersTempsON,section.libelle as secLib,division.libelle as divLib,civilite.libelle as civLib from eleve 
							left outer join section on idSection=section.id 
							join division on idDivision=division.id 
							join civilite on idCivilite=civilite.id 
							where eleve.id=:par_idEleve");
							
			$lesEnregsE->bindValue(":par_idEleve", $idEle, PDO::PARAM_INT);

			$lesEnregsE->execute();

		} catch(PDOException $e){
			echo("ErrSelectCarac1: Erreur lors de la sélection des caractéristiques dans admin_gestion_eleves_modification.php.
				<br>Message d'erreur :".$e->getMessage());
		}

			$eleve=$lesEnregsE->fetch();
		try{
			// select des infos de l'épreuve 
			$lesEnregP=$bdd->prepare("SELECT inscritBenef,derogation,discipline.libelle as disLib,natureepreuve.libelle as natLib, epreuve.id as idE, natureepreuve.id as natId from passageepreuve 
				join epreuve on idEpreuve=epreuve.id 
				join natureepreuve on idNatureEpreuve=natureepreuve.id 
				join discipline on idDiscipline=discipline.id 
				where idEleve=:par_idEleve && passageepreuve.id=:par_idPass");
			$lesEnregP->bindValue(':par_idEleve',$idEle, PDO::PARAM_INT);
			$lesEnregP->bindValue(':par_idPass',$idEpre, PDO::PARAM_STR);
			$lesEnregP->execute();
		} catch(PDOException $e){
			echo("ErrSelectCarac2: Erreur lors de la sélection des caractéristiques dans admin_gestion_eleves_modification.php.
				<br>Message d'erreur :".$e->getMessage());
		}
			$passage=$lesEnregP->fetch();
			// attribution des variables
			$txt_nom=$eleve->nom;
			$txt_prenom=$eleve->prenom;
			$txt_dateNai=$eleve->dateNaissance;
			$rbt_tiersTemps=$eleve->tiersTempsON;
			$lst_civilite=$eleve->civLib;
			$lst_division=$eleve->divLib;
			$lst_section=$eleve->secLib;
			$rbt_benef=$passage->inscritBenef;			
			$rbt_derog=$passage->derogation;			
			$lst_epreuve=$passage->idE;

			$natuId=$passage->natId;			
	}
	else{	
	if(isset($_POST['btn_valider'])==true){
		extract($_POST);
		if (isset($txt_nom)==false) {
			$msg=$msg."Le nom est obligatoire.<br>";
		} 
		if(isset($txt_prenom)==false){
			$msg=$msg."Le prénom est obligatoire.<br>";
		} 
		if (isset($txt_dateNai)==false) {
			$msg=$msg."La date de naissance est obligatoire.<br>";
		} 
		if (isset($rbt_tiersTemps)==false) {
			$msg=$msg."Le tiers temps n'a pas été sélectionné.<br>";
		} 
		if (isset($lst_civilite)==false) {
			$msg=$msg."La civilité est obligatoire.<br>";
		} 
		if(isset($lst_division)==false) {
			$msg=$msg."La division est obligatoire.<br>";
		} 
		if (isset($rbt_benef)==false) {
			$msg=$msg."Le bénéfice n'a pas été sélectionné.<br>";
		} 

		if (isset($rbt_derog)==false) {
			$msg=$msg."La dérogation n'a pas été sélectionné.<br>";
		} 

		if(isset($lst_epreuve)==false) {
			$msg=$msg."L'épreuve n'a pas été sélectionné.<br>";
		} 
		if($msg==""){
			include"connexion_bd_gesoraux.php";
			try{
				$lesEnregsE=$bdd->prepare("UPDATE eleve set nom=:par_nom,prenom=:par_prenom,dateNaissance=:par_date,tiersTempsON=:par_tiers,idCivilite=:par_idCivilite,idSection=:par_idSection,idDivision=:par_idDivision where id=:par_idE");

				$lesEnregsE->bindValue(':par_idE',$idEle, PDO::PARAM_INT);
				$lesEnregsE->bindValue(':par_nom', strtoupper($txt_nom), PDO::PARAM_STR);
				$lesEnregsE->bindValue(':par_prenom', strtoupper($txt_prenom), PDO::PARAM_STR);
				$lesEnregsE->bindValue(':par_date', $txt_dateNai, PDO::PARAM_STR);
				$lesEnregsE->bindValue(':par_tiers', $rbt_tiersTemps, PDO::PARAM_STR);
				$lesEnregsE->bindValue(':par_idCivilite', $lst_civilite, PDO::PARAM_INT);
				if(isset($lst_section)==true){
					$sect=$lst_section;
				} else {
					$sect=null;
				}
				$lesEnregsE->bindValue(':par_idSection', $sect, PDO::PARAM_INT);
				$lesEnregsE->bindValue(':par_idDivision', $lst_division, PDO::PARAM_INT);
				
				$lesEnregsE->execute();

			} catch(PDOException $e) {
				echo("ErrUpdateEleve : Erreur lors de la modification d'un eleve dans admin_gestion_eleves_modification.php.
				<br>Message d'erreur :".$e->getMessage());
			}	

			try{
				$lesEnregP=$bdd->prepare("UPDATE passageepreuve set inscritBenef=:par_benef,derogation=:par_derog,idEpreuve=:par_idEpreuve where id=:par_idP");

				$lesEnregP->bindValue(':par_idP',$idEpre,PDO::PARAM_INT);
				$lesEnregP->bindValue(':par_benef',$rbt_benef,PDO::PARAM_STR);
				$lesEnregP->bindValue(':par_derog',$rbt_derog,PDO::PARAM_STR);											
				$lesEnregP->bindValue(':par_idEpreuve',$lst_epreuve,PDO::PARAM_INT);
			
				$lesEnregP->execute();

			} catch(PDOException $e) {
				echo("ErrUpdateEpreuve : Erreur lors de la modification de l'épreuve de l'élève dans admin_gestion_eleves_modification.php.
				<br>Message d'erreur :".$e->getMessage());
			}	

				$msg="La modification a bien été effectué.";

				header('Location:admin_gestion_eleves_consultation.php?msg='.$msg);
			
		}
	}
	}			
?>

<?php include "assets_haut_admin.php"?>
<div class="container">
	<form method='POST'>
		<?php
			include"admin_gestion_eleves_composant_graph.php";
		?>

		<div class="form-group">
			<label class="col-md-4"><b>Bénéficiaire :</b></label><br>
			<div class="col-md-12">
			<?php
				echo"<div class='form-check form-check-inline'>";
				if($rbt_benef == "O"){
					echo "<input class='form-check-input' type='radio' checked name='rbt_benef' id='benefOui' value='O'>Oui";
				} else {
					echo "<input class='form-check-input' type='radio'  name='rbt_benef' id='benefOui' value='O'>Oui";
				}
				echo"</div>";
				echo"<div class='form-check form-check-inline'>";
				if($rbt_benef == "N"){
					echo "<input class='form-check-input' type='radio' checked name='rbt_benef' id='benefNon' value='N'>Non";
				} else {
					echo "<input class='form-check-input' type='radio' name='rbt_benef' id='benefNon' value='N'>Non";
				}
				echo"</div>";
			?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4"><b>Dérogation :</b></label><br>
			<div class="col-md-12">
				<?php
					echo"<div class='form-check form-check-inline'>";
					if($rbt_derog == "O"){
						echo "<input class='form-check-input' type='radio' checked name='rbt_derog' id='derogOui' value='O'>Oui";
					} else {
						echo "<input class='form-check-input' type='radio'  name='rbt_derog' id='derogOui' value='O'>Oui";
					}
					echo"</div>";
					echo"<div class='form-check form-check-inline'>";
					if($rbt_derog == "N"){
						echo "<input class='form-check-input' type='radio' checked name='rbt_derog' id='derogNon' value='N'>Non";
					} else {
						echo "<input class='form-check-input' type='radio' name='rbt_derog' id='derogNon' value='N'>Non";
					}
					echo"</div>";
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4"><b>Epreuve :</b></label><br>
			<div class="col-md-12">
				<select class="custom-select custom-select" name="lst_epreuve">
					<?php 
						include "connexion_bd_gesoraux.php";

						if($natuId==1){
							try{
								$lesEnregs=$bdd->query("SELECT epreuve.id as idEpr, discipline.libelle as discLib, natureepreuve.libelle from epreuve join discipline on discipline.id=idDiscipline join natureepreuve on idNatureEpreuve=natureepreuve.id where natureepreuve.id=$natuId");
							} catch(PDOException $e) {
								die("ErrSelecCiv : erreur lors de la sélection des civilités dans admin_gestion_eleves_composant_graph.php<br>
									Message d'erreur : ".$e->getMessage());
							}
							if($lesEnregs->rowCount()>0) {
								foreach ($lesEnregs as $enreg) {
									if($lst_epreuve == $enreg->idEpr){
										echo "<option class='form-group' selected value='$enreg->idEpr'>$enreg->discLib</option>";
									} else {
										echo "<option class='form-group' value='$enreg->idEpr'>$enreg->discLib</option>";
									}																	
								}
							}
						}
						else {
							if($natuId==2){
								try{
									$lesEnregs=$bdd->query("SELECT epreuve.id as idEpr, discipline.libelle as discLib, natureepreuve.libelle as natLibe from epreuve join discipline on discipline.id=idDiscipline join natureepreuve on idNatureEpreuve=natureepreuve.id where natureepreuve.id=$natuId");
								} catch(PDOException $e) {
									die("ErrSelecCiv : erreur lors de la sélection des civilités dans admin_gestion_eleves_composant_graph.php<br>
										Message d'erreur : ".$e->getMessage());
								}
								if($lesEnregs->rowCount()>0) {
									foreach ($lesEnregs as $enreg) {
										if($lst_epreuve == $enreg->idEpr){
											echo "<option class='form-group' selected value='$enreg->idEpr'>$enreg->discLib $enreg->natLibe</option>";
										} else {
											echo "<option class='form-group' value='$enreg->idEpr'>$enreg->discLib $enreg->natLibe</option>";
										}																	
									}
								}
							}
						}
					?>
				</select>
			</div>
		</div>

		<div >
			<input type="submit" name="btn_valider" value="Valider" />
		</div> 

		<input type="hidden" name="idEle" value="<?php echo $idEle;?>"/> 
		<input type="hidden" name="idEpre" value="<?php echo $idEpre;?>"/>
			
</form>
</div>	
		<?php
			echo $msg;
		?>	
</section>
	</body>
</html>
<?php include "assets_bas.php"?>
