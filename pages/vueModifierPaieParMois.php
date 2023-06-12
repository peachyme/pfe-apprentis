<?php
require_once('session.php');
require_once('connexionDB.php');
include '../fonctions/fonctions.php'; 


   $paie  = isset($_GET['paie'])?$_GET['paie']:0;
   $date  = isset($_GET['date'])?$_GET['date']:"";
   $NBA = isset($_GET['nba'])?$_GET['nba']:0;
   $id = isset($_GET['id'])?$_GET['id']:0;
   $mat = isset($_GET['matricule'])?$_GET['matricule']:0;

   if ($_SERVER['REQUEST_METHOD'] == 'POST') 
   {

       $NBA = (int)$_POST['nba'];
       $date  = $_POST['date'];
       $id  = $_POST['id'];
       $mat = $_POST['matricule'];
       $paie = calculePaie($NBA,$date,$mat);
       
       header("location:vueModifierPaieParMois.php?matricule=$mat&nba=$NBA&date=$date&paie=$paie&id=$id");
       
   }




?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier paie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
	</head>
	<body style="background-color : #e0ebeb">
		<div class="container">
			<br>

			<div class="panel panel-info" >
				<div class="panel-heading">Modifier pointage</div>
				<div class="panel-body">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form">
                       
                        <div class="form-group">
							<input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id ?>" />
						</div>
                        
                        <div class="form-group">
							 
							<input type="hidden" name="matricule" id="matricule" class="form-control" value="<?php echo $mat ?>" />
						</div>
                        
                        <div class="form-group">
							<label for="nba" class="control-label">Nombre d'absences </label>
							<input type="number" name="nba" id="nba" class="form-control" value="<?php echo $NBA ?>"/>
						</div>
                        
						<div class="form-group">
							<label for="date" class="control-label">Date</label>
							<input type="date" name="date" id="date" class="form-control" value="<?php echo $date ?>" readonly/>
						</div>
                        
                        <div class="form-group">
							<label for="paie" class="control-label">Paie </label>
							<input type="number" name="paie" id="paie" class="form-control" readonly
                                   value="<?php echo $paie ?>"/>
						</div>
                        
                      
							
                         
                        <a href="updatePaieParMois.php?matricule=<?php echo $mat ?>&id=<?php echo $id ?>
                                 &nba=<?php echo $NBA ?>&paie=<?php echo $paie ?>&date=<?php echo $date ?>"
                           class="btn btn-blue" style="float: right; margin-left: 10px">
                           Enregistrer
                            <span class="fa fa-save"></span>
                        </a>
                        
                        <button type="submit" style="float: right"
                                class="btn btn-blue" >Calculer paie &nbsp;
                        <span class="fas fa-calculator"></span></button>
                        
							
					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>



