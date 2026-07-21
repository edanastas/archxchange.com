<?php






		
		function query_insert($field,$value,$options) { // CHECK IF FIELD VALUE EXISTS
/*
INPUT --> 		${var}['key1'] = "value1" / ${var}['key1'] = NULL;
RETURNS --> 	`key1` = 'value1' / `key1` = NULL
*/
	
	if ( $options == 2 ) { // IF 2 THEN LAST FIELD (NO COMMA)
		$pre_comma = ", ";
	} elseif ( $options != 1 ) { // LAST FIELD NO COMMA 
		$post_comma = ", "; // DEFAULT --> SET COMMA
	} // IF 1 THEN LAST FIELD (NO COMMA)
	
	//echo "\$field --> $field<BR>";
	
	if ( $field || $field == "0" ) {
		//echo "INSIDE! ($field)<BR>";
		return "" . $pre_comma . " `$field` = " . 
			return_priority( array( array($value,"'" . addslashes($value) . "'"), "NULL" ) ) . "" . $post_comma . "  "; // INSERT DB FIELD AND VALUE
	}
	
	//if ( ${options}['on'] ) {
		//if ( $field && $value ) {
			//return $pre_comma . "`$field` = '" . addslashes($value) . "'" . $post_comma . " "; // INSERT DB FIELD AND VALUE
		//} elseif ( !$options['not_null'] ) {
		//} else {
			//return $pre_comma . "`$field` = NULL" . $post_comma . " "; // INSERT DB FIELD AND VALUE
		//}
	//}
}
/**** END FUNCTION ****/






		function query_prep($value,$reverse=NULL) { // TRIM AND ADD SLASHES
	
	return ( $reverse 
		? html_entity_decode($info['name']) 
		//? html_entity_decode(stripslashes($info['name']),ENT_QUOTES) 
		: htmlentities(trim(eregi_replace("<(.*)>?","",$value)),ENT_QUOTES) ); // this will strip all html code tags
		//: addslashes(trim($value)) );
}
/**** END FUNCTION ****/






/*		function query_ XXX() { // XXX
	
}
/**** END FUNCTION ****/






?>
