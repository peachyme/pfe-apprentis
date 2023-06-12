
<?php
    session_start();
	if(isset($_SESSION['user']))
    {
        require_once('connexionDB.php');
        $id=isset($_GET['idUser'])?$_GET['idUser']:0;
        $etat = isset($_GET['etat'])?$_GET['etat']:0;
        if($etat==1)
        {
            $nvEtat=0;
        } 
        else
        {
            $nvEtat=1;
        }
        
        $requeteUpdateUserState = "UPDATE utilisateurs
				               SET etat=?
				               WHERE id=?";	

        $param=array($nvEtat, $id);
        $resultatUpdateUserState = $connexion->prepare($requeteUpdateUserState);	
        $resultatUpdateUserState->execute($param);
        header("location:vueUtilisateurs.php");
    }
    else
    {
        header('location:vueAuthentification.php');
    }
	
?>