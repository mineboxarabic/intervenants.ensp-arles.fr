
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
    <!--dataTable-->
    <link rel="stylesheet" href="vendor/data-table/media/css/dataTables.bootstrap.min.css">
    <!--Select with searching & tagging-->
    <link rel="stylesheet" href="vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="vendor/select2/css/select2-bootstrap.min.css">
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
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="panel-title"><?php echo inter; ?>s</h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-4 col-md-12">
                                    <div class="row animated fadeInRight">
                                    <div class="col-sm-12">
                                        <div class="panel">
                                            <div class="panel-content">
                                                <div class="table-responsive">
                                                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <?php
                                                            foreach (array_keys($users->fetch_assoc()) as $element){
                                                                echo "<th>".$element."</th>";
                                                            }?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            foreach ($users as $row){
                                                                echo "<tr>";
                                                                foreach ($row as $element){
                                                                    echo "<td>".$element."</td>";
                                                                }
                                                                echo "</tr>";
                                                            }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-12">
                                    <!-- FORM -->    
                                    <div class="panel">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form  id="inline-validation" class="form-horizontal form-stripe" method="post" action="intervention-admin.php">
                                                        <div class="form-group">
                                                            <!--DANGER modal-->
                                                            <button type="button" class="btn btn-wide btn-info" data-toggle="modal" data-target="#info-modal" method="post" action="profil.php"><?php echo inter_créer; ?></button>
                                                            <div class="col-sm-offset-3 col-sm-9">
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <form class="form-horizontal form-stripe" method="post" action="profil.php">
                                                                                <div class="modal-header state modal-info">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-warning"></i><?php echo inter_créer; ?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label for="l_name" class="col-sm-3 control-label"><?php echo nom; ?><span class="required">*</span></label>
                                                                                        <div class="col-sm-6">
                                                                                            <input type="text" class="form-control" id="nom" name="l_name" required >
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group">
                                                                                        <label for="f_name" class="col-sm-3 control-label"><?php echo prenom; ?><span class="required">*</span></label>
                                                                                        <div class="col-sm-6">
                                                                                            <input type="text" class="form-control" id="prenom" name="f_name" required>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="c_mail" class="col-sm-3 control-label"><?php echo email; ?><span class="required">*</span></label>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="input-group mb-sm">
                                                                                                <span class="input-group-addon">@</span>
                                                                                                <input type="email" class="form-control" id="c_mail" name="c_mail" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="f_name" class="col-sm-3 control-label"><?php echo remuneration; ?><span class="required">*</span></label>
                                                                                        <div class="col-sm-6">
                                                                                        <select name="remun" class="form-control" style="width: 100%">
                                                                                            <option value="Salaire" label="<?php echo salaire; ?>"></option>
                                                                                            <option value="Facture" label="<?php echo facture; ?>"></option>
                                                                                        </select>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" name="valider" class="btn btn-danger">Ok</button>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN FORM -->
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                        </div>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
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
<!--dataTable-->
<script src="vendor/data-table/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/data-table/media/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function(){
    "use strict";
    //DATATABLE
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $('.data-table').DataTable({});
});
</script>
</body>
</html>
