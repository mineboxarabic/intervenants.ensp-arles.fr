
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="dossiers.php"><?php echo dossiers; ?></a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row animated fadeInUp">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="panel-title"><?php echo dossiers; ?></h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-4 col-md-12">
                                    <div class="row animated fadeInRight">
                                        <div class="col-sm-12">
                                            <div class="panel">
                                                <div class="panel-content">
                                                    <button type="button" class="btn btn-wide btn-info" data-toggle="modal" data-target="#info-modal" method="post" action="profil.php"><?php echo create_folder; ?></button>
                                                    <div class="table-responsive">
                                                        <table id="basic-table" class="data-table table table-striped  table-hover" cellspacing="0" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <?php
                                                                $i=0;
                                                                $key_intervenant="";
                                                                foreach (array_keys($dossiers->fetch_assoc()) as $element){
                                                                    if($i==2)
                                                                        $key_intervenant=$element;
                                                                    else
                                                                        echo "<th>".$element."</th>";
                                                                    $i++;
                                                                }?>
                                                                <th><?php echo suppr; ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                foreach ($dossiers as $row){
                                                                    echo "<tr>";
                                                                    $i=0;
                                                                    $key=0;
                                                                    $element2=$row[$key_intervenant];
                                                                    foreach ($row as $element){
                                                                        if($i==0) {
	                                                                        $id_folder_to_delete=$element;
                                                                            echo "<td> <a href='dossier.php?id_d=$element&id_i=$element2'>".$element."</a></td>";
                                                                        }
                                                                        else if($i==1) {
                                                                            echo "<td> <a href='dossier.php?id_d=$id_folder_to_delete&id_i=$element2'>".$element."</a></td>";
                                                                        }
                                                                        else if($i==2)
                                                                            $key=$element;
                                                                        else if($i==3)
                                                                            echo "<td> <a href='infos-user.php?id=$key'>".$element."</a></td>";
                                                                        else if($i==15) {
	                                                                        	
	                                                                        	                                                                        
                                                                            echo "<td>";
                                                                           		//echo $element.'-';
                                                                           
	                                                                        	if($Files->exist("CONTRAT1",$element2,$id_folder_to_delete)) {
		                                                                        	$element=$element+2;
		                                                                      }
		                                                                      
	                                                                        	if($Files->exist("CONTRAT2",$element2,$id_folder_to_delete)) {
		                                                                        	$element++;
		                                                                      }
		                                                                   
																			//echo $element.'-';

                                                                            switch($element) { case 0: echo "1 -A compléter"; break; case 1: echo "2 - Complet (attente de vérification)"; break; case 2: echo "3 - Vérifié RH"; break; case 3: echo " 6 - Archivé"; break; case 4: echo "4 - Contrat signé ENSP"; break; case 5: echo "5 - Contrat signé"; break;  case 6: echo "6 - Archivé"; break; default: echo "no state"; break; }
                                                                            echo "</td>";
                                                                        }
                                                                        else
                                                                            echo "<td>".$element."</td>";
                                                                        $i++;
                                                                    }
                                                                    echo "<td><button style='z-index=2;' onClick='event.stopPropagation();delete_folder(".$id_folder_to_delete.");' class='btn btn-o btn-danger btn-xs'><i class='fa fa-trash'></i></button></td>";
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
                                <div class="col-sm-4 col-md-12" style="position: inherit">
                                    <!-- FORM -->    
                                    <div class="panel">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-md-12" style="position: inherit">
                                                    <!--DANGER modal-->
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <form class="form-horizontal form-stripe" method="post" action="dossiers.php">
                                                                        <div class="modal-header state modal-info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="modal-info-label"><i class="fa fa-warning"></i><?php echo create_folder; ?></h4>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="form-group">
                                                                                <label for="title" class="col-sm-3 control-label"><?php echo title; ?><span class="required">*</span></label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control" id="title" name="title" required >
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group">
                                                                                <label for="select2-example-basic4" class="col-sm-3 control-label"><?php echo years; ?><span class="required">*</span></label>
                                                                                <div class="col-sm-6">
                                                                                    <select name="year" class="form-control" id="select2-example-basic4" style="width: 100%;" required>
                                                                                        <option value='2025-2026' label='2025-2026'>2025-2026</option>
                                                                                        <option value='2024-2025' label='2024-2025'>2024-2025</option>
                                                                                        <option value='2023-2024' label='2023-2024'>2023-2024</option>
                                                                                        <option value='2022-2023' label='2022-2023' selected >2022-2023</option>
                                                                                        <option value='2021-2022' label='2021-2022'>2021-2022</option>
                                                                                        <option value='2020-2021' label='2020-2021'>2020-2021</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            
                                                                            <div class="form-group">
                                                                                <label for="f_name" class="col-sm-3 control-label"><?php echo remuneration; ?><span class="required">*</span></label>
                                                                                <div class="col-sm-6">
                                                                                <select name="remun" class="form-control" style="width: 100%">
                                                                                    <option value="">---<?php echo remuneration; ?>---</option>
                                                                                    <option value="Vacation" label="<?php echo salaire; ?>"></option>
                                                                                    <option value="Facture" label="<?php echo facture; ?>"></option>
                                                                                    <option value="titre-gracieux" label="Titre gracieux"></option>
                                                                                </select>

                                                                                </div>
                                                                            </div>

                                                                            
                                                                            <div class="form-group">
                                                                                <label for="select2-example-basic2" class="col-sm-3 control-label"><?php echo select_inter; ?><span class="required">*</span></label>
                                                                                <div class="col-sm-6">
                                                                                    <select name="intervenant" class="form-control" id="select2-example-basic2" style="width: 100%;" required>
                                                                                        <?php
                                                                                            $i=0;
                                                                                            foreach ($users as $row){
                                                                                                $s="";
                                                                                                if($i==$users->num_rows-1) $s='selected';
                                                                                                echo "<option value='".$row["id"]."' label='".$row["id"]." : ".$row["Prénom"]." ".$row["Nom"]."' $s>".$row["id"]." : ".$row["Prénom"]." ".$row["Nom"]."</option>";
                                                                                                $i++;
                                                                                            }
                                                                                        ?>
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
<!--seewtaler-->
<script src="../vendor/sweetalert/sweetalert.min.js"></script>
<!--pNotify-->
<script src="../vendor/toastr/toastr.min.js"></script>
<!--dataTable-->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js" type="text/javascript"></script>

<script>

$('.data-table').DataTable({
    dom: 'Bfrtip',
    order: [[0, 'desc']],
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
    ],
    columnDefs: [
        {
            targets: [-4,-5,-6,-7,-8,-9,-10,-11,-12,-14],
            visible: false
        }
    ],
    
    
});

function delete_folder(id) {
        swal({
                title: "<?php echo swal1; ?>",
                text: "<?php echo swal12; ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo swal3; ?>",
                closeOnConfirm: false
            },
            function(){
                swal("<?php echo swal4; ?>", "<?php echo swal13; ?>", "success");
                window.location = "Controller/Ajax/delete_folder.php?id="+id;
            });
        }
</script>
</body>
</html>
