<?php

    session_start();
	if(isset($_SESSION['user']))
    {
        require_once('connexionDB.php');
        
        $matricule = $_GET['matricule'];
	    $code = $_GET['code'];
        
        $requeteDeleteStructureApprenti = "DELETE FROM STRUCT_APP WHERE MATRICULE=? AND CODE_STRUCT=?";	
        $param = array($matricule, $code);	
        $resultatDeleteStructureApprenti = $connexion->prepare($requeteDeleteStructureApprenti);
        $resultatDeleteStructureApprenti->execute($param);	
        header("location:vueStructures.php?matricule=$matricule");
    }
    else
    {
        header('location:vueAuthentification.php');
    }

?>