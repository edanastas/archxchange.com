<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if ( !defined('ACCESS') ) die(ERROR_MESSAGE);


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
define("TITLE","ADMIN: Project Management"); // PAGE TITLE
$form_default[department_other] = "enter department";

////////// GET DEPARTMENTS
//////////////////////////////////////////////////
$sql = "SELECT * FROM template_departments 
	WHERE domain_id IS NULL 
		OR domain_id = '". DOMAIN_ID ."' 
		AND inactive IS NULL";

//$sql = query_domain("template_departments");
$query = mysqli_query($db, $sql);
while ( $departments = mysqli_fetch_assoc($query) ) {
	$form[departments][$departments[department_id]] = $departments;
}


if ( $_GET[CRYPT_REF_ID] ) {
	/*
	
	LEFT JOIN template_departments td ON td.department_id = tp.department_id 
	LEFT JOIN template_categories tc ON tc.category_id = tp.category_id 
	LEFT JOIN template_contacts tca ON tca.contact_id = tp.architect_id 
	*/
	
	$sql = "SELECT * FROM template_projects tp 
	LEFT JOIN template_categories tc ON tc.category_id = tp.category_id 
	LEFT JOIN template_contacts tca ON tca.contact_id = tp.architect_id 
	WHERE 1 
		AND tp.domain_id = '". DOMAIN_ID."' 
		AND tp.project_id = '". $_GET[CRYPT_REF_ID] ."' LIMIT 1";
	$query = mysqli_query($db, $sql);
	$edit = mysqli_fetch_assoc($query);
	

	////////// GET PROJECT DEPARTMENTS
	//////////////////////////////////////////////////
	$sql = "SELECT * FROM template_project_departments 
		WHERE project_id = '". $_GET[CRYPT_REF_ID] ."'";
	$query = mysqli_query($db, $sql);
	while ( $departments = mysqli_fetch_assoc($query) ) {
		$edit[departments][$departments[department_id]][project_id] = true;
	}
	
}

//dev_print($edit);

// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( $_POST[ADD_PROJECT] || ( $_POST[UPDATE_PROJECT] && $_GET[CRYPT_REF_ID] ) ) {
	
	////////// SETUP SQL STATEMENT
	if ( $_POST[ADD_PROJECT] ) {
		$action = "INSERT INTO template_projects SET 
			project_id = NULL,
			domain_id = '". DOMAIN_ID ."',";
		
	} elseif ( $_POST[UPDATE_PROJECT] && $_GET[CRYPT_REF_ID] ) {
		$action = "UPDATE template_projects SET ";
		$where = " WHERE project_id = '". $_GET[CRYPT_REF_ID] ."' LIMIT 1";
	}
	
	
	////////// CHECK FORM SUBMISSIONS
	//////////////////////////////////////////////////
	function local_eval_name($name) {
		$name = eregi_replace(",","",trim($name));
		$values = explode(" ",$name);
		foreach($values AS $key => $value) {
			if ( $value && !preg_match("/@/i",$value) ) {
				$return[contact] .= ($return[contact] ? " ". $value : $value );
			} elseif ( preg_match("/@/i",$value) ) {
				$return[email] = $value;
			}
		}
		//$return[firstname] = $values[0];
		//$return[lastname] = $values[1];
		//$return[email] = (email_validate($values[2]) ? $values[2] : null);
		//$return[email] = $values[2];
		
		return $return;
	}
	
	If ( !$_POST[title] ) $error[title] = "Please submit a Title for this project.";
	If ( !$_POST[site] ) $error[site] = "Please describe the site context for this project.";
	If ( !$_POST[design] ) $error[design] = "Please describe the design of this project.";
	//If ( !$_POST[construction] ) $error[construction] = "Please submit a description of the construction process.";
	
	
	////////// CHECK DATES
	//////////////////////////////////////////////////
	// check if completion date is before design date
	If ( $_POST[date_completion] && $_POST[date_design] && $_POST[date_completion] < $_POST[date_design]) {
		$error[date_completion] = "The project completion date is set before the start of design.";
	}
	
	// check if completion date is before construction date
	if ( $_POST[date_completion] && $_POST[date_construction] && $_POST[date_completion] < $_POST[date_construction]) {
		$error[date_completion] = "The project completion date is set before the start of construction.";
	}
	
	// check if construction date is before design date
	if ( $_POST[date_construction] && $_POST[date_design] && $_POST[date_design] > $_POST[date_construction]) {
		$error[date_completion] = "The start of construction date is set before the start of design.";
	}
	
	
	////////// CHECK CLIENT
	//////////////////////////////////////////////////
	If ( !$_POST[client_id] ) {
		$error[client_id] = "Please select or add a client for this project.";
	} else {
		if ( !$error && !is_numeric($_POST[client_id]) ) {
			
			//$values = explode(" ",$_POST[client_id]);
			$values = local_eval_name($_POST[client_id]);
			
			// insert client
			$sql = "INSERT INTO template_contacts SET 
				contact_id = NULL,
				type = 'client',
				domain_id = '". DOMAIN_ID ."',
				contact = '". query_prep($values[contact]) ."',
				email = '". query_prep($values[email]) ."'";
			if ( !mysqli_query($db, $sql) ) {
				$error[client_id] = "There was an error adding the client. An administrator has been contacted to resolve the issue as quickly as possible. If you need immediate assitance please contact us using our trouble ticket system or attempt the form again.";
				error($error[client_id],$sql,1);
			} else $last_client_id = mysqli_insert_id($db);
		}
	}
	
	////////// CHECK ARCHITECT
	//////////////////////////////////////////////////
	If ( !$_POST[architect_id] ) {
		$error[architect_id] = "Please select or add an architect for this project.";
	} else {
		if ( !$error && !is_numeric($_POST[architect_id]) ) {
			
			//$values = explode(" ",$_POST[architect_id]);
			$values = local_eval_name($_POST[architect_id]);
			
			// insert architect
			$sql = "INSERT INTO template_contacts SET 
				contact_id = NULL,
				type = 'architect',
				domain_id = '". DOMAIN_ID ."',
				contact = '". query_prep($values[contact]) ."',
				email = '". query_prep($values[email]) ."'";
			if ( !mysqli_query($db, $sql) ) {
				$error[architect_id] = "There was an error adding the architect. An administrator has been contacted to resolve the issue as quickly as possible. If you need immediate assitance please contact us using our trouble ticket system or attempt the form again.";
				error($error[architect_id],$sql,1);
			} else $last_architect_id = mysqli_insert_id($db);
		}
	}
	
	////////// CHECK CATEGORY
	//////////////////////////////////////////////////
	If ( !$_POST[category_id] ) {
		$error[category_id] = "Please select or add a category for this project.";
	} else {
		if ( !$error && !is_numeric($_POST[category_id]) ) {
			// insert categories
			$sql = "INSERT INTO template_categories SET 
				category_id = NULL,
				domain_id = '". DOMAIN_ID ."',
				category = '". query_prep($_POST[category_id]) ."'";
			if ( !mysqli_query($db, $sql) ) {
				$error[category_id] = "There was an error adding the new category. An administrator has been contacted to resolve the issue as quickly as possible. If you need immediate assitance please contact us using our trouble ticket system or attempt the form again.";
				error($error[category_id],$sql,1);
			} else $last_category_id = mysqli_insert_id($db);
		}
	}
	
	////////// CHECK DEPARTMENTS
	//////////////////////////////////////////////////
	// check if other was submitted (and checked) and it does not equal the default text "enter department" ($form_default[department_other])
	if ( $_POST[departments][other] && $_POST[department_other] && $_POST[department_other] != $form_default[department_other] ) {
		$sql = "INSERT INTO template_departments SET 
			department_id = NULL, 
			department = '". query_prep($_POST[department_other]) ."', 
			domain_id = '". DOMAIN_ID ."'";
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error trying to insert the new (other) department from the project page",$sql,1);
			$error[department_id] = "There was an error trying to insert the new department. Try to manually add the new department from the department manager and then return to this project and change the department to the new department.";
		} else {
			// add the new department to the selected project
			if ( $last_department_id = mysqli_insert_id($db) ) {
				//$sql = "INSERT INTO template_project_departments SET
				//	project_id = '". $_GET[CRYPT_REF_ID] ."', 
				//	department_id = '". $last_department_id ."'";
				//if ( !$results = mysqli_query($db, $sql) ) {
				//	error("there was an error inserting the project department associations into the database for the new (other) department",$sql,1,null,
				//		"manually add the new department and the project associations after resolving the problems");
				//	$error[department_id] = "There was an error trying to associate your new department with this project.";
				//}
				
				// manually generate existing db values that would have been set in the $edit variable above
				$form[departments][$last_department_id][department_id] = $last_department_id;
				$form[departments][$last_department_id][department] = $_POST[department_other];
				$edit[departments][$last_department_id][project_id] = $_GET[CRYPT_REF_ID];
				
			}
		}
	}
	
	////////// STILL CHECKING DEPARTMENTS --> ALTER DEPARTMENT : PROJECT ASSOCIATIONS
	if ( is_array($form[departments]) ) {
		
		// loop through all project department 
		foreach($form[departments] AS $value) {
			$sql = null;
			
			////////// ADD NEW DEPARTMENT ASSOCIATIONS TO PROJECT
			if ( $_POST[departments][$value[department_id]] || $last_department_id == $value[department_id] ) { // check if submitted -->
				// yes posted --> is it in the db already?
				if ( !$edit[departments][$value[department_id]][project_id] || $last_department_id == $value[department_id] ) {
					// add to database
					$sql = "INSERT INTO template_project_departments SET 
						project_id = '". $_GET[CRYPT_REF_ID] ."', 
						department_id = '". $value[department_id] ."'";
				}
				
			////////// REMOVE DEPARTMENT ASSOCIATIONS FROM PROJECT
			} else {
				// not submitted (posted) --> is it in the db?
				if ( $value[project_id] ) {
					// remove from db
					$sql = "DELETE FROM template_project_departments 
						WHERE project_id = '". $_GET[CRYPT_REF_ID] ."' 
							AND department_id = '". $value[department_id] ."' LIMIT 1";
				}
			}
			
			// process database entries or removals
			if ( $sql ) {
				if ( !mysqli_query($db, $sql) ) {
					error("there was an error inserting the project department associations into the database",$sql,1,null,
						"manually add the project associations after resolving the problems");
					$error[department_id] = "There was an error attempting to modify the departments associated with this project.";
				}
			}
		}
		
	}
	
	
	/*If ( !$_POST[department_id] ) {
		$error[department_id] = "Please select or add a department for this project.";
	} else {
		if ( !$error && !is_numeric($_POST[department_id]) ) {
			// insert departments
			$sql = "INSERT INTO template_departments SET 
				department_id = NULL,
				domain_id = '". DOMAIN_ID ."',
				department = '". query_prep($_POST[department_id]) ."'";
			if ( !mysqli_query($db, $sql) ) {
				$error[department_id] = "There was an error adding the new department. An administrator has been contacted to resolve the issue as quickly as possible. If you need immediate assitance please contact us using our trouble ticket system or attempt the form again.";
				error($error[department_id],$sql,1);
			} else $last_department_id = mysqli_insert_id($db);
		}
	}*/
	
	
	////////// NO ERRORS
	//////////////////////////////////////////////////
	if ( !$error ) { // && $disabled 
		
		// insert project
		$sql = $action ."
			category_id = '". ( $last_category_id ? $last_category_id : $_POST[category_id] ) ."',
			client_id = '". ( $last_client_id ? $last_client_id : $_POST[client_id] ) ."',
			architect_id = '". ( $last_architect_id ? $last_architect_id : $_POST[architect_id] ) ."',
			
			title = '". query_prep($_POST[title]) ."',
			site = '". query_prep($_POST[site]) ."',
			design = '". query_prep($_POST[design]) ."',
			construction = '". query_prep($_POST[construction]) ."',
			date_design = ". ($_POST[date_design] ? "'". $_POST[date_design] ."'" : "NULL") .",
			date_construction = ". ($_POST[date_construction] ? "'". $_POST[date_construction] ."'" : "NULL") .",
			date_completion = ". ($_POST[date_completion] ? "'". $_POST[date_completion] ."'" : "NULL") ." ". $where;
		
		
		
		if ( !mysqli_query($db, $sql) ) {
			$error[SUBMIT] = "There was an error adding the new project. An administrator has been contacted to resolve the issue as quickly as possible. If you need immediate assitance please contact us using our trouble ticket system or attempt the form again.";
			error($error[ADD_PROJECT],$sql,1);
		} else {
			//echo "SUCCESSFULLY UPDATED!";
			// header("location:projects.php");
		}
		
	} else {
		//dev_print($_POST);
	}
}

// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_header_admin.php");

echo "<h2></h2><div id='nifty'>Unresolved code. Adding departments to new project when using \"Add As New Project\" option will add to current project_id. Possible solution is to remove \"Add As New Project\" option completely. Only add new projects from blank project page, although even that would cause similar problems. change project confirm when changing.</div>";

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
echo "<TABLE BORDER=0 BORDERCOLOR=PINK ALIGN=CENTER WIDTH=100%S CELLPADDING=1 CELLSPACING=0 RULES=NONE>";
//echo form_table_start();



echo "<FORM ACTION='". $_SERVER[PHP_SELF] ."' METHOD=GET>";

	////////// TITLE
	$insert_form[] = array("-",NULL,"PROJECT INFORMATION FORM");
	
	
	//////////////////////////////////////////////////
	$sql = "SELECT * FROM template_projects 
		WHERE domain_id = '". DOMAIN_ID ."' 
		ORDER BY title";
	$query = mysqli_query($db, $sql);
	if ( mysqli_num_rows($query) > 0 ) {
		
		$input[project_id] = "<SELECT NAME='". CRYPT_REF_ID ."' ". html_onchange() ." onchange=\"confirmDiscard(true)\">";
		
		// INSERT SELECT
		$input[project_id] .= "<OPTION VALUE=''>CHANGE PROJECT ---></OPTION>";
		
		while ( $info = mysqli_fetch_assoc($query) ) {
			/*
			// SELECTED
			if ( $_GET[CRYPT_REF_ID] == $info[project_id] ) {
				$edit = $info;
				echo "HERE!<P>";
				if ( $previous[project_id] ) $adjacent[previous] = $previous[project_id];
				$insert_next = TRUE;
				
			} elseif ( $insert_next && !$adjacent[next] ) {
				$adjacent[next] = $info[project_id];
			}
			*/
			
			$input[project_id] .= "<OPTION VALUE='". $info[project_id] ."' ". 
					($_GET[CRYPT_REF_ID] == $info[project_id] ? " SELECTED" : NULL) .">". 
				ucwords($info[title]) ." [". $info[project_id] ."]</OPTION>";
			$previous = $info;
		}
		$input[project_id] .= "</SELECT>";
	}
	
	////////// EXISTING DEPARTMENTS
	$insert_form[] = array("project_id", "change project", 
		$input[project_id],
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
	
	////////// SPACER
	$insert_form[] = array("-",NULL,10); // VERTICAL SPACER
	
	
	////////// PROCESS FORM ARRAY
	//////////////////////////////////////////////////

	echo form_input($insert_form); $insert_form = NULL;
	
	//////////////////////////////////////////////////
	
echo "</FORM>

<form  name='projectForm' ACTION='" . $_SERVER[PHP_SELF] . ($_SERVER[QUERY_STRING] ? "?". $_SERVER[QUERY_STRING] : null) ."' method='post' onSubmit=\"\">";//return safeSubmit(this);

	////////// SPACER
	//$insert_form[] = array("-",NULL,5); // VERTICAL SPACER
	
	
	if ( $_GET[CRYPT_REF_ID] ) {
		
		//////////////////////////////////////////////////
		$sql = "select * from template_images where domain_id = '". DOMAIN_ID."' and project_id = '". $_GET[CRYPT_REF_ID] ."'";
		$query = mysqli_query($db, $sql);
		$input[images] .= "<div STYLE='width:100%;'>";//overflow:scroll;
		while ( $images = mysqli_fetch_assoc($query) ) {
			$input[images] .= "<a href='project_images.php?image_id=". $images[image_id] ."'><img border=0 src='". LOCAL_DOMAIN ."/uploads/". $images[image_id] .".png' 
				style='margin:4px;float:left;border:2px solid gray;height:50px;'></a>";
		}
		$input[images] .= "</div>";
		
		$input[images] .= "<br /><div style='clear:left;'><a href='project_images.php?". CRYPT_REF_ID ."=". $_GET[CRYPT_REF_ID] ."'>--> add images to this project</a></div>";
		
		////////// IMAGES
		$insert_form[] = array("_",NULL,$input[images]); // VERTICAL SPACER
	}
	
	
	////////// QUESTION
	//$insert_form[] = array("?",NULL,"What would you like your public screename to be?"); // SUBTITLE
	
	////////// TITLE
	$insert_form[] = array("title", trans("project title"),
		array("TEXT",$edit[title],NULL," onFocus=\"formAltered();\""),//safeSubmit(this.form);
		NULL,NULL,NULL);
	
	////////// owner
	//$insert_form[] = array("owner", trans("owner"), // $field_name // WITH TRANSLATION FUNCTION
	//	array("TEXT",$edit[owner],null,NULL), // $input[type], $input[value], $input[style], $input[option]
	//	NULL,NULL,NULL);
	
	
	////////////////////////////////////////////////// CLIENT_ID
	$input[client_id] = "<select name=client_id onChange=\"check_extend_select(this,'Enter the client name here (firstname lastname email@domain.com)');formAltered();\">";
	$input[client_id] .= "<option value=''>SELECT --></option>";
	
	$sql = "SELECT * FROM template_contacts 
		WHERE domain_id is null 
			OR domain_id = '". DOMAIN_ID ."' 
			AND type = 'client'";
	$query = mysqli_query($db, $sql);
	while ( $clients = mysqli_fetch_assoc($query) ) {
		$input[client_id] .= "<option value='". $clients[contact_id] ."'".
			( ($last_client_id ? $last_client_id : ($_POST[client_id] ? $_POST[client_id] : $edit[client_id])) == $clients[contact_id] ? " SELECTED" : null ) .">". 
				$clients[contact] ."</option>";
	}
	
	// if new option is selected reenter it as selected option
	$input[client_id] .= ( !$last_client_id && $_POST[client_id] && !is_numeric($_POST[client_id]) 
			? "<option value='". $_POST[client_id] ."' SELECTED>". $_POST[client_id] ." [ADD]</option>" : null );
	$input[client_id] .= "<option value=''>add client name...</option>"; // create new option
	$input[client_id] .= "</select>";
	
	////////// CLIENT_ID
	$insert_form[] = array("client_id", "client",
		$input[client_id],
		NULL,NULL,NULL);
	
	
	////////// ARCHITECT
	//$insert_form[] = array("architect", "architect",
	//	array("TEXT",$edit[architect],NULL,NULL),
	//	NULL,NULL,NULL);
	
	
	////////////////////////////////////////////////// ARCHITECT_ID
	$input[architect_id] = "<select name=architect_id onChange=\"check_extend_select(this,'Enter the architect name here (firstname lastname email@domain.com)');formAltered();\">";
	$input[architect_id] .= "<option value=''>SELECT --></option>";
	
	$sql = "SELECT * FROM template_contacts 
		WHERE domain_id is null 
			OR domain_id = '". DOMAIN_ID ."' 
			AND type = 'architect'";
	$query = mysqli_query($db, $sql);
	while ( $architects = mysqli_fetch_assoc($query) ) {
		$input[architect_id] .= "<option value='". $architects[contact_id] ."'".
			( ($last_architect_id ? $last_architect_id : ($_POST[architect_id] ? $_POST[architect_id] : $edit[architect_id])) == $architects[contact_id] ? " SELECTED" : null ) .">". 
				$architects[contact] ."</option>";
	}
	
	// if new option is selected reenter it as selected option
	$input[architect_id] .= ( !$last_architect_id && $_POST[architect_id] && !is_numeric($_POST[architect_id]) 
			? "<option value='". $_POST[architect_id] ."' SELECTED>". $_POST[architect_id] ." [ADD]</option>" : null );
	$input[architect_id] .= "<option value=''>add architect name...</option>"; // create new option
	$input[architect_id] .= "</select>";
	
	////////// ARCHITECT_ID
	$insert_form[] = array("architect_id", "architect",
		$input[architect_id],
		NULL,NULL,NULL);
	
	
	
	
	////////////////////////////////////////////////// CATEGORIES
	$input[category_id] = "<select name=category_id onChange=\"check_extend_select(this,'Enter the new category here');formAltered();\">";
	$input[category_id] .= "<option value=''>SELECT --></option>";
	
	$sql = "SELECT * FROM template_categories 
		WHERE domain_id IS NULL 
			OR domain_id = '". DOMAIN_ID ."' 
			AND inactive IS NULL";
	$query = mysqli_query($db, $sql);
	while ( $categories = mysqli_fetch_assoc($query) ) {
		$input[category_id] .= "<option value='". $categories[category_id] ."'".
			( ($last_category_id ? $last_category_id : ($_POST[category_id] ? $_POST[category_id] : $edit[category_id])) == $categories[category_id] ? " SELECTED" : null ) .">". 
				$categories[category] ."</option>";
	}
	// if new option is selected reenter it as selected option
	$input[category_id] .= ( !$last_category_id && $_POST[category_id] && !is_numeric($_POST[category_id]) 
		? "<option value='". $_POST[category_id] ."' SELECTED>". $_POST[category_id] ." [ADD]</option>" : null );
	$input[category_id] .= "<option value=''>create new category...</option>"; // create new option
	$input[category_id] .= "</select>";
	
	////////// CATEGORIES
	$insert_form[] = array("category_id", "category",
		$input[category_id],
		NULL,NULL,NULL);
	
	
	
	////////////////////////////////////////////////// DEPARTMENTS
	/*$input[department_id] = "<select name=department_id onChange=\"check_extend_select(this,'Enter the new department here')\">";
	$input[department_id] .= "<option value=''>SELECT --></option>";
	
	$sql = "SELECT * FROM template_departments WHERE domain_id IS NULL OR domain_id = '". DOMAIN_ID ."'";
	$query = mysqli_query($db, $sql);
	while ( $departments = mysqli_fetch_assoc($query) ) {
		$input[department_id] .= "<option value='". $departments[department_id] ."'".
			( ($last_department_id ? $last_department_id : $_POST[department_id]) == $departments[department_id] ? " SELECTED" : null ) .">". 
				$departments[department] ."</option>";
	}
	
	// if new option is selected reenter it as selected option
	$input[department_id] .= ( !$last_department_id && $_POST[department_id] && !is_numeric($_POST[department_id]) 
			? "<option value='". $_POST[department_id] ."' SELECTED>". $_POST[department_id] ." [ADD]</option>" : null );
	$input[department_id] .= "<option value=''>create new department...</option>"; // create new option
	$input[department_id] .= "</select>";
	*/
	
	$columns = 2;
	
	$input[department_id] .= "
	
	<script type='text/javascript'>
		<!--
		
		function selectCheckbox(elem) {
			//alert('check it');
			document.getElementById(elem).checked = true;
		}
		
		-->
	</script>

	<table border=0 cellpadding=0 cellspacing=0>
		<tr>";
	
	
	//$sql = "SELECT d.*, pd.project_id FROM template_departments d 
	//	LEFT JOIN template_project_departments pd ON pd.department_id = d.department_id 
	//	WHERE domain_id IS NULL 
	//		OR domain_id = '". DOMAIN_ID ."'";
	//$sql = query_domain("template_departments");
	//$query = mysqli_query($db, $sql);
	//while ( $departments = mysqli_fetch_assoc($query) ) {
	if ( is_array($form[departments]) ) {
		foreach($form[departments] AS $departments ) {
			
			if ( $departments[domain_id] ) $custom_flag = true;
			
			if ( $cell >= $columns ) {
				$cell = null;
				$input[department_id] .= "</tr><tr>";
			}
			
			$input[department_id] .= "<td>
				<input type=checkbox name=departments[". $departments[department_id] ."]".
					// if departments are submitted in form --> then take $_POST variables only, not db settings unless it was just added ($last_department_id)
					( ($_POST 
						//? ($_POST[departments][$departments[department_id]] ? $_POST[departments][$departments[department_id]] : $last_department_id) 
						? ($_POST[departments][$departments[department_id]] || $last_department_id == $departments[department_id] ? true : false) 
						: $edit[departments][$departments[department_id]][project_id]) ? " CHECKED" : NULL) ." onChange=\"formAltered();\"> ". 
					$departments[department] ." 
					". ($departments[domain_id] ? " * " : null) ."
					[". $departments[department_id] ."]"."";
			
			$cell++;
		}
	}
	
	$input[department_id] .= "</tr>";
	
	$input[department_id] .= "<tr>
		<td colspan=". $columns .">
			<input type=checkbox name=departments[other] id='checkboxOther'\">
			<input type=text name=department_other value='". $form_default[department_other] ."' 
				onFocus=\"if(this.value=='". $form_default[department_other] ."')this.value='';selectCheckbox('checkboxOther');formAltered();\">
		</td>
	</tr>";
	
	$input[department_id] .= "</table>";
	
	////////// DEPARTMENTS
	$insert_form[] = array("department_id", "departments",
		( $custom_flag ? form_trailer("The departments with the asterisk next to them (*) are your custom departments. You can manage your departments from the 
			<a href='departments.php' onclick=\"return confirmDiscard();\">Departments Manager</a>") : null) . $input[department_id],
		NULL,NULL,NULL);
	
	
	////////// NOTE
	//$insert_form[] = array("~",NULL,"We treat your personal privacy just as we would our own. You can be assured that we will not share your email address with anyone. You will be able to opt out of any email correspondence with us at any time or adjust your settings from your account settings.");
	
	//<input name="dc" value="" size="11" onfocus="if(self.gfPop)gfPop.fPopCalendar(document.demoform.dc);return false;">
	
	////////// DESIGN DATE
	$insert_form[] = array("date_design", "design start date",
		"<input name='date_design' value='". ($_POST[date_design] ? $_POST[date_design] : $edit[date_design]) ."' size='11' onFocus=\"formAltered();if(self.gfPop)gfPop.fPopCalendar(document.projectForm.date_design);return false;\">",
		NULL,NULL,NULL);
	
	
	////////// CONSTRUCTION DATE
	$insert_form[] = array("date_construction", "construction date",
		"<input name='date_construction' value='". ($_POST[date_construction] ? $_POST[date_construction] : $edit[date_construction]) ."' size='11' onFocus=\"formAltered();if(self.gfPop)gfPop.fPopCalendar(document.projectForm.date_construction);return false;\">",
		NULL,NULL,NULL);
	
	
	////////// COMPLETION DATE
	$insert_form[] = array("date_completion", "completion date",
		"<input name='date_completion' value='". ($_POST[date_completion] ? $_POST[date_completion] : $edit[date_completion]) ."' size='11' onFocus=\"formAltered();if(self.gfPop)gfPop.fPopCalendar(document.projectForm.date_completion);return false;\">",
		NULL,"final completion of construction",NULL);
	
	////////// TEST DATE
	$insert_form[] = array("date_test", "test date",
		"<script>DateInput('date_test',true)</script>",
		NULL,"final completion of construction",NULL);
	
	
	////////// SPACER
	$insert_form[] = array("-",NULL,10); // VERTICAL SPACER
	
	
	////////// TITLE
	$insert_form[] = array("_",NULL,"PROJECT DESCRIPTIONS");
	$max_length = 300;
	$form_width = "80%";
	
	////////// DESIGN DESCRIPTION
	$edit[design] = ( $_POST[design] ? $_POST[design] : $edit[design] );
	$insert_form[] = array("design", "design",
		"<div id='projectDesignSample' onclick=\"new Effect.BlindUp('projectDesignSample',{ afterFinish: new Effect.BlindDown('projectDesign',{ afterFinish: setTimeout('setCaretToEnd(document.projectForm.design)',1200) }) })\" style='width:". $form_width .";'>
			". nl2br((strlen($edit[design]) > $max_length ? substr($edit[design],0,$max_length) : $edit[design])) ."... (click to edit)
		</div>
		<div id='wrapper'>
			<div id='projectDesign' style='display:none;'>
				<textarea name='design' id='projectFormDesign' rows=10 style='width:". $form_width .";' onFocus=\"formAltered();\">". $edit[design] ."</textarea>
			</div>
		</div>",
		NULL,NULL,NULL);
	
	////////// DIVIDER
	$insert_form[] = array("~",NULL,3);
	
	////////// SITE DESCRIPTION
	$edit[site] = ( $_POST[site] ? $_POST[site] : $edit[site] );
	$insert_form[] = array("site", "site",
		"<div id='projectSiteSample' onclick=\"new Effect.BlindUp('projectSiteSample',{ afterFinish: new Effect.BlindDown('projectSite',{ afterFinish: setTimeout('setCaretToEnd(document.projectForm.site)',1200) }) })\" style='width:". $form_width .";'>
			". nl2br((strlen($edit[site]) > $max_length ? substr($edit[site],0,$max_length) : $edit[site])) ."... (click to edit)
		</div>
		<div id='wrapper'>
			<div id='projectSite' style='display:none;'>
				<textarea name='site' id='projectFormSite' rows=5 style='width:". $form_width .";' onFocus=\"formAltered();\">". $edit[site] ."</textarea>
			</div>
		</div>",
		NULL,NULL,NULL);
	
	////////// DIVIDER
	$insert_form[] = array("~",NULL,3);
	
	////////// CONSTRUCTION DESCRIPTION
	$edit[construction] = ( $_POST[construction] ? $_POST[construction] : $edit[construction] );
	$insert_form[] = array("construction", "construction",
		"<div id='projectConstructionSample' onclick=\"new Effect.BlindUp('projectConstructionSample',{ afterFinish: new Effect.BlindDown('projectConstruction',{ afterFinish: setTimeout('setCaretToEnd(document.projectForm.construction)',1200) }) })\" style='width:". $form_width .";'>
			". nl2br((strlen($edit[construction]) > $max_length ? substr($edit[construction],0,$max_length) : $edit[construction])) ."... (click to edit)
		</div>
		<div id='wrapper'>
			<div id='projectConstruction' style='display:none;'>
				<textarea name='construction' id='projectFormConstruction' rows=5 style='width:". $form_width .";' onFocus=\"formAltered();\">". $edit[construction] ."</textarea>
			</div>
		</div>",
		NULL,NULL,NULL);
	
	
	
	/*
	////////// SITE
	$insert_form[] = array("site", "site",
		array("TEXTAREA",$edit[site],NULL,"ROWS=5"),
		NULL,NULL,NULL);
	
	////////// DESIGN
	$insert_form[] = array("design", "design",
		array("TEXTAREA",$edit[design],NULL,"ROWS=10"),
		NULL,NULL,NULL);
	
	////////// CONSTRUCTION
	$insert_form[] = array("construction", "construction",
		array("TEXTAREA",$edit[construction],NULL,"ROWS=5"), 
		NULL,NULL,NULL);
	*/
	
	////////// TITLE
	//$insert_form[] = array("_",NULL,"PROJECT LOCATION");
	
	////////// SPACER
	$insert_form[] = array("-",NULL,20);
	
	if ( $_GET[CRYPT_REF_ID] ) {
		////////// SUBMIT
		$insert_form[] = array("SUBMIT",NULL,
			"<INPUT TYPE=SUBMIT NAME=UPDATE_PROJECT VALUE='Update Project'> <INPUT TYPE=SUBMIT NAME=ADD_PROJECT VALUE='Add As New Project'>", // $input[type], $input[value], $input[style], $input[option]
			NULL,NULL,NULL); // $styles,$trailer,$options
		
	} else {
		
		////////// SUBMIT
		$insert_form[] = array("SUBMIT",NULL,
			"<INPUT TYPE=SUBMIT NAME=ADD_PROJECT VALUE='Add New Project' onClick=\"return safeSubmit(this.form);\">", // $input[type], $input[value], $input[style], $input[option]
			NULL,NULL,NULL); // $styles,$trailer,$options
		
	}
	
	
	
////////// PROCESS FORM ARRAY
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

	echo form_input($insert_form);
	
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////
////////// END BODY
echo form_table_end();
//echo "</TABLE>";
echo "</FORM>";

dev_print($_POST);
//dev_print($edit);

////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_footer.php");

?>
