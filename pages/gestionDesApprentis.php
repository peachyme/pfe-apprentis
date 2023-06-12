
<?php 
    require_once('session.php');
	require_once('connexionDB.php');
	

    
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des apprentis</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        
       <style type="text/css">
           
           
   

           header .containerr{
               width : 100%;
               height : 150px;
               background-color: #31708f;

           }
           header .containerr .section1{
             float: left;
               background-color: #31708f;
               width : 17%;
               height : 150px;
               margin-left :0;
               text-align: center

           }
           
           .section1 img{
               width: 70px;
               height: 70px;
               margin-top: 15px;
               margin-bottom: 5px;
           }
           .section1 a{
               color : #d9edf7;
               font-style:normal;
               font-family: 'Times New Roman', Times, serif;
               font-size: 20px;
           }           
           .section1 a:hover{
               color : #fff;
               text-decoration: none
           }
           
           /*
           header .containerr .section1 h1{
               font-family: "Times New Roman", Times, serif	
;
               color: #d9edf7;
               text-align: center;
               padding-bottom: 15px;
               padding-top: 20px;
               margin-left: 50px
           }
*/
           
           header .containerr .section2{
               float : right;
               background-color: white;
               height : 150px;
               text-align: center;
               border-top-left-radius: 50%;
               border-bottom-left-radius: 50%;




           }
         
           header .containerr .section2 .logo {
               height:170px; 
               width:170px; 
               padding-bottom: 5px;
               margin-top : -10px
               
          }
    
           
           footer
           {
               background-color : #31708f;
               color : #A2A9AF;
               height : 30px;
               width: 100%;
               position: absolute
           }
           footer h5
           {
               margin : auto;
               text-align: center;
               margin-top: 10px
           }
           .titre{
               position: absolute;
           }
           .titre h1{
               margin-left: 420px;
               margin-top: 40px;
               font-style:normal;
               font-family: 'Times New Roman', 'Times', monospace;
           }
           .titre a{
               color : #d9edf7;
           }
           .titre a:hover{
               text-decoration: none
           }

           .main img{
               width: 100%;
               height: 477px;
           }
           .main .btn{
               height: 100px;
               width: 250px;
               margin-left: 150px;
               margin-top: 90px;
               border-radius: 5%;
               font-size: 20px;
               font-style:normal;
               font-family: 'Times New Roman', 'Times', monospace;
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
               

           }
           .main .btns1{
               display: flex;
                position: absolute;
           }
           .main .btns2{
               margin-top: 200px;
               display: flex;
                position: absolute;
           }
           .main span{
               font-size:30px; 
               margin-bottom:5px;
               margin-top: 15px
           }
     
    </style>

	</head>
	<body>
        
        <header>
            <div class="containerr">
                
                <div class="section1">
                    <img src="../images/user.png" >
                    <br>
                    <a href = "vueModifierUtilisateur.php?idUser=<?php echo $_SESSION['user']['id'] ?>">Bienvenue <?php echo $_SESSION['user']['login'] ?></a>
                    <br>
                    <a href = "logout.php">Log out &nbsp;
                        <span class="fas fa-door-open"></span></a>
            
                </div>
                <div class="titre">
                    <h1><a href="gestionDesApprentis.php" >Le Suivi des Apprentis</a></h1>
                </div>
                
                <div class="section2">
                <div class="white-section">
                <div class="overlay">
                    <img class="logo" src="../images/gtp.png">
                </div>
                </div>
                </div>
               
            </div>
            
        </header>
        <div class="main">
            <div class="btns1">
                <a href="vueApprentis.php" class="btn btn-blue">
                    <span class="fa fa-address-card"></span>
                    <br>
                    Apprentis
                </a>
                <a href="vueParMois.php" class="btn btn-blue">
                    <span class="fas fa-money-check-alt"></span>
                    <br>
                    Présalaires
                </a>
                <a href="vueBesoinApprentissage.php" class="btn btn-blue">
                    <span class="fa fa-mortar-board"></span>
                    <br>
                    Besoins d'apprentissage
                </a>
            </div>
            <div class="btns2">
                <a href="stat.php" class="btn btn-blue">
                    <span class="fas fa-chart-bar"></span>
                    <br>
                    Statistiques
                </a>
                <?php if($_SESSION['user']['role']=="Chef de service") {?>
                <a href="vueUtilisateurs.php" class="btn btn-blue">
                    <span class="fa fa-users"></span>
                    <br>
                    Espace administrateur
                </a>
                <?php }else{ ?>
                <a  class="btn btn-blue">
                    <span class="fa fa-users"></span>
                    <br>
                    Espace administrateur
                </a>
                <?php } ?>
                <a href="Apropos.php" class="btn btn-blue">
                    <span class="fa fa-info-circle"></span>
                    <br>
                    A propos
                </a>
            </div>
            <img src="../images/img.png">
            
        </div>
		
        
        <footer>
            <h5>&copy; Le Suivi des Apprentis 2020 | Entreprise Nationale de Grands Travaux Pétroliers | Created and designed by Hadjer & Rayane</h5>
        </footer>   
        
				
		
		
	</body>
</html>