<?php

// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0


define('LOCAL', ( preg_match("/^(concord\.local|192\.168\.)/i", $_SERVER['HTTP_HOST']) ? TRUE : FALSE )); // LOCAL DEV SERVER


if (!defined('ACCESS')) die("access temporarily restricted");

if ( !defined('CRON') && LOCAL == FALSE ) { // IF NOT RUN BY CRONTAB OR LOCAL CONTINUE
	// MAKE SURE THE URL HAS THE www. IN FRONT OF IT
	if ( !preg_match("/www\./i", $_SERVER['HTTP_HOST']) || preg_match("/\.$|\:/", $_SERVER['HTTP_HOST']) ) {
		header("location:http://www.". DOMAIN . $_SERVER['REQUEST_URI']);
	} elseif ( defined('SSL') ) { // IS SSL REQUIRED ON THE PAGE --> define('SSL',TRUE); // ADD TO PAGE HEADER
		if ( !$_SERVER['HTTPS'] ) header("location:https://www.". DOMAIN . $_SERVER['REQUEST_URI']);
	}
}


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0
session_start();



// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0

////////// SITE CONSTANTS
/////////////////////////////////////////////////////////////////////////////////////
define('ERROR_MESSAGE', 'ACCESS TEMPORARILY RESTRICTED'); // ERROR_MESSAGE
define('CRYPT_REF_ID',sha1('REF_ID'));
define('FORM_WIDTH',340);

$config[forms][width] = 340;
$config[image][types] = array(
	1=>"photograph",
	2=>"construction",
	"process"=>array(
		3=>"sketches",
		4=>"renderings / visualization",
		5=>"models"),
	"drawings"=>array(
		6=>"plans",
		7=>"sections",
		8=>"elevations",
		9=>"sections",
		10=>"details",
		11=>"site plan"),
	12=>"map");// ,"photographers"=>array("")

// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0

////////// DATABASE CONNECTION
/////////////////////////////////////////////////////////////////////////////////////
// On aaPanel, secure files live above web root
// Adjust this path to match your server's secure directory location
$secure_dir = (LOCAL ? dirname(__FILE__) : "/www/wwwroot/secure/archxchange");
require($secure_dir . "/db.php"); // CONNECT TO DB



////////// LAYOUT SETTINGS
/////////////////////////////////////////////////////////////////////////////////////

////////// IMAGE PREFERENCES 
//define('THUMB_DISPLAY', '80'); // THUMBNAIL DISPLAY SIZE
//define('THUMB_SIZE', '100'); // ACTUAL THUMBNAIL SIZE



////////// DOMAIN SETTINGS
//define('DOMAIN', preg_replace("/(www\.)/i","","www.archxchange.com")); // remove www for emails, etc.


////////// SITE SETTINGS
/////////////////////////////////////////////////////////////////////////////////////
define('DEFAULT_TITLE', 'Welcome to ' . DOMAIN); // WEB PAGE TITLE
//define('IMAGE_HEADER_01', '01'); // WEB PAGE TITLE  ***************************************************************
//define('ERROR_MESSAGE', 'YOU DO NOT HAVE ACCESS TO VIEW THIS PAGE'); // ERROR_MESSAGE


////////// SECURITY ACCESS
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// SITE ACCESS
/*if ( $config = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM config LIMIT 1") ));
if ( $config[status] > 0 ) {
	define('SITE_ACCESS', '$config[status]'); // SITE ACCESS FROM SITE DB
} else {
	define('SITE_ACCESS', '0'); // 
}*/


////////// FUNCTIONS
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
require(TEMPLATE_BASE_DIR . "_functions/fnc.php"); // QUERY


?>
