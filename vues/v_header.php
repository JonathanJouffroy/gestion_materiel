<!DOCTYPE html>
<?php 
session_start();
$nom = $_SESSION['user'];
if(!isset($nom))
{
    header("Location:http://127.0.0.1/Gestion%20du%20matériel");
}
else
{
?>
<html>
    <head>
        <title>Gestion du matériel</title>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="../images/logo.png"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>		
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/bootstrap.js"></script>
    
    </head>
    <body>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <!-- Affiche bouton home  -->
                <a class="navbar-brand" href="http://127.0.0.1/Gestion%20du%20mat%c3%a9riel/vues/v_accueil.php">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
              </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav" style="width: 94%;">
                  <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Afficher le stock<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../vues/v_afficher_operationnel.php">Opérationnel</a></li> 
                         <li class="divider"></li>
                         <li><a class="dropdown-item" href="../vues/v_afficher_formation.php">De formation</a></li>
                    </ul>
                </li> 


                    <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gérer le stock<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../vues/v_gerer_operationnel.php">Opérationnel</a></li> 
                         <li class="divider"></li>
                         <li><a class="dropdown-item" href="../vues/v_gerer_formation.php">De formation</a></li>
                    </ul>
                </li>  

                     
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ajouter du Matériel<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../vues/v_ajout_operationnel.php">Opérationnel</a></li> 
                         <li class="divider"></li>
                         <li><a href="../vues/v_ajout_formation.php">De formation</a></li>
                    </ul>
                </li>    

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Visualiser les lots / Formations<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../PDF/Lot A.pdf" target="_blank">Lot A</a></li> 
                        <li class="divider"></li>
                        <li><a href="../PDF/Lot B.pdf" target="_blank">Lot B</a></li>
                        <li class="divider"></li>
                        <li><a href="../PDF/Lot C.pdf" target="_blank">Lot C</a></li>
                        <li class="divider"></li>
                        <li><a href="../PDF/Formation PSC1.pdf" target="_blank">Formation PSC1</a></li>
                    </ul>
                </li> 
                
                <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stock à commander<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../vues/v_afficher_operationnel_a_commander.php">Opérationnel</a></li> 
                         <li class="divider"></li>
                         <li><a class="dropdown-item" href="../vues/v_afficher_formation_a_commander.php">De formation</a></li>
                    </ul>
                </li> 
                <li><a href="../vues/v_contact.php">Contact</a></li>       
                
                <li style="float: right; color: white;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo " Bonjour" . ' '. $nom ;?></li>  
       
                 <li class="nav-item dropdown" style="float: right;">
                    <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span></a>
                    
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../vues/v_mon_compte.php">Mon Compte</a></li> 
                         <li class="divider"></li>
                         <li><a href="../vues/v_modifier_mdp.php">Modifier mon mot de passe</a></li>
                          <li class="divider"></li>
                          <li><a href="../vues/v_export_stock_op.php" target="_blank">Export du Stock des matériels Opérationnel</a></li>
                          <li class="divider"></li>
                          <li><a href="../vues/v_export_stock_for.php" target="_blank">Export du Stock des matériels de Formation</a></li>
                    </ul>
                </li>

              
                

              </ul>


            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
       <!-- <a href="https://icons8.com/icon/14099/paramètres">Paramètres icon by Icons8</a> -->
       <?php 
}
?>