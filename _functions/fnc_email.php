<?php





		function email_validate($email) { // INCLUDES GMAILS FILTERING + (PLUS) ALIASING
	if ( preg_match("/^[a-zA-Z0-9][a-z0-9_.-\+]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($email)) && 
			!preg_match("/^www|\.$/i", trim($email)) ) {
		return TRUE;
	}
}
/**** END FUNCTION ****/





/*		function email_ XXX() {
	
}
/**** END FUNCTION ****/



?>
