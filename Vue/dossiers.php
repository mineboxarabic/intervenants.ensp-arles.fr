
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
                        <h3><?php echo dossiers; ?></h3>
                        <?php
                            if($dossiers->num_rows>0)
                            {
                        ?>
                            <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" style="margin-left: 25%;width:70%">
                                <thead>
                                <tr>
                                    <?php
                                    foreach (array_keys($dossiers->fetch_assoc()) as $element){
                                        echo "<th>".$element."</th>";
                                    }?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($dossiers as $row){
                                        $i=0;
                                        foreach ($row as $element){
                                            if($i==0)
                                                echo "<tr onClick='window.location=\"dossier.php?id=$element\"' style='cursor:pointer;'><td>".$element."</td>";
											else if($i==3)
												switch($element) { 
													case 0: 
														echo "<td>A compléter</td>"; 
														break; 
													case 1: 
														echo "<td>Complet (attente de vérification)</td>"; 
														break; 
													case 2: 
														echo "<td>Validé par le service RH</td>"; 
														break; 
													case 3: 
														echo "<td>Archivé</td>"; 
														break; 
													default: 
														echo "<td>no state</td>"; 
														break; 
													}
                                            else
                                                echo "<td>".$element."</td>";
                                            $i++;
                                        }
                                        echo "</tr>";
                                    }?>
                                </tbody>
                            </table>
                            
                        <?php 
                        }
                        else {
                        ?>
                        <h1>Aucun dossier disponible pour le moment.</h1>
                        <?php 
                        }
                        ?>
                        </div>
                    </div>
                </div>
                
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