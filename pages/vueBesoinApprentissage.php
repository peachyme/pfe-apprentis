
<?php
	require_once('session.php');
	require_once('connexionDB.php');
	
	$session = isset($_GET['session'])?$_GET['session']:"";
    $codeSpc = isset($_GET['code_specialite'])?$_GET['code_specialite']:0;
    $codeStr = isset($_GET['structure'])?$_GET['structure']:0;

    $size = isset($_GET['size'])?(int)$_GET['size']:400;
    $page = isset($_GET['page'])?(int)$_GET['page']:1;
	$offset=($page-1)*$size;
	
    if($session==0)
    {
        if(($codeSpc==0)&&($codeStr==0))
        {
            // toutes les spécialites et toutes les spécialités
          
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
							 	              ORDER BY ID_SESS DESC
							         	      LIMIT $size
							                  OFFSET $offset");

		  
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage");
      
        }
        if(($codeSpc!=0)&&($codeStr==0)) //toutes les structures et une spécialité 
        {
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
								                     AND B.CODE_SPC=$codeSpc
							 	                     ORDER BY ID_SESS DESC
							         	             LIMIT $size
							                  	     OFFSET $offset"); 
        
        
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage
								            WHERE CODE_SPC = $codeSpc");
   
        }
        if(($codeStr!=0)&&($codeSpc==0)) //toutes les spécialités et une structure 
        {
        
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
								                     AND B.CODE_STR=$codeStr
							 	                     ORDER BY ID_SESS DESC
							         	             LIMIT $size
							                  	     OFFSET $offset"); 
        
            
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage
								            WHERE CODE_STR = $codeStr");
   
        }
        if(($codeStr!=0)&&($codeSpc!=0)) //une spécialité et une structure 
        {
      
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
								                     AND B.CODE_STR = $codeStr
                                                     AND B.CODE_SPC = $codeSpc
							 	                     ORDER BY ID_SESS DESC
							         	             LIMIT $size
							                  	     OFFSET $offset"); 
        
       
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage
								            WHERE CODE_STR = $codeStr
                                            AND CODE_SPC = $codeSpc");
    
        }
    }
    else
    {
        if(($codeSpc==0)&&($codeStr==0))
        {
       
            // toutes les spécialites et toutes les spécialités
          
        
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
								              AND ID_SESS=$session
							 	              ORDER BY ID_SESS DESC
							         	      LIMIT $size
							                  OFFSET $offset");

		 
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage
								            WHERE ID_SESS=$session");
           
	
        }
        if(($codeSpc!=0)&&($codeStr==0)) //toutes les structures et une spécialité 
        {
        
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
								                     AND ID_SESS=$session
                                                     AND B.CODE_SPC=$codeSpc
							 	                     ORDER BY ID_SESS DESC
							         	             LIMIT $size
							                  	     OFFSET $offset"); 
        
       
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage
								            WHERE ID_SESS=$session
								            AND CODE_SPC = $codeSpc");
    
        }
        if(($codeStr!=0)&&($codeSpc==0)) //toutes les spécialités et une structure 
        {
        
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
								                     AND ID_SESS=$session
                                                     AND B.CODE_STR=$codeStr
							 	                     ORDER BY ID_SESS DESC
							         	             LIMIT $size
							                  	     OFFSET $offset"); 
        
        
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage
								            WHERE ID_SESS=$session
								            AND CODE_STR = $codeStr");
    
        }
        if(($codeStr!=0)&&($codeSpc!=0)) //une spécialité et une structure 
        {
       
            $resultatBesoins = $connexion->query("SELECT B.CODE_STR, B.CODE_SPC, B.ID_SESS, B.NB_APPR, STR.LIBELLE_STRUCT,       
                                             SPC.LIBELLE_SPC
                                             FROM besoin_apprentissage B, structure STR, specialite SPC
                                              WHERE B.CODE_STR = STR.CODE_STRUCT
                                              AND B.CODE_SPC = SPC.CODE_SPC
								                     AND ID_SESS = $session
                                                     AND B.CODE_STR = $codeStr
                                                     AND B.CODE_SPC = $codeSpc
							 	                     ORDER BY ID_SESS DESC
							         	             LIMIT $size
							                  	     OFFSET $offset"); 
        
        
          
            $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrBesoins 
							            	FROM besoin_apprentissage
								            WHERE ID_SESS = $session
								            AND CODE_STR = $codeStr
                                            AND CODE_SPC = $codeSpc");
  
        }      
   }
	
		
	
	
	
	$nbr = $resultatCount->fetch();
	
	$nbrBesoins = (int)$nbr['nbrBesoins'];
	
	$reste = $nbrBesoins % $size;

	if($reste==0)
		$nbrPages = $nbrBesoins/$size;
	else
		$nbrPages = floor($nbrBesoins/$size)+1;// floor retourne la partie entière d'un nombre 
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
		<title>Gestion des besoins</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
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
  </style>
	</head>
	<body style="background-color : #e0ebeb">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
                <br>
				<div class="panel panel-default espace80">
					<div class="panel-heading">Rechercher...</div>
					<div class="panel-body">
						<form method="get" action="vueBesoinApprentissage.php" class="form-inline">
						<div class="form-group">	
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
						
								
								<input type="number" name="session" 
										placeholder="Saisir une session"
										id="session" class="form-control" 
										value="<?php echo $session; ?>"/>
                                <input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-grey">
                                    <i class="fa fa-search"></i>
								</button>
                            <?php if($_SESSION['user']['role']=="Chef de service") {?>
                                <a class="btn btn-grey"
                                   style="position: relative; margin-left: 185px;" href="vueAjouterBesoin.php">
                                   Ajouter besoin d'apprentissage
                                    <span class="fa fa-plus" style="margin-left : 10px; margin-right : 5px"></span>
                                </a>
                            <?php } ?>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
					Liste des besoins d'apprentissage
					</div>
					<div class="panel-body">
                        <div class="tableFixHead scrollbar-blue scrollable" style="height : 250px">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Session</th>
									<th>Structure</th>
									<th>Spécialité</th>
									<th>Nombre d'apprentis</th>
                                    <?php if($_SESSION['user']['role']=="Chef de service") {?>
                                    <th> &nbsp;&nbsp;Actions</th>
                                    <?php } ?>
								</tr>
							</thead>
							<tbody>
									<?php while($besoin = $resultatBesoins->fetch()){?>
									<tr>
										<td><?php echo $besoin['ID_SESS'] ?></td>
										<td><?php echo $besoin['LIBELLE_STRUCT'] ?></td>
										<td><?php echo $besoin['LIBELLE_SPC'] ?></td>
										<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php echo $besoin['NB_APPR'] ?></td>
                                        
										<?php if($_SESSION['user']['role']=="Chef de service") {?>		
										<td>
												&nbsp;&nbsp;&nbsp;
												<a href="vueModifierBesoin.php?session=<?php echo $besoin['ID_SESS'] ?>
                                                          &structure=<?php echo $besoin['CODE_STR'] ?>
                                                          &code_specialite=<?php echo $besoin['CODE_SPC'] ?>">
													<span class="fa fa-edit icon" style="margin-left : 10px; margin-right : 10px"></span>
												</a>
                                           
										</td>
                                        <?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
                        
                        
                        </div> 
                            <div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de besoins par Page </label>
											
											<input type="hidden" name="session" 
												value="<?php echo $session ?>">
											<input type="hidden" name="page" 
												value="<?php echo $page ?>">
											<select name="size" class="form-control"
													onchange="this.form.submit()">
												<option <?php if($size==50)  echo "selected" ?>>50</option>
												<option <?php if($size==100) echo "selected" ?>>100</option>
												<option <?php if($size==200) echo "selected" ?>>200</option>
												<option <?php if($size==300) echo "selected" ?>>300</option>
												<option <?php if($size==400) echo "selected" ?>>400</option>
                                            </select> &nbsp;&nbsp;&nbsp;&nbsp;
										
										</form>
									</li>
									<?php for($i=1;$i<=$nbrPages;$i++){ ?>
										<li class="<?php if($i==$page) echo 'active' ?>">
											<a href="vueBesoinApprentissage.php?page=<?php echo $i ?>
											&session=<?php echo $session ?>
											&size=<?php echo $size ?>
                                            &structure=<?php echo $codeStr ?>
                                            &code_specialite=<?php echo $codeSpc ?>">
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
	</body>
</html>