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
        
 error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

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
            <input type="password" name="mdp" placeholder="Mot de passe">
            <br>
            <br>
            <input type="submit" value="Connexion" name="btn_connexion" class="btn-success">
        </form>
    </div>
        <?php
          
     ?>
    </body>
</html>
