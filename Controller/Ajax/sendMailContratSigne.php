<?php
require_once('../../Model/User.php');
$User = new User;

include("../../config/Mailjet/php-mailjet-v3-simple.class.php");

$apiKey = '796120ead20556203da028d5843d4b7a';
$secretKey = '19a3b02d8633de6f0622122fb65d5994';
$created_mail = $_GET["created_mail"];


$mj = new Mailjet('334ed6fd723964363a5f3398c2d7622e', '997609099c64f1b139cbb2681d80a591');		
	$params = array(
    "method" => "POST",
    "from" => "support@ensp-arles.fr",
    "to" => $created_mail,
     "CC" => "b.martinez@ensp-arles.fr",
	 "subject" => "ENSP Intervenants - Nouveau contrat signé",
    "html" => "
    Bonjour,<br>
	   Un contrat a été signé par un intervenant, il est à votre disposition sur la plateforme : <br>
	    <a href='". DOMAIN_NAME . "'>". DOMAIN_NAME . "</a><br>
	    Bonne journée.<br><br>
	****************** Ceci est un mail automatique, ne pas répondre ****************** <br><br>",);
$result = $mj->sendEmail($params);
if ($mj->_response_code == 200)
    echo "email sent !";
else
    echo "error - " . $mj->_response_code;

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>