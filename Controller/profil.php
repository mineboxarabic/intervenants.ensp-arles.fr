<?php
require_once 'config/config_general.php';
include_once 'Controller/function.php';
require_once 'Model/Login.php';
require_once 'Model/User.php';
$Login = new Login;
$User = new User;

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || $_SESSION['admin']){header('Location: login.php');exit();}
/**
 * This page generate HTML Version of the page in the html directory
 * If you are looking for specific content please look at the "content" directory
 */

$id_user=$_SESSION['member_id'];

$first_name=$User->get("first_name",$id_user);
$last_name=$User->get("last_name",$id_user);
$member_email=$User->get("member_email",$id_user);

// $exe_etu = $bdd -> query ("SELECT * FROM user WHERE id='".$id_user."'");
// $nb_etu = $exe_etu -> rowcount ();
// $rep_etu = $exe_etu -> fetch ();
// extract($rep_etu);

$toaster="";

if(isset($_POST["modify_mdp"])) {
    if(!isset($_POST['last_mdp']) || !isset($_POST['new_mdp']) || !isset($_POST['renew_mdp']) || empty($_POST['last_mdp']) || empty($_POST['new_mdp']) || empty($_POST['renew_mdp']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else if ($_POST['new_mdp']!=$_POST['renew_mdp']) {
        $msg = "The two passwords don't match !";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        $msg = $User->modifyMdp($id_user,hash_pbkdf2("sha256",$_POST['last_mdp'], "salt", 1000, 20),hash_pbkdf2("sha256",$_POST['new_mdp'], "salt", 1000, 20),$_POST['new_mdp']);
        if(empty($msg))
        {
            $msg = "Data Update !";
        }
        else
        {
            $Type = "error";
        }
        $first_name=$User->getFirstName($id_user);
        $last_name=$User->getLastName($id_user);
        $member_email=$User->getEmail($id_user);
        $_SESSION['first_name'] = $first_name;
        $_SESSION['member_username'] = $member_email;
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

if(isset($_POST['valider'])){
    if(!isset($_POST['l_name']) || !isset($_POST['f_name']) || !isset($_POST['c_mail']) || !isset($_POST['civ'])
    || !isset($_POST['bornDate']) || !isset($_POST['phone']) || !isset($_POST['country']) || !isset($_POST['secu']) || !isset($_POST['siret']) 
    || !isset($_POST['adresse']) || !isset($_POST['cp']) || !isset($_POST['city']) || !isset($_POST['live_country']) || !isset($_POST['born_country'])
    || empty($_POST['l_name']) || empty($_POST['f_name']) || empty($_POST['c_mail']) || empty($_POST['civ']) 
    || empty($_POST['bornDate']) || empty($_POST['phone']) || empty($_POST['country']) || empty($_POST['born_country'])
    || empty($_POST['adresse']) || empty($_POST['cp']) || empty($_POST['city']) || empty($_POST['live_country']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    /*
    } else if(empty($_POST['secu']) && empty($_POST['siret'])) {
        $msg = "You have to supplied one data minimum between ss and siret !";
        $Type = "error";
     */
    } else {
        if(isset($_POST['rqth'])) $rqth="1";
        else $rqth="0";
        $msg = "";
        $Type = "success";
        $msg = $User->updateProfil($id_user,$_POST['l_name'],$_POST['f_name'],$_POST['c_mail'],$_POST['civ'],$_POST['bornDate'],$_POST['phone'],$_POST['country'],$_POST['secu'],$_POST['siret'],$_POST['adresse'],$_POST['cp'],$_POST['city'],$_POST['live_country'],$_POST['born_country'],$rqth,$msg);
        if(empty($msg))
        {
            $msg = "Data Update !";
        }
        else
        {
            $Type = "error";
        }
        $first_name=$User->getFirstName($id_user);
        $last_name=$User->getLastName($id_user);
        $member_email=$User->getEmail($id_user);
        $_SESSION['first_name'] = $first_name;
        $_SESSION['member_username'] = $member_email;
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

$id_user=$_SESSION['member_id'];

$first_name=$User->get("first_name",$id_user);
$last_name=$User->get("last_name",$id_user);
$member_email=$User->get("member_email",$id_user);
$civ=$User->get("civilite",$id_user);
$born_date=$User->get("born_date",$id_user);
$phone=$User->get("phone",$id_user);
$born_country=$User->get("born_country",$id_user);
$ss=$User->get("ss",$id_user);
$siret=$User->get("siret",$id_user);
if($ss==0) {settype($ss,"string");$ss="";}
//if($siret==0) {settype($siret,"string");$siret="";}
$addr=$User->get("address",$id_user);
$cp=$User->get("CP",$id_user);
$city=$User->get("city",$id_user);
$live_country=$User->get("live_country",$id_user);
$nationality=$User->get("nationality",$id_user);
$rqth=$User->get("rqth",$id_user);

require_once "Vue/profil.php";

echo $toaster;

?>