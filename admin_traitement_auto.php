<?php include "assets_haut_admin.php"; ?> 
<div class="form-group d-flex justify-content-center"> 
<h1>Lancement du traitement automatique</h1>
</div>
<br><br>
<form action="traitement_auto.php" method="POST">
	<div class="form-group d-flex justify-content-center"> 

		<input class='btn btn-success btn-lg' type="submit" name="btn_valider" id="btn_valider" value="Lancer le traitement">

	</div>
	<div class="form-group d-flex justify-content-center">
		<?php extract($_GET);
			echo $msg;
		?>
	</div>
</form>

<?php include "assets_bas.php"; ?>
