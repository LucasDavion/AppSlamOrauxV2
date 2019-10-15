<?php
session_start();
if(isset($_SESSION["idTypeUtilisateur"])==false || $_SESSION["idTypeUtilisateur"] != 2){
    header("connexion_app.php");
}

// $id_Util=$_SESSION['id'];
$id_Util=$_SESSION["id"];
$valeur="";
$val_chb="";
$msg="";
$chbapremJ="";
$chbmatinJ="";
$demiJournee="";
$idDemiJournee="";
$idSalle="";
$compteur=0;
$erreur="";


// Connexion à la base de données
include "connexion_bd_gesoraux.php";        


if(isset($_POST['bouton_valider'])==true){
    extract($_POST);
    
    // pour une modification venant de l'utilisateur, on doit d'abord supprimer ses précédentes sélections dans la base de données pour les rajouter en plus des nouvelles (ou les enlever)
    try{
        $lesEnregs=$bdd->prepare("Delete from choixprofdemijournee where idUtilisateur=:par_idUtil");
        $lesEnregs->bindValue(":par_idUtil",$id_Util,PDO::PARAM_INT);
        $lesEnregs->execute();

    } catch(PDOException $e){
        echo("ErrSuppChoixProfDemiJournee : Erreur lors de la suppression d'un choix du prof pour une demi journée dans saisie_demi_journee.php.
            <br>Message d'erreur :".$e->getMessage());
    }

    foreach($_POST as $cle=>$valeur){
        if (strpos($cle, "chb")===0) {
            $val_chb=$valeur;
        } else {
            //liste
            if(strpos($cle, "salle") === 0 && $val_chb != "") {

                // on vérifie que la salle n'est pas déjà prise à cette demi journée là
                $lesSallesPrises=$bdd->prepare("SELECT idDemiJournee from choixprofdemijournee where idSalle=$valeur and idDemijournee=$val_chb");
                $lesSallesPrises->execute();
                $laSallePrise = $lesSallesPrises->fetch();
                
                // le SELECT a retourné un enregistrement: on récupère l'enregistrement 
                
                // la salle n'existe pas dans la base de donnée : on peut donc l'enregistrer avec un insert
                if($laSallePrise == false)
                {
                    $requete=$bdd->prepare("INSERT into choixprofdemijournee values(:par_idUtil, :par_idDemiJournee, :par_idSalle)");
                    $requete->bindValue(':par_idUtil', $id_Util, PDO::PARAM_INT);
                    $requete->bindValue(':par_idDemiJournee', $val_chb, PDO::PARAM_INT);
                    $requete->bindValue(':par_idSalle', $valeur, PDO::PARAM_INT);
                    $requete->execute();
                    $val_chb=""; // cette variable contient le numéro de demi-journée
                                // dans $valeur on a le numéro de salle
                } else {

                    // la salle est déjà prise, on affiche un message d'erreur pour dire quelles salles sont prises. il faut récupérer les libellés exactes de celles-ci (et pour les demi-journées également)      
                    $lesSalles=$bdd->prepare("SELECT libelle from salle where id=$valeur");
                    $lesSalles->execute();
                    $laSalle=$lesSalles->fetch();

                    $lesDemis=$bdd->prepare("SELECT date, matinAprem from demijournee where id=$val_chb");
                    $lesDemis->execute();
                    $laDemi=$lesDemis->fetch();

                    list($year, $month, $day) = explode("-", $laDemi->date);
                    $date_fr = $day."/".$month."/".$year;

                    if($laDemi->matinAprem=="matin")
                    {
                        $erreur=$erreur."<br>La salle $laSalle->libelle pour le $laDemi->matinAprem du $date_fr est déjà prise, veuillez en sélectionner une autre.";
                    } else {
                        $erreur=$erreur."<br>La salle $laSalle->libelle pour l'$laDemi->matinAprem du $date_fr est déjà prise, veuillez en sélectionner une autre.";
                    }
                    $val_chb="";
                    
                }

            } 
        }
    }
    echo $erreur;

}
?>

<!doctype html>
<html class="no-js" lang="fr-FR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/icon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                  <a href="panel_prof_gesoraux.php"><img src="images/logo.png" alt="logo"></a>
              </div>
          </div>
          <?php  
if($_SESSION["idTypeUtilisateur"]=='1'){
               include "admin_nav.html";
            }else{
                if($_SESSION["idTypeUtilisateur"]=='2'){
                    include "prof_nav.html";
                }else{
                    if($_SESSION["idTypeUtilisateur"]=='3'){
                        include "scolarite_nav.html";
                    }   
                }
            }
          ?>

      </div>
      <!-- sidebar menu area end -->
      <!-- main content area start -->
      <div class="main-content">
        <!-- header area start -->
        <div class="header-area">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="nav-btn pull-left">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="col-auto">
                </div>
                <div class="col-auto mr-auto"></div>
                <!-- Nav Item - User Information -->
                <?php 
                    include "bouton_profil.php";
                     ?>
    </div>
</div>

<section>
    
    <h1><center>Saisie et Modification des demi-journées</center></h1></br>
        <div class="">       
            <table class="table text-center table-bordered">
                <thead class="thead-dark">

                <!-- début formulaire !-->
                <form action='' method='post'>
                    
                    <?php

                // on prend les dates dans la bdd
                    $lesDemiJournees=$bdd->query("SELECT distinct date from demijournee");  
                    $lesDemiJournees->execute();
                    

                // et on sauvegarde la date de la demi-journée en l'affichant dans un tableau
                    echo "<tr><th scope='col'></th>";
                    foreach ($lesDemiJournees as $demiJournee)
                    {
                        // on affiche les dates "à la française"
                        list($year, $month, $day) = explode("-", $demiJournee->date);
                        $date_fr = $day."/".$month."/".$year;
                        echo "<th scope='col'>$date_fr</th>";

                    }
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                // affichage de la première ligne matin
                    echo "<tr><th scope='row' class='align-middle'>Matin</th>";

                // ligne matin
                    $lesDemiJournees=$bdd->query("SELECT id, date from demijournee where matinAprem='matin'");      
                    foreach ($lesDemiJournees as $demiJournee)
                    {

                        $lesDemi=$bdd->query("SELECT idDemiJournee from choixprofdemijournee join demijournee on idDemijournee=$demiJournee->id and idUtilisateur=$id_Util");
                        $selection=$lesDemi -> fetch();

                        // on prend les salles qui sont déjà attribuées à un utilisateur (s'il en a)
                        $lesSalles=$bdd->query("SELECT libelle, salle.id from utilisateur join Salle on idSalleAtt=Salle.id where utilisateur.id=$id_Util and idSalleAtt is not null");

                        // le SELECT a retourné un enregistrement: on récupère l'enregistrement 
                        $salle =$lesSalles ->fetch();

                        if($lesDemi->rowCount () != 0) {
                            // si la demi journée représentée par la checkbox a déjà été sélectionnée par l'utilisateur connecté, la checkbox sera déjà cochée pour la demi-journée
                            echo "<td><input type='checkbox' checked name='chbmatinJ$demiJournee->id' id='chbmatinJ$demiJournee->id' value='$demiJournee->id'/><br>";
                        } else {

                            echo "<td><input type='checkbox' name='chbmatinJ$demiJournee->id' id='chbmatinJ$demiJournee->id' value='$demiJournee->id'/><br>";
                        }
                        // si l'utilisateur n'a pas de salle attribuée, on veut lui afficher toutes les salles
                        if($salle==false)
                        {
                            // on prend les salles dans la bdd
                            echo "<select name='salle$demiJournee->id'>";
                            $lesSalles=$bdd->query("SELECT id, libelle from salle where id not in (select idSalle from choixprofdemijournee where idDemiJournee=$demiJournee->id and idUtilisateur!=$id_Util)");
                            foreach ($lesSalles as $salle)
                            {
                                $lesSallesSelect=$bdd->query("SELECT idSalle from choixprofdemijournee where idUtilisateur=$id_Util and idDemiJournee=$demiJournee->id");
                                
                                if($lesSallesSelect->rowCount() !=0 )
                                {
                                    $uneSalleSelect=$lesSallesSelect ->fetch();
                                    if ($uneSalleSelect->idSalle == $salle->id ) {
                                        echo "<option selected value='$salle->id'>$salle->libelle</option>";
                                    } else {
                                        echo "<option value='$salle->id'>$salle->libelle</option>";
                                    }
                                } else {
                                    echo "<option value='$salle->id'>$salle->libelle</option>";
                                }           

                            }
                            echo "</select></td>";
                        } 
                        else 
                        {
                            echo "$salle->libelle</td>";
                            echo "<input type='hidden' name='salle$demiJournee->id' value='$salle->id' />";
                        }



                        
                    }

                    echo "</tr>";
                    

                    echo "<tr><th scope='row' class='align-middle'>Après-midi</th>" ;
                // ligne aprem
                    $lesDemiJournees=$bdd->query("SELECT id, date from demijournee where matinAprem='après-midi'");     
                    foreach ($lesDemiJournees as $demiJournee)
                    {

                        $lesDemi=$bdd->query("SELECT idDemiJournee from choixprofdemijournee join demijournee on idDemijournee=$demiJournee->id and idUtilisateur=$id_Util ");
                        $selection=$lesDemi -> fetch();

                        $lesSalles=$bdd->query("SELECT libelle, salle.id from utilisateur join Salle on idSalleAtt=Salle.id where utilisateur.id=$id_Util and idSalleAtt is not null");

                        // le SELECT a retourné un enregistrement: on récupère l'enregistrement 
                        $salle =$lesSalles ->fetch();


                        if($lesDemi->rowCount () != 0) {
                            echo "<td><input type='checkbox' checked name='chbapremJ$demiJournee->id' id='chbapremJ$demiJournee->id' value='$demiJournee->id'/><br>";
                        } else {

                            echo "<td><input type='checkbox' name='chbapremJ$demiJournee->id' id='chbapremJ$demiJournee->id' value='$demiJournee->id' /><br>";
                        }
                    

                        if($salle==false)
                        {
                            // on prend les salles dans la bdd
                            echo "<select name='salle$demiJournee->id'>";           

                            $lesSalles=$bdd->query("SELECT id, libelle from salle where id not in (select idSalle from choixprofdemijournee where idDemiJournee=$demiJournee->id and idUtilisateur!=$id_Util)");
                            foreach ($lesSalles as $salle)
                            {
                                $lesSallesSelect=$bdd->query("SELECT idSalle from choixprofdemijournee where idUtilisateur=$id_Util and idDemiJournee=$demiJournee->id");
                                
                                if($lesSallesSelect->rowCount() !=0 )
                                {
                                    $uneSalleSelect=$lesSallesSelect ->fetch();
                                    if ($uneSalleSelect->idSalle == $salle->id ) {
                                        echo "<option selected value='$salle->id'>$salle->libelle</option>";
                                    } else {
                                        echo "<option value='$salle->id'>$salle->libelle</option>";
                                    }
                                } else {
                                    echo "<option value='$salle->id'>$salle->libelle</option>";
                                }
                            }
                            echo "</select></td>";
                        } 
                        else 
                        {

                            echo "$salle->libelle</td>";
                            echo "<input type='hidden' name='salle$demiJournee->id' value='$salle->id' />";
                        }
                    }
                
                    
                    



                    echo "</tr>";
                    echo "</tbody>";
                    ?>
                
                </table>
                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-success" name="bouton_valider" id="bouton_valider" value="Valider" />
                </div>

                <!-- fin formulaire !-->
            </form>

            </div>

</section>
</div>
</div>
<!-- jquery latest version -->
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
<!-- bootstrap 4 js -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.slicknav.min.js"></script>

<!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- start zingchart js -->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
</script>
<!-- all line chart activation -->
<script src="assets/js/line-chart.js"></script>
<!-- all pie chart -->
<script src="assets/js/pie-chart.js"></script>
<!-- others plugins -->
<script src="assets/js/plugins.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>
