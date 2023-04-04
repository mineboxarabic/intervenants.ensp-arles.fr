<?php
require_once '../../Model/Ticket.php';
$Ticket = new Ticket();
var_dump($Ticket->updateState($_GET["id"]));
?>