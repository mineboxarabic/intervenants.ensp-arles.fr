
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
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="panel-title"><?php echo infos_perso; ?></h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-4 col-md-12">
                                    <!-- FORM -->    
                                    <div class="panel">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form id="inline-validation needs-validation" class="form-horizontal" method="post" action="profil.php">
                                                    <div class="col-sm-5">
                                                        <h4 class="section-subtitle"><b><?php echo info_perso; ?></b></h4>
                                                        <div class="panel">
                                                            <div class="panel-content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="l_name" class="col-sm-4 control-label"><?php echo civ; ?></label>
                                                                            <div class="col-sm-6">
                                                                                <select name="civ" class="form-control" >
                                                                                    <option value="">---<?php echo civ; ?>---</option>
                                                                                    <option value="Monsieur" label="Monsieur" <?php if($civ=="Monsieur") echo "selected"; ?>></option>
                                                                                    <option value="Madame" label="Madame" <?php if($civ=="Madame") echo "selected"; ?>></option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="l_name" class="col-sm-4 control-label"><?php echo nom; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <input type="text" class="form-control" id="nom" name="l_name" required value="<?php echo $last_name; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="f_name" class="col-sm-4 control-label"><?php echo prenom; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <input type="text" class="form-control" id="prenom" name="f_name" value="<?php echo $first_name; ?>" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="c_mail" class="col-sm-4 control-label"><?php echo email; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <input type="email" class="form-control" id="c_mail" name="c_mail" value="<?php echo $member_email; ?>" required>
                                                                            </div>
                                                                        </div>
<br><br>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-4 control-label"><?php echo dateNaissance; ?> <span class="required">*</span></label>
                                                                            <div class="input-group col-sm-6">
                                                                                
                                                                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                                                <!--
                                                                                <input name="bornDate" id="date" type="date" class="form-control" value="<?php echo $born_date; ?>" required>
                                                                                -->
                                                                                <?php
                                                                                $date = new DateTime($born_date);
	                                                                                
																				 ?>
                                                                                <input name="bornDate" type="text" class="form-control" id="default-datepicker" value="<?php if($born_date=="0000-00-00"){
                                                                                	echo "JJ/MM/AAAA";} else {echo $date->format('d/m/Y');}?>" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="born_country" class="col-sm-4 control-label"><?php echo pays_naiss; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <select name="born_country" id="select2-example-basic3" class="form-control" required>
                                                                                    <option value="">---<?php echo pays_naiss; ?>---</option>
                                                                                    <optgroup label="AMERICA">
                                                                                        <option value="Anguilla" <?php if($born_country=="Anguilla") echo "selected"; ?> label="Anguilla">Anguilla</option>
                                                                                        <option value="Antigua and Barbuda" <?php if($born_country=="Antigua and Barbuda") echo "selected"; ?> label="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                                        <option value="Argentina" <?php if($born_country=="Argentina") echo "selected"; ?> label="Argentina">Argentina</option>
                                                                                        <option value="Aruba" <?php if($born_country=="Aruba") echo "selected"; ?> label="Aruba">Aruba</option>
                                                                                        <option value="Bahamas" <?php if($born_country=="Bahamas") echo "selected"; ?> label="Bahamas">Bahamas</option>
                                                                                        <option value="Barbados" <?php if($born_country=="Barbados") echo "selected"; ?> label="Barbados">Barbados</option>
                                                                                        <option value="Belize" <?php if($born_country=="Belize") echo "selected"; ?> label="Belize">Belize</option>
                                                                                        <option value="Bermuda" <?php if($born_country=="Bermuda") echo "selected"; ?> label="Bermuda">Bermuda</option>
                                                                                        <option value="Bolivia" <?php if($born_country=="Bolivia") echo "selected"; ?> label="Bolivia">Bolivia</option>
                                                                                        <option value="Brazil" <?php if($born_country=="Brazil") echo "selected"; ?> label="Brazil">Brazil</option>
                                                                                        <option value="British Virgin Islands" <?php if($born_country=="British Virgin Islands") echo "selected"; ?> label="British Virgin Islands">British Virgin Islands</option>
                                                                                        <option value="Canada" <?php if($born_country=="Canada") echo "selected"; ?> label="Canada">Canada</option>
                                                                                        <option value="Cayman Islands" <?php if($born_country=="Cayman Islands") echo "selected"; ?> label="Cayman Islands">Cayman Islands</option>
                                                                                        <option value="Chile" <?php if($born_country=="Chile") echo "selected"; ?> label="Chile">Chile</option>
                                                                                        <option value="Colombia" <?php if($born_country=="Colombia") echo "selected"; ?> label="Colombia">Colombia</option>
                                                                                        <option value="Costa Rica" <?php if($born_country=="Costa Rica") echo "selected"; ?> label="Costa Rica">Costa Rica</option>
                                                                                        <option value="Cuba" <?php if($born_country=="Cuba") echo "selected"; ?> label="Cuba">Cuba</option>
                                                                                        <option value="Dominica" <?php if($born_country=="Dominica") echo "selected"; ?> label="Dominica">Dominica</option>
                                                                                        <option value="Dominican Republic" <?php if($born_country=="Dominican Republic") echo "selected"; ?> label="Dominican Republic">Dominican Republic</option>
                                                                                        <option value="Ecuador" <?php if($born_country=="Ecuador") echo "selected"; ?> label="Ecuador">Ecuador</option>
                                                                                        <option value="El Salvador" <?php if($born_country=="El Salvador") echo "selected"; ?> label="El Salvador">El Salvador</option>
                                                                                        <option value="Falkland Islands" <?php if($born_country=="Falkland Islands") echo "selected"; ?> label="Falkland Islands">Falkland Islands</option>
                                                                                        <option value="French Guiana" <?php if($born_country=="French Guiana") echo "selected"; ?> label="French Guiana">French Guiana</option>
                                                                                        <option value="Greenland" <?php if($born_country=="Greenland") echo "selected"; ?> label="Greenland">Greenland</option>
                                                                                        <option value="Grenada" <?php if($born_country=="Grenada") echo "selected"; ?> label="Grenada">Grenada</option>
                                                                                        <option value="Guadeloupe" <?php if($born_country=="Guadeloupe") echo "selected"; ?> label="Guadeloupe">Guadeloupe</option>
                                                                                        <option value="Guatemala" <?php if($born_country=="Guatemala") echo "selected"; ?> label="Guatemala">Guatemala</option>
                                                                                        <option value="Guyana" <?php if($born_country=="Guyana") echo "selected"; ?> label="Guyana">Guyana</option>
                                                                                        <option value="Haiti" <?php if($born_country=="Haiti") echo "selected"; ?> label="Haiti">Haiti</option>
                                                                                        <option value="Honduras" <?php if($born_country=="Honduras") echo "selected"; ?> label="Honduras">Honduras</option>
                                                                                        <option value="Jamaica" <?php if($born_country=="Jamaica") echo "selected"; ?> label="Jamaica">Jamaica</option>
                                                                                        <option value="Martinique" <?php if($born_country=="Martinique") echo "selected"; ?> label="Martinique">Martinique</option>
                                                                                        <option value="Mexico" <?php if($born_country=="Mexico") echo "selected"; ?> label="Mexico">Mexico</option>
                                                                                        <option value="Montserrat" <?php if($born_country=="Montserrat") echo "selected"; ?> label="Montserrat">Montserrat</option>
                                                                                        <option value="Netherlands Antilles" <?php if($born_country=="Netherlands Antilles") echo "selected"; ?> label="Netherlands Antilles">Netherlands Antilles</option>
                                                                                        <option value="Nicaragua" <?php if($born_country=="Nicaragua") echo "selected"; ?> label="Nicaragua">Nicaragua</option>
                                                                                        <option value="Panama" <?php if($born_country=="Panama") echo "selected"; ?> label="Panama">Panama</option>
                                                                                        <option value="Paraguay" <?php if($born_country=="Paraguay") echo "selected"; ?> label="Paraguay">Paraguay</option>
                                                                                        <option value="Peru" <?php if($born_country=="Peru") echo "selected"; ?> label="Peru">Peru</option>
                                                                                        <option value="Puerto Rico" <?php if($born_country=="Puerto Rico") echo "selected"; ?> label="Puerto Rico">Puerto Rico</option>
                                                                                        <option value="Saint Barthélemy" <?php if($born_country=="Saint Barthélemy") echo "selected"; ?> label="Saint Barthélemy">Saint Barthélemy</option>
                                                                                        <option value="Saint Kitts and Nevis" <?php if($born_country=="Saint Kitts and Nevis") echo "selected"; ?> label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                                        <option value="Saint Lucia" <?php if($born_country=="Saint Lucia") echo "selected"; ?> label="Saint Lucia">Saint Lucia</option>
                                                                                        <option value="Saint Martin" <?php if($born_country=="Saint Martin") echo "selected"; ?> label="Saint Martin">Saint Martin</option>
                                                                                        <option value="Saint Pierre and Miquelon" <?php if($born_country=="Saint Pierre and Miquelon") echo "selected"; ?> label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                                        <option value="Saint Vincent and the Grenadines" <?php if($born_country=="Saint Vincent and the Grenadines") echo "selected"; ?> label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                                                        <option value="Suriname" <?php if($born_country=="Suriname") echo "selected"; ?> label="Suriname">Suriname</option>
                                                                                        <option value="Trinidad and Tobago" <?php if($born_country=="Trinidad and Tobago") echo "selected"; ?> label="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                                        <option value="Turks and Caicos Islands" <?php if($born_country=="Turks and Caicos Islands") echo "selected"; ?> label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                                        <option value="U.S. Virgin Islands" <?php if($born_country=="U.S. Virgin Islands") echo "selected"; ?> label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                                                                        <option value="United States" <?php if($born_country=="United States") echo "selected"; ?> label="United States">United States</option>
                                                                                        <option value="Uruguay" <?php if($born_country=="Uruguay") echo "selected"; ?> label="Uruguay">Uruguay</option>
                                                                                        <option value="Venezuela" <?php if($born_country=="Venezuela") echo "selected"; ?> label="Venezuela">Venezuela</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="ASIA">
                                                                                        <option value="Afghanistan" <?php if($born_country=="Afghanistan") echo "selected"; ?> label="Afghanistan">Afghanistan</option>
                                                                                        <option value="Armenia" <?php if($born_country=="Armenia") echo "selected"; ?> label="Armenia">Armenia</option>
                                                                                        <option value="Azerbaijan" <?php if($born_country=="Azerbaijan") echo "selected"; ?> label="Azerbaijan">Azerbaijan</option>
                                                                                        <option value="Bahrain" <?php if($born_country=="Bahrain") echo "selected"; ?> label="Bahrain">Bahrain</option>
                                                                                        <option value="Bangladesh" <?php if($born_country=="Bangladesh") echo "selected"; ?> label="Bangladesh">Bangladesh</option>
                                                                                        <option value="Bhutan" <?php if($born_country=="Bhutan") echo "selected"; ?> label="Bhutan">Bhutan</option>
                                                                                        <option value="Brunei" <?php if($born_country=="Brunei") echo "selected"; ?> label="Brunei">Brunei</option>
                                                                                        <option value="Cambodia" <?php if($born_country=="Cambodia") echo "selected"; ?> label="Cambodia">Cambodia</option>
                                                                                        <option value="China" <?php if($born_country=="China") echo "selected"; ?> label="China">China</option>
                                                                                        <option value="Cyprus" <?php if($born_country=="Cyprus") echo "selected"; ?> label="Cyprus">Cyprus</option>
                                                                                        <option value="Georgia" <?php if($born_country=="Georgia") echo "selected"; ?> label="Georgia">Georgia</option>
                                                                                        <option value="Hong Kong SAR China" <?php if($born_country=="Hong Kong SAR China") echo "selected"; ?> label="Hong Kong SAR China">Hong Kong SAR China</option>
                                                                                        <option value="India" <?php if($born_country=="India") echo "selected"; ?> label="India">India</option>
                                                                                        <option value="Indonesia" <?php if($born_country=="Indonesia") echo "selected"; ?> label="Indonesia">Indonesia</option>
                                                                                        <option value="Iran" <?php if($born_country=="Iran") echo "selected"; ?> label="Iran">Iran</option>
                                                                                        <option value="Iraq" <?php if($born_country=="Iraq") echo "selected"; ?> label="Iraq">Iraq</option>
                                                                                        <option value="Israel" <?php if($born_country=="Israel") echo "selected"; ?> label="Israel">Israel</option>
                                                                                        <option value="Japan" <?php if($born_country=="Japan") echo "selected"; ?> label="Japan">Japan</option>
                                                                                        <option value="Jordan" <?php if($born_country=="Jordan") echo "selected"; ?> label="Jordan">Jordan</option>
                                                                                        <option value="Kazakhstan" <?php if($born_country=="Kazakhstan") echo "selected"; ?> label="Kazakhstan">Kazakhstan</option>
                                                                                        <option value="Kuwait" <?php if($born_country=="Kuwait") echo "selected"; ?> label="Kuwait">Kuwait</option>
                                                                                        <option value="Kyrgyzstan" <?php if($born_country=="Kyrgyzstan") echo "selected"; ?> label="Kyrgyzstan">Kyrgyzstan</option>
                                                                                        <option value="Laos" <?php if($born_country=="Laos") echo "selected"; ?> label="Laos">Laos</option>
                                                                                        <option value="Lebanon" <?php if($born_country=="Lebanon") echo "selected"; ?> label="Lebanon">Lebanon</option>
                                                                                        <option value="Macau SAR China" <?php if($born_country=="Macau SAR China") echo "selected"; ?> label="Macau SAR China">Macau SAR China</option>
                                                                                        <option value="Malaysia" <?php if($born_country=="Malaysia") echo "selected"; ?> label="Malaysia">Malaysia</option>
                                                                                        <option value="Maldives" <?php if($born_country=="Maldives") echo "selected"; ?> label="Maldives">Maldives</option>
                                                                                        <option value="Mongolia" <?php if($born_country=="Mongolia") echo "selected"; ?> label="Mongolia">Mongolia</option>
                                                                                        <option value="Myanmar [Burma]" <?php if($born_country=="Myanmar [Burma]") echo "selected"; ?> label="Myanmar [Burma]">Myanmar [Burma]</option>
                                                                                        <option value="Nepal" <?php if($born_country=="Nepal") echo "selected"; ?> label="Nepal">Nepal</option>
                                                                                        <option value="Neutral Zone" <?php if($born_country=="Neutral Zone") echo "selected"; ?> label="Neutral Zone">Neutral Zone</option>
                                                                                        <option value="North Korea" <?php if($born_country=="North Korea") echo "selected"; ?> label="North Korea">North Korea</option>
                                                                                        <option value="Oman" <?php if($born_country=="Oman") echo "selected"; ?> label="Oman">Oman</option>
                                                                                        <option value="Pakistan" <?php if($born_country=="Pakistan") echo "selected"; ?> label="Pakistan">Pakistan</option>
                                                                                        <option value="Palestinian Territories" <?php if($born_country=="Palestinian Territories") echo "selected"; ?> label="Palestinian Territories">Palestinian Territories</option>
                                                                                        <option value="People's Democratic Republic of Yemen" <?php if($born_country=="People's Democratic Republic of Yemen") echo "selected"; ?> label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                                                                        <option value="Philippines" <?php if($born_country=="Philippines") echo "selected"; ?> label="Philippines">Philippines</option>
                                                                                        <option value="Qatar" <?php if($born_country=="Qatar") echo "selected"; ?> label="Qatar">Qatar</option>
                                                                                        <option value="Saudi Arabia" <?php if($born_country=="Saudi Arabia") echo "selected"; ?> label="Saudi Arabia">Saudi Arabia</option>
                                                                                        <option value="Singapore" <?php if($born_country=="Singapore") echo "selected"; ?> label="Singapore">Singapore</option>
                                                                                        <option value="South Korea" <?php if($born_country=="South Korea") echo "selected"; ?> label="South Korea">South Korea</option>
                                                                                        <option value="Sri Lanka" <?php if($born_country=="Sri Lanka") echo "selected"; ?> label="Sri Lanka">Sri Lanka</option>
                                                                                        <option value="Syria" <?php if($born_country=="Syria") echo "selected"; ?> label="Syria">Syria</option>
                                                                                        <option value="Taiwan" <?php if($born_country=="Taiwan") echo "selected"; ?> label="Taiwan">Taiwan</option>
                                                                                        <option value="Tajikistan" <?php if($born_country=="Tajikistan") echo "selected"; ?> label="Tajikistan">Tajikistan</option>
                                                                                        <option value="Thailand" <?php if($born_country=="Thailand") echo "selected"; ?> label="Thailand">Thailand</option>
                                                                                        <option value="Timor-Leste" <?php if($born_country=="Timor-Leste") echo "selected"; ?> label="Timor-Leste">Timor-Leste</option>
                                                                                        <option value="Turkey" <?php if($born_country=="Turkey") echo "selected"; ?> label="Turkey">Turkey</option>
                                                                                        <option value="Turkmenistan"  <?php if($born_country=="Turkmenistan") echo "selected"; ?> label="Turkmenistan">Turkmenistan</option>
                                                                                        <option value="United Arab Emirates" <?php if($born_country=="United Arab Emirates") echo "selected"; ?> label="United Arab Emirates">United Arab Emirates</option>
                                                                                        <option value="Uzbekistan" <?php if($born_country=="Uzbekistan") echo "selected"; ?> label="Uzbekistan">Uzbekistan</option>
                                                                                        <option value="Vietnam" <?php if($born_country=="Vietnam") echo "selected"; ?> label="Vietnam">Vietnam</option>
                                                                                        <option value="Yemen" <?php if($born_country=="Yemen") echo "selected"; ?> label="Yemen">Yemen</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="EUROPE">
                                                                                        <option value="Albania" <?php if($born_country=="Andorra") echo "selected"; ?> label="Andorra">Andorra</option>
                                                                                        <option value="Andorra" <?php if($born_country=="Albania") echo "selected"; ?> label="Albania">Albania</option>
                                                                                        <option value="Austria" <?php if($born_country=="Austria") echo "selected"; ?> label="Austria">Austria</option>
                                                                                        <option value="Belarus" <?php if($born_country=="Belarus") echo "selected"; ?> label="Belarus">Belarus</option>
                                                                                        <option value="Belgium" <?php if($born_country=="Belgium") echo "selected"; ?> label="Belgium">Belgium</option>
                                                                                        <option value="Bosnia and Herzegovina" <?php if($born_country=="Bosnia and Herzegovina") echo "selected"; ?> label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                                        <option value="Bulgaria" <?php if($born_country=="Bulgaria") echo "selected"; ?> label="Bulgaria">Bulgaria</option>
                                                                                        <option value="Croatia" <?php if($born_country=="Croatia") echo "selected"; ?> label="Croatia">Croatia</option>
                                                                                        <option value="Cyprus" <?php if($born_country=="Cyprus") echo "selected"; ?> label="Cyprus">Cyprus</option>
                                                                                        <option value="Czech Republic" <?php if($born_country=="Czech Republic") echo "selected"; ?> label="Czech Republic">Czech Republic</option>
                                                                                        <option value="Denmark" <?php if($born_country=="Denmark") echo "selected"; ?> label="Denmark">Denmark</option>
                                                                                        <option value="East Germany" <?php if($born_country=="East Germany") echo "selected"; ?> label="East Germany">East Germany</option>
                                                                                        <option value="Estonia" <?php if($born_country=="Estonia") echo "selected"; ?> label="Estonia">Estonia</option>
                                                                                        <option value="Faroe Islands" <?php if($born_country=="Faroe Islands") echo "selected"; ?> label="Faroe Islands">Faroe Islands</option>
                                                                                        <option value="Finland" <?php if($born_country=="Finland") echo "selected"; ?> label="Finland">Finland</option>
                                                                                        <option value="France" <?php if($born_country=="France" || $born_country=="") echo "selected"; ?> label="France">France</option>
                                                                                        <option value="Germany" <?php if($born_country=="Germany") echo "selected"; ?> label="Germany">Germany</option>
                                                                                        <option value="Gibraltar" <?php if($born_country=="Gibraltar") echo "selected"; ?> label="Gibraltar">Gibraltar</option>
                                                                                        <option value="Greece" <?php if($born_country=="Greece") echo "selected"; ?> label="Greece">Greece</option>
                                                                                        <option value="Guernsey" <?php if($born_country=="Guernsey") echo "selected"; ?> label="Guernsey">Guernsey</option>
                                                                                        <option value="Hungary" <?php if($born_country=="Hungary") echo "selected"; ?> label="Hungary">Hungary</option>
                                                                                        <option value="Iceland" <?php if($born_country=="Iceland") echo "selected"; ?> label="Iceland">Iceland</option>
                                                                                        <option value="Ireland" <?php if($born_country=="Ireland") echo "selected"; ?> label="Ireland">Ireland</option>
                                                                                        <option value="Isle of Man" <?php if($born_country=="Isle of Man") echo "selected"; ?> label="Isle of Man">Isle of Man</option>
                                                                                        <option value="Italy" <?php if($born_country=="Italy") echo "selected"; ?> label="Italy">Italy</option>
                                                                                        <option value="Jersey" <?php if($born_country=="Jersey") echo "selected"; ?> label="Jersey">Jersey</option>
                                                                                        <option value="Latvia" <?php if($born_country=="Latvia") echo "selected"; ?> label="Latvia">Latvia</option>
                                                                                        <option value="Liechtenstein" <?php if($born_country=="Liechtenstein") echo "selected"; ?> label="Liechtenstein">Liechtenstein</option>
                                                                                        <option value="Lithuania" <?php if($born_country=="Lithuania") echo "selected"; ?> label="Lithuania">Lithuania</option>
                                                                                        <option value="Luxembourg" <?php if($born_country=="Luxembourg") echo "selected"; ?> label="Luxembourg">Luxembourg</option>
                                                                                        <option value="Macedonia" <?php if($born_country=="Macedonia") echo "selected"; ?> label="Macedonia">Macedonia</option>
                                                                                        <option value="Malta" <?php if($born_country=="Malta") echo "selected"; ?> label="Malta">Malta</option>
                                                                                        <option value="Metropolitan France" <?php if($born_country=="Metropolitan France") echo "selected"; ?> label="Metropolitan France">Metropolitan France</option>
                                                                                        <option value="Moldova" <?php if($born_country=="Moldova") echo "selected"; ?> label="Moldova">Moldova</option>
                                                                                        <option value="Monaco" <?php if($born_country=="Monaco") echo "selected"; ?> label="Monaco">Monaco</option>
                                                                                        <option value="Montenegro" <?php if($born_country=="Montenegro") echo "selected"; ?> label="Montenegro">Montenegro</option>
                                                                                        <option value="Netherlands" <?php if($born_country=="Netherlands") echo "selected"; ?> label="Netherlands">Netherlands</option>
                                                                                        <option value="Norway" <?php if($born_country=="Norway") echo "selected"; ?> label="Norway">Norway</option>
                                                                                        <option value="Poland" <?php if($born_country=="Poland") echo "selected"; ?> label="Poland">Poland</option>
                                                                                        <option value="Portugal" <?php if($born_country=="Portugal") echo "selected"; ?> label="Portugal">Portugal</option>
                                                                                        <option value="Romania" <?php if($born_country=="Romania") echo "selected"; ?> label="Romania">Romania</option>
                                                                                        <option value="Russia" <?php if($born_country=="Russia") echo "selected"; ?> label="Russia">Russia</option>
                                                                                        <option value="Sann Marino" <?php if($born_country=="Sann Marino") echo "selected"; ?> label="San Marino">San Marino</option>
                                                                                        <option value="Serbia" <?php if($born_country=="Serbia") echo "selected"; ?> label="Serbia">Serbia</option>
                                                                                        <option value="Serbia and Montenegro" <?php if($born_country=="Serbia and Montenegro") echo "selected"; ?> label="Serbia and Montenegro">Serbia and Montenegro</option>
                                                                                        <option value="Slovakia" <?php if($born_country=="Slovakia") echo "selected"; ?> label="Slovakia">Slovakia</option>
                                                                                        <option value="Slovenia" <?php if($born_country=="Slovenia") echo "selected"; ?> label="Slovenia">Slovenia</option>
                                                                                        <option value="Spain" <?php if($born_country=="Spain") echo "selected"; ?> label="Spain">Spain</option>
                                                                                        <option value="Svalbard and Jan Mayen" <?php if($born_country=="Svalbard and Jan Mayen") echo "selected"; ?> label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                                                        <option value="Sweden" <?php if($born_country=="Sweden") echo "selected"; ?> label="Sweden">Sweden</option>
                                                                                        <option value="Switzerland" <?php if($born_country=="Switzerland") echo "selected"; ?> label="Switzerland">Switzerland</option>
                                                                                        <option value="Ukraine" <?php if($born_country=="Ukraine") echo "selected"; ?> label="Ukraine">Ukraine</option>
                                                                                        <option value="Union of Soviet Socialist Republics" <?php if($born_country=="Union of Soviet Socialist Republics") echo "selected"; ?> label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                                                                        <option value="United Kingdom" <?php if($born_country=="United Kingdom") echo "selected"; ?> label="United Kingdom">United Kingdom</option>
                                                                                        <option value="Vatican City" <?php if($born_country=="Vatican City") echo "selected"; ?> label="Vatican City">Vatican City</option>
                                                                                        <option value="Åland Islands" <?php if($born_country=="Åland Islands") echo "selected"; ?> label="Åland Islands">Åland Islands</option>
                                                                                    </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <br><br>
                                                                    
                                                                        <div class="form-group">
                                                                            <label for="phone-mask" class="col-sm-4 control-label"><?php echo tel; ?><span class="required">*</span></label>
                                                                            <div class="input-group col-sm-6">
                                                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                                <input name="phone" id="phone-number" type="text" class="form-control" value="<?php if(!empty($phone)) echo $phone; else echo "0_ __ __ __ __"; ?>" data-inputmask="'mask': '09 99 99 99 99'" required>
                                                                            </div>
                                                                                <span id="phone-message" class="help-block col-sm-6" style='color:red;display: none;'><i class="fa fa-info-circle mr-xs"></i>Phone incomplete</span>
                                                                                <span id="phone-message-valid" class="help-block col-sm-6" style='color:green;display: none;'><i class="fa fa-info-circle mr-xs"></i>Phone complete</span>
                                                                        </div><br><br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <h4 class="section-subtitle"><b><?php echo info_supp ; ?></b></h4>
                                                        <div class="panel">
                                                            <div class="panel-content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="select2-example-basic2" class="col-sm-3 control-label"><?php echo nationalite; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <select name="country" id="select2-example-basic2" class="form-control" required>
                                                                                    <option value="">---<?php echo nationalite; ?>---</option>
                                                                                    <optgroup label="Nationalité">
                                                                                        <option value="Afghane" <?php if($nationality=="Afghane") echo "selected"; ?>>Afghane </option>
                                                                                        <option value="Albanaise" <?php if($nationality=="Albanaise") echo "selected"; ?>>Albanaise </option>
                                                                                        <option value="Allemande" <?php if($nationality=="Allemande") echo "selected"; ?>>Allemande </option>
                                                                                        <option value="Algérienne" <?php if($nationality=="Algérienne") echo "selected"; ?>>Algérienne </option>
                                                                                        <option value="Americaine" <?php if($nationality=="Americaine") echo "selected"; ?>>Americaine </option>
                                                                                        <option value="Andorrane" <?php if($nationality=="Andorrane") echo "selected"; ?>>Andorrane </option>
                                                                                        <option value="Angolaise" <?php if($nationality=="Angolaise") echo "selected"; ?>>Angolaise </option>
                                                                                        <option value="Antiguaise-et-Barbudienne" <?php if($nationality=="Antiguaise-et-Barbudienne") echo "selected"; ?>>Antiguaise-et-Barbudienne </option>
                                                                                        <option value="Argentine" <?php if($nationality=="Argentine") echo "selected"; ?>>Argentine </option>
                                                                                        <option value="Armenienne" <?php if($nationality=="Armenienne") echo "selected"; ?>>Armenienne </option>
                                                                                        <option value="Australienne" <?php if($nationality=="Australienne") echo "selected"; ?>>Australienne </option>
                                                                                        <option value="Autrichienne" <?php if($nationality=="Autrichienne") echo "selected"; ?>>Autrichienne </option>
                                                                                        <option value="Azerbaïdjanaise" <?php if($nationality=="Azerbaïdjanaise") echo "selected"; ?>>Azerbaïdjanaise </option>
                                                                                        <option value="Bahamienne" <?php if($nationality=="Bahamienne") echo "selected"; ?>>Bahamienne </option>
                                                                                        <option value="Bahreinienne" <?php if($nationality=="Bahreinienne") echo "selected"; ?>>Bahreinienne </option>
                                                                                        <option value="Bangladaise" <?php if($nationality=="Bangladaise") echo "selected"; ?>>Bangladaise </option>
                                                                                        <option value="Barbadienne" <?php if($nationality=="Barbadienne") echo "selected"; ?>>Barbadienne </option>
                                                                                        <option value="Belge" <?php if($nationality=="Belge") echo "selected"; ?>>Belge </option>
                                                                                        <option value="Belizienne" <?php if($nationality=="Belizienne") echo "selected"; ?>>Belizienne </option>
                                                                                        <option value="Béninoise" <?php if($nationality=="Béninoise") echo "selected"; ?>>Béninoise </option>
                                                                                        <option value="Bhoutanaise" <?php if($nationality=="Bhoutanaise") echo "selected"; ?>>Bhoutanaise </option>
                                                                                        <option value="Biélorusse" <?php if($nationality=="Biélorusse") echo "selected"; ?>>Biélorusse </option>
                                                                                        <option value="Birmane" <?php if($nationality=="Birmane") echo "selected"; ?>>Birmane </option>
                                                                                        <option value="Bissau-Guinéenne" <?php if($nationality=="Bissau-Guinéenne") echo "selected"; ?>>Bissau-Guinéenne </option>
                                                                                        <option value="Bolivienne" <?php if($nationality=="Bolivienne") echo "selected"; ?>>Bolivienne </option>
                                                                                        <option value="Bosnienne" <?php if($nationality=="Bosnienne") echo "selected"; ?>>Bosnienne </option>
                                                                                        <option value="Botswanaise" <?php if($nationality=="Botswanaise") echo "selected"; ?>>Botswanaise </option>
                                                                                        <option value="Brésilienne" <?php if($nationality=="Brésilienne") echo "selected"; ?>>Brésilienne </option>
                                                                                        <option value="Britannique" <?php if($nationality=="Britannique") echo "selected"; ?>>Britannique </option>
                                                                                        <option value="Brunéienne" <?php if($nationality=="Brunéienne") echo "selected"; ?>>Brunéienne </option>
                                                                                        <option value="Bulgare" <?php if($nationality=="Bulgare") echo "selected"; ?>>Bulgare </option>
                                                                                        <option value="Burkinabée" <?php if($nationality=="Burkinabée") echo "selected"; ?>>Burkinabée </option>
                                                                                        <option value="Burundaise" <?php if($nationality=="Burundaise") echo "selected"; ?>>Burundaise </option>
                                                                                        <option value="Cambodgienne" <?php if($nationality=="Cambodgienne") echo "selected"; ?>>Cambodgienne </option>
                                                                                        <option value="Camerounaise" <?php if($nationality=="Camerounaise") echo "selected"; ?>>Camerounaise </option>
                                                                                        <option value="Canadienne" <?php if($nationality=="Canadienne") echo "selected"; ?>>Canadienne </option>
                                                                                        <option value="Cap-verdienne" <?php if($nationality=="Cap-verdienne") echo "selected"; ?>>Cap-verdienne </option>
                                                                                        <option value="Centrafricaine" <?php if($nationality=="Centrafricaine") echo "selected"; ?>>Centrafricaine </option>
                                                                                        <option value="Chilienne" <?php if($nationality=="Chilienne") echo "selected"; ?>>Chilienne </option>
                                                                                        <option value="Chinoise" <?php if($nationality=="Chinoise") echo "selected"; ?>>Chinoise </option>
                                                                                        <option value="Chypriote" <?php if($nationality=="Chypriote") echo "selected"; ?>>Chypriote </option>
                                                                                        <option value="Colombienne" <?php if($nationality=="Colombienne") echo "selected"; ?>>Colombienne </option>
                                                                                        <option value="Comorienne" <?php if($nationality=="Comorienne") echo "selected"; ?>>Comorienne </option>
                                                                                        <option value="Congolaise" <?php if($nationality=="Congolaise") echo "selected"; ?>>Congolaise </option>
                                                                                        <option value="Congolaise" <?php if($nationality=="Congolaise") echo "selected"; ?>>Congolaise </option>
                                                                                        <option value="Cookienne" <?php if($nationality=="Cookienne") echo "selected"; ?>>Cookienne </option>
                                                                                        <option value="Costaricaine" <?php if($nationality=="Costaricaine") echo "selected"; ?>>Costaricaine </option>
                                                                                        <option value="Croate" <?php if($nationality=="Croate") echo "selected"; ?>>Croate </option>
                                                                                        <option value="Cubaine" <?php if($nationality=="Cubaine") echo "selected"; ?>>Cubaine </option>
                                                                                        <option value="Danoise" <?php if($nationality=="Danoise") echo "selected"; ?>>Danoise </option>
                                                                                        <option value="Djiboutienne" <?php if($nationality=="Djiboutienne") echo "selected"; ?>>Djiboutienne </option>
                                                                                        <option value="Dominicaine" <?php if($nationality=="Dominicaine") echo "selected"; ?>>Dominicaine </option>
                                                                                        <option value="Dominiquaise" <?php if($nationality=="Dominiquaise") echo "selected"; ?>>Dominiquaise </option>
                                                                                        <option value="Égyptienne" <?php if($nationality=="Égyptienne") echo "selected"; ?>>Égyptienne </option>
                                                                                        <option value="Émirienne" <?php if($nationality=="Émirienne") echo "selected"; ?>>Émirienne </option>
                                                                                        <option value="Équato-guineenne" <?php if($nationality=="Équato-guineenne") echo "selected"; ?>>Équato-guineenne </option>
                                                                                        <option value="Équatorienne" <?php if($nationality=="Équatorienne") echo "selected"; ?>>Équatorienne </option>
                                                                                        <option value="Érythréenne" <?php if($nationality=="Érythréenne") echo "selected"; ?>>Érythréenne </option>
                                                                                        <option value="Espagnole" <?php if($nationality=="Espagnole") echo "selected"; ?>>Espagnole </option>
                                                                                        <option value="Est-timoraise" <?php if($nationality=="Est-timoraise") echo "selected"; ?>>Est-timoraise </option>
                                                                                        <option value="Estonienne" <?php if($nationality=="Estonienne") echo "selected"; ?>>Estonienne </option>
                                                                                        <option value="Éthiopienne" <?php if($nationality=="Éthiopienne") echo "selected"; ?>>Éthiopienne </option>
                                                                                        <option value="Fidjienne" <?php if($nationality=="Fidjienne") echo "selected"; ?>>Fidjienne </option>
                                                                                        <option value="Finlandaise" <?php if($nationality=="Finlandaise") echo "selected"; ?>>Finlandaise </option>
                                                                                        <option value="Française" <?php if($nationality=="Française" || $nationality=="") echo "selected"; ?>>Française </option>
                                                                                        <option value="Gabonaise" <?php if($nationality=="Gabonaise") echo "selected"; ?>>Gabonaise </option>
                                                                                        <option value="Gambienne" <?php if($nationality=="Gambienne") echo "selected"; ?>>Gambienne </option>
                                                                                        <option value="Georgienne" <?php if($nationality=="Georgienne") echo "selected"; ?>>Georgienne </option>
                                                                                        <option value="Ghanéenne" <?php if($nationality=="Ghanéenne") echo "selected"; ?>>Ghanéenne </option>
                                                                                        <option value="Grenadienne" <?php if($nationality=="Grenadienne") echo "selected"; ?>>Grenadienne </option>
                                                                                        <option value="Guatémaltèque" <?php if($nationality=="Guatémaltèque") echo "selected"; ?>>Guatémaltèque </option>
                                                                                        <option value="Guinéenne" <?php if($nationality=="Guinéenne") echo "selected"; ?>>Guinéenne </option>
                                                                                        <option value="Guyanienne" <?php if($nationality=="Guyanienne") echo "selected"; ?>>Guyanienne </option>
                                                                                        <option value="Haïtienne" <?php if($nationality=="Haïtienne") echo "selected"; ?>>Haïtienne </option>
                                                                                        <option value="Hellénique" <?php if($nationality=="Hellénique") echo "selected"; ?>>Hellénique </option>
                                                                                        <option value="Hondurienne" <?php if($nationality=="Hondurienne") echo "selected"; ?>>Hondurienne </option>
                                                                                        <option value="Hongroise" <?php if($nationality=="Hongroise") echo "selected"; ?>>Hongroise </option>
                                                                                        <option value="Indienne" <?php if($nationality=="Indienne") echo "selected"; ?>>Indienne </option>
                                                                                        <option value="Indonésienne" <?php if($nationality=="Indonésienne") echo "selected"; ?>>Indonésienne </option>
                                                                                        <option value="Irakienne" <?php if($nationality=="Irakienne") echo "selected"; ?>>Irakienne </option>
                                                                                        <option value="Iranienne" <?php if($nationality=="Iranienne") echo "selected"; ?>>Iranienne </option>
                                                                                        <option value="Irlandaise" <?php if($nationality=="Irlandaise") echo "selected"; ?>>Irlandaise </option>
                                                                                        <option value="Islandaise" <?php if($nationality=="Islandaise") echo "selected"; ?>>Islandaise </option>
                                                                                        <option value="Israélienne" <?php if($nationality=="Israélienne") echo "selected"; ?>>Israélienne </option>
                                                                                        <option value="Italienne" <?php if($nationality=="Italienne") echo "selected"; ?>>Italienne </option>
                                                                                        <option value="Ivoirienne" <?php if($nationality=="Ivoirienne") echo "selected"; ?>>Ivoirienne </option>
                                                                                        <option value="Jamaïcaine" <?php if($nationality=="Jamaïcaine") echo "selected"; ?>>Jamaïcaine </option>
                                                                                        <option value="Japonaise" <?php if($nationality=="Japonaise") echo "selected"; ?>>Japonaise </option>
                                                                                        <option value="Jordanienne" <?php if($nationality=="Jordanienne") echo "selected"; ?>>Jordanienne </option>
                                                                                        <option value="Kazakhstanaise" <?php if($nationality=="Kazakhstanaise") echo "selected"; ?>>Kazakhstanaise </option>
                                                                                        <option value="Kenyane" <?php if($nationality=="Kenyane") echo "selected"; ?>>Kenyane </option>
                                                                                        <option value="Kirghize" <?php if($nationality=="Kirghize") echo "selected"; ?>>Kirghize </option>
                                                                                        <option value="Kiribatienne" <?php if($nationality=="Kiribatienne") echo "selected"; ?>>Kiribatienne </option>
                                                                                        <option value="Kittitienne" <?php if($nationality=="Kittitienne") echo "selected"; ?>>Kittitienne et Névicienne </option>
                                                                                        <option value="Koweïtienne" <?php if($nationality=="Koweïtienne") echo "selected"; ?>>Koweïtienne </option>
                                                                                        <option value="Laotienne" <?php if($nationality=="Laotienne") echo "selected"; ?>>Laotienne </option>
                                                                                        <option value="Lesothane" <?php if($nationality=="Lesothane") echo "selected"; ?>>Lesothane </option>
                                                                                        <option value="Lettone" <?php if($nationality=="Lettone") echo "selected"; ?>>Lettone </option>
                                                                                        <option value="Libanaise" <?php if($nationality=="Libanaise") echo "selected"; ?>>Libanaise </option>
                                                                                        <option value="Libérienne" <?php if($nationality=="Libérienne") echo "selected"; ?>>Libérienne </option>
                                                                                        <option value="Libyenne" <?php if($nationality=="Libyenne") echo "selected"; ?>>Libyenne </option>
                                                                                        <option value="Liechtensteinoise" <?php if($nationality=="Liechtensteinoise") echo "selected"; ?>>Liechtensteinoise </option>
                                                                                        <option value="Lituanienne" <?php if($nationality=="Lituanienne") echo "selected"; ?>>Lituanienne </option>
                                                                                        <option value="Luxembourgeoise" <?php if($nationality=="Luxembourgeoise") echo "selected"; ?>>Luxembourgeoise </option>
                                                                                        <option value="Macédonienne" <?php if($nationality=="Macédonienne") echo "selected"; ?>>Macédonienne </option>
                                                                                        <option value="Malaisienne" <?php if($nationality=="Malaisienne") echo "selected"; ?>>Malaisienne </option>
                                                                                        <option value="Malawienne" <?php if($nationality=="Malawienne") echo "selected"; ?>>Malawienne </option>
                                                                                        <option value="Maldivienne" <?php if($nationality=="Maldivienne") echo "selected"; ?>>Maldivienne </option>
                                                                                        <option value="Malgache" <?php if($nationality=="Malgache") echo "selected"; ?>>Malgache </option>
                                                                                        <option value="Maliennes" <?php if($nationality=="Maliennes") echo "selected"; ?>>Maliennes </option>
                                                                                        <option value="Maltaise" <?php if($nationality=="Maltaise") echo "selected"; ?>>Maltaise </option>
                                                                                        <option value="Marocaine" <?php if($nationality=="Marocaine") echo "selected"; ?>>Marocaine </option>
                                                                                        <option value="Marshallaise" <?php if($nationality=="Marshallaise") echo "selected"; ?>>Marshallaise </option>
                                                                                        <option value="Mauricienne" <?php if($nationality=="Mauricienne") echo "selected"; ?>>Mauricienne </option>
                                                                                        <option value="Mauritanienne" <?php if($nationality=="Mauritanienne") echo "selected"; ?>>Mauritanienne </option>
                                                                                        <option value="Mexicaine" <?php if($nationality=="Mexicaine") echo "selected"; ?>>Mexicaine </option>
                                                                                        <option value="Micronésienne" <?php if($nationality=="Micronésienne") echo "selected"; ?>>Micronésienne </option>
                                                                                        <option value="Moldave" <?php if($nationality=="Moldave") echo "selected"; ?>>Moldave </option>
                                                                                        <option value="Monegasque" <?php if($nationality=="Monegasque") echo "selected"; ?>>Monegasque </option>
                                                                                        <option value="Mongole" <?php if($nationality=="Mongole") echo "selected"; ?>>Mongole </option>
                                                                                        <option value="Monténégrine" <?php if($nationality=="Monténégrine") echo "selected"; ?>>Monténégrine </option>
                                                                                        <option value="Mozambicaine" <?php if($nationality=="Mozambicaine") echo "selected"; ?>>Mozambicaine </option>
                                                                                        <option value="Namibienne" <?php if($nationality=="Namibienne") echo "selected"; ?>>Namibienne </option>
                                                                                        <option value="Nauruane" <?php if($nationality=="Nauruane") echo "selected"; ?>>Nauruane </option>
                                                                                        <option value="Néerlandaise" <?php if($nationality=="Néerlandaise") echo "selected"; ?>>Néerlandaise </option>
                                                                                        <option value="Néo-Zélandaise" <?php if($nationality=="Néo-Zélandaise") echo "selected"; ?>>Néo-Zélandaise </option>
                                                                                        <option value="Népalaise" <?php if($nationality=="Népalaise") echo "selected"; ?>>Népalaise </option>
                                                                                        <option value="Nicaraguayenne" <?php if($nationality=="Nicaraguayenne") echo "selected"; ?>>Nicaraguayenne </option>
                                                                                        <option value="Nigériane" <?php if($nationality=="Nigériane") echo "selected"; ?>>Nigériane </option>
                                                                                        <option value="Nigérienne" <?php if($nationality=="Nigérienne") echo "selected"; ?>>Nigérienne </option>
                                                                                        <option value="Niuéenne" <?php if($nationality=="Niuéenne") echo "selected"; ?>>Niuéenne </option>
                                                                                        <option value="Nord-coréenne" <?php if($nationality=="Nord-coréenne") echo "selected"; ?>>Nord-coréenne </option>
                                                                                        <option value="Norvégienne" <?php if($nationality=="Norvégienne") echo "selected"; ?>>Norvégienne </option>
                                                                                        <option value="Omanaise" <?php if($nationality=="Omanaise") echo "selected"; ?>>Omanaise </option>
                                                                                        <option value="Ougandaise" <?php if($nationality=="Ougandaise") echo "selected"; ?>>Ougandaise </option>
                                                                                        <option value="Ouzbéke" <?php if($nationality=="Ouzbéke") echo "selected"; ?>>Ouzbéke </option>
                                                                                        <option value="Pakistanaise" <?php if($nationality=="Pakistanaise") echo "selected"; ?>>Pakistanaise </option>
                                                                                        <option value="Palaosienne" <?php if($nationality=="Palaosienne") echo "selected"; ?>>Palaosienne </option>
                                                                                        <option value="Palestinienne" <?php if($nationality=="Palestinienne") echo "selected"; ?>>Palestinienne </option>
                                                                                        <option value="Panaméenne" <?php if($nationality=="Panaméenne") echo "selected"; ?>>Panaméenne </option>
                                                                                        <option value="Papouane-Néo-Guinéenne" <?php if($nationality=="Papouane-Néo-Guinéenne") echo "selected"; ?>>Papouane-Néo-Guinéenne </option>
                                                                                        <option value="Paraguayenne" <?php if($nationality=="Paraguayenne") echo "selected"; ?>>Paraguayenne </option>
                                                                                        <option value="Péruvienne" <?php if($nationality=="Péruvienne") echo "selected"; ?>>Péruvienne </option>
                                                                                        <option value="Philippine" <?php if($nationality=="Philippine") echo "selected"; ?>>Philippine </option>
                                                                                        <option value="Polonaise" <?php if($nationality=="Polonaise") echo "selected"; ?>>Polonaise </option>
                                                                                        <option value="Portugaise" <?php if($nationality=="Portugaise") echo "selected"; ?>>Portugaise </option>
                                                                                        <option value="Qatarienne" <?php if($nationality=="Qatarienne") echo "selected"; ?>>Qatarienne </option>
                                                                                        <option value="Roumaine" <?php if($nationality=="Roumaine") echo "selected"; ?>>Roumaine </option>
                                                                                        <option value="Russe" <?php if($nationality=="Russe") echo "selected"; ?>>Russe </option>
                                                                                        <option value="Rwandaise" <?php if($nationality=="Rwandaise") echo "selected"; ?>>Rwandaise </option>
                                                                                        <option value="Saint-Lucienne" <?php if($nationality=="Saint-Lucienne") echo "selected"; ?>>Saint-Lucienne </option>
                                                                                        <option value="Saint-Marinaise" <?php if($nationality=="Saint-Marinaise") echo "selected"; ?>>Saint-Marinaise </option>
                                                                                        <option value="Saint-Vincentaise et Grenadine" <?php if($nationality=="Saint-Vincentaise et Grenadine") echo "selected"; ?>>Saint-Vincentaise et Grenadine </option>
                                                                                        <option value="Salomonaise" <?php if($nationality=="Salomonaise") echo "selected"; ?>>Salomonaise </option>
                                                                                        <option value="Salvadorienne" <?php if($nationality=="Salvadorienne") echo "selected"; ?>>Salvadorienne </option>
                                                                                        <option value="Samoane" <?php if($nationality=="Samoane") echo "selected"; ?>>Samoane </option>
                                                                                        <option value="Santoméenne" <?php if($nationality=="Santoméenne") echo "selected"; ?>>Santoméenne </option>
                                                                                        <option value="Saoudienne" <?php if($nationality=="Saoudienne") echo "selected"; ?>>Saoudienne </option>
                                                                                        <option value="Sénégalaise" <?php if($nationality=="Sénégalaise") echo "selected"; ?>>Sénégalaise </option>
                                                                                        <option value="Serbe" <?php if($nationality=="Serbe") echo "selected"; ?>>Serbe </option>
                                                                                        <option value="Seychelloise" <?php if($nationality=="Seychelloise") echo "selected"; ?>>Seychelloise </option>
                                                                                        <option value="Sierra-Léonaise" <?php if($nationality=="Sierra-Léonaise") echo "selected"; ?>>Sierra-Léonaise </option>
                                                                                        <option value="Singapourienne" <?php if($nationality=="Singapourienne") echo "selected"; ?>>Singapourienne </option>
                                                                                        <option value="Slovaque" <?php if($nationality=="Slovaque") echo "selected"; ?>>Slovaque </option>
                                                                                        <option value="Slovène" <?php if($nationality=="Slovène") echo "selected"; ?>>Slovène </option>
                                                                                        <option value="Somalienne" <?php if($nationality=="Somalienne") echo "selected"; ?>>Somalienne </option>
                                                                                        <option value="Soudanaise" <?php if($nationality=="Soudanaise") echo "selected"; ?>>Soudanaise </option>
                                                                                        <option value="Sri-Lankaise" <?php if($nationality=="Sri-Lankaise") echo "selected"; ?>>Sri-Lankaise </option>
                                                                                        <option value="Sud-Africaine" <?php if($nationality=="Sud-Africaine") echo "selected"; ?>>Sud-Africaine </option>
                                                                                        <option value="Sud-Coréenne" <?php if($nationality=="Sud-Coréenne") echo "selected"; ?>>Sud-Coréenne </option>
                                                                                        <option value="Sud-Soudanaise" <?php if($nationality=="Sud-Soudanaise") echo "selected"; ?>>Sud-Soudanaise </option>
                                                                                        <option value="Suédoise" <?php if($nationality=="Suédoise") echo "selected"; ?>>Suédoise </option>
                                                                                        <option value="Suisse" <?php if($nationality=="Suisse") echo "selected"; ?>>Suisse </option>
                                                                                        <option value="Surinamaise" <?php if($nationality=="Surinamaise") echo "selected"; ?>>Surinamaise </option>
                                                                                        <option value="Swazie" <?php if($nationality=="Swazie") echo "selected"; ?>>Swazie </option>
                                                                                        <option value="Syrienne" <?php if($nationality=="Syrienne") echo "selected"; ?>>Syrienne </option>
                                                                                        <option value="Tadjike" <?php if($nationality=="Tadjike") echo "selected"; ?>>Tadjike </option>
                                                                                        <option value="Tanzanienne" <?php if($nationality=="Tanzanienne") echo "selected"; ?>>Tanzanienne </option>
                                                                                        <option value="Tchadienne" <?php if($nationality=="Tchadienne") echo "selected"; ?>>Tchadienne </option>
                                                                                        <option value="Tchèque" <?php if($nationality=="Tchèque") echo "selected"; ?>>Tchèque </option>
                                                                                        <option value="Thaïlandaise" <?php if($nationality=="Thaïlandaise") echo "selected"; ?>>Thaïlandaise </option>
                                                                                        <option value="Togolaise" <?php if($nationality=="Togolaise") echo "selected"; ?>>Togolaise </option>
                                                                                        <option value="Tonguienne" <?php if($nationality=="Tonguienne") echo "selected"; ?>>Tonguienne </option>
                                                                                        <option value="Trinidadienne" <?php if($nationality=="Trinidadienne") echo "selected"; ?>>Trinidadienne </option>
                                                                                        <option value="Tunisienne" <?php if($nationality=="Tunisienne") echo "selected"; ?>>Tunisienne </option>
                                                                                        <option value="Turkmène" <?php if($nationality=="Turkmène") echo "selected"; ?>>Turkmène </option>
                                                                                        <option value="Turque" <?php if($nationality=="Turque") echo "selected"; ?>>Turque </option>
                                                                                        <option value="Tuvaluane" <?php if($nationality=="Tuvaluane") echo "selected"; ?>>Tuvaluane </option>
                                                                                        <option value="Ukrainienne" <?php if($nationality=="Ukrainienne") echo "selected"; ?>>Ukrainienne </option>
                                                                                        <option value="Uruguayenne" <?php if($nationality=="Uruguayenne") echo "selected"; ?>>Uruguayenne </option>
                                                                                        <option value="Vanuatuane" <?php if($nationality=="Vanuatuane") echo "selected"; ?>>Vanuatuane </option>
                                                                                        <option value="Vaticane" <?php if($nationality=="Vaticane") echo "selected"; ?>>Vaticane </option>
                                                                                        <option value="Vénézuélienne" <?php if($nationality=="Vénézuélienne") echo "selected"; ?>>Vénézuélienne </option>
                                                                                        <option value="Vietnamienne" <?php if($nationality=="Vietnamienne") echo "selected"; ?>>Vietnamienne </option>
                                                                                        <option value="Yéménite" <?php if($nationality=="Yéménite") echo "selected"; ?>>Yéménite </option>
                                                                                        <option value="Zambienne" <?php if($nationality=="Zambienne") echo "selected"; ?>>Zambienne </option>
                                                                                        <option value="Zimbabwéenne" <?php if($nationality=="Zimbabwéenne") echo "selected"; ?>>Zimbabwéenne </option>
                                                                                    </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div>
Merci de remplir l'un ou l'autre des deux champs suivants : <br><br>
                                                                        <div class="form-group">
                                                                            <label for="secu" class="col-sm-3 control-label"><?php echo ss_num; ?></label>
                                                                            <div class="col-sm-6">
                                                                                <input name="secu" type="text" class="form-control" id="inputMaxLength" value="<?php echo $ss; ?>" placeholder="15 caractères" maxlength="15">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="siret" class="col-sm-3 control-label">N°d'identification</label>
                                                                            <div class="col-sm-6">
                                                                                <input name="siret" type="text" class="form-control" id="" value="<?php echo $siret; ?>" placeholder="">
                                                                            </div>
                                                                        </div>
<br><br>
                                                                        <div class="form-group">
                                                                            <label for="addr" class="col-sm-3 control-label"><?php echo adresse; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <input type="text" class="form-control" id="adr" name="adresse" value="<?php echo $addr; ?>" placeholder="Adresse" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="cp" class="col-sm-3 control-label"><?php echo cp; ?><span class="required">*</span></label>
                                                                            <div class=col-sm-6>
                                                                                <input name="cp" id="code-cp" class="form-control" placeholder="Code postal"  value="<?php if($cp!=0) echo $cp; ?>" autocomplete="off" required>
                                                                            </div>
                                                                            <!--
                                                                            <ul id="liste-cp" style="position: absolute;background-color: white;border-radius: 5px;z-index: 1000;cursor: pointer;transform: translateY(30px);box-shadow: 0 0 4px grey;<?php if(!empty($cp)) echo "display:none";?>">
                                                                                <li data-vicopo="#ville, #code-cp" data-vicopo-click='{"#code-cp": "code", "#ville": "ville"}'>
                                                                                    <strong data-vicopo-code-postal></strong>
                                                                                    <span data-vicopo-ville></span>
                                                                                </li>
                                                                            </ul>
                                                                            -->
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="city" class="col-sm-3 control-label"><?php echo ville; ?><span class="required">*</span></label>
                                                                            <div class=col-sm-6>
                                                                                <input name="city" id="ville" class="form-control" placeholder="Ville" value="<?php echo $city;?>" required>
                                                                            </div>
                                                                        </div>

                                                                        
                                                                        <div class="form-group">
                                                                            <label for="live_country" class="col-sm-3 control-label"><?php echo pays; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <select name="live_country" id="select2-example-basic" class="form-control" required>
                                                                                    <option value="">---<?php echo pays; ?>---</option>
                                                                                    <optgroup label="AMERICA">
                                                                                        <option value="Anguilla" <?php if($live_country=="Anguilla") echo "selected"; ?> label="Anguilla">Anguilla</option>
                                                                                        <option value="Antigua and Barbuda" <?php if($live_country=="Antigua and Barbuda") echo "selected"; ?> label="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                                        <option value="Argentina" <?php if($live_country=="Argentina") echo "selected"; ?> label="Argentina">Argentina</option>
                                                                                        <option value="Aruba" <?php if($live_country=="Aruba") echo "selected"; ?> label="Aruba">Aruba</option>
                                                                                        <option value="Bahamas" <?php if($live_country=="Bahamas") echo "selected"; ?> label="Bahamas">Bahamas</option>
                                                                                        <option value="Barbados" <?php if($live_country=="Barbados") echo "selected"; ?> label="Barbados">Barbados</option>
                                                                                        <option value="Belize" <?php if($live_country=="Belize") echo "selected"; ?> label="Belize">Belize</option>
                                                                                        <option value="Bermuda" <?php if($live_country=="Bermuda") echo "selected"; ?> label="Bermuda">Bermuda</option>
                                                                                        <option value="Bolivia" <?php if($live_country=="Bolivia") echo "selected"; ?> label="Bolivia">Bolivia</option>
                                                                                        <option value="Brazil" <?php if($live_country=="Brazil") echo "selected"; ?> label="Brazil">Brazil</option>
                                                                                        <option value="British Virgin Islands" <?php if($live_country=="British Virgin Islands") echo "selected"; ?> label="British Virgin Islands">British Virgin Islands</option>
                                                                                        <option value="Canada" <?php if($live_country=="Canada") echo "selected"; ?> label="Canada">Canada</option>
                                                                                        <option value="Cayman Islands" <?php if($live_country=="Cayman Islands") echo "selected"; ?> label="Cayman Islands">Cayman Islands</option>
                                                                                        <option value="Chile" <?php if($live_country=="Chile") echo "selected"; ?> label="Chile">Chile</option>
                                                                                        <option value="Colombia" <?php if($live_country=="Colombia") echo "selected"; ?> label="Colombia">Colombia</option>
                                                                                        <option value="Costa Rica" <?php if($live_country=="Costa Rica") echo "selected"; ?> label="Costa Rica">Costa Rica</option>
                                                                                        <option value="Cuba" <?php if($live_country=="Cuba") echo "selected"; ?> label="Cuba">Cuba</option>
                                                                                        <option value="Dominica" <?php if($live_country=="Dominica") echo "selected"; ?> label="Dominica">Dominica</option>
                                                                                        <option value="Dominican Republic" <?php if($live_country=="Dominican Republic") echo "selected"; ?> label="Dominican Republic">Dominican Republic</option>
                                                                                        <option value="Ecuador" <?php if($live_country=="Ecuador") echo "selected"; ?> label="Ecuador">Ecuador</option>
                                                                                        <option value="El Salvador" <?php if($live_country=="El Salvador") echo "selected"; ?> label="El Salvador">El Salvador</option>
                                                                                        <option value="Falkland Islands" <?php if($live_country=="Falkland Islands") echo "selected"; ?> label="Falkland Islands">Falkland Islands</option>
                                                                                        <option value="French Guiana" <?php if($live_country=="French Guiana") echo "selected"; ?> label="French Guiana">French Guiana</option>
                                                                                        <option value="Greenland" <?php if($live_country=="Greenland") echo "selected"; ?> label="Greenland">Greenland</option>
                                                                                        <option value="Grenada" <?php if($live_country=="Grenada") echo "selected"; ?> label="Grenada">Grenada</option>
                                                                                        <option value="Guadeloupe" <?php if($live_country=="Guadeloupe") echo "selected"; ?> label="Guadeloupe">Guadeloupe</option>
                                                                                        <option value="Guatemala" <?php if($live_country=="Guatemala") echo "selected"; ?> label="Guatemala">Guatemala</option>
                                                                                        <option value="Guyana" <?php if($live_country=="Guyana") echo "selected"; ?> label="Guyana">Guyana</option>
                                                                                        <option value="Haiti" <?php if($live_country=="Haiti") echo "selected"; ?> label="Haiti">Haiti</option>
                                                                                        <option value="Honduras" <?php if($live_country=="Honduras") echo "selected"; ?> label="Honduras">Honduras</option>
                                                                                        <option value="Jamaica" <?php if($live_country=="Jamaica") echo "selected"; ?> label="Jamaica">Jamaica</option>
                                                                                        <option value="Martinique" <?php if($live_country=="Martinique") echo "selected"; ?> label="Martinique">Martinique</option>
                                                                                        <option value="Mexico" <?php if($live_country=="Mexico") echo "selected"; ?> label="Mexico">Mexico</option>
                                                                                        <option value="Montserrat" <?php if($live_country=="Montserrat") echo "selected"; ?> label="Montserrat">Montserrat</option>
                                                                                        <option value="Netherlands Antilles" <?php if($live_country=="Netherlands Antilles") echo "selected"; ?> label="Netherlands Antilles">Netherlands Antilles</option>
                                                                                        <option value="Nicaragua" <?php if($live_country=="Nicaragua") echo "selected"; ?> label="Nicaragua">Nicaragua</option>
                                                                                        <option value="Panama" <?php if($live_country=="Panama") echo "selected"; ?> label="Panama">Panama</option>
                                                                                        <option value="Paraguay" <?php if($live_country=="Paraguay") echo "selected"; ?> label="Paraguay">Paraguay</option>
                                                                                        <option value="Peru" <?php if($live_country=="Peru") echo "selected"; ?> label="Peru">Peru</option>
                                                                                        <option value="Puerto Rico" <?php if($live_country=="Puerto Rico") echo "selected"; ?> label="Puerto Rico">Puerto Rico</option>
                                                                                        <option value="Saint Barthélemy" <?php if($live_country=="Saint Barthélemy") echo "selected"; ?> label="Saint Barthélemy">Saint Barthélemy</option>
                                                                                        <option value="Saint Kitts and Nevis" <?php if($live_country=="Saint Kitts and Nevis") echo "selected"; ?> label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                                        <option value="Saint Lucia" <?php if($live_country=="Saint Lucia") echo "selected"; ?> label="Saint Lucia">Saint Lucia</option>
                                                                                        <option value="Saint Martin" <?php if($live_country=="Saint Martin") echo "selected"; ?> label="Saint Martin">Saint Martin</option>
                                                                                        <option value="Saint Pierre and Miquelon" <?php if($live_country=="Saint Pierre and Miquelon") echo "selected"; ?> label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                                        <option value="Saint Vincent and the Grenadines" <?php if($live_country=="Saint Vincent and the Grenadines") echo "selected"; ?> label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                                                        <option value="Suriname" <?php if($live_country=="Suriname") echo "selected"; ?> label="Suriname">Suriname</option>
                                                                                        <option value="Trinidad and Tobago" <?php if($live_country=="Trinidad and Tobago") echo "selected"; ?> label="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                                        <option value="Turks and Caicos Islands" <?php if($live_country=="Turks and Caicos Islands") echo "selected"; ?> label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                                        <option value="U.S. Virgin Islands" <?php if($live_country=="U.S. Virgin Islands") echo "selected"; ?> label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                                                                        <option value="United States" <?php if($live_country=="United States") echo "selected"; ?> label="United States">United States</option>
                                                                                        <option value="Uruguay" <?php if($live_country=="Uruguay") echo "selected"; ?> label="Uruguay">Uruguay</option>
                                                                                        <option value="Venezuela" <?php if($live_country=="Venezuela") echo "selected"; ?> label="Venezuela">Venezuela</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="ASIA">
                                                                                        <option value="Afghanistan" <?php if($live_country=="Afghanistan") echo "selected"; ?> label="Afghanistan">Afghanistan</option>
                                                                                        <option value="Armenia" <?php if($live_country=="Armenia") echo "selected"; ?> label="Armenia">Armenia</option>
                                                                                        <option value="Azerbaijan" <?php if($live_country=="Azerbaijan") echo "selected"; ?> label="Azerbaijan">Azerbaijan</option>
                                                                                        <option value="Bahrain" <?php if($live_country=="Bahrain") echo "selected"; ?> label="Bahrain">Bahrain</option>
                                                                                        <option value="Bangladesh" <?php if($live_country=="Bangladesh") echo "selected"; ?> label="Bangladesh">Bangladesh</option>
                                                                                        <option value="Bhutan" <?php if($live_country=="Bhutan") echo "selected"; ?> label="Bhutan">Bhutan</option>
                                                                                        <option value="Brunei" <?php if($live_country=="Brunei") echo "selected"; ?> label="Brunei">Brunei</option>
                                                                                        <option value="Cambodia" <?php if($live_country=="Cambodia") echo "selected"; ?> label="Cambodia">Cambodia</option>
                                                                                        <option value="China" <?php if($live_country=="China") echo "selected"; ?> label="China">China</option>
                                                                                        <option value="Cyprus" <?php if($live_country=="Cyprus") echo "selected"; ?> label="Cyprus">Cyprus</option>
                                                                                        <option value="Georgia" <?php if($live_country=="Georgia") echo "selected"; ?> label="Georgia">Georgia</option>
                                                                                        <option value="Hong Kong SAR China" <?php if($live_country=="Hong Kong SAR China") echo "selected"; ?> label="Hong Kong SAR China">Hong Kong SAR China</option>
                                                                                        <option value="India" <?php if($live_country=="India") echo "selected"; ?> label="India">India</option>
                                                                                        <option value="Indonesia" <?php if($live_country=="Indonesia") echo "selected"; ?> label="Indonesia">Indonesia</option>
                                                                                        <option value="Iran" <?php if($live_country=="Iran") echo "selected"; ?> label="Iran">Iran</option>
                                                                                        <option value="Iraq" <?php if($live_country=="Iraq") echo "selected"; ?> label="Iraq">Iraq</option>
                                                                                        <option value="Israel" <?php if($live_country=="Israel") echo "selected"; ?> label="Israel">Israel</option>
                                                                                        <option value="Japan" <?php if($live_country=="Japan") echo "selected"; ?> label="Japan">Japan</option>
                                                                                        <option value="Jordan" <?php if($live_country=="Jordan") echo "selected"; ?> label="Jordan">Jordan</option>
                                                                                        <option value="Kazakhstan" <?php if($live_country=="Kazakhstan") echo "selected"; ?> label="Kazakhstan">Kazakhstan</option>
                                                                                        <option value="Kuwait" <?php if($live_country=="Kuwait") echo "selected"; ?> label="Kuwait">Kuwait</option>
                                                                                        <option value="Kyrgyzstan" <?php if($live_country=="Kyrgyzstan") echo "selected"; ?> label="Kyrgyzstan">Kyrgyzstan</option>
                                                                                        <option value="Laos" <?php if($live_country=="Laos") echo "selected"; ?> label="Laos">Laos</option>
                                                                                        <option value="Lebanon" <?php if($live_country=="Lebanon") echo "selected"; ?> label="Lebanon">Lebanon</option>
                                                                                        <option value="Macau SAR China" <?php if($live_country=="Macau SAR China") echo "selected"; ?> label="Macau SAR China">Macau SAR China</option>
                                                                                        <option value="Malaysia" <?php if($live_country=="Malaysia") echo "selected"; ?> label="Malaysia">Malaysia</option>
                                                                                        <option value="Maldives" <?php if($live_country=="Maldives") echo "selected"; ?> label="Maldives">Maldives</option>
                                                                                        <option value="Mongolia" <?php if($live_country=="Mongolia") echo "selected"; ?> label="Mongolia">Mongolia</option>
                                                                                        <option value="Myanmar [Burma]" <?php if($live_country=="Myanmar [Burma]") echo "selected"; ?> label="Myanmar [Burma]">Myanmar [Burma]</option>
                                                                                        <option value="Nepal" <?php if($live_country=="Nepal") echo "selected"; ?> label="Nepal">Nepal</option>
                                                                                        <option value="Neutral Zone" <?php if($live_country=="Neutral Zone") echo "selected"; ?> label="Neutral Zone">Neutral Zone</option>
                                                                                        <option value="North Korea" <?php if($live_country=="North Korea") echo "selected"; ?> label="North Korea">North Korea</option>
                                                                                        <option value="Oman" <?php if($live_country=="Oman") echo "selected"; ?> label="Oman">Oman</option>
                                                                                        <option value="Pakistan" <?php if($live_country=="Pakistan") echo "selected"; ?> label="Pakistan">Pakistan</option>
                                                                                        <option value="Palestinian Territories" <?php if($live_country=="Palestinian Territories") echo "selected"; ?> label="Palestinian Territories">Palestinian Territories</option>
                                                                                        <option value="People's Democratic Republic of Yemen" <?php if($live_country=="People's Democratic Republic of Yemen") echo "selected"; ?> label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                                                                        <option value="Philippines" <?php if($live_country=="Philippines") echo "selected"; ?> label="Philippines">Philippines</option>
                                                                                        <option value="Qatar" <?php if($live_country=="Qatar") echo "selected"; ?> label="Qatar">Qatar</option>
                                                                                        <option value="Saudi Arabia" <?php if($live_country=="Saudi Arabia") echo "selected"; ?> label="Saudi Arabia">Saudi Arabia</option>
                                                                                        <option value="Singapore" <?php if($live_country=="Singapore") echo "selected"; ?> label="Singapore">Singapore</option>
                                                                                        <option value="South Korea" <?php if($live_country=="South Korea") echo "selected"; ?> label="South Korea">South Korea</option>
                                                                                        <option value="Sri Lanka" <?php if($live_country=="Sri Lanka") echo "selected"; ?> label="Sri Lanka">Sri Lanka</option>
                                                                                        <option value="Syria" <?php if($live_country=="Syria") echo "selected"; ?> label="Syria">Syria</option>
                                                                                        <option value="Taiwan" <?php if($live_country=="Taiwan") echo "selected"; ?> label="Taiwan">Taiwan</option>
                                                                                        <option value="Tajikistan" <?php if($live_country=="Tajikistan") echo "selected"; ?> label="Tajikistan">Tajikistan</option>
                                                                                        <option value="Thailand" <?php if($live_country=="Thailand") echo "selected"; ?> label="Thailand">Thailand</option>
                                                                                        <option value="Timor-Leste" <?php if($live_country=="Timor-Leste") echo "selected"; ?> label="Timor-Leste">Timor-Leste</option>
                                                                                        <option value="Turkey" <?php if($live_country=="Turkey") echo "selected"; ?> label="Turkey">Turkey</option>
                                                                                        <option value="Turkmenistan"  <?php if($live_country=="Turkmenistan") echo "selected"; ?> label="Turkmenistan">Turkmenistan</option>
                                                                                        <option value="United Arab Emirates" <?php if($live_country=="United Arab Emirates") echo "selected"; ?> label="United Arab Emirates">United Arab Emirates</option>
                                                                                        <option value="Uzbekistan" <?php if($live_country=="Uzbekistan") echo "selected"; ?> label="Uzbekistan">Uzbekistan</option>
                                                                                        <option value="Vietnam" <?php if($live_country=="Vietnam") echo "selected"; ?> label="Vietnam">Vietnam</option>
                                                                                        <option value="Yemen" <?php if($live_country=="Yemen") echo "selected"; ?> label="Yemen">Yemen</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="EUROPE">
                                                                                        <option value="Albania" <?php if($live_country=="Andorra") echo "selected"; ?> label="Andorra">Andorra</option>
                                                                                        <option value="Andorra" <?php if($live_country=="Albania") echo "selected"; ?> label="Albania">Albania</option>
                                                                                        <option value="Austria" <?php if($live_country=="Austria") echo "selected"; ?> label="Austria">Austria</option>
                                                                                        <option value="Belarus" <?php if($live_country=="Belarus") echo "selected"; ?> label="Belarus">Belarus</option>
                                                                                        <option value="Belgium" <?php if($live_country=="Belgium") echo "selected"; ?> label="Belgium">Belgium</option>
                                                                                        <option value="Bosnia and Herzegovina" <?php if($live_country=="Bosnia and Herzegovina") echo "selected"; ?> label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                                        <option value="Bulgaria" <?php if($live_country=="Bulgaria") echo "selected"; ?> label="Bulgaria">Bulgaria</option>
                                                                                        <option value="Croatia" <?php if($live_country=="Croatia") echo "selected"; ?> label="Croatia">Croatia</option>
                                                                                        <option value="Cyprus" <?php if($live_country=="Cyprus") echo "selected"; ?> label="Cyprus">Cyprus</option>
                                                                                        <option value="Czech Republic" <?php if($live_country=="Czech Republic") echo "selected"; ?> label="Czech Republic">Czech Republic</option>
                                                                                        <option value="Denmark" <?php if($live_country=="Denmark") echo "selected"; ?> label="Denmark">Denmark</option>
                                                                                        <option value="East Germany" <?php if($live_country=="East Germany") echo "selected"; ?> label="East Germany">East Germany</option>
                                                                                        <option value="Estonia" <?php if($live_country=="Estonia") echo "selected"; ?> label="Estonia">Estonia</option>
                                                                                        <option value="Faroe Islands" <?php if($live_country=="Faroe Islands") echo "selected"; ?> label="Faroe Islands">Faroe Islands</option>
                                                                                        <option value="Finland" <?php if($live_country=="Finland") echo "selected"; ?> label="Finland">Finland</option>
                                                                                        <option value="France" <?php if($live_country=="France" || $live_country=="") echo "selected"; ?> label="France">France</option>
                                                                                        <option value="Germany" <?php if($live_country=="Germany") echo "selected"; ?> label="Germany">Germany</option>
                                                                                        <option value="Gibraltar" <?php if($live_country=="Gibraltar") echo "selected"; ?> label="Gibraltar">Gibraltar</option>
                                                                                        <option value="Greece" <?php if($live_country=="Greece") echo "selected"; ?> label="Greece">Greece</option>
                                                                                        <option value="Guernsey" <?php if($live_country=="Guernsey") echo "selected"; ?> label="Guernsey">Guernsey</option>
                                                                                        <option value="Hungary" <?php if($live_country=="Hungary") echo "selected"; ?> label="Hungary">Hungary</option>
                                                                                        <option value="Iceland" <?php if($live_country=="Iceland") echo "selected"; ?> label="Iceland">Iceland</option>
                                                                                        <option value="Ireland" <?php if($live_country=="Ireland") echo "selected"; ?> label="Ireland">Ireland</option>
                                                                                        <option value="Isle of Man" <?php if($live_country=="Isle of Man") echo "selected"; ?> label="Isle of Man">Isle of Man</option>
                                                                                        <option value="Italy" <?php if($live_country=="Italy") echo "selected"; ?> label="Italy">Italy</option>
                                                                                        <option value="Jersey" <?php if($live_country=="Jersey") echo "selected"; ?> label="Jersey">Jersey</option>
                                                                                        <option value="Latvia" <?php if($live_country=="Latvia") echo "selected"; ?> label="Latvia">Latvia</option>
                                                                                        <option value="Liechtenstein" <?php if($live_country=="Liechtenstein") echo "selected"; ?> label="Liechtenstein">Liechtenstein</option>
                                                                                        <option value="Lithuania" <?php if($live_country=="Lithuania") echo "selected"; ?> label="Lithuania">Lithuania</option>
                                                                                        <option value="Luxembourg" <?php if($live_country=="Luxembourg") echo "selected"; ?> label="Luxembourg">Luxembourg</option>
                                                                                        <option value="Macedonia" <?php if($live_country=="Macedonia") echo "selected"; ?> label="Macedonia">Macedonia</option>
                                                                                        <option value="Malta" <?php if($live_country=="Malta") echo "selected"; ?> label="Malta">Malta</option>
                                                                                        <option value="Metropolitan France" <?php if($live_country=="Metropolitan France") echo "selected"; ?> label="Metropolitan France">Metropolitan France</option>
                                                                                        <option value="Moldova" <?php if($live_country=="Moldova") echo "selected"; ?> label="Moldova">Moldova</option>
                                                                                        <option value="Monaco" <?php if($live_country=="Monaco") echo "selected"; ?> label="Monaco">Monaco</option>
                                                                                        <option value="Montenegro" <?php if($live_country=="Montenegro") echo "selected"; ?> label="Montenegro">Montenegro</option>
                                                                                        <option value="Netherlands" <?php if($live_country=="Netherlands") echo "selected"; ?> label="Netherlands">Netherlands</option>
                                                                                        <option value="Norway" <?php if($live_country=="Norway") echo "selected"; ?> label="Norway">Norway</option>
                                                                                        <option value="Poland" <?php if($live_country=="Poland") echo "selected"; ?> label="Poland">Poland</option>
                                                                                        <option value="Portugal" <?php if($live_country=="Portugal") echo "selected"; ?> label="Portugal">Portugal</option>
                                                                                        <option value="Romania" <?php if($live_country=="Romania") echo "selected"; ?> label="Romania">Romania</option>
                                                                                        <option value="Russia" <?php if($live_country=="Russia") echo "selected"; ?> label="Russia">Russia</option>
                                                                                        <option value="Sann Marino" <?php if($live_country=="Sann Marino") echo "selected"; ?> label="San Marino">San Marino</option>
                                                                                        <option value="Serbia" <?php if($live_country=="Serbia") echo "selected"; ?> label="Serbia">Serbia</option>
                                                                                        <option value="Serbia and Montenegro" <?php if($live_country=="Serbia and Montenegro") echo "selected"; ?> label="Serbia and Montenegro">Serbia and Montenegro</option>
                                                                                        <option value="Slovakia" <?php if($live_country=="Slovakia") echo "selected"; ?> label="Slovakia">Slovakia</option>
                                                                                        <option value="Slovenia" <?php if($live_country=="Slovenia") echo "selected"; ?> label="Slovenia">Slovenia</option>
                                                                                        <option value="Spain" <?php if($live_country=="Spain") echo "selected"; ?> label="Spain">Spain</option>
                                                                                        <option value="Svalbard and Jan Mayen" <?php if($live_country=="Svalbard and Jan Mayen") echo "selected"; ?> label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                                                        <option value="Sweden" <?php if($live_country=="Sweden") echo "selected"; ?> label="Sweden">Sweden</option>
                                                                                        <option value="Switzerland" <?php if($live_country=="Switzerland") echo "selected"; ?> label="Switzerland">Switzerland</option>
                                                                                        <option value="Ukraine" <?php if($live_country=="Ukraine") echo "selected"; ?> label="Ukraine">Ukraine</option>
                                                                                        <option value="Union of Soviet Socialist Republics" <?php if($live_country=="Union of Soviet Socialist Republics") echo "selected"; ?> label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                                                                        <option value="United Kingdom" <?php if($live_country=="United Kingdom") echo "selected"; ?> label="United Kingdom">United Kingdom</option>
                                                                                        <option value="Vatican City" <?php if($live_country=="Vatican City") echo "selected"; ?> label="Vatican City">Vatican City</option>
                                                                                        <option value="Åland Islands" <?php if($live_country=="Åland Islands") echo "selected"; ?> label="Åland Islands">Åland Islands</option>
                                                                                    </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="checkbox-custom checkbox-primary">
                                                                            <input type="checkbox" id="check-s1" name="rqth" <?php if($rqth) echo "checked"; ?>>
                                                                            <label class="check" for="check-s1"><?php echo rqth; ?></label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-9">
                                                                <button type="submit" name="valider" class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait.."><?php echo enregistrer; ?></button>
                                                               
                                                                <!--DANGER modal-->
                                                                <button type="button" class="btn btn-wide btn-danger" data-toggle="modal" data-target="#error-modal" method="post" action="profil.php"><?php echo modify_pass; ?></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="modal-error-label">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <form class="form-horizontal form-stripe" method="post" action="profil.php">
                                                                    <div class="modal-header state modal-danger">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="modal-error-label"><i class="fa fa-warning"></i><?php echo modify_pass; ?></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="last_mdp" class="col-sm-3 control-label"><?php echo last_pass; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <input type="password" class="form-control" name="last_mdp" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="new_mdp" class="col-sm-3 control-label"><?php echo new_pass; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <input type="password" class="form-control" name="new_mdp" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="renew_mdp" class="col-sm-3 control-label"><?php echo re_pass; ?><span class="required">*</span></label>
                                                                            <div class="col-sm-6">
                                                                                <input type="password" class="form-control" name="renew_mdp" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="modify_mdp" class="btn btn-danger">Ok</button>
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
<script>
/*
    $(":input").inputmask();
    document.getElementById("code-cp").addEventListener('keypress', (event) => {
        document.getElementById("liste-cp").style.display="block";
        event.stopPropagation();
    });
    */
    
    $("#phone-number").inputmask("09 99 99 99 99",{ "onincomplete": function(){ document.getElementById("phone-message").style.display='block'; document.getElementById("phone-message-valid").style.display='none'}, "oncomplete": function(){ document.getElementById("phone-message").style.display='none'; document.getElementById("phone-message-valid").style.display='block'} });
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
