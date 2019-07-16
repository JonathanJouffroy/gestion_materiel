<?php

include '../include/bdd.php';
$pdo = PdoBdd::getPdoBdd();
 $error = '';
 $Enregistrer = false;
$listeAntenne = $pdo->AfficherAntenne();
 //VERIFIE SI FORMULAIRE ENVOYÉ OU PAS
 if(isset($_POST['deco'])){
  session_destroy();
 }
  
  
 // Récupération PROPRE des variables AVANT de les utiliser :
$userName = !empty($_POST['userName']) ? $_POST['userName'] : NULL;
$password = !empty($_POST['pass']) ? $_POST['pass'] : NULL;
$id = !empty($_POST['idA']) ? $_POST['idA'] : NULL;
$nomU = !empty($_POST['nom']) ? $_POST['nom'] :NULL;
$prenomU = !empty($_POST['prenom']) ? $_POST['prenom'] :NULL;
$adresseM = !empty($_POST['mail']) ? $_POST['mail'] :NULL;
$roleU = !empty($_POST['role']) ? $_POST['role'] :NULL;
 
if($userName && $password){

    if(isset($_POST['register'])){
    $Enregistrer = $pdo->Enregistrer($userName, $password, $id);
    if($Enregistrer == true){
     $_SESSION['user'] = $userName;
    }
   }
   
  }
  else{
   $error = 'Veuillez remplir tous le champs!';
  }


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
 
    <h1 id="titreA">Créer mon Compte</h1>
    <div id="divA">  
        <form action="" method="POST">
            <input class="inputRegister" type="text" name="nom" placeholder="Nom " required/>
            <input class="inputRegister" type="text" name="prenom" placeholder="Prénom" required>
            <br>
            <br>
            <input class="inputRegister" type="text" name="userName" placeholder="Nom d'utilisateur" required/>
            <input class="inputRegister" type="password" name="pass" placeholder="Mot de passe" required>
            <br>
            <br>
            <p>Antenne :</p>
                <SELECT name="idA" size="1" required="">
                <?php 
                foreach ($listeAntenne as $listeA)
                {
                    ?> <option value="<?php echo $listeA['id'] ?>"><?php echo $listeA['nom']; ?></option>
                    <?php
                }
                
                ?>
           </SELECT>
            
            <br>
            <br>
            <input class="inputRegister" type="text" name="mail" placeholder="Adresse Mail" required>
            <br>
            <br>
            <input type="submit" value="Créer mon compte" name="enregistrer" class="btn-success" >
        </form>
        <br>
    </div>    
    </body>
</html>




