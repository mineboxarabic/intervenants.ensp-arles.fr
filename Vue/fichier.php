
<!doctype html>
<html lang="fr" class="fixed">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo title_site; ?></title>
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--pNotify-->
    <link rel="stylesheet" href="vendor/toastr/toastr.min.css">
    <!--Magnific popup-->
    <link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="assets/css/style.css">

     <!--Date picker-->
    <link rel="stylesheet" href="vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css">
    <!--Time picker-->
    <link rel="stylesheet" href="vendor/bootstrap_time-picker/css/timepicker.css">
    <!--Color picker-->
    <link rel="stylesheet" href="vendor/bootstrap_color-picker/css/bootstrap-colorpicker.min.css">
    <!--Select with searching & tagging-->
    <link rel="stylesheet" href="vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="vendor/select2/css/select2-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/costomCss/fichier.css">

    <style>
         .upload_input {
        opacity:0; 
        position: absolute;
        z-index: 1000;
        width:calc(100% - 120px);
        height:100%; 
        left:0; 
        cursor: pointer;
        top:0;
    }
    </style>    
</head>

<body>
<div class="wrap">

    <!-- HEADER -->
          <?php require_once 'Vue/template/inc.header.php'; ?>
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body">
        <!-- LEFT SIDEBAR -->
        <!-- ========================================================= -->
        <div class="left-sidebar">
            <!-- left sidebar HEADER -->
            <div class="left-sidebar-header">
                <div class="left-sidebar-title">Navigation</div>
                <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                    <span></span>
                </div>
            </div>
         <!-- NAVIGATION -->
          <?php require_once 'Vue/template/inc.menu.php'; ?>
          
        </div>
        <!-- CONTENT -->
        <!-- ========================================================= -->
        <div class="content">
            <!-- content HEADER -->
            <!-- ========================================================= -->
            <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php"><?php echo dashboard; ?></a></li>
                    </ul>
                </div>
            </div>
            
            <div class="tab-pane" id="files">
                <h4> Données non complètes </h4>
                <div class="info__how__to__use">
                    ⚠ Les documents se téléversent un par un. <br>
                    1. Cliquer sur "choisir" pour sélectionner votre document. <br>
                    2. Cliquer sur envoyer à droite pour le téléverser. <br>
                </div>


                <div class="input-group">
                    <span class="input-group-btn">
                        <!--<button class="btn btn-default btn-choose" type="button">Choisir</button> -->
                        <input class="btn btn-default btn-choose" type="file" value="Envoyer"/> 
                    </span>
                    <input id="RIB" type="file" accept="image/*,.pdf" name="RIB" class="upload_input" style="display: none;">
                    <input type="text" value="" class="form-control" placeholder="Choose a file...">
                </div>

                


                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-choose" type="button">Choisir</button>
                    </span>
                    <input id="RIB" type="file" accept="image/*,.pdf" name="CI" class="upload_input" style="display: none;">
                    <input type="text" value="" class="form-control" placeholder="Choose a file...">
                </div>


                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-choose" type="button">Choisir</button>
                    </span>
                    <input id="RIB" type="file" accept="image/*,.pdf" name="SS" class="upload_input" style="display: none;">
                    <input type="text" value="" class="form-control" placeholder="Choose a file...">
                </div>


                <div class="input-group">
                    <span class="input-group-btn">
                        <button onclick="download_admin_file('9h5qA9wU1rmpVGj.PNG','Wrong.PNG');" class="download_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">Download</button>
                    </span>
                    <input type="file" accept="image/*,.pdf" name="FILE" class="upload_input" style="display: none;" disabled="">
                    <input type="text" value="Wrong.PNG" class="form-control" disabled=""> <span class="input-group-btn">
                        <button onclick="delete_admin_file('9h5qA9wU1rmpVGj.PNG')" class="delete_FILE btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                    </span>
                </div>

                <div class="input-group">
                    <span class="input-group-btn">
                        <button onclick="download_admin_file('9h5qA9wU1rmpVGj.PNG','Wrong.PNG');" class="download_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">Download</button>
                    </span>
                    <input type="file" accept="image/*,.pdf" name="FILE" class="upload_input" style="display: none;" disabled="">
                    <input type="text" value="Wrong.PNG" class="form-control" disabled=""> <span class="input-group-btn">
                        <button onclick="delete_admin_file('9h5qA9wU1rmpVGj.PNG')" class="delete_FILE btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                    </span>
                </div>

                <div class="input-group">
                    <span class="input-group-btn">
                        <button onclick="download_admin_file('9h5qA9wU1rmpVGj.PNG','Wrong.PNG');" class="download_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">Download</button>
                    </span>
                    <input type="file" accept="image/*,.pdf" name="FILE" class="upload_input" style="display: none;" disabled="">
                    <input type="text" value="Wrong.PNG" class="form-control" disabled=""> <span class="input-group-btn">
                        <button onclick="delete_admin_file('9h5qA9wU1rmpVGj.PNG')" class="delete_FILE btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                    </span>
                </div>


                <button type="button" class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">Valider ces données</button>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="assets/js/template-script.min.js"></script>
<script src="assets/js/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
<!--Max length-->
<script src="vendor/bootstrap_max-lenght/bootstrap-maxlength.js"></script>
<!--Select with searching & tagging-->
<script src="vendor/select2/js/select2.min.js"></script>
<!--Input mask-->
<script src="vendor/input-masked/inputmask.bundle.min.js"></script>
<script src="vendor/input-masked/phone-codes/phone.js"></script>
<!--Date picker-->
<script src="vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js"></script>
<!--Time picker-->
<script src="vendor/bootstrap_time-picker/js/bootstrap-timepicker.js"></script>
<!--Color picker-->
<script src="vendor/bootstrap_color-picker/js/bootstrap-colorpicker.min.js"></script>
<!--Examples-->
<script src="assets/js/examples/forms/advanced.js"></script>

<!--jQuery validation-->
<script src="vendor/jquery-validation/jquery.validate.js"></script>
<!--Examples-->
<script src="assets/js/examples/forms/validation.js"></script>
<!--pNotify-->
<script src="vendor/toastr/toastr.min.js"></script>
<!--CP and city-->
<script src="vendor/vicopo/vicopo.min.js"></script>
<script>
/*
    $(":input").inputmask();
    document.getElementById("code-cp").addEventListener('keypress', (event) => {
        document.getElementById("liste-cp").style.display="block";
        event.stopPropagation();
    });
    */
    
    $("#phone-number").inputmask("09 99 99 99 99",{ "onincomplete": function(){ document.getElementById("phone-message").style.display='block'; document.getElementById("phone-message-valid").style.display='none'}, "oncomplete": function(){ document.getElementById("phone-message").style.display='none'; document.getElementById("phone-message-valid").style.display='block'} });
    (function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('needs-validation');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();
</script>
</body>
</html>
