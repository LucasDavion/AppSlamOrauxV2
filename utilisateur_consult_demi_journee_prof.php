<?php
session_start();
if(isset($_SESSION["idTypeUtilisateur"])==false || $_SESSION["idTypeUtilisateur"] != 2){
    header("connexion_app.php");
}
//connexion a la bdd
include "connexion_bd_gesoraux.php";
//on recupère l'id de l'utilisateur
$id_Util=$_SESSION['id'];
$demiJournee="";
$idDemiJournee="";
$idSalle="";
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
	// si l'utilisateur est un administrateur
            if($_SESSION["idTypeUtilisateur"]=='1'){
               include "admin_nav.html";
            }else{
	// si l'utilisateur est un prof	    
                if($_SESSION["idTypeUtilisateur"]=='2'){
                    include "prof_nav.html";
                }else{
	// si l'utilisateur est un surveillant
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
<h1><center>Consultation des demi-journées</h1><br>	
				 <table class="table text-center table-bordered">
                <thead class="thead-dark">

					<!-- début formulaire !-->
					<form action='' method='post'>


						<?php
			/******************************************************
			  On affiche les dates de debut et de fin des épreuves 
			 ******************************************************/
						$lesDemiJournees=$bdd->query("SELECT distinct date from demijournee");	

				// on sauvegarde la date de la demi-journée
						echo "<tr><th scope='col'>Date :</th>";

						foreach ($lesDemiJournees as $enreg)
						{
							echo "<th scope='col'>$enreg->date</th>";

						}
						echo "</tr>";
						echo "</thead>";
			
						
			/*****************************************
			  On affiche les salles de la ligne matin
			 *****************************************/

						echo "<tbody>";
						echo "<tr>
						<th scope='row' class='align-middle'><strong>Matin</strong></th>" ;

						$lesDemiJournees=$bdd->query("SELECT id from demijournee where matinAprem='matin'");		
						foreach ($lesDemiJournees as $demiJournee)
						{

							$lesDemi=$bdd->query("SELECT idDemiJournee from choixprofdemijournee join demijournee on idDemijournee=$demiJournee->id and idUtilisateur=$id_Util");
							$selection=$lesDemi -> fetch();
							if($lesDemi->rowCount () != 0) {
								echo "<td><input type='checkbox' checked name='chbmatinJ$demiJournee->id' id='chbmatinJ$demiJournee->id' value='$demiJournee->id' disabled='disabled' /><br>";
							} else {

								echo "<td><input type='checkbox' name='chbmatinJ$demiJournee->id' id='chbmatinJ$demiJournee->id' value='$demiJournee->id' disabled='disabled' /><br>";
							}
							
						// si le prof a une salle attitré
							$lesSalles=$bdd->query("SELECT libelle, salle.id from utilisateur join Salle on idSalleAtt=Salle.id where utilisateur.id=$id_Util and idSalleAtt is not null");

						// le SELECT a retourné un enregistrement: on récupère l'enregistrement 
							$salle =$lesSalles->fetch();
							
						// si il n'a pas de salle attitré
							if($salle==false)
							{
						// on prend les salles de la bdd

								
								$lesSalles=$bdd->query("SELECT libelle 
									from choixprofdemijournee 
									join salle on salle.id=idSalle 
									where idUtilisateur=$id_Util 
									and idDemiJournee=$demiJournee->id");
								
							// on prend les salles qui ont été enregistrées dans la bdd par le prof
								if($lesSalles->rowCount() !=0 )
								{
									$salle=$lesSalles->fetch();
							// affichage des salles enregistrées par le prof	
									echo "$salle->libelle";	
								} 
							// si il n'a pas enregistrées de salle
								else 
								{
									echo "Aucune salle";
								}
							}
  						//affichage des salles attitré
							else 
							{
								echo "$salle->libelle";
							}

						}
						echo "</tr>";
						
			/*****************************************
			  On affiche les salles de la ligne aprem
			 ******************************************/
						echo "<tr>
						<th scope='row' class='align-middle'><strong>Après-midi</strong></th>" ;
			
						$lesDemiJournees=$bdd->query("SELECT id, date from demijournee where matinAprem='après-midi'");		
						foreach ($lesDemiJournees as $demiJournee)
						{

							$lesDemi=$bdd->query("SELECT idDemiJournee from choixprofdemijournee where idUtilisateur=$id_Util and idDemiJournee=$demiJournee->id ");
							if($lesDemi->rowCount () != 0) {
								echo "<td><input type='checkbox' checked name='chbapremJ$demiJournee->id' id='chbapremJ$demiJournee->id' value='$demiJournee->id'disabled='disabled'/><br>";
							} else {

								echo "<td><input type='checkbox' name='chbapremJ$demiJournee->id' id='chbapremJ$demiJournee->id' value='$demiJournee->id' disabled='disabled' /><br>";
							}

							$lesSalles=$bdd->query("SELECT libelle, salle.id from utilisateur join Salle on idSalleAtt=Salle.id where utilisateur.id=$id_Util and idSalleAtt is not null");

						// le SELECT a retourné un enregistrement: on récupère l'enregistrement 
							$salle =$lesSalles ->fetch();
							
						// si le prof n'a pas de salle attitré
							if($salle==false)
							{
						// on prend les salles dans la bdd			

								$lesSalles=$bdd->query("SELECT libelle 
									from choixprofdemijournee 
									join salle on salle.id=idSalle 
									where idUtilisateur=$id_Util 
									and idDemiJournee=$demiJournee->id");
								
								if($lesSalles->rowCount() !=0 )
								{
									$salle=$lesSalles->fetch();
									//on affiche les salles enregistrées par le prof 
									echo "$salle->libelle";	
								} 
								
						// si il n'a pas enregistré de salle 
								else 
								{
									echo "Aucune salle";
								}
							}
							else 
							{
						// affichage des salles attitré
								echo "$salle->libelle";
							}
						}
						?>
					</tbody>
					</table>
			


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
