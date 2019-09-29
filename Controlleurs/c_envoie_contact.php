<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    session_start();
    require '../PHPMailer-master/src/Exception.php';
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';
    require '../vendor/autoload.php';

    include_once '../include/bdd.php';
    $pdo = PdoBdd::getPdoBdd();
    
    $nom = $_POST['nom'];
    $mailU = $_POST['mailU'];
    $prenom = $_POST['prenom'];
    $message = $_POST['message'];
    $utilisateur = $nom . ' '. $prenom;
    
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
        $mail->setFrom($mailU, $utilisateur);

        $mail->addAddress('contact@protectioncivile01.fr', 'Protection Civile');     // Add a recipient

        $body = "<p>Bonjour,</p>
            <p>Vous avez reçu une demande de contact de la part de $nom  $prenom.</b></p>
            <p>Le message est : $message </p>
            <p>Cordialement,</p>";
        
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Demande de contact';
        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);
        $mail->send();
        
    
?>


