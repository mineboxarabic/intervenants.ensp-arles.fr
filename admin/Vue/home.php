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
              
               <!--INFORMATIONS-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
	                            <div class="col-md-12">
                                    <h4>
                                        <?php echo bienvenue; ?>
                                            &nbsp;<?php echo ucfirst($_SESSION['first_name'])." ".ucfirst($_SESSION['last_name']);  ?>&nbsp;
                                        <?php echo titre_bienvenue; ?>
                                    </h4>
                                    <hr>
                                    <!--
                                    <div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">×</a>
                                        Bonjour, <br>
                                        Nous vous invitons à échanger ensemble en ligne ce<strong> mercredi 17 février à 18h </strong>autour du master, du concours d’entrée et des activités de l'école, avec Marta Gili, directrice de l’ENSP, Delphine Paul, directrice des études et de la recherche, et les étudiants de l’ENSP.
                                        <br><br>
                                        <a href="https://www.ensp-arles.fr/evenements/jpo-2021-en-ligne/" target="_blank">https://www.ensp-arles.fr/evenements/jpo-2021-en-ligne/</a>
                                    </div>
                                    -->
	                          </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                    <div class="col-sm-5 col-md-4 col-lg-4">
                        <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                            <a href="index.php">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <span class="icon fa fa-user color-darker-2"></span>
                                        </div>
                                        <div class="col-xs-8">
                                            <h4 class="subtitle color-darker-2"><?php echo state ?> : Administrateur <?php if(!empty($_SESSION['acreditation'])) echo '('.$_SESSION['acreditation'].')'; ?></h4>
                                            <h1 class="title color-w"><?php echo ucfirst($_SESSION['first_name'])." ".ucfirst($_SESSION['last_name']);  ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-4 col-lg-4">
                        <div class="panel widgetbox wbox-2 bg-darker-2 color-light">
                            <a href="dossiers.php">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <span class="icon fa fa-folder color-lighter-2"></span>
                                        </div>
                                        <div class="col-xs-8">
                                            <h4 class="subtitle color-lighter-2"><?php echo dossiers ?></h4>
                                            <h1 class="title color-w"> <?php echo $Dossiers->number(); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-4 col-lg-4">
                        <div class="panel widgetbox wbox-2 bg-darker-1 color-light">
                            <a href="dossiers.php">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <span class="icon fa fa-folder-open color-lighter-2"></span>
                                        </div>
                                        <div class="col-xs-8">
                                            <h4 class="subtitle color-lighter-2"><?php echo dossiers_unvalide ?></h4>
                                            <h1 class="title color-w"> <?php echo $Dossiers->numberToComplete(); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h4>Taux de tickets par mois</h4>
                        <canvas id="area-chart" width="400" height="160"></canvas>
                    </div>
                    <div class="col-sm-4">
                        <h4>Rapport de dossiers</h4>
                        <canvas id="pie-chart" width="400" height="260"></canvas>
                    </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
               <!--LEGALES-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
	                            <div class="col-md-12" style="font-size: 10px;">
                                    Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée relative à l'informatique, 
                                    aux fichiers et aux libertés, les données à caractère personnel que vous transmettez seront utilisées 
                                    exclusivement pour le traitement et la gestion de votre candidature par les services de l'École nationale 
                                    supérieure de la photographie.Elles ne seront en aucun cas communiquées à un tiers. Le traitement des données 
                                    a fait l'objet d'une inscription au registre du correspondant informatique et libertés de l'université. 
                                    Vous avez un droit d'accès, de rectification et de suppression pour motif légitime quant aux données personnelles 
                                    vous concernant. Vous pouvez exercer ce droit en contactant la sous direction Gestion de la formation et des 
                                    Etudes à cette adresse : support@ensp-arles.fr
	                          </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
               
                  
                </div>
                
                
                
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
<!--pNotify-->
<script src="../vendor/toastr/toastr.min.js"></script>
<!--morris chart-->
<script src="../vendor/chart-js/chart.min.js"></script>
<!--Gallery with Magnific popup-->
<script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<!--Examples-->
<script src="../vendor/chart-js/chart.min.js"></script>
<script>
    var area = document.getElementById("area-chart");

/*
var options ={
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero:true
            }
        }]
    }
};
    var dataArea = {
        labels: ["Janvier","Février", "Mars","Avril", "Mai", "Juin","Juillet","Aout", "Septembre","Octobre", "Novembre","Décembre"],
        datasets: [
            
            {
                label: "Nombre de tickets reçus à valider",
                fill: true,
                backgroundColor: "rgba(255, 0, 0, 0.55)",
                borderColor: "rgba(255, 0, 0, 0.55)",
                pointBorderColor: "rgba(235, 0, 0, 1)",
                pointBackgroundColor: "#fff",
                pointHoverBackgroundColor: "#343d3e",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                data: [
            <?php 
                    foreach($tickets_restant as $ticket) { //pour chaque tickets :
                        $i=0;
                        $monthResult[0]=0;
                        $monthResult[1]=0;
                        $monthResult[2]=0;
                        $monthResult[3]=0;
                        $monthResult[4]=0;
                        $monthResult[5]=0;
                        $monthResult[6]=0;
                        $monthResult[7]=0;
                        $monthResult[8]=0;
                        $monthResult[9]=0;
                        $monthResult[10]=0;
                        $monthResult[11]=0;
                        foreach($ticket as $month) {?>//pour chaque mois :
                            <?php if($i==0) $numsave=$month;
                                    else $monthResult[$month-1]=$numsave; ?>//on met le nombre de tickets dans le mois approprié :
                            <?php $i++; 
                        }
                        for ($i=0; $i < 12; $i++) { 
                            if($i!=11)
                                echo $monthResult[$i].",";
                            else
                                echo $monthResult[$i];
                        }
                    } ?>
                ],
            },
            {
                label: "Nombre de tickets reçus",
                fill: true,
                backgroundColor: "rgba(55, 209, 119, 0.45)",
                borderColor: "rgba(55, 209, 119, 0.45)",
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointHoverBackgroundColor: "343d3e",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                data: [
                    
                    <?php 
                    foreach($tickets as $ticket) { //pour chaque tickets :
                        $i=0;
                        $monthResult[0]=0;
                        $monthResult[1]=0;
                        $monthResult[2]=0;
                        $monthResult[3]=0;
                        $monthResult[4]=0;
                        $monthResult[5]=0;
                        $monthResult[6]=0;
                        $monthResult[7]=0;
                        $monthResult[8]=0;
                        $monthResult[9]=0;
                        $monthResult[10]=0;
                        $monthResult[11]=0;
                        foreach($ticket as $month) {?> //pour chaque mois :
                            <?php if($i==0) $numsave=$month;
                                    else $monthResult[$month-1]=$numsave; ?>//on met le nombre de tickets dans le mois approprié :
                            <?php $i++; 
                        }
                        for ($i=0; $i < 12; $i++) { 
                            if($i!=11)
                                echo $monthResult[$i].",";
                            else
                                echo $monthResult[$i];
                        }
                    } ?>
                ]
            },
            {
                label: "Nombre de tickets au total",
                fill: true,
                backgroundColor: "rgba(175, 175, 175, 0.26)",
                borderColor: "rgba(175, 175, 175, 0.26)",
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointHoverBackgroundColor: "#343d3e",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                data: [
            <?php 
                    foreach($tickets_total as $ticket) { //pour chaque tickets :
                        $i=0;
                        $monthResult[0]=0;
                        $monthResult[1]=0;
                        $monthResult[2]=0;
                        $monthResult[3]=0;
                        $monthResult[4]=0;
                        $monthResult[5]=0;
                        $monthResult[6]=0;
                        $monthResult[7]=0;
                        $monthResult[8]=0;
                        $monthResult[9]=0;
                        $monthResult[10]=0;
                        $monthResult[11]=0;
                        foreach($ticket as $month) {?>//pour chaque mois :
                            <?php if($i==0) $numsave=$month;
                                    else $monthResult[$month-1]=$numsave; ?>//on met le nombre de tickets dans le mois approprié :
                            <?php $i++; 
                        }
                        for ($i=0; $i < 12; $i++) { 
                            if($i!=11)
                                echo $monthResult[$i].",";
                            else
                                echo $monthResult[$i];
                        }
                    } ?>
                ],
            }

        ],
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            }
        }
    };
    var areaChart = new Chart(area, {
        type: 'line',
        data: dataArea,
        options: options
    });
*/
    var pie = document.getElementById("pie-chart");

    var dataPie = {
        labels: [
            "Dossiers à valider",
            "Dossiers validés"
        ],
        datasets: [
            {
                data: [<?php echo $Dossiers->numberToComplete(); ?>, <?php echo $Dossiers->number()-$Dossiers->numberToComplete(); ?>],
                backgroundColor: [
                    "rgba(55, 209, 119, 0.45)",
                    "#FFCE56"
                ],
                hoverBackgroundColor: [
                    "rgba(55, 209, 119, 0.6)",
                    "#FFCE56"
                ]
            }]
    };


    var pieChar = new Chart(pie, {
        type: 'pie',
        data: dataPie

    });

</script>
</body>
</html>