
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
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row animated fadeInUp">
              
               <!--INFORMATIONS-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
	                            <div class="col-md-12">
                                    <h4>
                                        <?php echo bienvenue; ?>
                                            &nbsp;<?php echo ucfirst($first_name)." ".ucfirst($last_name);  ?>&nbsp;
                                        <?php echo titre_bienvenue; ?>
                                    </h4>
                                    <hr>
                                    <!--
                                    <div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">×</a>
                                        Bonjour, <br>
                                        Nous vous invitons à échanger ensemble en ligne ce<strong> mercredi 17 février à 18h </strong>autour du master, du concours d’entrée et des activités de l'école, avec Marta Gili, directrice de l’ENSP, Delphine Paul, directrice des études et de la recherche, et les étudiants de l’ENSP.
                                        <br><br>
                                        <a href="https://www.ensp-arles.fr/evenements/jpo-2021-en-ligne/" target="_blank">https://www.ensp-arles.fr/evenements/jpo-2021-en-ligne/</a>
                                    </div>
                                    -->
	                          </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                    <div class="col-sm-5 col-md-4 col-lg-4">
                        <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                            <a href="profil.php">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <span class="icon fa fa-user color-darker-2"></span>
                                        </div>
                                        <div class="col-xs-8">
                                            <h4 class="subtitle color-darker-2"><?php echo state ?> : Intervenant</h4>
                                            <h1 class="title color-w"><?php echo ucfirst($first_name)." ".ucfirst($last_name);  ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    if($User->hasCompleteProfil($id_user)) {
                        ?>
                        <div class="col-sm-5 col-md-4 col-lg-4">
                            <div class="panel widgetbox wbox-2 bg-success color-w">
                                <a href="profil.php">
                                    <div class="panel-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <span class="icon fa fa-bell color-w"></span>
                                            </div>
                                            <div class="col-xs-8">
                                                <h1 class="title"><?php echo you_have_to_update_profil ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="col-sm-5 col-md-4 col-lg-4">
                            <div class="panel widgetbox wbox-2 bg-danger color-w">
                                <a href="profil.php">
                                    <div class="panel-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <span class="icon fa fa-warning color-w"></span>
                                            </div>
                                            <div class="col-xs-8">
                                                <h1 class="title"><?php echo you_have_not_to_update_profil ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-sm-5 col-md-4 col-lg-4">
                        <div class="panel widgetbox wbox-1 bg-darker-2 color-light">
                            <a href="dossiers.php">
                                <div class="panel-content">
                                    <h1 class="title color-light-1"> <i class="fa fa-envelope"></i>
                                        <?php 
                                        if($Dossier->haveToComplete($id_user)>1)
                                            echo $Dossier->haveToComplete($id_user)."</h1><h4 class='subtitle'>".dossiers_to_complete."</h4>";
                                        else if($Dossier->haveToComplete($id_user)==1)
                                            echo $Dossier->haveToComplete($id_user)."</h1><h4 class='subtitle'>".dossier_to_complete."</h4>";
                                        else if($Dossier->haveToComplete($id_user)==0)
                                            echo no_dossier."</h1>";
                                        ?>
                                </div>
                            </a>
                        </div>
                    </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
               <!--LEGALES-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
	                            <div class="col-md-12" style="font-size: 10px;">
                                    Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée relative à l'informatique, 
                                    aux fichiers et aux libertés, les données à caractère personnel que vous transmettez seront utilisées 
                                    exclusivement pour le traitement et la gestion de votre candidature par les services de l'École nationale 
                                    supérieure de la photographie.Elles ne seront en aucun cas communiquées à un tiers. Le traitement des données 
                                    a fait l'objet d'une inscription au registre du correspondant informatique et libertés de l'université. 
                                    Vous avez un droit d'accès, de rectification et de suppression pour motif légitime quant aux données personnelles 
                                    vous concernant. Vous pouvez exercer ce droit en contactant la sous direction Gestion de la formation et des 
                                    Etudes à cette adresse : support@ensp-arles.fr
	                          </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
               
                  
                </div>
                
                
                
                <!--TIMELINE left-->
                
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>

        <!--scroll to top-->
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
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