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
        case "intervenants.php":
            require_once "Controller/intervenants.php";
            break;
        case "dossiers.php":
            require_once "Controller/dossiers.php";
            break;
        case "infos-user.php":
            require_once "Controller/infos-user.php";
            break;
        case "dossier.php":
            require_once "Controller/dossier.php";
            break;
        case "form_intervention.php":
            require_once "Controller/form_intervention.php";
            break;
        case "intervention.php":
            require_once "Controller/intervention.php";
            break;
        case "interventions.php":
            require_once "Controller/interventions.php";
            break;
        case "profil.php":
            require_once "Controller/profil.php";
            break;
        case "ticket.php":
            require_once "Controller/ticket.php";
            break;
        default:
            require_once "Controller/error404.php";
            break;
    }
  }
