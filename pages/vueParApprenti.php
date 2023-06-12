<?php
	require_once('session.php');
	require_once('connexionDB.php');
	
	$mc = isset($_GET['motCle'])?$_GET['motCle']:"";
    $size = isset($_GET['size'])?$_GET['size']:5;
    $page = isset($_GET['page'])?$_GET['page']:1;
	$offset=($page-1)*$size;

		$resultatApprentis = $connexion->query("SELECT MATRICULE, NOM, PRENOM, NOM_ETABLISS, LIBELLE_SPC
								                  FROM APPRENTI A,SPECIALITE S
								                  WHERE A.CODE_SPC = S.CODE_SPC
							 	                  AND (NOM like '%$mc%' OR PRENOM like '%$mc%')
							 	                  ORDER BY NOM
							         	          LIMIT $size
							                  	  OFFSET $offset");

		$resultatCount = $connexion->query("SELECT COUNT(*) AS nbrApprentis 
							            	FROM APPRENTI 
								            WHERE NOM LIKE '%$mc%' OR PRENOM LIKE '%$mc%'");
	
	
	$nbr = $resultatCount->fetch();
	
	$nbrApprentis = $nbr['nbrApprentis'];
	
	$reste = $nbrApprentis % $size;

	if($reste==0)
		$nbrPages = $nbrApprentis/$size;
	else
		$nbrPages = floor($nbrApprentis/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Consultation des paies par apprenti</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
<style>
  .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    background-color: #d9edf7;
    color: #31708f;
}
  </style>
	</head>
	<body style="background-color : #e0ebeb">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
                <br>
				<div class="panel panel-default espace80">
					<div class="panel-heading">Rechercher des apprentis</div>
					<div class="panel-body">
						<form method="get" action="vueParApprenti.php" class="form-inline">
						<div class="form-group">						
								
								<input type="text" name="motCle" 
										placeholder="Rechercher un apprenti"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
                                <input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-grey">
                                        <i class="fa fa-search"></i>
								</button>
							</div>
                            
						</form>
					</div>
				</div>
				<div class="panel panel-info ">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                        Liste des apprentis (<?php echo $nbrApprentis ?> apprenti) 
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Matricule</th>
									<th>Nom</th>
									<th>Prénom</th>
                                    <th>Spécialité</th>
                                    <th>&nbsp;&nbsp;Action</th>
								</tr>
							</thead>
							<tbody>
									<?php while($apprenti = $resultatApprentis->fetch()){?>
									<tr>
										<td><?php echo $apprenti['MATRICULE'] ?></td>
										<td><?php echo $apprenti['NOM'] ?></td>
										<td><?php echo $apprenti['PRENOM'] ?></td>
                                        <td><?php echo $apprenti['LIBELLE_SPC'] ?></td>
												
										<td>
                                            &nbsp;&nbsp;&nbsp;
												<!--  Action consulter paie -->
												<a href="vuePaie.php?matricule=<?php echo $apprenti['MATRICULE'] ?>">
													<span class="fas fa-file-invoice-dollar icon" style="margin-left : 10px; margin-right : 10px"></span>
												</a>

                                               
                                            
                                            
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
                        
                        
                        <div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre d'apprentis par Page </label>
											
											<input type="hidden" name="motCle" 
												value="<?php echo $mc ?>">
											<input type="hidden" name="page" 
												value="<?php echo $page ?>">
											<select name="size" class="form-control"
													onchange="this.form.submit()">
												<option <?php if($size==5)  echo "selected" ?>>5</option>
												<option <?php if($size==10) echo "selected" ?>>10</option>
												<option <?php if($size==15) echo "selected" ?>>15</option>
												<option <?php if($size==20) echo "selected" ?>>20</option>
												<option <?php if($size==25) echo "selected" ?>>25</option>
											</select>&nbsp;&nbsp;&nbsp;&nbsp;
										</form>
									</li>
									<?php for($i=1;$i<=$nbrPages;$i++){ ?>
										<li class="<?php if($i==$page) echo 'active' ?>">
											<a href="vueParApprenti.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
	
						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>