<?php 
include '../config/config.php'; 
include_once 'Controller/function.php';

$mail_success="";
if (isset($_GET['subscription']))
    $mail_success = mailsuccess;

require_once "Vue/login.php";


?>