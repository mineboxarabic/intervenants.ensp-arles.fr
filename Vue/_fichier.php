<!DOCTYPE html>
<html>

<head>
    <title>Fichier</title>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>
        <?php echo title_site; ?>
    </title>
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
</head>

<body>

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
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="dossiers.php">Fichier</a></li>
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
                        <button class="btn btn-default btn-choose" type="button">Choisir</button>
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
        <!--pNotify-->
        <script src="vendor/toastr/toastr.min.js"></script>
        <!--morris chart-->
        <script src="vendor/chart-js/chart.min.js"></script>
        <!--Gallery with Magnific popup-->
        <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!--Examples-->
        <script src="assets/js/examples/dashboard.js"></script>
</body>

</html>