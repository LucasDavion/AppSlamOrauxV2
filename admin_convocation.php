<?php
session_start();
/*------------------------------------------------------
vérification que l'utilisateur est bien un administrateur
------------------------------------------------------*/
if(isset($_SESSION["idTypeUtilisateur"])==false || $_SESSION["idTypeUtilisateur"] != 1){
    header("Location: connexion_app.php");
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
                  <a href="index.html"><img src="images/logo.png" alt="logo"></a>
              </div>
          </div>
          <?php  
            /*-----------------------------------------------
            affiche le menu en fonction du type d'utilisateur
            ------------------------------------------------*/
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
    <?php include "connexion_bd_gesoraux.php"; ?>
<br><br><br>
<h2 class="text-center">Génération des convocations</h2>
<br><br>
<section>
	<div class="container">
		<div class="row">
			<div class="col">
				<form class="" action="admin_script_convocation.php" method="post">
					<p class="text-center">Générer les convocations de tous les élèves de toutes les classes :</p>
					<div class="form-group d-flex justify-content-center">
						<input type="submit" class="btn btn-success btn-lg" name="btn_tout-generer" value="Tout générer">
					</div>
				</form>
			</div>
		</div>
		<hr class="border border-dark" ><br>
		<div class="row">
			<div class="col">
				<form class="" action="admin_script_convocation.php" method="post">
					<p class="text-center">Générer pour une classe :</p>
					<div class="form-group">
						<select name="lst_section" class="form-control">
						<?php
							include "connexion_bd_gesoraux.php";
							try {
								$lesEnreg=$bdd->query("SELECT id, libelle FROM division");
							} catch (PDOException $e) {
								echo "erreur : .$e";
							}
							if ($lesEnreg->rowCount () > 0) {
								foreach ($lesEnreg as $enreg) {
									echo "<option value='$enreg->libelle'>$enreg->libelle</option>";
								}
							}
							?>
						</select>
					</div>
					<div class="form-group d-flex justify-content-center">
						<input type="submit" class="btn btn-success btn-sm" name="btn_genererclasse" value="Générer pour la classe">
					</div>

				</form>
			</div>
			<div class="col">
				<form class="" action="admin_script_convocation.php" method="post">
				<p class="text-center">Générer pour un éléve:</p>
					<div class="form-group">
						<select name="lst_eleve" class="form-control form-group">
						<?php
							include "connexion_bd_gesoraux.php";
							try {
								$lesEnreg=$bdd->query("SELECT eleve.id, nom, prenom FROM eleve ORDER BY nom");
							} catch (PDOException $e) {
								echo "erreur : .$e";
							}
							if ($lesEnreg->rowCount () > 0) {
								foreach ($lesEnreg as $enreg) {
									echo "<option value='$enreg->id'>$enreg->nom  $enreg->prenom</option>";
								}
							}
							?>
						</select>
					</div>
					<div class="form-group d-flex justify-content-center">
						<input type="submit" class="btn btn-success btn-sm" name="btn_generereleve" value="Générer pour l'élève">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

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
