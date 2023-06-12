<?php

    session_start();
	if(isset($_SESSION['user']))
    {
        require_once('connexionDB.php');
        $matricule = $_GET['matricule'];
        $requeteDeleteApprenti = "DELETE FROM APPRENTI WHERE MATRICULE=?";	
        $param = array($matricule);	
        $resultatDeleteApprenti = $connexion->prepare($requeteDeleteApprenti);
        $resultatDeleteApprenti->execute($param);	
        
        $requeteDeleteStructApp = "DELETE FROM STRUCT_APP WHERE MATRICULE=?";
        $resultatDeleteStructApp = $connexion->prepare($requeteDeleteStructApp);
        $resultatDeleteStructApp->execute($param);
       
        
        $requeteDeleteDAP = "DELETE FROM DAP WHERE MATRICULE=?";
        $resultatDeleteDAP = $connexion->prepare($requeteDeleteDAP);
        $resultatDeleteDAP->execute($param);
        
        $requeteDeleteRAA = "DELETE FROM RAA WHERE MATRICULE=?";		
        $resultatDeleteRAA = $connexion->prepare($requeteDeleteRAA);
        $resultatDeleteRAA->execute($param);
        
        
        $requeteDeletePaies  = "DELETE FROM paie WHERE MATRICULE=?";		
        $resultatDeletePaies = $connexion->prepare($requeteDeletePaies);
        $resultatDeletePaies->execute($param);	
        
        header("location:vueApprentis.php");
    }
    else
    {
        header('location:vueAuthentification.php');
    }
?>