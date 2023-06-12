<?php
   require_once('session.php');
   require_once('connexionDB.php');


        $id    = isset($_POST['idUser'])?$_POST['idUser']:0;
        $login = isset($_POST['login'])?$_POST['login']:"";
        $email = isset($_POST['email'])?$_POST['email']:"";
        $role  = isset($_POST['role'])?$_POST['role']:"";
	
	
        $requeteUpdateUser = "UPDATE utilisateurs
				              SET login=?, email=?, role=?
				              WHERE id=?";	

        $param = array($login,$email,$role,$id);

        $resultatUpdateUser = $connexion->prepare($requeteUpdateUser);		

        $resultatUpdateUser->execute($param);	
	
        header('location:vueUtilisateurs.php');
    
?>