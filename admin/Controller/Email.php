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


include("config/Mailjet/php-mailjet-v3-simple.class.php");
$apiKey = '796120ead20556203da028d5843d4b7a';
$secretKey = '19a3b02d8633de6f0622122fb65d5994';
$mj = new Mailjet('334ed6fd723964363a5f3398c2d7622e', '997609099c64f1b139cbb2681d80a591');

class Email {

	private $mail;

	function __construct() {
		
	
	}




	/**
	*	This method handles the sending of a users forgotten details::
	*/
	public function sendForgotPassword($code, $email) {
		
	}


	
	public function updateSuccess($f_name,$l_name,$email) {

	}



	public function newUser($f_name,$l_name,$email, $mdp) {
	
	
	$params = array(
    "method" => "POST",
    "from" => "support@ensp-arles.fr",
    "to" => $email,
    "subject" => "ENSP Inscriptions",
    "html" => "Bonjour $f_name $l_name,
			<br>
		Un accès à l'application de gestion des intervenants de l'Ecole nationale supérieure de la Photographie vient de vous être créé.
		". DOMAIN_NAME . "
		<br><br>
		Les identifiants et informations personnelles relatifs à votre compte sont :
		<br><br>
		Mail (nom d'utilisateur): $email <br>
		Mot de passe : $mdp <br>
		Attention : le mot de passe étant chiffré, il ne sera pas possible de le retransmettre !
		<br><br>
		Nous vous invitons fortement à finaliser les informations relatives à votre compte à l'adresse :". DOMAIN_NAME . "/profil.php
		Celle-ci seront automatiquement transmise à l'équipe administrative.
		<br><br>
		Cordialement.<br>
		L'équipe administrative de l'ENSP.  
		",);
$result = $mj->sendEmail($params);
if ($mj->_response_code == 200)
    echo "success - email sent";
else
    echo "error - " . $mj->_response_code;

	}

}
?>