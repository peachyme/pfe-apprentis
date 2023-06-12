<?php
	session_start();
    require_once('connexionDB.php');
    
	
	$login = isset($_POST['login'])?$_POST['login']:"";
    $pwd   = isset($_POST['pwd'])?$_POST['pwd']:"";
	
	
	$requeteLogin = "SELECT * FROM utilisateurs WHERE login=? and pwd=MD5(?)";
		
	$param = array($login, $pwd);	
	$resultatLogin = $connexion->prepare($requeteLogin);		
	$resultatLogin->execute($param);	
	
	if($user=$resultatLogin->fetch())
    {
        if($user['etat']==1)
        {
            $_SESSION['user'] = $user;
            header("Location:../index.php");
        }
        else
        {
            $_SESSION['loginError'] = "<strong>Erreur: </strong>
                                      votre compte est désactivé.
                                      <br> 
                                      Veuillez contacter l'administrateur !";
            
            header("Location:vueAuthentification.php");
        }
    }
    else
    {
		 $_SESSION['loginError']= "<strong>Erreur!</strong> Login ou password incorrect !";
         header("Location:vueAuthentification.php");
    } 
	
?>