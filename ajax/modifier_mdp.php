<?php

    include_once '../include/bdd.php';


    $pdo = PdoBdd::getPdoBdd();
    extract($_POST);
    $modif= $pdo->UpdateMDP($mdp,$id);
    
    if($modif == 1)
    {
        echo 'e';
    }
    else
    {
        echo 's';
    }

?>
