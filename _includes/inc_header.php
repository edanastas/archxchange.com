<?php


// SECURITY ACCESS //////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if (!defined('ACCESS')) die(ERROR_MESSAGE);
/*if ( !defined('ACCESS') ) {
	
	$redirect_message = "There was an error accessing the page (" . __FILE__ . ").";
	$redirect_url = "http://" . DOMAIN . "";
	
	$error = array("error" => $redirect_message, // ERROR MESSAGE
		"timer" => "2", // TIMER BEFORE REDIRECTING
		"url" => $redirect_url); // IF NO LOCATION SPECIFIED THEN GOES BACK ONE
	html_error($error);

}*/


// VARIABLES ////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0

// START LOAD TIME VARIABLES
/*function getMicrotime() {
	list($usec, $sec) = explode(" ",microtime());
	return ((float) $sec + (float)$usec);
}

$load_time['start'] = getMicrotime();   //include ("XPath.class.php");
*/

// HTML /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0


////////// HTML HEAD
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_head.php");

	//( defined('USER_ID') && USER_ID != NULL ? "login"=>"login.php" : "logout"=>"logout.php" ),
	
	$login = ( defined('USER_ID') && USER_ID != NULL ? "logout" : "login" );
	
foreach ( array("home"=>"./",
	$login => $login .".php",
	//"packages"=>"packages.php",
	//"test"=>"test.php",
	//"sample"=>"sample.php",
	//"login"=>"login.php",
	//"phpinfo"=>"phpinfo.php",
	//"register hosting"=>"register.php",
	"register"=>"register_user.php") AS $key => $value ) {
	
	$links[] = "<a href='". $value ."'>". $key ."</a>";
}

foreach ( array("admin"=>"./",
	"errors"=>"errors.php",
	"phpinfo"=>"phpinfo.php") AS $key => $value ) {
	
	$admin_links[] = "<a href='". $value ."'>". $key ."</a>";
}

foreach ( array("Add Project"=>"add_project.php?start",
	"Find Project"=>"find.php") AS $key => $value ) {
	//,"Add Office"=>"add_office.php"
	
	$primary_links[] = "<a href='". $value ."'>". $key ."</a>";
}

////////// BODY
/////////////////////////////////////////////////////////////////////////////////////
//echo "<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>\n\n";
echo "<div id='header'>
	
	<div id='imageLogoBox'>
	<img src='_images/axc_logo_0". ($_GET['css'] ? $_GET['css'] : "2") .".gif' id='imageLogo'>
	</div>
	
	<span style='padding:2px;color:#ccc;'>". implode("|",$links) ."</span>
	
	". ( user_access(7) ? "<span style='margin:2px;padding:2px;color:#ccc;background-color:#FFDED8;border:solid 1px #BEBFBF;border-bottom:solid 1px #8B8C8C;border-right:solid 1px #8B8C8C;'>". implode("|",$admin_links) ."</span>" : null)."
	<p>
	
	<h2 style='padding:2px;color:#ccc;margin:2px;padding:12px;'>". implode(" ",$primary_links) ."</h2>
	
</div>

<div id='content'>";


////////// CONTINUE TO BODY -->

?>
