
<?php
	require_once('connexionDB.php');
	
	
	if(isset($_POST['email']))
	    
		$email=$_POST['email'];
	
	else
	    
		$email="";
	
	$requete1="select * from utilisateur where email='$email'";
	
	$resultat1 = $connexion->query($requete1);
	
	
	if($user=$resultat1->fetch()){
	    
		$id=$user['id'];
		
		$pwd="0000";
		
		$requete="update utilisateur set pwd=MD5(?) where id=?";	
		
		$param=array($pwd,$id);	
		
		$resultat = $con->prepare($requete);	
		
		$resultat->execute($param);
	
		$to = $user['email'];
		
		$subject = "INITIALISATION DE MOT DE PASSE (Poste HP)";
		
		$txt = "Votre nouveau mot de passe est :$pwd";
		
		$headers = "From: Gestion des apprentis" . "\r\n" ."CC: hadjer.messaoudene19@gmail.com";
		
		mail($to,$subject,$txt,$headers);
		
		header("location:confirmationResetPwd.php");
	
	}else{
	    
		$_SESSION['erreurLogin']="<strong>Erreur!</strong> L'Email est incorrecte!!!";
		
         header("Location:initialiserPwd.php");
	}	
			
	
?>