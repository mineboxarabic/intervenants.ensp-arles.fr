<?php
//require_once('../Email.php');
//$Email = new Email;
require_once('../../Model/User.php');
$User = new User;
/*
if(!$User->valideMail($_GET["mail"]))
{
    echo "email can't be sent !";
}
else {
*/

include("../../config/Mailjet/php-mailjet-v3-simple.class.php");

$apiKey = '796120ead20556203da028d5843d4b7a';
$secretKey = '19a3b02d8633de6f0622122fb65d5994';
$email = $_GET["email"];

$mj = new Mailjet('334ed6fd723964363a5f3398c2d7622e', '997609099c64f1b139cbb2681d80a591');		
	$params = array(
    "method" => "POST",
    "from" => "support@ensp-arles.fr",
    "to" => $email,
    "subject" => "ENSP Intervenants - Votre contrat",
    "html" => "
    Bonjour,<br>
	   Un contrat a été signé et est à votre disposition sur la plateforme : <br>
	    <a href='". DOMAIN_NAME . "'>". DOMAIN_NAME . "</a><br>
		Merci de le signer à votre tour et de le téléverser dans l'onglet 'contrat' de votre dossier.<br><br>
	Merci, nous restons à votre disposition en cas de problème.<br>
	l'équipe administrative de l'ENSP.<br><br>
	****************** Ceci est un mail automatique, ne pas répondre ****************** <br><br>",);
$result = $mj->sendEmail($params);
if ($mj->_response_code == 200)
    echo "email sent !";
else
    echo "error - " . $mj->_response_code;

/*
    if ($m = $Email->sendForgotPassword($User->getCode($_GET["mail"]),$_GET["mail"])) {
        echo "email sent !";
    } else {
        echo "email can't be sent !";
    }
*/

/*
}
*/
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>