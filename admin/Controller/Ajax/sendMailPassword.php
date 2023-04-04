<?php
require_once('../Email.php');
$Email = new Email;
require_once('../../Model/User.php');
$User = new User;
if(!$User->valideMail($_GET["mail"]))
{
    echo "email can't be sent !";
}
else {
    if ($m = $Email->sendForgotPassword($User->getCode($_GET["mail"]),$_GET["mail"])) {
        echo "email sent !";
    } else {
        echo "email can't be sent !";
    }
}
?>