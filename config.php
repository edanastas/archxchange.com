<?php

// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if (!defined('ACCESS')) die("access temporarily restricted");
/*
if ( !defined('CRON') && !LOCAL ) { // IF NOT RUN BY CRONTAB CONTINUE
	
	// MAKE SURE THE URL HAS THE www. IN FRONT OF IT
	//( !preg_match("/faq.php|index.php|contact.php|products.php/i",$_SERVER[PHP_SELF]) ) // DO NOT REDIRECT TO www ON THESE PAGES
	//if ( !preg_match("/www./i",$_SERVER[HTTP_HOST]) || preg_match("/\.$|\:80$/i",$_SERVER[HTTP_HOST]) ) {
	if ( !preg_match("/www./i",$_SERVER[HTTP_HOST]) || preg_match("/\.$|\:80$/i",$_SERVER[HTTP_HOST]) ) {
		header("location:http://www.". DOMAIN . $_SERVER[REQUEST_URI]);
	} elseif ( defined('SSL') ) { // IS SSL REQUIRED ON THE PAGE --> define('SSL',TRUE); // ADD TO PAGE HEADER
		if ( !$_SERVER[HTTPS] ) header("location:https://www.". DOMAIN . $_SERVER[REQUEST_URI]);
			
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

// GLOBAL //
// define LOCAL — loaded from config_global.php below
// Load secure config early so LOCAL is available
$secure_path = "secure/";
require($secure_path . "config_global.php");

////////// SET DEVELOPMENT STATE
define('DEV_TRANS', TRUE); // DEVELOPER TRANSLATION STATE
define('DEV', (LOCAL ? TRUE : FALSE)); // DEVELOPER STATE

// we may possibly change these to less security risk config variables
//$config[dev] = TRUE; // DEVELOPER STATE
//$config[dev_trans] = TRUE; // DEVELOPER STATE


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
// see config_global.php reference below


////////// FUNCTIONS
/////////////////////////////////////////////////////////////////////////////////////
//require(TEMPLATE_BASE_DIR . "_functions/fnc.php"); // QUERY
define('ROOT_DIR', (LOCAL ? '/home/archx/' : '/www/domains/archxchange.com/')); // ROOT DIRECTORY



// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// SEARCH ENGINE OPTIMIZATION 
/////////////////////////////////////////////////////////////////////////////////////

// write the HTML headers
//header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	// Date in the past
//header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	// always modified
//header ("Cache-Control: no-cache, must-revalidate, no-store, post-check=0, pre-check=0");	// HTTP/1.1
//header ("Pragma: no-cache");	// HTTP/1.0


////////// SECURITY ACCESS
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

//echo "here!<p>";
/*
$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT user_id,email,language_code,firstname,lastname,access FROM users 
		WHERE SHA1(user_id) = '" . $_SESSION[user_id] . "' AND password = '" . $_SESSION[password] . "'"));
dev_print($user);

$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT user_id,email,language_code,firstname,lastname,access,password FROM users WHERE username = 'anastas'"));
dev_print($user);

echo "sha1(\$user[user_id]) --> ". sha1($user[user_id]) ."<p>";
echo "sha1(\$user[password]) --> ". sha1($user[password]) ."<p>";
echo "\$user[password] --> ". $user[password] ."<p>";

dev_print($_SESSION);
*/

// SETUP USER ACCESS
if ( @$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT user_id,email,language_code,firstname,lastname,access FROM users 
		WHERE SHA1(user_id) = '" . db_escape($_SESSION[user_id]) . "' AND SHA1(password) = '" . db_escape($_SESSION[password]) . "'")) ) { // MEMBERS --> CHECK FOR SESSION VARIABLES
	//echo "here! 1<p>";
	define('USER_ACCESS', ( $user[access] < 3 ? 3 : $user[access] )); // STATUS
	config_user($user);
	
} elseif ( @$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT user_id,email,language_code,firstname,lastname FROM users 
		WHERE SHA1(user_id) = '" . db_escape($_COOKIE[id]) . "'")) ) { // MEMBERS --> CHECK FOR SESSION VARIABLES
	//echo "here! 2<p>";
	define('USER_ACCESS', 1); // STATUS
	config_user($user);
	
} else {
	//echo "here! 3<p>";
	define('USER_ACCESS', NULL);
	config_user($user);
	
}

// MOVED TO REGISTRATION PAGE UNTIL SETUP A SETTINGS PAGE
// LANGUAGE THAT IS USED TO REGISTER WILL BE THE DEFAULT LANGUAGE
// IF CHANGED SET THE LANGUAGE CODE
/*if ( $_POST[language_change] && USER_ID != NULL ) {
	$sql = "UPDATE users SET language_code = '". $_POST[language_change] ."' WHERE user_id = '". USER_ID ."' LIMIT 1";
	if ( !mysqli_query($db, $sql) ) {
		mail(EMAIL_ADMIN,"ERROR - LANGUAGE CODE","COULD NOT UPDATE USERS LANGUAGE CODE\n\n". $sql);
	}
}*/

if ( USER_ACCESS < ACCESS ) {
	config_redirect_set(); // SET THE REDIRECT LOCATION BEFORE LOGGING IN
	header("location:login.php");
	exit();
}


?>
