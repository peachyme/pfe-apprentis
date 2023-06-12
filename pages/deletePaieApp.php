<?php

    session_start();
	if(isset($_SESSION['user']))
    {
        require_once('connexionDB.php');
        $id = $_GET['id'];
        $mc = $_GET['matricule'];
        $requeteDeletePaie = "DELETE FROM PAIE WHERE ID=?";	
        $param = array($id);	
        $requeteDeletePaie = $connexion->prepare($requeteDeletePaie);
        $requeteDeletePaie->execute($param);	
        
        
        header("location:vuePaie.php?matricule=$mc");
    }
    else
    {
        header('location:vueAuthentification.php');
    }
?>