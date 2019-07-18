<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'vendor/autoload.php';

include 'include/bdd.php';
$pdo = PdoBdd::getPdoBdd();
if(isset($_GET['section']))
{
    $section = htmlspecialchars($_GET['section']);
}
else
{
    $section ="";
}

if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      $nomU = $pdo->VerifMail($recup_mail);
      $verifCode = $pdo->VerifCodeMDP($recup_mail);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {

            $pseudo = $nomU; 
            $recup_code = "";
            
            
            $_SESSION['recup_mail'] = $recup_mail;
            for($i=0; $i < 8; $i++) { 
               $recup_code .= mt_rand(0,9);
            }
           
       $updateRecup = $pdo->UpdateRecup($recup_code,$recup_mail);
       $insertRecup = $pdo->InsertRecup($recup_mail,$recup_code);
       var_dump($verifCode);
            if($verifCode == 1)
            {
                $updateRecup; 
            }
            else
            {
                $insertRecup;
            }

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
                $mail->setFrom('support@alessi.com', 'Alessi');
	
                $mail->addAddress($recup_mail, $pseudo);     // Add a recipient
 
    
                $body = "<p>Bonjour,</p>

                    <p>Voici le code pour modifier votre mot de passe : $recup_code</b></p>
	
                    <p>Cordialement,</p>";

	
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Réinitialisation de votre mot de passe';
                $mail->Body = $body;
                $mail->AltBody = strip_tags($body);
                $mail->send();

                header("Location:http://127.0.0.1/Gestion%20du%20matériel/vues/v_mdpoublie.php?section=code");
      }
     
         else {
            $error = "Cette adresse mail n'est pas enregistrée";
         }
      } 
      else {
         $error = "Adresse mail invalide";
      }
   } else {
      $error = "Veuillez entrer votre adresse mail";
   }

if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verifReq = $pdo->VerifReq($_SESSION['recup_mail'],$verif_code);
      $verifRecup = $pdo->VerifRecup($_SESSION['recup_mail']);   
      
      if($verifReq == 1) {
                $verifRecup;
                header('Location:http://127.0.0.1/Gestion%20du%20matériel/vues/v_mdpoublie.php?section=changemdp');
         
      } else {
         $error = "Code invalide";
      }
   } else {
      $error = "Veuillez entrer votre code de confirmation";
   }
}
if(isset($_POST['change_submit'])) {
   if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {
       
       $verif_confirme = $pdo->VerifConfirme($_SESSION['recup_mail']);
       
      if($verif_confirme == 1) {
         $mdp = htmlspecialchars($_POST['change_mdp']);
         $mdpc = htmlspecialchars($_POST['change_mdpc']);               
         $DeleteCode = $pdo->DeleteCode($_SESSION['recup_mail']);
         
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {
               $mdp = password_hash($mdp, PASSWORD_DEFAULT); 
               $UpdateUtilisateur = $pdo->UpdateUtilisateur($mdp,$_SESSION['recup_mail']);
               $UpdateUtilisateur;
               $DeleteCode;

               header('Location:http://127.0.0.1/Gestion%20du%20matériel');
            } else {
               $error = "Vos mots de passes ne correspondent pas";
            }
         } else {
            $error = "Veuillez remplir tous les champs";
         }
      } else {
         $error = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
      }
   } else {
      $error = "Veuillez remplir tous les champs";
   }
}
?>