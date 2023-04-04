<?php
require_once 'config/config_general.php';
include_once 'Controller/function.php';
require_once 'Model/Faq.php';
require_once 'Model/Login.php';
require_once 'Model/Dossier.php';
$Ticket = new Ticket();
$Login = new Login();
$Dossier = new Dossier();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || $_SESSION['admin']){header('Location: login.php');exit();}
$id_user=$_SESSION['member_id'];
/**
 * This page generate HTML Version of the page in the html directory
 * If you are looking for specific content please look at the "content" directory
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$toaster="";
if(isset($_POST['valid_data'])){
    if(!isset($_POST['message']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        $msg = $Ticket->new($_POST['message'],$_POST['dossier'],$id_user);
        if(empty($msg))
        {
            $msg = "Ticket envoyé !";
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

$dossiers=$Dossier->getAll($id_user);
$tickets=$Ticket->getAll($id_user);

require_once "Vue/faq.php";

echo $toaster;

?>
