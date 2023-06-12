<?php
    require_once('session.php');
    $matricule = isset($_GET['matricule'])?$_GET['matricule']:0;
    $erreur = isset($_GET['erreur'])?$_GET['erreur']:"";
    $msg="<strong>Erreur :</strong> Relevé d'assiduité existe déjà";

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter un relevé d'assiduité</title>
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
			
			<div class="panel panel-info">
				<div class="panel-heading">Ajouter relevé d'assiduité</div>
				<div class="panel-body">
					<form method="post" action="insertRAA.php" class="form" enctype="multipart/form-data">
                        
                        <div class="form-group">
							<label for="matricule" class="control-label" >
								Matricule : <?php echo $matricule ?>
							</label>
							<input type="hidden" name="matricule" id="matricule" class="form-control" value="<?php echo $matricule ?>"/>
						</div>
                        
						<div class="form-group">
							<label for="libelléRAA" class="control-label" >
								Libellé
							</label>
							<input type="text" name="libelléRAA" id="libelléRAA" class="form-control" value="RAA" readonly/>
						</div>
                        
						<div class="form-group">
							<label for="designationRAA" class="control-label">Désignation</label>
							<input type="text" name="designationRAA" id="designationRAA" class="form-control" value="Relevé d'assiduité" readonly/>
						</div>
                        
                        <div class="form-group">
							<label for="dateRAA" class="control-label">Date *</label>
							<input type="date" name="dateRAA" id="dateRAA" class="form-control" required value=""/>
						</div>
                        
                        <div class="form-group">
							<label for="RAA" class="control-label">Relevé d'assiduité *</label>
							<input type="file" name="RAA" id="RAA" required/>
						</div>
                        <br>
						<button type="submit" style="float: right"
                                class="btn btn-blue" >Enregistrer &nbsp;
                        <span class="fas fa-save"></span></button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
    
    
    <div class="the-errors text-center">
			 
        			<?php

                        if ($erreur == "oui") {
            
                            echo '<div class="msg error">' . $msg . '</div>';
            
                            header("refresh:5;url=vueAjouterRAA.php");
            
                            exit();
                        } 
                        
                    ?>
				
    </div>
</html>
