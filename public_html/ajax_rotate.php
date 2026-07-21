<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", NULL); // see config.php for settings

define("TEMPLATE_BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(TEMPLATE_BASE_DIR . "config.php"); // _functions/fnc.php


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0

// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0

if (isset($_GET['direction']) && $_GET['ref_id']) {
	//$dbh = mysqli_connect("localhost", "test", "test") or die ('I cannot connect to the database because: ' . mysqli_error($db));
	//mysqli_select_db($db, "archx_01", $dbh);
	
	$ref_id = $_GET['ref_id'];
	//$text = addslashes(strip_tags($_GET['vote']));
	
	
	$file_path = (LOCAL ? TEMPLATE_BASE_DIR ."_uploads/" : "./_uploads/");
	$file_name = $_GET['ref_id'] .".png";
	$file = $file_path . $file_name;
	
	
	$command = (LOCAL ? "/usr/local/bin/convert" : "convert") ." -rotate ". ($_GET['direction'] ? "90" : "-90" ) ." ". $file ." ". $file;
	
	exec($command);
	
	
	$result = 1;
	$status = "the image was rotated successfully";
	
	//error("check if the image has been rotated",$command);
	$status = "executed successfully --> ". $command;
}

//$status .= "direction - ". $_GET['direction'] ." and ref_id - ". $_GET['ref_id'];


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0


header('Content-Type: text/xml');

echo "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
<response>
  <method>checkResults</method>
  <result>". (int) $result ."</result>
  <status>". $status ."</status>
</response>";


?>
