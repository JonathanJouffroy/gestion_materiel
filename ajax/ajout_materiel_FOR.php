<?php


    include_once '../include/bdd.php';


    $pdo = PdoBdd::getPdoBdd();
    extract($_POST);
    $insert = $pdo->InsertMaterielFOR($nom,$nomrmsc,$typeformation,$cons,$qte,$packaging,$localisation,$dateP,$stockmini,$idA);
    if($insert == false)
    {
        echo 'e';
    }
    else
    {
        echo 's';
    }

?>