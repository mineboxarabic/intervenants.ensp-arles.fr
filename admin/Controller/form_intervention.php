<?php
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
if(($Dossiers->get("statut", $_GET['id'])!=0 && $Dossiers->get("statut", $_GET['id'])!=1) || ($_SESSION["acreditation"]!="SM" && $_SESSION["acreditation"]!="RH")){header('Location: error404.php');exit();}
/**
 * This page generate HTML Version of the page in the Vue directory
 */
$id_user=$_SESSION['member_id'];
$id_dossier=$_GET['id'];
$id_intervenant=$Dossiers->get("id_intervenant",$id_dossier);

$first_name=$User->getFirstName($id_user);
$last_name=$User->getLastName($id_user);
$member_email=$User->getEmail($id_user);

$toaster ="";
if(isset($_POST['inter_creer'])) {
    if(!isset($_POST['name']) || !isset($_POST['date_begin']) || !isset($_POST['date_end']) || !isset($_POST['price']) || !isset($_POST['cursus']) || !isset($_POST['hours']) || !isset($_POST['type'])
    || empty($_POST['name']) || empty($_POST['date_begin']) || empty($_POST['date_end']) || empty($_POST['price']) || empty($_POST['cursus']) || empty($_POST['hours']) || empty($_POST['type']) || (isset($_POST['travel']) &&  empty($_POST['travel_text'])))
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
        $msg=$Intervention->add($_POST['name'],$_POST['date_begin'],$_POST['date_end'],$_POST['price']*$_POST['hours'],$travel,$travel_text,$id_dossier,$_POST['cursus'], $_POST['hours'], $_POST['type'], $_POST['referant'], $_POST['previ_date']);
        if(empty($msg))
        {
            header("Location: dossier.php?id_d=$id_dossier&id_i=$id_intervenant");
            $msg = "Intervention créé !";
            exit;
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

$users=$User->getAll();
$referants=$User->getAllReferants();

require_once "Vue/form_intervention.php";

echo $toaster;
?>