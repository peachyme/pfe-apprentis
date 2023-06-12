<?php
    require_once('session.php');
	require_once('connexionDB.php');
	
    
    $size = 3;
    $page =  isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page-1)*$size;

    $requeteUser = "SELECT * FROM utilisateurs ORDER BY id 	
				                               LIMIT $size
				                               OFFSET $offset";

    $requeteCount = "SELECT COUNT(*) countUser FROM utilisateurs";

    $resultatUser = $connexion->query($requeteUser);
    $resultatCount = $connexion->query($requeteCount);

    $tabCount = $resultatCount->fetch();
    $nbrUser = $tabCount['countUser'];
    $reste = $nbrUser % $size;
    if($reste===0)
    {
        $nbrPage = $nbrUser/$size;
    }
    else
    {
        $nbrPage = floor($nbrUser/$size)+1;
    }
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des utilisateurs</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/fontAwsome.js"></script>
<style>
  .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    background-color: #d9edf7;
    color: #31708f;
}
    .body{
        text-align: center
    }
   
    .container{
        width: 80%;
    }
  </style>
	</head>
	<body style="background-color : #e0ebeb">
        
		<?php include('entete.php');?>	
		<div class="container">
			<br>
			<div class="panel panel-default espace80">
                <div class="panel-heading">Espace de saisie</div>
                <div class="panel-body">
                    <div class="form-inline">
                        <a href="vueSaisirStructure.php" class="btn btn-grey">Ajouter une structure</a>&nbsp;&nbsp;
                        <a href="vueSaisirSpecialite.php" class="btn btn-grey">Ajouter une spécialité</a>&nbsp;&nbsp;
                        <a href="vueSaisirEtablissement.php" class="btn btn-grey">Ajouter un établissement de formation</a>
                    </div>
                    
                </div>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">
                    <span class="fa fa-list" style="color: #31708f; margin-left : 10px; margin-right : 10px"></span>
                    Liste des utilisateurs (<?php echo $nbrUser ?> utilisateurs)</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Id</th>
								<th>Login</th>
								<th>Role</th> 
                                <th>&nbsp;&nbsp;Actions</th>
								
							</tr>
						</thead>
						<tbody>
							
                                <?php while($user=$resultatUser->fetch()){?>
								<tr <?php if ($user['etat']==1){?>class="default" style="background-color:#f5f5f5;" <?php }
                                    else { ?> class="danger" <?php } ?>
                                    
                                    
                                   >
									<td><?php echo $user['id'] ?></td>
									<td><?php echo $user['login'] ?></td>
									<td><?php echo $user['role'] ?></td>
                                    
									
									<td>
											<a href="vueModifierUtilisateur.php?idUser=<?php echo $user['id'] ?>">
												<span class="fas fa-user-edit icon"
                                                      style=" margin-left : 10px; margin-right : 10px">
                                                </span>
											</a>
											
											
											<a OnClick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')" 
											href="deleteUser.php?idUser=<?php echo $user['id'] ?>">
												<span class="fas fa-user-alt-slash icon" 
                                                      style="margin-left : 10px; margin-right : 10px">
                                                </span>
											</a>
											
                                            <a href="updateUserState.php?idUser=<?php echo $user['id'] ?>&etat=<?php echo $user['etat'] ?>">
                                                <?php if($user['etat']==1)
                                                        echo '<span class="fa fa-user-times icon"
                                                                    style="margin-left : 10px; margin-right : 10px">
                                                              </span>';
                                                      else
                                                        echo '<span class="fas fa-user-check icon" 
                                                                  style="margin-left : 10px; margin-right : 10px">
                                                            </span>'; 
                                                ?>
                                            </a>
                                        	
									</td>
								<?php } ?>	
								</tr>
							
						</tbody>
					</table>
                    
                    <div>
						<ul class="nav nav-pills">
							<?php for($i=1;$i<=$nbrPage;$i++){ ?>
								<li class="<?php if($i==$page) echo 'active' ?>">
									<a href="vueUtilisateurs.php?page=<?php echo $i ?>">
										Page <?php echo $i ?>
									</a>
								</li>
							<?php } ?>	
						</ul>
					</div>
					
				</div>				
			</div>	
				
		</div>
	</body>
</html>