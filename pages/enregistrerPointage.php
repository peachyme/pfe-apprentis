<?php
	require_once('session.php');
	require_once('connexionDB.php');
   

	$matricule = $_POST['matricule'];
    $nb = $_POST['nb_absences'];
	$date = $_POST['date'];
   

    $requeteInsert="INSERT INTO PAIE(NB_ABS,DATE_P,MATRICULE) 
                    VALUES(?,?,?)";
				
    $param=array($nb,$date,$matricule);
	
	$resultatInsert = $connexion->prepare($requeteInsert);	
	$resultatInsert->execute($param);	
	
	header("location:vueSaisirPointage.php");

?>