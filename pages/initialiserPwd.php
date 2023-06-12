<?php
    require_once ('connexionDB.php');
    
    $erreur="";
    
    $msg="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['email']))
        
        $email = $_POST['email'];
    
    else
        
        $email = "";

    $requete1 = "select * from utilisateurs where email='$email'";
    
    $resultat1 = $connexion->query($requete1);

    if ($user = $resultat1->fetch()) {
        $id = $user['id'];
        $pwd = "0000";
        $requete = "update utilisateurs set pwd=MD5(?) where id=?";
        $param = array($pwd,$id);
        $resultat = $connexion->prepare($requete);
        $resultat->execute($param);


        $erreur = "non";
        
        $msg = "votre mot de passe à été itialisé avec succès à 0000";
    
    } else {
        $erreur = "oui";
        
        $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";
        
    }
}
?>



<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Initiliser votre mot de passe</title>
    <link 	rel="stylesheet" 	type="text/css" 	href="../css/bootstrap.min.css">
        <link 	rel="stylesheet" 	type="text/css"  	href="../css/font-awesome.min.css">
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/monStyle.css">
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/style.css">

        <script src="../js/jquery-3.3.1.js"></script>
    	<script src="../js/myjs.js"></script>
        <script src="../js/fontAwsome.js"></script>
    

</head>
<body class="boddyy">
    <br><br><br><br><br><br><br><br><br>
	<div class="container col-md-6 col-md-offset-3">
		<br>
		<div class="panel panel-info ">
			<div class="panel-heading">Initiliser votre mot de passe</div>
			<div class="panel-body">

				<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form">

					<div class="form-group">
						<label for="email" class="control-label">
							Veuillez saisir votre
							email de récuperation
						</label>
						
						 <input 
						 	type="email" 
						 	name="email"
							id="email" 
							class="form-control" />

					</div>

                    <button type="submit" 
                                class="btn btn-blue" >
                        Initialiser le mot de passe &nbsp;
                        <span class="fas fa-save"></span></button>
					

				</form>

				
			</div>
			
		</div>
		
		<div class="the-errors text-center">
			 
        			<?php

                        if ($erreur == "oui") {
            
                            echo '<div class="msg error">' . $msg . '</div>';
            
                            header("refresh:10;url=initialiserPwd.php");
            
                            exit();
                        } 
                        else if($erreur == "non")  {
            
                            echo '<div class="msg succes">' . $msg . '</div>';
            
                            header("refresh:5;url=vueAuthentification.php");
            
                            exit();
                        }
    
                    ?>
				
				</div>
	</div>

</body>
</html>



