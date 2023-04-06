<?php include_once 'Controller/function.php';
require_once 'Model/Files.php';
require_once 'Model/Dossier.php';

$files = new Files();
$dossier = new Dossier();
?>

  <!-- ========================================================= -->
            <div id="left-nav" class="nano">
                <div class="nano-content">
                    <nav>
                        <ul class="nav" id="main-nav">
                            <!--HOME-->
                            <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>
	                            <span><?php echo dashboard; ?></span></a>
	                         </li>
	                         
	                           <li><a href="profil.php"><i class="fa fa-pencil" aria-hidden="true"></i>
	                            <span><?php echo infos_perso; ?></span></a>
	                         </li>
							 <li>
								<?php if($files->allFilesExist()){?>
									<a href="fichier.php"><i class="fa fa-files-o" aria-hidden="true"></i>
										<span><?php echo fichiers; ?></span></a>
								<?php }else{?>
									<a href="fichier.php"><i class="fa fa-files-o" aria-hidden="true"></i>
										<span style="color: #d2322d;"><?php echo fichiers.' ⚠'; ?></span></a>
								<?php }?>
							 </li>

							 <?php if($dossier->areProfilsComplete()){?>
	                           <li><a href="dossiers.php"><i class="fa fa-files-o" aria-hidden="true"></i>
	                            <span><?php echo dossiers; ?></span></a>
								<?php }else{?>
									<li><a href="dossiers.php"><i class="fa fa-files-o" aria-hidden="true"></i>
										<span style="color: #d2322d;"><?php echo dossiers.' ⚠'; ?></span></a>
								<?php }?>
								
	                         </li>
	                           <li><a href="ticket.php"><i class="fa fa-ticket" aria-hidden="true"></i></i>
	                            <span>Tickets</span></a>
	                         </li>
	                          <li><a href="faq.php"><i class="fa fa-question-circle" aria-hidden="true"></i></i>
	                            <span>FAQ</span></a>
	                         </li>

                         </ul>
                    </nav>
                </div>
            </div>
      