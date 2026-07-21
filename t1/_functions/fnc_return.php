<?php





		function return_domain($url) {
// THIS FUNCTION REDUCES URL LINK TO BASE DOMAIN
// EXAMPLE BELOW
// www.amazon.com/gp/registry/registry.html/ref=wlem-si-html_viewall/104-5286992-6636711?id=2KGT0YDSKQ1NS
// www.amazon.com
$return = parse_url($url);
return ${return}['host'];

/*return preg_replace(
	array("/(http)?(s)?(:\/\/)?([\.\-\_\w]+)(.*)/i"), // [\.\-\_\w] // ([\w\.\/\=\?\,\;\-\_\~\!\@\#\$\%\+\&]*)([\.\-\_\w]+)
	array("$4"), 
	$url);*/
}
/**** END FUNCTION ****/





		function return_value($var,$value=NULL) { // RETURN $value IF $var EXISTS
	
	if ( $var ) { // IF $var EXISTS 
		if ( !$value ) { // IF NO VALUE -->
			return $var; // RETURN $var AS $value
		} else {
			return $value;
		}
	} else {
		return FALSE;
	}

}
/**** END FUNCTION ****/





		function return_match($pattern,$match,$value) { // RETURN SELECTED TEXT IF VALUES MATCH
	
	if ( $pattern && $pattern == $match ) { // IF A MATCHES B (A = B) AND A EXIST -->
		return $value; // RETURN $return (CHECKED/SELECTED/ETC.)
	}
	
}
/**** END FUNCTION ****/





		function return_priority($vars) { // RETURN FIRST ARRAY VALUE
	if ( is_array($vars) ) { // IF ARRAY
		foreach ($vars AS $value) { // LOOP THROUGH ARRAY
			if ( is_array($value) ) {
				if ( ${value}['0'] ) { // IF ARRAY VALUE EXISTS
					return ${value}['1']; // RETURN
					break;
				}
			} else {
				if ( $value ) {
					return $value; // RETURN
					break;
				}
			}
		}
	}
	
}
/**** END FUNCTION ****/





/*		function return_first($var_1,$var_2,$var_3=NULL) { // RETURN FIRST VALUE
	for ($v=0;$v<=3;$v++) {
		if ( $var_$v ) {
			return $var_$v;
		}
	}
	
}
/**** END FUNCTION ****/





//		//function return_first({$var['1'],{$var['2'],{$var['3']=NULL) { // RETURN FIRST VALUE
		function return_first($var_1,$var_2,$var_3=NULL) { // RETURN FIRST VALUE
	$var = array($var_1,$var_2,$var_3);
	foreach ($var AS $value) {
		if ( $value ) {
			return $value;
		}
	}
}
/**** END FUNCTION ****/





		function return_else($var,$init,$alt) { // IF $var EXISTS RETURN INITIAL VALUE ($init / $var) ELSE RETURN ALT VALUE ($alt)
	
	if ( $var ) { // IF $var EXISTS -->
		if ( !$init ) { // RETURN $var VALUE IF $init IS NULL
			return $var;
		} else { // RETURN INITIAL VALUE ($init)
			return $init;
		}
	} else { //  RETURN ALTERNATE VALUE ($alt) -->
		return $alt;
	}
	
}
/**** END FUNCTION ****/





		function return_on($return,$on) { // RETURN VALUE ONLY IF $on EXISTS
	// USE WITH return_priority($vars)
	if ( $on ) {
		return $return;
	}
}
/**** END FUNCTION ****/





		function return_off($return,$off) { // RETURN VALUE ONLY IF $off DOES NOT EXISTS
	if ( !$off ) {
		return $return;
	}
}
/**** END FUNCTION ****/





		function return_alternate($initial,$alternate) { // ALTERNATE BETWEEN $initial / $alternate
	global $current;
	if ( $current != $initial ) { // IF THE $current VALUE IS EQUAL TO THE $initial VALUE -->
		
		$current = $initial;
		return $initial; // RETURN THE $alternate VALUE
	} else {
		
		$current = $alternate;
		return $alternate; // RETURN THE $initial VALUE
	}
	
}
/**** END FUNCTION ****/
/*		function return_alternate($current,$initial,$alternate) { // ALTERNATE BETWEEN $initial / $alternate
	if ( $current != $initial ) { // IF THE $current VALUE IS EQUAL TO THE $initial VALUE -->
		return $initial; // RETURN THE $alternate VALUE
	} else {
		return $alternate; // RETURN THE $initial VALUE
	}
	
}
/**** END FUNCTION ****/






		function return_array($index,$list,$separator) {
	if ( is_array($list) ) {
		foreach ( $list AS $key => $value ) {
			$return .= ( $return ? $separator : NULL ) . $index . " " . $value;
		}
	} elseif ($list) {
		$return = $index . $list . $separator;
	}
	return $return;
}
/**** END FUNCTION ****/





		function return_random($length,$string="123456789123456789ABCDEFGHJKLMNPQRSTUVWXYZ") { // GENERATE RANDOM CODE
	list($usec, $sec) = explode(' ', microtime());
	$make_seed = (float) $sec + ((float) $usec * 100000);
	mt_srand($make_seed);
	
	//$string = "123456789123456789ABCDEFGHJKLMNPQRSTUVWXYZ";
	
	$code = NULL;
	
	for($i=0; $i < $length; $i++) {
		$code .= $string[mt_rand(0,strlen($string)-1)];
	}
	
	return $code;
}
/**** END FUNCTION ****/





/*		function return_random($length) { // GENERATE RANDOM CODE
	$salt = "ABCDEFGHIJKLMNPQRSTUVWXYZ0123456789";
	srand((double)microtime() * 1000000);
	for ($i = 1; $i <= 6; $i++) {
		$return .=  substr($salt, rand() % 33, 1);
	}
	return $return;
}
/**** END FUNCTION ****/





		function return_array_item($array,$field) {
	if ( is_array($array) ) {
		return $array[$field];
	}
}
/**** END FUNCTION ****/





/*		function return_email($email) { // CHECK IF AN EMAIL ADDRESS IS OF VALID FORM
	if ( preg_match("/^[a-zA-Z0-9][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($email)) ) {
		return $email; // RETURN THE EMAIL ADDRESS
	} else {
		return FALSE;
	}
}
/**** END FUNCTION ****/





		function return_similarity($string1, $string2) { // CHECK SIMILAR OF TWO STRINGS 
		//function return_similarity($string1, $string2, $allowed=70) { // CHECK IF TWO STRINGS ARE SIMILAR BASED ON $allowed PERCENTAGE
	// $allowed = THE PERCENTAGE OF SIMILARITY ALLOWED, DEFAULT 70% SIMILARITY RETURNS TRUE
	similar_text($string1, $string2, $p);
	
	//echo "the strings are $p% similar<P>";
	
	return $p;
	//if ($p > $allowed) {
	//	return TRUE;
	//}
}
/**** END FUNCTION ****/





/*		function return_eval($string) {
// could not get this function to work, not important to figure out right now (ref checkout.php "trans(116,1)") - edward
// example code that did not work: $insert_form[] = array("?",NULL,return_eval(trans(116,1))); // SUBTITLE
	return eval("return \"" . $string . "\";");
}
/**** END FUNCTION ****/






        function return_array_implode($loop,$implode) { // RETURN EACH $loop ARRAY VALUE AS GLUE OF $implode
    if ( is_array($loop) ) {
        foreach ( $loop AS $value ) {
            $return .= implode($value, $implode);
        }
        return $return;
    }
}
/**** END FUNCTION ****/





		function return_implode_assoc($inner_glue, $outer_glue, $array) {
/* This isn't really DB function, but it's general... This will */
/* act like the PHP implode() function, but for assoc. arrays... */
	$output = array();
	foreach ( $array as $key => $item )
		$output[] = $key . $inner_glue . $item;
	
	return implode($outer_glue, $output);
 }
/**** END FUNCTION ****/





		function return_log($log) {
	
	if ( is_array($log) ) {
		foreach( $log AS $value ) {
			$return .= return_log($value);
		}
	} elseif ( $log ) {
		$return .= $log ." [". date('M d, Y g:iA T') ."]\n";
	}
	
	return $return;
	
}
/**** END FUNCTION ****/





/*		function return_ XXX() {
	
}
/**** END FUNCTION ****/



?>
