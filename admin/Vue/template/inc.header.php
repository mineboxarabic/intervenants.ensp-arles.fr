 <!-- page HEADER -->
    <!-- ========================================================= -->
    <?php header('Content-Type: text/html; charset=utf-8'); ?>
    <div class="page-header">
        <!-- LEFTSIDE header -->
        <div class="leftside-header">
            <div class="logo">
                <a href="index.php" class="on-click">
                    <img alt="logo" src="../assets/img/header-logo.png" />
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
              <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>&lang=fr"><img src="../assets/img/fr.png"></a> <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>&lang=en"><img src="../assets/img/en.png"></a>
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
                <a href="logout.php"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>