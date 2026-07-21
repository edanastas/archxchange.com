<?php

if ( !defined('ACCESS') ) die("YOU DO NOT HAVE ACCESS TO VIEW THIS PAGE");


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



// HTML /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

/*
	<!--<META HTTP-EQUIV='Content-Type' CONTENT='text/html; CHARSET=iso-8859-1'>
		<BASE HREF='http://" . ${_SERVER}['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "'>
		<BASE HREF='http://" . TEMPLATE_DOMAIN . "'>
		http://www.htmlhelp.com/reference/wilbur/head/base.html
	
	<META NAME=\"KEYWORDS\" CONTENT=\"$keyword\">
	<META NAME=\"DESCRIPTION\" CONTENT=\"$description\">-->
*/


//	<SCRIPT SRC='" . TEMPLATE_DOMAIN . "javascript.js' TYPE='text/javascript' LANGUAGE='javascript'></SCRIPT>



// <SCRIPT SRC=\"" . TEMPLATE_DOMAIN . "javascript.js\" TYPE=\"text/javascript\" LANGUAGE=\"javascript\"></SCRIPT>
//	<LINK REL=stylesheet HREF='" . TEMPLATE_DOMAIN . "styles.css' TYPE='text/css'>
//	<LINK REL=stylesheet HREF='" . TEMPLATE_BASE_DIR . "_styles/forms.css' TYPE='text/css'>

//<!-- <base href='http://www.vmrex.com/'> 
	//<link rel=stylesheet href='". TEMPLATE_BASE_DIR ."_styles/styles.css' type='text/css' media='screen'> -->
	
////////// HTML HEADER
/////////////////////////////////////////////////////////////////////////////////////
echo "<html>


<head>
	
	
	<title>" . (defined('TITLE') ? TITLE : DEFAULT_TITLE) . "</title>
	
	<link rel=stylesheet href='". TEMPLATE_BASE_DIR ."_styles/styles.css' type='text/css'>
	<link rel=stylesheet href='". TEMPLATE_BASE_DIR ."_styles/forms.css' type='text/css'>
	<link rel=stylesheet href='". TEMPLATE_BASE_DIR ."_styles/niftyCorners.css' type='text/css'>
	<link rel=stylesheet href='". TEMPLATE_BASE_DIR ."_styles/lightbox.css' type='text/css'>
	<link rel=stylesheet href='". TEMPLATE_BASE_DIR ."_styles/rating.css' type='text/css'>
	
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/default.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/prototype.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/scriptaculous.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/custom.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/lightbox.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/vote.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/nifty.js\" type=\"text/javascript\"></script>
	<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/calendarDateInput.js\" type=\"text/javascript\"></script>
	<!--<script src=\"". TEMPLATE_BASE_DIR ."_javascripts/moo.fx.js\" type=\"text/javascript\"></script>-->
	
	<style type=\"text/css\">
	<!--
	
		div#nifty {
			/*
			margin: 0 30%;
			*/
			margin: 0 20%;
			color:#fff;
			background-color:#DD7F00;
		}
	-->
	</style>
	
	
	<script language='javascript' type='text/javascript'>
	<!--
	" .
		//var radioCheck = new radioButton('cart_test');
		"
		
		function SetCheckbox(ThisCheckBox,ThisValue) {
			for (var i=0;i<ThisCheckBox.length;i++)
				if (ThisCheckBox[i].value!=ThisValue)
					ThisCheckBox[i].checked=false;
		}
	   
		function OpenWin(Loc,WinName,Width,Height) {
			var WinName = WinName 
			var WinInfo = \"toolbar=no,scrollbars=yes,directories=no,resizable=yes,menubar=no,width=\" + Width + \",height=\" + Height + \",screenX=100,screenY=100,top=100,left=100 \"
			window.open(Loc,WinName,WinInfo);
		}
		
		
	// -->
	</script>
	
</head>

<body>
<div id='container'>";



////////// CONTINUE TO HEADER -->

?>
