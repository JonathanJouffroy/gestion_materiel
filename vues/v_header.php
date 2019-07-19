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
                <li><a href="http://127.0.0.1/Gestion%20du%20mat%c3%a9riel/vues/v_enregistrement.php" class="fas fa-home">Accueil </a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Afficher le stock <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Stock Opérationnel</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Stock de formation</a></li>
                        </ul>
                </li>
               <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ajouter du matériel <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Opérationnel</a></li>
                            <li class="divider"></li>
                            <li><a href="#">De formation</a></li>
                        </ul>
                </li>
               <li><a href="#" >Visualiser les lots</a></li>
               <li><a href="#" >Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-sliders-h"></i><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Mon compte</a></li>
			<li class="divider"></li>
			<li><a href="index.php?uc=classesup">Exporter le stock</a></li>                                     
                    </ul>
                </li>
              </ul>


            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>