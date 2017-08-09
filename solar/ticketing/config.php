<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/
session_start();

$base_url= filter_var('', FILTER_SANITIZE_URL);

// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
define('CLIENT_ID','737582773898-s4mm5icfspplc31ifolic1cl5fncnj14.apps.googleusercontent.com');
define('CLIENT_SECRET','B1b_roKYMlfZdlPLsli6jIoc');
define('REDIRECT_URI','http://localhost/solar/ticketing/index.php');
define('APPROVAL_PROMPT','auto');
define('ACCESS_TYPE','offline');
?>