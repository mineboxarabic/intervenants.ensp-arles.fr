<?php
require_once '../../Model/Login.php';
$login = new Login();

if (isset($_POST['user']) && isset($_POST['pass'])) {
	$user = strip_tags($_POST['user']);
	$pass = strip_tags(hash_pbkdf2("sha256", $_POST['pass'], "salt", 1000, 20));
	echo $login->checkUserLogin($user, $pass);
}

if (isset($_POST['forgotEmail'])) {
	$email = strip_tags($_POST['forgotEmail']);
	echo $login->forgotPassword($email);
}

if (isset($_POST['passwordOne']) && isset($_POST['passwordTwo']) && isset($_POST['emailReset']) && isset($_POST['resetCode'])) {
	$passone = strip_tags(hash_pbkdf2("sha256", $_POST['passwordOne'], "salt", 1000, 20));
	$passtwo = strip_tags(hash_pbkdf2("sha256", $_POST['passwordTwo'], "salt", 1000, 20));
	$email = strip_tags($_POST['emailReset']);
	$code = strip_tags($_POST['resetCode']);
	echo $login->changeUserPassword($email, $passone, $passtwo, $code);
}