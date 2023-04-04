<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../config/config_general.php';
include_once 'Controller/function.php';
require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Intervention.php';
require_once 'Model/Dossiers.php';
$Login = new Login;
$User = new User;
$Intervention = new Intervention;
$Dossiers = new Dossiers;
$Login->verify();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){header('Location: login.php');exit();}
if(!isset($_GET['id'])){header('Location: error404.php');exit();}
if(($Dossiers->get("statut", $Intervention->get("id_dossier",$_GET['id']))!=0 && $Dossiers->get("statut", $Intervention->get("id_dossier",$_GET['id']))!=1) || ($_SESSION["acreditation"]!="SM" && $_SESSION["acreditation"]!="RH")){header('Location: error404.php');exit();}
/**
 * This page generate HTML Version of the page in the Vue directory
 */
$id_user=$_SESSION['member_id'];
$id=$_GET['id'];
$id_dossier=$Intervention->get("id_dossier",$id);
$id_intervenant=$Dossiers->get("id_intervenant",$id_dossier);

$first_name=$User->getFirstName($id_user);
$last_name=$User->getLastName($id_user);
$member_email=$User->getEmail($id_user);

$toaster ="";
if(isset($_POST['inter_edit'])) {
    if(!isset($_POST['name']) || !isset($_POST['date_begin']) || !isset($_POST['date_end']) || !isset($_POST['price']) || !isset($_POST['cursus']) || !isset($_POST['hours']) || !isset($_POST['type'])
    || empty($_POST['name']) || empty($_POST['date_begin']) || empty($_POST['date_end']) || empty($_POST['price']) || empty($_POST['cursus']) || empty($_POST['hours']) || empty($_POST['type']) || empty($_POST['state']) || (isset($_POST['travel']) &&  empty($_POST['travel_text'])))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        if(isset($_POST['travel'])) $travel="1";
        else $travel="0";
        $travel_text=$_POST['travel_text'];
        if($travel=="0")
            $travel_text="";
        $msg=$Intervention->update($_POST['name'],$_POST['date_begin'],$_POST['date_end'],$_POST['price']*$_POST['hours'],$travel,$travel_text,$id_dossier,$_POST['cursus'], $_POST['hours'], $_POST['type'], $_POST['state'], $_POST['previ_date'], $id);
        if(empty($msg))
        {
            $msg = "Intervention modifiée !";
        }
        else
        {
            $Type = "error";
        }
    }
    
    $toaster = '<script>
    window.onload = function() {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "rtl": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": 100,
        "hideDuration": 100,
        "timeOut": 2500,
        "extendedTimeOut": 1500,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
          var $toast = toastr["'.$Type.'"]("'.$msg.'"); // Wire up an event handler to a button in the toast, if it exists
          $toastlast = $toast;

          if ($toast.find(".clear").length) {
              $toast.delegate(".clear", "click", function () {
                  toastr.clear($toast, { force: true });
              });
          }
    }
    </script>';
}

$referants=$User->getAllReferants();

$referant=$Intervention->get("id_referant",$id);
$cursus=$Intervention->get("cursus",$id);
$type=$Intervention->get("type",$id);
$title=$Intervention->get("title",$id);
$date_begin=$Intervention->get("date_begin",$id);
$date_begin=implode('/',array_reverse  (explode('-',$date_begin)));
$date_end=$Intervention->get("date_end",$id);
$date_end=implode('/',array_reverse  (explode('-',$date_end)));
$price=$Intervention->get("price",$id);
$travel=$Intervention->get("travel",$id);
$travel_text=$Intervention->get("travel_text",$id);
$hours=$Intervention->get("hours",$id);
$state=$Intervention->get("statut",$id);
$previ_date=$Intervention->get("date_previsionnelle_de_payement",$id);
$previ_date=implode('/',array_reverse  (explode('-',$previ_date)));
$price_hour=$price/$hours;


require_once "Vue/intervention.php";

echo $toaster;

?>