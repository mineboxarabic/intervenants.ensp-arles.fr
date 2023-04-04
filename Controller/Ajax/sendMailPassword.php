<?php
//require_once('../Email.php');
//$Email = new Email;
require_once('../../Model/User.php');
$User = new User;
if(!$User->valideMail($_GET["mail"]))
{
    echo "email can't be sent !";
}
else {

	include("../../config/Mailjet/php-mailjet-v3-simple.class.php");

$apiKey = '796120ead20556203da028d5843d4b7a';
$secretKey = '19a3b02d8633de6f0622122fb65d5994';
$code = $User->getCode($_GET["mail"]);
$email = $_GET["mail"];

$mj = new Mailjet('334ed6fd723964363a5f3398c2d7622e', '997609099c64f1b139cbb2681d80a591');		
	$params = array(
    "method" => "POST",
    "from" => "support@ensp-arles.fr",
    "to" => $email,
    "subject" => "ENSP Intervenants - Nouveau mot de passe",
    "html" => "
    Bonjour,<br>
    Vous avez demander une réinitialisation de votre mot de passe sur la plateforme des intervenants de l'ENSP.<br><br>
    Pour cela merci de suivre le lien suivant : <br>
    <a href='". DOMAIN_NAME . "/forgot.php?email=$email&reset=$code'>". DOMAIN_NAME . "/forgot.php?email=$email&reset=$code</a>
	Si ce n'est pas le cas merci d'ignorer ce mail<br><br>
	L'équipe administrative de l'ENSP<br><br>
	*************************<br><br>",);
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
}
?>