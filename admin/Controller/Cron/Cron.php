<?php

if (!defined('DB_HOST')) define('DB_HOST','localhost');
if (!defined('DB_USER')) define('DB_USER','ensp_arles_com');
if (!defined('DB_PASS')) define('DB_PASS','po78erter');
if (!defined('DB_NAME')) define('DB_NAME','ensp_arles_com');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '/var/www/vhosts/ensp-arles.fr/intervenants.ensp-arles.fr/lib/PHPMailer/src/Exception.php';
require '/var/www/vhosts/ensp-arles.fr/intervenants.ensp-arles.fr/lib/PHPMailer/src/PHPMailer.php';
require '/var/www/vhosts/ensp-arles.fr/intervenants.ensp-arles.fr/lib/PHPMailer/src/SMTP.php';
require_once('/var/www/vhosts/ensp-arles.fr/intervenants.ensp-arles.fr/config/config.php');
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'eliot.masset@ensp-arles.fr';                     //SMTP username
    $mail->Password   = '9csy6h94';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('eliot.masset@ensp-arles.fr', 'ENSP - no-reply');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$ret="";
$query = "SELECT `date_begin`,m.`email`,`id_dossier`, `id_intervenant` FROM `intervention` i INNER JOIN `dossier` d ON `id_dossier`=d.`id` INNER JOIN `intervenant` t ON d.`id_intervenant`=t.`id` LEFT JOIN `membres` m ON m.`id`=`created_user` 
                                                WHERE `date_begin` >= DATE(NOW()) 
                                                AND   `date_begin` <= (DATE(now()) + interval 7 day)
                                                AND   i.`statut`!='Annulée'
                                                AND   d.`statut`<=1";
$stmt = $conn->query($query);
if ($stmt) {
    $ret = $stmt;
}
foreach ($ret as $row) {
    $date_begin="";
    $email="";
    $id=0;
    $id_i=0;
    $i=0;
    foreach ($row as $element) {
        if($i==0)
            $date_begin=$element;
        if($i==1)
            $email=$element;
        if($i==2)
            $id=$element;
        if($i==3)
            $id_i=$element;
        $i++;
    }
    $to = $email;
		$subject = "Dossier non complet || " . SITE_NAME;
		$message = 
		"<br>
		"."<br>
		"."Vous recevez cet e-mail parce qu'un dossier non vérifié à une interventions proches.
		<br> Cette intervention aura lieu le $date_begin
		Merci de bien vouloir le completer (si ce n'est pas encore le cas) et le vérifier.
		<br>
		"."Dossier : ".DOMAIN_NAME."/admin/dossier.php?id_d=$id&id_i=$id_i";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Account Creation <no-reply@' . EMAIL_EXT . "\r\n";

		try {
			//Content
			$mail->addAddress($email);     //Add a recipient
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = SITE_NAME;
			$mail->Body    = $message;
			$mail->AltBody = $message;
		
			$mail->send();
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
}

?>