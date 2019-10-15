
	<div class="row">
		<div class="col">
		</div>
		<div class="col-6">
			<div class="border border-dark rounded rounded-lg">
				<div class="form-group">
					<label class="col-md-4"><b>Nom :</b></label> 
					<div class="col-md-12">
						<input class="form-control" type="text" name="txt_nom" value="<?php echo $txt_nom;?>" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4"><b>Prénom :</b></label><br>
					<div class="col-md-12">
						<input class="form-control" type="text" name="txt_prenom" value="<?php echo $txt_prenom;?>" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-5"><b>Date de naissance :</b></label><br>
					<div class="col-md-12">
						<input class="form-control" type="Date" name="txt_dateNai" value="<?php echo $txt_dateNai;?>" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4"><b>Tiers-temps :</b></label><br>
					<div class="col-md-12">
						<?php
							echo"<div class='form-check form-check-inline'>";
							if($rbt_tiersTemps == "O"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_tiersTemps' id='tiersOui' value='O'>Oui";
							} else {
								echo "<input class='form-check-input' type='radio'  name='rbt_tiersTemps' id='tiersOui' value='O'>Oui";
							}
							echo"</div>";
							echo"<div class='form-check form-check-inline'>";
							if($rbt_tiersTemps == "N"){
								echo "<input class='form-check-input' type='radio' checked name='rbt_tiersTemps' id='tiersNon' value='N'>Non";
							} else {
								echo "<input class='form-check-input' type='radio' name='rbt_tiersTemps' id='tiersNon' value='N'>Non";
							}
							echo"</div>";
						?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4"><b>Civilité :</b></label><br>
					<div class="col-md-12">
						<select class="custom-select custom-select" name="lst_civilite" required>
							<?php 
								include "connexion_bd_gesoraux.php";
								try{
									$lesEnregs=$bdd->query("SELECT id,libelle from civilite");
								} catch(PDOException $e) {
									die("ErrSelecCiv : erreur lors de la sélection des civilités dans admin_gestion_eleves_composant_graph.php<br>
										Message d'erreur : ".$e->getMessage());
								}
								if($lesEnregs->rowCount()>0) {
									foreach ($lesEnregs as $enreg) {
										if($lst_civilite == $enreg->libelle){
											echo "<option class='form-group' selected value='$enreg->id'>$enreg->libelle</option>";
										} else {
											echo "<option class='form-group' value='$enreg->id'>$enreg->libelle</option>";
										}
									}
								}
							?>		
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4"><b>Division :</b></label><br>
					<div class="col-md-12">
						<select class="custom-select custom-select" name="lst_division" required>
							<?php 
								try{
									$lesEnregs=$bdd->query("SELECT id,libelle from division");
								} catch(PDOException $e) {
									die("ErrSelecDiv : erreur lors de la sélection des divisions dans admin_gestion_eleves_composant_graph.php<br>
										Message d'erreur : ".$e->getMessage());
								}
								if($lesEnregs->rowCount()>0) {
									foreach ($lesEnregs as $enreg) {
										if($lst_division == $enreg->libelle){
											echo "<option class='form-group' selected value='$enreg->id'>$enreg->libelle</option>";
										} else {
											echo "<option class='form-group' value='$enreg->id'>$enreg->libelle</option>";
										}
									}
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4"><b>Section :</b></label><br>
					<div class="col-md-12">
						<select class="custom-select custom-select" name="lst_section">
							<?php 
								try{
									$lesEnregs=$bdd->query("SELECT id,libelle from section");
								} catch(PDOException $e) {
									die("ErrSelecCiv : erreur lors de la sélection des civilités dans admin_gestion_eleves_composant_graph.php<br>
										Message d'erreur : ".$e->getMessage());
								}
								if($lesEnregs->rowCount()>0) {
									echo"<option value=0>Choisissez une section si il y en a une.</option>";
									foreach ($lesEnregs as $enreg) {
										if($lst_section == $enreg->libelle){
											echo "<option class='form-group' selected value='$enreg->id'>$enreg->libelle</option>";
										} else {
											echo "<option class='form-group' value='$enreg->id'>$enreg->libelle</option>";
										}
									}
								}
							?>
						</select>
					</div>
				</div>	
