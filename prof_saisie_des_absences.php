
<?php
include "assets_haut_prof.php";
$id  = $_SESSION['id'];				
include"connexion_bd_gesoraux.php"

?>

            <section>
				<div>
					<h1 class="text-center">Saisie des élèves absents</h1> <br>
					<form action ="" method="POST">
						<?php
							$msg = "";
							try{
								$lesDemijournees=$bdd->query("SELECT demijournee.id as 'idDemi' , idUtilisateur , date , matinAprem from choixprofdemijournee
								join demijournee on idDemiJournee = demijournee.id
								where idUtilisateur = ".$id." ");
							}catch(PDOException $e){
								echo("ERR BDSelect : erreur de lecture table 
									<br>Message d'erreur:".$e->getMessage());
							}
								
							if($lesDemijournees->rowCount () >0) {
								echo "<select class='form-control' name='demijournee' id='demijournee' onchange='this.form.submit();'>";
								echo "<option value= '0'>Veuillez sélectionner une plage horaire</option>";
								foreach ($lesDemijournees as $demijournee){
									list($year, $month, $day) = explode("-", $demijournee->date);
									$date_fr = $day."/".$month."/".$year;
									
									if ($demijournee == $demijournee->idDemi) {
										echo "<option selected value='$demijournee->idDemi'>$date_fr $demijournee->matinAprem</option>";
									}else{
										echo "<option value='$demijournee->idDemi'>$date_fr $demijournee->matinAprem</option>";
									}
								}
								echo "</select>";					
							} else{
								echo "<br><h4 class='erreur'>Consultation impossible : aucun enregistrement n'a été effectué</h4>";
							}
							
							if (isset ($_POST['demijournee']) == true && $_POST['demijournee']>0) {	
														
								try {
									$lesEnregs=$bdd->query("SELECT absence , passageepreuve.idDemiJournee , demijournee.date, eleve.nom as 'nom', eleve.prenom as 'prenom', division.libelle as 'division', natureepreuve.libelle as 'natureepreuve', plage.heureDebut as 'heurepassage' , passageepreuve.id as 'idPassage'
									from passageepreuve 
									left outer join utilisateur on idProfChoix=utilisateur.id 
									left outer join eleve on idEleve=eleve.id 
									join division on idDivision=division.id 
									join epreuve on idEpreuve=epreuve.id 
									join natureepreuve on idNatureEpreuve=natureepreuve.id 
									join plage on idPlage=plage.id 
									join demijournee on idDemijournee = demijournee.id 
									where idDemiJournee = ".$_POST['demijournee'].
									" order by eleve.nom ");

								
								}catch(PDOException $e){
									echo("ERR BDSelect : erreur de lecture table 
									<br>Message d'erreur:".$e->getMessage());
								}

								
								if ($lesEnregs->rowCount () ==0) {
									echo "<br> Il n'y a aucun élèves sur cette plage horaire";
								} else {				
									echo "<br><table class='table table-striped text-center'>";
									echo "<thead class='thead-dark'>";
									echo "<tr>"; 
									echo "<th scope='col'>Nom</th>";
									echo "<th scope='col'>Prénom</th>";
									echo "<th scope='col'>Division</th>";
									echo "<th scope='col'>Discipline</th>";
									echo "<th scope='col'>Heure de passage</th>";
									echo "<th scope='col'>Absence</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									foreach ($lesEnregs as $enreg) {
										echo"<tr>";
										echo"<td>$enreg->nom</td>";
										echo "<td>$enreg->prenom</td>";
										echo "<td>$enreg->division</td>";
										echo "<td>$enreg->natureepreuve</td>";
										echo "<td>$enreg->heurepassage</td>";			
										if($enreg->absence =='O'){							
											echo"<td><input type='checkbox' checked name='Abs$enreg->idPassage' value='$enreg->idPassage'/></input></td>";
										}
										else{
											echo "<td><input type='checkbox' name='Abs$enreg->idPassage' value='$enreg->idPassage'/></input></td>";
										}						
										echo "</tr>";						
									}
									echo "</tbody>";
									echo"</table>";
									echo"<div class='d-flex justify-content-center'>";
									echo'<input type="submit" class="btn btn-success btn-lg" name="btn_valider" id="btn_valider" value="Soumettre" />';
									echo "</div>";
								}
							}	
											
							$valeur="";
							$val_abs="";
							if(isset($_POST['btn_valider'])== true){
								extract($_POST);
								
								try{
									$req=$bdd->prepare("UPDATE passageepreuve set absence ='N' where absence = 'O' ");									
									$req->execute();		
								}catch(PDOException $e){
									echo("ErrBDUpdate : erreur update table <br>
										Message d'erreur :" .$e->getMessage());									
								}
								foreach($_POST as $cle=>$valeur){
									
									if(strpos($cle,"abs")==0 ){
										try{
											$req=$bdd->prepare("UPDATE passageepreuve set absence =:par_absence where id =:par_idabsence  ");
											$req->bindValue(':par_absence', 'O', PDO::PARAM_STR);
											$req->bindValue(':par_idabsence', $valeur, PDO::PARAM_INT);
											$req->execute();		
										}catch(PDOException $e){
											echo("ErrBDUpdate : erreur update table <br>
												Message d'erreur :" .$e->getMessage());
										}
									}
								} 
								$msg = "La modification a bien été effectuée";	
								echo $msg; 
							}				
					?>
					</form>
				</div>
            </section>
         <?php include "assets_bas.php"?>