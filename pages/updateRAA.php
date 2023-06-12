<?php
	require_once('session.php');
?>

<?php
	require_once('connexionDB.php');
	
    $matricule = $_POST['matricule'];
    $code = $_POST['codeRAA'];
    $date = $_POST['dateRAA'];


	$nomDoc = $_FILES['RAA']['name'];	
	
	$DocTmp = $_FILES['RAA']['tmp_name'];
	
	move_uploaded_file($DocTmp,'../documents/'.$nomDoc);
			
	if(!empty($nomDoc)){ // empty($nomDoc):$nomDoc est vide (document non envoyée)
						  // !empty($nomDoc):$nomDoc non vide (document envoyée)
		
		$requete="UPDATE RAA SET DATE_RAA=?, DOCUMENT=? where CODE_RAA=?";
		
		$param=array($date, $nomDoc, $code);		
	}
	else{ // document non envoyée
		$requete="UPDATE RAA SET DATE_RAA=? where CODE_RAA=?";
				
		$param=array($date, $code);
	}
			
	$resultat = $connexion->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:vueRAA.php?matricule=$matricule");

?>