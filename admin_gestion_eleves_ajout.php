<?php 
	include"connexion_bd_gesoraux.php";

	// Initialisation variable
	$msg="";
	$txt_nom="";
	$txt_prenom="";
	$txt_dateNai="";
	$rbt_tiersTemps="N";
	$lst_civilite="";
	$lst_division="";
	$lst_section="";
	$rbt_benefLV1="N";
	$rbt_benefLV2="N";
	$rbt_derogLV1="N";
	$rbt_derogLV2="N";
	$lst_epreuveLV1="";
	$lst_epreuveLV2="";


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
		if (isset($rbt_benefLV1)==false) {
			$msg=$msg."Le bénéfice LV1 n'a pas été sélectionné.<br>";
		} 
		if (isset($rbt_benefLV2)==false) {
			$msg=$msg."Le bénéfice LV2 n'a pas été sélectionné.<br>";
		} 
		if (isset($rbt_derogLV1)==false) {
			$msg=$msg."La dérogation LV1 n'a pas été sélectionné.<br>";
		} 
		if (isset($rbt_derogLV2)==false) {
			$msg=$msg."La dérogation LV2 n'a pas été sélectionné.<br>";
		} 
		if (isset($lst_epreuveLV1)==false) {
			$msg=$msg."L'épreuve LV1 n'a pas été sélectionné.<br>";
		} 
		if (isset($lst_epreuveLV2)==false){
			$msg=$msg."L'épreuve LV2 n'a pas été sélectionné.<br>";
		} 

		if($msg==""){
			try{
				//insertion de l'élève
				$insert_eleve=$bdd->prepare("INSERT into eleve values(0,:par_nom, :par_prenom,:par_date,:par_tiers,:par_idCivilite,:par_idSection,:par_idDivision)");
				
				$insert_eleve->bindValue(':par_nom', strtoupper($txt_nom), PDO::PARAM_STR);
				$insert_eleve->bindValue(':par_prenom', strtoupper($txt_prenom), PDO::PARAM_STR);
				$insert_eleve->bindValue(':par_date', $txt_dateNai, PDO::PARAM_STR);
				$insert_eleve->bindValue(':par_tiers', $rbt_tiersTemps, PDO::PARAM_STR);
				$insert_eleve->bindValue(':par_idCivilite', $lst_civilite, PDO::PARAM_INT);
				if(isset($lst_section)== true && $lst_section>0){
					$sect=$lst_section;
				} else {
					$sect=null;
				}
				$insert_eleve->bindValue(':par_idSection', $sect, PDO::PARAM_INT);
				$insert_eleve->bindValue(':par_idDivision', $lst_division, PDO::PARAM_INT);
				
				$insert_eleve->execute();
				$idEleve=$bdd->lastInsertId();
			} catch(PDOException $e) {
				die("ERRInsertEleve : Erreur lors de l'insertion d'un élève dans admin_gestion_eleves_ajout_exec.php <br>Message d'erreur".$e->getMessage());
			}

			try{
				$insert_epreuve1=$bdd->prepare("INSERT into passageepreuve values(0,:par_benef,:par_derog,:par_absence,:par_idElev,:par_idDemiJournee,:par_idPlage,:par_idEpreuve,:par_idProfChoix,:par_idSalle,:par_idProfAffecte)");

				$insert_epreuve1->bindValue(':par_benef',$rbt_benefLV1,PDO::PARAM_STR);
				$insert_epreuve1->bindValue(':par_derog',$rbt_derogLV1,PDO::PARAM_STR);
				$insert_epreuve1->bindValue(':par_absence',null,PDO::PARAM_STR);
				$insert_epreuve1->bindValue(':par_idElev',$idEleve,PDO::PARAM_INT);
				$insert_epreuve1->bindValue(':par_idDemiJournee',null,PDO::PARAM_STR);
				$insert_epreuve1->bindValue(':par_idPlage',null,PDO::PARAM_STR);
				$insert_epreuve1->bindValue(':par_idEpreuve',$lst_epreuveLV1,PDO::PARAM_INT);
				$insert_epreuve1->bindValue(':par_idProfChoix',null,PDO::PARAM_STR);
				$insert_epreuve1->bindValue(':par_idSalle',null,PDO::PARAM_STR);
				$insert_epreuve1->bindValue(':par_idProfAffecte',null,PDO::PARAM_STR);

				$insert_epreuve1->execute();

			} catch(PDOException $e) {
				die("ErrInsertEpreuve1 : Erreur lors de l'insertion de l'épreuve 1 dans admin_gestion_eleves_ajout_exec.php<br>Message d'erreur : ".$e->getMessage());
			}
			try{
				$insert_epreuve2=$bdd->prepare("INSERT into passageepreuve values(0,:par_benef,:par_derog,:par_absence,:par_idElev,:par_idDemiJournee,:par_idPlage,:par_idEpreuve,:par_idProfChoix,:par_idSalle,:par_idProfAffecte)");

				$insert_epreuve2->bindValue(':par_benef',$rbt_benefLV2,PDO::PARAM_STR);
				$insert_epreuve2->bindValue(':par_derog',$rbt_derogLV2,PDO::PARAM_STR);
				$insert_epreuve2->bindValue(':par_absence',null,PDO::PARAM_STR);
				$insert_epreuve2->bindValue(':par_idElev',$idEleve,PDO::PARAM_INT);
				$insert_epreuve2->bindValue(':par_idDemiJournee',null,PDO::PARAM_STR);
				$insert_epreuve2->bindValue(':par_idPlage',null,PDO::PARAM_STR);
				$insert_epreuve2->bindValue(':par_idEpreuve',$lst_epreuveLV2,PDO::PARAM_INT);
				$insert_epreuve2->bindValue(':par_idProfChoix',null,PDO::PARAM_STR);
				$insert_epreuve2->bindValue(':par_idSalle',null,PDO::PARAM_STR);
				$insert_epreuve2->bindValue(':par_idProfAffecte',null,PDO::PARAM_STR);

				$insert_epreuve2->execute();

			} catch(PDOException $e) {
				die("ErrInsertEpreuve2 : Erreur lors de l'insertion de l'épreuve 2 dans admin_gestion_eleves_ajout_exec.php<br>Message d'erreur : ".$e->getMessage());
			}
			$msg="L'élève a bien été ajouté.";

			header('Location:admin_gestion_eleves_consultation.php?msg='.$msg);
		}
	}
	echo($msg);
?>
<?php include "assets_haut_admin.php"?>
<section>

<div class="container">
		<header>
			<br>
			<h1 class="text-center">Ajout d'un élève</h1><br>
		</header>
		
			<form class="" action="" method="post">		
				<?php
					include"admin_gestion_eleves_composant_graph.php";
				?>
				<div class="form-group">
					<label class="col-md-4"><b>Bénéficiaire LV1 :</b></label><br>
					<div class="col-md-12">
						<?php
							echo"<div class='form-check form-check-inline'>";
							if($rbt_benefLV1 == "O"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_benefLV1' id='benefLV1Oui' value='O'>Oui";
							} else {
								echo "<input class='form-check-input' type='radio'  name='rbt_benefLV1' id='benefLV1Oui' value='O'>Oui";
							}
							echo"</div>";
							echo"<div class='form-check form-check-inline'>";
							if($rbt_benefLV1 == "N"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_benefLV1' id='benefLV1Non' value='N'>Non";
							} else {
								echo "<input class='form-check-input' type='radio' name='rbt_benefLV1' id='benefLV1Non' value='N'>Non";
							}
							echo"</div>";
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4"><b>Bénéficiaire LV2 :</b></label><br>
					<div class="col-md-12">
						<?php
							echo"<div class='form-check form-check-inline'>";
							if($rbt_benefLV2 == "O"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_benefLV2' id='benefLV2Oui' value='O'>Oui";
							} else {
								echo "<input class='form-check-input' type='radio'  name='rbt_benefLV2' id='benefLV2Oui' value='O'>Oui";
							}
							echo"</div>";
							echo"<div class='form-check form-check-inline'>";
							if($rbt_benefLV2 == "N"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_benefLV2' id='benefLV2Non' value='N'>Non";
							} else {
								echo "<input class='form-check-input' type='radio' name='rbt_benefLV2' id='benefLV2Non' value='N'>Non";
							}
							echo"</div>";
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4"><b>Dérogation LV1 :</b></label><br>
					<div class="col-md-12">
						<?php
							echo"<div class='form-check form-check-inline'>";
							if($rbt_derogLV1 == "O"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_derogLV1' id='derogLV1Oui' value='O'>Oui";
							} else {
								echo "<input class='form-check-input' type='radio'  name='rbt_derogLV1' id='derogLV1Oui' value='O'>Oui";
							}
							echo"</div>";
							echo"<div class='form-check form-check-inline'>";
							if($rbt_derogLV1 == "N"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_derogLV1' id='derogLV1Non' value='N'>Non";
							} else {
								echo "<input class='form-check-input' type='radio' name='rbt_derogLV1' id='derogLV1Non' value='N'>Non";
							}
							echo"</div>";
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4"><b>Dérogation LV2 :</b></label><br>
					<div class="col-md-12">
						<?php
							echo"<div class='form-check form-check-inline'>";
							if($rbt_derogLV2 == "O"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_derogLV2' id='derogLV2Oui' value='O'>Oui";
							} else {
								echo "<input class='form-check-input' type='radio'  name='rbt_derogLV2' id='derogLV2Oui' value='O'>Oui";
							}
							echo"</div>";
							echo"<div class='form-check form-check-inline'>";
							if($rbt_derogLV2 == "N"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_derogLV2' id='derogLV2Non' value='N'>Non";
							} else {
								echo "<input class='form-check-input'type='radio' name='rbt_derogLV2' id='derogLV2Non' value='N'>Non";
							}
							echo"</div>";
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4"><b>Epreuve LV1 :</b></label><br>
					<div class="col-md-12">
						<select class="custom-select custom-select" name="lst_epreuveLV1">
							<?php 
								$natuId1=1;
								try{
									$lesEnregs=$bdd->query("SELECT epreuve.id as idEpr, discipline.libelle as discLib, natureepreuve.libelle as natLibe from epreuve join discipline on discipline.id=idDiscipline join natureepreuve on idNatureEpreuve=natureepreuve.id where natureepreuve.id=$natuId1");
								} catch(PDOException $e) {
									die("ErrSelecCiv : erreur lors de la sélection des civilités dans admin_gestion_eleves_composant_graph.php<br>
										Message d'erreur : ".$e->getMessage());
								}
								if($lesEnregs->rowCount()>0) {
									foreach ($lesEnregs as $enreg) {
										if($lst_epreuveLV1 == $enreg->idEpr){
											echo "<option class='form-group' selected value='$enreg->idEpr'>$enreg->discLib $enreg->natLibe</option>";
										} else {
											echo "<option class='form-group' value='$enreg->idEpr'>$enreg->discLib $enreg->natLibe</option>";
										}																	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4"><b>Epreuve LV2 :</b></label><br>
					<div class="col-md-12">
						<select class="custom-select custom-select" name="lst_epreuveLV2">
							<?php 
							$natuId2=2;
								try{
									$lesEnregs=$bdd->query("SELECT epreuve.id as idEpr, discipline.libelle as discLib, natureepreuve.libelle as natLibe from epreuve join discipline on discipline.id=idDiscipline join natureepreuve on idNatureEpreuve=natureepreuve.id where natureepreuve.id=$natuId2");
								} catch(PDOException $e) {
									die("ErrSelecCiv : erreur lors de la sélection des civilités dans admin_gestion_eleves_composant_graph.php<br>
										Message d'erreur : ".$e->getMessage());
								}
								if($lesEnregs->rowCount()>0) {
									foreach ($lesEnregs as $enreg) {
										if($lst_epreuveLV2 == $enreg->idEpr){
											echo "<option class='form-group' selected value='$enreg->idEpr'>$enreg->discLib $enreg->natLibe</option>";
										} else {
											echo "<option class='form-group' value='$enreg->idEpr'>$enreg->discLib $enreg->natLibe</option>";
										}																	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group d-flex justify-content-center">
					<input class='btn btn-success btn-lg' type="submit" name="btn_valider" value="Valider" />
				</div>
				<?php
					echo $msg;
				?>	
				
			</form>
		</div>
	</div>
	<div class="col">
</div>	
</div>
</div>
</div>
</div>
</section>
<?php include "assets_bas.php"?>