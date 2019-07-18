<?php
session_start();

include '../vues/v_mdpoublie.php';
include '../include/bdd.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../vendor/autoload.php';
include '../include/bdd.php';

 $pdo = PdoBdd::getPdoBdd();
 $nomU = $pdo->VerifMail($recup_mail);
 $verifCode = $pdo->VerifCodeMDP($recup_mail);
 $updateRecup = $pdo->UpdateRecup($recup_code,$recup_mail);
 $insertRecup = InsertRecup($recup_mail,$recup_code);
 
 
 if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         
            $_SESSION['recup_mail'] = $recup_mail;
            $recup_code = "";
            for($i=0; $i < 8; $i++) { 
               $recup_code .= mt_rand(0,9);
            }
          if($verifCode == 1)
          {
             $updateRecup; 
          }
          else
          {
             $insertRecup;
          }
          
                       // Passing `true` enables exceptions
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

                    <p>Voici le code pour modifier votre mot de passe.</p>
	
                    <p>Cordialement,</p>";

	
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'test';
                $mail->Body = $body;
                $mail->AltBody = strip_tags($body);
                $mail->send();

                header("Location:http://localhost/Gestion%20du%20matériel/vues/v_mdpoublie.php?section=code");
                
                }catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
                
            }
            
          
      }
      
      
  }

 


