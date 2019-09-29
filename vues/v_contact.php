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
<legend><center><h2><b>Contactez Nous</b></h2></center></legend>
<br>


<div class="form-group"> 
  <label class="col-md-4 control-label">Nom*</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="nom" id="nom" placeholder="Nom" class="form-control"  value="<?php echo $nom;?>"type="text" required="">
  </div>
</div>
</div>

  <div class="form-group"> 
  <label class="col-md-4 control-label">Prénom*</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="prenom" id="prenom" placeholder="Prénom" class="form-control" value="<?php echo $prenom;?>" type="text" required>
  </div>
</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Adresse Mail*</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input  name="email" placeholder="Adresse mail" id="email" class="form-control" value="<?php echo $mail;?>"  type="email" required>
    </div>
  </div>
</div>

  <div class="form-group"> 
  <label class="col-md-4 control-label">Message*</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
        <textarea  name="message" id="message" placeholder="Saisir votre message" class="form-control"  required></textarea>
  </div>
</div>
</div>
  


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
      <center><button type="submit" class="btn btn-warning" id="ajout_mop" >Envoyer </button></center>
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

        $("#ajout_mop").click(function(e)
	{
        e.stopPropagation();
        e.preventDefault();
	
        var nom = $("#nom").val();   
        var prenom = $("#prenom").val();
        var mailU = $("#email").val();
        var message = $("#message").val();

        if(nom == '' || prenom == '' || mailU == '' || message == '' )
        {
            
             $("#alert_message").show();
             $("#alert_message").html("Attention !!! Merci de remplir tous les champs");
        }
        else{
        $.post("../Controlleurs/c_envoie_contact.php",
            {
                "nom":nom,
                "prenom":prenom,
                "mailU":mailU,
                "message":message,
            },
        retourAjoutMOP
            );
        }
    });
	
    function retourAjoutMOP(data)
	{
        //alert(data);
        //console.log(data);
        var test = data.substring(0,1);
        if (test == '2') 
	{
            $("#success_message").show();
            $("#success_message").html("Envoie du mail réussi");
        }
        
	else
	{
            // Affiche un message d'erreur
            $("#alert_message").show();
            $("#alert_message").html("Echec de l'envoie du mail");
        }
    }  
 });   

    </script>