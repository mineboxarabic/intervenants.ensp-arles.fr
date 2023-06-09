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
    <!--Select with searching & tagging-->
    <link rel="stylesheet" href="vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="vendor/select2/css/select2-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/costomCss/fichier.css">

    <style>
    .upload_input {
        opacity: 0;
        position: absolute;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;

        cursor: pointer;
    }

    button[disabled],
    html input[disabled] {
        cursor: not-allowed;
    }

    .disabledx {
        cursor: not-allowed;
        width: 200px;
    }
    </style>


</head>

<body>

<div class="wrap">
    <div class="background_black">
        <div class="popUp_preview">

        </div>
    </div>

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
                <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs"
                    data-toggle-class="left-sidebar-collapsed" data-target="html">
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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a
                                href="index.php"><?php echo dashboard; ?></a></li>
                    </ul>
                </div>
            </div>







            <!--================================= CONTENT ==========================================-->
            <div class="tab-pane" id="files">
                <!-- ici c'est sous header -->
                <h4> Données non complètes </h4>
                <div class="info__how__to__use">
                    <?php 
                        echo INFO_COMMENT_TELECHARGER;
                    ?>
                </div>
                <?php if($files->allFilesExist()){?>
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong><?php echo complete_data; ?></strong>
                </div>
                <?php }else{ ?>
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong><?php echo dossiers_unvalide; ?></strong>
                </div>
                <?php } ?>





                <!-- ==================================  Form pour l'upload des fichier  ========================================== -->
                <form id="upload-form" action="Controller/upload_file.php" method="POST"
                    enctype="multipart/form-data">
                    <div>




                        <!--==================================== RIB ================================== -->
                        <?php
                        //Récupération l'id de l'utilisateur
                        $isExist = $files->existCoIn('RIB', $id_user); //Vérification si le fichier RIB existe
                        

                        //Si le fichier existe on affiche juste le nom du fichier et le bouton de téléchargement et un button pour vore le fichier actuelle
                        if($isExist){
                            $file = $files->getName('RIB'); //Récupération du nom du fichier
                            $hasheName = $files->getHashedName('RIB'); //Récupération du nom hashe du fichier
                            echo'<div class="input-group input-group-file-existe">
                            <div class="input-group-input">
                            <h5>RIB:</h5>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">'.choisir.'</button>
                                </span>
                                <input id="RIB" type="file" accept="image/*,.pdf" name="RIB" class="disabledx upload_input" disabled="">
                                <input id="RIPText" type="text" value="'.$file.'" class="form-control" placeholder="Choose a file..." disabled="">
                                </div>
                                <button onclick="download(\''.$id_user.'\',\''.$hasheName.'\')" class="download_file btn btn-wide btn-loading btn-primary" type="button"  >'.telecharger.'</button>
                                <button type="button" onclick="preview(\''.$id_user.'\',\''.$hasheName.'\')" class="preview_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">'.Apercu.'</button>
                                <button id="delete-RIB-btn" class="delete_FILE btn btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                            </div>';
                        }else{
                            echo'<div class="input-group ">
                            <h5>RIB:</h5>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Choisir</button>
                                </span>
                                <input id="RIB" type="file" accept="image/*,.pdf" name="RIB" class="upload_input" >
                                <input id="RIPText" type="text" value="" class="form-control" placeholder="Choose a file...">
                            </div>';
                        }

                        ?>



                        <!-- La meme chose pour les autres fichiers type de fichier -->
                        <!-- ==================================  SS  ========================================== -->
                        <?php 
                        $isExist = $files->existCoIn('SS', $id_user);
                        if($isExist){
                            $file = $files->getName('SS');
                            $hasheName = $files->getHashedName('SS');
                            echo'
                            <div class="input-group input-group-file-existe">
                            <h5>SS:</h5>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">'.choisir.'</button>
                                </span>
                                <input id="SS" type="file" accept="image/*,.pdf" name="SS" class="disabledx upload_input" disabled="">
                                <input id="SSText" type="text" value="'.$file.'" class="form-control" placeholder="Choose a file..." disabled="">
                                <button onclick="download(\''.$id_user.'\',\''.$hasheName.'\')" type="button" class="download_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." >'.telecharger.'</button>
                                <button type="button" onclick="preview(\''.$id_user.'\',\''.$hasheName.'\')" class="preview_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">'.Apercu.'</button>
                                <button id="delete-SS-btn" class="delete_FILE btn btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                            </div>';
                        }else{
                            echo'<div class="input-group">
                            <h5>SS:</h5>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Choisir</button>
                                </span>
                                <input id="SS" type="file" accept="image/*,.pdf" name="SS" class="upload_input" >
                                <input id="SSText" type="text" value="" class="form-control" placeholder="Choose a file...">
                            </div>';
                        }
                        ?>

                        <!-- ==================================  CI  ========================================== -->
                        <?php
                        $isExist = $files->existCoIn('CI', $id_user);
                        if($isExist){
                            $file = $files->getName('CI');
                            $hasheName = $files->getHashedName('CI');
                            echo'<div class="input-group input-group-file-existe">
                            <h5>CI:</h5>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">'.choisir.'</button>
                                </span>
                                <input id="CI" type="file" accept="image/*,.pdf" name="CI" class="disabledx upload_input" disabled="">
                                <input id="CIText" type="text" value="'.$file.'" class="form-control" placeholder="Choose a file..." disabled="">
                                <button type="button" onclick="download(\''.$id_user.'\',\''.$hasheName.'\')" class="download_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." >'.telecharger.'</button>
                                <button type="button" onclick="preview(\''.$id_user.'\',\''.$hasheName.'\')" class="preview_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">'.Apercu.'</button>
                                <button id ="delete-CI-btn" class="delete_FILE btn btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                            </div>';
                        }else{
                            echo'<div class="input-group">
                            <h5>CI:</h5>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Choisir</button>
                                </span>
                                <input id="CI" type="file" accept="image/*,.pdf" name="CI" class="upload_input" >
                                <input id="CIText" type="text" value="" class="form-control" placeholder="Choose a file...">
                            </div>';
                        }
                        ?>

                        <div class="input-group">
                        <h5>Autre Fichier:</h5>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-choose" type="button">Choisir</button>
                            </span>
                            <input id="Autre" type="file" accept="image/*,.pdf" name="Autre" class="upload_input" >
                            <input id="AutreText" type="text" value="" class="form-control" placeholder="Choose a file...">
                    </div> 
                    </div>






                    <input type="submit" class="btn btn-wide btn-loading btn-primary"
                        data-loading-text="please wait.." value="<?= soum_folder ?>" />
                </form>
                <div class="hl"> </div>
    <!-- ==================================  Autre Fichier  ========================================== -->
                    
                        <?php 
                         $fileNames = $files->getAllOtherFiles();

                        echo "<script>console.log('ddddddddddd".count($fileNames)."')</script>    ";
                        if(count($fileNames) > 0){
                            for($i = 0; $i < count($fileNames['names']); $i++){
                                echo "<script>console.log('".$fileNames['names'][$i]."')</script>    ";
                                 $file = $fileNames['hashedNames'][$i];
                                 $hasheName = $fileNames['names'][$i];
     
                                 echo'<div class="input-group input-group-file-existe">
                                     <input id="Autre" type="file" accept="image/*,.pdf" name="Autre" class="disabledx upload_input" disabled="">
                                     <input id="AutreText" type="text" value="'.$file.'" class="form-control" placeholder="Choose a file..." disabled="">
                                     <button type="button" onclick="download(\''.$id_user.'\',\''.$hasheName.'\')" class="download_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait.." >'.telecharger.'</button>
                                     <button type="button" onclick="preview(\''.$id_user.'\',\''.$hasheName.'\')" class="preview_file btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">'.Apercu.'</button>
                                     <button id ="delete-Autre-btn" onclick="deleteFile(\''.$id_user.'\',\''.$hasheName.'\')" class="delete_FILE btn btn-loading btn-danger" data-loading-text="please wait.." style="width: min-width;">X</button>
                                 </div>';
                             }
                        }else{
                           echo "no additional files found";
                        }

                
                        
                        ?>

            </div>

            <!--BASIC scripts-->
            <!-- ========================================================= -->
            <script src="assets/js/costomJS/fichier.js"></script>
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
            <!--CP and city-->
            <script src="vendor/vicopo/vicopo.min.js"></script>




            <!-- =============== L'utilisation de ajax ================== -->
            <script>
            $("#delete-RIB-btn").click(function() {
                var id_user = <?php echo json_encode($id_user); ?>;
                let hasheName = <?php echo json_encode($files->getHashedName('RIB')); ?>;
                console.log('id_user: ' + id_user);
                console.log('hasheName: ' + hasheName);
                $.ajax({
                    url: "Controller/ajax/deleteFile.php",
                    dataType: "text",
                    type: "post",
                    data: {
                        id_user: id_user,
                        hasheName: hasheName,
                        type: "RIB"
                    },
                    success: function(data) {
                        toastr.success("RIB supprimé avec succès");
                        if (data == "success") {
                            toastr.success("RIB supprimé avec succès");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Une erreur est survenue");
                        }
                    }
                });
            });


            $("#delete-CI-btn").click(function() {
                var id_user = <?php echo json_encode($id_user); ?>;
                let hasheName = <?php echo json_encode($files->getHashedName('CI')); ?>;
                console.log('id_user: ' + id_user);
                console.log('hasheName: ' + hasheName);
                $.ajax({
                    url: "Controller/ajax/deleteFile.php",
                    dataType: "text",
                    type: "post",
                    data: {
                        id_user: id_user,
                        hasheName: hasheName,
                        type: "CI"
                    },
                    success: function(data) {
                        if (data == "success") {
                            toastr.success("CI supprimé avec succès");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Une erreur est survenue");
                        }
                    }
                });
            });


            $("#delete-SS-btn").click(function() {
                var id_user = <?php echo json_encode($id_user); ?>;
                let hasheName = <?php echo json_encode($files->getHashedName('SS')); ?>;
                console.log('id_user: ' + id_user);
                console.log('hasheName: ' + hasheName);
                $.ajax({
                    url: "Controller/ajax/deleteFile.php",
                    dataType: "text",
                    type: "post",
                    data: {
                        id_user: id_user,
                        hasheName: hasheName,
                        type: "SS"
                    },
                    success: function(data) {
                        if (data == "success") {
                            toastr.success("SS supprimé avec succès");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Une erreur est survenue");
                        }
                    }
                });
            });


            function deleteFile(user, name){
                console.log('id_user: ' + user);
                console.log('hasheName: ' + name);
                $.ajax({
                    url: "Controller/ajax/deleteFile.php",
                    dataType: "text",
                    type: "post",
                    data: {
                        id_user: user,
                        hasheName: name,
                        type: "Autre"
                    },
                    success: function(data) {
                        if (data == "success") {
                            toastr.success("Fichier supprimé avec succès");
                            setTimeout(function() {
                                location.reload();
                            }, 100);
                        } else {
                            toastr.error("Une erreur est survenue");
                        }
                    }
                });
                }
            </script>
        </div>
    </div>
</div>

</body>

</html>