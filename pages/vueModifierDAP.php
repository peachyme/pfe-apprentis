<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $code = isset($_GET['code'])?$_GET['code']:"";
    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;

    $requeteDAP = "SELECT * FROM DAP WHERE code_dap like '$code'";

	$resultatDAP = $connexion->query($requeteDAP);

	$dap = $resultatDAP->fetch();


?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier une demande d'apprentissage</title>
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
				<div class="panel-heading">Modifier demande d'apprentissage</div>
				<div class="panel-body">
					<form method="post" action="updateDAP.php" class="form" enctype="multipart/form-data">
					  
                        <div class="form-group">
							<label for="matricule" class="control-label">
								Matricule : <?php echo $matricule ?>
							</label>
							<input type="hidden" name="matricule" id="matricule" class="form-control" value="<?php echo $matricule ?>"/>
						</div>
                        
                        <div class="form-group">
							<label for="codeDAP" class="control-label" >
								Code : <?php echo $code ?>
							</label>
							<input type="hidden" name="codeDAP" id="codeDAP" class="form-control" value="<?php echo $code ?>"/>
						</div>
                        
						<div class="form-group">
							<label for="libelléDAP" class="control-label" >
								Libellé 
							</label>
							<input type="text" name="libelléDAP" id="libelléDAP" class="form-control" value="DAP" readonly/>
						</div>
						
						<div class="form-group">
							<label for="designationDAP" class="control-label">Désignation</label>
							<input type="text" name="designationDAP" id="designationDAP" class="form-control" value="Demande d'apprentissage" readonly/>
						</div>
                        
                        <div class="form-group">
							<label for="dateDAP" class="control-label">Date</label>
							<input type="date" name="dateDAP" id="dateDAP" class="form-control" value="<?php echo $dap['DATE_DAP'] ?>"/>
						</div>
                        
                        <div class="form-group">
							<label for="DAP" class="control-label">Demande d'apprentissage</label>
							<input type="file" name="DAP" id="DAP"/>
						</div>
                        <br>
						<button type="submit" style="float: right"
                                class="btn btn-blue">Enregistrer &nbsp;
                        <span class="fas fa-save"></span></button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>
