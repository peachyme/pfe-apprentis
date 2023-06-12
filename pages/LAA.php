

<?php
require('../pages/session.php');
require('../pages/connexionDB.php');




$date = date("d/m/Y");
$year = (int)date("Y");
$month = (int)date("m");

$resultatListPaie = $connexion->query( "SELECT  PAIE.MATRICULE, NOM, PRENOM, PAIE_P, NB_ABS
                                        FROM PAIE, APPRENTI
                                        WHERE PAIE.MATRICULE = APPRENTI.MATRICULE 
                                        AND MONTH(DATE_P)=$month AND YEAR(DATE_P)=$year");




require('fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A4)
$pdf = new FPDF('P', 'mm', 'A4');


//Ajouter une nouvelle page
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetAutoPageBreak(true)[5];
// entete
$pdf->Cell(30, 21, '', 'TBLR', 0);

$pdf->Image('gtp.jpg', 16.5, 12, 17, 17);


$pdf->Cell(0.01);
$pdf->Cell(120, 21, "LISTE NOMINATIVE DES PRESALAIRES DES APPRENTIS", 'TB', 0, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 7, "LNP-".$month."-".$year, 'TRLB', 1, 'C');


$pdf->SetFont('Arial', '', 12);
$pdf->Cell(150);
$pdf->Cell(40, 7, "Date : ". $date, 'LBR', 1, 'C');

$pdf->Cell(150);
$pdf->Cell(40, 7, "page 1 sur 1", 'LBR', 1, 'C');



// Saut de ligne
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);


$pdf->Cell(190, 1, "", 'LRT', 1, 'L');

$pdf->Cell(80, 10, "   Apprenti", 'LB', 0, 'L');
$pdf->Cell(60, 10, "   Nombre d'absence", 'B', 0, 'L');
$pdf->Cell(50, 10, "   Paie", 'RB', 1, 'L');
$pdf->SetFont('Arial', '', 10);



 while($paie = $resultatListPaie->fetch()){
     $nom = $paie['NOM'];
     $prenom = $paie['PRENOM'];
     $nb = $paie['NB_ABS'];
     $paiee = $paie['PAIE_P'];
    $pdf->Cell(90, 10,  "   ".$nom." ". $prenom, 'L', 0, 'L');
    $pdf->Cell(50, 10, "       ".$nb, '', 0, 'L');
    $pdf->Cell(50, 10, "   ".$paiee."  DA", 'R', 1, 'L');
}
								

$pdf->Cell(190, 1, "", 'LRB', 1, 'L');



//Afficher le pdf
$pdf->Output('', '', true);
?>


