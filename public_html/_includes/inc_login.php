<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if (!defined('ACCESS')) die(ERROR_MESSAGE);


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
//echo "\$_SERVER[PHP_SELF] --> " . $_SERVER[PHP_SELF] . " <P>";
//dev_print($_POST);

// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0

////////// LOGIN CHECKING
/*if ( $_POST[AGREE] || $_POST[DISAGREE] ) {
	
	////////// CHECK AGREE
	if ( $_POST[AGREE] ) {
		
		$_SESSION[AGREE] = TRUE;
		
	} elseif ( $_POST[DISAGREE] ) {
		
		$_SESSION[AGREE] = FALSE;
		$error[AGREE] = "You must agree to our conditions to take advantage of our great prices.";
	}
	
////////// REGISTRATION CHECKING
} else*/if ( $_POST[LOGIN] ) {
	
	////////// CHECK EMAIL
	if ( !eregi("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", trim($_POST[email])) ) {
		//$error[email] = TRUE;
		//$error[db] = "Please submit a valid e-mail address<br>";
		$error[email] = "Please submit a valid e-mail address";
		
	}/* else { // IF EMAIL --> CHECK IF EMAIL EXISTS
		if ( mysqli_fetch_row(mysqli_query($db, "SELECT * FROM users WHERE user_id = '" . trim($_POST[email]) . "' LIMIT 1")) ) {
			$error[email] = "that email address already exists in our database";
		}
	}*/
	
	////////// CHECK PASSWORD
	// if they have a password but they haven't filled it in then error:
	///if ( $_POST[have_password] == "no" )  { // "I AM A NEW CUSTOMER" -->
		// IF EMAIL --> CHECK IF EMAIL EXISTS
		///if ( mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE email = '" . trim($_POST[email]) . "' LIMIT 1")) ) {
		///	$error[email] = "The e-mail address already exists in our records"; 
		///	$note[forgot] = "Did you forget your password? <A HREF='forgot.php'>click here</A>"; // Did you forget your password // Need assistance with your password
		///}
		
	///} else
	
	
	//if ( $_POST[have_password] == "yes" || ( $_POST[email] && $_POST[password] && $_POST[have_password] != "no" ) ) { // "I AM A RETURNING CUSTOMER" -->
		
	if ( $_POST[have_password] == "yes" || ( $_POST[email] && $_POST[password] && $_POST[have_password] != "no" ) ) { // "I AM A RETURNING CUSTOMER" -->
		
		
		
		if ( !eregi("^.{4,12}$",$_POST[password]) ) { // !$_POST[password] ) { // &&  $_POST[have_password] == "yes"
			//$error[pwd] = TRUE;
			$error[password] = "Please enter a password (4-12 characters)";
			//$error[db] .= "* Please enter a password<br>";
		} else {
			//if ( $_POST[have_password] == "yes" ) { // RETURNING CUSTOMER
			
			
			// CHECK IF THE USER EXISTS
				if ( mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users 
						WHERE email = '" . db_escape(trim($_POST[email])) . "' LIMIT 1")) ) {
				
				
					// CHECK IF PASSWORD MATCHES
					if ( !$info = mysqli_fetch_assoc(mysqli_query($db, "SELECT `user_id`,`language_code`,`password` FROM `users` 
							WHERE `email` = '" . db_escape(trim($_POST[email])) . "' 
							AND `password` = sha1('" . db_escape($_POST[password]) . "') LIMIT 1")) ) {
					
					$error[password] = "The password does not match our records";
					$note[forgot] = "Did you forget your password? <A HREF='forgot.php'>click here</A>";
					
				} else {
					
					//dev_print($info);
					
					////////// LOGOUT
					//session_start();
					//session_unset();
					//session_destroy();
					
					//define('USER_ID',$info[user_id]);
					//$_COOKIE[auto] = NULL;
					//unset($_SESSION['auto']);
					//echo $info[user_id] . "|" . sha1($_POST[password]);
					//exit();
					//$_COOKIE[auto] = $info[user_id] . " | " . sha1($_POST[password]);
					
					//$_SESSION[user_id] = $info[user_id];
					//$_SESSION[password] = $info[password];
					
					member_login($info);
					
					///cart_login();
					
					///if ( !$_SERVER[QUERY_STRING] && cart_qty() > 0 ) {
					///	header("Location:./cart.php");
					///} else {
					///	header("Location:./" . return_on($_SERVER[QUERY_STRING], $_SERVER[QUERY_STRING]) );
					///}
					
				}
				
			} else { // IF NO EMAIL -->
				
				$checked[no] = "CHECKED";
				$error[email] = "The email address is not in our records";
				
			} /* else {
			
				// IF EMAIL --> CHECK IF EMAIL EXISTS
				if ( mysqli_fetch_row(mysqli_query($db, "SELECT * FROM users WHERE user_id = '" . trim($_POST[email]) . "' LIMIT 1")) ) {
					$error[email] = "That e-mail address already exists";
					$error[forgot] = "Did you forget your password?";
				} else {
					
				}
			}*/
			
			
		}
	} else { // "I AM A NEW CUSTOMER" -->
		
		// IF EMAIL --> CHECK IF EMAIL EXISTS
		if ( mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE email = '" . db_escape(trim($_POST[email])) . "' LIMIT 1")) ) {
			$error[email] = "The e-mail address already exists in our records"; 
			$note[forgot] = "Did you forget your password? <A HREF='forgot.php'>click here</A>"; // Did you forget your password // Need assistance with your password
			
			$checked[yes] = "CHECKED";
			
		} else {
			$checked[no] = "CHECKED";
		}
		
	}
	
	
////////// REGISTRATION CHECKING
} elseif ( $_POST[REGISTER] ) {
	////////// check names:
	// check for first name:
	if ( !$_POST[firstname] ) {
		$error[firstname] = TRUE;
	}
	
	// check for last name:
	if ( !$_POST[lastname] ) {
		$error[lastname] = TRUE;
	}// else {
		//$ln = ucfirst(strtolower(trim(addslashes($_POST[lastname]))));
	//}
	
	//echo "\$error[lastname] --> $error[lastname]<P>";
	
	////////// check emails match:
	if ( $_POST[email_confirm] && $_POST[email] != $_POST[email_confirm] ) {
		$error[email_confirm] = "the emails do not match";
	} elseif ( !$_POST[email_confirm] ) {
		$error[email_confirm] = TRUE;
	}
	
	////////// check something was entered and that no letters crept into the phone field:
	
	if ( eregi("[a-zA-Z]", $_POST[phone]) ) {
		$error[phone] = "please check the phone number";
	} elseif ( !eregi(".{10,}", $_POST[phone]) ) {
		$error[phone] = TRUE;
		
	}
	
	////////// check dob
	// check 'date of birth' fields have been filled in:
	if ( !$_POST[dob][month] || !$_POST[dob][day] || !$_POST[dob][year] ) {
		$error[dob] = TRUE;
	} else {
		$dob = $_POST[dob][year] . "-" . $_POST[dob][month] . "-" . $_POST[dob][day];
	}
	
	// check gender:
	if ( !$_POST[gender] ) {
		$error[gender] = TRUE;
	}
	
	////////// check passwords have been entered and they match:
	// check for password:
	if ( !$_POST[password] ) {
		$error[password] = TRUE;
	}// else {
	//	$npwd = trim($_POST[password]);
	//}
	
	// check if passwords match:
	if ( $_POST[password] != $_POST[password_confirm] ) {
		$error[password_confirm] = "passwords do not match";
	} elseif ( !$_POST[password_confirm] ) {
		$error[password_confirm] = TRUE;
	}
	
	// 
	if (!$error) {
		
		if ( mysqli_query($db, "INSERT INTO users SET 
					email = '" . db_escape($_POST[email]) . "',
					password = sha1('" . db_escape($_POST[password]) . "'),
					firstname = '" . db_escape(ucfirst(strtolower(trim($_POST[firstname])))) . "',
					lastname = '" . db_escape(ucfirst(strtolower(trim($_POST[lastname])))) . "',
					dob = '" . db_escape($dob) . "',
					gender = '" . db_escape($_POST[gender]) . "',
					phone = '" . db_escape($_POST[phone]) . "',
					reg_date = NOW()") ) {
			
			//$$CRYPT_USER_ID = $info[user_id]; session_register(CRYPT_USER_ID);
			//session_register(CRYPT_USER_ID,$info[user_id]);
			//session_register(id,$info[user_id]);
			//$_SESSION[CRYPT_USER_ID] = $info[user_id];
			
			//$_SESSION[ref_id] = mysqli_insert_id($db);
			//define('USER_ID',mysqli_insert_id($db));
			//$_SESSION[ref_id] = USER_ID;
			//$_SESSION[password] = sha1($_POST[password]);
			//$_COOKIE[auto] = $info[user_id] . " | " . sha1($_POST[password]);
			
			$info[ref_id] = mysqli_insert_id($db);
			$info[password] = sha1($_POST[password]);
			
			member_login($info);
			///cart_login();
			
			///header("Location:./" . return_on($_SERVER[QUERY_STRING], $_SERVER[QUERY_STRING]) );
			//header("Location:./" . return_on("?" . $_SERVER[QUERY_STRING], $_SERVER[QUERY_STRING]) . "");
			
		} else {
		// else error:
			$error[db] = "Sorry - query failed<P>" . mysqli_error($db);
			echo $sql . mysqli_error($db);
		}
	}// else {
	//	$error[db] .= "* Please correct the fields highlighted in red<br>";
	//}
}



// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0



echo "<TABLE BORDER=0 ALIGN=CENTER CELLSPACING=0 CELLPADDING=3 STYLE='color:" . COLOR_GRAY_DARK . ";'>
	<FORM METHOD=POST ACTION=" . $_SERVER[PHP_SELF] . "" . return_on("?" . $_SERVER[QUERY_STRING], $_SERVER[QUERY_STRING]) . ">";

//echo "<TR><TD HEIGHT=10>" . TRANSPARENT . "</TD></TR>";

if ( ($_POST[LOGIN] && !$error) || $_POST[REGISTER] ) {// || $_POST[AGREE] || $_POST[DISAGREE]
	
	
	/*if ( !$_SESSION[AGREE] ) {
		
		echo "<TR>
				<TD COLSPAN=2>" . html_title_text("Please Review our Conditions") . "</TD>
			</TR><TR>
				<TD COLSPAN=2>
					<TEXTAREA NAME=disclaimer ROWS=20 STYLE='width:450px;'>" . fnc_dislaimer() . "</TEXTAREA></TD>
			</TR>";
		
		
		echo "<TR>
				<TD COLSPAN=2 STYLE='padding-left:20px;'>" .  error_list($error) . "</TD>
			</TR>";
		
		
		echo "<TR>
				<TD></TD>
				<TD><INPUT TYPE=SUBMIT VALUE='AGREE' NAME=AGREE> <INPUT TYPE=SUBMIT VALUE='DISAGREE' NAME=DISAGREE></TD>
			</TR>";
			
		echo "<TR>
				<TD COLSPAN=2 STYLE='padding-left:20px;'>" .  return_array(NULL,$note,"<BR>") . "</TD>
			</TR>";
		
	} else {*/
		
		echo "<TR>
				<TD COLSPAN=2>" . html_title_text("Please take a moment to register") . "</TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[firstname],'first name') . "</TD>
				<TD><INPUT TYPE=TEXT NAME=firstname CLASS='form' VALUE=" . $_POST[firstname] . "></TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[lastname],'last name') . "</TD>
				<TD><INPUT TYPE=TEXT NAME=lastname CLASS='form' VALUE=" . $_POST[lastname] . "></TD>
			</TR><TR>
				<TD ALIGN=RIGHT>e-mail address</TD>
				<TD><INPUT TYPE=TEXT NAME=email CLASS='form' VALUE='" . $_POST[email] . "'></TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[email_confirm],'re-type e-mail') . "</TD>
				<TD><INPUT TYPE=TEXT NAME=email_confirm CLASS='form' VALUE='$_POST[email_confirm]'></TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[phone],'phone') . "</TD>
				<TD><INPUT TYPE=TEXT NAME=phone CLASS='form' VALUE='$_POST[phone]'></TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[dob],'date of birth') . "</TD>
				<TD COLSPAN=2>" . date_return_drop('dob', $_POST[dob][year], $_POST[dob][month], $_POST[dob][day], array('limit' => 18, 'location' => 10)) . "</TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[gender],'gender') . "</TD>
				<TD><INPUT TYPE=RADIO NAME=gender VALUE='m'" . 
					return_match($_POST[gender], 'm', 'checked') . "> male &#160 <INPUT TYPE=RADIO NAME=gender VALUE='f'"  . 
					return_match($_POST[gender], 'f', 'checked') . "> female </TD>
			</TR><TR>
				<TD COLSPAN=2></TD>
			</TR><TR>
				<TD COLSPAN=2>" . html_title_text("Secure your account with a password") . "</TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[password],'enter a new password') . "</TD>
				<TD><INPUT TYPE=PASSWORD NAME=password CLASS='form' VALUE='" . $_POST[password] . "'></TD>
			</TR><TR>
				<TD ALIGN=RIGHT>" . error_red($error[password_confirm],'re-type password') . "</TD>
				<TD><INPUT TYPE=PASSWORD NAME=password_confirm CLASS='form' VALUE='" . 
					($error[password_confirm] ? null : $_POST[password_confirm]) . "'></TD>
			</TR><TR>
				<TD COLSPAN=2> </TD>
			</TR>";
		
		/*
		<TR>
				<TD COLSPAN=2>" . html_title_text("How did you hear about us?") . "</TD>
			</TR><TR>
				<TD BGCOLOR=" . COLOR_GRAY_LIGHT . " COLSPAN=2 STYLE='padding-left:20px;border-top:thin solid;border-left:thin solid;border-right:thin solid;'>If you have a discount code, please enter it now</TD>
			</TR><TR>
				<TD ALIGN=RIGHT BGCOLOR=" . COLOR_GRAY_LIGHT . " STYLE='border-bottom:thin solid;border-left:thin solid;'>" . error_red($error[password],'discount code') . "</TD>
				<TD ALIGN=LEFT BGCOLOR=" . COLOR_GRAY_LIGHT . " STYLE='padding-top:4px;padding-bottom:4px;border-bottom:thin solid;border-right:thin solid;'>
					<INPUT TYPE=TEXT NAME=code CLASS='form' VALUE='" . $_POST[code] . "'></TD>
			</TR>
		*/
		
		echo "<TR>
				<TD COLSPAN=2 STYLE='padding-left:20px;'>" .  error_list($error) . "</TD>
			</TR>";
		
		
		echo "<TR>
				<TD></td>
				<TD><INPUT TYPE=SUBMIT VALUE='CONTINUE' NAME=REGISTER ID=submit2></TD>
			</TR>";
			
		echo "<TR>
				<TD COLSPAN=2 STYLE='padding-left:20px;'>" .  return_array(NULL,$note,"<BR>") . "</TD>
			</TR>";
	
	//}
	
	
	
} else {
	
	// IF DEFAULT RADIO CHECKED SETTING HAS NOT BEEN DEFINED ABOVE --> SET IT HERE
	if ( !$checked[no] && !$checked[yes] ) {
		
		if ( $_POST[have_password] == "no" ) {
			
			$checked[no] = "CHECKED";
		} else {
			
			$checked[yes] = "CHECKED";
		}
	}
	
	echo "<TR>
			<TD COLSPAN=2>" . html_title_text("What is your e-mail address?") . "</TD>
		</TR><TR>
			<TD COLSPAN=2>" . error_red($error[email],'e-mail address') . " <INPUT TYPE=TEXT NAME=email VALUE='$_POST[email]' STYLE='width:170px;'></TD>
		</TR><TR>
			<TD ALIGN=RIGHT><INPUT TYPE=RADIO NAME=have_password ID=have_password VALUE=no $checked[no]></TD>
			<TD>I am a new member and don't have a password</TD>
		</TR><TR>
			<TD ALIGN=RIGHT><INPUT TYPE=RADIO NAME=have_password ID=have_password VALUE=yes $checked[yes]></TD>
			<TD>" . error_red($error[pwd],'I have a password') . " <INPUT TYPE=PASSWORD NAME=password VALUE='$_POST[password]'></TD>
		</TR>";
	
	
	echo "<TR>
			<TD COLSPAN=2 STYLE='padding-left:20px;color:red;'>" . error_list($error) . "</TD>
		</TR>";
	
	
	echo "<TR>
			<TD HEIGHT=40></td>
			<TD><INPUT TYPE=SUBMIT VALUE='CONTINUE' NAME=LOGIN ID=submit></TD>
		</TR>";
		
	echo "<TR>
			<TD COLSPAN=2 STYLE='padding-left:20px;'>" .  return_array(NULL,$note,"<BR>") . "</TD>
		</TR>";
}

echo "</FORM>
	</TABLE>";


?>
