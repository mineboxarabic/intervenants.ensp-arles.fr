<?php
require_once 'config/inc.connect.php';
require_once 'config/config_general.php';
require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Dossiers.php';
require_once 'Model/Ticket.php';
include_once 'Controller/function.php';
$Login = new Login();
$User = new User();
$Ticket = new Ticket();
$Dossiers = new Dossiers();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){header('Location: login.php');exit();}
/**
 * This page generate HTML Version of the page in the html directory
 * If you are looking for specific content please look at the "content" directory
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_user=$_SESSION['member_id'];

$first_name=$User->getAdmin("first_name",$id_user);
$last_name=$User->getAdmin("last_name",$id_user);
$member_email=$User->getAdmin("email",$id_user);

$tickets = $Ticket->getAllByMonthByUser($id_user);
$tickets_total = $Ticket->getAllByMonth();
$tickets_restant = $Ticket->getAllByMonthByUserToComplete($id_user);

require_once "Vue/home.php";

?>
