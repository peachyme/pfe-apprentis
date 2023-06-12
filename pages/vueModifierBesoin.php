<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $codeStr = $_GET['structure'];
    $session = $_GET['session'];
    $codeSpc = $_GET['code_specialite'];

   
    $requeteBesoin = "SELECT B.NB_APPR, STR.LIBELLE_STRUCT, SPC.LIBELLE_SPC
                      FROM besoin_apprentissage B, structure STR, specialite SPC
                      WHERE B.CODE_STR = STR.CODE_STRUCT
                      AND B.CODE_SPC = SPC.CODE_SPC
                      AND ID_SESS = $session
                      AND B.CODE_STR = $codeStr
                      AND B.CODE_SPC = $codeSpc"; 

    $resultatBesoin = $connexion->query($requeteBesoin);
    $besoin = $resultatBesoin->fetch();
    $nbApp = $besoin['NB_APPR'];
    $specialite = $besoin['LIBELLE_SPC'];
    $structure = $besoin['LIBELLE_STRUCT'];

										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier besoin</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
	</head>
	<body style="background-color : #e0ebeb">
        <?php include('entete.php');?>
		<div class="container">
			<br>
			
			<div class="panel panel-info espace80">
				<div class="panel-heading">Modifier besoin d'apprentissage</div>
				<div class="panel-body">
					<form method="post" action="updateBesoin.php" class="form">
					
                        <div class="form-group">
							<label for="session" class="control-label" >
								Session : <?php echo $session ?>
							</label>
							<input type="hidden" name="session" id="session" class="form-control" value="<?php echo $session ?>"/>
						</div>
                        
                        <div class="form-group">
							<label for="structure" class="control-label" >
								Structure : <?php echo $structure ?>
							</label>
							<input type="hidden" name="structure" id="structure" class="form-control" value="<?php echo $codeStr ?>"/>
						</div>
                        
                        <div class="form-group">
							<label for="code_specialite" class="control-label" >
								Spécialité : <?php echo $specialite ?>
							</label>
							<input type="hidden" name="code_specialite" id="code_specialite" class="form-control" 
                                   value="<?php echo $codeSpc ?>"/>
						</div>
                        
                        	
                        <div class="form-group">
							<label for="nbApp" class="control-label">Nombre d'apprentis </label>
							<input type="number" name="nbApp" id="nbApp" class="form-control" 
                                   value="<?php echo $nbApp ?>" />
						</div>						
						
										
						<button type="submit" style="float: right"
                                class="btn btn-blue">Enregistrer &nbsp;
                        <span class="fas fa-save" ></span></button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



