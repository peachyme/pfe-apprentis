<?php
	require_once('session.php');
	require_once('connexionDB.php');
   

	$id = $_GET['id'];
    $nb = (int)$_GET['nba'];
	$date = $_GET['date'];
    $paie = $_GET['paie'];
   
    
   

    $requete="UPDATE PAIE SET NB_ABS=?, PAIE_P=? WHERE ID=?";
				
    $param=array($nb,$paie,$id);
	
	$resultat = $connexion->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:vueParMois.php?date=$date");

?>