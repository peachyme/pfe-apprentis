<?php
   require_once('session.php');
   require_once('connexionDB.php');


        $id    = isset($_POST['idUser'])?$_POST['idUser']:0;
        $login = isset($_POST['login'])?$_POST['login']:"";
        $email = isset($_POST['email'])?$_POST['email']:"";
	
	
        $requeteUpdateUser = "UPDATE utilisateurs
				              SET login=?, email=?
				              WHERE id=?";	

        $param = array($login,$email,$id);

        $resultatUpdateUser = $connexion->prepare($requeteUpdateUser);		

        $resultatUpdateUser->execute($param);	
	
        header('location:vueAuthentification.php');
    
?>