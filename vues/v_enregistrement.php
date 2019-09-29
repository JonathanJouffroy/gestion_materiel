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
$password = !empty($_POST['mdp']) ? $_POST['mdp'] : NULL;
$idAntenne = !empty($_POST['idA']) ? $_POST['idA'] : NULL;
$nomU = !empty($_POST['nom']) ? $_POST['nom'] :NULL;
$prenomU = !empty($_POST['prenom']) ? $_POST['prenom'] :NULL;
$adresseM = !empty($_POST['mail']) ? $_POST['mail'] :NULL;
$role = !empty($_POST['role']) ? $_POST['role'] :NULL;


if($nomU && $password){

    if(isset($_POST['enregistrer'])){
    $Enregistrer = $pdo->Enregistrer($nomU,$prenomU,$userName,$password,$adresseM,$idAntenne,$role);
    if($Enregistrer == true){
     $_SESSION['user'] = $userName;
     header('Location: ../index.php');
    }
    else if($Enregistrer == false){
       $error = "Données invalides";
    }
   }
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
 

<div class="container">
        <br><br><br><br><br><br><br><br><br>
<form class="well form-horizontal" action=" " method="post">
<fieldset>

<!-- Form Name -->
<legend><center><h1><b>Créer mon Compte</b></h1></center></legend>
<br>

<!-- Text input-->
 <div class="form-row">

      <div class="col-6 col-sm-6 form-group">
      <label class="col-md-4 control-label">Nom* :</label>  
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="nom" placeholder="Nom " class="form-control"  type="text" required>
        </div>
     </div>
      <div class="col-6 col-sm-6 form-group">
         <label class="col-md-4 control-label">Prénom* :</label>  
          <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
             <input  name="prenom" placeholder="Prénom"  class="form-control"  type="text" required>
        </div>
      </div>
</div>

 <div class="form-row">
      <div class="col-6 col-sm-6 form-group">
      <label class="col-md-4 control-label">Nom d'utilisateur* :</label>  
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="userName" placeholder="Nom d'utilisateur" class="form-control"  type="text" required>
        </div>
     </div>
      <div class="col-6 col-sm-6 form-group">
         <label class="col-md-4 control-label">Mot de passe* :</label>  
          <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
             <input  type="password" name="mdp" placeholder="Mot de passe"  class="form-control"  required>
        </div>
      </div>
</div>
<!-- Text input-->
<br><br><br><br><br><br>
<div class="form-group">
  <label class="col-md-4 control-label" >Adresse mail* :</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <input  type="email" name="mail" placeholder="Adresse Mail" class="form-control"  required>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" >Antenne* :</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
              <select name="idA" size="1" required class="form-control">
                        <?php 
                        foreach ($listeAntenne as $listeA)
                        {
                            ?> <option value="<?php echo $listeA['id'] ?>"><?php echo $listeA['nom']; ?></option>
                            <?php
                        }

                        ?>
     </select>
    </div>
  </div>
</div>
     
<div class="form-group" hidden>
  <label class="col-md-4 control-label" >Rôle</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  <input type="text" name="role" id="role" placeholder="Role" class="form-control" value="0">
    </div>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-success" name="enregistrer" style="width: 30%;">Valider</button></center>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-primary" onclick="window.location.href = '/Gestion%20du%20matériel';" style="width: 30%;"><span class="glyphicon glyphicon-home"></span> Accueil </button></center>
  </div>
</div>
            <p style="text-align: center; color: red;"><?php echo $error?></p>
</fieldset>
</form>
    </div>
</body>
</html>







