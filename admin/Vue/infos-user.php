
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
    <link rel="stylesheet" href="../vendor/data-table/media/css/dataTables.bootstrap.min.css">
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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="intervenants.php"><?php echo intervenants; ?></a></li>
                        <li><a><?php echo profil_user; ?></a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--PROFILE-->
                    <div>
                        <div class="profile-photo">
                            <img alt="User photo" src="../assets/img/<?php if($civ=="Monsieur" || empty($civ)) echo "profil"; else echo "women";?>.svg" />
                        </div>
                        <div class="user-header-info">
                            <h2 class="user-name"><?php echo "$last_name $first_name" ?></h2>
                            <h5 class="user-position"><?php echo intervenant; ?></h5>
                        </div>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--CONTACT INFO-->
                    <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
                        <div class="panel-content">
                            <div style="width:100%; height: 30px">
                                <h4 class="" style="display: inline-block; float: left; margin:0;"><b>Informations</b></h4>
                                <?php if($_SESSION["acreditation"]=="SM"){ ?> <button type="button" class="btn btn-success btn-o" onClick='window.location = "profil.php?id=<?php echo $id_user?>";' style="width: min-content;height: min-content;font-size: 15px; padding:1px 5px; display: inline-block;float: right;"><i class='fa fa-edit'></i></button> <?php } ?>
                            </div>
                            <ul class="user-contact-info ph-sm" style="width: 100%">
                                <li><b><i class="color-primary mr-sm fa fa-user"></i></b> <?php if(empty($civ))echo ""; else if($civ=='Monsieur') echo "M. "; else echo "Mme. ";echo "$last_name $first_name"?></li>
                                <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b> <?php echo $member_email;?></li>
                                <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> <?php if(empty($tel))echo not_give; else echo $tel;?></li>
                                <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> <?php if(empty($adresse))echo not_give; else echo "$adresse, $cp $ville ($pays)";?></li>
                            </ul>
                        </div>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--LIST-->
                    <div class="panel  b-primary bt-sm ">
                        <div class="panel-content">
                            <div style="width:100%">
                                <h4 class="" style="display: inline-block; float: left; margin:0;"><b><?php echo dossiers; ?></b></h4>
                                <button type="button" class="btn btn-success btn-o" style="width: min-content;height: min-content;font-size: 15px; padding:0 6px; display: inline-block;float: right;" data-toggle="modal" data-target="#info-modal">+</button>
                            </div>
                            <div class="widget-list list-sm list-left-element " style="max-height: 200px; overflow: auto; display: block; width: 100%;">
                                <ul>
                                <?php
                                    foreach ($dossiers as $row)
                                    {
                                        $i=0;
                                        foreach ($row as $element){
                                            if($i==0)
                                                echo "<li><a href='dossier.php?id_d=$element&id_i=$id_user'><div class='left-element'>";
                                            else if($i==1 && $element==0)
                                                echo "<i class='fa fa-pencil color-warning'></i></div><div class='text'>";
                                            else if($i==1)
                                                echo "<i class='fa fa-check color-success'></i></div><div class='text'>";
                                            else if($i==2)
                                                echo '<span class="title">'.$element.' </span>';
                                            else if($i>=3)
                                                echo '<span class="subtitle"> '.$element.'</span>';
                                            $i++;
                                        }
                                        echo "</div></a></li>";
                                    }?>
                                </ul>
                                <div class="col-sm-offset-3 col-sm-9">
                                    <!-- Modal -->
                                    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form class="form-horizontal form-stripe" method="post" action="infos-user.php&id=<?php echo $id_user ?>">
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
                                                                    <option value='2022-2023' label='2022-2023'>2022-2023</option>
                                                                    <option value='2021-2022' label='2021-2022'>2021-2022</option>
                                                                    <option value='2020-2021' label='2020-2021' selected>2020-2021</option>
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
                <div class="col-md-6 col-lg-8">
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--TIMELINE-->
                    <div class="timeline animated fadeInUp">
                        <div class="timeline-box">
                            <div class="timeline-icon bg-primary">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="timeline-content">
                                <h4 class="tl-title"><?php echo naiss_natio; ?></h4> 
                                <?php echo dateNaissance." : ";if($born_date=="0000-00-00")echo not_give; else echo implode('/',array_reverse(explode('-',$born_date)));?> <br>
                                <?php echo born_country; ?> : <?php if(empty($born_country))echo not_give; else echo $born_country;?> <br>
                                <?php echo nationalite; ?> : <?php if(empty($nationality))echo not_give; else echo $nationality;?> <br>
                            </div>
                            <div class="timeline-footer">
                                <span><?php echo naiss_natio; ?></span>
                            </div>
                        </div>
                        <div class="timeline-box">
                            <div class="timeline-icon bg-primary">
                                <i class="fa fa-info"></i>
                            </div>
                            <div class="timeline-content">
                                <h4 class="tl-title"><?php echo supp_infos ; ?></h4>
                                <?php echo ss_num ; ?> : <?php if(empty($ss))echo not_give; else echo $ss;?> <br>
                                Siret : <?php if(empty($siret))echo not_give; else echo $siret;?>
                            </div>
                            <div class="timeline-footer">
                                <span><?php echo supp_infos ; ?></span>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel  b-primary bt-sm ">
                        <div class="panel-content">
                            <h4 class=""><b>Interventions</b></h4>
                            <div class="widget-list list-sm list-left-element " style="max-height: 200px; overflow: auto;">
                                <ul>
                                <?php
                                    foreach ($interventions as $row)
                                    {
                                        $i=0;
                                        foreach ($row as $element){
                                            if($i==0)
                                                echo "<li><a href='intervention.php?id=$element'><div class='left-element'><i class='fa fa-check color-success'></i></div><div class='text'>";
                                            else if($i==2)
                                                echo '<span class="title">'.$element.' </span>';
                                            else if($i==3)
                                                echo '<span class="subtitle"> '.$element.'</span>';
                                            else if($i>3)
                                                echo '<span class="subtitle"> ( '.$element.' )</span>';
                                            $i++;
                                        }
                                        echo "</div></a></li>";
                                    }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
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
