<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer-master/src/Exception.php';
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';
    require '../vendor/autoload.php';
    include_once '../include/bdd.php';
    
    $pdo = PdoBdd::getPdoBdd();
    
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $nom_rnmsc = $_POST['nom_rnmsc'];
    $type_formation = $_POST['type_formation'];
    $quantite = $_POST['quantite'];
    $localisation = $_POST['localisation'];
    $peremption = $_POST['peremption'];
    $stock_minimum = $_POST['stock_minimum'];
    $user = $_SESSION['user'];
    
    
$Affcompte = $pdo->AfficherCompte($user);

foreach ($Affcompte as $compteAff)
{
    $nom = $compteAff['nom'];
    $prenom = $compteAff['prenom'];
    $mailC = $compteAff['adresse_mail'];
    $pseudo = $prenom .''. $nom;
}

    if ($quantite < $stock_minimum) {
        $mail = new PHPMailer(true);       
        $mail->CharSet = 'UTF-8';  
        $mail->SMTPDebug = 2; 
        $mail->Host='smtp-jonathanjouffroy.alwaysdata.net';
        $mail->isSMTP();
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'jonathanjouffroy@alwaysdata.net';                 // SMTP username
        $mail->Password = 'JonathanTest1234';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('contact@protectioncivile01.fr', 'Protection Civile');

        $mail->addAddress($mailC, $pseudo);     // Add a recipient

        $body = "<p>Bonjour,</p>
            <p>Le matériel <b>$nom_rnmsc </b>a atteint son stock minimum.</p>
            <p>Cordialement,</p>";
        
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Attention! Stock minimum atteint.';
        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);
        $mail->send();
        echo "Impossible de modifier le matériel. Le stock minimum a été atteint.";
    } 

        echo $pdo->ModifierMaterielFormation($id, $nom, $nom_rnmsc, $type_formation, $quantite, $localisation, $peremption, $stock_minimum);
    
?>
