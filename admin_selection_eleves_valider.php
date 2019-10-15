<?php
include "connexion_bd_gesoraux.php";
$valeur="";
$val_select="";
if(isset($_POST['btn_valider'])==true){
    foreach($_POST as $cle=>$valeur){
        try{
                //On récupère la valeur de l'idEpreuve
            if (strpos($cle, "idEpreuve")===0) {
                $val_idEpreuve=$valeur;
            }
            //on récupère la valeur de l'idSalle
            if(strpos($cle, "lst_salle")===0)
            {
                $val_idSalle=$valeur; 
            }
            //on récupère la valeur séléctionné pour la plage
            if(strpos($cle, "lst_plage")===0)
            {
                $val_plage=$valeur;

                // on sépare la date et l'heure de l'épreuve
                $lesPlages = explode(" ",$val_plage);
                $idDemiJournee = $lesPlages[0];
                $idPlage = $lesPlages[1];
            }
                ////On récupère l'id du prof sélectionné
            if(strpos($cle, "lst_prof") ===0) {
                $val_prof=$valeur;
                $req=$bdd->prepare("UPDATE passageepreuve set idProfAffecte =:par_idProf, idSalle = :par_Salle, idDemiJournee = :par_idDemiJournee, idPlage = :par_idPlage
                   where id=:par_idEpreuve");
                    //si l'id prof est 0 alors on met null dans la bdd
                if ($val_prof==0){
                    $req->bindValue (':par_idProf', null, PDO::PARAM_INT);
                }else {
                        //sinon on met l'id du professeur sélectionné
                    $req->bindValue(':par_idProf', $val_prof,PDO::PARAM_INT);
                }
                $req->bindValue(':par_Salle', $val_idSalle,PDO::PARAM_INT);
                $req->bindValue(':par_idDemiJournee', $idDemiJournee,PDO::PARAM_INT);
                $req->bindValue(':par_idPlage', $idPlage,PDO::PARAM_INT);
                $req->bindValue(':par_idEpreuve', $val_idEpreuve,PDO::PARAM_INT);
                
                $req->execute();
                    //on se redirige vers la sélection des élèves en fournissant le message d'information
                $msg="Les modifications ont été prises en compte";
                header('Location:admin_selection_eleves.php?msg='.$msg);
            }   
        }catch(PDOException $e){
            die("err BDUpdate : erreur d'update table passageepreuve dans admin_selection_eleves_valider.php<br>
                Message d'erreur : ".$e->getMessage());
        }
    }
}
?>