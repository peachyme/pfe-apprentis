<?php
	require_once('session.php');

	require_once('connexionDB.php');
	
    $Etabliss = $_POST['libellé'];
	
	
    $requete="INSERT INTO ETABLISSEMENT VALUES (?)";
				
    $param=array($Etabliss);
	
	$resultat = $connexion->prepare($requete);	
	$resultat->execute($param);
	
	header("location:vueSaisirEtablissement.php");

?>