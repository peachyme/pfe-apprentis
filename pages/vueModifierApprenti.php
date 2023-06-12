<?php
    require_once('session.php');
    require_once('connexionDB.php');


    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;
    $requeteApprenti = "SELECT * FROM APPRENTI WHERE MATRICULE=$matricule";
    $resultatApprenti = $connexion->query($requeteApprenti);
    $apprenti = $resultatApprenti->fetch();
    $nom = $apprenti['NOM'];
    $prenom = $apprenti['PRENOM'];
    $date = $apprenti['DATE_NAISS'];
    $lieu = $apprenti['LIEU_NAISS'];
    $etablissement = $apprenti['NOM_ETABLISS'];
    $specialite = $apprenti['CODE_SPC'];
    $session = $apprenti['SESSION'];
    $requeteEtab="SELECT * FROM ETABLISSEMENT";
	$resultatEtab = $connexion->query($requeteEtab);

    $requeteSpecialite="SELECT * FROM SPECIALITE";
	$resultatSpecialite = $connexion->query($requeteSpecialite);
	
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier un apprenti</title>
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
				<div class="panel-heading">Modifier apprenti</div>
				<div class="panel-body">
					<form method="post" action="updateApprenti.php" class="form">
					
						<div class="form-group" style="padding-left:15px;">
							<label for="matricule" class="control-label" >
								Matricule : <?php echo $matricule ?>
							</label>
							<input type="hidden" name="matricule" id="matricule" class="form-control" value="<?php echo $matricule ?>"/>
						</div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="nom" class="control-label">Nom</label>
							<input type="text" name="nom" id="nom" class="form-control" 
                                   placeholder="Nom" value="<?php echo $nom ?>"/>
                          </div>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="prenom" class="control-label">Prénom</label>
							<input type="text" name="prenom" id="prenom" class="form-control" 
                                   placeholder="Prenom" value="<?php echo $prenom ?>"/>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="dateN" class="control-label">Date de naissance</label>
							<input type="date" name="dateN" id="dateN" class="form-control" 
                                   placeholder="Date de naissance" value="<?php echo $date ?>"/>
                          </div>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="lieuN" class="control-label">Lieu de naissance</label>
							<input type="text" name="lieuN" id="lieuN" class="form-control" 
                                   placeholder="Lieu de naissance" value="<?php echo $lieu ?>"/>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6" style="width:42%">
                            <label for="etablissement" class="control-label">Etablissement de formation *</label>
							<select name="etablissement" id="etablissement" class="form-control" required>
                                    <?php while($etab=$resultatEtab->fetch()){ ?>
									<option value="<?php echo $etab['NOM_ETABLISS']?>" 
										<?php echo $etablissement==$etab['NOM_ETABLISS']?"selected":0 ?>>									
										<?php echo $etab['NOM_ETABLISS']?>
									</option>									
								    <?php } ?>
								</select>
                          </div>
                            
                          <div class="form-group col-md-6" style="padding-left:180px; width:57%">
                            <label for="code_specialite" class="control-label">Spécialité</label>
							<select name="code_specialite" id="code_specialite" class="form-control">
								<?php while($spec=$resultatSpecialite->fetch()){ ?>
									<option value="<?php echo $spec['CODE_SPC']?>" 
										<?php echo $specialite==$spec['CODE_SPC']?"selected":0 ?>>									
										<?php echo $spec['LIBELLE_SPC']?>
									</option>									
								<?php } ?>
							</select>
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



