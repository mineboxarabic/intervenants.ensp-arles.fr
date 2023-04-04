<?php
 $host = 	'localhost';                                                        
 $user = 	'ensp_arles_com';                                                    
 $passwd = 	'po78erter';                                                                                                         
 $db=		'ensp_arles_com';
 mysql_connect($host,$user,$passwd) or die("erreur de connexion au serveur"); 
 mysql_select_db($db) or die("erreur de connexion a la base de donnees");   
 
    
?>