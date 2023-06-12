<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;
        
    $requeteDAP = "SELECT * FROM DAP WHERE MATRICULE = $matricule";
    $resultatDAP = $connexion->prepare($requeteDAP);
    $resultatDAP->execute();
    
    $num_rows = $resultatDAP->rowCount();
    


    
 
?>
<!DOCTYPE HTML>
<html>  
	<head>
		<meta charset="utf-8" />
		<title>Demande d'apprentissage</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="../js/fontAwsome.js"></script>
        

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
	<body style="background-color : #e0ebeb">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
               <br>
                <?php 
                if($num_rows == 0)
                {
                ?>
                 <div class="panel panel-default espace80">
					<div class="panel-heading">Demande d'apprentissage</div>
					<div class="panel-body">
						<form method="get" action="vueDAP.php" class="form-inline">
						<div class="form-group">
                                <a class="btn btn-grey" 
                                   href="vueAjouterDAP.php?matricule=<?php echo $matricule ?>">Ajouter la demande d'apprentissage
                         <span class="fas fa-file-text" 
                                  style="font-size:17px;margin-left : 10px; margin-right : 10px"></span></a>
							</div>
						</form>
					</div>
				</div>
                <?php 
                }
                else
                {
                    $dap = $resultatDAP->fetch();
                ?>
                 <div class="panel panel-info espace80">
					<div class="panel-heading">
                        <span class="fas fa-file-text" 
                              style="color:#31708f; font-size:17px;margin-left : 10px; margin-right : 10px"></span>
                        Demande d'apprentissage
                    </div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Code</th>
									<th>Date</th>
                                    <th>&nbsp; Actions</th>
								</tr>
							</thead>
							<tbody>
									<tr>
										<td><?php echo $dap['CODE_DAP'] ?></td>
										<td><?php echo date("d/m/Y", strtotime($dap['DATE_DAP'])) ?></td>	
										<td>
												<a href="vueModifierDAP.php?code=<?php echo $dap['CODE_DAP'] ?>&matricule=<?php echo $matricule ?>">
													<span class="fas fa-file-signature	icon" 
                                                          style="margin-left : 10px; margin-right : 10px">
                                                    </span>
												</a>
                                            
                                                <a href="../documents/<?php echo $dap['DOCUMENT'] ?>" target="_blank">
													<span class="fa fa-print icon"
                                                          style="font-size:15px; margin-left : 10px; margin-right : 10px"></span>
												</a>
                                            
										</td>
									</tr>
								
							</tbody>
						</table>			
					</div>
				</div>
                <?php }?>

            
                
					
				
			</div>
		</div>
	</body>
</html>