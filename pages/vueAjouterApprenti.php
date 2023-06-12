<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $codeSpc = isset($_GET['code_specialite'])?$_GET['code_specialite']:0;
    $requeteSpecialite = "SELECT * FROM SPECIALITE";
    $codeStr = isset($_GET['code_structure'])?$_GET['code_structure']:0;
    $requeteEtab="SELECT * FROM ETABLISSEMENT";
	$resultatEtab = $connexion->query($requeteEtab);    
    $requeteStructure="SELECT * FROM STRUCTURE";
	$resultatStructure = $connexion->query($requeteStructure);
	$resultatSpecialite = $connexion->query($requeteSpecialite);
    $erreur = isset($_GET['erreur'])?$_GET['erreur']:"";
    $msg1 = "<strong>Erreur :</strong> Cet apprenti existe déjà.";
    $msg2 = "<strong>Erreur :</strong> Nombre de places dans cette structure est insuffisant.";
    $date = (int)date("Y");


?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvel apprenti</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
	</head>
    <div class="the-errors text-center">
        			<?php
                        if ($erreur == "oui") 
                        { ?> <div class="espace60"></div> <?php
                            echo '<div class="msg error">' . $msg1 . '</div>';
                            header("refresh:3;url=vueAjouterApprenti.php");
                            exit();
                        } 
                        if ($erreur == "non") 
                        { ?> <div class="espace60"></div> <?php
                            echo '<div class="msg error">' . $msg2 . '</div>';
                            header("refresh:3;url=vueAjouterApprenti.php");
                            exit();
                        } 
                    ?>
				 </div>
	<body style="background-color : #e0ebeb">
        <?php include('entete.php');?>
		<div class="container">
			<br>
			
			<div class="panel panel-info espace80">
				<div class="panel-heading">Nouvel apprenti</div>
				<div class="panel-body">
					<form method="post" action="addApprenti.php" class="form">
					
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="session" class="control-label">Session *</label>
							<input type="number" name="session" id="session" class="form-control" value="<?php echo $date ?>" required/>
                          </div>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="dateD" class="control-label">Date de debut de formation *</label>
							<input type="date" name="dateD" id="dateD" class="form-control" required/>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="nom" class="control-label">Nom *</label>
							<input type="text" name="nom" id="nom" class="form-control" required/>
                          </div>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="prenom" class="control-label">Prénom *</label>
							<input type="text" name="prenom" id="prenom" class="form-control" required/>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="dateN" class="control-label">Date de naissance</label>
							<input type="date" name="dateN" id="dateN" class="form-control" required/>
                          </div>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="lieuN" class="control-label">Lieu de naissance</label>
							<input type="text" name="lieuN" id="lieuN" class="form-control" required/>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="etablissement" class="control-label">Etablissement de formation *</label>
							<select name="etablissement" id="etablissement" class="form-control" required>
                                    <?php while($etab=$resultatEtab->fetch()){ ?>
									<option value="<?php echo $etab['NOM_ETABLISS']?>" 
										<?php echo $etab['NOM_ETABLISS'] ?>>									
										<?php echo $etab['NOM_ETABLISS']?>
									</option>									
								    <?php } ?>
								</select>
                          </div>
                            
                            <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="code_structure" class="control-label">Structure *</label>
							<select name="code_structure" id="code_structure" class="form-control" required>
                                    <?php while($str=$resultatStructure->fetch()){ ?>
									<option value="<?php echo $str['CODE_STRUCT']?>" 
										<?php echo $codeStr==$str['CODE_STRUCT']?"selected":0 ?>>									
										<?php echo $str['LIBELLE_STRUCT']?>
									</option>									
								    <?php } ?>
								</select>
                          </div>
                            </div>
						<div class="form-row">
                        <div class="form-group col-md-6" style="width:42%">
                          <label for="code_specialite" class="control-label">Spécialité *</label>
							<select name="code_specialite" id="code_specialite" class="form-control" required>
									<option value="" >Toutes les spécialités</option>
                                    <?php while($specialite=$resultatSpecialite->fetch()){ ?>
										<option value="<?php echo $specialite['CODE_SPC']?>" 
											<?php echo $codeSpc==$specialite['CODE_SPC']?"selected":0 ?>>
											<?php echo $specialite['LIBELLE_SPC']?>
										</option>									
									<?php } ?>
								</select>
                        </div>
                            
                        <div class="form-group col-md-6" style="padding-left:180px; padding-bottom:15px; width:57%">
                            <label for="ccp" class="control-label">Compte CCP *</label>
							<input type="text" name="ccp" id="ccp" class="form-control" required/>
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