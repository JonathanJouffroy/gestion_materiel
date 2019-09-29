<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'v_header.php';   
include '../include/bdd.php';
$pdo = PdoBdd::getPdoBdd();
$error = '';
$user = $_SESSION['user'];
$listeAntenne = $pdo->AfficherAntenne();
$listeLot = $pdo->AfficherLotOP();
$listeMateriel = $pdo->AfficherMaterielOP();
$Affcompte = $pdo->AfficherCompte($user);

foreach ($Affcompte as $compteAff)
{
    $nom = $compteAff['nom'];
    $prenom = $compteAff['prenom'];
    $mail = $compteAff['adresse_mail'];
    $id= $compteAff['id'];
}
?>
<html>
    <head>    

        <meta charset="UTF-8">
        <title>Accueil</title>
        <link rel="stylesheet"  href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/bootstrap.js"></script>
    </head>

    <body>

<div class="container">

    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend><center><h2><b>Mon Compte</b></h2></center></legend>
<br>

<div class="form-group">
  <label class="col-md-4 control-label">Nom d'utilisateur</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="nomutilisateur" placeholder="Nom d'utilisateur" id="nomutilisateur" class="form-control" value="<?php echo $user;?>" readonly  type="text" >
    </div>
  </div>
</div>

<div class="form-group" hidden> 
  <label class="col-md-4 control-label">Nom</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="id" id="id" placeholder="Nom" class="form-control"  value="<?php echo $id;?>"type="text" >
  </div>
</div>
</div>


<div class="form-group"> 
  <label class="col-md-4 control-label">Nom</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="nom" id="nom" placeholder="Nom" class="form-control"  value="<?php echo $nom;?>"type="text" >
  </div>
</div>
</div>

  <div class="form-group"> 
  <label class="col-md-4 control-label">Prénom</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="prenom" id="prenom" placeholder="Prénom" class="form-control" value="<?php echo $prenom;?>" type="text" >
  </div>
</div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label">Adresse Mail</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input  name="email" placeholder="Adresse mail" id="email" class="form-control" value="<?php echo $mail;?>"  type="email" >
    </div>
  </div>
</div>




<!-- Button -->

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-warning" id="modifInfo" >Modifier les informations du compte</button></center>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-danger" id="deconnexion" >Déconnexion</button></center>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <p id="alert_message" style="text-align: center;" class="alert alert-danger" role="alert" hidden></p>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <p id="success_message" style="text-align: center;" class="alert alert-success" role="alert" hidden></p>
  </div>
</div>


</fieldset>
</form>
</div>
    </div><!-- /.container -->
    <script> 
        
$(document).ready(function() {

        $("#deconnexion").click(function(e)
	{
        e.stopPropagation();
        e.preventDefault();
	
      

        $.post("../Controlleurs/c_deconnexion.php",
            {
                
            },
        retourAccueil
            );
        
    });
	
    function retourAccueil()
	{
         window.location = "http://127.0.0.1/Gestion%20du%20matériel";
    }  
    
     $("#modifInfo").click(function(e)
	{
        e.stopPropagation();
        e.preventDefault();
	
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var adressemail = $("#email").val();
        var id = $("#id").val();
        
        $.post("../ajax/modifier_informations_compte.php",
            {
                "nom":nom,
                "prenom":prenom,
                "adressemail":adressemail,
                "id":id,
            },
        retourModifC
            );
        
    });
	
    function retourModifC(data)
	{
        var test = data.substring(0,1);
        if (test == 'e') 
	{
            $("#success_message").show();
            $("#success_message").html("Modification réussi avec succès");
        }
        
	else
	{
            // Affiche un message d'erreur
            $("#alert_message").show();
            $("#alert_message").html("Echec de la modification");
        }
    }  
 });   

    </script>