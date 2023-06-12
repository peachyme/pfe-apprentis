<?php
	require_once('session.php');
	require_once('connexionDB.php');
   

	$matricule = $_GET['matricule'];
    $nb = $_GET['nb_absences'];
	$date = $_GET['date'];
    $paie = $_GET['paie'];
   

    $requeteInsert="UPDATE PAIE SET PAIE_P=? WHERE NB_ABS=? AND DATE_P=? AND MATRICULE=?";
				
    $param=array($paie,$nb,$date,$matricule);
	
	$resultatInsert = $connexion->prepare($requeteInsert);	
	$resultatInsert->execute($param);	
	
	header("location:vueCalculePaie.php");

?>