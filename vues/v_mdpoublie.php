<?php

include '../include/bdd.php';
 $pdo = PdoBdd::getPdoBdd();
 $error = '';
 $section='';
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion du matériel</title>
        <link rel="stylesheet"  href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/bootstrap.js"></script>
    </head>
    
    <body>
 
    <h1 id="titreA">Mot de passe oublié</h1>
    <div id="divA">  
<?php if($section == 'code') { ?>
Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>
<br/>
<form method="post">
   <input type="text" placeholder="Code de vérification" name="verif_code"/><br/>
   <input type="submit" value="Valider" name="verif_submit"/>
</form>
<?php } elseif($section == "changemdp") { ?>
Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
<form method="post">
   <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/><br/>
   <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/>
   <input type="submit" value="Valider" name="change_submit"/>
</form>
<?php } else { ?>
<form method="post">
    <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/><br>
   <input type="submit" value="Valider" name="recup_submit" class="btn-success"/>
</form>
<?php } ?>
<?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo ""; } ?>
        <br>
    </div>  
    
    
    
<?php
require '../vendor/autoload.php';
if(isset($_POST['mailform']))
{

$mail = new PHPMailer(true);       
$mail->CharSet = 'UTF-8';                     // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2; 
    $mail->Host='';
    $mail->isSMTP();
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('test@laurentdebize.com', 'Garderie de Meillonnas');
	
    $mail->addAddress("jonathanjouffroy@gmail.com", "Jonathan");     // Add a recipient
 
    
	$body = "<p>Bonjour,</p>

	<p>Voici votre Facture du mois.</p>
	
	<p>Cordialement,</p>";

	
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'test';
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);
    $mail->send();


} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

}

?>
<form method="POST" action="">
	<input type="submit" value="Recevoir un mail !" name="mailform"/>
</form>
    </body>
</html>

