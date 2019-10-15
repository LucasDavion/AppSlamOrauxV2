<?php include "assets_haut_admin.php"?>
    		<section>
<script>
        function confirmer_suppres()
        {
            return(confirm('Êtes-vous sûr de vouloir supprimer les informations de ce professeur ?'));
        }
    </script>

    			<?php
    			if(isset($_GET['msg'])==true){
    				$msg=$_GET['msg'];
    			} else {
					$msg="";
				}
    			?>
    			<header>
    				<br>
    				<h1 class="text-center">Consultation des professeurs </h1>
    			</header>
    			<div class="">
    				<div class="">
    					<div class="col">
    						<br>
    						<div class="d-flex justify-content-center">
    							<a href="admin_gestion_prof_ajout.php"> <input class="btn btn-success btn-lg" type="button" name="btn_ajout_prof" value="Ajouter un professeur"></a>
    						</div>
    						<br>
    						<?php 
    						if($msg != ""){
    							echo"<div class='alert alert-success'>";
    							echo $msg; 
							}
							
    						?>
    					</div>
    					<br>
    					
    					<div class="d-flex justify-content-center">
    						
    						<div class="table table-striped">
    							<?php
    							include "connexion_bd_gesoraux.php";
    							try{
    								$lesEnregs=$bdd->query("SELECT utilisateur.id as 'idUtilisateur',nom, prenom, mail, discipline.libelle as 'discipline', 
    									salle.libelle as 'salle'
    									FROM utilisateur 
    									left outer join discipline on idDiscipline = discipline.id 
    									left outer join salle on idSalleAtt = salle.id
    									Order BY nom"); 
    								if($lesEnregs->rowCount()==0) {
									//le SELECT n'a pas retournée d'enregistrement : on affiche un message d'erreur
    									echo("Aucun professeur n'a été enregistré");
    								} else {
									//-----------------------------------------------------------------------
									//le SELECT a retourné un ou plusieur enregistrements
									//pour chaque enregistrement, on affiche le nom, le prénom, l'email,
									// la discipline et la salle attitrée
									//-----------------------------------------------------------------------
									//affichage de la première ligne du tableau
    									echo" <table class ='table table-striped text-center'>";
    									echo" <thead class='thead-dark'>";
    									echo" <tr>";
    									echo "<th>Nom</th>";
    									echo "<th>Prénom</th>";
    									echo "<th>E-mail</th>";
    									echo "<th>Discipline</th>";
    									echo "<th>Salle</th>";
    									echo "<th>Modifier</th>";
    									echo "<th>Supprimer</th>";
    									echo" </tr>";
    									echo"</tr>";
									// affichage des caractéristiques de chaque professeur
    									foreach($lesEnregs as $enreg){
    										echo" <tr>";
    										echo "<td> $enreg->nom</td>";
    										echo "<td> $enreg->prenom</td>";
    										echo "<td> $enreg->mail</td>";
    										echo "<td> $enreg->discipline</td>";
    										echo "<td> $enreg->salle</td>";
    										echo"<td> <a href='admin_gestion_prof_modif.php?id=$enreg->idUtilisateur'> <input class='btn btn-info' type='button' name='btn_modif_prof' value='Modifier'> </a> </td>";
    										echo"<td> <a href='admin_gestion_prof_supp.php?id=$enreg->idUtilisateur' onclick='return confirmer_suppres();'> <input class='btn btn-danger' type='button' name='btn_supp_prof' value='Supprimer'> </a></td>";
    										echo" </tr>";

    									}
    									echo" </table>";
    								}
    							} catch(PDOException $e) {
    								echo(" erreur de SELECT dans gestion_prof_admin.php<br>Message d'erreur :".$e->getMessage());
    							}
    							?>
    						</div>
    					</div>
    				</div>
    			</section>
    		<?php include "assets_bas.php"?>


