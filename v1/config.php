<?php

// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if (!defined('ACCESS')) die("access temporarily restricted");
/*
if ( !defined('CRON') && !LOCAL ) { // IF NOT RUN BY CRONTAB CONTINUE
	
	// MAKE SURE THE URL HAS THE www. IN FRONT OF IT
	//( !preg_match("/faq.php|index.php|contact.php|products.php/i",$_SERVER['PHP_SELF']) ) // DO NOT REDIRECT TO www ON THESE PAGES
	//if ( !preg_match("/www./i",$_SERVER['HTTP_HOST']) || preg_match("/\.$|\:80$/i",$_SERVER['HTTP_HOST']) ) {
	if ( !preg_match("/www./i",$_SERVER['HTTP_HOST']) || preg_match("/\.$|\:80$/i",$_SERVER['HTTP_HOST']) ) {
		header("location:http://www.". DOMAIN . ${_SERVER}['REQUEST_URI']);
	} elseif ( defined('SSL') ) { // IS SSL REQUIRED ON THE PAGE --> define('SSL',TRUE); // ADD TO PAGE HEADER
		if ( !$_SERVER['HTTPS'] ) header("location:https://www.". DOMAIN . ${_SERVER}['REQUEST_URI']);
			
	}

}*/


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0


////////// SITE CONSTANTS (security risk variables are set here as constants)
/////////////////////////////////////////////////////////////////////////////////////
define('SITE_ACCESS', '0'); // SITE DEVELOPMENT STATE
	// 0 (NORMAL), 1 (NO VIEWING), 2 (NO LOGIN), 3 (NO ACCOUNT CHANGES)

// GLOBAL // define('LOCAL', ( preg_match("/^(concord.local|192\.168\.)/i",$_SERVER['HTTP_HOST']) ? TRUE : FALSE )); // LOCAL DEV SERVER

////////// SET DEVELOPMENT STATE
define('DEV_TRANS', TRUE); // DEVELOPER TRANSLATION STATE
define('DEV', (LOCAL ? TRUE : FALSE)); // DEVELOPER STATE

// we may possibly change these to less security risk config variables
//{$config['dev'] = TRUE; // DEVELOPER STATE
//{$config['dev_trans'] = TRUE; // DEVELOPER STATE


////////// DEVELOPMENT STATE
if ( DEV == TRUE ) {
	ini_set('display_errors', 1); // Ensure errors get to the user.
	error_reporting(E_ALL & ~E_NOTICE);
}


////////// DOMAIN SETTINGS
define('DOMAIN', preg_replace("/(www\.)/i","","www.archxchange.com")); // remove www for emails, etc.


////////// SITE SETTINGS
/////////////////////////////////////////////////////////////////////////////////////
define('DEFAULT_TITLE', 'Welcome to ' . DOMAIN); // WEB PAGE TITLE
//define('IMAGE_HEADER_01', '01'); // WEB PAGE TITLE  ***************************************************************
//define('ERROR_MESSAGE', 'ACCESS TEMPORARILY RESTRICTED'); // ERROR_MESSAGE



// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0



////////// FUNCTIONS
/////////////////////////////////////////////////////////////////////////////////////
//require(BASE_DIR . "_functions/fnc.php"); // QUERY
require(BASE_DIR . "../../config_global.php"); // QUERY
define('ROOT_DIR', '/home/archx/'); // WEB PAGE TITLE



// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// SEARCH ENGINE OPTIMIZATION 
/////////////////////////////////////////////////////////////////////////////////////

// write the HTML headers
//header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	// Date in the past
//header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	// always modified
//header ("Cache-Control: no-cache, must-revalidate, no-store, post-check=0, pre-check=0");	// HTTP/1.1
//header ("Pragma: no-cache");	// HTTP/1.0



?>
