<?php
	require_once('session.php');
?>

<?php
	require_once('connexionDB.php');
	
    $matricule = $_POST['matricule'];
    $code = $_POST['codeDAP'];
    $date = $_POST['dateDAP'];


	$nomDoc = $_FILES['DAP']['name'];	
	
	$DocTmp = $_FILES['DAP']['tmp_name'];
	
	move_uploaded_file($DocTmp,'../documents/'.$nomDoc);
			
	if(!empty($nomDoc)){ // empty($nomDoc):$nomDoc est vide (document non envoyée)
						  // !empty($nomDoc):$nomDoc non vide (document envoyée)
		
		$requete="UPDATE DAP SET DATE_DAP=?, DOCUMENT=? where CODE_DAP=?";
		
		$param=array($date, $nomDoc, $code);		
	}
	else{ // document non envoyée
		$requete="UPDATE DAP SET DATE_DAP=? where CODE_DAP=?";
				
		$param=array($date, $code);
	}
			
	$resultat = $connexion->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:vueDAP.php?matricule=$matricule");

?>