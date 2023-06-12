<?php
	require_once('session.php');
    require_once('connexionDB.php');
	include '../fonctions/fonctions.php'; 

    
	
    $matricule = $_POST['matricule'];
	$code = $_POST['structure'];
	$session = $_POST['session'];
	$specialite = $_POST['specialite'];
    
	

    if(structureExists($code,$matricule)==0)
    {
        if(placesDisp($session,$code,$specialite)==1)
        {
            $requete = "SELECT * FROM STRUCTURE WHERE CODE_STRUCT=$code";
            $resultat = $connexion->query($requete);
            $structure = $resultat->fetch();   
    
            $libelle = $structure['LIBELLE_STRUCT'];
            $design = $structure['DESIGN_STRUCT'];
            
            $requete = "SELECT * FROM SPECIALITE WHERE CODE_SPC=$specialite";
            $resultat = $connexion->query($requete);
            $spc = $resultat->fetch();   
    
            $libellee = $spc['LIBELLE_SPC'];
            
            
            $requeteInsertStr="INSERT INTO STRUCT_APP(MATRICULE,CODE_STRUCT,CODE_SPC,LIBELLE_STRUCT,DESIGN_STRUCT,LIBELLE_SPC) 
                               VALUES(?,?,?,?,?,?)";
		
            $param=array($matricule,$code,$specialite,$libelle,$design,$libellee);
	
            $resultatInsertStr = $connexion->prepare($requeteInsertStr);
            $resultatInsertStr->execute($param);
            
            $requeteUpdateStr="UPDATE APPRENTI SET CODE_STR=? WHERE MATRICULE=?";
		
            $param=array($code,$matricule);
	
            $resultatUpdateStr = $connexion->prepare($requeteUpdateStr);
            $resultatUpdateStr->execute($param);	
	
            header("location:vueStructures.php?matricule=$matricule");
        }
        else
        {
            $erreur = "non";
            header("location:vueAjouterStructure.php?matricule=$matricule&erreur=$erreur");
        }
    }
    else
    {
        $erreur = "oui";
        header("location:vueAjouterStructure.php?matricule=$matricule&erreur=$erreur");

    }
    


?>