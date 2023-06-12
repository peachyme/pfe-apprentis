<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $requeteEtablissement = "SELECT * FROM ETABLISSEMENT";
    $resultatEtablissement = $connexion->query($requeteEtablissement);

?>
<!DOCTYPE HTML>
<html>
   
	<head>
		<meta charset="utf-8" />
		<title>Nouvel Etablissement</title>
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
				<div class="panel-heading">Nouvel Etablissement</div>
				<div class="panel-body">
					<form method="post" action="addEtablissement.php" class="form-inline">
                        

                        <div class="form-group">
                            <input type="text" name="libellé" id="libellé" class="form-control" 
                                   placeholder="Etablissement de formation" style="width: 220px" required/>
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
                        Liste des Etablissements
					</div>
					<div class="panel-body">
                        <div class="tableFixHead scrollbar-blue scrollable" style="height : 270px">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Nom</th>
								</tr>
							</thead>
							<tbody>
									
							<?php while($etablissement = $resultatEtablissement->fetch()){?>
									<tr>
										<td><?php echo $etablissement['NOM_ETABLISS'] ?></td>
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


