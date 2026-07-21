<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", 1); // see config.php for settings

define("TEMPLATE_BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(TEMPLATE_BASE_DIR . "config.php"); // _functions/fnc.php


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
define("TITLE","Add New project Form"); // PAGE TITLE
${form}['no_match'] = "<span style='color:#777;'>No, These do not match...</span>";

if ( preg_match("/start/i",$_SERVER['QUERY_STRING']) ) unset($_SESSION['project']['title']);

// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( ${_POST}['SUBMIT'] && $disabled) {
	
	// CHECK USERNAME
	if ( !$_POST['username'] ) {
		${error}['username'] = "please submit a username";
	} elseif ( strlen($_POST['username']) < 4 ) {
		${error}['username'] = "Your username should be at least 4 characters";
	} else {
		
		$sql = "SELECT * FROM users WHERE username = '". ${_POST}['username'] ."' LIMIT 1";
		if ( !$query = mysqli_query($db, $sql) ) {
			error("there was an error checking if the new user exists",$sql,1);
			${error}['username'] = "There was an error validating your information. Please contact an administrator for assistance.";
		} elseif ( mysqli_fetch_array($query)) {
			${error}['username'] = "The username you selected is not vailable. Please select another username.";
		}
		
		
		
	}
	
	// CHECK EMAIL
	if ( !$_POST['email'] ) {
		${error}['email'] = "please submit your email address";
	} elseif ( !email_validate($_POST['email']) ) {
		${error}['email'] = "We could not validate your email address. Make sure you submitted it correctly. They usually have an @ in there somewhere, without any spaces.";
	} else {
		$sql = "SELECT * FROM users WHERE email = '". ${_POST}['email'] ."' LIMIT 1";
		if ( !$query = mysqli_query($db, $sql) ) {
			error("there was an error checking if the new user exists",$sql,1);
			${error}['email'] = "There was an error validating your information. Please contact an administrator for assistance.";
		} elseif ( mysqli_fetch_array($query)) {
			${error}['email'] = "Your email address is already registered. Would you like to have your password email to you? <a href='". TEMPLATE_BASE_DIR ."forgot.php'>forgot password</a>";
		}
	}
	
	// CHECK PASSWORD
	if ( !$_POST['password'] ) {
		${error}['password'] = "please submit a password";
	} elseif ( strlen($_POST['password']) < 6 ) {
		${error}['password'] = "Your password should be at least 6 characters";
	} elseif ( ${_POST}['password'] != ${_POST}['password_confirm'] ) {
		${error}['password_confirm'] = "Your passwords did not match. Make sure you got your password correct otherwise you may not be able to get access this account next time you try to login.";
	}
	
	// CHECK FIRSTNAME
	if ( strlen($_POST['firstname']) < 3 ) {
		${error}['firstname'] = "please submit your first name";
	}
	
	// CHECK LASTNAME
	if ( strlen($_POST['lastname']) < 3 ) {
		${error}['lastname'] = "please submit your last name";
	}
	
	if ( !$error ) {
		
		$sql = "INSERT INTO users SET 
			username = '". ${_POST}['username'] ."',
			email = '". ${_POST}['email'] ."',
			password = '". sha1($_POST['password']) ."',
			firstname = '". ${_POST}['firstname'] ."',
			lastname = '". ${_POST}['lastname'] ."',
			profession_id = '". ${_POST}['profession_id'] ."',
			reg_date = NOW()";
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error trying to insert new user",$sql,1);
		} else {
			// sign in
			//user_login();
			header("location:./");
		}
	}
	
	
}

if ( ${_POST}['CONTINUE'] ) {
	
	////////////////////////////////////////////////// CHECK REQUIRED FIELDS
	
	////////// CHECK TITLE
	if ( !preg_match("/[a-z]{3}/i",$_POST['title']) ) {
		${error}['title'] = "Please submit a project title to continue";
	}
	
	////////// CHECK COUNTRY
	if ( !$_POST['country_id']  ) {
		${error}['country_id'] = "Please select a country where this project is located";
	}
	
	
	
	////////// CHECK METROPOLITAN AREA
	
	// %%% CHECK TO SEE IF THE METRO AREA HAS BEEN ADDED TO ANOTHER PROVINCE FOR EXTRA PRECAUTION
	// search the db without zone_id and return which zone it is from to prompt user with check box or continuation button
	
	if ( ${_POST}['metro_id'] && !is_numeric($_POST['metro_id']) ) {
		$sql = "INSERT INTO countries_zones_metros SET 
			metro_id = NULL,
			metro_country_id = '". ${_POST}['country_id'] ."',". 
			( ${_POST}['zone_id'] ? "metro_zone_id = '". ${_POST}['zone_id'] ."'," : NULL) ."
			metro_name = '". ${_POST}['metro_id'] ."'";
		
		$log[] = "\$sql --> ". $sql ."<P>";
		
		if ( !$query = mysqli_query($db, $sql) ) {
			error("there was an error inserting the new metropolitan area by the user (". USER_ID .")",$sql);
			${error}['metro_id'] = "there was an error attempting to insert the Metropolitan area. Please try to add the project again or try removing the new metropolitan area.";
		} else {
			$last_metro_id = mysqli_insert_id($db);
		}
		
	}
	
	
	if ( !$error ) {
		
		$sql = "INSERT INTO projects SET 
			project_id = NULL, 
			user_id = '". USER_ID ."'";
			
		$log[] = "\$sql --> ". $sql ."<P>";
		
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error inserting the new project");
		} else {
			
			////////// zone_id
			if ( $last_project_id = mysqli_insert_id($db) ) {
				
				
				////////////////////////////////////////////////// project_title
				$sql = "INSERT INTO projects_title SET 
					project_id = '". $last_project_id ."', 
					user_id = '". USER_ID ."', 
					title = '". ${_POST}['title'] ."'";
				
				$log[] = "\$sql --> ". $sql ."<P>";
				
				if ( !mysqli_query($db, $sql) ) {
					error("there was an error inserting the new project TITLE",$sql);
				}
				
				////////////////////////////////////////////////// project_location
				$metro_id = ($last_metro_id ? $last_metro_id : ${_POST}['metro_id']);
				
				$sql = "INSERT INTO projects_locations SET 
					project_id = '". $last_project_id ."', 
					user_id = '". USER_ID ."', ". 
					($_POST['country_id'] ? "country_id = '". ${_POST}['country_id'] ."'," : NULL) .
					($_POST['zone_id'] ? "zone_id = '". ${_POST}['zone_id'] ."'," : NULL) .
					($metro_id ? "metro_id = '". $metro_id ."'," : NULL) .
					($_POST['address_01'] ? "address_01 = '". ${_POST}['address_01'] ."'," : NULL) .
					($_POST['city'] ? "city = '". ${_POST}['city'] ."'," : NULL) .
					($_POST['postal_code'] ? "postal_code = '". ${_POST}['postal_code'] ."'," : NULL) .
					"stamp = NOW()";
				
				$log[] = "\$sql --> ". $sql ."<P>";
				
				if ( !mysqli_query($db, $sql) ) {
					error("there was an error inserting the new project LOCATION",$sql);
				}
				
				
				////////// REDIRECT
				//echo "<b>location:<A HREF='./project.php?". CRYPT_REF_ID ."=". $last_project_id ."'>./project.php?". CRYPT_REF_ID ."=". $last_project_id ."</A></b><P>";
				
				header("location:./project.php?". CRYPT_REF_ID ."=". $last_project_id ."");
				exit();
				
			} else {
				${error}['CONTINUE'] = "There was an error inserting the new project. Please try again or contact us for assistance.";
			}
			
			
			
			
		}
		
		
		
	}
	
}


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");

/*
echo "
<STYLE TYPE='text/css'>
<!--
.hiddenRow { display:none; }
-->
</STYLE>

<script type='text/javascript'>
<!--

	function hideRows(id) {
		document.getElementById(id).className = 'hiddenRow';
		document.getElementById('officeId').value = id;
	}
	function test() {
		getElementById('defaultOfficeId').checked=false;
	}
	
-->
</script>";


function changePassword(){
 document.getElementById('pwRow_Change').style.display= 'none';
 document.getElementById('pwRow_New').style.display = 'block';
 document.getElementById('pwRow_New2').style.display = 'block';
 
 document.getElementById('formfield[password]').focus();
}

function toggle(hide) {
	if ( hide ) {
		//document.getElementById('hidethis').style.display = 'none';
		document.getElementById('tab'+id).className = 'hiddenRow';
	} else {
		document.getElementById('hidethis').style.display = '';
	}
}

*/
//include(TEMPLATE_BASE_DIR . "_includes/inc_login.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
//echo "<TABLE BORDER=0 BORDERCOLOR=PINK ALIGN=CENTER CELLPADDING=1 CELLSPACING=0 RULES=NONE>";
echo form_table_start();
echo "<FORM NAME='NEW_PROJECT' ACTION=" . ${_SERVER}['PHP_SELF'] . " METHOD=POST>";





//////// MAIN SECTION HEADING
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


////////// SUBSECTION HEADINGS
/////////////////////////////////////////////////////////////////////////////////////

	
	////////// TITLE NAME HERE
	$insert_form[] = array("-",NULL,"New Project Form"); // SUBTITLE
	
	////////// QUESTION
	$insert_form[] = array("?",NULL,"What is the name or title of the project?"); // SUBTITLE
	
	//////////////////////////////////////////////////
	// DEFINE ${edit}['title'] FROM SESSION IF NOT DEFINED
	
	if ( ${_POST}['title'] ) ${edit}['title'] = ${_POST}['title'];
	
	// IF PREVIOUS SEARCH TITLE SELECTED
	if ( ${_SESSION}['project']['title'][$_GET['p_title_selected']] ) {
		${edit}['title'] = ${_SESSION}['project']['title'][$_GET['p_title_selected']];
	} else {
		${edit}['title'] = ${_SESSION}['project']['title'][0];
	}
	
	////////// TITLE
	$insert_form[] = array("title", trans("project title"),
		array("TEXT",{$edit['title'],NULL,NULL),
		NULL,NULL,NULL);
	
	////////// IF TITLE WAS SUBMITTED --> CHECK IF IT EXISTS
	if ( preg_match("/[a-z]{3}/i",$_POST['title']) || ${_SESSION}['project']['title'][$_GET['p_title_selected']]  ) {
		
		// 
		if ( is_array($_SESSION['project']['title']) ) {
			
			if ( !in_array($_POST['title'],$_SESSION['project']['title']) ) {
				${_SESSION}['project']['title'][] = ${_POST}['title'];
			}
			
			// if there is more than one stored title searches --> create a list of links to recall them
			if ( count($_SESSION['project']['title']) > 1 ) {
				foreach($_SESSION['project']['title'] AS $key => $title ) {
					if ( strtolower($title) != strtolower($_POST['title']) && strtolower($title) != strtolower($_SESSION['project']['title'][$_GET['p_title_selected']]) ) {
							${input}['title_searched'] .= ({$input['title_searched'] ? "</br>":NULL) 
								."<a href='". ${_SERVER}['PHP_SELF'] ."?p_title_selected=". $key ."'>". ucwords($title) ."</a>";
					}
				}
				
				////////// OFFICE UNKOWN
				$insert_form[] = array("title_searched", trans("previous searches"),
					${input}['title_searched'] ."<div style='color:gray;padding-top:5px;'>(click previous title search to recall)</div>",
					NULL,NULL,NULL);
				
				////////// SPACER
				$insert_form[] = array("-",NULL,10);
				
			} else {
				
			}
			
		} else {
		//} elseif ( preg_match("/start/i",$_SERVER['QUERY_STRING']) ) {
			
			//echo "here";
			
			//unset($_SESSION['project']['title']);
		//	unset($_SESSION['project']['title']);
			//$_SESSION['project']['title'] = NULL;
			
			${_SESSION}['project']['title'][] = ${_POST}['title'];
			
		}
		
		////////// NOTE
		$insert_form[] = array("~",NULL,"To prevent duplicate project submissions please attempt to submit or search for alternate names for this project here in this field. This search (". ${_POST}['title'] .") will be retained and an option to re-select it will be presented to you in the next step."); // SUBTITLE
		
		
		///////////////////////////////////
		//
		//  REFINE THIS SEARCH TO ACCOUNT FOR EACH WORD INDIVIDUALLY
		//  PRODUCE A PERCENTAGE OF HIGHEST SIMILARITY TO LIST AT TOP OF RESULTS
		//
		///////////////////////////////////
		
		
		// CHECK IF PROJECT ALREADY EXISTS
		$sql = "SELECT * FROM projects_title 
			WHERE title LIKE '%". ${_POST}['title'] ."%'";
		
		$log[] = "\$sql --> ". $sql;
		
		if ( !$query = mysqli_query($db, $sql) ) {
			error("there was an error searching for matching projects while trying to add a new project",$sql);
		} elseif ( mysqli_num_rows($query) > 0 ) {
			
			// QUERY PROJECTS DATABASE
			while ($info = mysqli_fetch_assoc($query)) {
				${input}['project_id'] .= "<INPUT TYPE=RADIO NAME='project_id' VALUE='". ${info}['project_id'] ."'".
					(($_POST['project_id'] ? ${_POST}['project_id'] : ${_SESSION}['project']['project_id']) == ${info}['project_id'] 
						? " CHECKED" : NULL) ."> ". ucwords({$info['title']) ."</br>";
			}
			
			////////// QUESTION
			$insert_form[] = array("?",NULL,"Do any of the following projects match the project you intend to add?"); // SUBTITLE
			
			////////// EXISTING PROJECT MATCHES
			$insert_form[] = array("project_id", trans("existing projects"),
				${input}['project_id'] .
					"<INPUT TYPE=RADIO NAME='project_id' VALUE=''".
					(($_POST['project_id'] ? ${_POST}['project_id'] : ${_SESSION}['project']['project_id']) ? NULL : " CHECKED") ."> ". ${form}['no_match'],
				NULL,NULL,NULL);
		}
		
		////////// HEADER
		$insert_form[] = array("~",NULL,3);
		
		////////// QUESTION
		$insert_form[] = array("?",NULL,"Where is this new project located"); // SUBTITLE
		
		
		////////// TITLE NAME HERE
		//$insert_form[] = array("_",NULL,"Detailed Project Location"); // SUBTITLE
		
		
		////////////////////////////////////////////////// country_id
		//{$input['country_id'] = form_drop_countries(return_priority(array($_POST['country_id'],{$edit['country_id'])));
		${input}['country_id'] = form_drop_countries({$edit['country_id']);
		
		////////// COUNTRY MENU
		$insert_form[] = array("country_id", trans("country"),
			${input}['country_id'],
			NULL,NULL,NULL); // $styles,$trailer,$options
		
		
		
		
		
		
		
		
		
		
		
		
		
		////////////////////////////////////////////////// zone_id
		//{$input['zone_id'] = form_drop_zones(return_priority(array($_POST['zone_id'],{$edit['zone_id'])));
		//{$input['zone_id'] = form_drop_zones({$edit['zone_id'],NULL,array("onchange"=>true));
		${input}['zone_id'] = form_drop_zones({$edit['zone_id']);
		
		////////// PROVINCE MENU
		$insert_form[] = array("zone_id", trans("province / state"),
			${input}['zone_id'],
			NULL,NULL,NULL); // $styles,$trailer,$options
		
		
		//if ( ${_POST}['zone_id'] ) {
			
			////////////////////////////////////////////////// metro_id
			${input}['metro_id'] = "<select id=metro_id name=metro_id onChange=\"check_extend_select(this,'Enter the name of the Greater Metropolitan Area where this project is located (for example: New York)');formAltered();\">";
			${input}['metro_id'] .= "<option value=''>SELECT --></option>";
			
			$sql = "SELECT * FROM countries_zones_metros 
				WHERE metro_country_id = '". ${_POST}['country_id'] ."' ".
					( ${_POST}['zone_id'] ? "AND metro_zone_id = '". ${_POST}['zone_id'] ."'" : NULL);
			$query = mysqli_query($db, $sql);
			while ( $metros = mysqli_fetch_assoc($query) ) {
				${input}['metro_id'] .= "<option value='". ${metros}['metro_id'] ."'".
					( ($last_metro_id ? $last_metro_id : ($_POST['metro_id'] ? ${_POST}['metro_id'] : ${edit}['metro_id'])) == ${metros}['contact_id'] ? " SELECTED" : null ) .">". 
						${metros}['metro_name'] ."</option>";
			}
			
			// if new option is selected reenter it as selected option
			${input}['metro_id'] .= ( !$last_metro_id && ${_POST}['metro_id'] && !is_numeric($_POST['metro_id']) 
					? "<option value='". ${_POST}['metro_id'] ."' SELECTED>". ${_POST}['metro_id'] ." [ADD]</option>" : null );
			${input}['metro_id'] .= "<option value=''>add Greater Metropolitan Area...</option>"; // create new option
			${input}['metro_id'] .= "</select>";
			
			////////// metro_id
			$insert_form[] = array("metro_id", trans("metro area"),
				${input}['metro_id'],
				NULL,NULL,NULL);
			
		//}
		
		
		
		//if ( ${_POST}['SEARCH_OFFICE'] && !$_POST['office_id'] ) {
		//if ( ($_POST['SEARCH_OFFICE'] || ${_POST}['country_id']) && !$_POST['office_id'] ) {
		if ( ${_POST}['country_id'] ) {
			
			////////// SPACER
			$insert_form[] = array("-",NULL,10);
			
			/*
			////////// OFFICE WEBSITE
			$insert_form[] = array("office_url", trans("website url"),
				array("TEXT",{$edit['office_url'],NULL,NULL),
				NULL,NULL,NULL);
			
			////////// OFFICE PHONE
			$insert_form[] = array("office_phone", trans("office phone"),
				array("TEXT",{$edit['office_phone'],NULL,NULL),
				NULL,NULL,NULL);
			*/
			
			////////// OFFICE ADDRESS LINE 1
			$insert_form[] = array("address_01", trans("address"),
				array("TEXT",{$edit['address_01'],NULL,NULL),
				NULL,NULL,NULL);
			
			////////// CITY
			$insert_form[] = array("city", trans("city / township"), 
				array("TEXT",{$edit['city'],NULL,NULL),
				//array("TEXT",return_priority(array($_POST['city'],{$edit['city'])),NULL,NULL),
				NULL,NULL,NULL); // $styles,$trailer,$options
			
			////////// POSTAL CODE
			$insert_form[] = array("postal_code", trans("postal code"), 
				array("TEXT",{$edit['postal_code'],NULL,NULL),
				//array("TEXT",return_priority(array($_POST['postal_code'],{$edit['postal_code'])),NULL,NULL),
				NULL,NULL,NULL); // $styles,$trailer,$options
			
		}
		
		
		////////// SPACER
		$insert_form[] = array("-",NULL,10);
		
		////////// SUBMIT
		$insert_form[] = array("CONTINUE",NULL,
			"<INPUT TYPE=SUBMIT NAME=CONTINUE VALUE='Continue...' onclick='return confirmMetroProvince();'>",
			NULL,NULL,NULL);
		
		//}
		
	} else {
		
		////////// SUBMIT
		$insert_form[] = array("CONTINUE",NULL,
			"<INPUT TYPE=SUBMIT NAME=CONTINUE VALUE='Continue...' onclick='return confirmMetroProvince();'>",
			NULL,NULL,NULL);
		
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
//dev_print($_SESSION);
//dev_print($_SERVER);
dev_print($log);


////////// CHECK VARIABLES
/////////////////////////////////////////////////////////////////////////////////////
//-- echo "<B>\$error</B><BR>"; dev_print($error);
//-- echo "<B>\$_REQUEST</B><BR>"; dev_print($_REQUEST);



////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
