<?php

    include_once '../include/bdd.php';


    $pdo = PdoBdd::getPdoBdd();
    extract($_POST);
    $modif= $pdo->ModifierCompte($nom,$prenom,$adressemail,$id);
    if($modif == 1)
    {
        echo 'e';
    }
    else
    {
        echo 's';
    }

?>

