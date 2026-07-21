<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if ( !defined('ACCESS') ) die(ERROR_MESSAGE);


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
//define("TITLE","PAGE TITLE"); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0


// HTML /////////////////////////////////////////////////////////////////////////////
////////////// /////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_header_admin.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////


/*
echo "<form method=post>
	
	
	<input type=text name=command style='width:100%;' value='' onfocus=\"formAltered();\">
	<textarea name=store style='width:100%;' rows=10>". 
		stripslashes(($_POST[store] ? $_POST[store] : null)) ."</textarea>
	</form>";
*/
/*

		periodCount++;
		periodVar = null;
		for (i=0;i<=periodCount;i++) {
			//document.write(\"The number is \" + i)
			periodVar = periodVar .'.';
		}
		document.getElementById('periods').innerHTML = '.';
		
		*/



echo "


<script type=\"text/javascript\">
	<!--
	
	var p = ''
	var r
	var t
	
	function appendPeriods() {
		if ( document.getElementById('periodContainer').style.visibility == 'hidden' ) {
			document.getElementById('periodContainer').style.visibility = 'visible' }
		if ( p == '.....' ) { r = '' } else { r = p+'.' }
		p = r
		document.getElementById('periods').innerHTML = p;
		t = setTimeout(\"appendPeriods()\",500)
	}
	
	-->
</script>

<a href='#' onClick='appendPeriods();'>test</a>
<div style='opacity:.5;background-color:black;border:4px solid gray;position:absolute;left:100px;top:300px;width:430px;visibility:hidden;' id='periodContainer'>
	<h2 style='opacity:1;padding:30px 50px;font-size:16pt;color:white;font-weight:normal;letter-spacing:.1em'>UPLOADING IMAGES<span id='periods'></span></h2></div>";


$inis = ini_get_all();

dev_print($inis);

////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_footer.php");

?>
