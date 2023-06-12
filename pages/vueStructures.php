<?php
    require_once('session.php');
    require_once('connexionDB.php');
    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;


    $requeteStructuresApprenti = "SELECT * FROM STRUCT_APP WHERE MATRICULE=$matricule";
    $resultattructuresApprenti = $connexion->query($requeteStructuresApprenti);
    

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des structures</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>

	</head>
	<body style="background-color : #e0ebeb">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
                <br>
				<div class="panel panel-default espace60">
                    <div class="panel-heading">
                        Nouvelle structure
					</div>
					<div class="panel-body">
						<form method="get" action="vueStructures.php" class="form-inline">
                                <a class="btn btn-grey"
                                   href="vueAjouterStructure.php?matricule=<?php echo $matricule ?>">
                                   Ajouter nouvelle structure
                                    <span class="fa fa-plus" style="margin-left : 10px; margin-right : 10px"></span>

                                </a>
						</form>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                        Historique des structures
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Code</th>
									<th>Libellé</th>
                                    <th>Désignation</th>
                                    <th>Actions</th>
								</tr>
							</thead>
							<tbody>
									
							<?php while($structure = $resultattructuresApprenti->fetch()){?>
									<tr>
										<td><?php echo $structure['CODE_STRUCT'] ?></td>
										<td><?php echo $structure['LIBELLE_STRUCT'] ?></td>
										<td><?php echo $structure['DESIGN_STRUCT'] ?></td>
										
										<td>
												&nbsp; 
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer la structure?')" 
													href="deleteStructure.php?matricule=<?php echo $matricule ?>
                                                          &code=<?php echo $structure['CODE_STRUCT'] ?>">
													<span class="fas fa-trash icon" 
                                                          style="font-size:15px; margin-left : 10px; margin-right : 10px">
                                                    </span>
												</a>
										</td>
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