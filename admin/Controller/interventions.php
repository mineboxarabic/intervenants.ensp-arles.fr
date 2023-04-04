<?php
require_once 'config/inc.connect.php';

require_once 'config/config_general.php';
include_once 'Controller/function.php';
//require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Intervention.php';
require_once 'Model/Dossiers.php';
//$Login = new Login;
$User = new User;
$Intervention = new Intervention;
$Dossiers = new Dossiers;
//$Login->verify();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){header('Location: login.php');exit();}

$id_user=$_SESSION['member_id'];

$first_name=$User->getFirstName($id_user);
$last_name=$User->getLastName($id_user);
$member_email=$User->getEmail($id_user);

$interventions=$Intervention->getAll();

$toaster = "";

require_once "Vue/interventions.php";

echo $toaster;
?>