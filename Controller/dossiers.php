<?php
require_once 'config/config_general.php';
include_once 'Controller/function.php';
require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Intervention.php';
require_once 'Model/Dossier.php';
$Login = new Login();
$User = new User();
$Intervention = new Intervention();
$Dossier = new Dossier();
$Login->verify();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || $_SESSION['admin']){header('Location: login.php');exit();}
/**
 * This page generate HTML Version of the page in the html directory
 * If you are looking for specific content please look at the "content" directory
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_user=$_SESSION['member_id'];

$first_name=$User->getFirstName($id_user);
$last_name=$User->getLastName($id_user);
$member_email=$User->getEmail($id_user);

$dossiers=$Dossier->getAll($id_user);

require_once "Vue/dossiers.php";

?>
