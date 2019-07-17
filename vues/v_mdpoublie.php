<?php

include '../include/bdd.php';
 $pdo = PdoBdd::getPdoBdd();
 $error = '';
 $section='';
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
Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>
<br/>
<form method="post">
   <input type="text" placeholder="Code de vérification" name="verif_code"/><br/>
   <input type="submit" value="Valider" name="verif_submit"/>
</form>
<?php } elseif($section == "changemdp") { ?>
Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
<form method="post">
   <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/><br/>
   <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/>
   <input type="submit" value="Valider" name="change_submit"/>
</form>
<?php } else { ?>
<form method="post">
    <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/><br>
   <input type="submit" value="Valider" name="recup_submit" class="btn-success"/>
</form>
<?php } ?>
<?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo ""; } ?>
        <br>
    </div>    
    </body>
</html>




