<?php


/*******************************************************************************************
 *
 *		Auto HTML Form Generator 
 *		Name:		inc_form.php
 *		Author:		Edward Anastas (www.anastas.org)
 *		Email:		edward@anastas.org
 *		Date:		6/20/2004
 *		Version:	0.1.3
 *
 *		Description:
 *			auto form generator - Automatically creates and modifies database
 *			supports - TEXT, TEXTAREA, INPUT, RADIO, CHECKBOX, SELECT, DATE, TODAY
 *			
 *		Notes:
 *			
 *			preload with inc_form_init.php to load edit form variables
 *			
 *			
 *******************************************************************************************/



// ACCESS ///////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0



// SESSION //////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
if ( !$form['width'] ) { $form['width'] = 300; }
if ( !$form['style'] ) { $form['style'] = " STYLE='width:" . $form['width'] . "px;'"; }
if ( !$form['maxlength'] ) { $form['maxlength'] = 255; }

if ( !defined("DB_TITLE") ) {
	define("DB_TITLE",strtoupper(basename($_SERVER['PHP_SELF'],".php")));
}

define("COLOR_GUIDE","#888888");
define("COLOR_BACKGROUND","#FFFFFF");
define("COLOR_GRAY_LIGHT","#EEEEEE");


// DATABASE /////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0



// HTML /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0


// FORM /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 11.0


$buffer['form'] .= "<TABLE BORDER=0 ALIGN=CENTER WIDTH=100% CELLSPACING=0 CELLPADDING=3 RULES=NONE>
	 <FORM ACTION=" . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] . " METHOD=POST>";


////////// FORM PROCESSOR
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
if ( is_array($fields) ) {
	
	$previous_field_name = "id";
	
	////////// FORM NAME
	foreach ( $fields AS $field_name => $field_name_value ) {

		if ( is_array($field_name_value) ) {
			////////// FORM TYPE
			foreach ( $field_name_value AS $field_type => $field_type_value ) {


				// SETUP DEFAULT VARS
				$field_title_align = "CENTER";

				if ( is_array($field_type_value) ) {

					////////// FORM VALUES
					
					/*if ( $field_type == "RADIO" || $field_type == "SELECT" || $field_type == "CHECKBOX" ) {
						$create[$field_name] .= "`$field_name` enum(";
					}*/
					//$start = TRUE;
					foreach ( $field_type_value AS $field_value => $field_text ) {

						// SETUP DEFAULT VARS
						//$html[$field_name][title] = $field_text . " ";
						// INSERT FIELD NAME FOR DATABASES
						//$db[$field_name][content] = "`$field_name` ";
						
						
						
						////////// RADIO
						//////////////////////////////
						if ( $field_type == "CHECKBOX" || $field_type == "RADIO" ) {
							
							// DISPLAY FIELD NAME
							// 
							// 
							if ( $field_value == "-" ) { // FIELD NAME DISPLAY VALUE
							
								// DEFINE FIELD TITLE
								$html[$field_name][title] = $field_text;
								
							} else {
								
								// DEFINE FIELD TITLE (IF NOT DEFINED ABOVE ON PREVIOUS LOOP)
								if ( !$html[$field_name][title] ) {
									
									// HTML ////////////////////
									$html[$field_name][title] = $field_name;
									
								}
								
								
								if ( $field_type == "CHECKBOX" ) {
								
									// CREATE CHECKBOX (ENUM) ////////////////////
									$create[$field_name][start] = "`$field_name` ENUM(";
									$create[$field_name][content] .= $create[$field_name][comma] . "'" . $field_value . "'";
									$create[$field_name][end] = ") DEFAULT NULL,";
									
									// ALTER CHECKBOX (ENUM) //////////////////
									$alter[$field_name] = "ADD `$field_name` ENUM('1') DEFAULT NULL AFTER `" . $previous_field_name . "`;";
									
									// SET THE COMMA TO INSERT ON THE NEXT LOOP
									//$create[$field_name][comma] = ","; // DO NOT NEED THIS ANYMORE ONLY CHECKBOX USES ENUM('1') NOW
									
								} else {
									
									// CREATE ////////////////////
									$create[$field_name][content] .= "`$field_name` VARCHAR(100) DEFAULT NULL,";
									
									// ALTER //////////////////
									$alter[$field_name] = "ADD `$field_name` VARCHAR(100) DEFAULT NULL AFTER `" . $previous_field_name . "`;";
									
								}
								
								
	
								// IF ITEM IS SELECTED
								if ( $field_value == $form_value[$field_name] ) {
	
									$selected = " CHECKED";
	
									// DB ////////////////////
									//if ( $field_value ) { $buffer_field_value = "'$field_value'"; } else { $buffer_field_value = "NULL"; }
									$db[$field_name][content] = addslashes($field_value);
									
								} else {
									$selected = NULL;
								}
								
								
								// HTML ////////////////////
								$html[$field_name][content] .= " <INPUT TYPE=$field_type NAME='$field_name' VALUE='$field_value'$selected> $field_text \n";
								
							}
							
							
						////////// SELECT
						//////////////////////////////
						} elseif ( $field_type == "SELECT" ) {
							
							if ( $field_value == "-" ) {
								// DEFINE FIELD TITLE
								$html[$field_name][title] = $field_text;
							} elseif ( $field_value == "JAVA" ) {
								// DEFINE FIELD TITLE
								$html[$field_name][java] = " " . $field_text;
								
							} else {
								// DB ////////////////////
								
								//$alter[$field_name] = "";
								
								// CREATE ENUM
								//$create[$field_name][start] = "`$field_name` enum(";
								//$create[$field_name][content] .= $create[$field_name][comma] . "'" . $field_value . "'";
								//$create[$field_name][end] = ") DEFAULT NULL,";
								
								$create[$field_name][content] = "`$field_name` VARCHAR(100) DEFAULT NULL,";
								
								// SET THE COMMA TO INSERT ON THE NEXT LOOP
								$create[$field_name][comma] = ",";

								// ALTER //////////////////
								$alter[$field_name] = "ADD `$field_name` VARCHAR(100) DEFAULT NULL AFTER `" . $previous_field_name . "`;";
								
								
								// HTML ////////////////////
								if ( $field_value == $form_value[$field_name] ) {
									
									// FIELD VALUE MATCHES THE FORM VALUE
									$selected = " SELECTED";
	
									// DB ////////////////////
									//if ( $field_value ) { $buffer_field_value = "'$field_value'"; } else { $buffer_field_value = "NULL"; }
									//$db[$field_name][content] = "`$field_name` = $buffer_field_value" . $comma . "";
									$db[$field_name][content] = addslashes($field_value);
	
	
								} else {
									// FIELD VALUE DOES NOT MATCH FORM VALUE
									$selected = NULL;
								}
								
								
								//$db[$field_name][start] = "`$field_name` = ";
								//$db[$field_name][end] = $comma . "";
								
								// IF THE SELECT VALUE IS DIFFERENT THAN THE DISPLAY VALUE -->
								if ( strtolower($field_text) != strtolower($field_value) ) { // ADD IT TO DISPLAY VALUE
									$insert_value = " (" . $field_value . ")";
								} else {
									$insert_value = NULL;
								}
								
								
								// HTML ////////////////////
								$html[$field_name][start] = "<SELECT NAME='$field_name' VALUE='$field_value'" . $html[$field_name][java] . ">\n\n";
								$html[$field_name][content] .= "<OPTION VALUE='$field_value'$selected> " . $field_text . $insert_value . "</OPTION>\n";
								$html[$field_name][end] = "</SELECT>\n\n";
								
								
								// DEFINE FIELD TITLE
								$html[$field_name][title] = $field_name . " ";
							}
							
							
						////////// TEXTAREA
						//////////////////////////////
						} elseif ( $field_type == "TEXTAREA" ) {

							// DB ////////////////////
							//if ( $field_value ) { $buffer_field_value = "'$field_value'"; } else { $buffer_field_value = "NULL"; }
							//$db[$field_name][content] = "`$field_name` = $buffer_field_value" . $comma . "";
							
							if ( $field_value ) {
								$db[$field_name][content] = addslashes($field_value);
							}
							
							//$db[$field_name][start] = "`$field_name` = ";
							//$db[$field_name][end] = $comma . "";
							
							
							
							$create[$field_name][content] .= "`$field_name` TEXT DEFAULT NULL,";
							//$buffer_create_db .= "`$field_name` text DEFAULT NULL,";
							
							
							// ALTER //////////////////
							$alter[$field_name] = "ADD `$field_name` TEXT DEFAULT NULL AFTER `" . $previous_field_name . "`;";


							// HTML ////////////////////
							$field_title_align = "TOP";
							
							// DEFINE FIELD TITLE
							$html[$field_name][title] = $field_text . " ";
							$html[$field_name][content] .= "<$field_type NAME='$field_name'" . $form['style'] . " ROWS=5>$field_value</$field_type> \n";
							
							
							// SET THE FIRST TEXTAREA FIELD AS THE DISPLAY TEXT
							if ( !$buffer['index']['text'] ) {
								//$list[$field_name][text] = $field_name;
								$buffer['index']['text'] = $field_name;
							}
							
							
						////////// DEFAULT INPUT
						//////////////////////////////
						} elseif ( $field_type == "NOTE" ) {
							
							//$html[$field_name][content] .= $field_value;
							//$html[$field_name][content] = $form_value[$field_name][NOTE];
							
						} else {

							// TEXT BOX MAX SIZE
							if ( $field_type == "TEXT" ) {
								
								
								// INDEX ////////////////////
								
								// LINK ////////////////////$field_text
								//if ( preg_match("/^http\:\/\//i",trim($field_value)) && !$buffer['index']['link'] ) {
								//echo "( $field_type_value AS $field_value => $field_text )<BR>";
								//echo "\$field_text --> $field_text<BR>";
								//echo "\$field_name --> $field_name<BR>";
								//echo "\$field_value --> $field_value<BR>";
								//$form_value[$field_name] 
								//echo "\$form_value[$field_name] --> " . $form_value[$field_name] . "<BR>";
								
								//echo "\$field_type_value --> $field_type_value<BR>";
								//if ( preg_match("/http/i",trim($field_value)) && !$buffer['index']['link'] ) {
								//if ( preg_match("/http/i",trim($field_value)) ) {
									//echo "HERE!<BR>";
									//$buffer['index']['link'] = trim($field_value);
									//$buffer['index']['link'] = $field_name;
								//}
								
								// SET THE FIRST TEXT FIELD AS THE DISPLAY INDEX LINK
								if ( !$buffer['index']['handle'] ) {
									//$list[$field_name][handle] = $field_name;
									$buffer['index']['handle'] = $field_name;
									//$list[$field_name][handle] = $field_value;
								}
								
								// DB ////////////////////
								//if ( $field_value ) { $buffer_field_value = "'$field_value'"; } else { $buffer_field_value = "NULL"; }
								//$db[$field_name][content] = "`$field_name` = $buffer_field_value" . $comma . "";
								
								if ( $field_value) {
									$db[$field_name][content] = addslashes($field_value);
								}
								
								//$db[$field_name][start] = "`$field_name` = ";
								//$db[$field_name][end] = $comma . "";
								
								$create[$field_name][content] .= "`$field_name` VARCHAR(255) DEFAULT NULL,";
								//$buffer_create_db .= "`$field_name` VARCHAR(255) DEFAULT NULL,";
								
								// ALTER //////////////////
								$alter[$field_name] = "ADD `$field_name` VARCHAR(255) DEFAULT NULL AFTER `" . $previous_field_name . "`;";


								// HTML ////////////////////
								$buffer_form_text_maxlength = " MAXLENGTH=" . $form['maxlength'] . "";
								
								
							}
							
							// DEFINE FIELD TITLE
							$html[$field_name][title] = $field_text . "";
							$html[$field_name][content] .= "<INPUT TYPE=$field_type NAME='$field_name'" . $form['style'] . "$buffer_form_text_maxlength VALUE='$field_value'> \n";
							//echo "\$field_value" . $field_value . "<BR>";
							
							
							
						}
						
					}
					
					//$comma = NULL;
					/*if ( $field_type == "RADIO" || $field_type == "SELECT" || $field_type == "CHECKBOX" ) {
						$buffer_create_db .= ") DEFAULT NULL,";
					}*/
					
					$previous_field_name = $field_name;

				} else {
					
					////////// SUBMIT
					//////////////////////////////
					if ( $field_type == "SUBMIT" ) {
						
						$db[$field_name][none] = TRUE;
						
						// DEFINE FIELD TITLE
						$html[$field_name][title] = NULL;
						$html[$field_name][content] .= "<INPUT TYPE=$field_type NAME='$field_name' VALUE='$field_type_value'>
							<INPUT TYPE=HIDDEN NAME=" . CRYPT_REF_ID . " VALUE='" . $_GET['CRYPT_REF_ID'] . "'>";
						
						$html[$field_name][content] .= "<INPUT TYPE=$field_type NAME=CANCEL VALUE=CANCEL>\n";
						
						
						if ( $_GET['CRYPT_REF_ID'] ) {
							
							if ( !$form_value['inactive'] ) {
								$insert_inactive = "deactivate";
							} else {
								$insert_inactive = "activate";
							}
							
							$html[$field_name][content] .= "&#160&#160&#160<INPUT TYPE=SUBMIT NAME=SUBMIT VALUE='" . strtoupper($insert_inactive) . "'>";
							
							$html[$field_name][content] .= "<BR><INPUT TYPE=$field_type NAME=DELETE VALUE=DELETE> 
								<INPUT TYPE=CHECKBOX NAME=DELETE_CONFIRM VALUE=" . $_GET['CRYPT_REF_ID'] . "> check to confirm";
						} else {
							
						}
						
					
					////////// DATE
					//////////////////////////////
					} elseif ( $field_type == "DATE" || $field_type == "TODAY" ) {
						
						
						if ( !is_array($form_value[$field_name]) ) {
							
							if ( $field_type == "TODAY" && !$form_value[$field_name][year] && !$form_value[$field_name][month] && !$form_value[$field_name][day] ) {
								
								// RESET CURRENT $form_value (PRINTS OUT 1'S ?)
								$form_value[$field_name] = NULL;
								$form_value[$field_name][year] = date('Y');
								$form_value[$field_name][month] = date('m');
								$form_value[$field_name][day] = date('d');
								
								
								
							} else {
								
								// FORMAT THE DATE
								$format_date = explode("-", $form_value[$field_name]);
								
								// RESET CURRENT $form_value (PRINTS OUT 1'S ?)
								$form_value[$field_name] = NULL;
								$form_value[$field_name][year] = $format_date['0'];
								$form_value[$field_name][month] = $format_date['1'];
								$form_value[$field_name][day] = $format_date['2'];
							}
							
						}
						
						// DEFINE FIELD TITLE
						$html[$field_name][title] = $field_type_value;
						
						// GET THE FORM DROP DOWN MENUS
						$html[$field_name][content] .= 
							date_return_drop( $field_name, 
							$form_value[$field_name][year], 
							$form_value[$field_name][month],
							$form_value[$field_name][day], NULL);
						
						if ( $form_value[$field_name][year] || $form_value[$field_name][month] || $form_value[$field_name][day] ) {
							
							// SET VALUES TO 0 IF NOT SUBMITTED
							if ( !$form_value[$field_name][year] ) { $form_value[$field_name][year] = "0000"; }
							if ( !$form_value[$field_name][month] ) { $form_value[$field_name][month] = "00"; }
							if ( !$form_value[$field_name][day] ) { $form_value[$field_name][day] = "00"; }
							
							// COMPILE DATE VALUES SUBMITTED
							$db[$field_name][content] = "" . 
								$form_value[$field_name][year] . "-" . 
								$form_value[$field_name][month] . "-" . 
								$form_value[$field_name][day] . "";
						} else { // IF NO DATES SUBMITTED SET TO NULL
							$db[$field_name][content] = NULL;
						}
						
						// ALTER //////////////////
						$alter[$field_name] = "ADD `$field_name` DATE AFTER `" . $previous_field_name . "`;";

						$create[$field_name][content] .= "`$field_name` DATE,";
						
						
						$previous_field_name = $field_name;
						
					////////// COLLATE ORDER
					//////////////////////////////
					} elseif ( $field_type == "COLLATE" ) {
						
						//$html[$field_name][title] = $field_name;
						$html[$field_name][title] = $field_type_value;
						
						//echo "\$form_nums --> $form_nums<BR>";
						
						if ( !$_GET['inactive'] ) {
							$query = mysqli_query($db, "SELECT id FROM " . basename($_SERVER['PHP_SELF'],".php") . " 
								WHERE `inactive` IS NULL");
							
							$form_rows = @mysqli_num_rows($query); // GET NUM ROWS FOR COLLATE
							if ( !$_GET['CRYPT_REF_ID'] ) { ++$form_rows; } // IF INSERTING NEW VARIABLE ADD LAST COLLATE VALUE
							
							//echo "\$form_rows --> $form_rows<BR>";
							$html[$field_name][start] .= "<SELECT NAME=$field_name>";
							for($n = 1; $n <= $form_rows; $n++) {
								// CHECK SELECTED ORDER NUMBER
								
								//$form_value['collate'] == 
								if ( $form_value[$field_name] == $n || !$_GET['CRYPT_REF_ID'] ) {
								//echo "( $form_value[$field_name] == $n )<BR>";
								//if ( $form_value[$field_name] == $n ) {
								//if ( $form_value[$field_name] == $n || ( !$form_value[$field_name] && $n == ($form_rows - 1) ) ) {
								
									$selected = " SELECTED"; } else {
									$selected = NULL; }
									
								$html[$field_name][content] .= "<OPTION VALUE='$n'$selected>$n</OPTION>"; //$row_nums
							}
							$html[$field_name][end] .= "</SELECT> &#160 (select display order)";
						} else {
							$html[$field_name][content] = "(activate to collate)";
						}
						
						if ( $form_value[$field_name] ) {
							$db[$field_name][collate] = $form_value[$field_name];
						}
						//$db[$field_name][content] = "$buffer_field_value";
						
						//echo "\$form_value[$field_name] --> " . $form_value[$field_name] . "<BR>";
						
						
						// DO NOT INCLUDE DATABAES CREATION BECAUSE THIS IS A DEFAULT VALUE
						//$create[$field_name][content] .= "`$field_name` int(12) DEFAULT NULL,";
						
						// THIS IS THE CODE FROM WISHCENTRAL - CAN ERASE WHEN DONE
						/*if ( ($row_nums >= 1 && ($row['inactive'] || $_POST['ADD_FORM'] )) || ($row_nums > 1 && !$row['inactive']) ) {
							$row_nums = $row_nums + $add;
							$html[$field_name][content] .= "<SELECT NAME=$value>";
							for($n = 1; $n < $row_nums; $n++) {
								if ( $row[$value] == $n || ( !$row[$value] && $n == ($row_nums - 1) ) ) {
									$selected = " SELECTED"; } else {
									$selected = NULL; }
								
								$html[$field_name][content] .= "<OPTION VALUE='$n'$selected>$n</OPTION>"; //$row_nums
							}
							$html[$field_name][content] .= "</SELECT> &#160 (select display order)";
						}*/
					////////// COLLATE ORDER
					//////////////////////////////
					} elseif ( $field_type == "NOTE" ) {
						
						
						//$html[$field_name][content] = $form_value[$field_name][NOTE];
						
					}
				}
				
				
				
			}
			
			
											//////////////////////////////////////////////////////////
			// BUFFER - CREATE (DB) 		//////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			$buffer['db']['create'] .= $create[$field_name][start] . $create[$field_name][content] . $create[$field_name][end] . "\n";
			
											//////////////////////////////////////////////////////////
			// BUFFER - INSERT (DB) 		//////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			if ( !$db[$field_name][none] && !$db[$field_name][collate] ) { // IF NOT COLLATE OR NONE (SUBMIT) DEFINED
				$buffer['db']['insert'] .= "`$field_name` = ";
				if ( $db[$field_name][content] ) { // IF THERE IS NO VALUE FOR DATABASE --> SET TO NULL
					$buffer['db']['insert'] .= "'" . $db[$field_name][content] . "'"; // ADD SINGLE QUOTATIONS
				} else {
					$buffer['db']['insert'] .= "NULL"; // USE NULL
				}
				$buffer['db']['insert'] .= ",\n"; // ADD COMMA FOR NEXT DB FIELD
				
				//$db[$field_name][start] = "`$field_name` = ";
				//$db[$field_name][end] = $comma . "";
				
				//if ( $db[$field_name][content] ) { $db[$field_name][content] = "'" . $db[$field_name][content] . "'"; } else { $db[$field_name][content] = "NULL"; }
				//$buffer['db']['insert'] .= $db[$field_name][start] . $db[$field_name][content] . $db[$field_name][end] . "\n";
				//$buffer['db']['insert'] .= $db[$field_name] . "\n";
			} elseif ( $db[$field_name][collate] ) {
				$buffer['db']['collate'] .= $db[$field_name][collate]; // SET BUFFER COLLATE VALUE TO SORT BELOW
			}
			
			
											//////////////////////////////////////////////////////////
			// BUFFER - LIST (DB) 			//////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			//echo $buffer['index']['handle'] = $list[$field_name][handle];
			//echo $buffer['index']['text'] = $list[$field_name][text];
			//echo "<TR>
			//	<TD>" . $list[$field_name][handle] . "<BR>
			//		" . $list[$field_name][text] . "</TD>
			//</TR>";
			//$list[$field_name][text]
			//$list[$field_name][handle]
			
			
			
											//////////////////////////////////////////////////////////
			// BUFFER - FORM (HTML)			//////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////
			$buffer['form'] .= "<TR>
					<TD ALIGN=RIGHT VALIGN=$field_title_align CLASS='TextGrayDark' STYLE='padding-right:10px;' NOWRAP>\n
						" . $html[$field_name][title] . " </TD>\n
					<TD ALIGN=LEFT VALIGN=CENTER NOWRAP CLASS='TextGrayDark'>" . $html[$field_name][start] .
															$html[$field_name][content] .
															$html[$field_name][end] . "</TD>
				</TR>\n\n";
			
			
			////////// CLEAN VARS
			//$buffer_form = NULL;
			//$buffer_form_select_start = NULL;
			//$buffer_form_select_end = NULL;

		} else {

			////////// HEADER BAR
			//////////////////////////////
			if ( $field_name_value == "1" ) {
				$buffer['form'] .= "<TR>
					<TD HEIGHT=1 BGCOLOR=" . COLOR_GUIDE . " STYLE='padding:0px;' COLSPAN=2></TD>
				</TR><TR>
					<TD HEIGHT=3 BGCOLOR=" . COLOR_BACKGROUND . " STYLE='padding:0px;' COLSPAN=2></TD>
				</TR>";


			////////// SPACER
			//////////////////////////////
			} elseif ( is_int($field_name_value) ) {
				$buffer['form'] .= "<TR>
					<TD HEIGHT=" . $field_name_value . " BGCOLOR=" . COLOR_BACKGROUND . " STYLE='padding:0px;' COLSPAN=2></TD>
				</TR>";


			////////// ADDRESS
			//////////////////////////////
			}/* elseif ( $field_name_value == "ADDRESS" ) {
				
				include("_includes/inc_form_address.php");

			////////// TEXT ROW
			//////////////////////////////
			}*/ else {
				$buffer['form'] .= "<TR>
					<TD ALIGN=LEFT VALIGN=CENTER HEIGHT=1 BGCOLOR=" . COLOR_GRAY_LIGHT . " STYLE='padding-left:20px;' COLSPAN=2>
						<B>$field_name_value</B></TD>\n
				</TR>";

			}
		}
	}
}


$buffer['form'] .= "</FORM>
</TABLE>";





////////// DATABASE / HTML PROCESSOR
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
if ( $_POST['SUBMIT'] ) {
	
	// CHECK IF TABLE HAS CHANGED
	////////////////////////////////////////////////////////////////////////////////
	//$previous_field_name = $field_name;//////////////////////////////////////////////////////////// GANDHI
	//$alter_table = "ALTER TABLE " . basename($_SERVER['PHP_SELF'],".php") . " " . $alter; ////////////////////////////// GANDHI
	//if ( $field_type == "TEXT" || $field_type == "TEXTAREA" || $field_type == "RADIO" || $field_type == "SELECT" || $field_type == "CHECKBOX" ) {						
		//$enter = 0;		
		//$table_name = basename($_SERVER['PHP_SELF'],".php");						
		
		
		
		
		
		$columns_query = mysqli_query($db, "SHOW COLUMNS FROM `" . basename($_SERVER['PHP_SELF'],".php") . "`");																																									
		while ( $columns = mysqli_fetch_array($columns_query) ) {
					
			$new_array[$columns['0']] = $columns['0'];
			
			if ( array_key_exists($columns['0'], $alter) ) {
				$alter[$columns['0']] = NULL;
				
				//echo "$columns['0'] - $columns['1'] - $columns['2'] - $columns['3'] - $columns['4'] <BR>";
			}// elseif ( $columns['0'] != "id" && $columns['0'] != "collate" && $columns['0'] != "inactive" && $columns['0'] != "stamp" ) {
				//echo "<B>ALTER TABLE WITH $columns['0']</B><BR>";
				//echo "$columns['0'] - $columns['1'] - $columns['2'] - $columns['3'] - $columns['4'] <BR>";
			//}
			/*
			if ( $find_field['Field'] == $field_name ) {									
				++$enter;																		
			}*/
		}
		
		//echo "<BR><BR>";
		
		foreach( $alter AS $key => $value) {
			//if ( !array_key_exists($value, $new_array) ) {
			//if ( array_search($key, $new_array) ) {
			///	echo "DO NOTHING $value<BR>";
			///} else {
			if ( $value ) {
				if ( !mysqli_query($db, "ALTER TABLE `" . basename($_SERVER['PHP_SELF'],".php") . "` " . $value) ) {
					echo "COULD NOT ADD COLUMN TO DATABASE<BR>" . "ALTER TABLE `" . basename($_SERVER['PHP_SELF'],".php") . "` " . $value;
					exit();
					///html_error();
				}
				//echo "ALTER TABLE `" . basename($_SERVER['PHP_SELF'],".php") . "` $value<BR>";
			}
			///}
		}
		
		
		/*if ( $enter == 0 ){
			mysqli_query($db, $alter_table);
		}*/
	//}
	
	
	echo "<BR><BR>";
	
	
	
	
	
	// UPDATE OR INSERT ?
	if ( $_GET['CRYPT_REF_ID']) { // IF $_GET THEN UPDATE
		$action = "UPDATE";
		$where = "WHERE id = '" . $_GET['CRYPT_REF_ID'] . "'";
		$limit = " LIMIT 1";
	} else { // INSERT NEW
		$action = "INSERT INTO";
		$id = "`id` = NULL,";
		//$buffer['db']['insert'] .= "collate = '" . $buffer['db']['collate'] . "',\n"; // 
	}
	
	//if ( $form_values['deactivate'] ) {
	if ( $_POST['SUBMIT'] == "ACTIVATE" ) {
		$buffer['db']['insert'] .= "`inactive` = NULL,\n";
		
		$buffer['db']['collate'] = 1; // SET THE COLLATE VALUE TO 1
		// IF YOU WANT TO SET COLLATE VALUE TO LAST THEN USE SCRIPT BELOW FOR COLLATE
		//$query = mysqli_query($db, "SELECT id FROM " . basename($_SERVER['PHP_SELF'],".php") . " WHERE inactive IS NULL");
		//$form_rows = mysqli_num_rows($query); // GET NUM ROWS FOR COLLATE
		
	} elseif ( $_POST['SUBMIT'] == "DEACTIVATE" ) {
		$buffer['db']['insert'] .= "`inactive` = '1',\n";
		$buffer['db']['insert'] .= "`collate` = NULL,\n";
		$buffer['db']['collate'] = NULL;
	}
	
	// SETUP THE DB QUERY
	$db_query = $action . " `" . basename($_SERVER['PHP_SELF'],".php") . "` SET " . 
			$id . 
			$buffer['db']['insert'] .
			"`stamp` = NOW() " .
			$where . $limit . ";";
	
	
	
	// INSERT THE QUERY INTO THE DB
	if ( !mysqli_query($db, $db_query) ) { // IF ERROR INSERTING -->
		echo "ERROR: " . mysqli_error($db) . "<P>" . $db_query;
	} else { // IF DB INSERT OK -->
		
		
		// PROCESS COLLATE ORDER
		////////////////////////////////////////////////////////////////////////////////
												////////////////////////////////////////
		//if ( $buffer['db']['collate'] ) {
			
			//$query_collate = mysqli_query($db, "SELECT id,collate,inactive FROM " . basename($_SERVER['PHP_SELF'],".php") . ""); 
			$query_collate = mysqli_query($db, "SELECT * FROM `" . basename($_SERVER['PHP_SELF'],".php") . "` " .
				"WHERE `inactive` IS NULL " .
				"ORDER BY `collate`,`inactive`");
				//ORDER BY inactive ASC,`collate`,stamp DESC");
			//$collate_order = 1;
			
			//$collate_order = NULL;
			
			//dev_print($buffer);
			
			while ( $flush = mysqli_fetch_assoc($query_collate) ) {  ////////// COLLATE
				
				//if ( $_GET['CRYPT_REF_ID'] == $flush['id'] ) { // IF $_GET ID = CURRENT ID -->
				
			//$query_id = mysqli_query($db, "SELECT * FROM wc_users WHERE user_id = LAST_INSERT_ID()");
			//if ( $last_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT LAST_INSERT_ID()")) ) {
				//echo "LAST_ID --> " . mysqli_insert_id($db);
				
				if ( $_GET['CRYPT_REF_ID'] ) {
					$for = $_GET['CRYPT_REF_ID'];
				} else {
					$for = mysqli_insert_id($db);
				}
				
				
				if ( $for == $flush['id'] ) { // IF $_GET ID = CURRENT ID -->
					
					// UPDATE $_GET ID SET TO $_POST COLLATE
					$flush_query = "UPDATE `" . basename($_SERVER['PHP_SELF'],".php") . "` SET 
						`collate` = '" . $buffer['db']['collate'] . "' 
						WHERE id = '" . $for . "' LIMIT 1"; //  - collate: " . $buffer['db']['collate'] . " - id: " . $_GET['CRYPT_REF_ID']
					mysqli_query($db, $flush_query);
					
				} else {
					
					++$collate_order;
					
					// CHECK IF YOU ARE ON THE CURRENT COLLATE VALUE IN THE LOOP
					if ( $buffer['db']['collate'] == $collate_order ) { // IF $_POST COLLATE = CURRENT COLLATE VALUE -->
						// INCREASE THE COLLATE VALUE
						++$collate_order; // GO TO NEXT COLLATE VALUE
					}
					
					$flush_query = "UPDATE `" . basename($_SERVER['PHP_SELF'],".php") . "` SET 
						`collate` = '" . $collate_order . "' 
						WHERE id = '" . $flush['id'] . "' LIMIT 1"; //  - collate: " . $buffer['db']['collate'] . " - id: " . $_GET['CRYPT_REF_ID']
					mysqli_query($db, $flush_query);
										
				}
			}
		//}
												////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		
		
		
		
		
		
		echo "<CENTER><BR><BR> ITEM " . $_POST['DELETE_CONFIRM'] . " UPDATED<BR></CENTER>";
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=" . $_SERVER['PHP_SELF'] . "'>";
		exit();
		//header("location:" . $_SERVER['PHP_SELF'] . "");
		//echo "the information has been updated/inserted<BR>";
		echo $db_query;
	}
	
	//echo $buffer['form'];
	//echo "<BR><BR>" . nl2br($db_insert_row) . "<BR><BR>";
	
} elseif ( $_POST['DELETE'] && $_POST['DELETE_CONFIRM'] ) {
	
	
	
	// DELETE ROW
	if ( !mysqli_query($db, "DELETE FROM `" . basename($_SERVER['PHP_SELF'],".php") . "` WHERE id = '" . $_POST['DELETE_CONFIRM'] . "' LIMIT 1") ) {
		echo "ERROR: " . mysqli_error($db) . "<P>" . $db_query;
	} else {
		
		echo "<CENTER><BR><BR> ITEM " . $_POST['DELETE_CONFIRM'] . " DELETED<BR></CENTER>";
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=" . $_SERVER['PHP_SELF'] . "'>";
		exit();
		//header("location:" . $_SERVER['PHP_SELF'] . "");
		echo $db_query;
	}
	
	
} elseif ( (!$_POST || !$_POST['CANCEL']) && !$_POST['CANCEL'] && ($_GET['CRYPT_REF_ID'] || $_GET['INSERT'] || $_POST['ADD']) ) {
//} elseif ( !$_POST['SUBMIT'] && ( $_GET['CRYPT_REF_ID'] || $_GET['INSERT'] || $_POST['ADD'] ) ) {
//if ( $_GET['CRYPT_REF_ID'] || $_GET['INSERT'] || $_POST['ADD'] || ( $_POST && !$_POST['SUBMIT']) ) {
	
	// DISPLAY FORM
	echo $buffer['form'];
	
} else {
	
	////////// CREATE TABLE
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	// CHECK IF TABLE EXISTS
	$query = mysqli_query($db, "SHOW TABLES LIKE '" . basename($_SERVER['PHP_SELF'],".php") . "'");
	if ( !mysqli_num_rows($query) ) { // IF TABLE DOES NOT EXIST --> CREATE TABLE
		
		// CREATE TABLE SQL
		$db_query = "CREATE TABLE `" . basename($_SERVER['PHP_SELF'],".php") . "` (
				`id` int(12) NOT NULL auto_increment,
				`collate` int(12) DEFAULT NULL,
				" . $buffer['db']['create'] . "
				`inactive` enum('1') DEFAULT NULL,
				`stamp` timestamp(14) NOT NULL,
				PRIMARY KEY  (`id`)
				) TYPE=MyISAM;";
		
		if ( !mysqli_query($db, $db_query) ) { // IF COULD NOT CREATE TABLE --> ERROR
			// CREATE TABLE ERROR
			echo "ERROR: " . mysqli_error($db) . "<P>" . $db_query;
		} else {
			// CREATE TABLE COMPLETED NOTE
			echo "<BR><BR> TABLE " . basename($_SERVER['PHP_SELF'],".php") . " HAS BEEN CREATED<BR>";
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=" . $_SERVER['PHP_SELF'] . "'>";
			exit();
			//echo "the database was created<BR>";
			echo $db_query;
		}
		
		
		
	////////// DISPLAY TABLE
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	} else {
		
		
		$divider = "<TR>
				<TD HEIGHT=2 BGCOLOR=" . COLOR_BACKGROUND . " COLSPAN=2></TD>
			</TR><TR>
				<TD HEIGHT=1 BGCOLOR=" . COLOR_GUIDE . " COLSPAN=2></TD>
			</TR><TR>
				<TD HEIGHT=2 BGCOLOR=" . COLOR_BACKGROUND . " COLSPAN=2></TD>
			</TR>";
		
		
		echo "<TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=1 BGCOLOR=" . COLOR_BACKGROUND . ">";
		
		echo "<TR>
				<TD></TD>
				<TD HEIGHT=30 BGCOLOR=" . COLOR_BACKGROUND . "><B>". DB_TITLE . "</B></TD>
			</TR>" . $divider . "";
		
		
		$query = mysqli_query($db, "SELECT * FROM `" . basename($_SERVER['PHP_SELF'],".php") . "` ORDER BY `inactive`,`collate`");
		if ( @mysqli_num_rows($query) ) {
			
			
			//echo $link = $buffer['index']['handle'];
			//echo $text = $buffer['index']['text'];
			
			
			// GET THE RESULTS OF THE TABLE
			while ( $results = mysqli_fetch_assoc($query) ) {
				
				if ( $results['inactive'] ) {
					$strike['on'] = "<STRIKE>";
					$strike['off'] = "</STRIKE>";
					$insert_index = "-&#160"; // USE A DASH IF INACTIVE
					$insert_inactive = "&inactive=1"; // IDENTIFY THAT THE ITEM IS INACTIVE TO PREVENT INSERTING COLLATE MENU
					
					$divider = NULL;
					$results[$buffer['index']['text']] = NULL;
					
				} else {
					$insert_index = ++$list_index . ".";
					$strike['on'] = NULL;
					$strike['off'] = NULL;
				}
				
				echo "<TR>
					<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGray' BGCOLOR=" . COLOR_BACKGROUND . " STYLE='padding-right:5px;'>" . $insert_index . "</TD>
					<TD CLASS='TextGray' BGCOLOR=" . COLOR_BACKGROUND . " STYLE='padding-right:5px;padding-left:5px;'>
						" . $strike['on'] . "<A HREF='" . $_SERVER['PHP_SELF'] . "?" . CRYPT_REF_ID . "=" . $results['id'] . $insert_inactive . "'>";
						if ( !$results[$buffer['index']['handle']] ) {
							echo "DATABASE ID: " . $results['id'];
						} else {
							echo "<B>" . $results[$buffer['index']['handle']] . "</B>"; //  ($results['collate'])
						}
						
						echo "</A>" . $strike['off'];
						
						//
						foreach ( $results AS $key => $link ) {
							//if ( preg_match("/^http:///i",$link) && !$link_inserted ) {
							if ( preg_match("/^http:///i",$link) ) {
							//if ( $results['link'] ) {
							
								echo " - <A TARGET=LINK HREF='" . $link . "'>
									<FONT CLASS='TextRed'>" . html_link_domain($link) . "</FONT></A>";
								//dev_print(html_link_domain($results['link']));
								break;
							}
						}
						
						
							//$buffer['index']['link']
						echo "<BR>
							" . html_links($results[$buffer['index']['text']], "LINK", 500) . "</TD>
				</TR>" . $divider . "";
				
			}
			
		} else {
			echo "<TR>
				<TD HEIGHT=10 BGCOLOR=" . COLOR_BACKGROUND . " COLSPAN=2></TD>
			</TR><TR>
				<TD></TD>
				<TD CLASS='TextGray' BGCOLOR=" . COLOR_BACKGROUND . ">
					THE TABLE <B>" . basename($_SERVER['PHP_SELF'],".php") . "</B> IS EMPTY</TD>
			</TR><TR>
				<TD HEIGHT=10 BGCOLOR=" . COLOR_BACKGROUND . " COLSPAN=2></TD>
			</TR>" . $divider . "";
		}
		
		echo "<TR>
				<TD HEIGHT=8 BGCOLOR=" . COLOR_BACKGROUND . " COLSPAN=2></TD>
			</TR><TR>
			<TD WIDTH=20></TD>
			<TD CLASS='TextGray' BGCOLOR=" . COLOR_BACKGROUND . ">
				<FORM ACTION=" . $_SERVER['PHP_SELF'] . " METHOD=POST>
				<INPUT TYPE=SUBMIT NAME=ADD VALUE='ADD " . DB_TITLE . "'>
				</FORM></TD>
		</TR>";
		
		echo "</TABLE>";
	}
}


?>
