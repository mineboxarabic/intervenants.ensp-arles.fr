<?php
/**
 * @package Simple, Secure Login
 * @author John Crossley <john@suburbanarctic.com>
 * @copyright John Crossley 2012 
 * @version 2.0
 **/

// Include the config file so the database knows what day it is::
if(file_exists ('../../../config/config.php')) // prevent ajax call
	require_once('../../../config/config.php');
else
	require_once('../config/config.php');

if(file_exists ('../function.php')) // prevent ajax call
	require_once('../function.php');
else if(file_exists ('Controller/function.php'))
	require_once('Controller/function.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if(file_exists ('../../../lib/PHPMailer/src/Exception.php')) // prevent ajax call
{
	require '../../../lib/PHPMailer/src/Exception.php';
	require '../../../lib/PHPMailer/src/PHPMailer.php';
	require '../../../lib/PHPMailer/src/SMTP.php';
}
else
{
	require '../lib/PHPMailer/src/Exception.php';
	require '../lib/PHPMailer/src/PHPMailer.php';
	require '../lib/PHPMailer/src/SMTP.php';
}



class Email {

	private $mail;

	function __construct() {
		$this->mail = new PHPMailer(true);
		try {
			//Server settings
			$this->mail->SMTPDebug = false;                      //Enable verbose debug output
			$this->mail->isSMTP();                                            //Send using SMTP
			$this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$this->mail->Username   = 'eliot.masset@ensp-arles.fr';                     //SMTP username
			$this->mail->Password   = '9csy6h94';                               //SMTP password
			$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$this->mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			//Recipients
			$this->mail->setFrom('eliot.masset@ensp-arles.fr', 'ENSP - no-reply');
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}




	/**
	*	This method handles the sending of a users forgotten details::
	*/
	public function sendForgotPassword($code, $email) {
		// Now for the message: DO NOT CHANGE ANY OF THE RESET URL::
		$message = 
"
" . MAIL_forgot_password_1 . SITE_NAME . "

".MAIL_forgot_password_2 . DOMAIN_NAME . "/forgot.php?email=$email&reset=$code
<br>****************************************************************************

".MAIL_forgot_password_3."<br>". SITE_NAME . " ";
	
		// Some random header stuff::
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: '.MAIL_forgot_password_header.' <no-reply@' . EMAIL_EXT . "\r\n";
		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = "Nouveau mot de passe || " . SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}


	
	public function updateSuccess($f_name,$l_name,$email) {
		$to = $email;
		$subject = "Registration Success || " . SITE_NAME;
		$message = 
"
".MAIL_update_password_1.SITE_NAME." $f_name".MAIL_update_password_2.DOMAIN_NAME."/profil.php<br>

".MAIL_update_password_5."$f_name";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: '.MAIL_update_password_header.' <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}



	public function newUser($f_name,$l_name,$email, $mdp) {
		// Mail non traduit car non relatif à l'envoyeur.
		$to = $email;
		$subject = "Registration Success || " . SITE_NAME;
		$message = "Félicitation,<br>
		vous avez dés à présent le statut d'intervenant à l'Ecole National Supérieur de la Photographie.<br>
		Attention : le mot de passe étant chiffré, il ne sera pas possible de le retransmettre !<br>
		<br>
		Votre compte à été créé avec succès.<br>
		Les identifiants et informations personnelles relatifs à votre compte sont :<br>
		Mail (nom d'utilisateur): $email <br>
		Nom : $l_name <br>
		Prenom : $f_name <br>
		Mot de passe : $mdp <br><br>
		Nous vous invitons fortement à finaliser les informations relatives à votre compte à l'adresse :". DOMAIN_NAME . "/profil.php";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}




	public function updateMdpSuccess($name,$email,$mdp) {
		$to = $email;
		$subject = "Registration Success || " . SITE_NAME;
		$message = 
"<br>
".MAIL_update_password_1_1.SITE_NAME." $name".MAIL_update_password_1_2." $mdp

".MAIL_update_password_1_3."$name";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}

	public function newIntervention($name,$email, $dossier, $year,$id) {
		$to = $email;
		$subject = "Nouvelle intervention || " . SITE_NAME;
		$message = 
"<br>
"."Bonjour ".$name.
",<br>
"."Vous recevez cet e-mail parce qu'une nouvelle intervention à été créée sur votre dossier ".$dossier." (".$year.").
<br>
"."Intervention : ".DOMAIN_NAME."/intervention.php?id=$id";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}

	public function dossierValidate($title,$year,$name,$id,$email) {
		// Mail non traduit car non relatif à l'envoyeur.
		$to = $email;
		$subject = "Registration Success || " . SITE_NAME;
		$message = "Bonjour $name,<br>
		Le dossier : '$title ($year)' à été validé.<br>
		Vous pourrez suivre votre dossier à l'adresse : ".DOMAIN_NAME."/dossier.php?id=$id
		<br>";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}


	public function dossierUnvalidate($title,$year,$name,$id,$email,$message) {
		// Mail non traduit car non relatif à l'envoyeur.
		$to = $email;
		$subject = "Registration Success || " . SITE_NAME;
		$message = "Bonjour $name,<br>
		Le dossier : '$title ($year)' à été rejeté, des informations sont invalides.<br>
		<b>Message de l'administrateur :<b><br> $message <br>
		Vous pourrez suivre votre dossier à l'adresse : ".DOMAIN_NAME."/dossier.php?id=$id
		<br>";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}

	public function dossierSuppr($email,$name,$title) {
		$to = $email;
		$subject = "Nouveau dossier || " . SITE_NAME;
		$message = 
		"<br>
		"."Bonjour ".$name.
		",<br>
		"."Vous recevez cet e-mail parce que le dossier $title vient d'être supprimer.
		<br>
		";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}

	}

	public function newFolder($name,$email,$title,$year,$id) {
		$to = $email;
		$subject = "Nouveau dossier || " . SITE_NAME;
		$message = 
		"<br>
		"."Bonjour ".$name.
		",<br>
		"."Vous recevez cet e-mail parce qu'un nouveau dossier $title sur l'année $year à été créé.
		<br>
		Merci de bien vouloir le completer.
		<br>
		"."Dossier : ".DOMAIN_NAME."/dossier.php?id=$id";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}

	public function cronAlert($date_begin,$email,$id) {
		$to = $email;
		$subject = "Dossier non complet || " . SITE_NAME;
		$message = 
		"<br>
		"."Bonjour ".$name.
		",<br>
		"."Vous recevez cet e-mail parce qu'un dossier non vérifié à une interventions proches.
		<br> Cette intervention aura lieu le $date_begin
		Merci de bien vouloir le completer (si ce n'est pas encore le cas) et le vérifier.
		<br>
		"."Dossier : ".DOMAIN_NAME."/dossier.php?id=$id";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$this->mail->addAddress($email);     //Add a recipient
			$this->mail->isHTML(true);                                  //Set email format to HTML
			$this->mail->Subject = SITE_NAME;
			$this->mail->Body    = $message;
			$this->mail->AltBody = $message;
		
			$this->mail->send();
			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}
}
?>