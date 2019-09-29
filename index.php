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
                <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
        <script src="js/bootstrap.js"></script>
    </head>
    
    <body>
        <br><br><br><br><br><br><br><br><br>
    <div class="container">
<form class="well form-horizontal" action=" " method="post">
<fieldset>

<!-- Form Name -->
<legend><center><h2><b>Se connecter</b></h2></center></legend>
<br>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Nom d'utilisateur* :</label>  
  <div class="col-md-4 selectContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
   <input  type="text" name="userName" placeholder="Nom d'utilisateur" class="form-control" required/>
    </div>
  </div>
</div>


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Mot de passe* :</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  <input type="password" name="pass" placeholder="Mot de passe" class="form-control" required>
    </div>
  </div>
</div>



<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-success" name="valider">Connexion</button></center>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-primary" onclick="window.location.href='vues/v_enregistrement.php'" >Créer mon compte </button></center>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-primary" onclick="window.location.href='vues/v_mdpoublie.php'" >Mot de passe oublié ? </button></center>
  </div>
</div>
</fieldset>
     <p style="text-align: center; color: red;" > <?php echo $error ?></p>
</form>


</div> 
</body>
</html>



