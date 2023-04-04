<?php
	/// CONTROLLER ADMIN////
require_once 'config/inc.connect.php';

require_once 'config/config_general.php';
include_once 'Controller/function.php';
//require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Dossiers.php';
require_once 'Model/Intervention.php';
require_once 'Model/Files.php';
//$Login = new Login();
$User = new User();
$Dossiers = new Dossiers();
$Intervention = new Intervention();
$Files = new Files();
//$Login->verify();


if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){header('Location: login.php');exit();}
if(!isset($_GET['id_d']) || !preg_match("/^[0-9]*$/", $_GET['id_d'])){header('Location: error404.php');exit();}
if(!isset($_GET['id_i']) || !preg_match("/^[0-9]*$/", $_GET['id_i'])){header('Location: error404.php');exit();}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_dossier=$_GET['id_d'];
$id_intervenant=$_GET['id_i'];

$toaster="";

if(isset($_POST['valider_profil'])){
    if(!$User->hasCompleteProfil($id_intervenant)) {
        $msg = "User haven't complete your profil on the profil page!";
        $Type = "error";
    }
    else if(!isset($_POST['c_mail']) || !isset($_POST['phone']) || !isset($_POST['adresse']) || !isset($_POST['cp']) || !isset($_POST['city']) || !isset($_POST['live_country']) 
    || empty($_POST['c_mail']) || empty($_POST['phone']) ||  empty($_POST['adresse']) || empty($_POST['cp']) || empty($_POST['city']) || empty($_POST['live_country']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        if(isset($_POST['rqth'])) $rqth="1";
        else $rqth="0";
        $msg = $Dossiers->update($id_dossier,$_POST['c_mail'],$_POST['phone'],$_POST['adresse'],$_POST['cp'],$_POST['city'],$_POST['live_country'],$rqth,$msg);
        if(empty($msg))
        {
            $msg = "Data Update !";
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

if(isset($_POST['modif_remun'])) {
		echo 'remun : '.$_POST['remun'].'/state : '.$_POST['state'].'/siren : '.$_POST['siren'].'/';

    if(!$User->hasCompleteProfil($id_intervenant)) {
        $msg = "User haven't complete your profil on the profil page!";
        $Type = "error";
    }
    else if(!isset($_POST['remun']) || empty($_POST['remun']) || ($Dossiers->get("remuneration",$id_dossier)=="Vacation" &&  empty($_POST['state'])) || ($Dossiers->get("statut",$id_dossier)=="Salarie du secteur public" && $_POST['state']=="Salarie du secteur public" && empty($_POST['name_employeur'])) || ($Dossiers->get("remuneration",$id_dossier)=="Facture" && empty($_POST['siren']) ))
    {
        $msg = "Vous avez fourni des données vides ou invalides !";
        $Type = "error";
    } else { 
        $msg = "";
        $Type = "success";
        if($Dossiers->get("statut_social",$id_dossier)=="Salarie du secteur public" && $_POST['state']=="Salarie du secteur public" && isset($_POST['name_employeur']))
            $msg = $Dossiers->updateEmployeur($id_dossier,$_POST['name_employeur'],$msg);
        if($_POST['state']!="Salarie du secteur public" && $Dossiers->get("statut_social",$id_dossier)=="Salarie du secteur public" && $msg == "") {
            $msg = $Dossiers->toSansEmploi($id_dossier,$msg);
        }
        if($Dossiers->get("remuneration",$id_dossier)=="Facture" && $msg == "")
            $msg = $Dossiers->updateSIREN($id_dossier,$_POST['siren'],$msg);
            $msg = $Dossiers->updatenomStructure($id_dossier,$_POST['nomStructure'],$msg);
        /*if($msg == "")
            $msg = $Dossiers->updateState($id_dossier,$_POST['state'],$msg);
            */
        if($msg == "")
            $msg = $Dossiers->updateRemun($_POST['remun'],$id_dossier,$msg);
        if(empty($msg))
        {
            $msg = "Remuneration modifiée !";
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

if(isset($_POST['valid_dossier'])){
    if(!$User->hasCompleteProfil($id_intervenant)) {
        $msg = "User haven't complete your profil on the profil page!";
        $Type = "error";
    }
    else {
        $msg = "";
        $Type = "success";
        $Dossiers->Validate($id_dossier,$User->getAdmin("email",$Dossiers->get("created_user",$id_dossier)),$id_intervenant);
        if(empty($msg))
        {
            $msg = "Data Update !";
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

if(isset($_POST['unvalid_dossier'])){
    if(!$User->hasCompleteProfil($id_intervenant)) {
        $msg = "User haven't complete your profil on the profil page!";
        $Type = "error";
    }
    else {
        $msg = "";
        $Type = "success";
        $Dossiers->Unvalidate($id_dossier,$_POST['message_input']);
        if(empty($msg))
        {
            $msg = "Data Update !";
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

$isProfilComplete=$Dossiers->isProfilComplete($id_dossier);
$isDataComplete=$Dossiers->isDataComplete($id_dossier);
$remuneration=$Dossiers->get("remuneration",$id_dossier);
$intervenant=$User->get("first_name",$Dossiers->get("id_intervenant",$id_dossier))." ".$User->get("last_name",$Dossiers->get("id_intervenant",$id_dossier));
$year=$Dossiers->get("year",$id_dossier);
$title=$Dossiers->get("title",$id_dossier);
$statut_soc=$Dossiers->get("statut_social",$id_dossier);
$nomStructure=$Dossiers->get("nomStructure",$id_dossier);
$name_employeur=$Dossiers->get("employeur",$id_dossier);

$first_name=$User->get("first_name",$id_intervenant);
$last_name=$User->get("last_name",$id_intervenant);
$member_email=$Dossiers->get("member_email",$id_dossier);
if(empty($member_email))
    $member_email=$User->get("member_email",$id_intervenant);
$civ=$User->get("civilite",$id_intervenant);
$born_date=$User->get("born_date",$id_intervenant);
$born_date=implode('/',array_reverse  (explode('-',$born_date)));
$phone=$Dossiers->get("phone",$id_dossier);
if(empty($phone))
    $phone=$User->get("phone",$id_intervenant);
$born_country=$User->get("born_country",$id_intervenant);
$ss=$User->get("ss",$id_intervenant);
$siret=$Dossiers->get("siren",$id_dossier);
if($ss==0) {settype($ss,"string");$ss="";}
//if($siret==0) {settype($siret,"string");$siret="";}
$addr=$Dossiers->get("address",$id_dossier);
if(empty($addr))
    $addr=$User->get("address",$id_intervenant);
$cp=$Dossiers->get("CP",$id_dossier);
if(empty($cp))
    $cp=$User->get("CP",$id_intervenant);
$city=$Dossiers->get("city",$id_dossier);
if(empty($city))
    $city=$User->get("city",$id_intervenant);
$live_country=$Dossiers->get("live_country",$id_dossier);
if(empty($live_country))
    $live_country=$User->get("live_country",$id_intervenant);
$nationality=$User->get("nationality",$id_intervenant);
$rqth=$User->get("rqth",$id_intervenant);
if($isProfilComplete)
    $rqth=$Dossiers->get("rqth",$id_dossier);

$state = $Dossiers->get("statut",$id_dossier);
$siren = $Dossiers->get("siren",$id_dossier);

if($Files->exist("RIB",$id_intervenant,$id_dossier)) {
    $rib_name=$Files->get("real_name",$id_dossier, $id_intervenant, "RIB");
    $rib_name_hash=$Files->get("name",$id_dossier, $id_intervenant, "RIB");
}
if($Files->exist("SS",$id_intervenant,$id_dossier)) {
    $ss_name=$Files->get("real_name",$id_dossier, $id_intervenant, "SS");
    $ss_name_hash=$Files->get("name",$id_dossier, $id_intervenant, "SS");
}
if($Files->exist("CI",$id_intervenant,$id_dossier)) {
    $ci_name=$Files->get("real_name",$id_dossier, $id_intervenant, "CI");
    $ci_name_hash=$Files->get("name",$id_dossier, $id_intervenant, "CI");
}
if($Files->exist("CE",$id_intervenant,$id_dossier)) {
    $ce_name=$Files->get("real_name",$id_dossier, $id_intervenant, "CE");
    $ce_name_hash=$Files->get("name",$id_dossier, $id_intervenant, "CE");
}
if($Files->exist("SE",$id_intervenant,$id_dossier)) {
    $se_name=$Files->get("real_name",$id_dossier, $id_intervenant, "SE");
    $se_name_hash=$Files->get("name",$id_dossier, $id_intervenant, "SE");
}
if($Files->exist("CONTRAT1",$id_intervenant,$id_dossier)) {
    $contrat1_name=$Files->get("real_name",$id_dossier, $id_intervenant, "CONTRAT1");
    $contrat1_name_hash=$Files->get("name",$id_dossier, $id_intervenant, "CONTRAT1");
}
if($Files->exist("CONTRAT2",$id_intervenant,$id_dossier)) {
    $contrat2_name=$Files->get("real_name",$id_dossier, $id_intervenant, "CONTRAT2");
    $contrat2_name_hash=$Files->get("name",$id_dossier, $id_intervenant, "CONTRAT2");
}
$hasCompleteProfil=$User->hasCompleteProfil($id_intervenant);
$interventions=$Intervention->getAllByDossier($id_dossier);
$files=$Files->getAllAdministrativesFiles($id_dossier,$id_intervenant);

require_once "Vue/dossier.php";

echo $toaster;

?>