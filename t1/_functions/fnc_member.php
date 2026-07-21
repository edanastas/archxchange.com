<?php




		function member_access($access=ACCESS) { // CHECK IF MEMBER ACCESS IS >= THE USERS ACCESS LEVEL
	
	//if ( !defined('ACCESS') ) define('ACCESS',NULL); // SHOULDN'T NEED THIS BUT JUST IN CASE
	
	//if ( ACCESS > $access ) {
		//$access = ACCESS;
	//}
	
	//echo "\$access requirement --> ". (int) USER_ACCESS ." >= ". (int) $access ."<BR>";
	//echo "ACCESS --> ". ACCESS ."<BR>";
	//echo "USER_ACCESS --> ". USER_ACCESS ."<BR>";
	
	//if ( USER_ACCESS >= ACCESS ) {
	//if ( USER_ACCESS != NULL && USER_ACCESS >= $access ) {
	//if ( defined('USER_ACCESS') && USER_ACCESS >= ( is_numeric($access) ? $access : ACCESS ) ) {
	if ( defined('USER_ACCESS') && USER_ACCESS != NULL && (int) USER_ACCESS >= (int) $access ) {
	//if ( defined('USER_ACCESS') && USER_ACCESS >= ( $access ? $access : ACCESS ) || preg_match("/concord.local|demessi.com/i", ${_SERVER}['HTTP_HOST']) ) {
		return TRUE;
	} else {
		//header("location:login.php" . return_value("?" . ${_SERVER}['PHP_SELF'] . "?" . ${_SERVER}['QUERY_STRING'],NULL) );
		//exit();
		return FALSE;
	}
	
}
/**** END FUNCTION ****/





		function member_login($info) { // LOGIN
	
	// PREVENT SESSION FIXATION (FORCING USER TO USE HACKERS SESSION ID) 
	session_regenerate_id();
	
	// CHECK IF MEMBER IS LOGGED IN
	${_SESSION}['user_id'] = sha1($info['user_id']);
	${_SESSION}['password'] = ${info}['password'];
	
	setcookie("id", sha1({$info['user_id']}), time() + 31536000, "", ".".DOMAIN);
	setcookie("lang", ${info}['language_code'], time() + 31536000, "", ".".DOMAIN);
	
	//echo "before --> the user_id is --> [" . USER_ID . "]";
	//dev_print(cart_qty()); echo "<P>";
	
	///cart_login($info['user_id']); // COPY SESSION CART ITEMS TO DATABASE CART
	
	//echo "after --> ";
	//dev_print(cart_qty()); echo "<P>";
	//exit();
	
	
	//if ( preg_match("/checkout.php/i",$_SERVER['PHP_SELF']) ) {
	//	header("location:" . ${_SERVER}['PHP_SELF'] . "");
	//} else
	
	//dev_print($_SESSION);
	//exit;
	
	/*if ( ${_SESSION}['redirect'] ) { // IF QUERY_STRING RETURN TO QUERY_STRING
		//$_SESSION['redirect'] = ${_SERVER}['QUERY_STRING'];
		header("Location:" . ${_SESSION}['redirect'] );
	} elseif ( preg_match("/checkout.php/i", ${_SERVER}['PHP_SELF']) ) { // IF CHECKOUT LOGIN RETURN TO CHECKOUT
		header("Location:./checkout.php");
	} else*/
	
	//echo "what is going on here!<P>";
	//echo "what is the redirect ? \${_SESSION}['redirect'] --> " . ${_SESSION}['redirect'] . "<P>";
//	config_redirect();
//ANASTAS:changed
	
	
	
	config_redirect();
	
	/*if (cart_qty() > 0) { // IF CART QUANTITY > 0 RETURN TO CART
		header("Location:./cart.php");
	} else { // RETURN TO HOMEPAGE
		header("Location:./");
	}
	*/
	//echo "redirect cancelled<P>";
	//fnc_redirect("");
	
	
}
/**** END FUNCTION ****/





		function member_logout() { // LOGOUT
	
	/*
	*/
	// DELETE SESSION INFORMATION
	//$_SESSION['user_id'] = NULL;
	unset($_SESSION['user_id']);
	//$_SESSION['password'] = NULL;
	unset($_SESSION['password']);
	
	//$_SESSION['checkout'] = NULL;
	unset($_SESSION['checkout']);
	//$_SESSION['selection'] = NULL;
	unset($_SESSION['selection']);
	
	
	//dev_print($_SESSION);
	//dev_print($_REQUEST);
	$_SESSION = array();
	session_unset();
	session_destroy();
	
	unset($_COOKIE[session_name()]);
	//dev_print($_SESSION);
	//exit;
	
	// UNSET COOKIE INFORMATION
	//setcookie("id", NULL, time() + 31536000);
	//setcookie("id", sha1($info['user_id']), time() + 31536000);
	setcookie("id", ${_COOKIE}['id'], time() - 3600, "", ".". DOMAIN);
	setcookie("id", ${_COOKIE}['id'], time() - 3600);
	setcookie(session_name(), $_COOKIE[session_name()], time() - 3600, "", ".". DOMAIN);
	setcookie(session_name(), $_COOKIE[session_name()], time() - 3600);
	
	// NO NEED TO UNSET LANGUAGE PREFERENCE
	//setcookie("lang", NULL, time() + 31536000);
	//setcookie("lang", ${info}['language_code'], time() + 31536000);
	//setcookie("lang", NULL, time() + 31536000);
	
	if ( ${_SERVER}['QUERY_STRING'] ) { // IF QUERY_STRING RETURN TO QUERY_STRING
		header("Location:./" . return_on($_SERVER['QUERY_STRING'], ${_SERVER}['QUERY_STRING']) );
	} else { // RETURN TO HOMEPAGE
		header("Location:./");
	}
	
}
/**** END FUNCTION ****/





		function member_query($fields=NULL,$user_id=USER_ID) {
	
	if ( is_array($fields) ) {
		${sql}['fields'] = implode(", ", $fields);
	} elseif ( $fields ) {
		${sql}['fields'] = $fields;
	} else { // DEFAULT QUERY
		${sql}['fields'] = "u.user_id, u.domain_id, u.address_id, u.email, u.firstname, u.lastname, u.dob, u.gender, 
			u.phone, u.fax, u.timezone_id, u.language_code, u.source, u.source_other";//, d.domain, d.shipping ";
	}
	
	//LEFT JOIN domains d ON d.domain_id = u.domain_id 
	$query = "SELECT ". ${sql}['fields'] ." 
		FROM users u 
		WHERE u.user_id = '" . $user_id . "' "; // , promotion_types // AND promotion_code = source
	/*
	, 
			addresses.zone_id, addresses.country_id 
	
		LEFT JOIN promotion_types pt ON pt.promotion_code = users.source
		LEFT JOIN addresses ON (addresses.user_id=users.user_id), 
		LEFT JOIN countries_zones ON (countries_zones.zone_id=addresses.zone_id) 
	
	*/
	
	return mysqli_query($db, $query);
	
	
	
}
/**** END FUNCTION ****/





		function member_info($fields=NULL,$user_id=USER_ID) {
	$query = member_query($fields,$user_id);
	return mysqli_fetch_assoc($query);
}
/**** END FUNCTION ****/





		function member_check_password($password,$user_id=USER_ID) {
	
	//echo "the password is --> ". $password . "<P>";
	//echo "the user_id is --> ". $user_id . "<P>";
	
	if ( $user = mysqli_fetch_assoc(mysqli_query($db, "SELECT email FROM users 
		WHERE password = sha1('". $password ."') AND user_id = '". $user_id ."' LIMIT 1")) ) {
		
		//echo "the password does match<P>";
		return $user;
	}
	// else {
		
		//echo "the password does NOT match<P>";
	//	return FALSE;
	//}
	
}
/**** END FUNCTION ****/






/*		function member_ XXX() {
	
}
/**** END FUNCTION ****/



?>
