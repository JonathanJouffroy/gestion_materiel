<?php
    include_once '../include/bdd.php';
    
    $idAntenne = $_POST['idAntenne'];

    $pdo = PdoBdd::getPdoBdd();
    $materielOperationnel = $pdo->AfficherMaterielOperationnelACommander($idAntenne);
    echo json_encode($materielOperationnel);
?>
