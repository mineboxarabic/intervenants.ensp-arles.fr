<?php

//start session
require_once('Model/Files.php');
require_once('function.php');

$id_user = $_SESSION['member_id'];

//Create a Files object

$files = new Files();
require_once('Vue/fichier.php');

