<?php

    session_start();
	if(isset($_SESSION['user']))
    {
        require_once('connexionDB.php');
        $id = $_GET['id'];
        $date = $_GET['date'];
        $requeteDeletePaie = "DELETE FROM PAIE WHERE ID=?";	
        $param = array($id);	
        $requeteDeletePaie = $connexion->prepare($requeteDeletePaie);
        $requeteDeletePaie->execute($param);	
        
        
        header("location:vueParMois.php?date=$date");
    }
    else
    {
        header('location:vueAuthentification.php');
    }
?>