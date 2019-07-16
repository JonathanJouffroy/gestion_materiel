<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
        include 'vues/v_header.php'; 
        include 'include/bdd.php';
        $nom= '';
        $mdp='';
        $pdo = PdoBdd::getPdoBdd();
        $Connexion = $pdo->Connexion($nom,$mdp);
 ?>
<html>
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
            <input type="text" name="nomutilisateur" placeholder="Nom d'utilisateur">
            <br>
            <br>
            <input type="password" name="mdp" placeholder="Mot de passe" value="$nom">
            <br>
            <br>
            <input type="submit" value="Connexion" name="btn_connexion" class="btn-success" value="$mdp">
        </form>
    </div>
        <?php
          
     ?>
    </body>
</html>
