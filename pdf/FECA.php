

<?php
require('../pages/session.php');
require('../pages/connexionDB.php');



$matricule = isset($_GET['matricule'])?$_GET['matricule']:0;

$requeteApprenti = "SELECT NOM, PRENOM, LIBELLE_SPC FROM APPRENTI A, SPECIALITE S 
                    WHERE A.CODE_SPC = S.CODE_SPC
                    AND MATRICULE = $matricule";

$resultatApprenti = $connexion->query($requeteApprenti);

$apprenti = $resultatApprenti->fetch();

$nom_prenom = strtoupper($apprenti['NOM'] . " " . $apprenti['PRENOM']);

$specialite = $apprenti['LIBELLE_SPC'];

$date = date("d/m/Y");

$numSeq = $matricule % 100;



require('fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A4)
$pdf = new FPDF('L', 'mm', 'A5');


//Ajouter une nouvelle page
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetAutoPageBreak(true)[5];
// entete
$pdf->Cell(30, 21, '', 'TBLR', 0);

$pdf->Image('gtp.jpg', 16.5, 12, 17, 17);


$pdf->Cell(0.01);
$pdf->Cell(120, 14, "FICHE D'ETABLISSEMENT D'UNE CARTE D'ACCES", 'T', 0, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 7, "FECA-SMG-".$numSeq, 'TRLB', 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30);
$pdf->Cell(120, 14, "POUR STAGIAIRES ET APPRENTIS", 'B', 0, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0.01);
$pdf->Cell(40, 7, "Date : ". $date, 'LBR', 1, 'C');

$pdf->Cell(150);
$pdf->Cell(40, 7, "page 1 sur 1", 'LBR', 1, 'C');




// Saut de ligne
$pdf->Ln(2);

// Début en police Arial normale taille 10

$pdf->SetFont('Arial', '', 10);
$h = 5;
$retrait = "      ";

$pdf->Write($h, $retrait . "Nom et prénom            : "  . "$nom_prenom\n");

$pdf->Write($h, $retrait . "Fonction                       : "  . "\n");

$pdf->Write($h, $retrait . "Spécialité                     : "  . "$specialite\n");

$pdf->Write($h, $retrait . "Matricule                      : "  . "$matricule\n");
 
$pdf->Write($h, $retrait . "Période                        : du : .................... au : ...................."  . " \n");

$pdf->Write($h, $retrait . "Groupe sanguin           : .................Rh"  . "\n");

$pdf->Write($h, $retrait . "N° du badge                 :  "  . "\n");

$pdf->Write($h, $retrait . "Date d'établissement   :  "  . "\n");

$pdf->Ln(2);

$pdf->Cell(50);
$pdf->Cell(7, 7, 'Stagiaire', '', 0);
$pdf->Cell(10);
$pdf->Cell(7, 7, '', 'TBLR', 0);

$pdf->Cell(40);
$pdf->Cell(7, 7, 'Apprenti', '', 0);
$pdf->Cell(10);
$pdf->Cell(7, 7, '', 'TBLR', 1);

$pdf->Ln(3);

$pdf->Cell(47.5, 7.5, 'Visa Chef de Service', 'TRL', 0, 'C');
$pdf->Cell(47.5, 7.5, 'Visa Chef de Service SIE', 'RT', 0, 'C');
$pdf->Cell(47.5, 7.5, 'Visa section TCA', 'RT', 0, 'C');
$pdf->Cell(47.5, 7.5, '        Signature de léintéressé', 'TR', 1, 'C');


$pdf->Cell(47.5, 3, 'Recrutement/Formation', 'LR', 0, 'C');
$pdf->Cell(47.5, 3, '', 'R', 0, 'C');
$pdf->Cell(47.5, 3, '', 'R', 0, 'C');
$pdf->Cell(47.5, 3, '', 'R', 1, 'C');

$pdf->Cell(47.5, 3, '', 'LR', 0, 'C');
$pdf->Cell(47.5, 3, '', 'R', 0, 'C');
$pdf->Cell(47.5, 3, '', 'R', 0, 'C');
$pdf->Cell(47.5, 3, '', 'R', 1, 'C');

$pdf->Cell(47.5, 20, '', 'BRL', 0, 'C');
$pdf->Cell(47.5, 20, '', 'BR', 0, 'C');
$pdf->Cell(47.5, 20, '', 'BR', 0, 'C');
$pdf->Cell(47.5, 20, '', 'BR', 1, 'C');

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(190, 10, "               Cette fiche doit être accompagnée de la feuille de route / PV d'installation / déclaration de perte de l'intéressé", 'LBR', 1, 'C');

$pdf->Ln(3);

$pdf->SetFont('Arial', '', 8);

$pdf->Cell(30);
$pdf->Cell(80, 5, 'Indice de révision : R0', 'B', 0, 'L');
$pdf->Cell(80, 5, 'Niveau de confidentialité 0 : R0', 'B', 1, 'R');
$pdf->Cell(30);
$pdf->Cell(150, 5, "GTP USAGE INTERNE - VALIDE LE JOUR DE L'IMPRESSION - VERIFIER QUE VOUS UTILISEZ LA DERNIERE VERSION", '', 0, 'L');


//Afficher le pdf
$pdf->Output('', '', true);
?>


