<?php
 session_start();
include 'include/bdd.php';
$pdo = PdoBdd::getPdoBdd();
 $error = '';
 $bLogin = false;
 $bRegister = false;
 
 //VERIFIE SI FORMULAIRE ENVOYÉ OU PAS
 if(isset($_POST['deco'])){
  session_destroy();
 }
  
  
 // Récupération PROPRE des variables AVANT de les utiliser :
 $userName = !empty($_POST['userName']) ? $_POST['userName'] : NULL;
 $password = !empty($_POST['pass']) ? $_POST['pass'] : NULL;
 $id = !empty($_POST['idA']) ? $_POST['idA'] : NULL;
  
 if($userName && $password){

   if(isset($_POST['valider'])){
    $bLogin = $pdo->Connexion($userName, $password);
    if($bLogin == true){
     $_SESSION['user'] = $userName;
     header('Location: vues/v_accueil.php');
    } else {
     echo "LOGIN OU MOT DE PASSE INVALIDE";
    }
   }
      
   if(isset($_POST['register'])){
    $bRegister = $pdo->Enregistrer($userName, $password, $id);
    if($bRegister == true){
     $_SESSION['user'] = $userName;
    }
   }
   
  }
  else{
   $error = 'Veuillez remplir tous le champs!';
  }


?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf8">
  <title></title>
 </head>
 <body>
  <!-- FORMULAIRE AVEC LOGIN MDP -->
  <div id="divIndex1">
   <form action="" method="POST">
    <label class="login">Nom d'utilisateur </label><input class="inputLogin" type="text" name="userName" /><br/>
    <label class="login">Mot de passe </label><input class="inputLogin" type="password" name="pass"><br/>
    <label id="login-submit"><?php echo $error; ?></label><input class="inputLogin" type="submit" name="valider" value="valider"/>
    <input class="inputLogin" type="submit" name="register" value="s'enregistrer"/><br/>
    <?php echo $_SESSION['user'];?>
   </form>
      <?php
      if(!empty($user)){
      ?>
      <form action="" method="POST">
    <input class="inputLogin" type="submit" name="deco" value="se déconnecter"/>
   </form>
      <?php
      }
      ?>
  </div>
 </body>
 
</html>