<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", NULL); // see config.php for settings

define("TEMPLATE_BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(TEMPLATE_BASE_DIR . "config.php"); // _functions/fnc.php


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
define("TITLE","Registration"); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( $_POST['SUBMIT'] ) {
	
	// CHECK USERNAME
	if ( !$_POST['username'] ) {
		$error['username'] = "please submit a username";
	} elseif ( strlen($_POST['username']) < 4 ) {
		$error['username'] = "Your username should be at least 4 characters";
	} else {
		
		$sql = "SELECT * FROM users WHERE username = '". $_POST['username'] ."' LIMIT 1";
		if ( !$query = mysqli_query($db, $sql) ) {
			error("there was an error checking if the new user exists",$sql,1);
			$error['username'] = "There was an error validating your information. Please contact an administrator for assistance.";
		} elseif ( mysqli_fetch_array($query)) {
			$error['username'] = "The username you selected is not vailable. Please select another username.";
		}
		
		
		
	}
	
	// CHECK EMAIL
	if ( !$_POST['email'] ) {
		$error['email'] = "please submit your email address";
	} elseif ( !email_validate($_POST['email']) ) {
		$error['email'] = "We could not validate your email address. Make sure you submitted it correctly. They usually have an @ in there somewhere, without any spaces.";
	} else {
		$sql = "SELECT * FROM users WHERE email = '". $_POST['email'] ."' LIMIT 1";
		if ( !$query = mysqli_query($db, $sql) ) {
			error("there was an error checking if the new user exists",$sql,1);
			$error['email'] = "There was an error validating your information. Please contact an administrator for assistance.";
		} elseif ( mysqli_fetch_array($query)) {
			$error['email'] = "Your email address is already registered. Would you like to have your password email to you? <a href='". TEMPLATE_BASE_DIR ."forgot.php'>forgot password</a>";
		}
	}
	
	// CHECK PASSWORD
	if ( !$_POST['password'] ) {
		$error['password'] = "please submit a password";
	} elseif ( strlen($_POST['password']) < 6 ) {
		$error['password'] = "Your password should be at least 6 characters";
	} elseif ( $_POST['password'] != $_POST['password_confirm'] ) {
		$error['password_confirm'] = "Your passwords did not match. Make sure you got your password correct otherwise you may not be able to get access this account next time you try to login.";
	}
	
	// CHECK FIRSTNAME
	if ( strlen($_POST['firstname']) < 3 ) {
		$error['firstname'] = "please submit your first name";
	}
	
	// CHECK LASTNAME
	if ( strlen($_POST['lastname']) < 3 ) {
		$error['lastname'] = "please submit your last name";
	}
	
	if ( !$error ) {
		
		$sql = "INSERT INTO users SET 
			username = '". $_POST['username'] ."',
			email = '". $_POST['email'] ."',
			password = '". sha1($_POST['password']) ."',
			firstname = '". $_POST['firstname'] ."',
			lastname = '". $_POST['lastname'] ."',
			profession_id = '". $_POST['profession_id'] ."',
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

// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");




//include(TEMPLATE_BASE_DIR . "_includes/inc_login.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
//echo "<TABLE BORDER=0 BORDERCOLOR=PINK ALIGN=CENTER CELLPADDING=1 CELLSPACING=0 RULES=NONE>";
echo form_table_start();
echo "<FORM ACTION=" . $_SERVER['PHP_SELF'] . " METHOD=POST>";





//////// MAIN SECTION HEADING
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


////////// SUBSECTION HEADINGS
/////////////////////////////////////////////////////////////////////////////////////


	////////// TITLE NAME HERE
	$insert_form[] = array("-",NULL,"REGISTRATION"); // SUBTITLE
	
	
	////////// SPACER
	//$insert_form[] = array("-",NULL,5); // VERTICAL SPACER
	
	
	////////// TYPE
	//$insert_form[] = array("type", trans("account type"),
	//	"<INPUT TYPE=RADIO NAME=TYPE VALUE='0'> personal <INPUT TYPE=RADIO NAME=TYPE VALUE='1'> professional hosting ",
	//	NULL,NULL,NULL);
	
	
	////////// QUESTION
	$insert_form[] = array("?",NULL,"What would you like your public screename to be?"); // SUBTITLE
	
	////////// USERNAME
	$insert_form[] = array("username", trans("username"),
		array("TEXT",$edit['username'],NULL,"MAXLENGTH=30"),
		NULL,NULL,NULL);
	
	////////// EMAIL
	$insert_form[] = array("email", trans("email"), // $field_name // WITH TRANSLATION FUNCTION
		array("TEXT",$edit['email'],null,NULL), // $input['type'], $input['value'], $input['style'], $input['option']
		NULL,"email@example.com",NULL); // $styles,$trailer,$options
	//"<div class='formNote'>we treat your personal privacy just as we would our own. So you can be assured that we will not share your email address with anyone. Simple as that!</div>"
	
	////////// NOTE
	$insert_form[] = array("~",NULL,"We treat your personal privacy just as we would our own. You can be assured that we will not share your email address with anyone. You will be able to opt out of any email correspondence with us at any time or adjust your settings from your account settings."); // SUBTITLE
	
	////////// NOTE
	//$insert_form[] = array("~",NULL,"we treat your personal privacy just as we would our own. So you can be assured that we will not share your email address with anyone. Simple as that!"); // SUBTITLE
	
	
	/*
	////////// EMAIL CONFIRM
	$insert_form[] = array("email_confirm", trans("confirm email"),
		array("TEXT",$edit['email_confirm'],NULL,NULL),
		NULL,NULL,NULL);
	*/
	
	////////// PASSWORD
	$insert_form[] = array("password", trans("password"),
		array("PASSWORD",$edit['password'],NULL,NULL),
		NULL,NULL,NULL);
		
	////////// PASSWORD CONFIRM
	$insert_form[] = array("password_confirm", trans("confirm password"),
		array("PASSWORD",$edit['password_confirm'],NULL,NULL),
		NULL,NULL,NULL);
	
	
	////////// SPACER
	$insert_form[] = array("-",NULL,10); // VERTICAL SPACER
	
	////////// QUESTION
	$insert_form[] = array("?",NULL,"Please tell us a little bit about yourself?"); // SUBTITLE
	
	//////////////////////////////////////////////////
	$sql = "SELECT * FROM professions WHERE approved IS NOT NULL";
	$query = mysqli_query($db, $sql);
	$input['profession'] = "<SELECT NAME=profession_id>
		<OPTION VALUE=''>SELECT --></OPTION>";
	while ( $info = mysqli_fetch_array($query) ) {
		$input['profession'] .= "<OPTION VALUE='". $info['profession_id'] ."' ". 
			($info['profession_id'] == $_POST['profession_id'] ? " SELECTED" : null).">". ucwords($info['profession']) ."</OPTION>";
	}
	$input['profession'] .= "</SELECT>";
	
	////////// PROFESSION
	$insert_form[] = array("profession", trans("profession"),
		$input['profession'],
		NULL,NULL,NULL);
	
	
	////////// FIRSTNAME
	$insert_form[] = array("firstname", trans("firstname"),
		array("TEXT",$edit['firstname'],NULL,NULL),
		NULL,NULL,NULL);
	
	////////// LASTNAME
	$insert_form[] = array("lastname", trans("lastname"),
		array("TEXT",$edit['lastname'],NULL,NULL),
		NULL,NULL,NULL);
	
	
	/*
	////////// AGREE
	$insert_form[] = array("agree", null,
		array("CHECKBOX",$edit['agree'],NULL,NULL),
		NULL,NULL,NULL);
	
	/////////// test
	$insert_form[] = array("comments", "comments",
		array("TEXTAREA",$edit['comments'],NULL,NULL),
		NULL,NULL,NULL);
	*/
	
	////////// SUBMIT
	$insert_form[] = array("SUBMIT",NULL,
		"<INPUT TYPE=SUBMIT NAME=SUBMIT VALUE='Sign Me Up!'>", // $input['type'], $input['value'], $input['style'], $input['option']
		NULL,NULL,NULL); // $styles,$trailer,$options
	
	
	
	
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






////////// CHECK VARIABLES
/////////////////////////////////////////////////////////////////////////////////////
//-- echo "<B>\$error</B><BR>"; dev_print($error);
//-- echo "<B>\$_REQUEST</B><BR>"; dev_print($_REQUEST);



////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
