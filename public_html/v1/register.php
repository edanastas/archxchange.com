<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", NULL); // see config.php for settings

define("BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(BASE_DIR . "config.php"); // _functions/fnc.php


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
define("TITLE","Registration"); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( $_POST[SUBMIT] ) {
	
	
	// CHECK USERNAME
	if ( !$_POST[username] ) {
		$error[username] = "please submit a username";
	} elseif ( strlen($_POST[username]) < 4 ) {
		$error[username] = "Your username should be at least 4 characters";
	} else {
		$sql = "SELECT * FROM users WHERE username = '". query_prep($_POST[username]) ."' LIMIT 1";
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error checking if the new user exists",$sql,1);
			$error[username] = "There was an error validating your information. Please contact an administrator for assistance.";
		} else {
			
		}
	}
	
	// CHECK EMAIL
	if ( !$_POST[email] ) {
		$error[email] = "please submit your email address";
	} elseif ( !email_validate($_POST[email]) ) {
		$error[email] = "We could not validate your email address. Make sure you submitted it correctly. They usually have an @ in there somewhere, without any spaces.";
	}
	
	// CHECK NAMES
	if ( !$_POST[firstname] ) 
		$error[firstname] = "please provide us with a contact name. You can change this name at any time from your account management.";
	
	if ( !$_POST[lastname] ) 
		$error[lastname] = "please provide us with a contact name. You can change this name at any time from your account management.";
	
	if ( !$_POST[company] ) 
		$error[company] = "Please submit a company name.";
	
	if ( !$_POST[phone] ) 
		$error[phone] = "Please submit a phone so we can contact you if we need any additional information.";
	
	
	// CHECK PASSWORD
	if ( !$_POST[password] ) {
		$error[password] = "please submit a password";
	} elseif ( strlen($_POST[password]) < 6 ) {
		$error[password] = "Your password should be at least 6 characters";
	} elseif ( $_POST[password] != $_POST[password_confirm] ) {
		$error[password_confirm] = "Your passwords did not match. Make sure you got your password correct otherwise you may not be able to get access this account next time you try to login.";
	}
	
	
	// CHECK DOMAIN
	if ( !$_POST[domain] ) {
		$error[domain] = "please submit your offices website domain";
	} elseif ( !eregi("[a-z0-9-]+\.[a-z]{2,4}$",trim($_POST[domain])) ) { //(www\.)?
		$error[domain] = "We could not validate your website domain.";
	}
	
	
	if ( !$error ) {
		
		// INSERT DOMAIN (MOST IMPORTANT)
		$sql = "INSERT INTO domains SET 
			domain_id = NULL, 
			domain = '". $_POST[domain] ."', 
			company = '". $_POST[company] ."'";
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error trying to insert new domain",$sql,1,NULL,
				"manually create a member for this domain (". $last_insert_id .")");
		} else {
			
			if ( $last_insert_id = mysqli_insert_id($db) ) {
				// INSERT ADMINISTRATIVE ACCOUNT MEMBER
				$sql = "INSERT INTO members SET 
					member_id = NULL, 
					domain_id = '". $last_insert_id ."', 
					username = '". $_POST[username] ."', 
					password = sha1('". $_POST[password] ."'), 
					email = '". $_POST[email] ."', 
					firstname = '". $_POST[firstname] ."', 
					lastname = '". $_POST[lastname] ."'";
				if ( !mysqli_query($db, $sql) ) {
					error("there was an error trying to insert new member for domain_id ". $last_insert_id,$sql,1);
				} else {
					
					// INSERT ADMINISTRATIVE ACCOUNT MEMBER
					$sql = "INSERT INTO contacts SET 
						contact_id = NULL, 
						access = '3', 
						domain_id = '". $last_insert_id ."', 
						email = '". $_POST[email] ."', 
						firstname = '". $_POST[firstname] ."', 
						lastname = '". $_POST[lastname] ."'";
					if ( !mysqli_query($db, $sql) ) {
						error("there was an error trying to copy the member information to the contacts (member_id ". mysqli_insert_id($db) .")",$sql,1);
					}
				}
			}
			
			header("location:instructions.php?ref=". sha1($last_insert_id));
			
		}
		
	}
	
	
}

// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(BASE_DIR . "_includes/inc_header.php");




//include(BASE_DIR . "_includes/inc_login.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
//echo "<TABLE BORDER=0 BORDERCOLOR=PINK ALIGN=CENTER CELLPADDING=1 CELLSPACING=0 RULES=NONE>";
echo form_table_start();
echo "<FORM ACTION=" . $_SERVER[PHP_SELF] . " METHOD=POST>";





//////// MAIN SECTION HEADING
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


////////// SUBSECTION HEADINGS
/////////////////////////////////////////////////////////////////////////////////////


	////////// TITLE
	$insert_form[] = array("-",NULL,"REGISTRATION");
	
	
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
		array("TEXT",$edit[username],NULL,"MAXLENGTH=30"),
		NULL,NULL,NULL);
	
	////////// EMAIL
	$insert_form[] = array("email", trans("email"), // $field_name // WITH TRANSLATION FUNCTION
		array("TEXT",$edit[email],null,NULL), // $input[type], $input[value], $input[style], $input[option]
		NULL,"email@example.com",NULL); // $styles,$trailer,$options
	//"<div class='formNote'>we treat your personal privacy just as we would our own. So you can be assured that we will not share your email address with anyone. Simple as that!</div>"
	
	////////// NOTE
	$insert_form[] = array("~",NULL,"We treat your personal privacy just as we would our own. You can be assured that we will not share your email address with anyone. You will be able to opt out of any email correspondence with us at any time or adjust your settings from your account settings.");
	
	////////// NOTE
	//$insert_form[] = array("~",NULL,"we treat your personal privacy just as we would our own. So you can be assured that we will not share your email address with anyone. Simple as that!"); // SUBTITLE
	
	
	/*
	////////// EMAIL CONFIRM
	$insert_form[] = array("email_confirm", trans("confirm email"),
		array("TEXT",$edit[email_confirm],NULL,NULL),
		NULL,NULL,NULL);
	*/
	
	////////// PASSWORD
	$insert_form[] = array("password", "password",
		array("PASSWORD",$edit[password],NULL,NULL),
		NULL,"6-18 characters",NULL);
		
	////////// PASSWORD CONFIRM
	$insert_form[] = array("password_confirm", "confirm password",
		array("PASSWORD",$edit[password_confirm],NULL,NULL),
		NULL,NULL,NULL);
	
	
	/*
	////////// FIRSTNAME
	$insert_form[] = array("firstname", "firstname",
		array("TEXT",$edit[firstname],NULL,NULL),
		NULL,NULL,NULL);
	
	////////// AGREE
	$insert_form[] = array("agree", null,
		array("CHECKBOX",$edit[agree],NULL,NULL),
		NULL,NULL,NULL);
	
	/////////// test
	$insert_form[] = array("comments", "comments",
		array("TEXTAREA",$edit[comments],NULL,NULL),
		NULL,NULL,NULL);
	*/
	
	////////// SPACER
	$insert_form[] = array("-",NULL,10); // VERTICAL SPACER
	
	
	////////// FIRSTNAME
	$insert_form[] = array("firstname", "firstname",
		array("TEXT",$edit[firstname],NULL,NULL),
		NULL,NULL,NULL);
	
	////////// LASTNAME
	$insert_form[] = array("lastname", "lastname",
		array("TEXT",$edit[lastname],NULL,NULL),
		NULL,NULL,NULL);
	
	
	
	
	////////// TITLE
	$insert_form[] = array("_",NULL,"OFFICE INFORMATION");
	
	////////// COMPANY
	$insert_form[] = array("domain", "website domain",
		array("TEXT",$edit[domain],NULL,NULL),
		NULL,"your-company-name.com",NULL);
	
	////////// NOTE
	$insert_form[] = array("~",NULL,"Your website domain should be registered at an ICANN approved registrar. Once registered you will be able to direct your domain to our servers. This will provide you with the most secure protection of your domain for the security of your companies identity. We are not domain registrars and feel that it would be in your best interest to register it independantly of any hosting service. Click here for a list of our recommended registrars.");
	
	
	////////// COMPANY
	$insert_form[] = array("company", "company name",
		array("TEXT",$edit[company],NULL,NULL),
		NULL,NULL,NULL);
	
	////////// PHONE
	$insert_form[] = array("phone", "office phone",
		array("TEXT",$edit[phone],NULL,NULL),
		NULL,NULL,NULL);
	
	/*
	////////// FAX
	$insert_form[] = array("fax", "office fax",
		array("TEXT",$edit[fax],NULL,NULL),
		NULL,NULL,NULL);
	
	
	*/
	
	
	////////// SUBMIT
	$insert_form[] = array("SUBMIT",NULL,
		"<INPUT TYPE=SUBMIT NAME=SUBMIT VALUE='Sign Me Up!'>", // $input[type], $input[value], $input[style], $input[option]
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
include(BASE_DIR . "_includes/inc_footer.php");

?>
