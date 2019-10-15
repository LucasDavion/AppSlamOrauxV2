<?php
    include "connexion_bd_gesoraux.php";
    //variables de session
    session_start();
var_dump($_SESSION);
    $idProf = $_SESSION['id'];  
    $valeur="";
    $val_select="";

    try{
        $laValeur = explode(" ", $_POST["idPassageEpreuve"]);
        $idPassageEpreuve = $laValeur[0];
        $caseCochee = $_POST['caseCochee'];
        if ($caseCochee == 'true')
        {
            // ---------------------------------------------------------------------
            // on réalise la requête de mise à jour : affectation du prof connecté
            // ---------------------------------------------------------------------
            $req=$bdd->prepare("UPDATE passageepreuve set idProfChoix =:par_idProf where id=:par_idEpreuve");
            $req->bindValue(':par_idProf', $idProf, PDO::PARAM_INT);
            $req->bindValue(':par_idEpreuve', $idPassageEpreuve,PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $req->execute();

            echo ($_SESSION['nom']);
        } else {
            // ---------------------------------------------------------------------
            // on réalise la requête de mise à jour : suppression du prof affecté
            // ---------------------------------------------------------------------
            $req = $bdd->prepare("UPDATE passageepreuve set idProfChoix = null where id = :par_id");
            $req->bindValue(':par_id', $idPassageEpreuve, PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $req->execute();
            echo " ";

        }
    }catch(PDOException $e){
        die("err BDUpdate : erreur d'update tables dans valider.php<br>
        Message d'erreur : ".$e->getMessage());
    }
?>