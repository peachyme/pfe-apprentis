<?php
	require_once('session.php');

	require_once('connexionDB.php');
	
    $libelle = $_POST['libellé'];
	$domaine = $_POST['domaine'];
    $duree = $_POST['duree'];
    
	
    $requete="INSERT INTO SPECIALITE (LIBELLE_SPC, DOMAINE_FORM, DUREE_FORM) VALUES (?,?,?)";
				
    $param=array($libelle,$domaine,$duree);
	
	$resultat = $connexion->prepare($requete);	
	$resultat->execute($param);
	
	header("location:vueSaisirSpecialite.php");

?>