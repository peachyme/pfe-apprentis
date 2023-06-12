<?php
    require_once('session.php');
    require_once('connexionDB.php');



    $requeteStructure="SELECT * FROM STRUCTURE";
    $resultatStructure = $connexion->query($requeteStructure);


    



?>
<!DOCTYPE HTML>
<html>
   
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Structure</title>
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
			<div class="panel panel-default espace80">
				<div class="panel-heading">Nouvelle Structure</div>
				<div class="panel-body">
					<form method="post" action="addSTR.php" class="form-inline">
                        

                        <div class="form-group">
                            <input type="text" name="libellé" id="libellé" class="form-control" 
                                   placeholder="Libellé" style="width: 220px" required/>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <input type="text" name="designatiion" id="designation" class="form-control" 
                                   placeholder="Designation" style="width: 220px" required/>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <input type="text" name="region" id="region" class="form-control" 
                                   placeholder="Région" style="width: 220px" required/>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <input type="text" name="type" id="type" class="form-control" 
                                   placeholder="Type" style="width: 220px" required/>
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
                        Liste des structures
					</div>
					<div class="panel-body">
                        <div class="tableFixHead scrollbar-blue scrollable" style="height : 270px">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Code</th>
									<th>Libellé</th>
                                    <th>Désignation</th>
                                    <th>Région</th>
                                    <th>Type</th>
								</tr>
							</thead>
							<tbody>
									
							<?php while($structure = $resultatStructure->fetch()){?>
									<tr>
										<td><?php echo $structure['CODE_STRUCT'] ?></td>
										<td><?php echo $structure['LIBELLE_STRUCT'] ?></td>
										<td><?php echo $structure['DESIGN_STRUCT'] ?></td>
										<td><?php echo $structure['REGION'] ?></td>
										<td><?php echo $structure['TYPE'] ?></td>
										
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



