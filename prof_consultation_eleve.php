 <!-- inclusion des assets -->
 <?php include "assets_haut_prof.php"?>

  <div class=container>
        <center><h1>Consultation des élèves</h1><hr></center>
        <div class=form-group>
            <?php
            // connexion bdd
            include "connexion_bd_gesoraux.php";
            try{
                // requête de récuperation des salles
                $lesEnregs=$bdd->query("SELECT eleve.id as eleId,nom,prenom,dateNaissance,tiersTempsON,section.libelle as secLib,division.libelle as divLib,civilite.libelle as civLib,passageepreuve.id as pasId,inscritBenef,derogation,discipline.libelle as disLib,natureepreuve.libelle as natLib from passageepreuve 
                                        join eleve on idEleve=eleve.id
                                        left outer join section on idSection=section.id 
                                        join division on idDivision=division.id 
                                        join civilite on idCivilite=civilite.id 
                                        join epreuve on idEpreuve=epreuve.id 
                                        join natureepreuve on idNatureEpreuve=natureepreuve.id 
                                        join discipline on idDiscipline=discipline.id 
                                        order by nom");
            }catch (PDOException $e) {
                die("Err BDSelect dans prof_consultation_eleve.php");
            }
            // on verifie que la requête récupère bien des enregistrements
            if($lesEnregs->rowCount()==0){
                echo("Aucun élèves n'a été enregistré");

            }else{
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
                }
                echo "</table><br><br>";
            }
            ?>
        </div>
  </div>
   <!-- inclusion des assets -->
 <?php include "assets_bas.php"?>

