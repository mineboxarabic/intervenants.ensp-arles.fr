
<!doctype html>
<html lang="fr" class="fixed">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo title_site; ?></title>
    <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/../favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../vendor/animate.css/animate.css">
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
    <!--dataTable-->
    <link rel="stylesheet" href="../vendor/data-table/media/css/dataTables.bootstrap.min.css">
    <!--Select with searching & tagging-->
    <link rel="stylesheet" href="../vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="../vendor/select2/css/select2-bootstrap.min.css">
    <!--seewtaler-->
    <link rel="stylesheet" href="../vendor/sweetalert/sweetalert.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
        $('.data-table').DataTable({"order":[[3,"desc"]]});
        function updateState(id) {
            $.post('/admin/Controller/Ajax/updateStateTicket.php?id='+id,
            {
                id: id
            }).done(function( data ) {
                    swal("Ticket n°"+id, "Ticket mis à jour !", "success");
                    window.location.reload();
                    return true;
                });
        }
    </script>
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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="dossiers.php">Ticket</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row">
                <form id="inline-validation" class="form-horizontal" method="post" action="ticket.php">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                        if($tickets->num_rows>0)
                                        {
                                    ?>
                                    <h3>Tickets</h3>
                                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <?php
                                            $i=0;
                                            foreach (array_keys($tickets->fetch_assoc()) as $element){
                                                if($i==2)
                                                    echo "<td>Dossier</td>";
                                                else if($i!=3)
                                                    echo "<td>".$element."</td>";
                                                $i++;
                                            }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach ($tickets as $row){
                                                $i=0;
                                                echo "<tr>";
                                                foreach ($row as $element){
                                                    if($i==0)
                                                        $id=$element;
                                                    if($i==2)
                                                    {
                                                        $id_inter=$Dossier->get('id_intervenant',$element);
                                                        echo "<td><a href='dossier.php?id_d=$element&id_i=".$Dossier->get('id_intervenant',$element)."' >".$id_inter."</a></td>";
                                                    }
                                                    else if($i==5)
                                                        echo "<td>".($element==1?"Fermé":"Ouvert <a class='btn btn-o btn-success' style='margin-left: 10px; padding:0 8px 0 5px;'><i class='fa fa-check' aria-hidden='true' style='height: 10px; width: 10px; margin:0' onClick='updateState($id);'></i></a>")." <a class='btn btn-o btn-info' style='margin-left: 10px; padding:0 8px 0 5px;'  href=\"mailto:".$User->get("member_email",$id_inter)."\"><i class='fa fa-envelope' aria-hidden='true' style='height: 10px; width: 10px; margin:0'></i></a></td>";
                                                    else if($i!=3)
                                                        echo "<td>".$element."</td>";
                                                    $i++;
                                                }
                                                echo "</tr>";
                                            }?>
                                        </tbody>
                                    </table>
                                    <?php
                                        } else {
                                    ?>
                                    <h3>Aucuns tickets</h3>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
<!--dataTable-->
<script src="../vendor/data-table/media/js/jquery.dataTables.min.js"></script>
<script src="../vendor/data-table/media/js/dataTables.bootstrap.min.js"></script>
<!--CP and city-->
<script src="../vendor/vicopo/vicopo.min.js"></script>
<!--seewtaler-->
<script src="../vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.data-table').DataTable({"order":[[3,"desc"]]});
</script>
</body>
</html>
