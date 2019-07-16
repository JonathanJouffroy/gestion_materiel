<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
        <?php 
        include 'vues/v_header.php';   
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Gestion du matériel</title>
        <link rel="stylesheet"  href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/bootstrap.js"></script>
    </head>
    
    <body>
 
            <h1 id="titreA">Se connecter</h1>
     <div id="divA">  
        <form action="vues/v_accueil.php" method="POST">
            <p>Nom d'utilisateur : <input type="text" name="nomutilisateur"> </p>
         
            <p id="mdpA">Mot de passe : <input type="password" name="mdp"></p>
            
            <input type="submit" value="Connexion" name="btn_connexion" class="btn-success">
        </form>
    </div>
        <?php
            
        
        
        
        ?>
    </body>
</html>
