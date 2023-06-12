<link rel="stylesheet" type="text/css" href="../css/monStyle.css">

<nav class="navbar navbar-fixed-top">
	<div class="container-fluid">
        
        <div class="navbar-image">
            
			<a href="gestionDesApprentis.php" class="navbar-brand">
                 <img src="../pdf/gtpp.jpg" alt="GTP" style="border-radius: 50%; height:40px; width:40px; margin-top:-10px; margin-bottom:10px; "></a>
		</div>
		<div class="navbar-header">
            
			<a href="gestionDesApprentis.php" class="navbar-brand" >
                 Gestion des Apprentis</a>
		</div>
  <ul class="nav navbar-nav">
    
      <li><a href="vueApprentis.php" ><span class="fa fa-address-card" style=" margin-left : 10px; margin-right : 10px"></span>
         Les apprentis</a></li>
      
      
      
      
           <li><a>
               <span class="fas fa-money-check-alt" 
                     style="margin-left : 10px; margin-right : 10px">
               </span>Les présalaires
               </a>
           <div class="presalaires-menu">
               <ul class="nav  navbar">
                  
                   <?php if($_SESSION['user']['role']=="Secrétaire") {?>
                   <li><a href = "vueSaisirPointage.php">
                       <span class="fas fa-file-invoice	" style="margin-left : 10px; margin-right : 10px"></span>
                       Saisir pointage
                       </a>
                   </li>
                   <?php } ?>
                   <?php if($_SESSION['user']['role']=="Chef de service") {?>
                   <li><a href = "vueCalculePaie.php">
                       <span class="fas fa-file-invoice-dollar	" style="margin-left : 10px; margin-right : 10px"></span>
                       Calculer présalaires
                       </a>
                   </li>
                   <?php } ?>
               
      
                   <li><a href = "vueParMois.php">
                        <span class="fas fa-calendar-alt" style="margin-left : 10px; margin-right : 10px"></span>
                       Consulter paies par mois
                       </a>
                   </li>
     
                   <li><a href = "vueParApprenti.php">
                          <span class="fas fa-user-graduate" style="margin-left : 10px; margin-right : 10px"></span>
                       Consulter paies par apprenti</a>
                   </li>
               </ul>
           </div>
               </li>
      
      
      
      
      
      
      
      
      
      
      
      
      <li><a href="vueBesoinApprentissage.php"><span class="fa fa-mortar-board" style="margin-left : 10px; margin-right : 10px"></span>Les besoins d'apprentissage</a></li>
		
      <?php if($_SESSION['user']['role']=="Chef de service") {?>
				<li><a href="vueUtilisateurs.php"><span class="fa fa-users" style="margin-left : 10px; margin-right : 10px"></span>
        Espace admin</a></li>
			<?php } ?>
    
  </ul>

		<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="modifierMonCompte.php?idUser=<?php echo $_SESSION['user']['id'] ?>">
						<span class="fas fa-user-circle"
                              style="margin-left : 10px; margin-right : 5px"></span>
                        <?php echo $_SESSION['user']['login'];?>
					</a>
				</li>
				<li>
					<a href="logout.php">
						<span class="fas fa-door-open"></span>
						Log out
					</a>
				</li>
			</ul>
	</div>
</nav>
    