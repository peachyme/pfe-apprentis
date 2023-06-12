<?php
	require_once('session.php');
?>

<?php

	require_once('connexionDB.php');
	
    $matricule = $_POST['matricule'];
    $numSeq = $matricule % 100;
	$libelle = $_POST['libelléDAP'];
	$designation = $_POST['designationDAP'];
	$date = $_POST['dateDAP'];
    $year = date("y",strtotime($date));
    if(strlen($numSeq)==1)
    {
        $code = $libelle.$year."0".$numSeq;
    }
    else
    {
        $code = $libelle.$year.$numSeq;
    }
    	
	$nomDocument = $_FILES['dap']['name'];	
	$DocumentTmp = $_FILES['dap']['tmp_name'];
	move_uploaded_file($DocumentTmp,'../documents/'.$nomDocument);
	
	$requete="INSERT INTO DAP(CODE_DAP, LIBELLE_DAP, DESIGN_DAP, DATE_DAP, DOCUMENT, MATRICULE) VALUES(?,?,?,?,?,?)";	
	$resultat = $connexion->prepare($requete);			
	$param=array($code, $libelle, $designation, $date, $nomDocument, $matricule);			
	$resultat->execute($param);	
		
	header("location:vueDAP.php?matricule=$matricule");
	
?>