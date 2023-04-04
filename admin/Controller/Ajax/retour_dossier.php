<?php
require_once '../../Model/Dossiers.php';
$Dossiers = new Dossiers();
echo $Dossiers->retour($_GET["id"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>