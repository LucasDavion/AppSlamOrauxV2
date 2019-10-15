<?php




require('fpdf.php');

class PDF extends FPDF
{
  // En-tête
  function Header()
  {

    //====================
    $lnlyce = "-6";
    //====================
      // Logo
      $this->Image('images/logo.png',10,10,30);
      // Police Arial gras 25
      $this->SetFont('Arial','B',25);
      // Décalage à droite
      $this->Cell(80);

      include "connexion_bd_gesoraux.php";
      $etablissement = $bdd->query("SELECT * FROM etablissement");
    	$etabli = $etablissement->fetch();

      $this->SetXY(100, 20);
      $this->Cell(0,10,'CONVOCATION',0,0);
      $this->SetFont('Arial','',8);
      $this->SetXY(10, 33);
      $this->Cell(0,10,utf8_decode($etabli->nomEtablissement),0,1);
      $this->Ln($lnlyce);
      $this->Cell(0,10,utf8_decode($etabli->complementNom),0,1);
      $this->Ln($lnlyce);
      $this->Cell(0,10,utf8_decode($etabli->adresse),0,1);
      $this->Ln($lnlyce);
      $this->Cell(0,10,utf8_decode($etabli->cp.$etabli->ville),0,1);
      $this->Ln($lnlyce);
      $this->Cell(0,10,utf8_decode('Téléphone : '.$etabli->tel),0,1);
      $this->Ln($lnlyce);
      $this->Cell(0,10,utf8_decode('Couriel : '.$etabli->email),0,1);
      $this->Ln($lnlyce);
      $this->Cell(0,10,utf8_decode('Site : '.$etabli->siteWeb),0,1);

      // Saut de ligne
      $this->Ln(25);
  }

  // Pied de page
  function Footer()
  {
    include "connexion_bd_gesoraux.php";
    $etablissement = $bdd->query("SELECT ville FROM etablissement");
    $etabli = $etablissement->fetch();

    $lieu = "$etabli->ville";
    $datee = date('Y-m-d');

    $datej = dateToFrench($datee,'l j F Y');
    $date = "$datej";
      // pied de page
      $this->SetY(-15);
      // Police Arial italique
      $this->SetFont('Arial','I',12);
      $this->SetXY(20, 250);
      $this->Cell(0,10,utf8_decode('Fait à '.$lieu.' le '.$date),0,1);
      $this->SetXY(20, 255);
      $this->Cell(20,10,utf8_decode("Signature du chef d'établissement"),0,1);
  }

}


 ?>
