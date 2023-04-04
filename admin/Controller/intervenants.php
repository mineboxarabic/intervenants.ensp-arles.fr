<?php
require_once 'config/inc.connect.php';


require_once 'config/config_general.php';
include_once 'Controller/function.php';
//require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Intervention.php';
//$Login = new Login;
$User = new User;
$Intervention = new Intervention;
//$Login->verify();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){header('Location: login.php');exit();}

$id_user=$_SESSION['member_id'];

$first_name=$User->getFirstName($id_user);
$last_name=$User->getLastName($id_user);
$member_email=$User->getEmail($id_user);



$toaster = "";

if(isset($_POST['valider'])){
    if(!isset($_POST['l_name']) || !isset($_POST['f_name']) || !isset($_POST['c_mail']) || empty($_POST['l_name']) || empty($_POST['f_name']) || empty($_POST['c_mail']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        $msg=$User->add($_POST['f_name'],$_POST['l_name'],$_POST['c_mail']);
        if(empty($msg))
        {
            $msg = "Intervenant créé !";
            header("Location: infos-user.php?id=".$User->getId($_POST['c_mail']));
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

require_once "Vue/intervenants.php";

echo $toaster;
?>