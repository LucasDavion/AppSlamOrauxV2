 <!-- inclusion des assets -->
 <?php include "assets_haut_admin.php"?>
 <!-- fonction js permetant de confirmer la suppression -->
	<script>
		function confirmer_suppres(){
			return(confirm("Etes-vous sûr de vouloir supprimer cette plage d'interrogation ?"))
		}
	</script>
  <div class=container>
		<center><h1>Gestion des plages d'interrogations</h1><hr></center>
		<div class=form-group>
			<!-- Bouton pour accéder à admin_gestion_plageinterrogation_ajout.php -->
			<center><a href="admin_gestion_plageinterrogation_ajout.php"><input type="submit" class="btn btn-success btn-lg" nane="ajout_salle" value="Ajout d'une plage d'interrogation" /></a></center><br>
			<?php
			// connexion bdd
			include "connexion_bd_gesoraux.php";
			try{
				// requête de récuperation des plage d'interrogation
				$lesEnregs=$bdd->query("select * from plage order by time(heureDebut)");
			}catch (PDOException $e) {
				die("Err BDSelect dans admin_gestion_plageinterrogation.php");
			}
			// on verifie que la requête récupère bien des enregistrements
			if($lesEnregs->rowCount()==0){
				echo("Aucune plage d'interrogation n'a été enregistré");

			}else{
				// si oui affichage des enregistrements dans un tableau pour la consultation
				echo "<table class='table table-striped text-center'>";
				echo"<thead class='thead-dark'><tr>";
				echo"<th scope='col'>Heure de début</th>";
				echo"<th scope='col'>Heure de fin</th>";
				echo"<th scope='col'>Nombre d'élèves</th>";				
				echo"<th scope='col'>Suppression</th></thead>";

				echo"</tr>";
				foreach ($lesEnregs as $enreg) {
					echo"<tr>";
					echo"<td>$enreg->heureDebut</td>";
					echo"<td>$enreg->heureFin</td>";
					echo"<td>$enreg->nbMaxEleve</td>";					
					// redirection vers admin_gestion_plageinterrogation_suppression.php
					echo "<td><a href='admin_gestion_plageinterrogation_suppression.php?id=$enreg->id' onclick='return confirmer_suppres();'><input type='submit' class='btn btn-danger' name='btn_supp' value='Supprimer' /></a></td>";
					echo"</tr>";
				}
				echo "</table><br><br>";
			}
			?>
		</div>
  </div>
   <!-- inclusion des assets -->
 <?php include "assets_bas.php"?>

