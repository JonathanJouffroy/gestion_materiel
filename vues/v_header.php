<!DOCTYPE html>
<html>
    <head>
        <title>Gestion du matériel</title>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>		
    </head>
    <body>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <!-- Affiche bouton home  -->
                <a class="navbar-brand" href="index.php">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
              </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="index.php?uc=enfant">Enfant </a></li>
                <li><a href="index.php?uc=responsable"> Responsable </a></li>
                <li><a href="index.php?uc=compte"> Compte</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Badgeuse <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="index.php?uc=importation">Importation badgeuse</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?uc=verif">Correction des erreurs</a></li>
                           
                        </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Facture <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            
							<li><a target="_blank" href="vues/v_facture.php">Facturation du mois</a></li>
							<li><a href="index.php?uc=saisiepenalites">Saisie des pénalités</a></li>
                            <!-- <li ><a href="index.php?uc=test">Facturation</a></li> -->
                            <!-- <li class="divider"></li> -->
                            <!-- <li>Editer</li> -->
                            <li class="divider"></li>
							    <li><a target="_blank" href="vues/v_pointage.php">Détail pointage</a></li>
                                <li><a target="_blank" href="vues/pdf.php">Situation du mois</a></li>
                                <li><a target="_blank" href="vues/v_situationA.php">Situation annuelle</a></li>
                        </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Paramètre<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?uc=horaire">Taux horaire</a></li>
						 <li class="divider"></li>
						<li><a href="index.php?uc=classesup">Classe Supérieure</a></li>
                                                <li><a href="index.php?uc=mensuelle">Validation Mensuelle</a></li>                                        
                    </ul>
                </li>
              </ul>


            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>