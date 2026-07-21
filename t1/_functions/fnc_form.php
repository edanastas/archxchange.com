<?php


// generates the options for a pull down menu from a enum field 
// $table is the table name, $field is the enum field you want to use 
// and $selected is the option to be selected 

		function enum_select_options($table,$field,$selected='') {
	$query = mysqli_query($db, "DESCRIBE $table"); 
	$result = mysqli_fetch_array($query); 
	do { 
		if ($result['Field'] == $field) { 
			if (substr($result['Type'],0,5) != "enum(") return FALSE; 
			
			$field_type = str_replace("enum(","",$result['Type']); 
			$field_type = str_replace("'","",$field_type); 
			$field_type = str_replace(")","",$field_type); 
			$options = explode(",",$field_type); 
			for ($i = 0; $i < count($options); $i++) { 
				$select_options .= "<option value=\"".$options[$i]."\""; 
				if ($options[$i] == $selected) $select_options .= " selected>".$options[$i]."</option>\n"; 
				else $select_options .= ">".$options[$i]."</option>\n"; 
			} 
			
			return $select_options; 
		} 
	} while ($result = mysqli_fetch_array($query)); 
} 
/**** END FUNCTION ****/





		//function form_input($field_name,$field_label,$input,$styles,$trailer,$options) { // FORM FIELD DEFAULT
		function form_input($insert_form) { // FORM FIELD DEFAULT
	
	
	// OF NO $field_label --> SET IT TO SPACE
	//if ( !$field_label ) $field_label = "&#160";
	
	if ( is_array($insert_form) ) {
		
		//dev_print($insert_form);
		global $error;
		
		foreach ( $insert_form AS $fields ) {
			
			unset($start);
			unset($return);
			unset($end);
			
			list($field_name,$field_label,$input,$styles,$trailer,$options) = $fields;
				
				// SETUP SPACING VALUES
				$field_label_display = html_strip($field_label);
				if ( strlen($field_label_display) > 20 ) {
					${html}['width'] = 240;
					${style}['width'] = "width:". ${html}['width'] ."px;";
					//$style[padding-left] = ($html['width']/2);
					${style}['padding'] = ($html['width']/4);
				} elseif ( strlen($field_label_display) < 6 ) {
					${html}['width'] = 40;
					${style}['width'] = "width:". ${html}['width'] ."px;";
					//$style[padding-left] = ($html['width']/2);
				} else {
					${html}['width'] = 150;
					${style}['width'] = "width:". ${html}['width'] ."px;";
					//$style['width'] = "width:100px;";
					//$style[padding-left] = ($html['width']/2);
					
					${style}['padding'] = ($html['width']/10);
				}
				
				$style[padding-left] = ($html['width']);
				
				if ( is_array($options) ) { // IF ARRAY PROCESS VALUES -->
					if ( array_key_exists("required_to_display",$options) ) { // IF ARRAY KEY EXISTS
						if ( !$options['required_to_display'] ) { // AND IF KEY DOES NOT CONTAIN VALUE
							$input = NULL; // RESET INPUT TO NULL TO PREVENT FORM FROM BEING DISPLAYED
						}
					}
				}
				
				
				if ( $input ) { //  IF INPUT VALUE EXISTS
					
					////////// DEFAULT VARIABLES
					////////////////////////////////////////////////////////////////////////////////
					////////////////////////////////////////////////////////////////////////////////
					${html}['valign'] = " VALIGN=TOP"; // CHANGED TO TOP FOR PAYMENT FORM WHEN TEXT WRAPS ON SMALL TABLES SEE checkout.php (payment)
					//$html['valign'] = " VALIGN=CENTER";
					
					
					////////// ALTERNATE FUNCTIONS
					////////////////////////////////////////////////////////////////////////////////
					/*if ( is_array($fieldname) ) {
						foreach($fieldname 	AS $value) {
							$construct_stirng .= "[". $value ."]";
							
							//$error['address']['134834'][fieldname] = "error message";
						}
					} else*/
					
					// TITLE
					if ( $field_name == "-" ) {
						
						if ( is_array($input) ) {
							
							// IF THE INPUT IS AN ARRAY AND THE $field_name IS A "-" -->
							foreach( $input AS $key => $value) { // THEN DISPLAY ALL THE ARRAY VALUES AS THE CELL CONTENT
								
								if ( !is_int($key) ) { // DISPLAY THE TITLE 
									$bg_color = "CCCCCC"; // DDDDDD
									$return .= "<TR BGCOLOR=#" . $bg_color . ">
											<TD CLASS='formTitle' STYLE='padding-left:". ${style}['padding'] ."px;font-weight:bold;color:#FFFFFF;' COLSPAN=2>" . 
												$value . "</TD>
										</TR>";
								} else {
									$bg_color = return_alternate($bg_color,"FDFEF2","FFFDD6"); // FFFFFF","EEEEEE F5F6F0","FFEAB3
									
									$return .= "<TR BGCOLOR=#" . $bg_color . ">
											<TD CLASS='formTitle' COLSPAN=2>" . // STYLE='padding-left:30px;'
												$value . "</TD>
										</TR>";
								}
							}
							
						} elseif ( is_int($input) ) { // IF $input IS AN INTEGER THEN USE THE INTEGER AS THE SPACER HEIGHT
							$return = "<TR>
									<TD HEIGHT=" . $input . " COLSPAN=2>
										</TD>
								</TR>";
						
						} else { // TITLE BAR
							$return = "<TR>
									<TD></TD>
									<TD CLASS='formTitle'>
										<H1>" . $input . "</H1></TD>". // STYLE='font-size:small;'
								"</TR>";
							
						}
						
					// FORM SUBTITLE
					} elseif ( $field_name == "_" ) {
						
						
						// TITLE BAR
							$return = "<TR>
										<TD></TD>
										<TD ALIGN=LEFT CLASS='formSubtitle'".
										// STYLE='padding-top:10px;padding-bottom:5px;padding-right:50px;'
										">
											<h2>" . $input . "</h2></TD>
									</TR>";
						
					// FORM QUESTION
					} elseif ( $field_name == "?" ) {
						
						$return = "<TR>
									<TD ALIGN=LEFT CLASS='formQuestion' STYLE='padding-left:". $style[padding-left] ."px;' COLSPAN=2>
										<h3>" . $input . "</h3></TD>
								</TR>";
						
						
					// FORM INFORMATION TEXT
					} elseif ( $field_name == "~" ) {
						
						
						if ( is_int($input) ) { // IF $input IS AN INTEGER --> USE THE INTEGER AS THE CHARACTERISTICS SET
							// CREATE NEW ONES AS YOU NEED THEM (1,2, ...)
							
							if ($input == 1) {
								// SETUP SET 1 CHARACTERISTICS (SIZE, WIDTH, COLOR, ETC.)
								// SETUP HERE VALUES HERE AND ADJUST INPUTS BELOW
								${hr}['width'] = 100;
							} elseif ($input == 2) {
								// SETUP SET 1 CHARACTERISTICS (SIZE, WIDTH, COLOR, ETC.)
								${hr}['width'] = 90;
							} elseif ($input == 3) {
								// SETUP SET 1 CHARACTERISTICS (SIZE, WIDTH, COLOR, ETC.)
								${hr}['width'] = 60;
							}
							
							$return = "<TR>
									<TD></TD>
									<TD>
										<HR SIZE=1 WIDTH=". ${hr}['width'] ."% ALIGN=LEFT NOSHADE COLOR=#DDDDDD></TD>
								</TR>";
						
						} else { // TITLE BAR
							$return = "<TR>
										<TD></TD>
										<TD ALIGN=LEFT".
										// STYLE='padding-top:10px;padding-bottom:5px;padding-right:50px;'
										// style='width:". FORM_WIDTH ."px;'
										">
											<div class='formNote'>" . $input . "</div></TD>
									</TR>";
						}
						
					// FORM TEXT
					}/* elseif ( $field_name == "~" ) {
						
						if ( is_int($input) ) { // IF $input IS AN INTEGER --> USE THE INTEGER AS THE CHARACTERISTICS SET
							// CREATE NEW ONES AS YOU NEED THEM (1,2, ...)
							
							if ($input == 1) {
								// SETUP SET 1 CHARACTERISTICS (SIZE, WIDTH, COLOR, ETC.)
							}
							
							$return = "<TR>
									<TD COLSPAN=2>
										<HR SIZE=1 WIDTH=". ($input ? $input : "95") ."% ALIGN=CENTER NOSHADE COLOR=#DDDDDD></TD>
								</TR>";
						
						} else { // TITLE BAR
							$return = "<TR>
										<TD ALIGN=LEFT COLSPAN=2 CLASS='TextGray' 
											STYLE='padding-top:5px;padding-bottom:5px;padding-right:". ${style}['padding'] ."px;padding-left:". ${style}['padding'] ."px;'>
											" . $input . "</TD>
									</TR>";
						}
						
						
						
					// GUIDE MESSAGE
					}*/ elseif ( $field_name == "*" ) {
						
						$return = "<TR>
								<TD ALIGN=CENTER HEIGHT=1 COLSPAN=2></TD>
							</TR><TR>
								<TD ALIGN=CENTER COLSPAN=2 CLASS='formNotification'>
									" . $input . "</TD>
							</TR><TR>
								<TD ALIGN=CENTER HEIGHT=1 COLSPAN=2></TD>
							</TR>";
						
						
					// ALERT MESSAGE
					} elseif ( $field_name == "!" ) {
						
						$return = "<TR>
								<TD ALIGN=CENTER COLSPAN=2 CLASS='formAlert'>
									" . $input . "</TD>
							</TR>";
						
						
					// PROCESS THE $input FORM VARIABLE
					} else {
						
						////////// ERROR
						////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////
						if ( $error[$field_name] ) { // IF ERROR - DISPLAY -->
							
							//$line['type'] = "thin lightgray solid";
							${line}['type'] = "solid thin #DDDDDD";
							//$padding['top'] = "padding-top:10px;";
							${styles}['1'] .= "border-left:". ${line}['type'] .";";
							${styles}['2'] .= "border-right:". ${line}['type'] .";";
							
							//background-color:#FFFFCC
							//if ( is_array( $input ) ) { // MOVED BELOW
								//if ( !preg_match("/background-color/i", ${input}['2']) ) ${input}['2'] .= "background-color:#FFF6AA;";
							//}
							
							//if ( $field_name == "error" ) {
							//	$error[$field_name] = "<FONT COLOR=RED><B> ERROR </B> </FONT>";
							//} else {
								$error[$field_name] = "<FONT COLOR=RED><B>OOPS!</B> - " . $error[$field_name] . " </FONT>";
							//}
							
							${styles}['0'] .= "background-color:#FFFFCC;";
							
							// DISPLAY THE START OF THE ERROR AREA (DOTTED LINE / START BACKGROUND COLOR CHANGE)
							$start = "<TR STYLE='" . ${styles}['0'] . "'>
								<TD ALIGN=LEFT VALIGN=CENTER HEIGHT=20 COLSPAN=2  CLASS='form' ". 
									//"STYLE='". ${cell}['padding'] ."border-top:". ${line}['type'] .";border-left:". ${line}['type'] .";border-right:". ${line}['type'] .";'>" . 
									"STYLE='padding-left:10px;padding-right:10px;padding-top:5px;border-top:". ${line}['type'] .";". ${styles}['1'] . ${styles}['2'] ."'>
									". $error[$field_name] . "</TD></TR>";
							
							// DISPLAY THE END OF THE ERROR AREA (DOTTED LINE / END BACKGROUND COLOR CHANGE)
							$end = "<TR STYLE='" . ${styles}['0'] . "'>
								<TD HEIGHT=2 COLSPAN=2 STYLE='empty-cells:show;padding-bottom:2px;border-bottom:". ${line}['type'] .";". ${styles}['1'] . ${styles}['2'] ."'></TD></TR>";
							
							//${styles}['1'] .= "border-left:". ${line}['type'] .";";
							//${styles}['2'] .= "border-right:". ${line}['type'] .";";
							
						}
						
						////////// DEFAULT INPUT FORMAT
						////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////
						//$input['type'],$input['name'],$input['value'],$input['style'],$input['option'] // FORM FUNCTION VARIABLES
						if ( is_array( $input ) ) { // IF DEFAULT INPUT FORMAT -->
							
							////////// DEFAULT STYLE
							//if ( !$input['2'] && ${input}['2'] != "-" ) { // IF NO STYLE SUBMITTED USE -->
								//$input['2'] = "width:240px;";
							//}
							
							if ( !preg_match("/width/i", ${input}['2']) && preg_match("/TEXT|TEXTAREA|PASSWORD/i", ${input}['0']) ) ${input}['2'] .= "width:". FORM_WIDTH ."px;";
							//if ( !preg_match("/background-color/i", ${input}['2']) ) ${input}['2'] .= "background-color:#FFFCC4;"; //FFF6AA
							
							////////// SET FORM VALUES
							////////////////////////////////////////////////////////////////////////////////
							////////////////////////////////////////////////////////////////////////////////
							if ( ${options}['value'] == 1 || ${options}['no_post'] ) { // KEEP INPUT VALUE OVER POST VALUE
								
							} elseif ( ${options}['value'] == 2 ) { // IF THERE IS NO INPUT VALUE, USE POST VALUE
								
								if ( !$input['1'] ) 
									${input}['1'] = $_POST[$field_name];
								
							} elseif ( ${options}['value'] == 3 ) { // EMPTY VALUE FOR INPUT
								
								${input}['1'] = NULL;
								
							} elseif ( ${options}['value'] == 4 ) { // DEFAULT VALUE FOR INPUT
								
								//$options['default']
								
								
								
							} elseif ( $_POST[$field_name] ) { // DEFAULT: IF POST VALUE --> USE POST VALUE
							//} elseif ( !$options['no_post'] && $_POST[$field_name] ) { // IF POST VALUE AND NO no_post --> USE POST VALUE
							//if ( !$options['value'] && $_POST[$field_name]) { // IF THERE IS NO VALUE PRIORITY DEFINED USE POST IF EXISTS
							//if ( !$input['1'] && !$options['no_post'] ) { // IF NO INPUT SUBMITTED USE POST VALUE
								
								//if ( $_POST[$field_name] && ${input}['1'] && admin_access(9) ) 
									//echo "alert! function change<BR>"; // --> input field overwritten by post field <BR>";
									//(file:". ${_SERVER}['PHP_SELF'] ." line:". __LINE__ .")<BR> 
									//change implemented for user_address.php affecting inc_address_form.php in the file fnc_form.php line: ". __LINE__ . "<P>";
								
								${input}['1'] = $_POST[$field_name];
								
							}
							
							
							if ( ${input}['0'] == "TEXTAREA" ) { // IF TEXTAREA
								${html}['valign'] = " VALIGN=TOP";
								$input = "<TEXTAREA NAME=\"" . $field_name ." ID=\"" . $field_name . 
									"\" STYLE='" . ${input}['2'] . "' " . ${input}['3'] . ">" . stripslashes({$input['1']}) . "</TEXTAREA> ". 
										( ${input}['4'] ? "<BR>". ${input}['4'] : NULL ) ."\n";
								
							} else { // NOT TEXTAREA
								$input = "<INPUT TYPE=\"" . ${input}['0'] ."\"".
									" NAME=\"" . $field_name . "\"" . 
								    " ID=\"" . $field_name . "\"" .
									" VALUE=\"" . stripslashes({$input['1']}) . "\"" . 
									" STYLE='" . ${input}['2'] . "' " . ${input}['3'] . "". 
										( preg_match("/RADIO|CHECKBOX/i",{$input['0']}) && $_POST[$field_name] ? " CHECKED" : NULL ) ."> ". ${input}['4'] ."\n";
							}
							
						}// else {
							//$input = nl2br($input);
							//$input = $input;
						//}
						
						
						// ADD THE PADDING TO THE DISPLAY CELL
						//if ( !preg_match("/padding-top/i", ${styles}['1']) ) ${styles}['1'] .= "padding-top:5px;";
						//if ( is_array($styles) )
							if ( !preg_match("/padding-right/i", ${styles}['1']) ) ${styles}['1'] .= "padding-right:5px;";
							if ( !preg_match("/padding-top/i", ${styles}['1']) ) ${styles}['1'] .= "padding-top:5px;";
							// REMOVED NEXT LINE BECAUSE OF DISPLAY ALIGNMENT OF ADMIN MANAGER (firstname, lastname)
							//if ( !preg_match("/padding-top/i", ${styles}['1']) ) ${styles}['1'] .= "padding-top:5px;";
							if ( !preg_match("/width/i", ${styles}['1']) ) ${styles}['1'] .= ${style}['width'];
						
						
						
						////////// THE FORM
						////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////
						
						//text-align:right;
						
						$return .= "<TR". ( ${styles}['0'] ? " STYLE='" . ${styles}['0'] . "'" : NULL ) ." ID='" . $field_name . "Row'>
								<TD ALIGN=RIGHT ". ${html}['valign'] ." CLASS='formLabel'". 
									( ${styles}['1'] ? " STYLE='" . ${styles}['1'] . "'" : NULL ) ." NOWRAP>". //  WIDTH=25% // ${style}['width'] . // WIDTH=". ${html}['width'] ."
									$field_label ."</TD>
								<TD ALIGN=LEFT VALIGN=CENTER CLASS='formInput'". 
										( ${styles}['2'] ? " STYLE='" . ${styles}['2'] . "'" : NULL ) .">". //  WIDTH=75%
									$input . 
										( $trailer ? " <FONT CLASS='TextGray'>&#160 ". $trailer ."</FONT>" : NULL ) . "</TD>
							</TR>";
					}
					
					// ($start / $end) VARIABLES ARE FOR ERROR DISPLAY
					$compile .= $start . $return . $end;
				}
				
			//}
		}
	
	if ($compile) return $compile;
	
	}
}
/**** END FUNCTION ****/






		function form_drop_countries_jon($match) { // RETURN RED ERROR TEXT FOR FORM FIELDS
	
	$return .= "<SELECT NAME=country_id onchange=\"submit()\">";
	
	query_db();
	$query = mysqli_query($db, "SELECT * FROM countries ORDER BY country_name");
	
	
	$return .= "<OPTION VALUE='' DISABLED>" . trans("SELECT A COUNTRY",1) . "</OPTION>";

	
	while ($results = mysqli_fetch_assoc($query) ) {
		
		// IF COUNTRY IS AFGHANISTAN --> INSERT BREAK LINE
		if ( ${results}['country_name'] == "Afghanistan" ) {
			$return .= "<OPTION VALUE=''> -------------- </OPTION>";
		}
			
		if ( $match == ${results}['country_id'] ) {
			$insert_selected_country = " SELECTED";
		} else {
			$insert_selected_country = NULL;
		}
		
		$return .= "<OPTION VALUE='{$results['country_id']}'$insert_selected_country>{$results['country_name']}</OPTION>";
		
	}
		
	$return .= "</SELECT>\n";

return $return;
	
}
/**** END FUNCTION ****/






		function form_drop_zones_jon($match) { // 
	
	
	$return .= "<SELECT NAME=zone_id onchange=\"submit()\">";
	
	query_db();
	
	$zone_list_sql = "SELECT a.zone_id, a.zone_name, a.zone_country_id, b.country_name FROM countries_zones a, countries b WHERE a.zone_country_id = b.country_id ORDER BY b.country_name, a.zone_name";

	$query = mysqli_query($db, $zone_list_sql);
	
	$return .= "<OPTION VALUE=''>" . trans("SELECT A ZONE",1) . "</OPTION>";
	
	while ($results = mysqli_fetch_assoc($query) ) {
				
		if ( $match == ${results}['zone_id'] ) {
			$insert_selected_zone = " SELECTED";
		} else {
			$insert_selected_zone = NULL;
		}
		
		if($results['country_name'] != $lastcname) $return .= "<OPTION VALUE='' DISABLED></OPTION>\n<OPTION VALUE='' DISABLED>" . ${results}['country_name']. "</OPTION>\n";
		$return .= "<OPTION VALUE='{$results['zone_id']}'$insert_selected_zone> - ${results}['zone_name']</OPTION>";
		$lastcname = ${results}['country_name'];
	
	}
		
	$return .= "</SELECT>\n";

return $return;
	
}
/**** END FUNCTION ****/






		function form_drop_countries($selected=NULL,$fieldname="country_id",$options=NULL) { // RETURN RED ERROR TEXT FOR FORM FIELDS
	
	// PROCESS FORM NAMES
	if ( is_array($fieldname) ) {
	
		if ( $posted_value = eval("return \$_POST[". ${fieldname}['0'] ."]". ${fieldname}['2'] ."[". ${fieldname}['1'] ."];") ) {
			$selected = $posted_value;
		}
		
		$form_name = ${fieldname}['0'] . ${fieldname}['2'] . "[". ${fieldname}['1'] ."]";
		
	} else {
		if ( $_POST[$fieldname] ) $selected = $_POST[$fieldname];
		$form_name = $fieldname;
		
	}
	
	
	if ( !$options['java'] ) ${options}['java'] = "onchange=\"submit()\"";
	
	//$return .= "<SELECT NAME=". $form_name ."". (!{$options['manual']} ? " onchange=\"updateMenu(this,'". $update_zones ."')\"" : NULL ) .">";
	$return .= "<SELECT ID=". $form_name ." NAME=". $form_name ." ". (!{$options['manual']} ? ${options}['java'] : NULL ) .">";
	
	
	//$query = mysqli_query($db, "SELECT * FROM countries WHERE inactive IS NULL ORDER BY country_name");
	$query = mysqli_query($db, "SELECT * FROM countries ORDER BY country_name");
	
	
	// CHECK IF A COUNTRY HAS BEEN SUBMITTED
	//if ( !$_REQUEST[$fieldname] ) {
	if ( !$selected ) {
		$return .= "<OPTION VALUE=''>" . trans("SELECT A COUNTRY",1) . " -----------> </OPTION>";
	}
	
	while ($results = mysqli_fetch_assoc($query) ) {
		
		// IF COUNTRY IS AFGHANISTAN --> INSERT BREAK LINE
		if ( ${results}['country_name'] == "Afghanistan" ) {
			$return .= "<OPTION VALUE=''> -------------- </OPTION>";
		}
		
		//echo "\$_POST[$fieldname] --> $_POST[$fieldname]<BR>";
		
		/*if ( $_REQUEST[$fieldname] return_priority(array($_REQUEST['zone_id'],$selected)) == $results[$fieldname] ) {
			$insert_selected_country = " SELECTED";
		} else {
			$insert_selected_country = NULL;
		}*/
		
		$return .= "<OPTION VALUE='". ${results}['country_id'] ."'" . 
			//return_match(return_priority(array($_REQUEST[$fieldname],$selected)), $results[$fieldname], " SELECTED") . ">{$results['country_name']}</OPTION>";
			( $selected == ${results}['country_id'] ? " SELECTED" : NULL ) . ">". ${results}['country_name'] ."</OPTION>";
		
	}
		
	$return .= "</SELECT>\n";

return $return;
	
}
/**** END FUNCTION ****/





		function form_drop_zones($selected=NULL,$fieldname="zone_id",$options=NULL) { // RETURN ZONES DROP-DOWN MENU
	
	//global $edit;
	//query_db();
	
	//echo "\$_POST[". ${fieldname}['0'] ."]". ${fieldname}['1'] ."";
	//echo "<P>eval -> ". eval("return \$_POST[". ${fieldname}['0'] ."]". ${fieldname}['1'] .";");
	
	// PROCESS FORM NAMES
	if ( is_array($fieldname) ) {
	
		if ( $posted_value = eval("return \$_POST[". ${fieldname}['0'] ."]". ${fieldname}['2'] ."[". ${fieldname}['1'] ."];") ) {
			$selected = $posted_value;
		}
		
		$form_name = ${fieldname}['0'] . ${fieldname}['2'] . "[". ${fieldname}['1'] ."]";
		
		// CHECK IF COUNTRY IS SELECTED
		$selected_country = eval("return \$_POST[". ${fieldname}['0'] ."]". ${fieldname}['2'] ."[country_id];");
		
	} else {
		if ( $_POST[$fieldname] ) $selected = $_POST[$fieldname];
		$form_name = $fieldname;
		
		// CHECK IF COUNTRY IS SELECTED
		$selected_country = ${_POST}['country_id'];
	}
	
	
	
	// could not figure out why had this sql query below so I removed it.
	// gave priority to posted values, even if a value is submitted.
	// if you experince problems, remove /// (three bar)) lines below
	/*if ( ${_POST}['zone_id'] ) {
		
		$selected = ${_POST}['zone_id'];
	}
	
	if ( $selected ) {
		
		$query = mysqli_query($db, "SELECT c2.* FROM `countries_zones` c1 
			LEFT JOIN `countries_zones` c2 ON c1.zone_country_id = c2.zone_country_id 
			WHERE c1.zone_id = '" . $selected . "'");
		
	} else {
		
		//$query = mysqli_query($db, "SELECT * FROM countries_zones WHERE zone_country_id = '" . $selected . "'");
		$query = mysqli_query($db, "SELECT * FROM countries_zones WHERE zone_country_id = '" . ${_REQUEST}['country_id'] . "'");
	}*/
	
	
	// IF THE POSTED country_id --> GET ZONES FOR THAT COUNTRY
	if ( $selected_country ) { // IF POSTED COUNTRY DOES NOT MATCH THE ZONES COUNTRY SELECT COUNTRY FOR THE POSTED ZONE
		
		$query = mysqli_query($db, "SELECT * FROM countries_zones WHERE zone_country_id = '" . $selected_country . "'");
		
		/*$query = mysqli_query($db, "SELECT c2.* FROM `countries_zones` c1 
			LEFT JOIN `countries_zones` c2 ON c1.zone_country_id = c2.zone_country_id 
			WHERE c1.zone_id = '" . $selected . "' AND c1.zone_country_id = '" . ${_POST}['country_id'] . "'");*/
		
	} elseif ( $selected ) { // IF ZONE CHANGES SELECT COUNTRY FOR THAT ZONE
		$query = mysqli_query($db, "SELECT c2.* FROM `countries_zones` c1 
			LEFT JOIN `countries_zones` c2 ON c1.zone_country_id = c2.zone_country_id 
			WHERE c1.zone_id = '" . $selected . "'");
	}// else {
		
	//	$query = mysqli_query($db, "SELECT * FROM countries_zones WHERE zone_country_id = '" . ${_POST}['country_id'] . "'");
	//}
	
	
	
	if ( ${options}['onchange'] ) {
		${options}['onchange'] = " onchange=\"submit()\"";
	}
	
	if ( $query ) {
		
		if ( mysqli_num_rows($query) > 0 ) {
			
			$return .= "<SELECT ID=". $form_name ." NAME=". $form_name ."". ${options}['onchange'] .">";
							
			// CHECK IF A ZONE HAS BEEN SUBMITTED
			//if ( !$_REQUEST['zone_id'] ) {
				//$return .= "<OPTION VALUE='' DISABLED>" . trans("SELECT",1) . " ----------------> </OPTION>";
				
				// SET THIS TO THE zone_id VAR IN THE URL TO PASS BACK IF NOTHING WAS CHANGED (SEE admin_warehouse_priorities.php AND )
				//$return .= "<OPTION VALUE='". ${_GET}['zone_id'] ."'>" . trans("SELECT A ZONE",1) . " --------> </OPTION>";
				$return .= "<OPTION VALUE='". 
					//eval("return $_REQUEST". $form_name .";") .// 
					${_GET}['zone_id'] .
					"'>" . trans("SELECT A ZONE",1) . " --------> </OPTION>";
			//}
			
			while ($results = mysqli_fetch_assoc($query) ) {
				
				/*if ( return_priority(array($_REQUEST['zone_id'],$selected)) == ${results}['zone_id'] ) {
					$insert_selected_zone = " SELECTED";
				} else {
					$insert_selected_zone = NULL;
				}*/
				
				//$return .= "<OPTION VALUE='{$results['zone_id']}'$insert_selected_zone>{$results['zone_name']}</OPTION>";
				$return .= "<OPTION VALUE='${results}['zone_id']'" . 
					///return_match(return_priority(array($_REQUEST['zone_id'],$selected)), ${results}['zone_id'], " SELECTED") . ">{$results['zone_name']}</OPTION>";
					( 
						( $selected != NULL ? $selected : ${_REQUEST}['zone_id'] ) // IF NO SELECT ZONE --> MATCH TO POSTED ZONE VALUE
					== ${results}['zone_id'] ? " SELECTED": NULL ) . ">{$results['zone_name']}</OPTION>";
				
				
				
				
			}
			$return .= "</SELECT>\n";
		}
	}
	
return $return;
	
}
/**** END FUNCTION ****/






		function form_default($title, $form, $options) {
	
	return "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP WIDTH=40 CLASS='TextGrayDark' STYLE='padding-right:10px;padding-top:4px;' NOWRAP>\n
			" . $title . " </TD>\n
		<TD ALIGN=LEFT VALIGN=TOP NOWRAP CLASS='TextGrayDark'>" . $form . "</TD>
	</TR>\n\n";
	
	
}
/**** END FUNCTION ****/






		function form_drop_timezones($timezone_id=NULL) { // RETURN TIMEZONES WHERE $timezone_id IS THE SELECTED GMT
	
	//echo "the timezone is \${_REQUEST}['timezone_id'] --> " . ${_REQUEST}['timezone_id'] . " <P>";
	
	if ( !$timezone_id ) { // IF NO $timezone_id USE ${_REQUEST}['timezone_id']
		$timezone_id = ${_REQUEST}['timezone_id'];
		//echo "no timezone set<P>";
	}
	
	query_db();
	//$query = mysqli_query($db, "SELECT * FROM timezones WHERE zone_country_id = '" . ${_REQUEST}['country_id'] . "'");
	$query = mysqli_query($db, "SELECT * FROM timezones");
	
	if ( mysqli_num_rows($query) > 0 ) {
		
		$return .= "<SELECT NAME=timezone_id STYLE='width:250px;'>";
						
		// CHECK IF A ZONE HAS BEEN SUBMITTED
		if ( !$timezone_id ) {
			$return .= "<OPTION VALUE='' DISABLED>" . trans("SELECT",1) . " ----------------> </OPTION>";
		}
		
		while ($results = mysqli_fetch_assoc($query) ) {
			
			/*if ( ${results}['timezone_id'] == $timezone_id ) {
			//if ( ${results}['timezone_id'] |= ${_REQUEST}['timezone_id'] | $timezone_id) {
				$insert_selected_zone = " SELECTED";
			} else {
				$insert_selected_zone = NULL;
			}*/
			
			$return .= "<OPTION VALUE='${results}['timezone_id']'" . 
				return_match($timezone_id, ${results}['timezone_id'], " SELECTED") . ">[" . ${results}['utc'] . "] ${results}['timezone']</OPTION>";
			
		}
		$return .= "</SELECT>\n";
	}
	
return $return;
	
}
/**** END FUNCTION ****/






		function form_drop_currencies($currency_id=NULL,$options=NULL) { // RETURN CURRENCY WHERE $currency_id IS THE SELECTED CURRENCY
	
	if ( !$currency_id ) { // IF NO $currency_id USE ${_REQUEST}['currency_id']
		$currency_id = ${_REQUEST}['currency_id'];
	}
	
	query_db();
	$query = mysqli_query($db, "SELECT * FROM currencies");
	
	if ( mysqli_num_rows($query) > 0 ) {
		
		//$return .= "<SELECT NAME=currency_id STYLE='width:250px;'>";
		$return .= "<SELECT NAME=currency_id>";
						
		// CHECK IF A ZONE HAS BEEN SUBMITTED
		if ( !$currency_id && !$options['compact']) {
			$return .= "<OPTION VALUE=''>" . trans("SELECT",1) . " ----> </OPTION>";
		}
		
		while ($results = mysqli_fetch_assoc($query) ) {
			
			/*if ( ${results}['currency_id'] == $currency_id ) {
			//if ( ${results}['currency_id'] |= ${_REQUEST}['currency_id'] | $currency_id) {
				$insert_selected_zone = " SELECTED";
			} else {
				$insert_selected_zone = NULL;
			}*/
			
			$return .= "<OPTION VALUE='${results}['currency_id']'" . 
				( $currency_id == ${results}['currency_id'] ? " SELECTED" : NULL ) . ">". 
					( ${options}['compact'] ? ${results}['code'] : ${results}['currency'] ) ."</OPTION>";
			
		}
		$return .= "</SELECT>\n";
	}
	
return $return;
	
}
/**** END FUNCTION ****/





		function form_table_start($options=NULL) {
	if ( !is_array($options) ) {
		//$options['cellpadding'] = "":
	//} elseif ( $options ) {
		${insert}['options'] = $options;
	}
	
	if ( !isset($options['width']) ) ${options}['width'] = "100%";
	if ( !isset($options['border']) ) ${options}['border'] = "0";
	if ( !isset($options['cellpadding']) ) ${options}['cellpadding'] = 2;
	if ( !isset($options['cellspacing']) ) ${options}['cellspacing'] = "0";
	if ( !isset($options['rules']) ) ${options}['rules'] = "NONE";
	
	return "<TABLE BORDER=". ${options}['border'] ." BORDERCOLOR=biege ALIGN=CENTER WIDTH=". ${options}['width'] ." 
		CELLPADDING=". ${options}['cellpadding'] ." CELLSPACING=". ${options}['cellspacing'] ." RULES=". ${options}['rules'] ." " . ${insert}['options'] . ">";
}
/**** END FUNCTION ****/





		function form_table_end() {
	return "</TABLE>";
}
/**** END FUNCTION ****/





		function form_update_redirect($message="YOU ARE BEING REDIRECTED", $interval=0, $location="./") {
	
	$return = "<META HTTP-EQUIV=REFRESH CONTENT='". $interval ."; URL=". $location ."'>";
	
	$return .= "<TABLE BORDER=0 BORDERCOLOR=lightbrown WIDTH=100%>
		<TR>
			<TD ALIGN=CENTER STYLE='padding-top:40px;'>
				<A HREF='". $location ."' STYLE='font-weight:bold;font-size:larger;color:red'><B>". strtoupper($message) ."</B></A></TD>
		</TR>
	</TABLE>";
	
	return $return;
}
/**** END FUNCTION ****/





		function form_cancel($location) {
	
	//if ( $_POST[CANCEL) {
		header("location:". $location ."");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=". $location ."'>";
		exit();
	//}
	//USAGE --> user_email.php, user_password.php
}
/**** END FUNCTION ****/





		function form_value($default,$value) { // DEFAULTS TO VALUE
	return " VALUE='". ( $value ? $value : $default ) ."' onFocus=\"if(this.value=='". $default ."')this.value='';\" onBlur=\"if(this.value=='')this.value='". $default ."';\"";
}
/**** END FUNCTION ****/





		function form_trailer($note) {
	return "<div style='float:right;width:160px;padding:4px;background:#eee;border:dotted thin gray;'>". $note ."</div>";
}
/**** END FUNCTION ****/





/*		function form_ XXX() {
	
}
/**** END FUNCTION ****/



?>
