<?php

if ( !defined('BASE_DIR') ) die("YOU DO NOT HAVE ACCESS TO VIEW THIS PAGE");


// SESSION //////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0

// write the HTML headers
/*header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	// Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	// always modified
header ("Cache-Control: no-cache, must-revalidate, no-store, post-check=0, pre-check=0");	// HTTP/1.1
header ("Pragma: no-cache");	// HTTP/1.0*/ // moved to config.php


// VARIABLES ////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0
$keyword = "keywords go here";
$description = "description goes here.";

//$sql = "select * from template_css where domain_id = '1' limit 1";
//$style = mysqli_fetch_assoc(mysqli_query($db, $sql));



// HTML /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

/*
	<!--<META HTTP-EQUIV='Content-Type' CONTENT='text/html; CHARSET=iso-8859-1'>
		<BASE HREF='http://" . $_SERVER[HTTP_HOST] . dirname($_SERVER[PHP_SELF]) . "'>
		<BASE HREF='http://" . TEMPLATE_DOMAIN . "'>
		http://www.htmlhelp.com/reference/wilbur/head/base.html
	
	<META NAME=\"KEYWORDS\" CONTENT=\"$keyword\">
	<META NAME=\"DESCRIPTION\" CONTENT=\"$description\">-->
*/


//	<SCRIPT SRC='" . TEMPLATE_DOMAIN . "javascript.js' TYPE='text/javascript' LANGUAGE='javascript'></SCRIPT>



// <SCRIPT SRC=\"" . TEMPLATE_DOMAIN . "javascript.js\" TYPE=\"text/javascript\" LANGUAGE=\"javascript\"></SCRIPT>
//	<LINK REL=stylesheet HREF='" . TEMPLATE_DOMAIN . "styles.css' TYPE='text/css'>
//	<LINK REL=stylesheet HREF='" . BASE_DIR . "_styles/forms.css' TYPE='text/css'>

// media='screen'

//	<link rel=stylesheet href='http://www.archxchange.com/_styles/styles.css' type='text/css'>
//	<link rel=stylesheet href='http://www.archxchange.com/_styles/forms.css' type='text/css'>
	
//<base href='http://www.archxchange.com/'>
/*
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/test.js\" type=\"text/javascript\"></script>

	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/default.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/prototype.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/scriptaculous.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/nifty.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/calendarDateInput.js\" type=\"text/javascript\"></script>
	
	
	<!--<<script src=\"". TEMPLATE_DOMAIN ."_javascripts/calendar/normal.js\" type=\"text/javascript\"></script>-->
	<!--<script src=\"". TEMPLATE_DOMAIN ."_javascripts/overlib.js\" type=\"text/javascript\"></script> overLIB (c) Erik Bosrup -->
	<!--<script src=\"". TEMPLATE_DOMAIN ."_javascripts/tooltips.js\" type=\"text/javascript\"></script>-->
	<!--<script src=\"". TEMPLATE_DOMAIN ."_javascripts/moo.fx.js\" type=\"text/javascript\"></script>-->
*/

////////// HTML HEADER
/////////////////////////////////////////////////////////////////////////////////////
echo "<html>

<head>
	
	<title>" . (defined('TITLE') ? TITLE : DEFAULT_TITLE) . "</title>
	
	". (eregi("/admin/",$_SERVER[PHP_SELF]) 
		? "<link rel=stylesheet href='". TEMPLATE_DOMAIN ."_styles/styles.css' type='text/css'>"
		: "<link rel=stylesheet href='". BASE_DIR ."_styles/styles.css' type='text/css'>" ) ."
	<!--<link rel=stylesheet href='". TEMPLATE_DOMAIN ."_styles/styles.css' type='text/css'>-->
	<link rel=stylesheet href='". TEMPLATE_DOMAIN ."_styles/forms.css' type='text/css'>
	<link rel=stylesheet href='". TEMPLATE_DOMAIN ."_styles/niftyCorners.css' type='text/css'>
	
	
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/default.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/prototype.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/scriptaculous.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/nifty.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_DOMAIN ."_javascripts/calendarDateInput.js\" type=\"text/javascript\"></script>
	
	<style type=\"text/css\">
	<!--
		
		div#nifty {
			/*
			background:#DDB600; // too goldish yellow
			margin: 0 30%;
			font-weight:bold;
			*/
			text-align:center;
			margin: 6 10%;
			color:#000;
			background:#FAD734;
		}
		". $style[css] ."
	-->
	</style>
	
	
	<script language='javascript' type='text/javascript'>
	<!--
		
		//window.onload=function() {
		function loadNifty() {
			if(!NiftyCheck())
				return;
			Rounded(\"div#nifty\",\"all\",\"#FFF\",\"#FAD734\",\"smooth\");
		}
		
	// -->
	</script>
</head>

<body onload=\"window.defaultStatus='This is the window.defaultStatus';loadNifty();\">
<div id='container'>";




////////// CONTINUE TO HEADER -->

?>
