<?php
   
  
    function findUserByLogin($login){
        
        global $connexion;
        
        $statement = $connexion->prepare("SELECT login FROM utilisateurs WHERE login=?");
        
        $statement->execute(array($login));
        
        $count = $statement->rowCount();
        
        return $count;
        
    }
	
	 function findUserByEmail($email){
	     
        global $connexion;
        
        $statement = $connexion->prepare("SELECT email FROM utilisateurs WHERE email=?");
        
        $statement->execute(array($email));
        
        $count = $statement->rowCount();
        
        return $count;
        
    }

    function structureExists($codeStr,$matricule)
    {
        global $connexion;
        
        $statement = $connexion->prepare("SELECT * FROM struct_app WHERE MATRICULE=? AND CODE_STRUCT=?");
        
        $statement->execute(array($matricule,$codeStr));
        
        $count = $statement->rowCount();
        
        return $count;
    }
   
    function raaExists($codeRAA)
    {
        global $connexion;
        
        $statement = $connexion->prepare("SELECT * FROM raa WHERE CODE_RAA=?");
        
        $statement->execute(array($codeRAA));
        
        $count = $statement->rowCount();
        
        return $count;
    }


   function apprentiExists($nom,$prenom,$dateN,$session)
    {
        global $connexion;
        
        $statement = $connexion->prepare("SELECT * FROM apprenti WHERE NOM=? AND PRENOM=? AND DATE_NAISS=? AND SESSION=?");
        
        $statement->execute(array($nom,$prenom,$dateN,$session));
        
        $count = $statement->rowCount();
        
        return $count;
    }

   function placesDisp($session,$structure,$specialite)
    {
        global $connexion;
        
        $statement1 = $connexion->prepare("SELECT * FROM apprenti A, struct_app SA
                                                    WHERE A.MATRICULE=SA.MATRICULE
                                                    AND A.CODE_SPC=? 
                                                    AND A.SESSION=? 
                                                    AND SA.CODE_STRUCT=?");
        
        $statement1->execute(array($specialite,$session,$structure));
        
        $countApprentis = $statement1->rowCount();
       
        $statement2 = $connexion->prepare("SELECT NB_APPR FROM besoin_apprentissage
                                                          WHERE CODE_SPC=? 
                                                          AND ID_SESS=? 
                                                          AND CODE_STR=?");
        
        $statement2->execute(array($specialite,$session,$structure));
        
        $result = $statement2->fetch();
       
        $besoin = $result['NB_APPR'];
        
        if($countApprentis<$besoin)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }


    function calculePaie($nbabs,$date,$matricule)
    {
        global $connexion;
        
        global $SNMG;
        
        $SNMG = 18000;
        
        global $paie;
        

        $statement1 = $connexion->prepare("SELECT * FROM apprenti WHERE MATRICULE=?");
        
        $statement1->execute(array($matricule));
        
        $apprenti = $statement1->fetch();
        
        $session = $apprenti['SESSION'];
                
        $dateDeb = date_create($apprenti['DATE_DEBUT']);
        
        $date = date_create($date);
        
        $today = date_create(date_format($date,"Y-m"));
        
        $diff = date_diff($today,$dateDeb);
        
        $years = (int)$diff->format("%y"); //get the years diff

        $months = $years*12 + (int)$diff->format("%m"); //get the months diff
        
        $nb = date_format($today,"t"); //get the number of days in the month of the specified date *$date*

        
        if(($months>=6)&&($months<12))
        {
            $paie = (0.3 * $SNMG *($nb - $nbabs)/$nb);

        }
        
        if(($months>=12)&&($months<18))
        {
            $paie = (0.4 * $SNMG *($nb - $nbabs)/$nb);
        }
        
        if(($months>=18)&&($months<24))
        {
            $paie = (0.5 * $SNMG *($nb - $nbabs)/$nb);
        }
        
        if(($months>=24)&&($months<30))
        {
            $paie = (0.6 * $SNMG *($nb - $nbabs)/$nb);
        }
        
        return $paie;
       
        
    }
   
?>