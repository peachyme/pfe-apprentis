<?php
require_once('session.php');
require_once('connexionDB.php');
include '../fonctions/fonctions.php'; 


   $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;
   $nbabs = isset($_GET['nbabs'])?$_GET['nbabs']:0;
   $date  = isset($_GET['date'])?$_GET['date']:"";


   $requete="SELECT * FROM PAIE WHERE MATRICULE = $matricule AND DATE_P IN (SELECT MAX(DATE_P) FROM PAIE WHERE MATRICULE=$matricule)";
   $resultat = $connexion->query($requete);
   
   $abs = $resultat->fetch();

   $nbabs = $abs['NB_ABS'];
   $date  = $abs['DATE_P'] ;

   if ($_SERVER['REQUEST_METHOD'] == 'POST') 
   {

       $nbabs = (int)$_POST['nb_absences'];
       $date  = $_POST['date'];
       $matricule = $_POST['matricule'];
       
       $paie = calculePaie($nbabs,$date,$matricule);
       
       header("location:vueCalculerPaie.php?matricule=$matricule&nbabs=$nbabs&date=$date&paie=$paie");
       
   }

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Calculer paie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
	</head>
	<body style="background-color : #e0ebeb">
        <div id="wrapper" >
            <?php include('entete.php');?>
		<div class="container" style="width:900px"> 

            <br>
			<div class="panel panel-info espace80">
				<div class="panel-heading">Saisir Pointage</div>
				<div class="panel-body">
					<form method="post" action="enregistrerPointage.php" class="form">
                       <br>
                        <div class="form-group">
							<label for="matricule" class="control-label" >
								Matricule : <?php echo $matricule ?>
							</label>
							<input type="hidden" name="matricule" id="matricule" class="form-control" 
                                   value="<?php echo $matricule ?>"/>
						</div>
                        <br>
                        <div class="form-group">
							<label for="nb_absences" class="control-label">Nombre d'absences *</label>
							<input type="number" name="nb_absences" id="nb_absences" class="form-control " required
                                   value="<?php echo $nbabs ?>"/>
						</div>
                        <br>
						<div class="form-group">
							<label for="date" class="control-label">Date *</label>
							<input type="date" name="date" id="date" class="form-control" required
                                   value="<?php echo $date ?>"/>
						</div>
                        
                       		
						<br>
						<br>
                        
                        <button type="submit"
                           class="btn btn-blue">
                           Enregistrer 
                            <span class="fa fa-save" 
                                  style="margin-left : 10px; margin-right : 10px;"></span>
                        </button>
						
							
					</form>
				</div>
			</div>
			
		</div>
		</div>
	</body>
</html>



