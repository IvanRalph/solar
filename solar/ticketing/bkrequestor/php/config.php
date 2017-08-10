<?php
/**
@author muni
@copyright http:www.smarttutorials.net
 */

require_once 'messages.php';

//site specific configuration declartion
define( 'BASE_PATH', 'http://localhost/user_login/index.php');
define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', '');
define( 'DB_NAME', 'user_login');

//Google App Details
define('GOOGLE_APP_NAME', 'CultivatingHappyness Google+ login');
define('GOOGLE_OAUTH_CLIENT_ID', 'YOUR CLIENT ID');
define('GOOGLE_OAUTH_CLIENT_SECRET', 'YOUR CLIENT SECRET');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://localhost/user_login/');
define("GOOGLE_SITE_NAME", 'http://localhost/');

function __autoload($class)
{
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}
?>