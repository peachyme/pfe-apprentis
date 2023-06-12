<?php
	require_once('session.php');
    require_once('connexionDB.php');
	include '../fonctions/fonctions.php'; 

    
	
    $libelle = $_POST['libellé'];
	$design = $_POST['designatiion'];
	$region = $_POST['region'];
	$type = $_POST['type'];
    
	
    if($region="reghaia"){$codeRegion = 0;}
    if($type="administrative"){$codeType = 9;}

    $requeteCode = "SELECT CODE_STRUCT FROM STRUCTURE";
    $resultatCode = $connexion->query($requeteCode);
    $max =0;
    
    while($code = $resultatCode->fetch())
    {
        $numSeq = $code['CODE_STRUCT'] % 100;
        if($numSeq > $max)
        {
            $max = $numSeq;
        }
    }
    $numSeq = $max + 1;
    
    $code = $codeType*1000 + $codeRegion*100 + $numSeq;


    $requeteInsertStr="INSERT INTO STRUCTURE(CODE_STRUCT,LIBELLE_STRUCT,DESIGN_STRUCT,REGION,TYPE) 
                               VALUES(?,?,?,?,?)";
		
    $param=array($code,$libelle,$design,$region,$type);
	
    $resultatInsertStr = $connexion->prepare($requeteInsertStr);
    $resultatInsertStr->execute($param);
            
      
    header("location:vueSaisirStructure.php");
     


?>