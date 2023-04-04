<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'ensp_arles_com');
define('DB_PASSWORD', 'po78erter');
define('DB_NAME', 'ensp_arles_com');
define('DB_USER_TBL', 'membres');

// Google API configuration
define('GOOGLE_CLIENT_ID', '1005639712504-ejt156oi1e0934n311heb2h2juhmk21d.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'SEh62Hb1UXSgTzEJb7nJsJOX');
define('GOOGLE_REDIRECT_URL', 'https://intervenants.ensp-arles.fr/admin');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('IntervenantS ENSP');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);