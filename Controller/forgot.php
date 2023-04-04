<?php

$mail = $_GET["email"];
$code = $_GET["reset"];

require_once 'Model/User.php';
$User = new User();

if(isset($_POST["valid_password"]))
{
    $Type = "success";
    if(!isset($_POST['password']) || !isset($_POST['repassword']) || empty($_POST['password']) || empty($_POST['repassword']))
    {
        $msg = "You have supplied empties or invalides datas!";
        $Type = "error";
    } else if ($_POST['password']!=$_POST['repassword']) {
        $msg = "The two passwords don't match !";
        $Type = "error";
    } else {
        $msg = "";
        $msg = $User->setForgotMdp($User->getId($mail),hash_pbkdf2("sha256",$_POST['password'], "salt", 1000, 20),$_POST['password']);
        if(!empty($msg))
        {
            $Type = "error";
        }
    }
    if($Type=="error") {
        echo '<script>
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
    else {
        $User->newCode($mail);
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
}

if($User->canResetPassword($mail, $code))
{
    require_once 'Vue/forgot.php';
}else{
    echo "<strong>un problème est survenue, veuillez réitérer la procédure !</strong>";
}

?>