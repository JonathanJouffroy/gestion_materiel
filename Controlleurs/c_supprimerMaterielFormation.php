<?php
    include_once '../include/bdd.php';

    $id = $_POST['id'];

    $pdo = PdoBdd::getPdoBdd();
    $pdo->SupprimerMaterielFormation($id);
?>