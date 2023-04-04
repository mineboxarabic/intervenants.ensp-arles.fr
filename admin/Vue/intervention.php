
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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="dossiers.php"><?php echo dossiers ; ?></a></li>
                        <li><a href="dossier.php?id_d=<?php echo $id_dossier; ?>&id_i=<?php echo $id_intervenant; ?>"><?php echo dossier ; ?></a></li>
                        <li><a><?php echo intervention_modif; ?></a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row animated fadeInUp">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="panel-title"><?php echo intervention_modif; ?></h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-4 col-md-12">
                                    <!-- FORM -->    
                                    <div class="panel">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="form-horizontal form-stripe" method="post" action="intervention.php?id=<?php echo $id; ?>">
                                                        <div class="form-group">
                                                            <label for="select2-example-basicRef" class="col-sm-2 control-label"><?php echo select_ref; ?></label>
                                                            <div class="col-sm-8">
                                                                <select name="referant" class="form-control" id="select2-example-basicRef">
                                                                    <option value="">---<?php echo select_ref; ?>---</option>
                                                                    <?php
                                                                        $i=0;
                                                                        foreach ($referants as $row){
                                                                            $s="";
                                                                            if($referant==$row["id"]) $s='selected';
                                                                                echo "<option value='".$row["id"]."' label='".$row["id"]." : ".$row["first_name"]." ".$row["last_name"]."' $s>".$row["id"]." : ".utf8_encode($row["first_name"])." ".utf8_encode($row["last_name"])."</option>";
                                                                            $i++;
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cursus" class="col-sm-2 control-label"><?php echo select_cursus; ?><span class="required">*</span></label>
                                                            <div class="col-sm-8">
                                                                <select name="cursus" class="form-control" required>
                                                                    <option value="">---<?php echo select_cursus; ?>---</option>
                                                                    <option value="Formation Continue" label="Formation Continue" <?php if($cursus=="Formation Continue") echo "selected"; ?>></option>
                                                                    <option value="1ere année" label="1ere année" <?php if($cursus=="1ere année") echo "selected"; ?>></option>
                                                                    <option value="2eme année" label="2eme année" <?php if($cursus=="2eme année") echo "selected"; ?>></option>
                                                					<option value="3eme année" label="3eme année" <?php if($cursus=="3eme année") echo "selected"; ?>></option>
																	<option value="EAC" label="EAC" <?php if($cursus=="EAC") echo "selected"; ?>></option>
	
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="type" class="col-sm-2 control-label"><?php echo select_type; ?><span class="required">*</span></label>
                                                            <div class="col-sm-8">
                                                                <select name="type" class="form-control" required>
                                                                    <option value="">---<?php echo select_type; ?>---</option>
                                                                    <option value="Ateliers photo" label="Ateliers photo" <?php if($type=="Ateliers photo") echo "selected"; ?>></option>
                                                                    <option value="2" label="Bilan de fin d'année" <?php if($type=="2") echo "selected"; ?>></option>
																	<option value="Conférence" label="Conférence" <?php if($type=="Conférence") echo "selected"; ?>></option>
                                                                    <option value="Cours magistral" label="Cours magistral" <?php if($type=="Cours magistral") echo "selected"; ?>></option>
                                                                    <option value="Cours technique" label="Cours technique" <?php if($type=="Cours technique") echo "selected"; ?>></option>
                                                                    <option value="Formation FC" label="Formation FC" <?php if($type=="Formation FC") echo "selected"; ?>></option>
                                                                   	<option value="Séminaire" label="Workshop" <?php if($type=="Séminaire") echo "selected"; ?>></option>
                                                                    <option value="Workshop" label="Workshop" <?php if($type=="Workshop") echo "selected"; ?>></option>
                                                                    <option value="9" label="Séminaire" <?php if($type=="9") echo "selected"; ?>></option>
																	<option value="Autre" label="Autre" <?php if($type=="Autre") echo "selected"; ?>></option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name" class="col-sm-2 control-label"><?php echo title_inter; ?><span class="required">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value="<?php echo $title; ?>" name="name" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"><?php echo date_begin_end; ?><span class="required">*</span></label>
                                                            <div class="col-sm-8">
                                                                <div class="input-daterange input-group" id="range-datepicker">
                                                                    <input type="text" value="<?php echo $date_begin; ?>" class="input-sm form-control" name="date_begin" />
                                                                    <span class="input-group-addon x-primary">to</span>
                                                                    <input type="text" value="<?php echo $date_end; ?>" class="input-sm form-control" name="date_end" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="price" class="col-sm-2 control-label"><?php echo inter_price; ?> (€/h)<span class="required">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="number" step="0.01" value="<?php echo $price_hour; ?>" class="form-control" name="price" min="0" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="price" class="col-sm-2 control-label"><?php echo inter_hours; ?> (h)<span class="required">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="number" step="0.01" value="<?php echo $hours; ?>" class="form-control" name="hours" min="0" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default-datepicker" class="col-sm-2 control-label "><?php echo previ_date; ?></label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                                    <input type="text" class="form-control" value="<?php echo $previ_date; ?>" name="previ_date" id="default-datepicker">
                                                                </div>
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group">
                                                            <label for="state" class="col-sm-2 control-label"><?php echo state; ?><span class="required">*</span></label>
                                                            <div class="col-sm-8">
                                                                <select name="state" class="form-control" required>
                                                                    <option value="">---<?php echo state; ?>---</option>
                                                                    <option value="Programmé" label="Programmé" <?php if(($state)=="Programmé") echo "selected"; ?>></option>
                                                                    <option value="Service fait constaté" label="Service fait constaté" <?php if(($state)=="Service fait constaté") echo "selected"; ?>></option>
                                                                    <option value="Service fait validé" label="Service fait validé" <?php if(($state)=="Service fait validé") echo "selected"; ?>></option>
                                                                    <option value="Payé" label="Payé" <?php if(($state)=="Payé") echo "selected"; ?>></option>
                                                                    <option value="Annulée" label="Annulée" <?php if(($state)=="Annulée") echo "selected"; ?>></option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="checkbox-custom checkbox-primary">
                                                            <input type="checkbox" id="check1" <?php if($travel==1) echo "checked"; ?> name="travel" onClick="displayTextArea();">
                                                            <label class="check" for="check1"><?php echo travel; ?></label>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="textarea" <?php if($travel==1) echo "style='display: inline-block;'"; else echo "style='display: none;'"; ?> id="label_textarea" class="control-label"><?php echo travel_text; ?></label>
                                                            <textarea class="form-control" <?php if($travel==1) echo "style='display: block;'"; else echo "style='display: none;'"; ?> style="width: 80%;" id="textarea" name="travel_text" placeholder="Write an explication"><?php echo $travel_text; ?></textarea>
                                                        </div>

                                                        <div class="form-group col-sm-8">
                                                            <button type="submit" name="inter_edit" class="btn btn-info"><?php echo intervention_modif; ?></button>
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
<!--CP and city-->
<script src="../vendor/vicopo/vicopo.min.js"></script>
<script>
    $(":input").inputmask();
    document.getElementById("code-cp").addEventListener('keypress', (event) => {
        console.log("lol");
        document.getElementById("liste-cp").style.display="block";
        event.stopPropagation();
    });

    function displayTextArea() {
        // Get the checkbox
        var checkBox = document.getElementById("check1");
        // Get the output text
        var text = document.getElementById("textarea");
        var label = document.getElementById("label_textarea");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
            text.style.display = "block";
            label.style.display = "inline-block";
        } else {
            text.style.display = "none";
            label.style.display = "none";
        }
    }
    
    $("#phone-number").inputmask("+99 9 99 99 99 99",{ "onincomplete": function(){ document.getElementById("phone-message").style.display='block'; document.getElementById("phone-message-valid").style.display='none'}, "oncomplete": function(){ document.getElementById("phone-message").style.display='none'; document.getElementById("phone-message-valid").style.display='block'} });
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
