

<?php 
    require_once('session.php');
	require_once('connexionDB.php');
	
    $codeSpc = isset($_GET['code_specialite'])?$_GET['code_specialite']:0;
    $codeStr = isset($_GET['structure'])?$_GET['structure']:0;

	$requeteSpecialite = "SELECT * FROM SPECIALITE";
	$resultatSpecialite = $connexion->query($requeteSpecialite);

    $requeteStructure="SELECT * FROM STRUCTURE";
	$resultatStructure = $connexion->query($requeteStructure);


    if(($codeSpc==0)&&($codeStr==0))
        {
            // toutes les spécialites et toutes les spécialités
            
            $resultat = $connexion->query("SELECT COUNT(*) AS NB, LIBELLE_SPC, LIBELLE_STRUCT
                                            FROM struct_app
                                            GROUP BY LIBELLE_SPC, LIBELLE_STRUCT");
        }

        if(($codeSpc!=0)&&($codeStr==0)) //toutes les structures et une spécialité 
        {   
           
           $resultat = $connexion->query("SELECT COUNT(*) AS NB, LIBELLE_SPC, LIBELLE_STRUCT
                                            FROM struct_app                                              
                                            WHERE CODE_SPC = $codeSpc
                                            GROUP BY LIBELLE_SPC, LIBELLE_STRUCT");
        }
        if(($codeStr!=0)&&($codeSpc==0)) //toutes les spécialités et une structure 
        {
           $resultat = $connexion->query("SELECT COUNT(*) AS NB, LIBELLE_SPC, LIBELLE_STRUCT
                                            FROM struct_app                                              
                                            WHERE CODE_STRUCT = $codeStr
                                            GROUP BY LIBELLE_SPC, LIBELLE_STRUCT");
        }
        if(($codeStr!=0)&&($codeSpc!=0)) //une spécialité et une structure 
        {
         
            $resultat = $connexion->query("SELECT COUNT(*) AS NB, LIBELLE_SPC, LIBELLE_STRUCT
                                            FROM struct_app
                                            WHERE CODE_STRUCT = $codeStr
                                            AND CODE_SPC = $codeSpc
                                            GROUP BY LIBELLE_SPC, LIBELLE_STRUCT");
    
        }
    
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Les apprentis en chiffres</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        
       <style type="text/css">
           
           
   

           header .containerr{
               width : 100%;
               height : 150px;
               background-color: #31708f;

           }
           header .containerr .section1{
             float: left;
               background-color: #31708f;
               width : 17%;
               height : 150px;
               margin-left :0;
               text-align: center

           }
           
           .section1 img{
               width: 70px;
               height: 70px;
               margin-top: 15px;
               margin-bottom: 5px;
           }
           .section1 a{
               color : #d9edf7;
               font-style:normal;
               font-family: 'Times New Roman', Times, serif;
               font-size: 20px;
           }           
           .section1 a:hover{
               color : #fff;
               text-decoration: none
           }
           
           /*
           header .containerr .section1 h1{
               font-family: "Times New Roman", Times, serif	
;
               color: #d9edf7;
               text-align: center;
               padding-bottom: 15px;
               padding-top: 20px;
               margin-left: 50px
           }
*/
           
           header .containerr .section2{
               float : right;
               background-color: white;
               height : 150px;
               text-align: center;
               border-top-left-radius: 50%;
               border-bottom-left-radius: 50%;




           }
         
           header .containerr .section2 .logo {
               height:170px; 
               width:170px; 
               padding-bottom: 5px;
               margin-top : -10px
               
          }
    
           
           footer
           {
               background-color : #31708f;
               color : #A2A9AF;
               height : 30px;
               width: 100%;
               position: absolute
           }
           footer h5
           {
               margin : auto;
               text-align: center;
               margin-top: 10px
           }
           .titre{
               position: absolute;
           }
           .titre h1{
               margin-left: 420px;
               margin-top: 40px;
               font-style:normal;
               font-family: 'Times New Roman', 'Times', monospace;
           }
           .titre a{
               color : #d9edf7;
           }
           .titre a:hover{
               text-decoration: none
           }
           
           #structure{
               width: 550px
           }
           #code_specialite{
               width: 550px
           }
    
     
    </style>

	</head>
	<body>
        <header>
            <div class="containerr">
                
                <div class="section1">
                    <img src="../images/user.png" >
                    <br>
                    <a href = "vueModifierUtilisateur.php?idUser=<?php echo $_SESSION['user']['id'] ?>">Bienvenue <?php echo $_SESSION['user']['login'] ?></a>
                    <br>
                    <a href = "logout.php">Log out &nbsp;
                        <span class="fas fa-door-open"></span></a>
            
                </div>
                <div class="titre">
                    <h1><a href="gestionDesApprentis.php" >Le Suivi des Apprentis</a></h1>
                </div>
                
                <div class="section2">
                <div class="white-section">
                <div class="overlay">
                    <img class="logo" src="../images/gtp.png">
                </div>
                </div>
                </div>
               
            </div>
            <br>
        </header>
        <div id="wrapper">			
			<div class="container">
        <div class="panel panel-info">
				<div class="panel-heading text-center" 
                     style=" font-style: oblique;font-family: 'Times New Roman', Times, serif;font-size: 25px">
                    <strong>Les apprentis en chiffres</strong></div>
               
						
				<div class="panel-body">
                    <form  method="get" action="stat.php" class="form-inline">
                        
                        <div class="form-group">
							<select name="structure" id="structure" class="form-control"
									onChange="this.form.submit();" >
									<option value="" >Toutes les structures </option>
                                     <?php while($str=$resultatStructure->fetch()){ ?>
                                <option value="<?php echo $str['CODE_STRUCT']?>" 
                                        <?php echo $codeStr==$str['CODE_STRUCT']?"selected":0 ?>>		
                                    <?php echo $str['LIBELLE_STRUCT']?>
                                </option>		
                                <?php } ?>
								</select>
						
							<select name="code_specialite" id="code_specialite" class="form-control"
									onChange="this.form.submit();" >
                                    <option value="" >Toutes les spécialités</option>
                                    <?php while($specialite=$resultatSpecialite->fetch()){ ?>
										<option value="<?php echo $specialite['CODE_SPC']?>" 
											<?php echo $codeSpc==$specialite['CODE_SPC']?"selected":0 ?>>
											<?php echo $specialite['LIBELLE_SPC']?>
										</option>									
									<?php } ?>
								</select>  
                            
						</div>
								
                        
										
								
                               
                             
						</form>
                    <br>
                    <div class="tableFixHead scrollbar-blue scrollable">
                    <table class="table table-striped ">
							<thead>
								<tr>
									<th class="text-center" >Structure</th>
									<th class="text-center">Spécialité</th>
                                    <th class="text-center">Apprentis</th>
								</tr>
							</thead>
							<tbody>
									<?php while($result = $resultat->fetch()){?>
									<tr>
                                        
										<td class="text-center"><?php echo $result['LIBELLE_STRUCT'] ?></td>
										<td class="text-center"><?php echo $result['LIBELLE_SPC'] ?></td>
										<td class="text-center"><?php echo $result['NB'] ?></td>
										
									</tr>
								<?php } ?>
							</tbody>
						</table>
                        
                        </div>
				</div>
			</div>

		</div>
		</div>
      
        
				
		
		
	</body>
</html>