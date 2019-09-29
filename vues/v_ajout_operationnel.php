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

$listeAntenne = $pdo->AfficherAntenne();
$listeLot = $pdo->AfficherLotOP();
$listeMateriel = $pdo->AfficherMaterielOP();

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
<legend><center><h2><b>Ajouter un matériel opérationnel</b></h2></center></legend>
<br>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Antenne*</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
   <select name="idA" id="idA" size="1" required class="form-control">
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

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Lot</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-tasks"></i></span>
    <select name="lot" id="lot" size="1" required class="form-control">
                        <?php 
                        foreach ($listeLot as $listeL)
                        {
                            ?> <option value="<?php echo $listeL['nom'] ?>"><?php echo $listeL['nom']; ?></option>
                            <?php
                        }

                        ?>
    </select>
    </div>
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" >Choix du matériel*</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
  <select name="nom_rnmsc" id="nom_rnmsc" size="1"  class="form-control" required>
                        <?php 
                        foreach ($listeMateriel as $listeM)
                        {
                            ?> <option value="<?php echo $listeM['nom_rnmsc'] ?>"><?php echo $listeM['nom_rnmsc']; ?></option>
                            <?php
                        }

                        ?>
    </select>
    </div>
  </div>
</div>

  <div class="form-group"> 
  <label class="col-md-4 control-label">Quantité*</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-signal"></i></span>
        <input  name="qte" id="qte" placeholder="Quantité" class="form-control"  type="number" min="0" required="">
  </div>
</div>
</div>

  <div class="form-group"> 
  <label class="col-md-4 control-label">Stock minimum*</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
        <input  name="stockmini" id="stockmini" placeholder="Stock minimum" class="form-control"  type="number" min="0" required>
  </div>
</div>
</div>

  <div class="form-group"> 
  <label class="col-md-4 control-label">Nom</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
        <input  name="nom" id="nom" placeholder="Nom" class="form-control"  type="text">
  </div>
</div>
</div>
  
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Date de péremption</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="datep" placeholder="Date de péremption" id="dateP" class="form-control"  type="date">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Consommable</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-copyright-mark"></i></span>
  <input  name="conso" placeholder="O = Nom consommable 1 = Consommable" id="conso" class="form-control"  type="number" min="0" max="1">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Packaging</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
  <input  name="packaging" placeholder="O = Non packagé 1 = Packagé" id="packaging" class="form-control"  type="number" min="0" max="1">
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label">Localisation</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-screenshot"></i></span>
  <input  name="localisation" placeholder="Saisir la localisation du matériel" id="localisation" class="form-control"  type="text">
    </div>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
      <center><button type="submit" class="btn btn-warning" id="ajout_mop" >Ajouter <span class="glyphicon glyphicon-send"></span></button></center>
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
        var nom_rnmsc = $("#nom_rnmsc").val();   
        var lot = $("#lot").val();
        var conso = $("#conso").val(); 
        var quantite = $("#qte").val();
        var packaging = $("#packaging").val();
        var localisation = $("#localisation").val();       
        var datep = $("#dateP").val();
        var stockmini = $("#stockmini").val();
        var ida = $("#idA").val();


        if(nom == '' || nom_rnmsc == '' || lot == '' || conso == '' || quantite == '' || packaging == '' || localisation == '' || datep == '' || stockmini == '' || ida == '' )
        {
            
             $("#alert_message").show();
             $("#alert_message").html("Attention !!! Merci de remplir tous les champs");
        }
        else{
        $.post("../ajax/ajout_materiel_OP.php",
            {
                "nom":nom,
                "nomrmsc":nom_rnmsc,
                "lot":lot,
                "cons":conso,
                "qte":quantite, 
                "packaging":packaging,
                "localisation":localisation,
                "dateP" :datep,
                "stockmini":stockmini,
		"idA" :ida,
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
        if (test == 's') 
	{
            $("#success_message").show();
            $("#success_message").html("Ajout réussi avec succès");
        }
        
	else
	{
            // Affiche un message d'erreur
            $("#alert_message").show();
            $("#alert_message").html("Echec de l'ajout");
        }
    }  
 });   

    </script>