
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

<body style="background-color: white;">
    <form method="post" action="" style="position: absolute;width:60%;margin-left: 20%;margin-top: 50vh; transform: translateY(-50%);">
        <div class="form-group mt-md">
            <span class="input-with-icon">
                <input type="password" class="form-control" name="password" id="password" require placeholder="password">
                <i class="fa fa-sign-in"></i>
            </span>
        </div>
        <div class="form-group">
            <span class="input-with-icon">
                <input type="password" class="form-control"  name="repassword" id="repassword" require placeholder="repassword">
                <i class="fa fa-key"></i>
            </span>
        </div>
        <div class="form-group">
            <input class="btn btn-success btn-block"  type="submit" name="valid_password" id="valid_password" class="button" value="update">                        
        </div>
    </form>
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