
<!doctype html>
<html lang="fr" class="fixed">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo title_site; ?></title>
    <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../vendor/animate.css/animate.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--pNotify-->
    <link rel="stylesheet" href="../vendor/toastr/toastr.min.css">
    <!--Magnific popup-->
    <link rel="stylesheet" href="../vendor/magnific-popup/magnific-popup.css">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/css/style.css">
    
     <!--Date picker-->
    <link rel="stylesheet" href="../vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css">
    <!--Time picker-->
    <link rel="stylesheet" href="../vendor/bootstrap_time-picker/css/timepicker.css">
    <!--Color picker-->
    <link rel="stylesheet" href="../vendor/bootstrap_color-picker/css/bootstrap-colorpicker.min.css">
    <!--seewtaler-->
    <link rel="stylesheet" href="../vendor/sweetalert/sweetalert.css">
    <!--Select with searching & tagging-->
    <link rel="stylesheet" href="../vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="../vendor/select2/css/select2-bootstrap.min.css">
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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="intervenants.php">interventions</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row animated fadeInUp">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="panel-title"><?php echo interventions; ?></h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-4 col-md-12">
                                    <div class="row animated fadeInRight">
                                    <div class="col-sm-12">
                                        <div class="panel">
                                            <div class="panel-content">
                                                <div class="table-responsive">
                                                <?php
                                                    if($interventions->num_rows>0)
                                                    {
                                                ?>
                                                <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <?php
                                                        foreach (array_keys($interventions->fetch_assoc()) as $element){
                                                            echo "<th>".$element."</th>";
                                                        }
                                                        echo "<th>Modifications</th>";
                                                        ?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        foreach ($interventions as $row){
                                                            echo "<tr>";
                                                            $i=0;
                                                            foreach ($row as $element){
                                                                if($i==0)
                                                                    $id_intervenant=$element;
                                                                if($i==1) {
                                                                    $state = $Dossiers->get("statut",$element);
                                                                    echo "<td><a href='dossier.php?id_d=$element&id_i=$id_intervenant'>".$Dossiers->get("title",$element)."</a></td>";
                                                                }
                                                                else
                                                                    echo "<td>".$element."</td>";
                                                                $i++;
                                                            }
                                                            if(($state==0 || $state==1) && ($_SESSION["acreditation"]=="SM" || $_SESSION["acreditation"]=="RH"))
                                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='intervention(".$row["id"].");' style='margin-right: 5px; '><i class='fa fa-edit'></i></button><button onClick='delete_intervention(".$row["id"].");' class='btn btn-o btn-danger btn-xs'><i class='fa fa-trash'></i></button></td>";
                                                            else if($statut_interv=="Programmée" && $_SESSION["acreditation"]=="SM")
                                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='update_sfc(".$row["id"].");' style='margin-right: 5px; '>Service fait constaté</button><button onClick='update_a(".$row["id"].");' class='btn btn-o btn-danger btn-xs'>Annulée</button></td>";
                                                            else if($statut_interv=="Service fait constaté" && $_SESSION["acreditation"]=="RH")
                                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='update_sfv(".$row["id"].");' style='margin-right: 5px; '>Service fait validé</button></td>";
                                                            else if($statut_interv=="Service fait validé" && $_SESSION["acreditation"]=="RH")
                                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='update_p(".$row["id"].");' style='margin-right: 5px; '>Payée</button></td>";
                                                            else
                                                                echo "<td><button class='btn btn-o btn-success btn-xs' style='margin-right: 5px; ' disabled><i class='fa fa-edit'></i></button><button class='btn btn-o btn-danger btn-xs' disabled><i class='fa fa-trash'></i></button></td>";
                                                            echo "</tr>";
                                                        }?>
                                                    </tbody>
                                                </table>
                                                <?php 
                                                }
                                                else {
                                                ?>
                                                <h1><?php echo no_inter; ?></h1>
                                                <?php 
                                                }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<script src="../vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/js/template-script.min.js"></script>
<script src="../assets/js/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
<!--Max length-->
<script src="../vendor/bootstrap_max-lenght/bootstrap-maxlength.js"></script>
<!--Select with searching & tagging-->
<script src="../vendor/select2/js/select2.min.js"></script>
<!--Input mask-->
<script src="../vendor/input-masked/inputmask.bundle.min.js"></script>
<script src="../vendor/input-masked/phone-codes/phone.js"></script>
<!--Date picker-->
<script src="../vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js"></script>
<!--Time picker-->
<script src="../vendor/bootstrap_time-picker/js/bootstrap-timepicker.js"></script>
<!--Color picker-->
<script src="../vendor/bootstrap_color-picker/js/bootstrap-colorpicker.min.js"></script>
<!--Examples-->
<script src="../assets/js/examples/forms/advanced.js"></script>

<!--jQuery validation-->
<script src="../vendor/jquery-validation/jquery.validate.js"></script>
<!--Examples-->
<script src="../assets/js/examples/forms/validation.js"></script>
<!--pNotify-->
<script src="../vendor/toastr/toastr.min.js"></script>
<!--seewtaler-->
<script src="../vendor/sweetalert/sweetalert.min.js"></script>
<!--dataTable-->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
<script>
$('.data-table').DataTable({
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print','pageLength',
        {
            collectionTitle: 'Visibility control',
            extend: 'colvis',
            collectionLayout: 'two-column'
        }
    ]
});

        function delete_intervention($id) {
            swal({
                title: "<?php echo swal1; ?>",
                text: "<?php echo swal2; ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo swal3; ?>",
                closeOnConfirm: false
            },
            function(){
                swal("<?php echo swal4; ?>", "<?php echo swal5; ?>", "success");
                window.location = "Controller/Ajax/delete_intervention.php?id="+$id;
            });
        }
        
        function intervention($id) {
            window.location.href = "intervention.php?id="+$id;
        }

        function update_sfc($id) {
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Service fait constaté") ?>&id="+$id;
        }

        function update_sfv($id) {
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Service fait validé") ?>&id="+$id;
        }

        function update_a($id) {
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Annulée") ?>&id="+$id;
        }

        function update_p($id) {
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Payée") ?>&id="+$id;
        }

</script>
</body>
</html>
