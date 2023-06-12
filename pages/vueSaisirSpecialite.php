<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $requeteSpecialite = "SELECT * FROM SPECIALITE";
    $resultatSpecialite = $connexion->query($requeteSpecialite);

?>
<!DOCTYPE HTML>
<html>
   
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Specialite</title>
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
		<div class="container" style = "width: 80%">
			<br>
			<br>
			
			<div class="panel panel-default espace80">
				<div class="panel-heading">Nouvelle Specialite</div>
				<div class="panel-body">
					<form method="post" action="addSPC.php" class="form-inline">
                        

                        <div class="form-group">
                            <input type="text" name="libellé" id="libellé" class="form-control" 
                                   placeholder="Libellé" style="width: 220px" required/>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <input type="text" name="domaine" id="domaine" class="form-control" 
                                   placeholder="Domaine de formation" style="width: 220px" required/>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <input type="number" name="duree" id="duree" class="form-control" 
                                   placeholder="Durée de formation" style="width: 220px" required/>
                        </div>
                        
						<button type="submit" style="float: right; width: 173px" 
                                class="btn btn-grey">Enregistrer &nbsp;
                        <span class="fas fa-save"></span></button>
				      
							
					</form>
				</div>
			</div>
            <div class="panel panel-info">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                        Liste des spécialités
					</div>
					<div class="panel-body">
                        <div class="tableFixHead scrollbar-blue scrollable" style="height : 270px">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Code</th>
									<th>Libellé</th>
                                    <th>Domaine</th>
                                    <th>Durée</th>
								</tr>
							</thead>
							<tbody>
									
							<?php while($specialite = $resultatSpecialite->fetch()){?>
									<tr>
										<td><?php echo $specialite['CODE_SPC'] ?></td>
										<td><?php echo $specialite['LIBELLE_SPC'] ?></td>
										<td><?php echo $specialite['DOMAINE_FORM'] ?></td>
										<td><?php echo $specialite['DUREE_FORM'] ?></td>
									</tr>
								<?php } ?>	
							</tbody>
						</table>
						
						
					</div>				
					</div>				
				</div>	
			
			
				
		</div>
	</body>
</html>



