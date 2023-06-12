<?php
   require_once('session.php');
   require_once('connexionDB.php');

	$mc = isset($_GET['matricule'])?(int)$_GET['matricule']:0;
    $date = isset($_GET['datee'])?$_GET['datee']:0;
    $month = (int)date("m", strtotime($date));
    $year = (int)date("Y", strtotime($date));

    $resultatApprenti = $connexion->query("SELECT * FROM apprenti WHERE MATRICULE = $mc");
    $apprenti = $resultatApprenti->fetch();
    $nom = $apprenti['NOM'];
    $prenom = $apprenti['PRENOM'];



  if ($date != 0)
    {
       
        $resultatPaies = $connexion->query("SELECT YEAR(DATE_P) AS YEAR, MONTH(DATE_P) AS MONTH, PAIE_P, DATE_P, NB_ABS, ID                                                 FROM PAIE
                                            WHERE MONTH(DATE_P) = $month
                                            AND YEAR(DATE_P) = $year
                                            AND MATRICULE = $mc
                                            ORDER BY DATE_P DESC ");	
    }
    else
    {
        
        $resultatPaies = $connexion->query("SELECT YEAR(DATE_P) AS YEAR, MONTH(DATE_P) AS MONTH, PAIE_P, DATE_P, NB_ABS, ID                                                 FROM PAIE
                                            WHERE MATRICULE = $mc
                                            ORDER BY DATE_P DESC");
    }

        
        
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>par apprenti</title>
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
				
				<div class="panel panel-default espace80">
					<div class="panel-heading">Rechercher les paies par mois et année</div>
					<div class="panel-body">
						<form method="get" action="vuePaie.php" class="form-inline">
						<div class="form-group">						
								
								<input type="month" name="datee" 
										id="datee" class="form-control" 
										value="<?php echo $date ?>"/>
                            
								<input type="hidden" name="matricule"  value="<?php echo $mc ?>">		

								
								<button type="submit" 
                                        class="btn btn-grey" >
									<i class="fa fa-search"></i>
								</button>
				        </div>
						</form>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                        Liste des paies de l'apprenti
                        <?php  echo " ".$nom[0].strtolower(ltrim($nom,$nom[0]))." ".$prenom[0].strtolower(ltrim($prenom,$prenom[0])) ?>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
                                    <th>ID</th>
									<th>Année</th>
									<th>Mois</th>
                                    <th>Nombre d'absences</th>
									<th>Paie</th>
                                    <?php if($_SESSION['user']['role']=="Chef de service") {?>
                                    <th>&nbsp; Actions</th>
			                        <?php } ?>
								</tr>
							</thead>
							<tbody>
									<?php while($paie = $resultatPaies->fetch()){?>
									<tr>
                                        <td><?php echo $paie['ID'] ?></td>
										<td><?php echo $paie['YEAR'] ?></td>
										<td>&nbsp;&nbsp;<?php echo $paie['MONTH'] ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $paie['NB_ABS'] ?></td>
                                        <td><?php echo $paie['PAIE_P'] ?></td>
										<?php if($_SESSION['user']['role']=="Chef de service") {?>
                                        <td>
												<!--  Action modifier paie -->
												<a href="vueModifierPaieParApp.php?nba=<?php echo $paie['NB_ABS'] ?>&paie=<?php echo $paie['PAIE_P'] ?>&id=<?php echo $paie['ID'] ?>&matricule=<?php echo $mc ?>
                                                         &date=<?php echo $paie['DATE_P'] ?>">
													<span class="glyphicon glyphicon-edit icon"
                                                          style="margin-left : 10px; margin-right : 10px">
                                                    </span>
												</a>
                                            
                                                <!--  Action Supprimer paie -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer la paie ?')" 
													href="deletePaieApp.php?id=<?php echo $paie['ID'] ?>&matricule=<?php echo $mc ?>
                                                          &date=<?php echo $paie['DATE_P'] ?>">
													<span class="fa fa-trash icon" 
                                                          style="font-size:15px;margin-left : 10px; margin-right : 10px"></span>
												</a>
												
											
										</td>
			                            <?php } ?> 
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