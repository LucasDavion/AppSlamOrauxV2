<?php
include "assets_haut_admin.php";
include"connexion_bd_gesoraux.php";


$msgErr="";
$chk_horsperiode ="";
if (isset($_POST['btn_valider']) == true) {
  extract($_POST);

  if(empty($txt_date)){
        $msgErr="La date est obligatoire.<br>";
  }
  else
  {
    if ($chk_horsperiode != 'O') {
      $chk_horsperiode = 'N';
    }
    if($msgErr ==""){
      try{
        $lesEnregs=$bdd->prepare("insert into demijournee values(0,:par_date,:par_matin,:par_periode)");
        $lesEnregs->bindValue(":par_date", $txt_date, PDO::PARAM_STR);
        $lesEnregs->bindValue(":par_matin", "matin", PDO::PARAM_STR);
        $lesEnregs->bindValue(":par_periode", $chk_horsperiode, PDO::PARAM_STR);
        $lesEnregs->execute();
      } catch(PDOException $e){
        echo("ErrInsDemiJour : Erreur lors de l'insertion de la demi-journee du matin dans admin_selection_periode_oraux.php.<br>
            Message d'erreur : ".$e->getMessage());
      }
      try{
          $lesEnregs=$bdd->prepare("insert into demijournee values(0,:par_date,:par_aprem,:par_periode)");
          $lesEnregs->bindValue(":par_date", $txt_date, PDO::PARAM_STR);
          $lesEnregs->bindValue(":par_aprem", "après-midi", PDO::PARAM_STR);
          $lesEnregs->bindValue(":par_periode", $chk_horsperiode, PDO::PARAM_STR);
          $lesEnregs->execute();
      } catch(PDOException $e){
          echo ("ErrInsDemiJour : Erreur lors de l'insertion de la demi-journee de l'après-midi dans admin_selection_periode_oraux.php.<br>Message d'erreur : ".$e->getMessage());
      }
      $msgErr = "La journée a bien été ajoutée";
    }
  }  
}
?>
      <section>
        <div class="container text-center">
          <br><br><h1>Ajout d'une journée</h1>
          <hr>
        </div>
      </section>
      <section>
        <div class="container text-center">
          <div class="row">
            <div class="col">
            </div>

              <div class="shadow-lg p-3 mb-5 bg-white rounded">

                <!-- Mon scrip a moi-->

                <form action="" method="post">

                  <!-- Saisie des dates -->

                  <div class="form-group">
                    Date
                    <input class="form-control" type="date" name="txt_date" value="" required>
                  </div>

              <!-- Saisie si c'est hors periode -->

                  <input type="checkbox" id="horsperiode" name="chk_horsperiode" value="O">
                  <label for="horsperiode">Cochez si cette date doit être utilisée pour le rattrapage</label>
                  <br>
                  <br>

                  <!-- Bouton valider-->
                  <div>
                    <input type="submit" class="btn btn-success btn-lg" name="btn_valider" value="Valider">
                  </div>
                  <div>
                    <label class="col-md-7"><br><?php echo $msgErr; ?></label>
                  </div>
                </form>
                <!-- Fin de mon script a moi -->

              </div>

            <div class="col">
            </div>
          </div>
        </div>
      </section>
   <?php 
   include "assets_bas.php";
   ?>