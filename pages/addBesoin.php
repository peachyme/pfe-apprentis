<?php
	require_once('session.php');

	require_once('connexionDB.php');
	
    $session = $_POST['session'];
	$structure = $_POST['structure'];
    $specialite = $_POST['code_specialite'];
    $nbApp = $_POST['nbApp'];
    
	
    $requeteSession = "SELECT * FROM SESS WHERE ID_SESS = $session";
    $resultatSession = $connexion->prepare($requeteSession);
    $resultatSession->execute();
    $num_rows = $resultatSession->rowCount();

     if($num_rows == 0)
     {
         $requeteInsertSession="INSERT INTO SESS VALUES(?)";
         $param=array($session);
         $resultatInsertSession = $connexion->prepare($requeteInsertSession);	
         $resultatInsertSession->execute($param);	
     }
     
     
    $requeteInsert="INSERT INTO BESOIN_APPRENTISSAGE(CODE_STR,CODE_SPC,ID_SESS,NB_APPR) 
                    VALUES(?,?,?,?)";
				
    $param=array($structure,$specialite,$session,$nbApp);
	$resultatInsert = $connexion->prepare($requeteInsert);	
	$resultatInsert->execute($param);	
	
	header("location:vueBesoinApprentissage.php");

?>