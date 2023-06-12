<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;
        

?>
<!DOCTYPE HTML>
<html>  
	<head>
		<meta charset="utf-8" />
		<title>Gestions de documents</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="../js/fontAwsome.js"></script>
        

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
	<body style="background-color : #e0ebeb">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
               <br> 
               
                <div class="panel panel-default espace80">
                    <div class="panel-heading">Choisir document</div>
					<div class="panel-body">    
                       
                        
                        <a class="btn btn-blue btn-lg btn-block"
                           href = "vueFECA.php?matricule=<?php echo $matricule ?>">
                        <span class="fas fa-file-invoice" 
                                  style="font-size:17px;margin-left : 10px; margin-right : 10px"></span>
                            Fiche d'établissement de la carte d'accès
                        </a>
                        
                        <a class="btn btn-blue btn-lg btn-block" 
                           href = "vueDAP.php?matricule=<?php echo $matricule ?>">
                            <span class="fas fa-file-text " 
                                  style="font-size:17px;margin-left : 10px; margin-right : 10px"></span>
                            Demande d'apprentissage
                        </a>
                        
                        <a class="btn btn-blue btn-lg btn-block" 
                           href = "vueRAA.php?matricule=<?php echo $matricule ?>">
                           <span class="fas fa-copy" 
                                  style="font-size:17px;margin-left : 10px; margin-right : 10px"></span>
                           Relevés d'assiduité
                        </a>
                            
					</div>
				</div>
			</div>
		</div>
	</body>
</html>