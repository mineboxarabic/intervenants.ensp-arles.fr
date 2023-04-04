<?php

  $url='';
  
  if(isset($_GET['page'])) {
      $url=explode('/',$_GET['page']);
  }

  if(empty($url))
  {
        require_once "Controller/index.php";
  }

  else {
    switch($url[0]) {
        case "":
            require_once "Controller/index.php";
            break;
        case "index.php":
            require_once "Controller/index.php";
            break;
        case "login.php":
            require_once "Controller/login.php";
        	break;
        case "profil.php":
            require_once "Controller/profil.php";
            break;
        case "forgot.php":
            require_once "Controller/forgot.php";
            break;
        case "dossiers.php":
            require_once "Controller/dossiers.php";
            break;
        case "dossier.php":
            require_once "Controller/dossier.php";
            break;
        case "ticket.php":
            require_once "Controller/ticket.php";
            break;
        case "fichier.php":
            require_once "Controller/fichier.php";
            break;
        case "faq.php":
            require_once "Controller/faq.php";
            break;
        default:
            require_once "Controller/error404.php";
            break;
    }
  }  
?>