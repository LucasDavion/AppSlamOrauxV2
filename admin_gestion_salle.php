 <!-- inclusion des assets -->
 <?php include "assets_haut_admin.php"?>
 <!-- fonction js permetant de confirmer la suppression -->
	<script>
		function confirmer_suppres(){
			return(confirm('Etes-vous sûr de vouloir supprimer cette salle ?'))
		}
	</script>
  <div class=container>
		<center><h1>Gestion des salles</h1><hr></center>
		<div class=form-group>
			<!-- Bouton pour accéder à admin_gestion_salle_ajout.php -->
			<center><a href="admin_gestion_salle_ajout.php"><input type="submit" class="btn btn-success btn-lg" nane="ajout_salle" value="Ajout d'une salle" /></a></center><br>
			<?php
			// connexion bdd
			include "connexion_bd_gesoraux.php";
			try{
				// requête de récuperation des salles
				$lesEnregs=$bdd->query("select * from salle");
			}catch (PDOException $e) {
				die("Err BDSelect dans admin_gestion_salle.php");
			}
			// on verifie que la requête récupère bien des enregistrements
			if($lesEnregs->rowCount()==0){
				echo("Aucune salle n'a été enregistré");

			}else{
				// si oui affichage des enregistrements dans un tableau pour la consultation
				echo "<table class='table table-striped text-center'>";
				echo"<thead class='thead-dark'><tr>";
				echo"<th scope='col'>Salle</th>";
				echo"<th scope='col'>suppression</th></thead>";

				echo"</tr>";
				foreach ($lesEnregs as $enreg) {
					echo"<tr>";
					echo"<td>$enreg->libelle</td>";
					// redirection vers admin_gestion_salle_suppression.php
					echo "<td><a href='admin_gestion_salle_suppression.php?id=$enreg->id' onclick='return confirmer_suppres();'><input type='submit' class='btn btn-danger' name='btn_supp' value='Supprimer' /></a></td>";
					echo"</tr>";
				}
				echo "</table><br><br>";
			}
			?>
		</div>
  </div>
   <!-- inclusion des assets -->
 <?php include "assets_bas.php"?>

