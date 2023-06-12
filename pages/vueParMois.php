<?php
require_once('session.php');
require_once("connexionDB.php");


$size = isset($_GET['size'])?$_GET['size']:5;
$page = isset($_GET['page'])?$_GET['page']:1;
$date = isset($_GET['date'])?$_GET['date']:0;
$offset=($page-1)*$size;
$requete = $connexion->query("SELECT MAX(ID) AS max FROM PAIE");
$result = $requete->fetch();
$month = date("m");
$year = date("Y");



  if ($date != 0)
    {
        $month = (int)date("m", strtotime($date));
        $year = (int)date("Y", strtotime($date));
        $resultatListPaie = $connexion->query( "SELECT  PAIE.MATRICULE, NOM, PRENOM, PAIE_P, NB_ABS, DATE_P, ID
                                        FROM PAIE, APPRENTI
                                        WHERE PAIE.MATRICULE = APPRENTI.MATRICULE 
                                        AND MONTH(DATE_P)=$month AND YEAR(DATE_P)=$year
                                        LIMIT $size
							            OFFSET $offset");
      
        $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrApprentis 
							            	FROM PAIE
                                            WHERE MONTH(DATE_P)=$month AND YEAR(DATE_P)=$year");
    }
    else
    {
        
        $resultatListPaie = $connexion->query( "SELECT  PAIE.MATRICULE, NOM, PRENOM, PAIE_P, NB_ABS, DATE_P, ID
                                        FROM PAIE, APPRENTI
                                        WHERE PAIE.MATRICULE = APPRENTI.MATRICULE
                                        AND MONTH(PAIE.DATE_P) = $month
                                        AND YEAR(PAIE.DATE_P) = $year
                                        LIMIT $size
							            OFFSET $offset");
        
       
        $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrApprentis 
							            	FROM PAIE
                                            WHERE MONTH(PAIE.DATE_P) = $month
                                            AND YEAR(PAIE.DATE_P) = $year");
    }

$nbr = $resultatCount->fetch();
	
	$nbrApprentis = $nbr['nbrApprentis'];
	
	$reste = $nbrApprentis % $size;

	if($reste==0)
		$nbrPages = $nbrApprentis/$size;
	else
		$nbrPages = floor($nbrApprentis/$size)+1;

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Consultation des paies par mois</title>
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
					<div class="panel-heading">Rechercher les paies par mois et année</div>
					<div class="panel-body">
						<form method="get" action="vueParMois.php" class="form-inline">
						<div class="form-group">						
								
								<input type="month" name="date"
										id="date" class="form-control" 
										value="<?php echo $date ?>"/>
                            
                            <input type="hidden" name="size"  value="<?php echo $size ?>">		
				            <input type="hidden" name="page"  value="<?php echo $page ?>">
								
								<button type="submit" 
                                        class="btn btn-grey" >
									<i class="fa fa-search"></i>
								</button>
							</div>
                            <?php if($_SESSION['user']['role']=="Chef de service") {?>
                            <a href="../pdf/LNA.php" target="_blank" class="btn btn-grey" style="float:right">
									<i class="fa fa-list" ></i> Liste nominative des présalaires
								</a>
                            <?php } ?>
						</form>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                        Liste des paies des apprentis de <?php echo $month."/".$year ?>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Matricule</th>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Paie</th>
                                    <?php if($_SESSION['user']['role']=="Chef de service") {?>
                                    <th>Actions</th>
			                        <?php } ?>                                    
                                    
								</tr>
							</thead>
							<tbody>
										<?php while($paie = $resultatListPaie->fetch()){?>
									<tr>
										<td><?php echo $paie['MATRICULE'] ?></td>
										<td><?php echo $paie['NOM'] ?></td>
										<td><?php echo $paie['PRENOM'] ?></td>
										<td><?php echo $paie['PAIE_P']?></td>
                                        <?php if($_SESSION['user']['role']=="Chef de service") {?>
                                        
                                        <td>
												<!--  Action modifier paie -->
												<a href="vueModifierPaieParMois.php?nba=<?php echo $paie['NB_ABS'] ?>&date=<?php echo $paie['DATE_P'] ?>&paie=<?php echo $paie['PAIE_P'] ?>&id=<?php echo $paie['ID'] ?>&matricule=<?php echo $paie['MATRICULE'] ?> ">
													<span class="glyphicon glyphicon-edit icon"
                                                          style="margin-left : 10px; margin-right : 10px">
                                                    </span>
												</a>
												
                                            
                                                <!--  Action Supprimer paie -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer la paie ?')" 
													href="deletePaieMois.php?id=<?php echo $paie['ID'] ?>&date=<?php echo $paie['DATE_P'] ?>">
													<span class="fa fa-trash icon" 
                                                          style="font-size:15px;margin-left : 10px; margin-right : 10px"></span>
												</a>
											
										</td>
			                            <?php } ?> 
										
									</tr>
								<?php } ?> 
							</tbody>
						</table>
						                         
                        <div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
                                            
											<label>Nombre de paie par Page </label>
											
											 
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
											<a href="vueParMois.php?page=<?php echo $i ?>
											&date=<?php echo $date ?>
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