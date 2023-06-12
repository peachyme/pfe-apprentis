<?php

   session_start();

   if(isset($_SESSION['loginError']))
   {
		$loginError = $_SESSION['loginError'];
   }
   else
   {
		$loginError = "";
   }

   session_destroy();
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>S'authentifier</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="../js/fontAwsome.js"></script>
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
    <body class="bod">
    <div class="left">
        <img src="../images/logiin.png">
    </div>
    <div class="right">
              
                <div class="title"> <h2>Login</h2> </div>
				<div class="form_container">
					<form method="post" action="login.php" class="form">
						
                        <?php
								if(!empty($loginError))
                                {?>			
									<div class="alert alert-danger">
										<?php echo $loginError ?>
									</div>			
						<?php 	}?>
						<div class="form-group">
							<label for="login" class="control-label" style="margin-left: 40px">
                                <span class="fas fa-user"
                                      style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Login * </label>
							<input type="text" name="login" id="login" 
                                   placeholder="entrer login" 
                                   class="form-control"
                                   style="width: 250px; margin-left: 40px"/>
						</div>
						<div class="form-group">
							<label for="pwd" class="control-label" style="margin-left: 40px">
                                <span class="fas fa-lock"
                                       style="color: #333;font-size:15px; margin-left : 5px; margin-right : 10px"></span>
                                Password * </label>
							<input type="password" name="pwd" id="pwd" placeholder="enter password" 
                                   class="form-control"
                                   style="width: 250px; margin-left: 40px"/>
						</div>
                        <br>
                        <button type="submit" class="btn btn-login" style="width: 250px; margin-left: 40px;font-size: 16px;" >
                            Login
                            <!--
                            <span
                                class="fas fa-door-closed">
                            </span> &nbsp;
                            -->
                        </button>
                        
                        <br><br><br>
                            <div> 
                                <a href="vueCreerCompte.php" style="color: #31708f; 
                                                                    position: relative; 
                                                                    float: left; 
                                                                    font-size:15px;
                                                                    margin-left: 40px">
                                   Créer un compte
                                </a>
                            </div>
                            <div>
                                <a href="InitialiserPwd.php" style="color: #31708f; 
                                                                    position: relative; 
                                                                    float: right; 
                                                                    font-size:15px;
                                                                    margin-right: 40px">
                                    Password oublié ?
                                </a>
                            </div>
                        
						
						
						
                     
					</form>
				
			</div>
		</div>
        
        
        </body>
                

	
</html>



