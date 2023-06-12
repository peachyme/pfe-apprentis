<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;
    $code = isset($_GET['code'])?$_GET['code']:0;
    $erreur = isset($_GET['erreur'])?$_GET['erreur']:"";
    $msg1 = "<strong>Erreur :</strong> L'apprenti appartient déjà à cette structure.";
    $msg2 = "<strong>Erreur :</strong> Nombre de places dans cette structure est insuffisant.";



    $requeteStructure  = "SELECT * FROM STRUCTURE";
	$resultatStructure = $connexion->query($requeteStructure);    

    $requeteApprenti  = "SELECT * FROM apprenti WHERE MATRICULE=$matricule";
	$resultatApprenti = $connexion->query($requeteApprenti);
    $apprenti = $resultatApprenti->fetch();
    $session = $apprenti['SESSION'];
    $specialite = $apprenti['CODE_SPC'];
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle structure</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
	</head>
	<body style="background-color : #e0ebeb">
		<div class="container">
			<br>
			
			<div class="panel panel-info">
				<div class="panel-heading">Nouvelle structure</div>
				<div class="panel-body">
					<form method="post" action="addStructure.php" class="form">
                        <div class="form-group">
							<label for="matricule" class="control-label" >
								Matricule : <?php echo $matricule ?>
							</label>
							<input type="hidden" name="matricule" id="matricule" class="form-control" value="<?php echo $matricule ?>"/>
						</div>
                        <div class="form-group">
							<label for="structure" class="control-label">Structure</label>
							<select name="structure" id="structure" class="form-control">
								<?php while($str=$resultatStructure->fetch()){ ?>
									<option value="<?php echo $str['CODE_STRUCT']?>" 
										<?php echo $code==$str['CODE_STRUCT']?"selected":0 ?>>									
										<?php echo $str['LIBELLE_STRUCT']?>
									</option>									
								<?php } ?>
							</select>
						</div>
                        
                        <input type="hidden" name="session"  value="<?php echo $session ?>">		
                        <input type="hidden" name="specialite"  value="<?php echo $specialite ?>">		

						
						
										
						<button type="submit" style="float: right"
                                class="btn btn-blue" >Enregistrer &nbsp;
                        <span class="fas fa-save" ></span></button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
 
    <div class="the-errors text-center">
        			<?php
                        if ($erreur == "oui") 
                        { ?> <div class="espace60"></div> <?php
                            echo '<div class="msg error">' . $msg1 . '</div>';
                            header("refresh:3;url=vueAjouterStructure.php");
                            exit();
                        } 
                        if ($erreur == "non") 
                        { ?> <div class="espace60"></div> <?php
                            echo '<div class="msg error">' . $msg2 . '</div>';
                            header("refresh:3;url=vueAjouterStructure.php");
                            exit();
                        } 
                    ?>
				 </div>
	
</html>



