<?php
session_start();
if(isset($_SESSION["idTypeUtilisateur"])==false || $_SESSION["idTypeUtilisateur"] != 1){
    header("Location: connexion_app.php");
}
?>

<?php 
  $messages = "";
echo "coucou".$_POST["envoyer"];
//ouverture du fichier $fic pointe sur le fichier
if (isset($_POST["envoyer"])== true) {
    # code...

          

            $dossier = 'upload/';
            $fichier = basename($_FILES['avatar']['name']);
            $taille_maxi = 100000;
            $taille = filesize($_FILES['avatar']['tmp_name']);
            $extensions = array('.csv');
            $extension = strrchr($_FILES['avatar']['name'], '.'); 
            //Début des vérifications de sécurité...
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
            }
            if($taille>$taille_maxi)
            {
               $erreur = 'Le fichier est trop gros...';
            }
            if(!isset($erreur)) {//S'il n'y a pas d'erreur, on upload
             

                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)){ //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                     
                            $fic = fopen($dossier . $fichier, "r");
                            if ($fic == false) {
                            //ouverture du fichier impossible
                                     echo "ouverture du fichier impossible";
                            } else {

                                $nb_fic= 0;

                                 //connexion à la base de donées
                                include "connexion_bd.php";

                                while ($enreg=fgetcsv($fic, 13421772,';')) {
                                        $nb_valeurs = count($enreg);

                                        if ($nb_valeurs != 25) {
                                            $message = "Erengistrement erreur";
                                        } else {

                                            try {


                                                $pos = strpos($enreg[1], 'TL');

                                                if ($pos === false) {

                                                    //changement du format de la date
                                                    $enreg[5] = str_replace('/', '-', $enreg[5]); // On remplce les '/' par des '-' car php ne gère pas bien les '/'
                                                    $enreg[5] = date("Y-m-d", strtotime($enreg[5]));
                                                    //PREPARE
                                                     $req = $bdd->prepare("insert into eleve values(0, :par_nom, :par_prenom, :par_datenaissance, :par_tierstemps, :par_idcivilite, :par_idsection, :par_iddivision)");

                                                    //requete du format de la civilité
                                                    $lesEnregs = $bdd -> query("SELECT id FROM civilite WHERE code = '$enreg[2]'"); 
                                                    $enregs = $lesEnregs -> fetch();
                                                    $req->bindValue(':par_idcivilite', $enregs->id, PDO::PARAM_INT );

                                                    //requete du format de idSection(section euro )

                                                    if ($enreg[9] == '') {
                                                       $req->bindValue(':par_idsection', NULL, PDO::PARAM_INT );
                                                    }
                                                    else{
                                                        $enreg[9] = str_replace('EUROPEENNE', 'Européenne', $enreg[9]);
                                                        $enreg[9] = str_replace('INTERNATION.', 'Internationale', $enreg[9]);
                                                        $lesEnregs = $bdd -> query("SELECT id FROM section WHERE libelle = '$enreg[9]'");
                                                        $enregs = $lesEnregs -> fetch();
                                                        if ($enregs != false){
                                                            $req->bindValue(':par_idsection', $enregs->id, PDO::PARAM_INT );
                                                        }else {
                                                            $req->bindValue(':par_idsection', NULL, PDO::PARAM_INT );
                                                        }
                                                    }


                                                    //requete du format de idDivison(classe)
                                                    $lesEnregs = $bdd -> query("SELECT id FROM division WHERE libelle = '$enreg[1]'");
                                                    $enregs = $lesEnregs ->fetch();
                                                    $req->bindValue(':par_iddivision', $enregs->id, PDO::PARAM_INT );

                                                    //requete insert(ELEVES) nom;prenom;dateNaissance;tiersTempsON;idCivilite;idSection ;idDivision

                                                    $req->bindValue(':par_nom', $enreg[3], PDO::PARAM_STR);
                                                    $req->bindValue(':par_prenom', $enreg[4], PDO::PARAM_STR );
                                                    $req->bindValue(':par_datenaissance', $enreg[5], PDO::PARAM_STR );
                                                    $req->bindValue(':par_tierstemps', $enreg[6], PDO::PARAM_STR );
                                                    $req->execute();
                                                    $messages = "Les eleves ont bien été intégrer à la base de donnée.<br>";


                                                    $req = $bdd->prepare("insert into passageepreuve(id, inscritBenef, derogation, idEleve, idEpreuve ) values(0, :par_inscritBenef, :par_derogation, :par_ideleve, :par_idepreuve )");


                                                    //POSITION LV1
                                                    $enreg[11] = str_replace('INSCRIT', 'N', $enreg[11]);
                                                    $enreg[11] = str_replace('BENEFICE','O', $enreg[11]);
                                                    $req->bindValue('par_inscritBenef', $enreg[11], PDO::PARAM_STR);


                                                    //DEROGATION LV1
                                                    $req->bindValue('par_derogation', $enreg[13], PDO::PARAM_STR);


                                                    //IDELEVE

                                                    $lesEnregs = $bdd -> prepare("SELECT id FROM eleve WHERE nom = :par_nom and prenom = :par_prenom");
                                                    $lesEnregs->bindValue('par_nom', $enreg[3], PDO::PARAM_STR);
                                                    $lesEnregs->bindValue('par_prenom', $enreg[4], PDO::PARAM_STR);
                                                    $lesEnregs->execute();
                                                    $enregs = $lesEnregs -> fetch();
                                                    if ($lesEnregs != false) {
                                                        $req->bindValue('par_ideleve', $enregs->id, PDO::PARAM_INT );
                                                    }

                                                        // ID EPREUVE
                                                    $lesEnregs = $bdd -> query("SELECT epreuve.id FROM epreuve join discipline on idDiscipline=discipline.id WHERE libelle = '$enreg[12]' and idNatureEpreuve=1 ");

                                                    if ($lesEnregs->rowCount()>0) {
                                                        $enregs = $lesEnregs -> fetch();
                                                        $req->bindValue('par_idepreuve', $enregs->id, PDO::PARAM_INT);
                                                        $req->execute();
                                                        $messages = "Les epreuves LV1 ont bien été integrer.<br>".$messages;
                                                    }
                                                    //2eme EPREUVE
                                                    $req = $bdd->prepare("insert into passageepreuve(id, inscritBenef, derogation, idEleve, idEpreuve ) values(0, :par_inscritBenef, :par_derogation, :par_ideleve, :par_idepreuve )");

                                                    //POSITION LV2
                                                    $enreg[14] = str_replace('INSCRIT', 'N', $enreg[14]);
                                                    $enreg[14] = str_replace('BENEFICE','O', $enreg[14]);
                                                    $req->bindValue('par_inscritBenef', $enreg[14], PDO::PARAM_STR);


                                                    //DEROGATION LV2
                                                    $req->bindValue('par_derogation', $enreg[16], PDO::PARAM_STR);


                                                     //IDELEVE

                                                    $lesEnregs = $bdd -> prepare("SELECT id FROM eleve WHERE nom = :par_nom and prenom = :par_prenom");
                                                    $lesEnregs->bindValue('par_nom', $enreg[3], PDO::PARAM_STR);
                                                    $lesEnregs->bindValue('par_prenom', $enreg[4], PDO::PARAM_STR);
                                                    $lesEnregs->execute();
                                                    $enregs = $lesEnregs -> fetch();
                                                    if ($lesEnregs != false) {
                                                        $req->bindValue('par_ideleve', $enregs->id, PDO::PARAM_INT );
                                                    }
                                                    // ID EPREUVE
                                                    $lesEnregs = $bdd -> query("SELECT epreuve.id FROM epreuve join discipline on idDiscipline=discipline.id WHERE libelle = '$enreg[15]' and idNatureEpreuve=2 ");

                                                    if ($lesEnregs->rowCount()>0) {
                                                        $enregs = $lesEnregs -> fetch();
                                                        $req->bindValue('par_idepreuve', $enregs->id, PDO::PARAM_INT);
                                                        $req->execute();
                                                        $messages = "Les epreuves LV2 ont bien été integrer.<br>".$messages;
                                                    }
                                                }

                                            
                                            } catch (PDOException $e) {
                                                die("Enregistrement err ! " . $e->getMessage());
                                            }       
                                        }
                                }
                            }
                    }else{ //Sinon (la fonction renvoie FALSE).
                
                        echo 'Echec de l\'upload !';
                    }
            } else {
                echo $erreur;
            } 
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
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/metisMenu.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.min.css">
        <link rel="stylesheet" href="css/bootstrap.css"
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
                  <a href="index.html"><img src="images/logo.png" alt="logo"></a>
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

        <br><br><br><br>
<?php 
if ($_POST["envoyer"]==true) {
    echo $messages;
}else{

 ?>
        <div class="container">
            <div class="row d-flex justify-content-center">

                <form method="POST" action="" enctype="multipart/form-data" class="text-center">
                    <div class="form-group">
                     <!-- On limite le fichier à 100Ko -->
                     <input  class="form-control-file" type="hidden" name="MAX_FILE_SIZE" value="4654567498">
                     Fichier : <input class="form-control-file"  type="file" name="avatar">
                     <br>
                     <input class="btn btn-success" type="submit" name="envoyer" value="Envoyer le fichier">   
                     <?php 
                     
                     ?>
                 </div>
             </form>

         </div>

     </div>


 </section>
<?php 
include "assets_bas.php";
?>