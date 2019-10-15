<?php
include "identiteEtablisement.php";

include "connexion_bd_gesoraux.php";

include "script_datechaine.php";

try {
	// Instanciation de la classe dérivée
	$pdf = new PDF('P','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$dateencours = date('Y');

	//variables future


	$leexam = $bdd->query("SELECT nom FROM NomExam");
	$exam = $leexam->fetch();

	$etablissement = $bdd->query("SELECT * FROM etablissement");
	$etabli = $etablissement->fetch();

	$exam= "$exam->nom";
	$sess= $dateencours;
	$desc="J'ai l'honneur de vous demander de vous présenter à l'heure indiquée muni(e) de cette convocation et d'une piéce d'identité en cours de validité (photographie récente de préfèrence) aux lieux, dates et horaires indiqués ci-dessous.";
	$titreGCadre="$etabli->nomEtablissement - $etabli->adresse - $etabli->cp $etabli->ville";
	$lieu="$etabli->ville";

	extract($_POST);

	if (isset($_POST["btn_tout-generer"]) == true) {
		$lesEleves = $bdd->query("SELECT Distinct nomE, prenomE, divisionE, idE FROM elevespassantep");
		$pdf->SetTitle("Toutes les convocations - $dateencours", "true");
	} else {
		if (isset($_POST["btn_genererclasse"]) == true) {
			$lesEleves = $bdd->query("SELECT Distinct nomE, prenomE, divisionE, idE FROM elevespassantep WHERE divisionE = '$lst_section' ");

			$pdf->SetTitle("Convocations de la classe $lst_section - $dateencours", "true");
		} else {
			if (isset($_POST["btn_generereleve"]) == true) {
				$lesEleves = $bdd->query("SELECT Distinct nomE, prenomE, divisionE, idE FROM elevespassantep WHERE idE = $lst_eleve ");
				$lInfo = $bdd->query("SELECT nom, prenom FROM eleve WHERE id =$lst_eleve");
				$uneInfo = $lInfo->fetch();

				$nomEleve = $uneInfo->nom;
				$prenomEleve = $uneInfo->prenom;

				$pdf->SetTitle("Convocation pour $nomEleve $prenomEleve - $dateencours", "true");
			} else {
				echo "erreur";
			}
		}
	}

	$nbConvoc = 0;

	foreach ($lesEleves as $eleve) {
		$nbConvoc = $nbConvoc + 1;
		$id = $eleve->idE;

		$pdf->SetFont('Arial','I',15);
		$pdf->SetXY(80, 45);
		$pdf->Cell(0,10,utf8_decode('Examen : '.$exam),0,1);
		$pdf->SetXY(80, 55);
		$pdf->Cell(0,10,utf8_decode('SESSION : '.$sess),0,1);


		$pdf->Rect(10, 80, 190, 20); //rectangle nom prenom

		//------------------ interieur rectange nom prenom

		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(15, 85);
		$pdf->Cell(0,10,utf8_decode($eleve->nomE." ".$eleve->prenomE),0,1);
		$pdf->SetXY(160, 85);
		$pdf->Cell(0,10,utf8_decode('Classe : '.$eleve->divisionE),0,1);

		//------------------ formule de politesse

		$pdf->SetFont('Arial','',12);
		$pdf->Ln(10);
		$pdf->MultiCell(190, 5,utf8_decode($desc),0, "J");

		$pdf->Rect(10, 125, 190, 120); //rectangle nom prenom

		//------------------ titre grand cadre

		$pdf->SetFont('Arial','',13);
		$pdf->SetXY(5, 130);
		$pdf->MultiCell(200, 5,utf8_decode($titreGCadre),0, "C");

		//------------------ bloc debut

		$lesEpreuves = $bdd->query("SELECT * FROM elevespassantep where idE = $id");

		$X=20;
		$Y=180;
		$ind="N";
		$Xr= 15;
		$Yr= 160;
		foreach ($lesEpreuves as $epreuve) {

			$pdf->SetFont('Arial','',13);

			if ($ind == "O") {

				$pdf->SetXY($X, $Y);
				$pdf->MultiCell(200, 5,utf8_decode("ET"),0, "L");

				$Y=$Y+25;
			}

			if ($lesEpreuves->rowCount() != 1) {
				$ind="O";
			}

			// Affiche : mardi 11 septembre 2001.
			$datefin = dateToFrench($epreuve->jourE,'l j F Y');

			$pdf->SetXY($Xr, $Yr);
			$pdf->MultiCell(200, 5,utf8_decode("Le ".$datefin),0, "L");


			$Yr= $Yr+5;
			$pdf->SetXY($Xr, $Yr);
			$pdf->MultiCell(200, 5,utf8_decode("A ".$epreuve->plagHoraireE),0, "L");


			$Yr= $Yr+5;
			$pdf->SetXY($Xr, $Yr);
			$pdf->MultiCell(200, 5,utf8_decode("En salle : ".$epreuve->salleE),0, "L");

			$Xr= $Xr+95;
			$Yr= $Yr-10;
			$pdf->SetXY($Xr, $Yr);
			$pdf->MultiCell(200, 5,utf8_decode("Épreuve obligatoire ".$epreuve->epreuveE." : ".$epreuve->disciplineE),0, "L");


			$Yr= $Yr+5;
			$pdf->SetXY($Xr, $Yr);
			$pdf->MultiCell(200, 5,utf8_decode("Durée de l'épreuve : ".$epreuve->dureeEpreuveE." Minutes"),0, "L");

			$Xr= 15;
			$Yr= $Yr+20;

		}

		$pdf->AddPage();

	}

	$pdf->SetFont('Arial','',20);
	$pdf->SetXY(30, 100);
	$pdf->MultiCell(150, 5,utf8_decode("TOTAL :"),0, "L");
	$pdf->SetXY(30, 110);
	$pdf->MultiCell(150, 5,utf8_decode("Convocation(s) générée(s) : ".$nbConvoc),0, "L");

	$pdf->Output();

} catch (PDOException $e) {
	die("erreur".$e->GetMessage());
}

?>
