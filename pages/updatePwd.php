<?php
    require_once('session.php');
?>
<?php
    require_once ('connexionDB.php');
    
    $login = $_SESSION['user']['login'];
    $email = $_SESSION['user']['email'];
    $id = $_SESSION['user']['id'];
    
    if (isset($_POST['oldpwd']))
        $oldpwd = $_POST['oldpwd'];
    else
        $oldpwd = "";
    
    if (isset($_POST['newpwd']))
        $newpwd = $_POST['newpwd'];
    else
        $newpwd = "";
    
    $dataErrors=array();
    
    $requete = "select * from utilisateurs where id=? and pwd=MD5(?)";
    
    $param = array($id,$oldpwd);
    
    $resultat = $connexion->prepare($requete);
    
    $resultat->execute($param);
    
    if ($user = $resultat->fetch()) {
        
        $id = $user['id'];
        
        $requete = "update utilisateurs set pwd=MD5(?) where id=?";
        
        $param = array($newpwd,$id);
        
        $resultat = $connexion->prepare($requete);
        
        $resultat->execute($param);
        $erreur = "non";
        header("location:vueChangerMDP.php?erreur=$erreur");
        
    } else {
        
        $erreur = "oui";
        header("location:vueChangerMDP.php?erreur=$erreur");
    }

?>
