 <?php include "assets_haut_admin.php"?>
<script> 
    function confirmer_suppres()
        {
            return(confirm('Etes-vous sûr de vouloir supprimer cet élève ainsi que ses épreuves.'));
        }</script> 

   
    		<section>

    			<?php
    			if(isset($_GET['msg'])==true){
    				$msg=$_GET['msg'];
    			} else {
    				$msg="";
    			}
    			?>
    			<header>
    				<br>
    				<h1 class="text-center">Consultation des élèves</h1>
    			</header>

    			<!--<?php // include "nav_admin.html" ?> !-->

    			<section class="">
    				
    					<div class="col "></div>
    						<br>
    						<div class="d-flex justify-content-center">
    							<a href='admin_gestion_eleves_ajout.php'>
    								<input class="btn btn-success btn-lg" type='button' name='AjoutEleve' value='Ajouter un élève'/>
    							</a>

    						</div>
    						<br>	
    						<?php 
    						if($msg != ""){
    							echo"<div class='alert alert-success'>";
    							echo $msg; 
    							echo "</div>";
    						}
    						?>

    						<br>

    						<div class="d-flex justify-content-center">
    							<?php 



    							include "connexion_bd_gesoraux.php";
					// Sélection des informations 
    							try {

    								$lesEnregs=$bdd->query("SELECT eleve.id as eleId,nom,prenom,dateNaissance,tiersTempsON,section.libelle as secLib,division.libelle as divLib,civilite.libelle as civLib,passageepreuve.id as pasId,inscritBenef,derogation,discipline.libelle as disLib,natureepreuve.libelle as natLib from passageepreuve 
    									join eleve on idEleve=eleve.id
    									left outer join section on idSection=section.id 
    									join division on idDivision=division.id 
    									join civilite on idCivilite=civilite.id 
    									join epreuve on idEpreuve=epreuve.id 
    									join natureepreuve on idNatureEpreuve=natureepreuve.id 
    									join discipline on idDiscipline=discipline.id 
    									order by nom");


						// affichage de la première ligne du tableau
    								echo "<table class ='table table-striped text-center'>";
    								echo"<thead class='thead-dark'>";
    								echo "<tr>";
    								echo "<th>Nom</th>";
    								echo "<th>Prénom</th>";
    								echo "<th>Date de Naissance</th>";
    								echo "<th>Civilité</th>";
    								echo "<th>Section</th>";
    								echo "<th>Division</th>";
    								echo "<th>Nature Epreuve</th>";
    								echo "<th>Langue</th>";
    								echo "<th>Tiers-Temps</th>";
    								echo "<th>Bénéfice</th>";
    								echo "<th>Dérogation</th>";

    								echo "<th>Modifier</th>";
    								echo "<th>Supprimer</th>";
    								echo "</tr>";
    								echo "</thead>";

					    // affichage des caractéristiques de chaque élève
    								foreach($lesEnregs as $enreg) {
    									echo "<tr>";
    									echo "<td>$enreg->nom</td>";
    									echo "<td>$enreg->prenom</td>";

    									list($year, $month, $day) = explode("-", $enreg->dateNaissance);
    									$date_fr = $day."/".$month."/".$year;

    									echo "<td>$date_fr</td>";
    									echo "<td>$enreg->civLib</td>";
    									echo "<td>$enreg->secLib</td>";
    									echo "<td>$enreg->divLib</td>";
    									echo "<td>$enreg->natLib</td>";
    									echo "<td>$enreg->disLib</td>";
    									echo "<td>$enreg->tiersTempsON</td>";
    									echo "<td>$enreg->inscritBenef</td>";
    									echo "<td>$enreg->derogation</td>";

				    		// boutton modif et supprimer
    									echo "<td><a href ='admin_gestion_eleves_modification.php?idElev=$enreg->eleId&idEp=$enreg->pasId'>
    									<input class='btn btn-info' type='button' name='Modifier' value='Modifier'/></a></td>";
    									echo "<td><a href ='admin_gestion_eleves_suppression.php?idElev=$enreg->eleId&idEp=$enreg->pasId' onclick='return confirmer_suppres();'>
    									<input class='btn btn-danger'type='button' name='Supprimer' value='Supprimer'/></a></td>";

    								}
    								echo "</table>";
    							} catch(PDOException $e) {
    								die("ErrSelectEleEpre : erreur de selection des élèves ou des passages épreuve dans admin_gestio_eleves_consultation.php
    									<br>Message d'erreur : " .$e->getMessage());
    							}				
    							?>		
    						</div>		
    					</div>
    				</div>
    			</div>
    		</section>
    	</section>
    <?php include "assets_bas.php"?>
