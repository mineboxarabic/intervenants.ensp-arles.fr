<?php
require_once '../../Model/User.php';
$User = new User();
echo $User->delete($_GET["id"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>