

<?php
    require_once ('session.php');

 $login = $_SESSION['user']['login'];
    $email = $_SESSION['user']['email'];
    $erreur = isset($_GET['erreur'])?$_GET['erreur']:"";
    $msg = "<strong>Erreur :</strong> L'ancien mot de passe est incorrect";
?>

<html>
	<head>
		<meta charset="utf-8">
        <title>Changement de mot de passe</title>
        
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/bootstrap.min.css">
        <link 	rel="stylesheet" 	type="text/css"  	href="../css/font-awesome.min.css">
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/monStyle.css">
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/style.css">

        <script src="../js/jquery-3.3.1.js"></script>
    	<script src="../js/myjs.js"></script>
        <script src="../js/fontAwsome.js"></script>
				
		
		
	</head>
	
	<body style="background-color : #e0ebeb">
	
		<br><br><br><br><br>
		
		<div class="container col-md-6 col-md-offset-3">
		
			<div class="panel panel-info">
				<div class="panel-heading">
                    <h2 class="text-center">Changement du mot de passe</h2>
    		
    		        <h3 class="text-center"> Compte : <?php echo $_SESSION['user']['login'] ?> 	</h3>
                </div>
				<div class="panel-body">
				
					<form class="form" method="post" action="updatePwd.php">
    
    
    			<!-- ***************** start old pwd field  ***************** -->
                    <br>
    				<div class="form-group">
                        <label for="oldpwd" class="label-control">
                                 <span class="fas fa-lock"
                                       style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Ancien password *</label>
    					<input 	
    						minlength=4
    						class="oldpwd form-control" 
    						type="password"
    						name="oldpwd" 
                            id="oldpwd" 
    						autocomplete="new-password"
    						placeholder="Taper votre ancien mot de passe" 
    						required> 
                            <span class="show-oldpwd fa fa-eye fa-2x oeil3" id="oeil3" style="font-size:20px; color:#333"></span>
    				</div>
    
    
    			<!-- ***************** end old pwd field ***************** -->
    
    <br>
    
    			<!--  ***************** start new pwd field  ***************** -->
    
    
    				<div class="form-group">
                        <label for="newpwd" class="label-control">
                                 <span class="fas fa-lock"
                                       style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Nouveau password *</label>
    					<input 	
    						minlength=4
    						class="newpwd form-control" 
    						type="password"
    						name="newpwd" 
    						id="newpwd" 
    						autocomplete="new-password"
    						placeholder="Taper votre nouveau mot de passe" 
    						required> 
                            <span class="show-newpwd fa fa-eye fa-2x oeil4" id="oeil4" style="font-size:20px; color:#333"></span>
    				</div>
    
    
    			<!--  *****************  end new pwd field  ***************** -->
    
    			<!--  ***************** start submit field  ***************** -->
    
    					<button type="submit" 
                                class="btn btn-blue btn-block">Enregistrer
                        <span class="fas fa-save"></span></button>
    			<!--   ***************** end submit field  ***************** -->
    
    		</form>
                    
               
				</div>
			</div>
			
		</div>
		
	</body>
     <div class="the-errors text-center">
        			<?php
                        if ($erreur == "oui") 
                        { ?> <div class="espace80"></div> <?php
                            echo '<div class="msg error">' . $msg . '</div>';
                            $url=$_SERVER['HTTP_REFERER'];
                            header("refresh:5;url=$url");
                            exit();
                        } 
                        if ($erreur == "non") 
                        { ?> <div class="alert alert-success espace60">
        			<h3>Le Changement de votre compte est achevé avec succès</h3>
        			<p>
        				<label for="login" class="control-label">Login :<?php echo $login; ?></label>
        			</p>
        			<p>
        				<label for="email" class="control-label">Email :<?php echo $email; ?></label>
        			</p>
        			<?php header("refresh:5;url=vueAuthentification.php");?>
        			
        			
        		</div>
                       <?php  } 
                    ?>
				 </div>
</html>





