 <?php 
 require_once "Model/Dossier.php";
 $Dossier_head = new Dossier();
 ?>
 <!-- page HEADER -->
    <!-- ========================================================= -->
    <div class="page-header">
        <!-- LEFTSIDE header -->
        <div class="leftside-header">
            <div class="logo">
                <a href="index.php" class="on-click">
                    <img alt="logo" src="assets/img/header-logo.png" />
                </a>
            </div>
            <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
        <!-- RIGHTSIDE header -->
        <div class="rightside-header">
            <div class="header-middle"></div>
            
           
                       
            <!--NOCITE HEADERBOX-->
            <div class="header-section hidden-xs" id="notice-headerbox">
            <?php 
            if($Dossier_head->haveToComplete($id_user)>1)
                echo "<span class='badge b-rounded x-success' style='background-color: #88b93c; margin-right: 5px;' ><i class='fa fa-bell'></i> ".$Dossier_head->haveToComplete($id_user)." ".dossiers_to_complete." </span>";
            else if($Dossier_head->haveToComplete($id_user)==1)
                echo "<span class='badge b-rounded x-success' style='background-color: #88b93c; margin-right: 5px;'><i class='fa fa-bell'></i> 1 ".dossier_to_complete." </span>";
            else if($Dossier_head->haveToComplete($id_user)==0)
                echo "<span class='badge b-rounded x-success' style='background-color: #88b93c; margin-right: 5px;'><i class='fa fa-check'></i> ".no_dossier." </span>";
            ?>
              <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>&lang=fr"><img src="assets/img/fr.png"></a> <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>&lang=en"><img src="assets/img/en.png"></a>
                <div class="header-separator"></div>
            </div>
            <!--USER HEADERBOX -->
            <div class="header-section" id="user-headerbox">
                <div class="user-header-wrap">
                                      <div class="user-info">
                        <span class="user-name"><?php echo $_SESSION['member_username']; ?></span>
                    </div>
                   
                </div>
             
            </div>
            <div class="header-separator"></div>
            <!--Log out -->
            <div class="header-section">
                <a href="index.php?logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>