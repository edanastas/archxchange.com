<?php

define('TRANS_LANG','en');



function trans($value,$flag = 1)  {
	return $value;
	/*if(is_numeric($value)) {
		return trans_id($value,$flag);
	} else {
		return trans_en($value,$flag);
	}*/
}
/**** END FUNCTION ****/





/*
function trans_id($value,$link = 1) { // TRANSLATE FROM ID (trans_id)
	if($GLOBALS['trans'][$value] != "") return ${GLOBALS}['trans'][$value];
	else { // NOT IN ARRAY, CHECK DATABASE
		$trans_id_sql  = "SELECT trans_id, en, " . TRANS_LANG . " FROM translations WHERE trans_id = '" . $value . "' LIMIT 1";
		$trans_id_res = mysqli_query($db, $trans_id_sql);
		
		if ( !$trans = mysqli_fetch_array($trans_id_res) ) {
			return "<FONT COLOR=RED> no record in table (id: $value)</FONT>";
		} else {
			if ($trans['TRANS_LANG'] != "") { // TRANSLATION EXISTS IN DATABASE
				if(defined('DEV_TRANS')){ // IN DEV MODE
					if ( $link  ) { // LINK IT
						if (strlen($trans['TRANS_LANG']) > 50) ${window}['height'] = ceil(((strlen($trans['TRANS_LANG'])/50)+1)*50)+300;//500;
						${window}['css_class'] = "CLASS='clean'";
						//$window['css_style'] = "STYLE='color: " . COLOR_HIGHLIGHT_DARK . ";text-decoration: none;'";
						${window}['anchor'] = ${trans}['TRANS_LANG'];
						${window}['href'] = TEMPLATE_DOMAIN . "admin/admin_translate.php?id=" . $value;
						
						return pop_window($window);
					} else { // DONT LINK IT, JUST TAG IT
						return ${trans}['TRANS_LANG'] . " [" . ${trans}['trans_id'] . "]";
					}
				} else return ${trans}['TRANS_LANG'];
				
			} else { // NO TRANSLATION EXISTS IN DATABASE
				if(defined('DEV_TRANS')){
					if($link){
						if (strlen($trans['en']) > 50) ${window}['height'] = ceil(((strlen($trans['TRANS_LANG'])/50)+1)*50)+250;//500;
						${window}['css_class'] = "CLASS='clean'";
						//$window['css_style'] = "STYLE='color: " . COLOR_HIGHLIGHT_DARK . ";text-decoration: none;'";
						${window}['anchor'] = ${trans}['en'] . " [click to translate: $value]";
						${window}['href'] = TEMPLATE_DOMAIN . "admin/admin_translate.php?en=" . ${trans}['en'];
						
						//return ${trans}['en'] . " " . pop_window($window);
						return pop_window($window);
					} else {
						return ${trans}['en'];
					}
				} else return ${trans}['en'];
			}
			
			
			
			
			
			
		}
	}
}
/**** END FUNCTION ****/



/*

function trans_en($en,$link = 1) { // TRANSLATE FROM english (en)
	// no need to translate english into english
	if(TRANS_LANG == 'en'){
		$return = $en; 
		
	} else { // if not english
		
		$translation_library = ${_SESSION}['TRANSLATION_LIBRARY'];
		
		${window}['width'] = 250;// this should be an argument in pop_window
	
		//query_db();
		//if ( !in_array(strtolower($en),array_flip($translation_library)) ) {
		if ( !in_array($en,array_flip($translation_library)) ) { // IF NOT IN LIBRARY
			if(defined('DEV_TRANS')){
				if($link){ // LINK IT
					${window}['anchor'] = "<FONT COLOR=EF5C47> $en</FONT>";
					//$window['anchor'] = "[click to translate: $en]";
					${window}['href'] = TEMPLATE_DOMAIN . "admin/admin_translate.php?en=$en";
				
					$return = pop_window($window);
				} else { // DONT LINK, JUST TAG
					$return = $en . "[*]";
				}
			} else $return =  $en;
		} else { 
			
			if ( preg_match("/admin/admin_/i",$_SERVER['PHP_SELF']) ) {
				// NOT SURE WHAT THIS SECTION IS FOR - jon
				
				
				$return = $translation_library[$en] . "(mystery section)";
				
			} else {
				$return =  $translation_library[$en];
			}
		}
	}
return $return;
}
/**** END FUNCTION ****/




/*
		function get_trans($types) { 
	$types = str_replace(",","' AND type='",$types);
	// builds a translation dictionary		
	$trans_data_sql = "SELECT trans_id, " . TRANS_LANG . " FROM translations WHERE type = '" . $types . "'";
	$trans_data_res = mysqli_query($db, $trans_data_sql);
	while($trans = mysqli_fetch_array($trans_data_res)){
		$trans_data[$trans['trans_id']] = ${trans}['TRANS_LANG'];
	}
	${GLOBALS}['trans'] = $trans_data;
}
/**** END FUNCTION ****/



/*

		function set_translation_library($language) {
	$trans_lib_sql = "SELECT en, $language FROM translations WHERE type = 'word' OR type = 'form'";
	$trans_lib_res = mysqli_query($db, $trans_lib_sql);
	$translation_library = array();
	while($translation_data = mysqli_fetch_array($trans_lib_res)){
		if($translation_data[$language] != "") $translation_library[$translation_data['en']] = $translation_data[$language];
	}
	
	${_SESSION}['TRANSLATION_LIBRARY'] = $translation_library;
	${_SESSION}['TRANSLATION_LANGUAGE'] = TRANS_LANG;
	
	echo "fetched new translation library: ". TRANS_LANG . "|$language|" . ${_SESSION}['TRANSLATION_LANGUAGE'] ;
}
/**** END FUNCTION ****/

/*
if(!$_SESSION['TRANSLATION_LIBRARY'] || ($_SESSION['TRANSLATION_LANGUAGE'] != TRANS_LANG)){
	//set_translation_library( TRANS_LANG );
}

// NOTE: ${_SESSION}['TRANSLATION_LIBRARY'] is set in above function .. not sure where it should go yet.   


function trans_revert($text) { // TRANSLATE FROM english (en)
		
	//query_db();
	$trans = mysqli_fetch_array(mysqli_query($db, "SELECT en FROM translations WHERE " . TRANS_LANG . " = '" . $text . "' LIMIT 1"));
	return ${trans}['en'];

}


*/


///////// DEPRICATED ///////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/*		function old_trans_en($en) { // TRANSLATE FROM english (en)

${window}['width'] = 250;

//query_db();
if ( !$trans = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM translations WHERE en = '" . $en . "' LIMIT 1")) ) {
	//return "<FONT COLOR=RED>$en</FONT>";
	
	${window}['anchor'] = "<FONT COLOR=EF5C47>$en</FONT>";
	${window}['href'] = TEMPLATE_DOMAIN . "admin/admin_translate.php?en=$en";
	
	$return = pop_window($window);
	//echo "FILE " . ${_SERVER}['PHP_SELF'];
} else {
	
	if ( preg_match("/admin/admin_/i",$_SERVER['PHP_SELF']) ) {
		${window}['anchor'] = ${trans}['TRANS_LANG'];
		${window}['href'] = TEMPLATE_DOMAIN . "admin/admin_translate.php?en=" . ${trans}['TRANS_LANG'];
		
		$return = ${trans}['TRANS_LANG'];
		//$return = pop_window($window);
		//$return = "<A HREF=\"javascript:OpenWin('" . ${window}['href'] . "','" . ${window}['target'] . "','" . ${window}['width'] . "','" . ${window}['height'] . "');\">" . ${window}['anchor'] . "</A>";
	} else {
		$return = ${trans}['TRANS_LANG'];
	}
}

return $return;
}
/**** END FUNCTION ****/





/*		function old_trans_id($trans_id) { // TRANSLATE FROM ID (trans_id)

	//query_db();
	$trans_id_sql= "SELECT en, " . TRANS_LANG . " FROM translations WHERE trans_id = '" . $trans_id . "' LIMIT 1";
	$trans_id_res = mysqli_query($db, $trans_id_sql);
	
	if ( !$trans = mysqli_fetch_array($trans_id_res) ) {
		return "<FONT COLOR=RED>no record in table (id: $trans_id)</FONT>";
	} else {
		if($trans['TRANS_LANG'] != "") return ${trans}['TRANS_LANG'];
		else return ${trans}['en'];
	}
	
	return ${trans}['TRANS_LANG'];

}
/**** END FUNCTION ****/



/**** END FUNCTION ****/



?>
