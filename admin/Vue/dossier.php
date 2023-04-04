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
    <!--seewtaler-->
    <link rel="stylesheet" href="../vendor/sweetalert/sweetalert.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTabDossierAdmin-<?php echo $id_intervenant; ?>', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTabDossierAdmin-<?php echo $id_intervenant; ?>');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }   
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
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Service fait constatée") ?>&id="+$id;
        }

        function update_sfv($id) {
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Service fait validée") ?>&id="+$id;
        }

        function update_a($id) {
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Annulée") ?>&id="+$id;
        }

        function update_p($id) {
            window.location = "Controller/Ajax/update_intervention.php?state=<?php echo urlencode("Payée") ?>&id="+$id;
        }

        function generatePDF() {
            window.location = "Controller/Ajax/pdfDossier.php?id=<?php echo $id_dossier; ?>";
        }
        
         function generatePDFFacture() {
            window.location = "Controller/Ajax/pdfDossierFacture.php?id=<?php echo $id_dossier; ?>";
        }
        
         function generatePDFGracieux() {
            window.location = "Controller/Ajax/pdfDossierGracieux.php?id=<?php echo $id_dossier; ?>";
        }
        
        function generatePDFGracieuxProvisoire() {
            window.location = "Controller/Ajax/pdfDossierGracieuxProvisoire.php?id=<?php echo $id_dossier; ?>";
        }
        
        function sendMailRappel() {
            //alert(<?php echo $member_email; ?>);
            window.location = "Controller/Ajax/sendMailRappel.php?email=<?php echo $member_email; ?>";
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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="dossiers.php"><?php echo dossiers; ?></a></li>
                        <li><a><?php echo dossier; ?></a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row">
                <div class="col-md-12">
                    <div style="float:left; display: inline-block;">
                        <h5><b><?php echo $title; ?></b> ( <a href="infos-user.php?id=<?php echo $id_intervenant; ?>"><?php echo $intervenant; ?></a> )</h5>
                        <h6><?php echo $year; ?> | statut : <strong> <?php switch ($state) {
                                case 0:
                                    echo "A compléter";
                                    break;
                                case 1:
                                    echo "Complet (attente de vérification)";
                                    break;
                                case 2:
                                    echo "Vérifié";
                                    break;
                                case 3:
                                    echo "Archivé";
                                    break;
                                default:
                                    echo "no state";
                                    break;
                            } ?></strong></h6>
                        <h6>Référent : <?php echo utf8_encode($User->getAdmin("first_name", $Dossiers->get("created_user", $id_dossier)) . " " . $User->getAdmin("last_name", $Dossiers->get("created_user", $id_dossier))); ?> | Crée le : <?php $datetime = explode(' ', $Dossiers->get("created_date", $id_dossier));
                            echo implode('/', array_reverse(explode('-', $datetime[0]))) . " " . $datetime[1]; ?></h6>
                        <?php if ($Dossiers->get("modif_date", $id_dossier) != "0000-00-00 00:00:00") { ?><em>Dernière modification : <?php $datetime = explode(' ', $Dossiers->get("modif_date", $id_dossier));
                         echo implode('/', array_reverse(explode('-', $datetime[0]))) . " " . $datetime[1]; ?></em><?php } ?>
                    </div>
                    <form  style="float:right; display: inline-block; margin-left: 10px;" id="inline-validation needs-validation" class="form-horizontal" method="post" action="dossier.php?id_d=<?php echo $id_dossier; ?>&id_i=<?php echo $id_intervenant; ?>">
                        <?php if ($state == 1 && $_SESSION["acreditation"] == "RH") { ?>
                                <button type="submit" name="valid_dossier" class="btn btn-wide btn-primary"><?php echo valid_folder; ?></button>
                        <?php } else if ($state == 0) { ?>
                                    <button type="submit" class="btn btn-wide btn-primary" disabled><?php echo valid_folder; ?></button>
                        <?php } ?>
                        <?php if ($state == 1 && $_SESSION["acreditation"] == "RH") { ?>
                                <button type="button" id="unvalide_folder" name="unvalid_dossier" class="btn btn-wide btn-danger"><?php echo unvalid_folder; ?></button>
                        <?php } else if ($state == 2 && $_SESSION["acreditation"] == "RH") { ?>
                                    <button type="button" id="retour_folder" name="retour_dossier" class="btn btn-wide btn-primary">Étape précédente</button>

                                    <button type="button" id="archive_folder" name="archive_dossier" class="btn btn-wide btn-danger"><?php echo archive; ?></button>
                        <?php } else if ($state == 0) { ?>
                                        <button type="button" class="btn btn-wide btn-danger" disabled><?php echo unvalid_folder; ?></button>
                                        <button type="submit" name="valid_dossier" class="btn btn-wide btn-primary">Forcer la validation</button>

                        <?php } ?>
                
                    </form>
                    <?php if ($state == 0) { ?>
                        &nbsp;<button onClick="sendMailRappel();" class="btn btn-danger btn-o" style="float:right; display: inline-block"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
                    <?php } ?>
                   
                    <div class="tabs" style="max-width: 100%;overflow: scroll;float: left;">
                        <!-- Tabs Header -->
                        <ul id="myTab" class="nav nav-tabs nav-justified">
                            <?php
                            if ($isProfilComplete) {
                                ?>
                                <li class="active"><a href="#profil" data-toggle="tab" style="color: green"><?php echo info_perso; ?></a></li>
                                <?php
                            } else {
                                ?>
                                <li class="active"><a href="#profil" data-toggle="tab" style="color: red"><?php echo info_perso; ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if ($isDataComplete) {
                                ?>
                                <li><a href="#datas" data-toggle="tab" style="color: green"><?php echo data_add; ?></a></li>
                                <?php
                            } else {
                                ?>
                                <li><a href="#datas" data-toggle="tab" style="color: red"><?php echo data_add; ?></a></li>
                                <?php
                            }
                            ?>
                            
                            <?php
                            /*
                            if ($Files->exist("SS", $id_intervenant, $id_dossier) &&
                             $Files->exist("RIB", $id_intervenant, $id_dossier) &&
                              $Files->exist("CI", $id_intervenant, $id_dossier) && 
                              (($Files->exist("CE", $id_intervenant, $id_dossier) &&
                               $statut_soc == "Salarie du secteur public") || $statut_soc != "Salarie du secteur public") && 
                               (($Files->exist("SE", $id_intervenant, $id_dossier) && 
                               $statut_soc == "Sans emploi") || $statut_soc != "Sans emploi")) {
                                ?>
                                 <li><a href="#files" data-toggle="tab" style="color: green"><?php // echo fichiers; ?></a></li> 
                                <?php
                            } else {
                                ?>
                                <li><a href="#files" data-toggle="tab" style="color: red"><?php echo fichiers; ?></a></li> 
                                <?php
                            }*/
                            ?>
                            <li><a href="#folder" data-toggle="tab">Interventions</a></li>
                            
                        
                            <li><a href="#contrat" data-toggle="tab">Contrat</a></li>
                            
                        </ul>
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="profil">
                                <div>
                                    <?php
                                    if (!$hasCompleteProfil) {
                                        ?>
                                        <div class="alert alert-danger fade in">
                                            <a href="" class="close" data-dismiss="alert">&times;</a>
                                            <span style="cursor: pointer;" onclick="location.href='profil.php?id=<?php echo $id_intervenant; ?>';" > <strong><?php echo title_have_to_update_profil; ?></strong> <?php echo have_to_update_profil; ?><span>
                                        </div>
                                    <?php
                                    }
                                    if ($isProfilComplete) {
                                        ?>
                                        <div class="alert alert-success fade in">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                            <strong><?php echo complete_data; ?></strong>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-danger fade in">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                            <strong><?php echo uncomplete_data; ?></strong> <?php echo data_unvalide; ?>
                                        </div>
                                        <?php
                                    }

                                    ?>
                                    <form id="inline-validation needs-validation" class="form-horizontal" method="post" action="dossier.php?id_d=<?php echo $id_dossier; ?>&id_i=<?php echo $id_intervenant; ?>">
                                        <div class="col-sm-6">
                                            <h4 class="section-subtitle"><b><?php echo info_perso; ?></b></h4>
                                            <div class="panel">
                                                <div class="panel-content">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="l_name" class="col-sm-3 control-label"><?php echo civ; ?><span class="required">*</span></label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if (empty($civ))
                                                                        echo not_give;
                                                                    else
                                                                        echo $civ; ?></div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="l_name" class="col-sm-3 control-label"><?php echo nom; ?><span class="required">*</span></label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if (empty($last_name))
                                                                        echo not_give;
                                                                    else
                                                                        echo $last_name; ?></div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="f_name" class="col-sm-3 control-label"><?php echo prenom; ?><span class="required">*</span></label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if (empty($first_name))
                                                                        echo not_give;
                                                                    else
                                                                        echo $first_name; ?></div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="c_mail" class="col-sm-3 control-label"><?php echo email; ?><span class="required">*</span></label>
                                                                <div class="col-sm-6">
                                                                    <?php if ($state == 0) { ?>
                                                                            <input type="email" class="form-control" id="c_mail" name="c_mail" value="<?php echo $member_email; ?>" required>
                                                                    <?php } else { ?>
                                                                            <input type="email" class="form-control" id="c_mail" name="c_mail" value="<?php echo $member_email; ?>" disabled>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label"><?php echo dateNaissance; ?> <span class="required">*</span></label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if ($born_date == "00/00/0000")
                                                                        echo not_give;
                                                                    else
                                                                        echo $born_date; ?></div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="born_country" class="col-sm-3 control-label"><?php echo pays_naiss; ?><span class="required">*</span></label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if (empty($born_country))
                                                                        echo not_give;
                                                                    else
                                                                        echo $born_country; ?></div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="phone-mask" class="col-sm-3 control-label"><?php echo tel; ?><span class="required">*</span></label>
                                                                <div class="input-group col-sm-6">
                                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                    
                                                                    <?php if ($state == 0) { ?>
                                                                        <input name="phone" id="phone-number" type="text" class="form-control" value="<?php if (!empty($phone))
                                                                            echo $phone;
                                                                        else
                                                                            echo ""; ?>" data-inputmask="'mask': '99 99 99 99 99'" required>
                                                                    <?php } else { ?>
                                                                        <input name="phone" id="phone-number" type="text" class="form-control" value="<?php echo $phone; ?>" data-inputmask="'mask': '99 99 99 99 99'" data-inputmask-clearincomplete="true" disabled>
                                                                    <?php } ?>
                                                                </div>
                                                                    <span id="phone-message" class="help-block col-sm-6" style='color:red;display: none;'><i class="fa fa-info-circle mr-xs"></i><?php echo phone_unc; ?></span>
                                                                    <span id="phone-message-valid" class="help-block col-sm-6" style='color:green;display: none;'><i class="fa fa-info-circle mr-xs"></i><?php echo phone_c; ?></span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4 class="section-subtitle"><b><?php echo info_supp; ?></b></h4>
                                            <div class="panel">
                                                <div class="panel-content">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="select2-example-basic2" class="col-sm-3 control-label"><?php echo nationalite; ?><span class="required">*</span></label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if (empty($nationality))
                                                                        echo not_give;
                                                                    else
                                                                        echo $nationality; ?></div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="secu" class="col-sm-3 control-label">n° SS :</label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if (empty($ss))
                                                                        echo not_give;
                                                                    else
                                                                        echo $ss; ?></div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="siret" class="col-sm-3 control-label">Identification :</label>
                                                                <div style="padding-top: 7px" class="col-sm-6">
                                                                    <div><?php if (empty($siret))
                                                                        echo not_give;
                                                                    else
                                                                        echo $siret; ?></div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="addr" class="col-sm-3 control-label"><?php echo adresse; ?><span class="required">*</span></label>
                                                                <div class="col-sm-6">
                                                                    
                                                                   
                                                                        <input type="text" class="form-control" id="adr" name="adresse" value="<?php echo $addr; ?>" placeholder="adresse" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="cp" class="col-sm-3 control-label"><?php echo cp; ?><span class="required">*</span></label>
                                                                <div class=col-sm-6>
                                                                    <?php if ($state == 0) { ?>
                                                                            <input name="cp" id="code-cp" class="form-control" placeholder="Code postal"  value="<?php if ($cp != 0)
                                                                                echo $cp; ?>" autocomplete="off" required>
                                                                    <?php } else { ?>
                                                                            <input name="cp" id="code-cp" class="form-control" placeholder="Code postal"  value="<?php if ($cp != 0)
                                                                                echo $cp; ?>" autocomplete="off" disabled>
                                                                    <?php } ?>
                                                                </div>
                                                                <ul id="liste-cp" style="position: absolute;background-color: white;border-radius: 5px;z-index: 1000;cursor: pointer;transform: translateY(30px);box-shadow: 0 0 4px grey;<?php if (!empty($cp))
                                                                    echo "display:none"; ?>">
                                                                    <li data-vicopo="#ville, #code-cp" data-vicopo-click='{"#code-cp": "code", "#ville": "ville"}'>
                                                                        <strong data-vicopo-code-postal></strong>
                                                                        <span data-vicopo-ville></span>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="city" class="col-sm-3 control-label"><?php echo ville; ?><span class="required">*</span></label>
                                                                <div class=col-sm-6>
                                                                    <?php if ($state == 0) { ?>
                                                                            <input name="city" id="ville" class="form-control" placeholder="Ville" value="<?php echo $city; ?>" required>
                                                                    <?php } else { ?>
                                                                            <input name="city" id="ville" class="form-control" placeholder="Ville" value="<?php echo $city; ?>" disabled>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="form-group">
                                                                <label for="live_country" class="col-sm-3 control-label"><?php echo pays; ?><span class="required">*</span></label>
                                                                <div class="col-sm-6">
                                                                    <?php if ($state == 0) { ?>
                                                                            <select name="live_country" id="select2-example-basic" class="form-control" required>
                                                                    <?php } else { ?>
                                                                            <select name="live_country" id="select2-example-basic" class="form-control" disabled>
                                                                    <?php } ?>
                                                                        <option value="">---<?php echo pays; ?>---</option>
                                                                        <optgroup label="AMERICA">
                                                                            <option value="Anguilla" <?php if ($live_country == "Anguilla")
                                                                                echo "selected"; ?> label="Anguilla">Anguilla</option>
                                                                            <option value="Antigua and Barbuda" <?php if ($live_country == "Antigua and Barbuda")
                                                                                echo "selected"; ?> label="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                            <option value="Argentina" <?php if ($live_country == "Argentina")
                                                                                echo "selected"; ?> label="Argentina">Argentina</option>
                                                                            <option value="Aruba" <?php if ($live_country == "Aruba")
                                                                                echo "selected"; ?> label="Aruba">Aruba</option>
                                                                            <option value="Bahamas" <?php if ($live_country == "Bahamas")
                                                                                echo "selected"; ?> label="Bahamas">Bahamas</option>
                                                                            <option value="Barbados" <?php if ($live_country == "Barbados")
                                                                                echo "selected"; ?> label="Barbados">Barbados</option>
                                                                            <option value="Belize" <?php if ($live_country == "Belize")
                                                                                echo "selected"; ?> label="Belize">Belize</option>
                                                                            <option value="Bermuda" <?php if ($live_country == "Bermuda")
                                                                                echo "selected"; ?> label="Bermuda">Bermuda</option>
                                                                            <option value="Bolivia" <?php if ($live_country == "Bolivia")
                                                                                echo "selected"; ?> label="Bolivia">Bolivia</option>
                                                                            <option value="Brazil" <?php if ($live_country == "Brazil")
                                                                                echo "selected"; ?> label="Brazil">Brazil</option>
                                                                            <option value="British Virgin Islands" <?php if ($live_country == "British Virgin Islands")
                                                                                echo "selected"; ?> label="British Virgin Islands">British Virgin Islands</option>
                                                                            <option value="Canada" <?php if ($live_country == "Canada")
                                                                                echo "selected"; ?> label="Canada">Canada</option>
                                                                            <option value="Cayman Islands" <?php if ($live_country == "Cayman Islands")
                                                                                echo "selected"; ?> label="Cayman Islands">Cayman Islands</option>
                                                                            <option value="Chile" <?php if ($live_country == "Chile")
                                                                                echo "selected"; ?> label="Chile">Chile</option>
                                                                            <option value="Colombia" <?php if ($live_country == "Colombia")
                                                                                echo "selected"; ?> label="Colombia">Colombia</option>
                                                                            <option value="Costa Rica" <?php if ($live_country == "Costa Rica")
                                                                                echo "selected"; ?> label="Costa Rica">Costa Rica</option>
                                                                            <option value="Cuba" <?php if ($live_country == "Cuba")
                                                                                echo "selected"; ?> label="Cuba">Cuba</option>
                                                                            <option value="Dominica" <?php if ($live_country == "Dominica")
                                                                                echo "selected"; ?> label="Dominica">Dominica</option>
                                                                            <option value="Dominican Republic" <?php if ($live_country == "Dominican Republic")
                                                                                echo "selected"; ?> label="Dominican Republic">Dominican Republic</option>
                                                                            <optiphpon value="Ecuador" <?php if ($live_country == "Ecuador")
                                                                                echo "selected"; ?> label="Ecuador">Ecuador</optiphpon>
                                                                            <option value="El Salvador" <?php if ($live_country == "El Salvador")
                                                                                echo "selected"; ?> label="El Salvador">El Salvador</option>
                                                                            <option value="Falkland Islands" <?php if ($live_country == "Falkland Islands")
                                                                                echo "selected"; ?> label="Falkland Islands">Falkland Islands</option>
                                                                            <option value="French Guiana" <?php if ($live_country == "French Guiana")
                                                                                echo "selected"; ?> label="French Guiana">French Guiana</option>
                                                                            <option value="Greenland" <?php if ($live_country == "Greenland")
                                                                                echo "selected"; ?> label="Greenland">Greenland</option>
                                                                            <option value="Grenada" <?php if ($live_country == "Grenada")
                                                                                echo "selected"; ?> label="Grenada">Grenada</option>
                                                                            <option value="Guadeloupe" <?php if ($live_country == "Guadeloupe")
                                                                                echo "selected"; ?> label="Guadeloupe">Guadeloupe</option>
                                                                            <option value="Guatemala" <?php if ($live_country == "Guatemala")
                                                                                echo "selected"; ?> label="Guatemala">Guatemala</option>
                                                                            <option value="Guyana" <?php if ($live_country == "Guyana")
                                                                                echo "selected"; ?> label="Guyana">Guyana</option>
                                                                            <option value="Haiti" <?php if ($live_country == "Haiti")
                                                                                echo "selected"; ?> label="Haiti">Haiti</option>
                                                                            <option value="Honduras" <?php if ($live_country == "Honduras")
                                                                                echo "selected"; ?> label="Honduras">Honduras</option>
                                                                            <option value="Jamaica" <?php if ($live_country == "Jamaica")
                                                                                echo "selected"; ?> label="Jamaica">Jamaica</option>
                                                                            <option value="Martinique" <?php if ($live_country == "Martinique")
                                                                                echo "selected"; ?> label="Martinique">Martinique</option>
                                                                            <option value="Mexico" <?php if ($live_country == "Mexico")
                                                                                echo "selected"; ?> label="Mexico">Mexico</option>
                                                                            <option value="Montserrat" <?php if ($live_country == "Montserrat")
                                                                                echo "selected"; ?> label="Montserrat">Montserrat</option>
                                                                            <option value="Netherlands Antilles" <?php if ($live_country == "Netherlands Antilles")
                                                                                echo "selected"; ?> label="Netherlands Antilles">Netherlands Antilles</option>
                                                                            <option value="Nicaragua" <?php if ($live_country == "Nicaragua")
                                                                                echo "selected"; ?> label="Nicaragua">Nicaragua</option>
                                                                            <option value="Panama" <?php if ($live_country == "Panama")
                                                                                echo "selected"; ?> label="Panama">Panama</option>
                                                                            <option value="Paraguay" <?php if ($live_country == "Paraguay")
                                                                                echo "selected"; ?> label="Paraguay">Paraguay</option>
                                                                            <option value="Peru" <?php if ($live_country == "Peru")
                                                                                echo "selected"; ?> label="Peru">Peru</option>
                                                                            <option value="Puerto Rico" <?php if ($live_country == "Puerto Rico")
                                                                                echo "selected"; ?> label="Puerto Rico">Puerto Rico</option>
                                                                            <option value="Saint Barthélemy" <?php if ($live_country == "Saint Barthélemy")
                                                                                echo "selected"; ?> label="Saint Barthélemy">Saint Barthélemy</option>
                                                                            <option value="Saint Kitts and Nevis" <?php if ($live_country == "Saint Kitts and Nevis")
                                                                                echo "selected"; ?> label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                            <option value="Saint Lucia" <?php if ($live_country == "Saint Lucia")
                                                                                echo "selected"; ?> label="Saint Lucia">Saint Lucia</option>
                                                                            <option value="Saint Martin" <?php if ($live_country == "Saint Martin")
                                                                                echo "selected"; ?> label="Saint Martin">Saint Martin</option>
                                                                            <option value="Saint Pierre and Miquelon" <?php if ($live_country == "Saint Pierre and Miquelon")
                                                                                echo "selected"; ?> label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                            <option value="Saint Vincent and the Grenadines" <?php if ($live_country == "Saint Vincent and the Grenadines")
                                                                                echo "selected"; ?> label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                                            <option value="Suriname" <?php if ($live_country == "Suriname")
                                                                                echo "selected"; ?> label="Suriname">Suriname</option>
                                                                            <option value="Trinidad and Tobago" <?php if ($live_country == "Trinidad and Tobago")
                                                                                echo "selected"; ?> label="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                            <option value="Turks and Caicos Islands" <?php if ($live_country == "Turks and Caicos Islands")
                                                                                echo "selected"; ?> label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                            <option value="U.S. Virgin Islands" <?php if ($live_country == "U.S. Virgin Islands")
                                                                                echo "selected"; ?> label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                                                            <option value="United States" <?php if ($live_country == "United States")
                                                                                echo "selected"; ?> label="United States">United States</option>
                                                                            <option value="Uruguay" <?php if ($live_country == "Uruguay")
                                                                                echo "selected"; ?> label="Uruguay">Uruguay</option>
                                                                            <option value="Venezuela" <?php if ($live_country == "Venezuela")
                                                                                echo "selected"; ?> label="Venezuela">Venezuela</option>
                                                                        </optgroup>
                                                                        <optgroup label="ASIA">
                                                                            <option value="Afghanistan" <?php if ($live_country == "Afghanistan")
                                                                                echo "selected"; ?> label="Afghanistan">Afghanistan</option>
                                                                            <option value="Armenia" <?php if ($live_country == "Armenia")
                                                                                echo "selected"; ?> label="Armenia">Armenia</option>
                                                                            <option value="Azerbaijan" <?php if ($live_country == "Azerbaijan")
                                                                                echo "selected"; ?> label="Azerbaijan">Azerbaijan</option>
                                                                            <option value="Bahrain" <?php if ($live_country == "Bahrain")
                                                                                echo "selected"; ?> label="Bahrain">Bahrain</option>
                                                                            <option value="Bangladesh" <?php if ($live_country == "Bangladesh")
                                                                                echo "selected"; ?> label="Bangladesh">Bangladesh</option>
                                                                            <option value="Bhutan" <?php if ($live_country == "Bhutan")
                                                                                echo "selected"; ?> label="Bhutan">Bhutan</option>
                                                                            <option value="Brunei" <?php if ($live_country == "Brunei")
                                                                                echo "selected"; ?> label="Brunei">Brunei</option>
                                                                            <option value="Cambodia" <?php if ($live_country == "Cambodia")
                                                                                echo "selected"; ?> label="Cambodia">Cambodia</option>
                                                                            <option value="China" <?php if ($live_country == "China")
                                                                                echo "selected"; ?> label="China">China</option>
                                                                            <option value="Cyprus" <?php if ($live_country == "Cyprus")
                                                                                echo "selected"; ?> label="Cyprus">Cyprus</option>
                                                                            <option value="Georgia" <?php if ($live_country == "Georgia")
                                                                                echo "selected"; ?> label="Georgia">Georgia</option>
                                                                            <option value="Hong Kong SAR China" <?php if ($live_country == "Hong Kong SAR China")
                                                                                echo "selected"; ?> label="Hong Kong SAR China">Hong Kong SAR China</option>
                                                                            <option value="India" <?php if ($live_country == "India")
                                                                                echo "selected"; ?> label="India">India</option>
                                                                            <option value="Indonesia" <?php if ($live_country == "Indonesia")
                                                                                echo "selected"; ?> label="Indonesia">Indonesia</option>
                                                                            <option value="Iran" <?php if ($live_country == "Iran")
                                                                                echo "selected"; ?> label="Iran">Iran</option>
                                                                            <option value="Iraq" <?php if ($live_country == "Iraq")
                                                                                echo "selected"; ?> label="Iraq">Iraq</option>
                                                                            <option value="Israel" <?php if ($live_country == "Israel")
                                                                                echo "selected"; ?> label="Israel">Israel</option>
                                                                            <option value="Japan" <?php if ($live_country == "Japan")
                                                                                echo "selected"; ?> label="Japan">Japan</option>
                                                                            <option value="Jordan" <?php if ($live_country == "Jordan")
                                                                                echo "selected"; ?> label="Jordan">Jordan</option>
                                                                            <option value="Kazakhstan" <?php if ($live_country == "Kazakhstan")
                                                                                echo "selected"; ?> label="Kazakhstan">Kazakhstan</option>
                                                                            <option value="Kuwait" <?php if ($live_country == "Kuwait")
                                                                                echo "selected"; ?> label="Kuwait">Kuwait</option>
                                                                            <option value="Kyrgyzstan" <?php if ($live_country == "Kyrgyzstan")
                                                                                echo "selected"; ?> label="Kyrgyzstan">Kyrgyzstan</option>
                                                                            <option value="Laos" <?php if ($live_country == "Laos")
                                                                                echo "selected"; ?> label="Laos">Laos</option>
                                                                            <option value="Lebanon" <?php if ($live_country == "Lebanon")
                                                                                echo "selected"; ?> label="Lebanon">Lebanon</option>
                                                                            <option value="Macau SAR China" <?php if ($live_country == "Macau SAR China")
                                                                                echo "selected"; ?> label="Macau SAR China">Macau SAR China</option>
                                                                            <option value="Malaysia" <?php if ($live_country == "Malaysia")
                                                                                echo "selected"; ?> label="Malaysia">Malaysia</option>
                                                                            <option value="Maldives" <?php if ($live_country == "Maldives")
                                                                                echo "selected"; ?> label="Maldives">Maldives</option>
                                                                            <option value="Mongolia" <?php if ($live_country == "Mongolia")
                                                                                echo "selected"; ?> label="Mongolia">Mongolia</option>
                                                                            <option value="Myanmar [Burma]" <?php if ($live_country == "Myanmar [Burma]")
                                                                                echo "selected"; ?> label="Myanmar [Burma]">Myanmar [Burma]</option>
                                                                            <option value="Nepal" <?php if ($live_country == "Nepal")
                                                                                echo "selected"; ?> label="Nepal">Nepal</option>
                                                                            <option value="Neutral Zone" <?php if ($live_country == "Neutral Zone")
                                                                                echo "selected"; ?> label="Neutral Zone">Neutral Zone</option>
                                                                            <option value="North Korea" <?php if ($live_country == "North Korea")
                                                                                echo "selected"; ?> label="North Korea">North Korea</option>
                                                                            <option value="Oman" <?php if ($live_country == "Oman")
                                                                                echo "selected"; ?> label="Oman">Oman</option>
                                                                            <option value="Pakistan" <?php if ($live_country == "Pakistan")
                                                                                echo "selected"; ?> label="Pakistan">Pakistan</option>
                                                                            <option value="Palestinian Territories" <?php if ($live_country == "Palestinian Territories")
                                                                                echo "selected"; ?> label="Palestinian Territories">Palestinian Territories</option>
                                                                            <option value="People's Democratic Republic of Yemen" <?php if ($live_country == "People's Democratic Republic of Yemen")
                                                                                echo "selected"; ?> label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                                                            <option value="Philippines" <?php if ($live_country == "Philippines")
                                                                                echo "selected"; ?> label="Philippines">Philippines</option>
                                                                            <option value="Qatar" <?php if ($live_country == "Qatar")
                                                                                echo "selected"; ?> label="Qatar">Qatar</option>
                                                                            <option value="Saudi Arabia" <?php if ($live_country == "Saudi Arabia")
                                                                                echo "selected"; ?> label="Saudi Arabia">Saudi Arabia</option>
                                                                            <option value="Singapore" <?php if ($live_country == "Singapore")
                                                                                echo "selected"; ?> label="Singapore">Singapore</option>
                                                                            <option value="South Korea" <?php if ($live_country == "South Korea")
                                                                                echo "selected"; ?> label="South Korea">South Korea</option>
                                                                            <option value="Sri Lanka" <?php if ($live_country == "Sri Lanka")
                                                                                echo "selected"; ?> label="Sri Lanka">Sri Lanka</option>
                                                                            <option value="Syria" <?php if ($live_country == "Syria")
                                                                                echo "selected"; ?> label="Syria">Syria</option>
                                                                            <option value="Taiwan" <?php if ($live_country == "Taiwan")
                                                                                echo "selected"; ?> label="Taiwan">Taiwan</option>
                                                                            <option value="Tajikistan" <?php if ($live_country == "Tajikistan")
                                                                                echo "selected"; ?> label="Tajikistan">Tajikistan</option>
                                                                            <option value="Thailand" <?php if ($live_country == "Thailand")
                                                                                echo "selected"; ?> label="Thailand">Thailand</option>
                                                                            <option value="Timor-Leste" <?php if ($live_country == "Timor-Leste")
                                                                                echo "selected"; ?> label="Timor-Leste">Timor-Leste</option>
                                                                            <option value="Turkey" <?php if ($live_country == "Turkey")
                                                                                echo "selected"; ?> label="Turkey">Turkey</option>
                                                                            <option value="Turkmenistan"  <?php if ($live_country == "Turkmenistan")
                                                                                echo "selected"; ?> label="Turkmenistan">Turkmenistan</option>
                                                                            <option value="United Arab Emirates" <?php if ($live_country == "United Arab Emirates")
                                                                                echo "selected"; ?> label="United Arab Emirates">United Arab Emirates</option>
                                                                            <option value="Uzbekistan" <?php if ($live_country == "Uzbekistan")
                                                                                echo "selected"; ?> label="Uzbekistan">Uzbekistan</option>
                                                                            <option value="Vietnam" <?php if ($live_country == "Vietnam")
                                                                                echo "selected"; ?> label="Vietnam">Vietnam</option>
                                                                            <option value="Yemen" <?php if ($live_country == "Yemen")
                                                                                echo "selected"; ?> label="Yemen">Yemen</option>
                                                                        </optgroup>
                                                                        <optgroup label="EUROPE">
                                                                            <option value="Albania" <?php if ($live_country == "Andorra")
                                                                                echo "selected"; ?> label="Andorra">Andorra</option>
                                                                            <option value="Andorra" <?php if ($live_country == "Albania")
                                                                                echo "selected"; ?> label="Albania">Albania</option>
                                                                            <option value="Austria" <?php if ($live_country == "Austria")
                                                                                echo "selected"; ?> label="Austria">Austria</option>
                                                                            <option value="Belarus" <?php if ($live_country == "Belarus")
                                                                                echo "selected"; ?> label="Belarus">Belarus</option>
                                                                            <option value="Belgium" <?php if ($live_country == "Belgium")
                                                                                echo "selected"; ?> label="Belgium">Belgium</option>
                                                                            <option value="Bosnia and Herzegovina" <?php if ($live_country == "Bosnia and Herzegovina")
                                                                                echo "selected"; ?> label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                            <option value="Bulgaria" <?php if ($live_country == "Bulgaria")
                                                                                echo "selected"; ?> label="Bulgaria">Bulgaria</option>
                                                                            <option value="Croatia" <?php if ($live_country == "Croatia")
                                                                                echo "selected"; ?> label="Croatia">Croatia</option>
                                                                            <option value="Cyprus" <?php if ($live_country == "Cyprus")
                                                                                echo "selected"; ?> label="Cyprus">Cyprus</option>
                                                                            <option value="Czech Republic" <?php if ($live_country == "Czech Republic")
                                                                                echo "selected"; ?> label="Czech Republic">Czech Republic</option>
                                                                            <option value="Denmark" <?php if ($live_country == "Denmark")
                                                                                echo "selected"; ?> label="Denmark">Denmark</option>
                                                                            <option value="East Germany" <?php if ($live_country == "East Germany")
                                                                                echo "selected"; ?> label="East Germany">East Germany</option>
                                                                            <option value="Estonia" <?php if ($live_country == "Estonia")
                                                                                echo "selected"; ?> label="Estonia">Estonia</option>
                                                                            <option value="Faroe Islands" <?php if ($live_country == "Faroe Islands")
                                                                                echo "selected"; ?> label="Faroe Islands">Faroe Islands</option>
                                                                            <option value="Finland" <?php if ($live_country == "Finland")
                                                                                echo "selected"; ?> label="Finland">Finland</option>
                                                                            <option value="France" <?php if ($live_country == "France")
                                                                                echo "selected"; ?> label="France">France</option>
                                                                            <option value="Germany" <?php if ($live_country == "Germany")
                                                                                echo "selected"; ?> label="Germany">Germany</option>
                                                                            <option value="Gibraltar" <?php if ($live_country == "Gibraltar")
                                                                                echo "selected"; ?> label="Gibraltar">Gibraltar</option>
                                                                            <option value="Greece" <?php if ($live_country == "Greece")
                                                                                echo "selected"; ?> label="Greece">Greece</option>
                                                                            <option value="Guernsey" <?php if ($live_country == "Guernsey")
                                                                                echo "selected"; ?> label="Guernsey">Guernsey</option>
                                                                            <option value="Hungary" <?php if ($live_country == "Hungary")
                                                                                echo "selected"; ?> label="Hungary">Hungary</option>
                                                                            <option value="Iceland" <?php if ($live_country == "Iceland")
                                                                                echo "selected"; ?> label="Iceland">Iceland</option>
                                                                            <option value="Ireland" <?php if ($live_country == "Ireland")
                                                                                echo "selected"; ?> label="Ireland">Ireland</option>
                                                                            <option value="Isle of Man" <?php if ($live_country == "Isle of Man")
                                                                                echo "selected"; ?> label="Isle of Man">Isle of Man</option>
                                                                            <option value="Italy" <?php if ($live_country == "Italy")
                                                                                echo "selected"; ?> label="Italy">Italy</option>
                                                                            <option value="Jersey" <?php if ($live_country == "Jersey")
                                                                                echo "selected"; ?> label="Jersey">Jersey</option>
                                                                            <option value="Latvia" <?php if ($live_country == "Latvia")
                                                                                echo "selected"; ?> label="Latvia">Latvia</option>
                                                                            <option value="Liechtenstein" <?php if ($live_country == "Liechtenstein")
                                                                                echo "selected"; ?> label="Liechtenstein">Liechtenstein</option>
                                                                            <option value="Lithuania" <?php if ($live_country == "Lithuania")
                                                                                echo "selected"; ?> label="Lithuania">Lithuania</option>
                                                                            <option value="Luxembourg" <?php if ($live_country == "Luxembourg")
                                                                                echo "selected"; ?> label="Luxembourg">Luxembourg</option>
                                                                            <option value="Macedonia" <?php if ($live_country == "Macedonia")
                                                                                echo "selected"; ?> label="Macedonia">Macedonia</option>
                                                                            <option value="Malta" <?php if ($live_country == "Malta")
                                                                                echo "selected"; ?> label="Malta">Malta</option>
                                                                            <option value="Metropolitan France" <?php if ($live_country == "Metropolitan France")
                                                                                echo "selected"; ?> label="Metropolitan France">Metropolitan France</option>
                                                                            <option value="Moldova" <?php if ($live_country == "Moldova")
                                                                                echo "selected"; ?> label="Moldova">Moldova</option>
                                                                            <option value="Monaco" <?php if ($live_country == "Monaco")
                                                                                echo "selected"; ?> label="Monaco">Monaco</option>
                                                                            <option value="Montenegro" <?php if ($live_country == "Montenegro")
                                                                                echo "selected"; ?> label="Montenegro">Montenegro</option>
                                                                            <option value="Netherlands" <?php if ($live_country == "Netherlands")
                                                                                echo "selected"; ?> label="Netherlands">Netherlands</option>
                                                                            <option value="Norway" <?php if ($live_country == "Norway")
                                                                                echo "selected"; ?> label="Norway">Norway</option>
                                                                            <option value="Poland" <?php if ($live_country == "Poland")
                                                                                echo "selected"; ?> label="Poland">Poland</option>
                                                                            <option value="Portugal" <?php if ($live_country == "Portugal")
                                                                                echo "selected"; ?> label="Portugal">Portugal</option>
                                                                            <option value="Romania" <?php if ($live_country == "Romania")
                                                                                echo "selected"; ?> label="Romania">Romania</option>
                                                                            <option value="Russia" <?php if ($live_country == "Russia")
                                                                                echo "selected"; ?> label="Russia">Russia</option>
                                                                            <option value="Sann Marino" <?php if ($live_country == "Sann Marino")
                                                                                echo "selected"; ?> label="San Marino">San Marino</option>
                                                                            <option value="Serbia" <?php if ($live_country == "Serbia")
                                                                                echo "selected"; ?> label="Serbia">Serbia</option>
                                                                            <option value="Serbia and Montenegro" <?php if ($live_country == "Serbia and Montenegro")
                                                                                echo "selected"; ?> label="Serbia and Montenegro">Serbia and Montenegro</option>
                                                                            <option value="Slovakia" <?php if ($live_country == "Slovakia")
                                                                                echo "selected"; ?> label="Slovakia">Slovakia</option>
                                                                            <option value="Slovenia" <?php if ($live_country == "Slovenia")
                                                                                echo "selected"; ?> label="Slovenia">Slovenia</option>
                                                                            <option value="Spain" <?php if ($live_country == "Spain")
                                                                                echo "selected"; ?> label="Spain">Spain</option>
                                                                            <option value="Svalbard and Jan Mayen" <?php if ($live_country == "Svalbard and Jan Mayen")
                                                                                echo "selected"; ?> label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                                            <option value="Sweden" <?php if ($live_country == "Sweden")
                                                                                echo "selected"; ?> label="Sweden">Sweden</option>
                                                                            <option value="Switzerland" <?php if ($live_country == "Switzerland")
                                                                                echo "selected"; ?> label="Switzerland">Switzerland</option>
                                                                            <option value="Ukraine" <?php if ($live_country == "Ukraine")
                                                                                echo "selected"; ?> label="Ukraine">Ukraine</option>
                                                                            <option value="Union of Soviet Socialist Republics" <?php if ($live_country == "Union of Soviet Socialist Republics")
                                                                                echo "selected"; ?> label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                                                            <option value="United Kingdom" <?php if ($live_country == "United Kingdom")
                                                                                echo "selected"; ?> label="United Kingdom">United Kingdom</option>
                                                                            <option value="Vatican City" <?php if ($live_country == "Vatican City")
                                                                                echo "selected"; ?> label="Vatican City">Vatican City</option>
                                                                            <option value="Åland Islands" <?php if ($live_country == "Åland Islands")
                                                                                echo "selected"; ?> label="Åland Islands">Åland Islands</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="checkbox-custom checkbox-primary">
                                                                <input type="checkbox" id="check-s1" name="rqth" <?php if ($rqth)
                                                                    echo "checked"; ?>>
                                                                <label class="check" for="check-s1"><?php echo rqth; ?></label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                
                                                <?php if ($state == 0) { ?>
                                                        <button type="submit" name="valider_profil" class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.."><?php echo enregistrer; ?></button>
                                                <?php } else { ?>
                                                        <button type="button" class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." disabled><?php echo enregistrer; ?></button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="datas">
                                    <?php
                                    if ($isDataComplete) {
                                        ?>
                                        <div class="alert alert-success fade in">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                            <strong><?php echo complete_data; ?></strong>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-danger fade in">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                            <strong><?php echo uncomplete_data; ?></strong> <?php echo data_unvalide; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                <form id="inline-validation needs-validation" class="form-horizontal" method="post" action="dossier.php?id_d=<?php echo $id_dossier; ?>&id_i=<?php echo $id_intervenant; ?>">
                                    <div class="panel">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="f_name" class="col-sm-3 control-label"><?php echo remuneration; ?><span class="required">*</span></label>
                                                        <div class="col-sm-6">
                                                            <?php if ($state == 0 && $_SESSION["acreditation"] == "SM") { ?>
                                                                    <select name="remun" class="form-control" style="width: 100%">
                                                            <?php } else { ?>
                                                                    <select name="remun" class="form-control" style="width: 100%">
                                                            <?php } ?>
                                                                <option value="">---<?php echo remuneration; ?>---</option>
                                                      <option value="Vacation" label="<?php echo salaire; ?>" <?php if ($remuneration == "Vacation")
                                                             echo "selected"; ?>>Vacation</option>
                                                      <option value="Facture" label="<?php echo facture; ?>" <?php if ($remuneration == "Facture")
                                                             echo "selected"; ?>>Facture</option>
                                                      <option value="titre-gracieux" label="Titre gracieux" <?php if ($Dossiers->get("remuneration", $id_dossier) == "titre-gracieux")
                                                          echo "selected"; ?>>Titre gracieux</option>
                                                            </select>
                                                        </div>
                                                    </div><?php if ($remuneration == "Facture") { ?>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">N° d'identification (SIREN ou autre) :<span class="required">*</span></label>
                                                            <div class="col-sm-6">
                                                         
                                                                    <input name="siren" id="siren" class="form-control" value="<?php echo $siret; ?>" required>
                                                         
                                                            </div>
                                                        </div>
                                                    
                                                         <div class="form-group">
                                                            <label class="col-sm-3 control-label">Nom de la structure <span class="required">*</span></label>
                                                            <div class="col-sm-6">
                                                       
                                                                    <input name="nomStructure" id="nomStructure" class="form-control" value="<?php echo $nomStructure; ?>" required>
                                                           
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    
                                                    
                                                    <?php if ($remuneration == "Vacation") { ?>
                                                        <div class="form-group">
                                                            <label for="f_name" class="col-sm-3 control-label"><?php echo soc_state; ?><span class="required">*</span></label>
                                                            <div class="col-sm-6">
                                                                <?php if ($state == 0) { ?>
                                                                    <select name="state" class="form-control" style="width: 100%">
                                                                <?php } else { ?>
                                                                    <select name="state" class="form-control" style="width: 100%">
                                                                <?php } ?>
                                                                    <option value="">---<?php echo soc_state; ?>---</option>
                                                                    <option value="Salarie du secteur public" label="Salarié du secteur public" <?php if ($statut_soc == "Salarie du secteur public")
                                                                        echo "selected"; ?>></option>
                                                                    <option value="Salarie du secteur privee" label="Salarié du secteur privée" <?php if ($statut_soc == "Salarie du secteur privee")
                                                                        echo "selected"; ?>></option>
                                                                    <option value="Etudiant" label="Etudiant" <?php if ($statut_soc == "Etudiant")
                                                                        echo "selected"; ?>></option>
                                                                    <option value="Retraite" label="Retraité" <?php if ($statut_soc == "Retraite")
                                                                        echo "selected"; ?>></option>
                                                                    <option value="Sans emploi" label="Sans emploi" <?php if ($statut_soc == "Sans emploi")
                                                                        echo "selected"; ?>></option>
                                                                    <option value="Artiste/Auteur" label="Artiste/Auteur" <?php if ($statut_soc == "Artiste/Auteur")
                                                                        echo "selected"; ?>></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                     <?php } ?>

                                                    <?php if ($statut_soc == "Salarie du secteur public") { ?>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label"><?php echo name_employeur; ?><span class="required">*</span></label>
                                                            <div class="col-sm-6">
                                                                <?php if ($state == 0) { ?>
                                                                        <input name="name_employeur" id="name_employeur" type="text" class="form-control" value="<?php echo $name_employeur; ?>">
                                                                <?php } else { ?>
                                                                        <input name="name_employeur" id="name_employeur" type="text" class="form-control" value="<?php echo $name_employeur; ?>" disabled>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-9">
                                                            <button type="submit" name="modif_remun" class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.."><?php echo modif; ?></button>
                                                        </div>
                                                    </div>
                                                 

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="files">
                                
                                <?php
                                if ($Files->exist("SS", $id_intervenant, $id_dossier) && $Files->exist("RIB", $id_intervenant, $id_dossier) && $Files->exist("CI", $id_intervenant, $id_dossier) && (($Files->exist("CE", $id_intervenant, $id_dossier) && $statut_soc == "Salarie du secteur public") || $statut_soc != "Salarie du secteur public") && (($Files->exist("SE", $id_intervenant, $id_dossier) && $statut_soc == "Sans emploi") || $statut_soc != "Sans emploi")) {
                                    ?>
                                        <div class="alert alert-success fade in">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                            <strong><?php echo complete_data; ?></strong>
                                        </div>
                                        <?php
                                } else {
                                    ?>
                                        <div class="alert alert-danger fade in">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                            <strong><?php echo uncomplete_data; ?></strong> <?php echo data_unvalide; ?>
                                        </div>
                                        <?php
                                }
                                ?>
                                <div class="input-group">
                                    <?php
                                    if ($Files->exist("RIB", $id_intervenant, $id_dossier)) {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" id="download_rib" type="button">RIB</button>
                                            </span>
                                            <input id="RIB"  type="file" accept="image/*,.pdf" name="RIB" class="upload_input" disabled/>
                                            <input type="text" value="<?php echo $rib_name; ?>"  class="form-control" disabled />
                                            <?php if ($state == 0) { ?>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." id="delete_RIB" style="width: min-width;">X</button>
                                                    </span>
                                            <?php } ?>
                                    
                                    <?php
                                    } else {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-choose" type="button">RIB</button>
                                            </span>
                                            <input id="RIB"  type="file" accept="image/*,.pdf" name="RIB" class="upload_input"/>
                                            <input type="text" class="form-control" placeholder='Choose a file...' />
                                            <span class="input-group-btn">
                                                <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_RIB">Upload RIB</button>
                                            </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="input-group">
                                    <?php
                                    if ($Files->exist("SS", $id_intervenant, $id_dossier)) {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" id="download_ss" type="button"><?php echo social_sec; ?></button>
                                            </span>
                                            <input id="SS-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="SS" class="upload_input" disabled/>
                                            <input type="text" value="<?php echo $ss_name; ?>"  class="form-control" disabled />
                                            <?php if ($state == 0) { ?>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." id="delete_SS" style="width: min-width;">X</button>
                                                    </span>
                                            <?php } ?>
                                    <?php
                                    } else {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-choose" type="button"><?php echo social_sec; ?></button>
                                            </span>
                                            <input id="SS-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="SS" class="upload_input"/>
                                            <input type="text" class="form-control" placeholder='Choose a file...' />
                                            <span class="input-group-btn">
                                                <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_SS">Upload <?php echo social_sec; ?></button>
                                            </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="input-group">
                                    <?php
                                    if ($Files->exist("CI", $id_intervenant, $id_dossier)) {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" id="download_ci" type="button"><?php echo ci; ?></button>
                                            </span>
                                            <input id="CI-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="CI" class="upload_input" disabled/>
                                            <input type="text" value="<?php echo $ci_name; ?>"  class="form-control" disabled />
                                            <?php if ($state == 0) { ?>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." id="delete_CI" style="width: min-width;">X</button>
                                                    </span>
                                            <?php } ?>
                                    <?php
                                    } else {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-choose" type="button"><?php echo ci; ?></button>
                                            </span>
                                            <input id="CI-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="CI" class="upload_input"/>
                                            <input type="text" class="form-control" placeholder='Choose a file...' />
                                            <span class="input-group-btn">
                                                <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_CI">Upload <?php echo ci; ?></button>
                                            </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                
                                <?php
                                if ($statut_soc == "Salarie du secteur public") {
                                    ?>

                                    <div class="input-group">
                                        <?php
                                        if ($Files->exist("CE", $id_intervenant, $id_dossier)) {
                                            ?>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" id="download_ce" type="button"><?php echo ce; ?></button>
                                                </span>
                                                <input id="CE-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="CE" class="upload_input" disabled/>
                                                <input type="text" value="<?php echo $ce_name; ?>"  class="form-control" disabled />
                                                <?php if ($state == 0) { ?>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." id="delete_CE" style="width: min-width;">X</button>
                                                        </span>
                                                <?php } ?>
                                        <?php
                                        } else {
                                            ?>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default btn-choose" type="button"><?php echo ce; ?></button>
                                                </span>
                                                <input id="CE-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="CE" class="upload_input"/>
                                                <input type="text" class="form-control" placeholder='Choose a file...' />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_CE">Upload <?php echo ce; ?></button>
                                                </span>
                                        <?php
                                        }
                                        ?>
                                        </div>
                                    <?php
                                }
                                ?>
                                    
                                <?php
                                if ($statut_soc == "Sans emploi") {
                                    ?>

                                    <div class="input-group">
                                        <?php
                                        if ($Files->exist("SE", $id_intervenant, $id_dossier)) {
                                            ?>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" id="download_se" type="button">Attestation de sans enploi</button>
                                                </span>
                                                <input id="SE-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="SE" class="upload_input" disabled/>
                                                <input type="text" value="<?php echo $se_name; ?>"  class="form-control" disabled />
                                                <?php if ($state == 0) { ?>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." id="delete_SE" style="width: min-width;">X</button>
                                                        </span>
                                                <?php } ?>
                                        <?php
                                        } else {
                                            ?>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default btn-choose" type="button">Attestation de sans enploi</button>
                                                </span>
                                                <input id="SE-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="SE" class="upload_input"/>
                                                <input type="text" class="form-control" placeholder='Choose a file...' />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_SE">Upload attestation de sans enploi</button>
                                                </span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                
                                <?php
                                }
                                ?>

                                <br><h4>Fichiers administratifs</h4>

                                
                                <div class="input-group">
                                    <input id="FILE-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="FILE" class="upload_input"/>
                                    <input type="text" class="form-control" placeholder='Choose a file...' />
                                    <span class="input-group-btn">
                                        <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_FILE">Upload new file</button>
                                    </span>
                                </div>

                                <?php
                                foreach ($files as $file) { ?>
                                            <div class="input-group">
                                                <?php
                                                $i = 0;
                                                $ret = '';
                                                foreach ($file as $element) {
                                                    if ($i == 1)
                                                        $name = $element;
                                                    if ($i == 2) {
                                                        $real_name = $element;
                                                        $ret = '<input type="text" value="' . $element . '"  class="form-control" disabled />';
                                                    }
                                                    $i++;
                                                } ?>
                                                <span class="input-group-btn">
                                                    <button onClick="download_admin_file('<?php echo addslashes($name); ?>','<?php echo addslashes($real_name); ?>');" class="download_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">Download</button>
                                                </span>
                                                <input type="file" accept="image/*,.pdf" name="FILE" class="upload_input" style="display: none;" disabled/>
                                                <?php echo $ret; ?>
                                                <span class="input-group-btn">
                                                    <button onClick="delete_admin_file('<?php echo addslashes($name); ?>')" class="delete_FILE btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                                                </span>
                                            </div>
                                            <?php
                                } ?>


                            </div>
                            <div class="tab-pane fade" id="folder">
                            <h3>Interventions</h3>
                                <?php
                                if ($interventions->num_rows > 0) {
                                    ?>
                                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <?php
                                            $i = 0;
                                            foreach (array_keys($interventions->fetch_assoc()) as $element) {
                                                if ($i != 7)
                                                    echo "<th>" . $element . "</th>";
                                                $i++;
                                            }
                                            echo "<th>Modifications</th>";
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($interventions as $row) {
                                            $i = 0;
                                            echo "<tr>";
                                            foreach ($row as $element) {
                                                if ($i == 6)
                                                    $statut_interv = $element;
                                                if ($i != 7)
                                                    echo "<td>" . $element . "</td>";
                                                $i++;
                                            }
                                            if (($state == 0 || $state == 1) && ($_SESSION["acreditation"] == "SM" || $_SESSION["acreditation"] == "RH"))
                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='intervention(" . $row["id"] . ");' style='margin-right: 5px; '><i class='fa fa-edit'></i></button><button onClick='delete_intervention(" . $row["id"] . ");' class='btn btn-o btn-danger btn-xs'><i class='fa fa-trash'></i></button></td>";
                                            else if ($statut_interv == "Programmée")
                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='update_sfc(" . $row["id"] . ");' style='margin-right: 5px; '>Service fait constaté</button><button onClick='update_a(" . $row["id"] . ");' class='btn btn-o btn-danger btn-xs'>Annulée</button></td>";
                                            else if ($statut_interv == "Service fait constaté" && $_SESSION["acreditation"] == "RH")
                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='update_sfv(" . $row["id"] . ");' style='margin-right: 5px; '>Service fait validé</button></td>";
                                            else if ($statut_interv == "Service fait validé" && $_SESSION["acreditation"] == "RH")
                                                echo "<td><button class='btn btn-o btn-success btn-xs' onClick='update_p(" . $row["id"] . ");' style='margin-right: 5px; '>Payée</button></td>";
                                            else
                                                echo "<td><button class='btn btn-o btn-success btn-xs' style='margin-right: 5px; ' disabled><i class='fa fa-edit'></i></button><button class='btn btn-o btn-danger btn-xs' disabled><i class='fa fa-trash'></i></button></td>";
                                            echo "</tr>";
                                        } ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                    ?>
                                    <h4><em><?php echo no_inter; ?></em></h4>
                                <?php
                                }
                                ?>
                                <?php if (($state == 0 || $state == 1) && ($_SESSION["acreditation"] == "SM" || $_SESSION["acreditation"] == "RH")) { ?>
                                        <button type="button" class="btn btn-wide btn-success" onclick="location.href='form_intervention.php?id=<?php echo $id_dossier; ?>'"><?php echo intervention_créer; ?></button>
                                <?php } else { ?>
                                        <button type="button" class="btn btn-wide btn-success" disabled><?php echo intervention_créer; ?></button>
                                <?php } ?>
                            </div>
                             <div class="tab-pane fade" id="contrat">
                             <h4>Étape 1</h4>
                         <?php //echo "Rem : ".$remuneration;?>
                         
                             <?php
                             if ($state == 1) { ?>
                             
                             
                                 Le contrat n'a pas encore été validé par le service RH.
                                 
                              <?php } else if ($state > 1) { ?>
                                            <?php if ($remuneration == "Vacation") { ?>
                                                  Contrat de vacation sans signature : 
                                                    <button onClick="generatePDF();" class="btn btn-danger btn-o"  display: inline-block"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                     <?php } else if ($remuneration == "Facture") { ?>
                                                         Lettre de mission sans signature : 
                                                        <button onClick="generatePDFFacture();" class="btn btn-danger btn-o"  display: inline-block"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                    <?php } else if ($remuneration == "titre-gracieux") { ?>
                                                          <strong>ATTENTION </strong> convention d'accueil à titre gracieux : 
                                                            <button onClick="generatePDFGracieuxProvisoire();" class="btn btn-danger btn-o"  display: inline-block"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                     <?php } ?>
                                     
                         <?php } ?>

                             <hr>
                             <h4>Étape 2</h4>
                              <div class="input-group">
                                    <?php
                                    if ($Files->exist("CONTRAT1", $id_intervenant, $id_dossier)) {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" id="download_contrat1" type="button">Contrat signé par l'ENSP</button>
                                            </span>
                                            <input id="CONTRAT1-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="CONTRAT1" class="upload_input" disabled/>
                                            <input type="text" value="<?php echo $contrat1_name; ?>"  class="form-control" disabled />
                                       
                                                <span class="input-group-btn">
                                                    <button class="btn btn-wide btn-loading btn-danger" data-loading-text="please wait.." id="delete_CONTRAT1" style="width: min-width;">X</button>
                                                </span>
                                       
                                    <?php
                                    } else {
                                        ?>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-choose" type="button">Contrat signé par l'ENSP</button>
                                            </span>
                                            <input id="CONTRAT1-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="CONTRAT1" class="upload_input"/>
                                            <input type="text" class="form-control" placeholder='Choisir un fichier...' />
                                            <span class="input-group-btn">
                                                <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_CONTRAT1">Téléverser le contrat</button>
                                            </span>
                                    <?php
                                    }
                                    ?>
                                  
                                </div>
                                
                                  <hr>
                             <h4>Étape 3</h4>
                             <br>
                                    <?php
                                    if ($Files->exist("CONTRAT2", $id_intervenant, $id_dossier)) {
                                        ?>
                                   
                                        <span class="input-group-btn">
                                                <button class="btn btn-primary" id="download_contrat2" type="button">Contrat signé par l'intervenant</button>
                                        </span>
                                    
                                      <?php
                                    } else {
                                        ?>
                                    
                                        L'intervenant n'a pas encore signé ou téléversé son contrat.
                                        <br><br>
                                        <div class="input-group">

                                        <span class="input-group-btn">
                                                <button class="btn btn-default btn-choose" type="button">Contrat signé par l'intervenant</button>
                                            </span>
                                            <input id="CONTRAT2-<?php echo lg; ?>"  type="file" accept="image/*,.pdf" name="CONTRAT2" class="upload_input"/>
                                            <input type="text" class="form-control" placeholder='Choisir un fichier...' />
                                            <span class="input-group-btn">
                                                <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." id="upload_CONTRAT2">Téléverser le contrat</button>
                                            </span>
                                        
                                        </div>
                                    
                                    <?php } ?>
                                    
                                     <hr>
                                    <?php if ($remuneration == "Vacation") { ?>
                                    
                                    
                                         <h4>Titre gracieux</h4>
                                          <strong>ATTENTION </strong> convention d'accueil à titre gracieux : 
                                            <button onClick="generatePDFGracieuxProvisoire();" class="btn btn-danger btn-o"  display: inline-block"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                 <?php } ?>
                                    
                                    
                             </div>
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

<!--seewtaler-->
<script src="../vendor/sweetalert/sweetalert.min.js"></script>
<!--examples-->
<script src="../assets/js/examples/ui-elements/alerts.js"></script>
<!--CP and city-->
<script src="../vendor/vicopo/vicopo.min.js"></script>
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
    #SS-fr {
        width:calc(100% - 397.73px);
    }
    #SS-en {
        width:calc(100% - 344.77px);
    }
    #CE-fr {
        width:calc(100% - 271.49px);
    }
    #CE-en {
        width:calc(100% - 286.7px);
    }
    #CI-fr {
        width:calc(100% - 167.98px);
    }
    #CI-en {
        width:calc(100% - 150.52px);
    }
    #SE-fr {
        width:calc(100% - 237.7px);
    }
    #SE-en {
        width:calc(100% - 237.7px);
    }
    ::-webkit-file-upload-button {
        cursor:pointer;
    }
</style>
<script>
$("#phone-number").inputmask("+99 9 99 99 99 99",{ "onincomplete": function(){ document.getElementById("phone-message").style.display='block'; document.getElementById("phone-message-valid").style.display='none'}, "oncomplete": function(){ document.getElementById("phone-message").style.display='none'; document.getElementById("phone-message-valid").style.display='block'} });
    (function() {
  'use strict';
})();
 $(".upload_input").each(function(index) {
        $(this).on('change', function(){  
            $(this).next('input').val($(this).val());
        });
    });
$('#unvalide_folder').on('click', function () {
        swal({
                title: "<?php echo swal6; ?>",
                text: "<?php echo swal7; ?>",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "<?php echo swal8; ?>"
            },
            function(inputValue){
                if (inputValue === false) return false;

                if (inputValue === "") {
                    swal.showInputError("<?php echo swal9; ?>");
                    return false
                }

                $.post('dossier.php?id_d=<?php echo $id_dossier; ?>&id_i=<?php echo $id_intervenant; ?>',
                {
                    unvalid_dossier: 'unvalid_dossier',
                    message_input: inputValue
                }, function(data) {
                    swal("<?php echo swal10; ?>", "<?php echo swal11; ?>", "success");
                    window.location.reload();
                    return true;
                }
                );
                

            });
    });

    $('#archive_folder').on('click', function () {
        swal({
                title: "<?php echo swal15; ?>",
                text: "<?php echo swal16; ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo swal17; ?>",
                closeOnConfirm: false
            },
            function(){
                swal("<?php echo swal18; ?>", "<?php echo swal19; ?>", "success");
                window.location = "Controller/Ajax/archive_dossier.php?id=<?php echo $id_dossier; ?>";
            });
    });
    
    $('#retour_folder').on('click', function () {
        swal({
                title: "<?php echo swal20; ?>",
                text: "<?php echo swal21; ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo swal22; ?>",
                closeOnConfirm: false
            },
            function(){
                swal("<?php echo swal23; ?>", "<?php echo swal24; ?>", "success");
                window.location = "Controller/Ajax/retour_dossier.php?id=<?php echo $id_dossier; ?>";
            });
    });


$(function(){
    "use strict";
    //DATATABLE
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $('.data-table').DataTable({});
});

<?php if ($Files->exist("RIB", $id_intervenant, $id_dossier)) { ?>
        $('#download_rib').on('click', function() {
            //window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $rib_name_hash; ?>&real_name=<?php echo $rib_name; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
            window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $rib_name_hash; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';

        });
<?php } ?>


<?php if ($Files->exist("SS", $id_intervenant, $id_dossier)) { ?>
        $('#download_ss').on('click', function() {
                window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $ss_name_hash; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
        });
    <?php } ?>


    <?php if ($Files->exist("CI", $id_intervenant, $id_dossier)) { ?>
        $('#download_ci').on('click', function() {
                window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $ci_name_hash; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
        });
    <?php } ?>

<?php if ($Files->exist("CE", $id_intervenant, $id_dossier)) { ?>
        $('#download_ce').on('click', function() {
                window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $ce_name_hash; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
        });
    <?php } ?>
    
<?php if ($Files->exist("SE", $id_intervenant, $id_dossier)) { ?>
        $('#download_se').on('click', function() {
                window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $se_name_hash; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
        });
    <?php } ?>

<?php if ($Files->exist("CONTRAT1", $id_intervenant, $id_dossier)) { ?>
        $('#download_contrat1').on('click', function() {
                window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $contrat1_name_hash; ?>&real_name=<?php echo $contrat1_name; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
        });
    <?php } ?>

<?php if ($Files->exist("CONTRAT2", $id_intervenant, $id_dossier)) { ?>
        $('#download_contrat2').on('click', function() {
                window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name=<?php echo $contrat2_name_hash; ?>&real_name=<?php echo $contrat2_name; ?>&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
        });
    <?php } ?>
function download_admin_file(name, real_name) {
    //window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name='+name+'&real_name='+real_name+'&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';
    window.location = 'Controller/Ajax/download_file.php?id_intervenant=<?php echo $id_intervenant; ?>&id_folder=<?php echo $id_dossier; ?>&name='+name+'&key=<?php echo $User->get("personnal_key", $id_intervenant); ?>';

}

<?php if (!$Files->exist("RIB", $id_intervenant, $id_dossier)) { ?>
        $('#upload_RIB').on('click', function() {
        var file_data = $('#RIB').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "RIB");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');
        $.ajax({
            url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Enregistré !")
                    document.location.reload();
                else
                    alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
            }
         });
    });
<?php } else { ?>
        document.getElementById("RIB").style.display="none";
    $('#delete_RIB').on('click', function() {
        var form_data = new FormData();
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "RIB");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);    
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');  
        $.ajax({
            url: 'Controller/Ajax/delete_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Supprimé !")
                    document.location.reload();
                else
                    alert(php_script_response); // display response from the PHP script, if any
            }
         });
    });
<?php } ?>


<?php if (!$Files->exist("SS", $id_intervenant, $id_dossier)) { ?>
    $('#upload_SS').on('click', function() {
        var file_data = $('#SS-<?php echo lg; ?>').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "SS");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);    
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');  
        $.ajax({
            url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Enregistré !")
                    document.location.reload();
                else
                    alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
            }
         });
    });
<?php } else { ?>
        document.getElementById("SS-<?php echo lg; ?>").style.display="none";
        $('#delete_SS').on('click', function() {
        var form_data = new FormData();
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "SS");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);   
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');   
        $.ajax({
            url: 'Controller/Ajax/delete_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Supprimé !")
                    document.location.reload();
                else
                    alert(php_script_response); // display response from the PHP script, if any
            }
         });
    });
<?php } ?>


<?php if (!$Files->exist("CI", $id_intervenant, $id_dossier)) { ?>
    $('#upload_CI').on('click', function() {
        var file_data = $('#CI-<?php echo lg; ?>').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CI");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);    
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');  
        $.ajax({
            url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Enregistré !")
                    document.location.reload();
                else
                    alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
            }
         });
    });
<?php } else { ?>
        document.getElementById("CI-<?php echo lg; ?>").style.display="none";
        $('#delete_CI').on('click', function() {
        var form_data = new FormData();
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CI");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');    
        $.ajax({
            url: 'Controller/Ajax/delete_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Supprimé !")
                    document.location.reload();
                else
                    alert(php_script_response); // display response from the PHP script, if any
            }
         });
    });
    <?php } ?>
 
/*-------------- CONTRAT1 --------------------------------------------*/   
<?php if (!$Files->exist("CONTRAT1", $id_intervenant, $id_dossier)) { ?>
    $('#upload_CONTRAT1').on('click', function() {
        var file_data = $('#CONTRAT1-<?php echo lg; ?>').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CONTRAT1");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);    
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');  
        $.ajax({
            url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Enregistré !"){
                        window.location = "Controller/Ajax/sendMailContrat.php?email=<?php echo $member_email; ?>";
                        document.location.reload();
                        }
                else {
                    alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
                    }
            }
         });
    });
<?php } else { ?>
        document.getElementById("CONTRAT1-<?php echo lg; ?>").style.display="none";
        $('#delete_CONTRAT1').on('click', function() {
        var form_data = new FormData();
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CONTRAT1");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');    
        $.ajax({
            url: 'Controller/Ajax/delete_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Supprimé !")
                    document.location.reload();
                else
                    alert(php_script_response); // display response from the PHP script, if any
            }
         });
    });
<?php } ?>


/*-------------- CONTRAT2 --------------------------------------------*/   
<?php if (!$Files->exist("CONTRAT2", $id_intervenant, $id_dossier)) { ?>
    $('#upload_CONTRAT2').on('click', function() {
        var file_data = $('#CONTRAT2-<?php echo lg; ?>').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CONTRAT2");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);    
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');  
        $.ajax({
            url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Enregistré !"){
                        window.location = "Controller/Ajax/sendMailContrat.php?email=<?php echo $member_email; ?>";
                        document.location.reload();
                        }
                else {
                    alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
                    }
            }
         });
    });
<?php } else { ?>
        //document.getElementById("CONTRAT2-<?php echo lg; ?>").style.display="none";
        $('#delete_CONTRAT2').on('click', function() {
        var form_data = new FormData();
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CONTRAT2");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');    
        $.ajax({
            url: 'Controller/Ajax/delete_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Supprimé !")
                    document.location.reload();
                else
                    alert(php_script_response); // display response from the PHP script, if any
            }
         });
    });
<?php } ?>

<?php if (!$Files->exist("CE", $id_intervenant, $id_dossier)) { ?>
    $('#upload_CE').on('click', function() {
        var file_data = $('#CE-<?php echo lg; ?>').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CE");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');
        $.ajax({
            url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Enregistré !")
                    document.location.reload();
                else
                    alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
            }
         });
    });
<?php } else { ?>
        document.getElementById("CE-<?php echo lg; ?>").style.display="none";
        $('#delete_CE').on('click', function() {
        var form_data = new FormData();
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "CE");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');
        $.ajax({
            url: 'Controller/Ajax/delete_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Supprimé !")
                    document.location.reload();
                else
                    alert(php_script_response); // display response from the PHP script, if any
            }
         });
    });
    <?php } ?>
    <?php if (!$Files->exist("SE", $id_intervenant, $id_dossier)) { ?>
    $('#upload_SE').on('click', function() {
        var file_data = $('#SE-<?php echo lg; ?>').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "SE");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');
        $.ajax({
            url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Enregistré !")
                    document.location.reload();
                else
                    alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
            }
         });
    });
<?php } else { ?>
        document.getElementById("SE-<?php echo lg; ?>").style.display="none";
        $('#delete_SE').on('click', function() {
        var form_data = new FormData();
        form_data.append('id_user', <?php echo $id_intervenant; ?>);  
        form_data.append('correspondance', "SE");
        form_data.append('id_dossier', <?php echo $id_dossier; ?>);
        form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');
        $.ajax({
            url: 'Controller/Ajax/delete_file.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                if(php_script_response=="Supprimé !")
                    document.location.reload();
                else
                    alert(php_script_response); // display response from the PHP script, if any
            }
         });
    });
    <?php } ?>
$('#upload_FILE').on('click', function() {
    var file_data = $('#FILE-<?php echo lg; ?>').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('id_user', <?php echo $id_intervenant; ?>);  
    form_data.append('correspondance', "FILE");
    form_data.append('id_dossier', <?php echo $id_dossier; ?>);
    form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');
    $.ajax({
        url: 'Controller/Ajax/upload_file.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            if(php_script_response=="Enregistré !")
                document.location.reload();
            else
                alert("Erreur : Fichier invalide ou non transmis"); // display response from the PHP script, if any
        }
     });
});

function delete_admin_file(real_name) {
    var form_data = new FormData();
    form_data.append('id_user', <?php echo $id_intervenant; ?>);  
    form_data.append('correspondance', "FILE");
    form_data.append('id_dossier', <?php echo $id_dossier; ?>);
    form_data.append('real_name', real_name);
    form_data.append('key', '<?php echo $User->get("personnal_key", $id_intervenant); ?>');    
    $.ajax({
        url: 'Controller/Ajax/delete_admin_file.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            if(php_script_response=="Supprimé !")
                document.location.reload();
            else
                alert(php_script_response); // display response from the PHP script, if any
        }
    });
}
</script>
</body>
</html>