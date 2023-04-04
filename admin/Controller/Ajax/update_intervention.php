<?php
require_once '../../Model/Intervention.php';
$Intervention = new Intervention();
$Intervention->updateState($_GET["state"],$_GET["id"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>