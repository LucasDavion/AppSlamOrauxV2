<?php
include"connexion_bd_gesoraux.php";
include"assets_haut_admin.php";
?>

<!-- Mon scrip a moi-->

<table class="table table-striped">
<?php

/*
*********************************************
Sélection des dates de la période sélectionné
*********************************************
*/

//Select des dates
$lesChoixProfs=$bdd->query("SELECT count(*) as nb from choixprofdemijournee");
$choixProf=$lesChoixProfs->fetch();
if($choixProf->nb == 0)
{
  echo "Les professeurs n'ont pas fait leurs choix.";
}
else
{
  try {
    $lesDates = $bdd->query("SELECT DISTINCT date from demijournee");
    if ($lesDates->rowCount()==0) {
      echo "Aucune date dans la base de données";
    } else {
      ?>
      <thead class="thead-dark">
        <tr>
          <td>
            <br>
          </td>
          <?php

        //Affichage de toute les dates dans la base de données

          foreach ($lesDates as $uneDate) {
            ?>
            <th scope="col">
              <?php

            //Conversion au format français

              $datejour = $uneDate->date;
              list($annee, $mois, $jour) = explode("-", $datejour);
              $dateFormatFrançais = "$jour/$mois/$annee";

            //Affichage de la date

              echo"$dateFormatFrançais";
              ?>
            </th>
            <?php
        } //fin du foreach qui affiche les dates
    //Message d'erreur pour le select des dates
    }
  } catch (PDOException $e) {
    echo("Err BDALec03Erreur : erreur de SELECT<br>Message d'erreur:".$e->getMessage());
  }
        ?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Matin</th>
      <?php
        /*
        ***************************************************
        Sélection des professeurs de la période sélectionné
        ***************************************************
        */
        $lesPeriodesMatins = $bdd->query("SELECT id, date from demijournee where matinAprem='matin'");
        foreach ($lesPeriodesMatins as $periodeMatin) {
          $idPeriode = $periodeMatin->id;
          try {
            $lesProfsMatins = $bdd->query("SELECT utilisateur.nom as 'nom', salle.libelle as 'salle', civilite.code as 'civilite' from choixprofdemijournee join utilisateur on idUtilisateur = utilisateur.id left outer join demijournee on idDemiJournee = demijournee.id join salle on idSalle = salle.id
              join civilite on idCivilite = civilite.id
              where idDemiJournee = $idPeriode");
            if ($lesProfsMatins->rowCount()==0) {
              echo "<td class = 'table-secondary'> </td>";
            } else {
              ?>
              <td>
                <?php

                //Affichage des profs

                foreach ($lesProfsMatins as $profMatin) {
                  $profMaj = ucfirst($profMatin->nom);
                  echo "<p>$profMatin->civilite &nbsp; $profMaj &nbsp; &nbsp; $profMatin->salle</p>";
                }
                ?>
              </td>
              <?php
            }

            //Message d'erreurs pour le select des professeurs pour les matins en fonction de la date

          } catch (PDOException $e) {
            echo("Err BDALec01Erreur : erreur de SELECT<br>Message d'erreur:".$e->getMessage());
          }
        }

        //Mettre un fond rouge quand c'est vide

        
        $periodeUtilisee = $bdd->query("SELECT idDemiJournee from choixprofdemijournee where idDemiJournee = $idPeriode");
        if ($periodeUtilisee->rowCount()==0) {
          echo "<td></td>";
        }
        
        ?>
    </tr>
    <tr>
      <th scope="row">Après-Midi</th>
      <?php
        /*
        ***************************************************
        Sélection des professeurs de la période sélectionné
        ***************************************************
        */
        $lesPeriodesAprems = $bdd->query("SELECT id, date from demijournee where matinAprem='après-midi'");
        foreach ($lesPeriodesAprems as $periodeAprem) {
          $idPeriode = $periodeAprem->id;
          try {
            $lesProfsAprems = $bdd->query("SELECT utilisateur.nom as 'nom', salle.libelle as 'salle', civilite.code as 'civilite' from choixprofdemijournee join utilisateur on idUtilisateur = utilisateur.id left outer join demijournee on idDemiJournee = demijournee.id join salle on idSalle = salle.id
              join civilite on idCivilite = civilite.id
              where idDemiJournee = $idPeriode");
            if ($lesProfsAprems->rowCount()==0) {
              echo "<td class ='table-secondary'> </td>";
            } else {

              echo"<td>";

                //Affichage des professeurs

              foreach ($lesProfsAprems as $profAprem) {
                $profMaj = ucfirst($profAprem->nom);
                echo "<p>$profAprem->civilite &nbsp; $profMaj &nbsp; &nbsp; $profAprem->salle</p>";
              }
            }

            echo"</td>";


            $periodeUtilisee2 = $bdd->query("SELECT idDemiJournee from choixprofdemijournee where idDemiJournee = $idPeriode");
            if ($periodeUtilisee->rowCount()==0) {
              echo "<td>Aucun</td>";
            }


                  //Message d'erreurs pour le select des professeurs pour les après-midi en fonction de la date

          } catch (PDOException $e) {
            echo("Err BDALec02Erreur : erreur de SELECT<br>Message d'erreur:".$e->getMessage());
          }
        }
}
?>

</tbody>
</table>
<!-- Fin de mon script a moi -->
<?php
include"assets_bas.php" 
?>