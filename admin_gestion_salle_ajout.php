<?php
// connexion bdd
include "connexion_bd_gesoraux.php";
// initialisation des variables
$msg="";
$libelle="";
// on vérifie si le bouton à bien été utilisé
if(isset($_POST['btn_valider'])==true){
  // extraction des saisies du formulaire
  extract($_POST);
  // on verifie si libelle à bien été saisie
  if(isset($libelle)==false || trim($libelle)==""){
    $msg=$msg."La salle est obligatoire<br>";
  }
 // si il n'y a pas de message d'erreur on fait la requête
  if($msg==""){
    // requête d'ajout des saisies dans la bdd
    try{
      $req=$bdd->prepare("insert into salle values(0, :par_libelle)");
      $req->bindValue(':par_libelle', $libelle, PDO::PARAM_STR);
      $req->execute();
      $msg="l'ajout s'est bien dérouler";
      header('Location: admin_gestion_salle.php?msg'.$msg);
    }catch(PDOException $e) {
      die("Err BDInsert  : erreur ajout table salle dans admin_gestion_salle_ajout.php<br>
        Message d'erreur :" . $e->getMessage());
    }
  }
}
?>
<!-- inclusion des assets -->
<?php include "assets_haut_admin.php"?>
<br><br>
<div class="container text-center">
  <h1>Création d'une salle</h1><hr>
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
          <form class="form" action="admin_gestion_salle_ajout.php" method ="POST">

           Salle :&nbsp;&nbsp;<input type='text'name='libelle' value="<?php echo $libelle ?>" autofocus size='20'/> <br><br>

           <input type="submit" class="btn btn-success" name="btn_valider" value="Valider" />
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
