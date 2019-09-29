<?php
    include_once '../include/bdd.php';
    
    $idAntenne = $_POST['idAntenne'];

    $pdo = PdoBdd::getPdoBdd();
    $materielOperationnel = $pdo->AfficherMaterielOperationnel($idAntenne);
    echo json_encode($materielOperationnel);
?>
