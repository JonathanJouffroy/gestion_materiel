<?php

include '../Controlleurs/c_mdpoublie.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion du matériel</title>
        <link rel="stylesheet"  href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/bootstrap.js"></script>
    </head>
    
<body>
    <h1 id="titreA">Mot de passe oublié</h1>
    <div id="divA">  
<?php if($section == 'code') { ?>

        <div class="container well">
        Un code de vérification vous a été envoyé par mail: <b><?= $_SESSION['recup_mail']; ?></b>
        </div>
<br/>
<form method="post">
   <input type="text" placeholder="Saisir le code" name="verif_code"/><br/>
   <br>
   <input type="submit" value="Valider" name="verif_submit" class="btn btn-success"/>
   <input type="button" value="Accueil" name="accueil" class="btn btn-primary" onclick="window.location.href = 'http://127.0.0.1/Gestion%20du%20matériel';"/>
</form>
<?php } elseif($section == "changemdp") { ?>
 <div class="container well">
Nouveau mot de passe pour <b><?= $_SESSION['recup_mail']; ?></b>
 </div>
<form method="post">
   <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/>
   <br><br>
   <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/>
   <br><br>
   <input type="submit" value="Valider" name="change_submit" class="btn btn-success"/>
   <input type="button" value="Accueil" name="accueil" class="btn btn-primary" onclick="window.location.href = 'http://127.0.0.1/Gestion%20du%20matériel';"/>
</form>
<?php } else { ?>
<form method="post">
   <input type="email" placeholder="Votre adresse mail" name="recup_mail"/>
   <br><br>
   <input type="submit" value="Valider" name="recup_submit" class="btn btn-success"/>
   <input type="button" value="Accueil" name="accueil" class="btn btn-primary" onclick="window.location.href = 'http://127.0.0.1/Gestion%20du%20matériel';"/>
</form>
<?php } ?>
<?php if(isset($error)) { echo '<span style="color:black">'.$error.'</span>'; } else { echo ""; } ?>
    </div>  
    </body>
</html>