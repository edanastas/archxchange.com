<?php





		function error($message=NULL,$sql=NULL,$level=NULL,$redirect=NULL,$action=NULL) {
	
	//dev_print(debug_backtrace());
	$debug = debug_backtrace();
	
	////////// INSERT ERROR INTO ERROR DATABASE
	/////////////////////////////////////////////////////////////////////////////////////
	${db}['insert'] = "INSERT INTO template_errors SET " .
				"error_id = NULL," .
				query_insert("user_id",USER_ID,NULL) .
				query_insert("level",$level,NULL) .
				query_insert("error",$message,NULL) .
				query_insert("error_mysql",mysqli_error($db),NULL) .
				query_insert("sql",$sql,NULL) .
				query_insert("action",$action,NULL) . // USED IN CRON FILE (BETA)
				
				query_insert("filename",basename($_SERVER['PHP_SELF']),NULL) .
				query_insert("file",basename($debug['0']['file']),NULL) .
				query_insert("line",$debug['0']['line'],NULL) .
				query_insert("function",$debug['0']['function'],NULL) .
				
				query_insert("session_id",session_id(),NULL) .
				
				query_insert("http_host",$_SERVER['HTTP_HOST'],NULL) .
				query_insert("remote_addr",$_SERVER['REMOTE_ADDR'],NULL) .
				query_insert("http_user_agent",$_SERVER['HTTP_USER_AGENT'],NULL) .
				
				query_insert("debug",print_r($debug,1),NULL) .
				query_insert("session",print_r($_SESSION,1),NULL) .
				query_insert("requested",print_r($_REQUEST,1),NULL) .
				query_insert("posted",print_r($_POST,1),NULL) .
				query_insert("server",serialize($_SERVER),NULL) .
				//query_insert("server",$server_log,NULL) .
				
				"stamp = NOW()";
			
			// check if template_errors db exists
			
			
			
			if ( !mysqli_query($db, ${db}['insert']) ) {
				echo mysqli_error($db);
			}
			
			$id = mysqli_insert_id($db);
	
	
	////////// PROCESS ERROR IMPORTANCE STEPS
	/////////////////////////////////////////////////////////////////////////////////////
	switch(TRUE) {
			
		case ($level >= 5):
			// EMAIL ADMIN NOTIFICATION
			//echo "AN ERROR HAS OCCURRED (ADMIN EMAIL)<P>";
			//mail(EMAIL_ADMIN,"DEMESSI ALERT","CHECK " . ${_SERVER}['HTTP_HOST'] . "\nERROR ID --> $id");
			
		case ($level >= 7):
			// EMAIL EMERGENCY CONTACT
			//echo "AN ERROR HAS OCCURRED (EMERGENCY EMAIL)<P>";
			//mail(EMAIL_EMERGENCY,"DEMESSI ALERT","CHECK " . ${_SERVER}['HTTP_HOST'] . "\nERROR ID --> $id");
		
		case ($level == 9):
			// STOP SCRIPT
			//echo "STOP SCRIPT (REDIRECT)<P>";
			
			header("location:http://" . ${_SERVER}['PHP_SELF'] );
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='1; URL=" . ${_SERVER}['PHP_SELF'] . "'>";
			exit();
	}
	
	
	/*$info['error'] = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM errors WHERE error_id = '" . mysqli_insert_id($db) . "' LIMIT 1"));
	
	echo "ERROR:<P>" . 
		$message . "<P>";
	dev_print($db);
	dev_print($info);
	dev_print($_REQUEST);
	dev_print($debug);*/
	
}
/**** END FUNCTION ****/







/*function test_01() {
	echo DOMAIN . " that was the domain<P>" . 
		"SCRIPT_FILENAME --> " . ${_SERVER}['SCRIPT_FILENAME'] . "<P>" .
		"PHP_SELF --> " . ${_SERVER}['PHP_SELF'] . "<P>" .
		"__LINE__ --> " . __LINE__ . "<P>" .
		"__FILE__ --> " . __FILE__ . "<P>" .
		"CURRENT FILE --> fnc.php<P>";
	
	//session_unregister("test");
	//$test = "this is a test session variable"; //session_register("test");
	//$_SESSION['test'] = $test;
	
	if ( is_array($_SERVER) ) {
		foreach ( $_SERVER AS $key => $value ) {
			$server_log .= "$key = $value\n";
		}
	}
	
	if ( is_array($_SESSION) ) {
		foreach ( $_SESSION AS $key => $value ) {
			if ( is_array($value) ) {
				foreach ( $value AS $key1 => $value1 ) {
					$session_log .= "  $key1 = $value1\n";
				}
			} else {
				$session_log .= "$key = $value\n";
			}
		}
	}
	
	if ( is_array($_POST) ) {
		foreach ( $_POST AS $key => $value ) {
			$post_log .= "$key = $value\n";
		}
	}
	
	if ( is_array($_GET) ) {
		foreach ( $_GET AS $key => $value ) {
			$get_log .= "$key = $value\n";
		}
	}
	
	
	$send_error = "SECURITY - " . ${_SERVER}['HTTP_REFERER'] . " ${_SESSION}['wc_user_id']\n\n" .
		
		"SERVER INFORMATION\n" .
		"------------------------------\n" .
		"$server_log\n\n" .
		
		"SESSION INFORMATION\n" .
		"------------------------------\n" .
		"$session_log\n\n" .
		
		"POST INFORMATION\n" .
		"------------------------------\n" .
		"$post_log\n\n" .
		
		"GET INFORMATION\n" .
		"------------------------------\n" .
		"$get_log\n\n" .
		
		"DB ACCESS ATTEMPT\n" .
		"------------------------------\n" .
		"$dbcheck3\n\n" .
		
		"------------------------------\n" .
		"file: " . __FILE__ . " (" . __LINE__ . ")\n" .
		"mysql_error: " . mysqli_error($db);
		
	
	echo nl2br($send_error) . "<P>";
	
	
}
/**** END FUNCTION ****/





/*		function error_red($error,$text)	{
// TURN TEXT RED IF ERROR
	
	/// echo "does the error exist?<BR>";
	if ( $error ) {
		/// echo " - yes<BR>";
		return "<font color=FF0000><nobr>" . $text . "</nobr></font>"; 
	} else {
		/// echo " - no<BR>";
		return $text; 
	}
	
 }
/************ END FUNCTION *************/





/*		function error_list($list) {
	if ( is_array($list) ) {
		foreach ( $list AS $value ) {
			if ( $value == "1" ) {
				// DEFAULT ERROR MESSAGE // <nobr>
				$default = return_on("<br>",$return) . "- Please correct the fields highlighted in red";
			} else {
				// SPECIFIC ERROR MESSAGE
				$return .= return_on("<br>",$return) . "- " . $value . "";
			}
		}
	} elseif ($list) {
		
		$return = $list;
		
	}
	
	return "<font color=red>" . $return . $default . "</font>";
}
/**** END FUNCTION ****/





/*		function error_ XXX() {
	
}
/**** END FUNCTION ****/



?>
