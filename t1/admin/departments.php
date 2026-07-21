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
if ( $_POST[BACK] ) {
	header("location:./");
} elseif ( $_POST[ADD] || $_POST[CHANGE] ) {
	
	////////// CHECK IF DEPARTMENT WAS SUBMITTED?
	if ( !$_POST[department] ) {
		$error[department] = "Please enter a department name and submit the form again";
	}
	
	////////// CHECK EXISTING DEPARTMENTS FOR DUPLICATES
	$sql = "SELECT * FROM template_departments 
		WHERE department LIKE '". $_POST[department] ."' ". 
			($_GET[CRYPT_REF_ID] && $_POST[CHANGE] ? " AND department_id != ". $_GET[CRYPT_REF_ID] : NULL) ." 
			AND domain_id = '". DOMAIN_ID ."'";
	
	if ( !$query = mysqli_query($db, $sql) ) {
		error("there was an error checking for duplicate departments",$sql);
	} else {
		if ( mysqli_fetch_assoc($query) ) {
			$error[department] = "The department you submitted already exists. Please submit a unique department";
		}
	}
	
	
	////////// PROCESS FORM
	if ( !$error ) {
		//$db[values] = "department = '". ucwords(strtolower(query_prep($_POST[department]))) ."', 
		//	notes = '". query_prep($_POST[notes]) ."', 
		//	". ( $_POST[inactive] ? " inactive = 1" : " inactive = NULL" ) ."";
		
		if ( $_POST[ADD] ) {
			$db[action] = "INSERT INTO";
			//"domain_id = '". DOMAIN_ID ."'"
		} elseif ( $_POST[CHANGE] ) {
			$db[action] = "UPDATE";
			$db[where] = "WHERE department_id = ". $_GET[CRYPT_REF_ID] ." AND domain_id = '". DOMAIN_ID ."' LIMIT 1";
		}
		
		
		$sql = $db[action] ." template_departments SET ".
			($_POST[ADD] ? "domain_id = '". DOMAIN_ID ."', " : null) .
			"department = '". ucwords(strtolower(query_prep($_POST[department]))) ."', 
			notes = '". query_prep($_POST[notes]) ."', 
			". ( $_POST[inactive] ? " inactive = 1" : " inactive = NULL" ) ." ".
			$db[where];
		
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error modifying the template_departments table",$sql,1);
		} else {
			if ( $last_insert_id = mysqli_insert_id($db) ) {
				header("location:". $_SERVER[PHP_SELF] ."?". CRYPT_REF_ID ."=". $last_insert_id);
			}
		}
	}
	
} elseif ( $_POST[DELETE] ) {
	
	if ( $_POST[DELETE] && !$_POST[confirm_delete] ) 
		$error[DELETE] = "By deleting this department you will also delete all the associations this department may have to your projects (although the actual projects associated with this department <u>will NOT be deleted</u>).";
		//$error[DELETE] = "Please be aware that by deleting this department you will also delete all the project associations to this department (although the actual projects associated with this department <u>will NOT be deleted</u>)";
	
	if ( !$error ) {
		
		// check all other databases that reference departments
		$sql = "DELETE FROM template_project_departments 
			WHERE department_id = '". $_GET[CRYPT_REF_ID] ."'";
		if ( !mysqli_query($db, $sql) ) {
			$error[DELETE] = "there was an error trying to delete the department associations to projects. An administrator has been contacted and will resolve the issue as quickly as possible.";
			error($error[DELETE],$sql,1);
		}
		
		/*// template_services
		STOP! DO NOT NEED TO DO THIS --> SIMPLY HAVE A CATEGORY OF SERVICES THAT ARE UNASSIGNED
		$sql = "DELETE FROM template_services 
			WHERE department_id = '". $_GET[CRYPT_REF_ID] ."'";
		if ( !mysqli_query($db, $sql) ) {
			$error[DELETE] = "there was an error trying to delete the department professional services. An administrator has been contacted and will resolve the issue as quickly as possible.";
			error($error[DELETE],$sql,1);
		}*/
		
		
		
		$sql = "DELETE FROM template_departments 
			WHERE department_id = '". $_GET[CRYPT_REF_ID] ."' 
				AND domain_id IS NOT NULL LIMIT 1";
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error deleting the department",$sql,1);
		} else {
			header("location:". $_SERVER[PHP_SELF] ."");
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
//echo "<FORM ACTION=" . $_SERVER[PHP_SELF] . " METHOD=POST>";




//////// MAIN SECTION HEADING
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


echo "<TABLE BORDER=0 BORDERCOLOR=orange ALIGN=CENTER width=100% CELLPADDING=3 CELLSPACING=0 RULSE=NONE>";

echo "<FORM ACTION='". $_SERVER[PHP_SELF] ."' METHOD=GET>";


	$insert_form[] = array("-",NULL,"Departments Manager"); // TITLE
	
	
	$insert_form[] = array("-",NULL,5); // SPACER
	
	////////// QUESTION
	$insert_form[] = array("?", NULL, "Would you like to edit an existing department?");
	////////// NOTE
	//$insert_form[] = array("_", NULL, "Select an existing department below to edit it.");
	
	//////////////////////////////////////////////////
	$sql = "SELECT * FROM template_departments WHERE domain_id = '". DOMAIN_ID ."'";
			//	ORDER BY department";
	$query = mysqli_query($db, $sql);
	if ( mysqli_num_rows($query) > 0 ) {
		
		$input[department_id] = "<SELECT NAME='". CRYPT_REF_ID ."' ". html_onchange() .">";
		
		// INSERT SELECT
		$input[department_id] .= "<OPTION VALUE=''>SELECT ---></OPTION>";
		
		while ( $info = mysqli_fetch_assoc($query) ) {
			
			//dev_print($info);
			// SELECTED
			if ( $_GET[CRYPT_REF_ID] == $info[department_id] ) {
				$edit = $info;
				
				if ( $previous[department_id] ) $adjacent[previous] = $previous[department_id];
				$insert_next = TRUE;
				
			} elseif ( $insert_next && !$adjacent[next] ) {
				$adjacent[next] = $info[department_id];
			}
			
			
			$input[department_id] .= "<OPTION VALUE='". $info[department_id] ."' ". 
				($_GET[CRYPT_REF_ID] == $info[department_id] ? " SELECTED" : NULL) .">". ucwords($info[department]) ." [". $info[department_id] ."]</OPTION>";
			$previous = $info;
		}
		$input[department_id] .= "</SELECT>";
	}
	
	////////// EXISTING DEPARTMENTS
	$insert_form[] = array("department_id", "existing departments", 
		$input[department_id],
		NULL,NULL,NULL);
	
	
	if ( $_GET[CRYPT_REF_ID] ) {
		////////// ADJACENT - NEXT / PREVIOUS
		$insert_form[] = array("adjacent", NULL, 
			($adjacent[previous] ? 
				"<A HREF='". $_SERVER[PHP_SELF]."?". CRYPT_REF_ID ."=". $adjacent[previous] ."'><SMALL><< PREVIOUS</SMALL></A>" : NULL) .
			($adjacent[previous] && $adjacent[next] ? " | " : NULL) .
			($adjacent[next] ? 
				"<A HREF='". $_SERVER[PHP_SELF]."?". CRYPT_REF_ID ."=". $adjacent[next] ."'><SMALL>NEXT >></SMALL></A>" : NULL),
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
		<FORM ACTION='". $_SERVER[PHP_SELF] . ($_SERVER[QUERY_STRING] ? "?". $_SERVER[QUERY_STRING] : NULL) ."' METHOD=POST>";
	
	
	////////// SUBTITLE
	$insert_form[] = array("_", NULL, "DEPARTMENT INFORMATION");
	
	
	////////// DEPARTMENT
	$insert_form[] = array("department", "department", // $field_name // WITH TRANSLATION FUNCTION
		array("TEXT",$edit[department],NULL,NULL), // $input[type], $input[value], $input[style], $input[option]
		NULL,NULL,array(value=>1)); // $styles,$trailer,$options
	
	
	
	////////// DEPARTMENT NOTES
	$insert_form[] = array("notes", "notes",
		array("TEXTAREA",$edit[notes],NULL,NULL),
		NULL,NULL,array(value=>1));
	
	
	////////// INACTIVE CHECKBOX
	$insert_form[] = array("inactive", NULL, 
		"<INPUT TYPE=CHECKBOX NAME=inactive VALUE=1 ". ($edit[inactive] ? " CHECKED" : NULL) ."> check to make department inactive",
		NULL,NULL,NULL);
	
	
	//////////////////////////////////////////////////
	if ( $_GET[CRYPT_REF_ID] ) {
		$input[submit] = "<INPUT TYPE=SUBMIT NAME='CHANGE' VALUE='SUBMIT CHANGES'> 
			<INPUT TYPE=SUBMIT NAME='ADD' VALUE='ADD AS NEW'> ";
		
		$input[delete] = "<INPUT TYPE=SUBMIT NAME=DELETE VALUE='DELETE...'> 
			". ($error[DELETE] ? "<INPUT TYPE=CHECKBOX NAME=confirm_delete>check to confirm delete" : null);
		
	} else {
		$input[submit] = "<INPUT TYPE=SUBMIT NAME='ADD' VALUE='ADD DEPARTMENT'> ";
	}
	
	$input[submit] .= "<INPUT TYPE=SUBMIT NAME='BACK' VALUE='BACK'>";
	
	////////// SUBMIT
	$insert_form[] = array("SUBMIT", NULL,
		$input[submit],
		NULL,NULL,NULL);
	
	
	////////// DELETE
	$insert_form[] = array("DELETE", NULL,
		$input[delete],
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
