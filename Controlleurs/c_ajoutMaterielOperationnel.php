<?php

    include_once '../include/bdd.php';


    $pdo = PdoBdd::getPdoBdd();
    $insert = $pdo->InsertMaterielOP($nom,$nomrmsc,$lot,$cons,$qte,$packaging,$localisation,$dateP,$stockmini,$idA);
    
    if($insert != true)
    {
        echo 'e';
    }
    else
    {
        echo 's';
    }


