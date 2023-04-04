<?php
// CONTROLLER FRONT //
require_once 'config/config_general.php';
include_once 'Controller/function.php';
require_once 'Model/Login.php';
require_once 'Model/User.php';
require_once 'Model/Intervention.php';
require_once 'Model/Dossier.php';
require_once 'Model/Files.php';
$Login = new Login();
$User = new User();
$Intervention = new Intervention();
$Dossier = new Dossier();
$Files = new Files();

if(isset($_GET['logout'])){$Login->logUserOut();}
if(!isset($_SESSION['admin']) || $_SESSION['admin']){header('Location: login.php');exit();}
if(!isset($_GET['id'])){header('Location: error404.php');exit();}
/**
 * This page generate HTML Version of the page in the html directory
 * If you are looking for specific content please look at the "content" directory
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_dossier=$_GET['id'];
$id_user=$_SESSION['member_id'];
$toaster="";
if(isset($_POST['valider'])){
    if(!$User->hasCompleteProfil($id_user)) {
        $msg = "Vous n'avez pas fini completer votre profil !";
        $Type = "error";
    }
    else if(!isset($_POST['c_mail']) || !isset($_POST['phone']) || !isset($_POST['adresse']) || !isset($_POST['cp']) || !isset($_POST['city']) || !isset($_POST['live_country']) 
    || empty($_POST['c_mail']) || empty($_POST['phone']) ||  empty($_POST['adresse']) || empty($_POST['cp']) || empty($_POST['city']) || empty($_POST['live_country']))
    {
        $msg = "Vous avez fourni des données vides ou invalides !";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        if(isset($_POST['rqth'])) $rqth="1";
        else $rqth="0";
        $msg = $Dossier->update($id_dossier,$_POST['c_mail'],$_POST['phone'],$_POST['adresse'],$_POST['cp'],$_POST['city'],$_POST['live_country'],$rqth,$msg);
        if(empty($msg))
        {
            $msg = "Données mises à jour!";
        }
        else
        {
            $Type = "erreur";
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


if(isset($_POST['valid_data'])){
    if(!$User->hasCompleteProfil($id_user)) {
        $msg = "Vous n'avez pas fini de completer votre profil";
        $Type = "error";
    }
    else if(($Dossier->get("remuneration",$id_dossier)=="Vacation" &&  empty($_POST['state'])) || ($Dossier->get("statut",$id_dossier)=="Salarie du secteur public" && $_POST['state']=="Salarie du secteur public" && empty($_POST['name_employeur'])) || ($Dossier->get("remuneration",$id_dossier)=="Facture" && empty($_POST['siren']) ))
    {
        $msg = "Vous avez fourni des données vides ou invalides ..!";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        if($Dossier->get("statut_social",$id_dossier)=="Salarie du secteur public" && $_POST['state']=="Salarie du secteur public" && isset($_POST['name_employeur']))
            $msg = $Dossier->updateEmployeur($id_dossier,$_POST['name_employeur'],$msg);

        if($_POST['state']!="Salarie du secteur public" && $Dossier->get("statut_social",$id_dossier)=="Salarie du secteur public") {
            $msg = $Dossier->toSansEmploi($id_dossier,$msg);
        }
        
        if($Dossier->get("remuneration",$id_dossier)=="Facture")
            $msg = $Dossier->updateSIREN($id_dossier,$_POST['siren'],$msg);
             $msg = $Dossier->updatenomStructure($id_dossier,$_POST['nomStructure'],$msg);
        $msg = $Dossier->updateState($id_dossier,$_POST['state'],$msg);
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

if(isset($_POST['valid_dossier'])){
    if(!$User->hasCompleteProfil($id_user)) {
        $msg = "Vous n'avez pas fini de completer votre profil";
        $Type = "error";
    } else {
        $msg = "";
        $Type = "success";
        $Dossier->setComplete($id_dossier,$id_user);
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


$isProfilComplete=$Dossier->isProfilComplete($id_dossier);
$intervenant=$User->get("first_name",$Dossier->get("id_intervenant",$id_dossier))." ".$User->get("last_name",$Dossier->get("id_intervenant",$id_dossier));
$year=$Dossier->get("year",$id_dossier);
$isDataComplete=$Dossier->isDataComplete($id_dossier);
$remuneration=$Dossier->get("remuneration",$id_dossier);
$siren=$Dossier->get("siren",$id_dossier);
$statut_soc=$Dossier->get("statut_social",$id_dossier);
$name_employeur=$Dossier->get("employeur",$id_dossier);
$nomStructure=$Dossier->get("nomStructure",$id_dossier);


$first_name=$User->get("first_name",$id_user);
$last_name=$User->get("last_name",$id_user);
$member_email=$Dossier->get("member_email",$id_dossier);
if(empty($member_email))
    $member_email=$User->get("member_email",$id_user);
$civ=$User->get("civilite",$id_user);
$born_date=$User->get("born_date",$id_user);
$born_date=implode('/',array_reverse  (explode('-',$born_date)));
$phone=$Dossier->get("phone",$id_dossier);
if(empty($phone))
    $phone=$User->get("phone",$id_user);
$born_country=$User->get("born_country",$id_user);
$ss=$User->get("ss",$id_user);
$siret=$User->get("siret",$id_user);
if($ss==0) {settype($ss,"string");$ss="";}
if($siret==0) {settype($siret,"string");$siret="";}
$addr=$Dossier->get("address",$id_dossier);
if(empty($addr))
    $addr=$User->get("address",$id_user);
$cp=$Dossier->get("CP",$id_dossier);
if(empty($cp))
    $cp=$User->get("CP",$id_user);
$city=$Dossier->get("city",$id_dossier);
if(empty($city))
    $city=$User->get("city",$id_user);
$live_country=$Dossier->get("live_country",$id_dossier);
if(empty($live_country))
    $live_country=$User->get("live_country",$id_user);
$nationality=$User->get("nationality",$id_user);
$rqth=$User->get("rqth",$id_user);
$created_user=$Dossier->get("created_user",$id_dossier);
if($isProfilComplete)
    $rqth=$Dossier->get("rqth",$id_dossier);


$state = $Dossier->get("statut",$id_dossier);

$button_valid=false;
if($Files->exist("RIB",$id_user,$id_dossier) && $Files->exist("SS",$id_user,$id_dossier) && $Files->exist("CI",$id_user,$id_dossier) && $isProfilComplete && $isDataComplete && $state==0 && (($Files->exist("CE",$id_user,$id_dossier) && $statut_soc=="Salarie du secteur public") || $statut_soc!="Salarie du secteur public") && (($Files->exist("SE",$id_user,$id_dossier) && $statut_soc=="Sans emploi") || $statut_soc!="Sans emploi")) {
    $button_valid=true;
}

if($Files->exist("RIB",$id_user,$id_dossier)) {
    $rib_name=$Files->get("real_name",$id_dossier, $id_user, "RIB");
}
if($Files->exist("SS",$id_user,$id_dossier)) {
    $ss_name=$Files->get("real_name",$id_dossier, $id_user, "SS");
}
if($Files->exist("CI",$id_user,$id_dossier)) {
    $ci_name=$Files->get("real_name",$id_dossier, $id_user, "CI");
}
if($Files->exist("CE",$id_user,$id_dossier)) {
    $ce_name=$Files->get("real_name",$id_dossier, $id_user, "CE");
}
if($Files->exist("SE",$id_user,$id_dossier)) {
    $se_name=$Files->get("real_name",$id_dossier, $id_user, "SE");
}
if($Files->exist("CONTRAT1",$id_user,$id_dossier)) {
    $contrat1_name=$Files->get("real_name",$id_dossier, $id_user, "CONTRAT1");
    $contrat1_name_hash=$Files->get("name",$id_dossier, $id_user, "CONTRAT1");

}
if($Files->exist("CONTRAT2",$id_user,$id_dossier)) {
    $contrat2_name=$Files->get("real_name",$id_dossier, $id_user, "CONTRAT2");
    $contrat2_name_hash=$Files->get("name",$id_dossier, $id_user, "CONTRAT2");

}
$hasCompleteProfil=$User->hasCompleteProfil($id_user);
$interventions=$Intervention->getAll($id_dossier);
$files=$Files->getAllAdministrativesFiles($id_dossier,$id_user);

$created_mail = $Dossier->getmail($created_user);


require_once "Vue/dossier.php";

echo $toaster;

?>
