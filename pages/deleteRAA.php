<?php

    session_start();
	if(isset($_SESSION['user']))
    {
        require_once('connexionDB.php');
        
        $matricule = $_GET['matricule'];
	    $code = $_GET['code'];
        
        $requeteDeleteRAA = "DELETE FROM RAA WHERE CODE_RAA=?";	
        $param = array($code);	
        $resultatDeleteRAA = $connexion->prepare($requeteDeleteRAA);
        $resultatDeleteRAA->execute($param);	
        header("location:vueRAA.php?matricule=$matricule");
    }
    else
    {
        header('location:vueAuthentification.php');
    }

?>