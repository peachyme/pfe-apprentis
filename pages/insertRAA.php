<?php
	require_once('session.php');
	require_once('connexionDB.php');
	include '../fonctions/fonctions.php'; 

	
    $matricule = $_POST['matricule'];
    $numSeq = $matricule % 100;
    $session = (int)($matricule/10000); 
	$libelle = $_POST['libelléRAA'];
	$designation = $_POST['designationRAA'];
	$date = $_POST['dateRAA'];
    $year = date("y",strtotime($date));    
    $month = date("m",strtotime($date));
    if(strlen($numSeq)==1)
    {
        $code = $libelle.$session.$month.$year."0".$numSeq;
    }
    else
    {
        $code = $libelle.$session.$month.$year.$numSeq;
    }
    
    if(raaExists($code)==0)
    {
        $nomDocument = $_FILES['RAA']['name'];	
        $DocumentTmp = $_FILES['RAA']['tmp_name'];
        move_uploaded_file($DocumentTmp,'../documents/'.$nomDocument);
	
        $requete="INSERT INTO RAA(CODE_RAA, LIBELLE_RAA, DESIGN_RAA, DATE_RAA, DOCUMENT, MATRICULE) VALUES(?,?,?,?,?,?)";	
        $resultat = $connexion->prepare($requete);			
        $param=array($code, $libelle, $designation, $date, $nomDocument, $matricule);			
        $resultat->execute($param);	
		
        header("location:vueRAA.php?matricule=$matricule");
    }
    else
    {
        $erreur="oui";
        header("location:vueAjouterRAA.php?erreur=$erreur"); 
    }
	
	
?>