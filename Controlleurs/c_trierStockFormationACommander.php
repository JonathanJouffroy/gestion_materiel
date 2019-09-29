<?php
    include_once '../include/bdd.php';
    
    $idAntenne = $_POST['idAntenne'];

    $pdo = PdoBdd::getPdoBdd();
    $materielFormation = $pdo->AfficherMaterielFormationACommander($idAntenne);
    echo json_encode($materielFormation);
?>
