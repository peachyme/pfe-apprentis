<?php 
    require_once('session.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Les apprentis en chiffres</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>   
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
           .container{
               background-color: white;
               opacity: 0.9;
               border-radius: 1%;
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
           }
           
           .apprentissage h2{
               margin-left: 100px;
               font-style:normal;
               font-family: 'Times New Roman', 'Times', monospace; 
               color : #31708f;
               font-size: 36px
           }
           .apprentissage p{
               margin-left: 150px;
               margin-right: 150px;
               text-align : justify;
               font-style:normal;
               font-family: 'Times New Roman', 'Times', monospace; 
               color : #333;
               font-size: 24px
           }
    
     
    </style>
	
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
    
    <div class="apprentissage container espace80">
        <br><strong><h2>L'apprentissage en bref</h2></strong><br>
        <p>L'ENGTP encadre en permanence environ 100 stagiaires dans le cadre de l'apprentissage pour les différentes spécialités et diplômes en convention avec plusieurs centres et instituts de formation professionnelle. La durée de stage varie entre 12 mois et 30 mois, le service formation est chargé de suivi des apprentis dès l'admission à l'entreprise jusqu'à l'obtention du diplôme et fin de la formation.
        </p><br><br>
    </div>
			
	
</html>