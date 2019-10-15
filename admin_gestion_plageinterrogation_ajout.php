<?php
// connexion bdd
include "connexion_bd_gesoraux.php";
// initialisation des variables
$msg="";
$heureDebut="";
$heureFin="";
$nbMaxEleve="";
// on vérifie si le bouton à bien été utilisé
if(isset($_POST['btn_valider'])==true){
  // extraction des saisies du formulaire
  extract($_POST);
  // on verifie si heureDebut à bien été saisie
  if(isset($heureDebut)==false || trim($heureDebut)==""){
    $msg=$msg."La plage d'interrogation est obligatoire<br>";
  }
  // on verifie si heureFin à bien été saisie
  if(isset($heureFin)==false || trim($heureFin)==""){
    $msg=$msg."La plage d'interrogation est obligatoire<br>";
  }
  // on verifie si nbMaxElve à bien été saisie
  if(isset($nbMaxEleve)==false || trim($nbMaxEleve)==""){
    $msg=$msg."La plage d'interrogation est obligatoire<br>";
  }
 // si il n'y a pas de message d'erreur on fait la requête
  if($msg==""){
    // requête d'ajout des saisies dans la bdd
    try{
      
      if(strtotime($heureDebut) < strtotime('12:00'))
      {
        $per="matin";
      }
      else
      {
        $per="après-midi";
      }
      $req=$bdd->prepare("insert into plage values(0, :par_heureDebut, :par_heureFin, :par_nbMaxEleve, :par_matinAprem)");
      $req->bindValue(':par_heureDebut', $heureDebut, PDO::PARAM_STR);
      $req->bindValue(':par_heureFin', $heureFin, PDO::PARAM_STR);
      $req->bindValue(':par_nbMaxEleve', $nbMaxEleve, PDO::PARAM_INT);
      $req->bindValue(':par_matinAprem', $per, PDO::PARAM_STR);
      
      $req->execute();
      $msg="l'ajout s'est bien déroulé";
      header('Location: admin_gestion_plageinterrogation.php?msg'.$msg);
    }catch(PDOException $e) {
      die("Err BDInsert  : erreur ajout table plage dans admin_gestion_palgeinterrogation_ajout.php<br>
        Message d'erreur :" . $e->getMessage());
    }
  }
}
?>
<!-- inclusion des assets -->
<?php include "assets_haut_admin.php"?>
<br><br>
<div class="container text-center">
  <h1>Création d'une plage d'interrogation</h1><hr>
  <br />
</div>
<div class="container text-center">
  <div class="row">
    <div class="col">
    </div>
    <div class="col-6"><br><br><br>
      <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <div class="form-group">
          <!-- formulaire -->
          <form class="form" action="admin_gestion_plageinterrogation_ajout.php" method ="POST">

           Heure de début :&nbsp;&nbsp;<input type='time'name='heureDebut' value="<?php echo $heureDebut ?>" size='20'/> <br><br>
           Heure de fin :&nbsp;&nbsp;<input type='time'name='heureFin' value="<?php echo $heureFin ?>" size='20'/> <br><br>
           nombre d'élève maximum pour cette plage :&nbsp;&nbsp;<input type='text'name='nbMaxEleve' value="<?php echo $nbMaxEleve ?>" size='20'/> <br><br>


           <input type="submit" class="btn btn-success" name="btn_valider" value="Envoyer" />
           <!-- affichage des possibles messages -->
           <?php echo $msg;?>

         </form>
       </div>
     </div>
   </div>
   <div class="col">
   </div>
 </div>
</div>
 <!-- inclusion des assets -->
 <?php include "assets_bas.php"?>
