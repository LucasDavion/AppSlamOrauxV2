<?php 
    include "connexion_bd_gesoraux.php";
    echo"<div class='d-flex justify-content-center'>";		
		echo"<div class'table table-striped'>";
		$compteur=0;
	        //on vérifie que l'on a bien reçu l'id de la division en POST et qu'il est >0
	        if(isset($_POST['idDivision'])==true && $_POST['idDivision']>=0){
				$idDivision=$_POST['idDivision'];
		        if(isset($_POST['idnatep'])==true && ($_POST['idnatep']>=1 || $_POST['idnatep']=='T')){
		            try{
		            if($_POST["idnatep"]=='T'){
						if($_POST["idabsence"]=='O')
						{
							//récupération (select) des enregistremnts de la table élève dont la division est 
		                    //identique à celle transmise
		                    $lesEnregs=$bdd->query(" SELECT passageepreuve.id as idEpreuve, eleve.nom as 'nom', eleve.prenom as 'prenom', 
							division.libelle as 'division', natureepreuve.libelle as 'natureepreuve', utilisateur.nom as 'professeur', 
							discipline.libelle as discipline, epreuve.idDiscipline, passageepreuve.idProfAffecte as 'idProfAffecte', demijournee.date, 
							demijournee.matinAprem,passageepreuve.idSalle, plage.heureDebut
		                        from passageepreuve 
		                        left outer join utilisateur on idProfAffecte=utilisateur.id
		                        left outer join eleve on idEleve=eleve.id
		                        join division on idDivision=division.id 
		                        join epreuve on idEpreuve=epreuve.id 
		                        join natureepreuve on idNatureEpreuve=natureepreuve.id 
		                        join discipline on epreuve.idDiscipline = discipline.id
								left outer join demijournee on demijournee.id = passageepreuve.idDemiJournee
								left outer join plage on idPlage = plage.id
		                        where((idDivision=$idDivision and $idDivision !=0) 
								or $idDivision =0) AND absence='O'  order by eleve.nom ");
						}
						else{

		                    //récupération (select) des enregistremnts de la table élève dont la division est 
		                    //identique à celle transmise
		                    $lesEnregs=$bdd->query(" SELECT passageepreuve.id as idEpreuve, eleve.nom as 'nom', eleve.prenom as 'prenom', 
							division.libelle as 'division', natureepreuve.libelle as 'natureepreuve', utilisateur.nom as 'professeur', 
							discipline.libelle as discipline, epreuve.idDiscipline, passageepreuve.idProfAffecte as 'idProfAffecte', demijournee.date, 
							demijournee.matinAprem,passageepreuve.idSalle, plage.heureDebut
		                        from passageepreuve 
		                        left outer join utilisateur on idProfAffecte=utilisateur.id
		                        left outer join eleve on idEleve=eleve.id
		                        join division on idDivision=division.id 
		                        join epreuve on idEpreuve=epreuve.id 
		                        join natureepreuve on idNatureEpreuve=natureepreuve.id 
		                        join discipline on epreuve.idDiscipline = discipline.id
								left outer join demijournee on demijournee.id = passageepreuve.idDemiJournee
								left outer join plage on idPlage = plage.id
		                        where((idDivision=$idDivision and $idDivision !=0) 
								or $idDivision =0)  order by eleve.nom ");
						}		
		            }
		            else{
		                extract($_POST);
						if($_POST["idabsence"]=='O')
						{
		                    //si on demande une nature d'épreuve spécifique 
		                    //on ne récupère que les élèves ayant cette nature d'épreuve
		                    $lesEnregs=$bdd->query("SELECT passageepreuve.id as idEpreuve, eleve.nom as 'nom', eleve.prenom as 'prenom', 
		                    division.libelle as 'division', natureepreuve.libelle as 'natureepreuve', utilisateur.nom as 'professeur', 
							discipline.libelle as discipline, epreuve.idDiscipline, passageepreuve.idProfAffecte as 'idProfAffecte',demijournee.date,
							plage.heureDebut, passageepreuve.idSalle
		                    from passageepreuve 
		                    left outer join utilisateur on idProfAffecte=utilisateur.id
		                    left outer join eleve on idEleve=eleve.id
		                    join division on idDivision=division.id 
		                    join epreuve on idEpreuve=epreuve.id 
		                    join natureepreuve on idNatureEpreuve=natureepreuve.id 
		                    join discipline on epreuve.idDiscipline = discipline.id
							left outer join demijournee on demijournee.id = passageepreuve.idDemiJournee
							left outer join plage on idPlage = plage.id
		                    where  ((idDivision=$idDivision and $idDivision !=0) or $idDivision =0)  
							and (natureepreuve.id= $idnatep) and absence='O' order by eleve.nom");
						}
						else 
						{
							//si on demande une nature d'épreuve spécifique 
		                    //on ne récupère que les élèves ayant cette nature d'épreuve
		                    $lesEnregs=$bdd->query("SELECT passageepreuve.id as idEpreuve, eleve.nom as 'nom', eleve.prenom as 'prenom', 
		                    division.libelle as 'division', natureepreuve.libelle as 'natureepreuve', utilisateur.nom as 'professeur', 
							discipline.libelle as discipline, epreuve.idDiscipline, passageepreuve.idProfAffecte as 'idProfAffecte',demijournee.date,
							plage.heureDebut, passageepreuve.idSalle
		                    from passageepreuve 
		                    left outer join utilisateur on idProfAffecte=utilisateur.id
		                    left outer join eleve on idEleve=eleve.id
		                    join division on idDivision=division.id 
		                    join epreuve on idEpreuve=epreuve.id 
		                    join natureepreuve on idNatureEpreuve=natureepreuve.id 
		                    join discipline on epreuve.idDiscipline = discipline.id
							left outer join demijournee on demijournee.id = passageepreuve.idDemiJournee
							left outer join plage on idPlage = plage.id
		                    where  ((idDivision=$idDivision and $idDivision !=0) or $idDivision =0)  
							and (natureepreuve.id= $idnatep) order by eleve.nom");
						}
		            }
		            }catch(PDOException $e){
		                //erreur grave (exception lors de la lecture)
		                die("Err BDALec01Erreur : erreur de SELECT dans admin_selection_eleves_crit.php<br>Message d'erreur :".$e->getMessage());
		            }
		                if($lesEnregs->rowCount()==0){
		                    //affichage d'un message informant qu'il n'existe pas d'élève avec cette division
		                    echo("Il n'y a aucun élève ayant la division sélectionnée<br><br>");
		                }else{
		                    //alimentation du tableau avec le nom,prénom,division, LV1/LV2, professeur ayant choisi l'élève

							echo"<form action='admin_selection_eleves_valider.php' method='POST'>";
							?>
							<div class="form-group d-flex justify-content-center" >
		                    <input class='btn btn-success btn-lg' type="submit" name="btn_valider" id="btn_valider" value="Valider" position = "fixed">
							</div>
							<?php
		                        echo" <table class ='table table-striped text-center'>";
		                        echo" <thead class='thead-dark'>";
		                        echo" <tr>";
		                        echo "<th>Nom</th>";
		                        echo "<th>Prénom</th>";
		                        echo "<th>Division</th>";
		                        echo "<th>Discipline</th>";
								echo "<th>LV1/LV2</th>";
								echo "<th>Plage Epreuve</th>";
								echo "<th>Salle</th>";
		                        echo "<th>Professeur</th>";
		                        echo" </tr>";
		                        echo"</thead>";
		                        //On affiche une checkbox si aucun prof n'a choisi l'élève, sinon une case vide
		                        foreach($lesEnregs as $enreg){
									$compteur++;
									echo" <tr>";
		                            echo "<td> $enreg->nom</td>";
		                            echo "<td> $enreg->prenom</td>";
		                            echo "<td> $enreg->division</td>";
		                            echo "<td> $enreg->discipline</td>";
									echo "<td> $enreg->natureepreuve <input type='hidden' name='idEpreuve$compteur' value=$enreg->idEpreuve>";
									
		                            //dans le tableau on affiche une liste déroulante avec le nom de tous les professeurs de la discipline de l'épreuve
		                            // si l'élève a déjà été choisi le nom du prof est affiché en premier. 
		                            ?>
										<?php 
										$lst_prof = $enreg->idProfAffecte;
										$lst_salle = $enreg->idSalle;
										$lst_plage = $enreg->date . $enreg->heureDebut;
										// -----------------------------------------------------
										//Liste déroulante avec la date et les plages
										//------------------------------------------------------
										echo "<td>";
										echo"<select class='custom-select custom-select' name='lst_plage$compteur' id='plage'><br>";
										echo"<option value='0'>Aucune</option>";


										//-------------------
										//pour mettre periode / hors periode 
										
									
										try{
											$lesEnregsPlagesP=$bdd->query("SELECT date, plage.heureDebut, idDemiJournee, idPlage
											from plagedemijournee 
											join demijournee on idDemiJournee = demijournee.id 
											join plage on idPlage = plage.id
											where demijournee.periode ='O'");
										}catch(PDOException $e) {
											echo("err BDSelect : erreur de lecture tables plagedemijournee, demijournee, plage dans admin_selection_eleves_crit.php<br>
												Message d'erreur : ".$e->getMessage());
										}
										//on teste si le select a retourné des enregistrement
										if($lesEnregsPlagesP->rowCount() > 0)
										{
											echo" <optgroup label='Hors Période'>";
											foreach($lesEnregsPlagesP as $enregPlage) {
												list($year, $month, $day) = explode("-", $enregPlage->date);
                    							$date_fr = $day."/".$month."/".$year;
												if($lst_plage == $enregPlage->date . $enregPlage->heureDebut){
													echo "<option class='form-group' selected value='$enregPlage->idDemiJournee $enregPlage->idPlage'>$date_fr $enregPlage->heureDebut</option>";
												}
												else{
													echo"<option class='form-group' value='$enregPlage->idDemiJournee $enregPlage->idPlage'>$date_fr $enregPlage->heureDebut</option>";
												}
												
											}

										}
										
										try{
											$lesEnregsPlagesP=$bdd->query("SELECT date, plage.heureDebut, idDemiJournee, idPlage
											from plagedemijournee 
											join demijournee on idDemiJournee = demijournee.id 
											join plage on idPlage = plage.id
											where demijournee.periode ='N'");
										}catch(PDOException $e) {
											echo("err BDSelect : erreur de lecture tables plagedemijournee, demijournee, plage dans admin_selection_eleves_crit.php<br>
												Message d'erreur : ".$e->getMessage());
										}
										//on teste si le select a retourné des enregistrement
										if($lesEnregsPlagesP->rowCount() > 0)
										{
											echo" <optgroup label='Période'>";
											foreach($lesEnregsPlagesP as $enregPlage) {
												list($year, $month, $day) = explode("-", $enregPlage->date);
                    							$date_fr = $day."/".$month."/".$year;
												if($lst_plage == $enregPlage->date . $enregPlage->heureDebut){
													echo "<option class='form-group' selected value='$enregPlage->idDemiJournee $enregPlage->idPlage'>$date_fr $enregPlage->heureDebut</option>";
												}
												else{
													echo"<option class='form-group' value='$enregPlage->idDemiJournee $enregPlage->idPlage'>$date_fr $enregPlage->heureDebut</option>";
												}
												
											}

										}
										echo "</select>";
										echo"</td>";
											
										
										//----------------------------------------
										//Liste déroulante contenant les salles
										//----------------------------------------

										echo "<td>";
										echo"<select class='custom-select custom-select' name='lst_salle$compteur' id='salle'><br>";
										echo"<option value='0'>Aucune</option>";
										try{
											$lesEnregsSalles=$bdd->query("SELECT id, libelle from salle");
										}catch(PDOException $e) {
											echo("err BDSelect : erreur de lecture table salle dans admin_selection_eleves_crit.php<br>
												Message d'erreur : ".$e->getMessage());
										}
											//on teste si le select a retourné des enregistrement
										if($lesEnregsSalles->rowCount() > 0)
										{
											foreach($lesEnregsSalles as $enregSalle) {
												if($lst_salle == $enregSalle->id){
													echo "<option class='form-group' selected value='$enregSalle->id'>$enregSalle->libelle</option>";
												}
												else{
													echo"<option class='form-group' value='$enregSalle->id'>$enregSalle->libelle</option>";
												}
												
											}

										}
										echo "</select>";
										echo"</td>";
									
?>
									<td>
		                            	<?php echo"<select class='custom-select custom-select' required name='lst_prof$compteur' id='prof'>"; ?>
											<option value="0">Aucun</option>
											<?php
								
												//exécution de la requête (avec la méthode query) pour obtenir le contenu de la table 
												// on récupère le résultat de la requête dans le tableau $lesenregs
												try{
													$lesEnregsUtiles=$bdd->query("SELECT utilisateur.id as idProf, utilisateur.nom as nomProf 
													from utilisateur
													Join discipline on utilisateur.idDiscipline = Discipline.id
													where utilisateur.idTypeUtilisateur = 2 and (utilisateur.idDiscipline= $enreg->idDiscipline  )");
												}catch(PDOException $e) { 
													die("err BDSelect : erreur de lecture table dans admin_selection_eleve-crit.php<br>
														Message d'erreur : ".$e->getMessage());
												}
												//on teste si le select a retourné des enregistrement
												if($lesEnregsUtiles->rowCount() > 0)
												{
													
													//pour chaque enregistrement retourné par la requête SQL, on créé une option dans la liste
													//l'attribut value contiendra l'id (l'identifiant du prof )et son nom
													//on limite le tableau retourné et pour chaque enregistrement, on affiche le nom 
													foreach($lesEnregsUtiles as $enregUtile) {
														if($lst_prof == $enregUtile->idProf){
															echo "<option class='form-group' selected value='$enregUtile->idProf'>$enregUtile->nomProf</option>";
														}else{
															echo"<option class='form-group' value='$enregUtile->idProf'>$enregUtile->nomProf</option>";
														}
																					
													}
												}
											?>
										</select>
		                             </td>
									 
		                            <?php
		                            echo" </tr>";
		                        }
		                    echo" </table>";
		                    ?>
							<div class="form-group d-flex justify-content-center">
		                    <input class='btn btn-success btn-lg' type="submit" name="btn_valider" id="btn_valider" value="Valider">
							</div>
		                    <?php
		                echo"</form>";
		                }
		    
	    }
	}
?>
</div>
</div>