<?php
require_once '../../Model/Intervention.php';
$Intervention = new Intervention();
echo $Intervention->delete($_GET["id"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>