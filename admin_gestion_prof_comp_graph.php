<div class="container">
	<div class="row d-flex justify-content-center">
		
		<div class="col-6">
			<div class="border">
				<div class="form-group">
					<!-- radio bouton avec la civilité -->
					<label  class="col-md-4" for="mr"><b>Civilité</b></label>
					<div class="col-md-12">
						<?php
						echo"<div class='form-check form-check-inline'>";
						if ($rbt_civilite =='1') {
							echo "<input class='form-check-input' type='radio' name='rbt_civilite' id='mr' value='1'/> Monsieur";
						}else{
							echo "<input class='form-check-input' type='radio'  name='rbt_civilite' id='mr' value='1'/> Monsieur";
						}
						echo"</div>";
						echo"<div class='form-check form-check-inline'>";
						if($rbt_civilite=='2'){
							echo "<input class='form-check-input' type='radio' checked name='rbt_civilite' id='mme' value='2'/> Madame";
						}else{
							echo "<input class='form-check-input' type='radio' checked name='rbt_civilite' id='mme' value='2'/> Madame";
						}
						echo"</div>";
						?>
					</div>
				</div>

				<!-- textbox contenant le nom -->
				<div class="form-group">
					<label class="col-md-4"><b>Nom</b></label>
					<div class="col-md-12">
						<input class="form-control" type='text' placeholder="Saisissez le nom" name="txt_nom" id="nom" value="<?php echo $txt_nom; ?>" required />
					</div>
				</div>

				<!-- textbox contenant le prénom -->
				<div class="form-group">
					<label class="col-md-4"><b>Prénom</b></label>
					<div class="col-md-12">
						<input class="form-control" type='text' placeholder="Saisissez le prénom"name="txt_prenom" id="prenom" value="<?php echo $txt_prenom; ?>"required />
					</div>
				</div>

				<!-- textbox contenant le mail -->
				<div class="form-group">
					<label class="col-md-4"><b>Mail</b></label>
					<div class="col-md-12">
						<input  class="form-control" type='text' placeholder="Saisissez le mail" name="txt_mail" id="mail" value="<?php echo $txt_mail; ?>" required />
					</div>
				</div>

				<!-- Liste déroulante avec les dicipline -->
				<div class="form-group">
					<label class="col-md-4"><b>Discipline</b></label>
					<div class="col-md-12">
						<select class="custom-select custom-select" required name="lst_discipline" id="discipline">
							
							<?php
							include "connexion_bd_gesoraux.php";
							//exécution de la requête (avec la méthode query) pour obtenir le contenu de la table 
							// on récupère le résultat de la requête dans le tableau $lesenregs
							try{
								$lesEnregs=$bdd->query("SELECT id, libelle from discipline");
							}catch(PDOException $e) {
								echo("err BDSelect : erreur de lecture table fonction dans employe_ajout.php<br>
									Message d'erreur : ".$e->getMessage());
							}
							//on teste si le select a retourné des enregistrement
							if($lesEnregs->rowCount() > 0)
							{
								//pour chaque enregistrement retourné par la requête SQL, on crée une option dans la liste
								//l'attribut value contiendra l'id (l'identifiant de la fonction)
								// et le libellé de la fonction sera affiché
								
								foreach($lesEnregs as $enreg) {
									if($lst_discipline == $enreg->id){
										echo "<option class='form-group' selected value='$enreg->id'>$enreg->libelle</option>";
									}else{
										echo"<option class='form-group' value='$enreg->id'>$enreg->libelle</option>";
									}
									
								}
							}
							?>
						</select>
					</div>
				</div>
				<!-- Liste déroulante avec les salles  -->
				<div class="form-group">
					<label class="col-md-4"><b>Salle Attitrée</b></label>
					<div class="col-md-12">
						<select class="custom-select custom-select" name="lst_salle" id="salle"><br>
							<option value="0">Aucune</option>
							<?php
							include "connexion_bd_gesoraux.php";
									//exécution de la requête (avec la méthode query) pour obtenir le contenu de la table
									// on récupère le résultat de la requête dans le tableau $lesenregs
							try{
								$lesEnregs=$bdd->query("SELECT id, libelle from salle");
							}catch(PDOException $e) {
								echo("err BDSelect : erreur de lecture table fonction dans employe_ajout.php<br>
									Message d'erreur : ".$e->getMessage());
							}
									//on teste si le select a retourné des enregistrement
							if($lesEnregs->rowCount() > 0)
							{
										//pour chaque enregistrement retourné par la requête SQL, on crée une option dans la liste
										//l'attribut value contiendra l'id (l'identifiant de la salle)
										// et le libellé de la salle sera affiché
										
								foreach($lesEnregs as $enreg) {
									if($lst_salle == $enreg->id){
										echo "<option class='form-group' selected value='$enreg->id'>$enreg->libelle</option>";
									}else{
										echo"<option class='form-group' value='$enreg->id'>$enreg->libelle</option>";
									}
									
								}
							}
							?>
						</select>
					</div>
				</div>
				
				<!-- bouton valider -->
				<div class="form-group d-flex justify-content-center">
					<input class='btn btn-success btn-lg' type="submit" name="btn_valider" value="Valider" />
				</div>
			</div>
		</div>
	</div>
</div>





