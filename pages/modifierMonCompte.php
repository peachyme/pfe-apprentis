<?php
    require_once('session.php');
	require_once('connexionDB.php');

	$idUser = $_GET['idUser'];

	$requeteUser = "SELECT * FROM utilisateurs WHERE id=$idUser";

	$resultatUser = $connexion->query($requeteUser);

	$user = $resultatUser->fetch();

    $login = $user['login'];
    $email = $user['email'];
    $role = $user['role'];
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Editer le compte</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>

	</head>
	<body style="background-color : #e0ebeb">
		<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
			<br>
			
			<div class="panel panel-info">
				<div class="panel-heading">Editer le compte</div>
				<div class="panel-body">
					<form method="post" action="updateMyAccount.php" class="form">
					
						<div class="form-group">
							<label for="idUser" class="control-label" >
								Id : <?php echo $user['id']; ?>
							</label>
							<input type="hidden" name="idUser" 
									id="idUser" class="form-control" 
									value="<?php echo $user['id']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="login" class="control-label">
                                <span class="fas fa-user"
                                      style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Login  </label>
							<input type="text" name="login" id="login" class="form-control"
									value="<?php echo $user['login']; ?>"/>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">
                                <span class="fas fa-envelope"
                                      style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Email  </label>
							<input type="text" name="email" id="email" class="form-control"
									value="<?php echo $user['email']; ?>"/>
						</div>
                        
                       
                        <br>
							
                        
                        <a href="vueChangerMDP.php" 
                                class="btn btn-blue" >
                            Changer le mot de passe &nbsp;
                        <span class="fas fa-lock"></span></a>
                        
						<button type="submit" style="float: right"
                                class="btn btn-blue">Enregistrer &nbsp;
                        <span class="fas fa-save"></span></button>
                        
                        
						
                    
                    
                    
                    </form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



