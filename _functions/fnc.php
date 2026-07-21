<?php 

/*
if ( preg_match("//home/havecigs/public_html/i", ${_SERVER}['SCRIPT_FILENAME']) ) { ////////// DEVELOPMENT COMPUTER
	include(TEMPLATE_BASE_DIR . "../secure/config_smokes.php");
} elseif ( preg_match("//Library/WebServer/Documents/i", ${_SERVER}['DOCUMENT_ROOT']) ) { ////////// DEVELOPMENT COMPUTER
	include(TEMPLATE_BASE_DIR . "root/config_smokes.php");
} else {
	include(TEMPLATE_BASE_DIR . "../../secure/config_smokes.php");
}*/


////////// FUNCTIONS
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_functions/fnc_config.php"); // CONFIG /home/archx/public_html/t1/_functions/fnc_config.php

include(TEMPLATE_BASE_DIR . "_functions/fnc_query.php"); // QUERY
include(TEMPLATE_BASE_DIR . "_functions/fnc_return.php"); // VARIABLE CHECKER
include(TEMPLATE_BASE_DIR . "_functions/fnc_form.php"); // FORM - DATABASES --> countries, zones
include(TEMPLATE_BASE_DIR . "_functions/fnc_date.php"); //  DATE
include(TEMPLATE_BASE_DIR . "_functions/fnc_error.php"); // ERRORS
include(TEMPLATE_BASE_DIR . "_functions/fnc_user.php"); // MEMBERS
include(TEMPLATE_BASE_DIR . "_functions/fnc_email.php");
include(TEMPLATE_BASE_DIR . "_functions/fnc_image.php");
include(TEMPLATE_BASE_DIR . "_functions/fnc_calcs.php");

include(TEMPLATE_BASE_DIR . "_functions/fnc_trans.php"); // TRANSLATION - DATABASES --> translations

include(TEMPLATE_BASE_DIR . "_functions/fnc_html.php"); // HTML
include(TEMPLATE_BASE_DIR . "_functions/fnc_pop.php"); // POP-UPS

include(TEMPLATE_BASE_DIR . "_functions/fnc_dev.php"); // DEVELOPMENT FUNCTIONS









/*		function fnc_ XXX() {
	
}
/**** END FUNCTION ****/





?>
