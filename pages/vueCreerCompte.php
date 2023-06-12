
<?php
	require_once('connexionDB.php');

	
	include '../fonctions/fonctions.php'; 
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$validationErrors = array();
		
		$login = $_POST['login'];
		
		$pwd1 = $_POST['pwd1'];
		
		$pwd2 = $_POST['pwd2'];
		
		$email = $_POST['email'];

			if (isset($login)) {
				
				$filtredLogin = filter_var($login, FILTER_SANITIZE_STRING);
				
				if (strlen($filtredLogin) < 4) {
					
					$validationErrors[] = "Erreur de validation: Le login doit contenir au moins 4 caractères";
				
				}
			}

			if (isset($pwd1) && isset($pwd2)) {
				
				if (empty($pwd1)) {
					
					$validationErrors[] = "Erreur de validation: Le mot ne doit pas être vide!";
				}

				if (md5($pwd1) !== md5($pwd2)) {
					
					$validationErrors[] = "Erreur de validation: Les deux mots de passe ne sont pas identiques";
				}
			}

			if (isset($email)) {
				
				$filtredEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
				
				if (filter_var($filtredEmail, FILTER_VALIDATE_EMAIL) != true) {
					
					$validationErrors[] = "Erreur de validation: Email non valid";
					
				}
			}
		

		if (empty($validationErrors)) {
			
			if (findUserByLogin($login) == 0 && findUserByEmail($email) == 0) {
				
				$stmt = $connexion->prepare('INSERT INTO utilisateurs(login, pwd,role, email,etat)
										VALUES (:pLogin,:pPwd,:pRole, :pEmail,:pEtat)');
										
				$stmt->execute(array(
				
						'pLogin' 	=> $login,
						'pPwd' 		=> md5($pwd1),
						'pRole'		=>'Visiteur',
						'pEmail' 	=> $email,
						'pEtat'		=>0)
				);
				
				$succesMsg = "Félicitation , vous avez créer votre nouveau compte";
                
               
			} else if(findUserByLogin($login) >0){

				$validationErrors[] = 'Désolé ce login est déjà utilisé';
				
			}else if(findUserByEmail($email) >0){

				$validationErrors[] = 'Désolé cet email est déjà utilisé';
			}

		}
	}

	
?>
<html>
	<head>
		<meta charset="utf-8">
        <title>Créer un compte</title>
        
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/bootstrap.min.css">
        <link 	rel="stylesheet" 	type="text/css"  	href="../css/font-awesome.min.css">
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/monStyle.css">
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/style.css">

        <script src="../js/jquery-3.3.1.js"></script>
    	<script src="../js/myjs.js"></script>
        <script src="../js/fontAwsome.js"></script>
				
		
		
	</head>
	
	<body class="boddyy">
	
		<br><br><br><br><br>
		
		<div class="container col-md-6 col-md-offset-3">
		
			<div class="panel panel-info">
				<div class="panel-heading">Créer un compte</div>
				<div class="panel-body">
				
					<form class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					
						<div class="form-group">
							<label for="login" class="label-control">
                                <span class="fas fa-user"
                                      style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Login *</label>
							<input type="text" name="login" id="login" 
                                   pattern=".{4,}"
                                   class="form-control" 
                                   autocomplete="off" 
                                   placeholder="Taper votre login"
                                   required>
							
						</div>						
						
						
                        <div class="form-group">
							<label for="pwd1" class="label-control">
                                 <span class="fas fa-lock"
                                       style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Password *</label>
							<input type="password" name="pwd1" id="pwd1" 
                                   class="pw1 form-control "  
                                   autocomplete="new-password"
                                   minlength=4
                                   placeholder="Taper votre password"
                                   required/>
                            <span class="show-pwd1 fa fa-eye fa-2x oeil1" id="oeil1" style="font-size:20px; color:#333"></span>


						</div>
                        
                        
                        <div class="form-group" >
                            <label for="pwd2" class="label-control">
                                 <span class="fas fa-lock"
                                       style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Confirmer password *</label>
							<input type="password" name="pwd2" id="pwd2" 
                                   stye="margin-top:10px"
                                   class="pwd2 form-control "  
                                   autocomplete="new-password"
                                   minlength=4
                                   placeholder="Retaper votre password pour le confirmer"
                                   required/>
                                   <i class="show-pwd2 fa fa-eye fa-2x oeil2" id="oeil2" style="font-size:20px; color:#333"></i>


						</div>
										
						<div class="form-group">
							<label for="email" class="label-control">
                                <span class="fas fa-envelope"
                                      style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Email *</label>
							<input type="email" name="email" autocomplete="on"  id="email"
                                   class="pwd form-control" 
                                   placeholder="Taper votre email"
                                   required>
							
							
						</div>
						<br>
                        <button type="submit" class="btn btn-blue">
                            <span class="far fa-id-card	" btn-blue
                                  style="font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                            Créer mon compte
                        </button>
					
					</form>
                    
                    
                    <div class="the-errors text-center">
			 
				<?php
				
					if (isset($validationErrors) && !empty($validationErrors)) {
					    
						foreach ($validationErrors as $error) {
						    
							echo '<div class="msg error">' . $error . '</div>';
                            
							
						}
					}

					if (!empty($succesMsg)) {
						
						echo '<div class="msg succes">' . $succesMsg . '</div>';
                        
                       
            
                            exit();
					}

				
				?>
                   
				
			</div>
				</div>
			</div>
			
		</div>
		
	</body>
</html>