<?php
// Start a fresh session::
if (!isset($_SESSION)) {
	session_start();
}


// Database settings, change these to match your server::
// Any problems email me:: john@suburbanarctic.com

///////// PROD ///////////

	if (!defined('DB_HOST')) define('DB_HOST','localhost');
 	if (!defined('DB_USER')) define('DB_USER','ensp_arles_com');
 	if (!defined('DB_PASS')) define('DB_PASS','po78erter');
 	if (!defined('DB_NAME')) define('DB_NAME','ensp_arles_com');



//////////// DEV ////////

/*
if (!defined('DB_HOST')) define('DB_HOST','localhost');
if (!defined('DB_USER')) define('DB_USER','root');
if (!defined('DB_PASS')) define('DB_PASS','');
if (!defined('DB_NAME')) define('DB_NAME','ensp_arles_com');
*/

/**
*	How many login attempts before they are locked out? DEFAULT 3::
*/
if (!defined('NUMBER_OF_ATTEMPTS')) define('NUMBER_OF_ATTEMPTS',8);

/**
*	The default domain name and project location for your app::
*	EG: http://suburbanarctic.com/secure-login/
*	MAKE SURE YOU LEAVE A TRAILING SLASH / << OK!!!!
*/
if (!defined('DOMAIN_NAME')) define('DOMAIN_NAME','https://intervenants.ensp-arles.fr/login.php');

/**
*	Name of your website::
*	EG: Suburban Arctic::
*/
if (!defined('SITE_NAME')) define('SITE_NAME','Intervenants ENSP');

/**
*	No-Reply email extension this should be your domain name like so::
*	EG: suburbanarctic.com
*/
if (!defined('EMAIL_EXT')) define('EMAIL_EXT','ensp-arles.fr');

// Just to define the applications version::
if (!defined('VERSION')) define('VERSION','2.0');

?>