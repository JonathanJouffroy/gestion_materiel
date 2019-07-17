<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 

session_start();
include 'include/bdd.php';
$pdo = PdoBdd::getPdoBdd();
 $error = '';
 $Connexion = false;

 //VERIFIE SI FORMULAIRE ENVOYÉ OU PAS
 if(isset($_POST['deco'])){
  session_destroy();
 }
  
  
 // Récupération PROPRE des variables AVANT de les utiliser :
 $userName = !empty($_POST['userName']) ? $_POST['userName'] : NULL;
 $password = !empty($_POST['pass']) ? $_POST['pass'] : NULL;
  
 if($userName && $password){

   if(isset($_POST['valider'])){
    $Connexion = $pdo->Connexion($userName, $password);
    if($Connexion == true){
     $_SESSION['user'] = $userName;
     header('Location: vues/v_accueil.php');
    }
    if($Connexion == false) {
     $error =  "LOGIN OU MOT DE PASSE INVALIDE";
    }
   }
   
  }


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
        <form action="" method="POST">
            <input class="inputLogin" type="text" name="userName" placeholder="Nom d'utilisateur" required/>
            <br>
            <br>
            <input class="inputLogin" type="password" name="pass" placeholder="Mot de passe" required>
            <br>
            <br>

            <input type="submit" value="Connexion" name="valider" class="btn-success">
        </form>
        <br>
       <form action="vues/v_enregistrement.php" method="POST">
            <input type="submit" value="Créer mon compte" name="enregistrer" class="btn-success" >
       </form>
            <br>
        <form action="vues/v_mdpoublie.php" method="POST">
            <input type="submit" value="Mot de passe oublié" name="mdpoublie" class="btn-success" >
            
       </form>
        <p> <?php echo $error ?></p>
    </div>    
    </body>
</html>


