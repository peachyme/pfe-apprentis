<?php
    require_once('session.php');
    require_once('connexionDB.php');

    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;
    $date = isset($_GET['dateRAA'])?$_GET['dateRAA']:0;

    $size = isset($_GET['size'])?(int)$_GET['size']:5;
    $page = isset($_GET['page'])?$_GET['page']:1;
	$offset=($page-1)*$size;
    

    if($date != 0)
    {
       
        $month = (int)date("m", strtotime($date));
        $year = (int)date("Y", strtotime($date));
        $requeteRAA = "SELECT * FROM RAA WHERE MATRICULE = $matricule 
                                         AND MONTH(DATE_RAA)=$month 
                                         AND YEAR(DATE_RAA)=$year
                                         LIMIT $size
                                         OFFSET $offset";
        
        $resultatRAA = $connexion->prepare($requeteRAA);
        $resultatRAA->execute();
        
        $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrRAA 
								              FROM RAA 
								              WHERE MATRICULE = $matricule 
                                              AND MONTH(DATE_RAA)=$month 
                                              AND YEAR(DATE_RAA)=$year");
    }
    else
    {
        
        $requeteRAA = "SELECT * FROM RAA WHERE MATRICULE = $matricule
                                         LIMIT $size
							             OFFSET $offset";
        
        $resultatRAA = $connexion->prepare($requeteRAA);
        $resultatRAA->execute();
        
        $resultatCount = $connexion->query("SELECT COUNT(*) AS nbrRAA 
								              FROM RAA 
								              WHERE MATRICULE = $matricule");
    }
    

	
	
	$nbr = $resultatCount->fetch();
	
	$nbrRAA = (int)$nbr['nbrRAA'];
	
	$reste = $nbrRAA % $size;

	if($reste==0)
		$nbrPages = $nbrRAA/$size;
	else
		$nbrPages = floor($nbrRAA/$size)+1;// floor retourne la partie entière d'un nombre 
	

    
 
?>
<!DOCTYPE HTML>
<html>  
	<head>
		<meta charset="utf-8" />
		<title>Relevés d'assiduité</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="../js/fontAwsome.js"></script>
        <style>
  .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    background-color: #d9edf7;
    color: #31708f;
}
  </style>
        

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
	<body style="background-color : #e0ebeb">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
              <br>
               
				<div class="panel panel-default espace80">
					<div class="panel-heading">Rechercher relevé d'assisuité</div>
					<div class="panel-body">
						<form method="get" action="vueRAA.php" class="form-inline">
                            <div class="form-group">
							<input type="hidden" name="matricule" id="matricule" class="form-control" value="<?php echo $matricule ?>"/>
						</div>
                        
						<div class="form-group">
                                <input type="month" name="dateRAA" 
										placeholder="choisir une date"
										id="dateRAA" class="form-control" 
										value="<?php echo $date ?>"/>
								<button type="submit" class="btn btn-grey" >
                                    <i class="fa fa-search"></i>
								</button>
                                <a class="btn btn-grey" 
                                   style="position: relative; 
                                          margin-left: 585px;" href="vueAjouterRAA.php?matricule=<?php echo $matricule ?>">
                                    Ajouter nouveau relevé d'assiduité
                                    <span class="fas fa-file" 
                                          style="font-size:17px;margin-left : 10px; margin-right : 5px"></span></a>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
                        <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                        Liste des relevés d'assiduité
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Code</th>
									<th>Date</th>
                                    <th>&nbsp; &nbsp; &nbsp; Actions</th>
								</tr>
							</thead>
							<tbody>
									<?php while($raa = $resultatRAA->fetch()){?>
									<tr>
										<td><?php echo $raa['CODE_RAA'] ?></td>
										<td><?php echo date("d/m/Y", strtotime($raa['DATE_RAA'])) ?></td>	
										<td>
												<a href="vueModifierRAA.php?code=<?php echo $raa['CODE_RAA'] ?>&matricule=<?php echo $matricule ?>">
													<span class="fas fa-file-signature icon"
                                                          style="margin-left : 10px; margin-right : 10px"></span>
												</a>
                                               
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le relevé ?')" 
													href="deleteRAA.php?code=<?php echo $raa['CODE_RAA'] ?>&matricule=<?php echo $matricule ?>">
													<span class="fa fa-trash icon" 
                                                          style="font-size:15px;margin-left : 10px; margin-right : 10px"></span>
												</a>
                                            
                                                <a href="../documents/<?php echo $raa['DOCUMENT'] ?>" target="_blank">
													<span class="fa fa-print icon" 
                                                          style="font-size:15px; margin-left : 10px; margin-right : 10px"></span>
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
											<label>Nombre de relevés par Page </label>
											
											<input type="hidden" name="dateRAA" 
												value="<?php echo $date ?>">
                                            
                                            <input type="hidden" name="matricule" 
												value="<?php echo $matricule ?>">
                                            
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
											<a href="vueRAA.php?page=<?php echo $i ?>
											&dateRAA=<?php echo $date ?>
                                            &matricule=<?php echo $matricule ?>
											&size=<?php echo $size ?>
                                           ">
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