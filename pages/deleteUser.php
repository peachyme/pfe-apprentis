<?php

    session_start();
	if(isset($_SESSION['user']))
    {
        require_once('connexionDB.php');
        $id = $_GET['idUser'];
        $requeteDeleteUser = "DELETE FROM utilisateurs WHERE id=?";	
        $param = array($id);	
        $resultatDeleteUser = $connexion->prepare($requeteDeleteUser);
        $resultatDeleteUser->execute($param);	
        header("location:vueUtilisateurs.php");
    }
    else
    {
        header('location:vueAuthentification.php');
    }
?>
