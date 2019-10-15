<?php
require('fpdf.php');

include "connexion_bd_gesoraux.php";
include "script_datechaine.php";
extract($_POST);

if (isset($_POST["btn_genererclasse"]) == true) {
  $lesEleves = $bdd->query("SELECT *
    FROM elevespassantep
    WHERE  idP = $lst_prof
    ORDER BY nomE");
  }



  class PDF extends FPDF
  {
    // En-tête
    function Header()
    {
      include "connexion_bd_gesoraux.php";
      extract($_POST);
      $leexam = $bdd->query("SELECT nom FROM NomExam");
      $exam = $leexam->fetch();

      $leProf = $bdd->query("SELECT nom, prenom
        FROM utilisateur
        WHERE  id = $lst_prof");
        $ptof = $leProf->fetch();
        $nomProf = $ptof->nom;
        $prenomProf = $ptof->prenom;
        $dateencours = date('Y');


        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        $this->SetTitle("Fiches d'émargement de $nomProf $prenomProf - $dateencours", "true");
        // Titre
        $this->Cell(0,10,'Emargement '.$exam->nom,1,0,'C');
        $dateencours = date('Y');
        $this->Text(15, 17,utf8_decode("Session $dateencours"));
        $this->SetXY(10,25);
        $this->Cell(0,5,utf8_decode("$nomProf $prenomProf"),0,0,'C');
        // Saut de ligne
        $this->Ln(0);
        $this->SetFont('Arial','',8);
        $this->Cell(36,8,utf8_decode(''),0,0,'C');
        $this->Ln(8);
        $this->Cell(15,8,utf8_decode('Division'),1,0,'C');
        $this->Cell(66,8,utf8_decode('Nom Prénom'),1,0,'C');
        $this->Cell(15,8,utf8_decode('1/3 temps'),1,0,'C');
        $this->Cell(20,8,utf8_decode('Épreuve'),1,0,'C');
        $this->Cell(25,8,utf8_decode('Langue'),1,0,'C');
        $this->Cell(40,8,utf8_decode('Date'),1,0,'C');
        $this->Cell(20,8,utf8_decode('Heure'),1,0,'C');
        $this->Cell(20,8,utf8_decode('Salle'),1,0,'C');
        $this->Cell(56,8,utf8_decode('Signature'),1,0,'C');

      }

      // Pied de page
      function Footer()
      {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page

      }
    }

    // Instanciation de la classe dérivée
    $pdf = new PDF();

    $pdf->AddPage("L","A4");
    $pdf->SetFont('Arial','',8);

    $ep = 1;
    $maxf = 0;
    foreach ($lesEleves as $eleve) {
      if ($ep == 1) {
        $pdf->SetXY(10,25);
        $pdf->Cell(71,8,utf8_decode(''),0,0,'C');
        $compteep=0;

        $pdf->SetXY(10,36);
      }
      $ep = 0;
      $id = $eleve->idE;
      $pdf->Ln(5);
      $pdf->SetFont('Arial','',7);

      $pdf->Cell(15,5,utf8_decode($eleve->divisionE),1,0,'C');


      if ($eleve->tiersTempsE == "O") {
        $pdf->SetFillColor(180);
        $pdf->Cell(66,5,utf8_decode($eleve->nomE." ".$eleve->prenomE),1,0,'L',true);
        $pdf->Cell(15,5,utf8_decode("".$eleve->tiersTempsE),1,0,'C',true);
      } else {
        $pdf->Cell(66,5,utf8_decode($eleve->nomE." ".$eleve->prenomE),1,0,'L');
        $pdf->Cell(15,5,utf8_decode("".$eleve->tiersTempsE),1,0,'C');
      }

      // converti la date en chaine Ex.Lundi 12 juin 2019
      $datefin = dateToFrench("$eleve->jourE",'l j F Y');

      $pdf->Cell(20,5,utf8_decode("".$eleve->epreuveE),1,0,'C');
      $pdf->Cell(25,5,utf8_decode("".$eleve->disciplineE),1,0,'C');
      $pdf->Cell(40,5,utf8_decode("".$datefin),1,0,'C');




      $pdf->Cell(20,5,utf8_decode("".$eleve->plagHoraireE),1,0,'C');
      $pdf->Cell(20,5,utf8_decode("".$eleve->salleE),1,0,'C');

      $pdf->Cell(56,5,utf8_decode(''),1,0,'C');
      $maxf = $maxf + 1;
      if ($maxf == 29) {
        $pdf->AddPage("L","A4");
        $pdf->Ln(3);
        $maxf = 0;
        $ep = 1;
      }
    }
    $pdf->Output();
    ?>
