<?php
	require_once('session.php');
    require_once('connexionDB.php');
	include '../fonctions/fonctions.php'; 

	
    $nom = strtoupper($_POST['nom']);
	$prenom = strtoupper($_POST['prenom']);
    $dateN = $_POST['dateN'];
    $lieuN = strtoupper($_POST['lieuN']);
    $etablissement = $_POST['etablissement'];
    $specialite = $_POST['code_specialite'];
    $structure = $_POST['code_structure'];
    $ccp = $_POST['ccp'];
    $dateD = $_POST['dateD'];
    $session = (int)$_POST['session'];
    $annee = $session % 100;
	
    if(apprentiExists($nom,$prenom,$dateN,$session)==0)
    {
        if(placesDisp($session,$structure,$specialite)==1)
        {
            $requeteMatricule = "SELECT MATRICULE FROM APPRENTI WHERE SESSION=$session";
            $resultatMatricule = $connexion->query($requeteMatricule);
            $max =0;
    
            while($mat = $resultatMatricule->fetch())
            {
                $numSeq = $mat['MATRICULE'] % 100;
                if($numSeq > $max)
                {
                    $max = $numSeq;
                }
            }
        
            $numSeq = $max + 1;
            $matricule = $annee*10000 + $specialite*100 + $numSeq;
    
            $requeteInsert="INSERT INTO APPRENTI(MATRICULE,NOM,PRENOM,DATE_NAISS,LIEU_NAISS,NOM_ETABLISS,CODE_SPC,CODE_STR,SESSION,DATE_DEBUT,CCP) 
                            VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		
            $param=array($matricule,$nom,$prenom,$dateN,$lieuN,$etablissement,$specialite,$structure,$session,$dateD,$ccp);
	
            $resultatInsert = $connexion->prepare($requeteInsert);
            $resultatInsert->execute($param);      
            
            $requete = "SELECT * FROM STRUCTURE WHERE CODE_STRUCT=$structure";
            $resultat = $connexion->query($requete);
            $struct = $resultat->fetch();   
    
            $libelle = $struct['LIBELLE_STRUCT'];
            $design = $struct['DESIGN_STRUCT'];
            
            $requete = "SELECT * FROM SPECIALITE WHERE CODE_SPC=$specialite";
            $resultat = $connexion->query($requete);
            $spc = $resultat->fetch();   
    
            $libellee = $spc['LIBELLE_SPC'];
            
            
            $requeteInsertStr="INSERT INTO STRUCT_APP(MATRICULE,CODE_STRUCT,CODE_SPC,LIBELLE_STRUCT,DESIGN_STRUCT,LIBELLE_SPC) 
                               VALUES(?,?,?,?,?,?)";
		
            $param=array($matricule,$structure,$specialite,$libelle,$design,$libellee);
	
            $resultatInsertStr = $connexion->prepare($requeteInsertStr);
            $resultatInsertStr->execute($param);	
	
            header("location:vueApprentis.php?matricule=$matricule");
            
        }
        else
        {
            $erreur = "non";
            header("location:vueAjouterApprenti.php?erreur=$erreur");
        }
        
    }
    else
    {
        $erreur = "oui";
        header("location:vueAjouterApprenti.php?erreur=$erreur");

    }
    

?>