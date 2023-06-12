<?php
	require_once('session.php');
?>

<?php
	require_once('connexionDB.php');
	
    $session = $_POST['session'];
    $codeSpc = $_POST['code_specialite'];
    $codeStr = $_POST['structure'];
    $nbApp = $_POST['nbApp'];
	
    $requeteUpdateBesoin="UPDATE besoin_apprentissage 
                          SET NB_APPR=?
                          WHERE CODE_STR=?
                          AND CODE_SPC=?
                          AND ID_SESS=?";
				
    $param=array($nbApp,$codeStr,$codeSpc,$session);
	
	$resultatUpdateBesoin = $connexion->prepare($requeteUpdateBesoin);	
	$resultatUpdateBesoin->execute($param);	
	
	header("location:vueBesoinApprentissage.php");

?>