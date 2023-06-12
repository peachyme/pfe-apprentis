

<?php
require('../pages/session.php');
require('../pages/connexionDB.php');




$date = date("d/m/Y");
$year = (int)date("Y");
$month = (int)date("m");

$resultatApprentis = $connexion->query("SELECT MATRICULE, NOM, PRENOM, NOM_ETABLISS, LIBELLE_SPC, LIBELLE_STRUCT
								                  FROM APPRENTI A,SPECIALITE S, STRUCTURE STR
								                  WHERE A.CODE_SPC = S.CODE_SPC
                                                  AND A.CODE_STR = STR.CODE_STRUCT
							 	                  AND SESSION=$year");



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
$pdf->Cell(120, 14, "LISTE DES APPRENTIS ADMIS", 'T', 0, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 7, "LAA-".$year."-".($year+1), 'TRLB', 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30);
$pdf->Cell(120, 14, "SESSION ".$year."/".($year+1), 'B', 0, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0.01);
$pdf->Cell(40, 7, "Date : ". $date, 'LBR', 1, 'C');

$pdf->Cell(150);
$pdf->Cell(40, 7, "page 1 sur 1", 'LBR', 1, 'C');



// Saut de ligne
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);


$pdf->Cell(190, 1, "", 'LRT', 1, 'L');

$pdf->Cell(65, 14, "   Apprenti", 'LB', 0, 'L');
$pdf->Cell(35, 14, "Spécialité", 'B', 0, 'L');
$pdf->Cell(35, 14, "      Structure", 'B', 0, 'L');
$pdf->Cell(55, 7, "   Etablissement", 'R', 1, 'L');
$pdf->Cell(135);
$pdf->Cell(55, 7, "   de formation", 'RB', 1, 'L');
$pdf->SetFont('Arial', '', 10);


$pdf->Cell(190, 5, "", 'LR', 1, 'L');

 while($apprenti = $resultatApprentis->fetch()){
     $nom = $apprenti['NOM'];
     $prenom = $apprenti['PRENOM'];
     $spc = $apprenti['LIBELLE_SPC'];
     $etab = $apprenti['NOM_ETABLISS'];
     $struct = $apprenti['LIBELLE_STRUCT'];
    $pdf->Cell(65, 10,  "   ".$nom." ". $prenom, 'L', 0, 'L');
    $pdf->Cell(35, 10, $spc, '', 0, 'L');
    $pdf->Cell(35, 10, "      ".$struct, '', 0, 'L');
    $pdf->Cell(55, 10, "   ".$etab, 'R', 1, 'L');
}
								
$pdf->Cell(190, 5, "", 'LR', 1, 'L');
$pdf->Cell(190, 1, "", 'LRB', 1, 'L');



//Afficher le pdf
$pdf->Output('', '', true);
?>


