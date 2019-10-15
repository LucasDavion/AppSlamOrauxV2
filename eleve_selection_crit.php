<?php 
     include "connexion_bd_gesoraux.php";
    //on vérifie que l'on a bien reçu l'id de la division en POST et qu'il est >0

    //--------------------ICI-----------------------
    echo"<div class='d-flex justify-content-center'>";		
        echo"<div class'table table-striped'>";
    //---------------------------------------------
     
   if(isset($_POST['idDivision'])==true && $_POST['idDivision']>=0){
        $idDivision=$_POST['idDivision'];
        $idDiscipline = $_POST['idDiscipline'];

        if(isset($_POST['idnatep'])==true && ($_POST['idnatep']>=1 || $_POST['idnatep']=='T')){
           
            try{
            if($_POST["idnatep"]=='T'){
                extract($_POST);
                    //récupération (select) des enregistremnts de la table élève dont la division est 
                    //identique à celle transmise
                    $lesEnregs=$bdd->query(" SELECT passageepreuve.id as idEp, eleve.nom as 'nom', eleve.prenom as 'prenom', 
                    division.libelle as 'division', natureepreuve.libelle as 'natureepreuve', utilisateur.nom as 'professeur',idProfChoix 
                        from passageepreuve 
                        left outer join utilisateur on idProfChoix=utilisateur.id
                        left outer join eleve on idEleve=eleve.id
                        join division on idDivision=division.id 
                        join epreuve on idEpreuve=epreuve.id 
                        join natureepreuve on idNatureEpreuve=natureepreuve.id 
                        where epreuve.idDiscipline=$idDiscipline and ((idDivision=$idDivision and $idDivision !=0) 
                        or $idDivision =0) order by eleve.nom ");
            }
            else{
                extract($_POST);
                    //si on demande une nature d'épreuve spécifique 
                    //on ne récupère que les élèves ayant cette nature d'épreuve
                    $lesEnregs=$bdd->query("SELECT passageepreuve.id as idEp, eleve.nom as 'nom', eleve.prenom as 'prenom', 
                    division.libelle as 'division', natureepreuve.libelle as 'natureepreuve', utilisateur.nom as 'professeur',idProfChoix 
                    from passageepreuve 
                    left outer join utilisateur on idProfChoix=utilisateur.id
                    left outer join eleve on idEleve=eleve.id
                    join division on idDivision=division.id 
                    join epreuve on idEpreuve=epreuve.id 
                    join natureepreuve on idNatureEpreuve=natureepreuve.id 
                    where epreuve.idDiscipline=$idDiscipline and ((idDivision=$idDivision and $idDivision !=0) or $idDivision =0)  
                    and (natureepreuve.id= $idnatep) order by nom");
            }
            }catch(PDOException $e){
                //erreur grave (exception lors de la lecture)
                die("Err BDALec01Erreur : erreur de SELECT dans eleve_selection_crit.php<br>Message d'erreur :".$e->getMessage());
            }
                if($lesEnregs->rowCount()==0){
                    //affichage d'un message informant qu'il n'existe pas d'élève avec cette division
                    echo("Il n'y a aucun élève ayant la division sélectionnée<br><br>");
                }else{
                    //alimentation du tableau avec le nom,prénom,division, LV1/LV2, professeur ayant choisi l'élève

                    echo"<form action='prof_update_passageepreuve.php' method='POST'>";
                    //---------------ICI----------------------------
                        echo" <table class ='table table-striped text-center'>";
                        echo" <thead class='thead-dark'>";
                    //----------------------------------------------------
                        echo" <tr>";
                        echo"<th>Sélectionner</th>";
                   
                        echo "<th>Nom</th>";
                        echo "<th>Prénom</th>";
                        echo "<th>Division</th>";
                        echo "<th>LV1/LV2</th>";
                        echo "<th>Professeur</th>";
                        echo" </tr>";
                       
                        //On affiche une checkbox si aucun prof n'a choisi l'élève, sinon une case vide ou une case sélectionner.
                        foreach($lesEnregs as $enreg){
                            echo" <tr>";
                            if($enreg->idProfChoix != null && ($_POST['idProf']==$enreg->idProfChoix)){
                                 echo"<td><input type='checkbox' value='$enreg->idEp $enreg->natureepreuve' id='sel$enreg->idEp' onclick='majNbSelectionne(this);' checked /></td>";
                            }
                            else{
                                echo"<td><input type='checkbox' value='$enreg->idEp $enreg->natureepreuve' id='sel$enreg->idEp' onclick='majNbSelectionne(this);' /></td>"; 
                            }
                           
                            echo "<td> $enreg->nom</td>";
                            echo "<td> $enreg->prenom</td>";
                            echo "<td> $enreg->division</td>";
                            echo "<td> <label class ='LV'>$enreg->natureepreuve</label></td>";
                            echo "<td> $enreg->professeur</td>";
                            echo" </tr>";
                    }
                    echo" </table>";
                    echo"</form>";
                    ?>
                    <script>
                    $(document).ready(function(){
                    //Ajax pour les checkbox
                        $('input[type=checkbox]').change(function () {
                            console.log("Appel");
                            $.ajax({
                                url : 'prof_update_passageepreuve.php', // script appelé
                                type : 'POST', // Le type de la requête HTTP est POST
                                data : 'caseCochee=' + $(this).prop('checked')+'&idPassageEpreuve='+$(this).val(), // le coché/décoché
                                dataType : 'html',                               
                            });
                        });
                    });
                    </script>
        <?php
        }
    }
}
                   
    ?>
</div>
</div>

