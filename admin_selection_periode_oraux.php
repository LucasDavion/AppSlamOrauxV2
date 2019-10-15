<?php
include "assets_haut_admin.php";
?>
<?php
    // connaître toutes les dates entre deux dates
function getDatesBetween($debut, $fin){
    if($debut>$fin){
        return false;
    }

                // définir la date de début et date de fin

    $debDate=strtotime($debut);
    $finDate=strtotime($fin);

                // création du tableau
    $dates=array();

                // mise dans un tableau de toutes les dates entre les deux dates saisies
    for($i=$debDate; $i <= $finDate; $i += strtotime('+1 day', 0)){
        $dates[] = date('Y-m-d', $i);
    }
    return $dates;

}

    // connaître tous les jours fériers
function getHolidays($year=null){

    if ($year === null)
    {
        $year = intval(strftime('%Y'));
    }

    $easterDate = easter_date($year);
    $easterDay = date('j', $easterDate);
    $easterMonth = date('n', $easterDate);
    $easterYear = date('Y', $easterDate);

    $holidays = array(
                        // Jours feries fixes
                        date('Y-m-d',mktime(0, 0, 0, 1, 1, $year)),// 1er janvier
                        date('Y-m-d',mktime(0, 0, 0, 5, 1, $year)),// Fete du travail
                        date('Y-m-d',mktime(0, 0, 0, 5, 8, $year)),// Victoire des allies
                        date('Y-m-d',mktime(0, 0, 0, 7, 14, $year)),// Fete nationale
                        date('Y-m-d',mktime(0, 0, 0, 8, 15, $year)),// Assomption
                        date('Y-m-d',mktime(0, 0, 0, 11, 1, $year)),// Toussaint
                        date('Y-m-d',mktime(0, 0, 0, 11, 11, $year)),// Armistice
                        date('Y-m-d',mktime(0, 0, 0, 12, 25, $year)),// Noel

                        // Jour feries qui dependent de paques
                        date('Y-m-d',mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear)),// Lundi de paques
                        date('Y-m-d',mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear)),// Ascension
                        date('Y-m-d',mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear)), // Pentecote
                    );

    sort($holidays);

    return $holidays;
}


include"connexion_bd_gesoraux.php";

$msg="";
$txt_dateDeb="";
$txt_dateFin="";
$msgErr ="";

if(isset($_POST['btn_valider'])==true){
    extract($_POST);

    if(empty($txt_dateDeb)){
        $msgErr=$msgErr."La date de début est obligatoire.<br>";
    }
    if(empty($txt_dateFin)){
        $msgErr=$msgErr."La date de fin est obligatoire.<br>";
    }

    // savoir si les professeurs ont déja choisi leurs voeux
    $lesChoix=$bdd->query("SELECT count(*) as 'choixProf' from choixprofdemijournee");
    $choix=$lesChoix->fetch();

    if($choix->choixProf>0)
    {
        $msgErr = "Il y a déja des professeurs qui ont fait des choix.";
    } else {

        $msgErr ="";
        // suppression de la table demijournee
        $supp1=$bdd->query("SET FOREIGN_KEY_CHECKS=0");
        $supp2=$bdd->query("truncate table demijournee");
        $supp4=$bdd->query("truncate table plagedemijournee");
        $supp3=$bdd->query("SET FOREIGN_KEY_CHECKS=1");
        // tableau contenant les dates

        $dates = getDatesBetween($txt_dateDeb,$txt_dateFin);

        // tableau contenant les jours fériers
        $holidays = getHolidays();
        $trouve=false;
        $ind=0;

        if($msgErr==""){
            foreach ($dates as $date) {  
                // savoir si le jour est un jour férié
                while($trouve==false && $ind<count($holidays)){
                    if($holidays[$ind]==$date){
                        $trouve = true;
                    } else {
                        $ind=$ind+1;
                    }   
                } 
                if($trouve== false){

                    // si le jour saisi est différent d'un samedi=6, d'un dimanche=0, on insère le matin
                    if(date("w",strtotime($date))!=0 && date("w",strtotime($date))!=6 ){ 

                        // insert du matin                                          
                        try{
                            $lesEnregs=$bdd->prepare("insert into demijournee values(0,:par_date,:par_matin,:par_periode)");
                            $lesEnregs->bindValue(":par_date", $date, PDO::PARAM_STR);
                            $lesEnregs->bindValue(":par_matin", "matin", PDO::PARAM_STR);
                            $lesEnregs->bindValue(":par_periode", "N", PDO::PARAM_STR);
                            $lesEnregs->execute();
                            $idDemiJournee = $bdd->lastInsertId();
                        } catch(PDOException $e){
                            die("ErrInsDemiJour : Erreur lors de l'insertion de la demi-journee du matin dans admin_selection_periode_oraux.php.<br>
                                Message d'erreur : ".$e->getMessage());
                        }

                        $lesEnregs = $bdd->query("SELECT id from plage where matinAprem = 'matin'");
                        
                        foreach ($lesEnregs as $plage) {
                            
                            
                            try{
                                $lesEnregs=$bdd->prepare("insert into plagedemijournee values(:par_idDemiJournee,:par_idPlage)");
                                $lesEnregs->bindValue(":par_idDemiJournee", $idDemiJournee, PDO::PARAM_STR);
                                $lesEnregs->bindValue(":par_idPlage", $plage->id, PDO::PARAM_STR);
                               
                                $lesEnregs->execute();
                            } catch(PDOException $e){
                                die("ErrInsDemiJour : Erreur lors de l'insertion de la demi-journee du matin dans admin_selection_periode_oraux.php.<br>
                                    Message d'erreur : ".$e->getMessage());
                            }
                        
                        }
                    }
                    // si le jour saisi est différent d'un samedi=6, d'un dimanche=0,d'un mercredi=3 et n'est pas un jour férier, on insère l'après-midi
                    if(date("w",strtotime($date))!=0 && date("w",strtotime($date))!=6){
                        // insert de l'après-midi
                        try{
                            $lesEnregs=$bdd->prepare("insert into demijournee values(0,:par_date,:par_aprem,:par_periode)");
                            $lesEnregs->bindValue(":par_date", $date, PDO::PARAM_STR);
                            $lesEnregs->bindValue(":par_aprem", "après-midi", PDO::PARAM_STR);
                            $lesEnregs->bindValue(":par_periode", "N", PDO::PARAM_STR);
                            $lesEnregs->execute();
                            $idDemiJournee = $bdd->lastInsertId();
                        } catch(PDOException $e){
                            die ("ErrInsDemiJour : Erreur lors de l'insertion de la demi-journee de l'après-midi dans admin_selection_periode_oraux.php.<br>Message d'erreur : ".$e->getMessage());
                        }

                        $lesEnregs = $bdd->query("SELECT id from plage where matinAprem = 'après-midi'");

                        foreach ($lesEnregs as $plage) {
                            try{
                                $lesEnregs=$bdd->prepare("insert into plagedemijournee values(:par_idDemiJournee,:par_idPlage)");
                                $lesEnregs->bindValue(":par_idDemiJournee", $idDemiJournee, PDO::PARAM_STR);
                                $lesEnregs->bindValue(":par_idPlage", $plage->id, PDO::PARAM_STR);
                               
                                $lesEnregs->execute();
                            } catch(PDOException $e){
                                die("ErrInsDemiJour : Erreur lors de l'insertion de la demi-journee du matin dans admin_selection_periode_oraux.php.<br>
                                    Message d'erreur : ".$e->getMessage());
                            }
                        
                        }
                    }
                }                

            }
        }
        $msgErr = "La période a été enregistrée";
    }
}
?>

    <!-- code !-->
    <section>
        <header>
            <h1 class="text-center">Sélection de la période des oraux</h1>
        </header>

        <div class="container">
            <div class="">
                <div class="col">                 
                    <br>
                    <form class="" action="" method="post">
                        <div class="form-group">
                            <label class="col-md-8">Date de début</label>
                            <div class="col-md-8">
                                <input class="form-control" type="Date" name="txt_dateDeb" value="<?php echo $txt_dateDeb;?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Date de fin</label>
                            <div class="col-md-8">
                                <input class="form-control" type="Date" name="txt_dateFin" value="<?php echo $txt_dateFin;?>" required>
                            </div>
                        </div>                      
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-md-5">
                                <input class='btn btn-success btn-lg' type="submit" name="btn_valider" value="Valider" />
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <label class="col-md-7"><br><?php echo $msgErr; ?></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </section>


<?php 
include "assets_bas.php";
?>