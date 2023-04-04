
<!doctype html>
<html lang="fr" class="fixed accounts sign-in">

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
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--seewtaler-->
    <link rel="stylesheet" href="vendor/sweetalert/sweetalert.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="box" style="width: min-content;">
            <!--SIGN IN FORM-->
            <div class="panel mb-none" style="width: 390px;display: inline-table;vertical-align: top;">
                <div class="panel-content bg-scale-0">
                <img src="assets/img/header-logo.png" style="height: 50px;display: inline-block;"><h2 style="display: inline-block; color: #E83843;"><b>Login</b></h2>
                   <form method="post" action="">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" name="username" id="username" placeholder="mail">
                                <i class="fa fa-sign-in"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control"  name="password" id="password" placeholder="<?php echo pass; ?>">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                       
                        <div class="form-group">
                            <input  class="btn btn-success btn-block"  type="submit" name="login" id="login" class="button" value="Login">                        
                        </div>
                            <!--  <input  class="btn btn-success btn-block" type="submit">-->
    		                <div id="loading" style="display:none;"><img src="assets/img/loader.gif" alt="Loading..."></div>
    		                <div id="feedback"></div>           
                        <a style="cursor: pointer" id="prompt-alert"><?php echo forgot_pass; ?></a><br>
                        <?php echo probleme; ?> <a href="mailto:support@ensp-arles.fr">support[at]ensp-arles.fr</a>
                        <br><br><br><br>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
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
	<script src="Controller/Ajax/ajax.js"></script>
<!--seewtaler-->
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!-- ========================================================= -->
<!--ALERT forgot password-->
<script>
$("#prompt-alert").on("click", function () {
    swal({
            title: "<?php echo forgot_pass; ?>",
            text: "<?php echo email; ?>",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "<?php echo email; ?> ..."
        },
        function(inputValue){
            if (inputValue === false) return false;

            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }

            // MAIL
            var xhr = new XMLHttpRequest();
            xhr.open("GET", 'Controller/Ajax/sendMailPassword.php?mail='+inputValue, true);

            //Envoie les informations du header adaptées avec la requête
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() { //Appelle une fonction au changement d'état.
                if(xhr.readyState == 4 && xhr.status == 200 && xhr.responseText.endsWith('email sent !')) {
                    swal("Nice!", "Un mail a été envoyé à l'adresse: " + inputValue, "success");
                }
                else
                {
                    swal("Error!", "Un mail n'a pas été envoyé à l'adresse: " + inputValue, "error");
                }
            }
            xhr.send();

        });
});
</script>

</body>

</html>
