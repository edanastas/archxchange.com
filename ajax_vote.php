<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", NULL); // see config.php for settings

define("TEMPLATE_BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(TEMPLATE_BASE_DIR . "config.php"); // _functions/fnc.php


//error("the ajax_vote.php page has been loaded");

// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0
//mail("edanastas@gmail.com","this is a test","this is the message id --> ". ${_GET}['ref_id'] ." and vote --> ". ${_GET}['vote']);

// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
//{$_GET['vote']
//{$_GET['ref_id']
//{$_GET['type']
//{$_GET['user_id']
//{$_GET['project_id']

//processVote(vote,ref_id,type,user_id,project_id)

if ({$_GET['vote'] && ${_GET}['ref_id']) {
	//$dbh = mysqli_connect("localhost", "test", "test") or die ('I cannot connect to the database because: ' . mysqli_error($db));
	//mysqli_select_db($db, "archx_01", $dbh);
	
	$ref_id = ${_GET}['ref_id'];
	//$text = addslashes(strip_tags({$_GET['vote']));
	$sql = "UPDATE projects_". ${_GET}['type'] ." SET ".
		//projects_". ${_GET}['type'] ."_id = '". ${_GET}['ref_id'] ."', 
		//project_id = '". ${_GET}['project_id'] ."',
		"vote_". ${_GET}['vote'] ." = vote_". ${_GET}['vote'] ." + ". ({$_GET['direction'] > 5 ? "2" : "1") .", 
		vote_direction = vote_direction ". ({$_GET['vote'] == "yes" ? " + 1" : " - 1 ") .", 
		vote_ip = '". ${_SERVER}['REMOTE_ADDR'] ."', 
		stamp = stamp 
		WHERE project_id = '". ${_GET}['project_id'] ."' 
			AND projects_". ${_GET}['type'] ."_id = ". ${_GET}['ref_id'] ."";
	
	//echo $update ."<p>";
	
	if ( !mysqli_query($db, $sql) ) {
		error("there was an error recording the vote",$sql);
		$status = "there was an error recording the vote in the data type\n". mysqli_error($db);
	} else {
		$result = 1;
		$status = "the vote was recorder successfully";
	}
	
	
	/*
	////////// RECORD VOTE RECORD IN CASE WE WANT TO USE IT FOR TRACKING CUSTOMER PREFERENCES?
	$sql = "INSERT INTO projects_votes (`project_id`, `type`, `user_id`, `vote_". ${_GET}['vote'] ."`, `vote_direction`, `vote_ip`) 
		values (
			'". ${_GET}['project_id'] ."', 
			'". ${_GET}['type'] ."', 
			'". ${_GET}['user_id'] ."', 
			vote_". ${_GET}['vote'] ." + ". ({$_GET['direction'] > 5 ? "2" : "1") .", 
			vote_direction ". ({$_GET['vote'] == "yes" ? " + 1" : " - 1") .", 
			'". ${_SERVER}['REMOTE_ADDR'] ."')";
	//". ({$_GET['user_id'] ? "'". ${_GET}['user_id'] ."'" : "NULL") .", 
	
	if ( !mysqli_query($db, $sql) ) {
		error("there was an error recording the alternative vote count",$sql,2);
		$status .= "\nthere was an error recording the alternative vote in projects_votes\n". mysqli_error($db);
	}
	//echo mysqli_error($db) ."<p>";
	*/
}


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
/*
status		points		votes		comments	blog entry	first entry	images		projects
guest		0			n/a			n/a			n/a			n/a			n/a			n/a
novice		1000		1			2			5			7			10			12
veteran		10000		2			5			10			12			15			20
expert		100000		5			7			12			15			20			30
*/


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
