<?php
require('fpdf.php');
include "connexion_bd_gesoraux.php";
include "script_datechaine.php";
extract($_POST);

$lesAbsences = $bdd->query("SELECT nomE, prenomE, divisionE, idE, disciplineE, epreuveE, plagHoraireE, jourE FROM elevespassantep where absenceE='O' ORDER BY nomE");

class PDF extends FPDF
{
// En-tête
function Header()
{
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Titre
    $this->Cell(0,10,'##ORAUX DE LANGUES##',1,0,'C');
    $this->Text(15, 17,utf8_decode("##SESSION 2019##"));
    // Saut de ligne
    $this->Ln(15);
    $this->SetFont('Arial','',8);
    $this->Cell(36,10,utf8_decode(''),0,0,'C');
    $this->Ln(8);
    $this->Cell(10,10,utf8_decode(''),0,0,'C');
    $this->Cell(28,5,utf8_decode('Division'),1,0,'C');
    $this->Cell(85,5,utf8_decode('Nom Prénom'),1,0,'C');
    $this->Cell(28,5,utf8_decode('Disipline'),1,0,'C');
    $this->Cell(40,5,utf8_decode('Epreuve'),1,0,'C');
    $this->Cell(35,5,utf8_decode('Plage horaire'),1,0,'C');
    $this->Cell(40.5,5,utf8_decode('Date'),1,0,'C');   
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
$maxf = 0;
foreach ($lesAbsences as $absence) {
  
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(10,10,utf8_decode(''),0,0,'C');
  $pdf->Cell(28,5,utf8_decode($absence->divisionE),1,0,'C');
  $pdf->Cell(85,5,utf8_decode($absence->nomE." ".$absence->prenomE),1,0,'L');
  $pdf->Cell(28,5,utf8_decode($absence->disciplineE),1,0,'C');
  $pdf->Cell(40,5,utf8_decode($absence->epreuveE),1,0,'C');
  $pdf->Cell(35,5,utf8_decode($absence->plagHoraireE),1,0,'C');
  $datefin = dateToFrench($absence->jourE,'l j F Y');
  $pdf->Cell(40.5,5,utf8_decode($datefin),1,0,'C');  

  $maxf = $maxf + 1;
  if ($maxf == 28) {
    $pdf->AddPage("L","A4");
    $pdf->Ln(3);
    $maxf = 0;
  }
}
$pdf->Output();
?>