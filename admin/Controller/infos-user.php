<?php
require_once 'config/inc.connect.php';

require_once 'config/config_general.php';
include_once 'Controller/function.php';
//require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Intervention.php';
require_once 'Model/Dossiers.php';
//$Login = new Login();
$User = new User();
$Intervention = new Intervention();
$Dossiers = new Dossiers();
//$Login->verify();
$User->get("civilité",$_GET['id']);

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){header('Location: login.php');exit();}
if(!isset($_GET['id'])){header('Location: error404.php');exit();}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_user=$_GET['id'];

$toaster="";
if(isset($_POST['valider'])) {
    if(!isset($_POST['year']) || !isset($_POST['title']) || !isset($_POST['remun'])
    || empty($_POST['year']) || empty($_POST['title']) || empty($_POST['remun']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        if(isset($_POST['travel'])) $travel="1";
        else $travel="0";
        $msg=$Dossiers->add($_POST['year'],$_POST['title'],$id_user,$_POST['remun'],$msg);
        if($msg!="Error : Data update Fail!")
        {
            header('Location: dossier.php?id_d='.$msg.'&id_i='.$id_user);
            $msg = "Dossier créé !";
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

$first_name=$User->getFirstName($id_user);
$last_name=$User->getLastName($id_user);
$member_email=$User->getEmail($id_user);
$civ=$User->get("civilité",$id_user);
$ss=$User->get("ss",$id_user);
$siret=$User->get("siret",$id_user);
if($ss==0) {settype($ss,"string");$ss="";}
if($siret==0) {settype($siret,"string");$siret="";}
$born_date=$User->get("born_date",$id_user);
$born_country=$User->get("born_country",$id_user);
$nationality=$User->get("nationality",$id_user);
$tel=$User->get("phone",$id_user);
$adresse=$User->get("address",$id_user);
$ville=$User->get("city",$id_user);
$cp=$User->get("CP",$id_user);
$pays=$User->get("live_country",$id_user);
$interventions=$Intervention->getAllById($id_user);
$dossiers=$Dossiers->getAllById($id_user);
if(empty($first_name)){header('Location: error404.php');exit();}

require_once "Vue/infos-user.php";

echo $toaster;

?>
