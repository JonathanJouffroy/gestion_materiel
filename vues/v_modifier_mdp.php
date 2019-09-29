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
<legend><center><h2><b>Modifier mon mot de passe</b></h2></center></legend>
<br>

<div class="form-group" hidden> 
  <label class="col-md-4 control-label">Mot de passe</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input  name="id" id="id" placeholder="Id" class="form-control"  type="text" value="<?php echo $id; ?>">
  </div>
</div>
</div>

<div class="form-group" > 
  <label class="col-md-4 control-label">Mot de passe</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input  name="mdp" id="mdp" placeholder="Mot de passe" class="form-control"  type="password" >
  </div>
</div>
</div>


<div class="form-group"> 
  <label class="col-md-4 control-label">Confirmation du nouveau mot de passe</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input  name="Cmdp" id="Cmdp" placeholder="Confirmation du nouveau mot de passe" class="form-control"  type="password" >
  </div>
</div>
</div>



<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
      <center><button type="submit" class="btn btn-warning" id="modifMDP" >Modifier le mot de passe</button></center>
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

        $("#modifMDP").click(function(e)
	{
        e.stopPropagation();
        e.preventDefault();
	
        var mdp = $("#mdp").val();
        var Cmdp = $("#Cmdp").val();
        var id = $("#id").val();
        if(mdp == Cmdp && mdp != ''){
            
            $.post("../ajax/modifier_mdp.php",
            {
                "mdp":mdp,
                "id":id,
            },
        retourMdp
            );
            
        }
        else{
            $("#alert_message").show();
            $("#alert_message").html("Les mot de passe ne sont pas identique");
        }
        
         function retourMdp(data)
	{
        var test = data.substring(0,1);
        if (test == 'e') 
	{
            $("#success_message").show();
            $("#success_message").html("Modification du mot de passe réussi avec succès");
        }
        
	else
	{
            // Affiche un message d'erreur
            $("#alert_message").show();
            $("#alert_message").html("Echec de la modification du mot de passe");
        }
    }  
        
    });
	
   
 });   

    </script>