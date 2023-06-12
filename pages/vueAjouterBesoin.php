<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $codeStr = isset($_GET['code'])?$_GET['code']:0;
    $requeteStructure="SELECT * FROM STRUCTURE";
	$resultatStructure = $connexion->query($requeteStructure);


    $codeSpc = isset($_GET['code_specialite'])?$_GET['code_specialite']:0;
    $requeteSpecialite = "SELECT * FROM SPECIALITE";
	$resultatSpecialite = $connexion->query($requeteSpecialite);
	
	$date = (int)date("Y");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouveau besoin</title>
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
			<br>
			
			<div class="panel panel-info espace80">
				<div class="panel-heading">Nouveau besoin d'apprentissage</div>
				<div class="panel-body">
					<form method="post" action="addBesoin.php" class="form">
					
                        <div class="form-group" style="padding-left:14px; width:97.5%">
							<label for="session" class="control-label">Session *</label>
							<input type="number" name="session" id="session" class="form-control" value="<?php echo $date ?>" required/>
						</div>
						
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="structure" class="control-label">Libellé structure *</label>
							<select name="structure" id="structure" class="form-control" required>
								<?php while($str=$resultatStructure->fetch()){ ?>
									<option value="<?php echo $str['CODE_STRUCT']?>" 
										<?php echo $codeStr==$str['CODE_STRUCT']?"selected":0 ?>>									
										<?php echo $str['LIBELLE_STRUCT']?>
									</option>									
								<?php } ?>
							</select>
                          </div>
                          
                          <?php
                          $codeStr = isset($_GET['code'])?$_GET['code']:0;
                          $requeteStructure="SELECT * FROM STRUCTURE";
                          $resultatStructure = $connexion->query($requeteStructure);
                          ?>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="designation" class="control-label">Designation structure *</label>
							<select name="designation" id="designation" class="form-control" required>
								<?php while($str=$resultatStructure->fetch()){ ?>
									<option value="<?php echo $str['CODE_STRUCT']?>" 
										<?php echo $codeStr==$str['CODE_STRUCT']?"selected":0 ?>>									
										<?php echo $str['DESIGN_STRUCT']?>
									</option>									
								<?php } ?>
							</select>
                          </div>
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="code_specialite" class="control-label">Spécialité *</label>
							<select name="code_specialite" id="code_specialite" class="form-control" required>
                                    <?php while($specialite=$resultatSpecialite->fetch()){ ?>
										<option value="<?php echo $specialite['CODE_SPC']?>" 
											<?php echo $codeSpc==$specialite['CODE_SPC']?"selected":0 ?>>
											<?php echo $specialite['LIBELLE_SPC']?>
										</option>									
									<?php } ?>
								</select>
                          </div>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; padding-bottom:15px; width:57%">
                            <label for="nbApp" class="control-label">Nombre d'apprentis *</label>
							<input type="number" name="nbApp" id="nbApp" class="form-control" required/>
                          </div>
                        </div>
										
				      <div style="padding:23px">
						<button type="submit" style="float: right" 
                                class="btn btn-blue">Enregistrer &nbsp;
                        <span class="fas fa-save"></span></button>
				       </div>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



