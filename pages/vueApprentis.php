
<?php
	require_once('session.php');
	require_once('connexionDB.php');
	
	$mc = isset($_GET['motCle'])?$_GET['motCle']:"";
    $codeSpc = isset($_GET['code_specialite'])?$_GET['code_specialite']:0;
    $codeStr = isset($_GET['structure'])?$_GET['structure']:0;



    $size = isset($_GET['size'])?$_GET['size']:5;
    $page = isset($_GET['page'])?$_GET['page']:1;
	$offset=($page-1)*$size;
	
    if(($codeSpc==0)&&($codeStr==0))
        {
            // toutes les spécialites et toutes les spécialités
          
            $resultatApprentis = $connexion->query("SELECT MATRICULE, NOM, PRENOM, NOM_ETABLISS, LIBELLE_SPC, LIBELLE_STRUCT
								                  FROM APPRENTI A,SPECIALITE S, STRUCTURE STR
								                  WHERE A.CODE_SPC = S.CODE_SPC
                                                  AND A.CODE_STR = STR.CODE_STRUCT
							 	                  AND (NOM like '%$mc%' OR PRENOM like '%$mc%')
							 	                  ORDER BY NOM
							         	          LIMIT $size
							                  	  OFFSET $offset");

		$resultatCount = $connexion->query("SELECT COUNT(*) AS nbrApprentis 
							            	FROM APPRENTI 
								            WHERE NOM LIKE '%$mc%' OR PRENOM LIKE '%$mc%'");
      
        }
        if(($codeSpc!=0)&&($codeStr==0)) //toutes les structures et une spécialité 
        {
            $resultatApprentis = $connexion->query("SELECT MATRICULE, NOM, PRENOM, NOM_ETABLISS, LIBELLE_SPC, LIBELLE_STRUCT
								                  FROM APPRENTI A,SPECIALITE S, STRUCTURE STR
								                  WHERE A.CODE_SPC = S.CODE_SPC
                                                  AND A.CODE_STR = STR.CODE_STRUCT
                                                  AND A.CODE_SPC = $codeSpc
							 	                  AND (NOM like '%$mc%' OR PRENOM like '%$mc%')
							 	                  ORDER BY NOM
							         	          LIMIT $size
							                  	  OFFSET $offset");

		$resultatCount = $connexion->query("SELECT COUNT(*) AS nbrApprentis 
								              FROM APPRENTI 
								              WHERE (NOM LIKE '%$mc%' OR PRENOM LIKE '%$mc%')
								              AND CODE_SPC = $codeSpc");
   
        }
        if(($codeStr!=0)&&($codeSpc==0)) //toutes les spécialités et une structure 
        {
        
            $resultatApprentis = $connexion->query("SELECT MATRICULE, NOM, PRENOM, NOM_ETABLISS, LIBELLE_SPC, LIBELLE_STRUCT
								                  FROM APPRENTI A,SPECIALITE S, STRUCTURE STR
								                  WHERE A.CODE_SPC = S.CODE_SPC
                                                  AND A.CODE_STR = STR.CODE_STRUCT
                                                  AND A.CODE_STR = $codeStr
							 	                  AND (NOM like '%$mc%' OR PRENOM like '%$mc%')
							 	                  ORDER BY NOM
							         	          LIMIT $size
							                  	  OFFSET $offset");

		$resultatCount = $connexion->query("SELECT COUNT(*) AS nbrApprentis 
							            	FROM APPRENTI 
								            WHERE (NOM LIKE '%$mc%' OR PRENOM LIKE '%$mc%')
                                            AND CODE_STR = $codeStr");
   
        }
        if(($codeStr!=0)&&($codeSpc!=0)) //une spécialité et une structure 
        {
      
            $resultatApprentis = $connexion->query("SELECT MATRICULE, NOM, PRENOM, NOM_ETABLISS, LIBELLE_SPC, LIBELLE_STRUCT
								                  FROM APPRENTI A,SPECIALITE S, STRUCTURE STR
								                  WHERE A.CODE_SPC = S.CODE_SPC
                                                  AND A.CODE_STR = STR.CODE_STRUCT
                                                  AND A.CODE_SPC = $codeSpc
                                                  AND A.CODE_STR = $codeStr
							 	                  AND (NOM like '%$mc%' OR PRENOM like '%$mc%')
							 	                  ORDER BY NOM
							         	          LIMIT $size
							                  	  OFFSET $offset");

		$resultatCount = $connexion->query("SELECT COUNT(*) AS nbrApprentis 
								              FROM APPRENTI 
								              WHERE (NOM LIKE '%$mc%' OR PRENOM LIKE '%$mc%')
                                              AND CODE_STR = $codeStr
								              AND CODE_SPC = $codeSpc");
    
        }
	

	
	
	$nbr = $resultatCount->fetch();
	
	$nbrApprentis = $nbr['nbrApprentis'];
	
	$reste = $nbrApprentis % $size;

	if($reste==0)
		$nbrPages = $nbrApprentis/$size;
	else
		$nbrPages = floor($nbrApprentis/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requeteSpecialite = "SELECT * FROM SPECIALITE";
	$resultatSpecialite = $connexion->query($requeteSpecialite);

    $requeteStructure="SELECT * FROM STRUCTURE";
	$resultatStructure = $connexion->query($requeteStructure);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des apprentis</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
        
<style>
  .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    background-color: #d9edf7;
    color: #31708f;
}
       .nav-pills>li>a, .nav-pills>li>a:focus, .nav-pills>li>a:hover {
    color: #31708f;
}

 
  
   
        </style>

	</head>
	<body style="background-color : #e0ebeb">		 
        <div id="wrapper">

		 	<?php include('entete.php');?>
			
			<div class="container">
                <br>
				<div class="panel panel-default espace80">
					<div class="panel-heading">Rechercher des apprentis</div>
					<div class="panel-body">
						<form method="get" action="vueApprentis.php" class="form-inline">
						<div class="form-group">						
								<select name="structure" id="structure" class="form-control"
                                    onChange="this.form.submit();">
                                <option value="" >Toutes les structures</option>
                                <?php while($str=$resultatStructure->fetch()){ ?>
                                <option value="<?php echo $str['CODE_STRUCT']?>" 
                                        <?php echo $codeStr==$str['CODE_STRUCT']?"selected":0 ?>>		
                                    <?php echo $str['LIBELLE_STRUCT']?>
                                </option>		
                                <?php } ?>
							</select>
                            
                            <select name="code_specialite" id="code_specialite" class="form-control"
									onChange="this.form.submit();">
									<option value="" >Toutes les spécialités</option>
                                    <?php while($specialite=$resultatSpecialite->fetch()){ ?>
										<option value="<?php echo $specialite['CODE_SPC']?>" 
											<?php echo $codeSpc==$specialite['CODE_SPC']?"selected":0 ?>>
											<?php echo $specialite['LIBELLE_SPC']?>
										</option>									
									<?php } ?>
								</select>
								
								
								<input type="text" name="motCle" 
										placeholder="Nom ou Prénom"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
                                <input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-grey">
                                        <i class="fa fa-search"></i>
								</button>
                            <?php if(($_SESSION['user']['role']=="Chef de service")||(($_SESSION['user']['role']=="Gestionnaire"))) {?>
                                   
                            <a class="btn btn-grey" style=" margin-left:10px"
                                        
                                    href="vueAjouterApprenti.php">
                                   Ajouter nouvel apprenti
                                    <span class="fa fa-user-plus" 
                                    style=" margin-left : 10px; margin-right : 5px"></span>
                            </a>
                            <?php } ?>
                            <?php if(($_SESSION['user']['role']=="Chef de service")||(($_SESSION['user']['role']=="Gestionnaire"))
                                    ||(($_SESSION['user']['role']=="Secrétaire"))) {?>
                            <a href="../pdf/LAA.php" target="_blank" class="btn btn-grey" style="margin-left:10px;float:right">
								Liste des apprentis admis &nbsp;	
                                <i class="fa fa-list" ></i> 
								</a>
				
			                <?php } ?>
                                
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                        Liste des apprentis (<?php echo $nbrApprentis ?> apprenti) 
					</div>
					<div class="panel-body">
						<div class="tableFixHead scrollbar-blue scrollable" style="height : 250px">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Matricule</th>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Etatblissement</th>
                                    <th>Spécialité</th>
                                    <th>Structure</th>
                                     <?php if(($_SESSION['user']['role']=="Chef de service")||(($_SESSION['user']['role']=="Gestionnaire"))) {?>
                                    <th>&nbsp;&nbsp;Actions</th>
                                    <?php } ?>
                                    
								</tr>
							</thead>
							<tbody>
									<?php while($apprenti = $resultatApprentis->fetch()){?>
									<tr>
										<td><?php echo $apprenti['MATRICULE'] ?></td>
										<td><?php echo $apprenti['NOM'] ?></td>
										<td><?php echo $apprenti['PRENOM'] ?></td>
										<td><?php echo $apprenti['NOM_ETABLISS'] ?></td>
                                        <td><?php echo $apprenti['LIBELLE_SPC'] ?></td>
                                        <td>&nbsp;<?php echo $apprenti['LIBELLE_STRUCT'] ?></td>
										
                                        <?php if(($_SESSION['user']['role']=="Chef de service")||(($_SESSION['user']['role']=="Gestionnaire"))) {?>
                                        <td>
												<!--  Action Editer un stagiaire -->
												<a href="vueModifierApprenti.php?matricule=<?php echo $apprenti['MATRICULE'] ?>">
													<span class="fas fa-user-edit icon" style="margin-left : 10px; margin-right : 10px"></span>
												</a>
                                               
                                            
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer l apprenti ?')" 
													href="deleteApprenti.php?matricule=<?php echo $apprenti['MATRICULE'] ?>">
													<span class="fas fa-user-alt-slash icon" 
                                                          style="margin-left : 10px; margin-right : 10px"></span>
												</a>
                                            										
											
                                                <div class="document-menuu">
                                                    <a href="#" >
                                                        <span class="fa fa-folder-open icon" 
                                                              style="margin-left : 10px; margin-right : 10px; font-size:17px;"></span>
                                                    </a>

                                                    
                                                    <div class="dropdown-menuu">
                                                        <ul class="nav  navbar">
    
      <li><a href="vueDAP.php?matricule=<?php echo $apprenti['MATRICULE'] ?>"><span class="fas fa-file-text" 
                                  style="font-size:17px; margin-right : 10px"></span>DAP</a></li>
      
      
      <li><a href="vueRAA.php?matricule=<?php echo $apprenti['MATRICULE'] ?>"><span class="fas fa-copy" 
                                  style="font-size:17px;margin-right : 10px"></span>RAA</a></li>
     
      <li><a href="../pdf/FECA.php?matricule=<?php echo $apprenti['MATRICULE'] ?>" target = "_blank"><span class="fas fa-file-invoice" 
                            style="font-size:17px; margin-right : 10px">
          </span>FECA</a></li>
      
    
  </ul>
                                                        
                                                        
                                                        
                                                    </div>
                                            </div>
                                            
                                                
                                                <a href="vueStructures.php?matricule=<?php echo $apprenti['MATRICULE'] ?>"> 
                                                    <span class="fas fa-sitemap icon" style="font-size:17px;margin-left : 10px; margin-right : 10px"></span>
                                                </a>
											
										</td>
                                        <?php } ?>
										
									</tr>
								<?php } ?>
							</tbody>
						</table>
                        </div>				

                        
                        
                        <div>																						
								<ul class="nav nav-pills">
									<li>
										<form class="form-inline">
											<label style="margin-top:10px">Nombre d'apprentis par page :</label>
											&nbsp;
											<input type="hidden" name="motCle" 
												value="<?php echo $mc ?>">
											<input type="hidden" name="page" 
												value="<?php echo $page ?>">
											<select name="size" class="form-control"
													onchange="this.form.submit()">
												<option <?php if($size==5)  echo "selected" ?>>5</option>
												<option <?php if($size==10) echo "selected" ?>>10</option>
												<option <?php if($size==15) echo "selected" ?>>15</option>
												<option <?php if($size==20) echo "selected" ?>>20</option>
												<option <?php if($size==25) echo "selected" ?>>25</option>
											</select>&nbsp;&nbsp;&nbsp;&nbsp;
										</form>
									</li> 
									<?php for($i=1;$i<=$nbrPages;$i++){ ?>
										<li <?php if($i==$page){ ?> class="active"<?php } ?>>
											<a href="vueApprentis.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
                                    
								</ul>
                            
							
						</div>
	
						
					</div>				
				</div>	
				

		</div>
		</div>
        <!--
         <footer>
             <div class="foot">
            <h5>&copy; Le Suivi des Apprentis 2020 | Entreprise Nationale de Grands Travaux Pétroliers.</h5>
             </div>
        </footer>  -->
	</body>
</html>