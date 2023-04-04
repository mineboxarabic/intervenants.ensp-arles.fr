<?php
require_once 'config/inc.connect.php';


require_once 'config/config_general.php';
include_once 'Controller/function.php';
//require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Intervention.php';
require_once 'Model/Dossiers.php';
require_once 'Model/Files.php';

//$Login = new Login;
$User = new User;
$Intervention = new Intervention;
$Dossiers = new Dossiers;
$Files = new Files();
//$Login->verify();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){header('Location: login.php');exit();}

$id_user=$_SESSION['member_id'];

$first_name=$User->getFirstName($id_user);
$last_name=$User->getLastName($id_user);
$member_email=$User->getEmail($id_user);

$dateInter=$Dossiers->getDateById($id_dossier);


$dossiers = $Dossiers->getAll();
$users=$User->getAll();

$toaster = "";

if(isset($_POST['valider'])) {
    if(!isset($_POST['year']) || !isset($_POST['title']) || !isset($_POST['intervenant']) || !isset($_POST['remun'])
    || empty($_POST['year']) || empty($_POST['title']) || empty($_POST['intervenant']) || empty($_POST['remun']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        if(isset($_POST['travel'])) $travel="1";
        else $travel="0";
        $msg=$Dossiers->add($_POST['year'],$_POST['title'],$_POST['intervenant'],$_POST['remun'],$msg);
        if($msg!="Error : Data update Fail!")
        {
            header('Location: dossier.php?id_d='.$msg.'&id_i='.$_POST['intervenant']);
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
$dossiers = $Dossiers->getAll();

require_once "Vue/dossiers.php";

echo $toaster;
?>