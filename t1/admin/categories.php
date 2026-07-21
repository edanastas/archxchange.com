<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if ( !defined('ACCESS') ) die(ERROR_MESSAGE);


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
//define("TITLE","PAGE TITLE"); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( ${_POST}['BACK'] ) {
	header("location:./");
} elseif ( ${_POST}['ADD'] || ${_POST}['CHANGE'] ) {
	
	////////// CHECK IF CATEGORY WAS SUBMITTED?
	if ( !$_POST['category'] ) {
		${error}['category'] = "Please enter a category name and submit the form again";
	}
	
	////////// CHECK EXISTING CATEGORIES FOR DUPLICATES
	$sql = "SELECT * FROM template_categories 
		WHERE category LIKE '". ${_POST}['category'] ."' ". 
			($_GET['CRYPT_REF_ID'] && ${_POST}['CHANGE'] ? " AND category_id != ". ${_GET}['CRYPT_REF_ID'] : NULL) ." 
			AND domain_id = '". DOMAIN_ID ."'";
	
	if ( !$query = mysqli_query($db, $sql) ) {
		error("there was an error checking for duplicate categories",$sql);
	} else {
		if ( mysqli_fetch_assoc($query) ) {
			${error}['category'] = "The category you submitted already exists. Please submit a unique category";
		}
	}
	
	
	////////// PROCESS FORM
	if ( !$error ) {
		//$db['values'] = "category = '". ucwords(strtolower(query_prep({$_POST['category']}))) ."', 
		//	notes = '". query_prep({$_POST['notes']}) ."', 
		//	". ( ${_POST}['inactive'] ? " inactive = 1" : " inactive = NULL" ) ."";
		
		if ( ${_POST}['ADD'] ) {
			${db}['action'] = "INSERT INTO";
		} elseif ( ${_POST}['CHANGE'] ) {
			${db}['action'] = "UPDATE";
			${db}['where'] = "WHERE category_id = ". ${_GET}['CRYPT_REF_ID'] ." AND domain_id = '". DOMAIN_ID ."' LIMIT 1";
		}
		
		
		$sql = ${db}['action'] ." template_categories SET ".
			($_POST['ADD'] ? "domain_id = '". DOMAIN_ID ."', " : null) .
			"category = '". ucwords(strtolower(query_prep({$_POST['category']}))) ."', 
			notes = '". query_prep({$_POST['notes']}) ."', 
			". ( ${_POST}['inactive'] ? " inactive = 1" : " inactive = NULL" ) ." ".
			${db}['where'];
		
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error modifying the template_categories table",$sql,1);
		} else {
			if ( $last_insert_id = mysqli_insert_id($db) ) {
				header("location:". ${_SERVER}['PHP_SELF'] ."?". CRYPT_REF_ID ."=". $last_insert_id);
			}
		}
	}
	
} elseif ( ${_POST}['DELETE'] ) {
	
	if ( !$_POST['confirm_delete'] ) {
		${error}['DELETE'] = "Please confirm that you would like to delete this category by checking the confirmation box below.";
	}
	
	if ( !$error ) {
		
		
		$sql = "DELETE FROM template_categories 
			WHERE category_id = '". ${_GET}['CRYPT_REF_ID'] ."' 
				AND domain_id IS NOT NULL LIMIT 1";
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error deleting the category",$sql,1);
		} else {
			header("location:". ${_SERVER}['PHP_SELF'] ."");
		}
		
	}
	
}


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_header_admin.php");


////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
//echo "<TABLE BORDER=0 BORDERCOLOR=PINK ALIGN=CENTER CELLPADDING=1 CELLSPACING=0 RULES=NONE>";
echo form_table_start();
//echo "<FORM ACTION=" . ${_SERVER}['PHP_SELF'] . " METHOD=POST>";




//////// MAIN SECTION HEADING
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


echo "<TABLE BORDER=0 BORDERCOLOR=orange ALIGN=CENTER width=100% CELLPADDING=3 CELLSPACING=0 RULSE=NONE>";

echo "<FORM ACTION='". ${_SERVER}['PHP_SELF'] ."' METHOD=GET>";


	$insert_form[] = array("-",NULL,"Categories Manager"); // TITLE
	
	
	$insert_form[] = array("-",NULL,5); // SPACER
	
	////////// QUESTION
	$insert_form[] = array("?", NULL, "Would you like to edit an existing category?");
	////////// NOTE
	//$insert_form[] = array("_", NULL, "Select an existing category below to edit it.");
	
	//////////////////////////////////////////////////
	$sql = "SELECT * FROM template_categories WHERE domain_id = '". DOMAIN_ID ."'";
			//	ORDER BY category";
	$query = mysqli_query($db, $sql);
	if ( mysqli_num_rows($query) > 0 ) {
		
		${input}['category_id'] = "<SELECT NAME='". CRYPT_REF_ID ."' ". html_onchange() .">";
		
		// INSERT SELECT
		${input}['category_id'] .= "<OPTION VALUE=''>SELECT ---></OPTION>";
		
		while ( $info = mysqli_fetch_assoc($query) ) {
			
			//dev_print($info);
			// SELECTED
			if ( ${_GET}['CRYPT_REF_ID'] == ${info}['category_id'] ) {
				$edit = $info;
				
				if ( ${previous}['category_id'] ) ${adjacent}['previous'] = ${previous}['category_id'];
				$insert_next = TRUE;
				
			} elseif ( $insert_next && !$adjacent['next'] ) {
				${adjacent}['next'] = ${info}['category_id'];
			}
			
			
			${input}['category_id'] .= "<OPTION VALUE='". ${info}['category_id'] ."' ". 
				($_GET['CRYPT_REF_ID'] == ${info}['category_id'] ? " SELECTED" : NULL) .">". ucwords({$info['category']}) ." [". ${info}['category_id'] ."]</OPTION>";
			$previous = $info;
		}
		${input}['category_id'] .= "</SELECT>";
	}
	
	////////// EXISTING CATEGORIES
	$insert_form[] = array("category_id", "existing categories", 
		${input}['category_id'],
		NULL,NULL,NULL);
	
	
	if ( ${_GET}['CRYPT_REF_ID'] ) {
		////////// ADJACENT - NEXT / PREVIOUS
		$insert_form[] = array("adjacent", NULL, 
			($adjacent['previous'] ? 
				"<A HREF='". ${_SERVER}['PHP_SELF']."?". CRYPT_REF_ID ."=". ${adjacent}['previous'] ."'><SMALL><< PREVIOUS</SMALL></A>" : NULL) .
			($adjacent['previous'] && ${adjacent}['next'] ? " | " : NULL) .
			($adjacent['next'] ? 
				"<A HREF='". ${_SERVER}['PHP_SELF']."?". CRYPT_REF_ID ."=". ${adjacent}['next'] ."'><SMALL>NEXT >></SMALL></A>" : NULL),
			array(NULL,NULL,"padding-left:40px;"),NULL,NULL);
	}
	
	
	////////// PROCESS FORM ARRAY
	//////////////////////////////////////////////////

	echo form_input($insert_form); $insert_form = NULL;
	
	//////////////////////////////////////////////////
	
	
	
	////////// FORM
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	
	echo "</FORM>
		<FORM ACTION='". ${_SERVER}['PHP_SELF'] . ({$_SERVER['QUERY_STRING']} ? "?". ${_SERVER}['QUERY_STRING'] : NULL) ."' METHOD=POST>";
	
	
	////////// SUBTITLE
	$insert_form[] = array("_", NULL, "CATEGORY INFORMATION");
	
	
	////////// CATEGORY
	$insert_form[] = array("category", "category", // $field_name // WITH TRANSLATION FUNCTION
		array("TEXT",$edit['category'],NULL,NULL), // ${input}['type'], ${input}['value'], ${input}['style'], ${input}['option']
		NULL,NULL,array(value=>1)); // $styles,$trailer,$options
	
	
	
	////////// CATEGORY NOTES
	$insert_form[] = array("notes", "notes",
		array("TEXTAREA",$edit['notes'],NULL,NULL),
		NULL,NULL,array(value=>1));
	
	
	////////// INACTIVE CHECKBOX
	$insert_form[] = array("inactive", NULL, 
		"<INPUT TYPE=CHECKBOX NAME=inactive VALUE=1 ". ({$edit['inactive']} ? " CHECKED" : NULL) ."> check to make category inactive",
		NULL,NULL,NULL);
	
	
	//////////////////////////////////////////////////
	if ( ${_GET}['CRYPT_REF_ID'] ) {
		${input}['submit'] = "<INPUT TYPE=SUBMIT NAME='CHANGE' VALUE='SUBMIT CHANGES'> 
			<INPUT TYPE=SUBMIT NAME='ADD' VALUE='ADD AS NEW'> ";
		
		${input}['delete'] = "<INPUT TYPE=SUBMIT NAME=DELETE VALUE='DELETE'> <INPUT TYPE=CHECKBOX NAME=confirm_delete>check to confirm delete";
		
	} else {
		${input}['submit'] = "<INPUT TYPE=SUBMIT NAME='ADD' VALUE='ADD CATEGORY'> ";
	}
	
	${input}['submit'] .= "<INPUT TYPE=SUBMIT NAME='BACK' VALUE='BACK'>";
	
	////////// SUBMIT
	$insert_form[] = array("SUBMIT", NULL,
		${input}['submit'],
		NULL,NULL,NULL);
	
	
	////////// DELETE
	$insert_form[] = array("DELETE", NULL,
		${input}['delete'],
		NULL,NULL,NULL);
	
	
////////// PROCESS FORM ARRAY
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

	echo form_input($insert_form);
	
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

echo "</FORM>";
echo "</TABLE>";

//dev_print($_POST);
//dev_print($_GET);

////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_footer.php");

?>
