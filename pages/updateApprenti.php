<?php
	require_once('session.php');
?>

<?php
	require_once('connexionDB.php');
	
	$matricule = $_POST['matricule'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$dateN=$_POST['dateN'];	
	$lieuN=$_POST['lieuN'];
    $etablissement=$_POST['etablissement'];
    $code_specialite=$_POST['code_specialite'];
    $session=$_POST['session'];

    $requete = "SELECT * FROM SPECIALITE WHERE CODE_SPC=$code_specialite";
    $resultat = $connexion->query($requete);
    $spc = $resultat->fetch();   
    
    $libellee = $spc['LIBELLE_SPC'];
            
           
    $requeteUpdateApprenti="UPDATE APPRENTI 
                            SET NOM=?, PRENOM=?, DATE_NAISS=?, LIEU_NAISS=?, NOM_ETABLISS=?, CODE_SPC=?, SESSION=?
                            WHERE MATRICULE=?";
				
    $param=array($nom,$prenom,$dateN, $lieuN, $etablissement, $code_specialite,$session, $matricule);
	
	$resultatUpdateApprenti = $connexion->prepare($requeteUpdateApprenti);	
	$resultatUpdateApprenti->execute($param);	
	
    $requeteUpdate = "UPDATE STRUCT_APP 
                            SET CODE_SPC=? , LIBELLE_SPC=?
                            WHERE MATRICULE=?";
				
    $param=array($code_specialite,$libellee,$matricule);
	
	$resultatUpdate = $connexion->prepare($requeteUpdate);	
	$resultatUpdate->execute($param);

	header("location:vueApprentis.php");

?>