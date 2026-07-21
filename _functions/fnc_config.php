<?php





		function config_redirect_set() { // SET REDIRECT VALUE
	if ( ${_SESSION}['config_redirect'] == '' || !$_SESSION['config_redirect'] ) {
		//$_SESSION['redirect'] = "http://" . ${_SERVER}['HTTP_HOST'] . ${_SERVER}['REQUEST_URI'] . ($_SERVER['QUERY_STRING'] ? "?" . ${_SERVER}['QUERY_STRING'] : NULL);
		//$_SESSION['redirect'] = ${_SERVER}['SCRIPT_URI'] . ($_SERVER['QUERY_STRING'] ? "?" . ${_SERVER}['QUERY_STRING'] : NULL);
		
		// THIS SETTING WORKS FOR THE SERVER
		${_SESSION}['config_redirect'] = "http://" . (LOCAL ? "concord.local" : ${_SERVER}['HTTP_HOST']) . ${_SERVER}['REQUEST_URI'];
		//echo "setting the redirect session var to (http://" . ${_SERVER}['SERVER_NAME'] . ${_SERVER}['REQUEST_URI'] . ")<BR>";
		
		//echo "redirect --> " . ${_SERVER}['SCRIPT_URI'] . ($_SERVER['QUERY_STRING'] ? "?" . ${_SERVER}['QUERY_STRING'] : NULL) . "<P>";
		//echo "\${_SESSION}['redirect'] --> ${_SESSION}['redirect']<P>";
		// EXAMPLE: http://www.domain.com/path/file.php?query_string=some_value
	}
}
/**** END FUNCTION ****/





		function config_redirect() { // REDIRECT
	if ( ${_SESSION}['config_redirect'] ) {
		$temp = ${_SESSION}['config_redirect']; // SET TEMP TO RESET SESSION REDIRECT
		${_SESSION}['config_redirect'] = NULL; // UNSET SESSION REDIRECT
		
		//echo "we are redirecting \${_SESSION}['redirect'] --> " . ${_SESSION}['redirect'] . "<P>";exit;
		header("Location:" . $temp ); // REDIRECT
		exit;
	} else {
		header("Location:./");
	}
}
/**** END FUNCTION ****/





		function config_user($info) { // DEFINE USER INFO
	
	////////// DEFINE SESSION VARIABLES
	/////////////////////////////////////////////////////////////////////////////////////
	if ( ${info}['user_id'] ) {
		define('USER_ID', ${info}['user_id']); // USER_ID
		define('USER_EMAIL', strtolower($info['email'])); // EMAIL
		define('USER_LANG', ${info}['language_code']); // LANGUAGE_CODE
		define('USER_FIRSTNAME', stripslashes($info['firstname'])); // FIRSTNAME
		define('USER_LASTNAME', stripslashes($info['lastname'])); // LASTNAME
	} else {
		define('USER_ID', NULL); // USER_ID
		define('USER_EMAIL', NULL); // EMAIL
		define('USER_LANG', NULL); // LANGUAGE_CODE
		define('USER_FIRSTNAME', NULL); // FIRSTNAME
		define('USER_LASTNAME', NULL); // LASTNAME
	}
}
/**** END FUNCTION ****/






/*		function config_die($redirect,$alert=NULL,$sql=NULL) { // REDIRECTS WITH PRETTY MESSAGE
	
	//if ( !preg_match("/cron/i",$_SERVER['PHP_SELF'] ) ) {
	if ( !defined('CRON') ) {
			
		
		if (!$redirect['url']) {
			if ( preg_match("/" . preg_quote($_SERVER['HTTP_HOST'], "/") . "/i", ${_SERVER}['HTTP_REFERER']) ) { // IF NOT OUR WEBSITE --> DO NOT GO BACK ONE (GO TO HOME PAGE)
				${redirect}['url'] = "javascript:history.back(1)";
			} else {
				${redirect}['url'] = "http://" . ${_SERVER}['HTTP_HOST'] . "";
			}
		}
		
		if (!$redirect['timer']) ${redirect}['timer'] = "0";
		
		if (!$redirect['redirecting']) {
			${redirect}['redirecting'] = trans("redirecting",1) ."...";
		} else {
			${redirect}['redirecting'] .= "...";
		}
		
		if (!$redirect['anchor']) ${redirect}['anchor'] = "click here to redirect manually";
		
		
		if ( !headers_sent() ) {
			echo "<HTML>
			<HEAD>
				<TITLE>". ( defined('TITLE') ? TITLE : DOMAIN ." - Undergoing Maintenance!" ) ."</TITLE>
					<META HTTP-EQUIV='refresh' CONTENT='". (int) ${redirect}['timer'] .";URL=". ${redirect}['url'] ."'>
					<LINK REL=stylesheet HREF='" . TEMPLATE_DOMAIN . "styles.css' TYPE='text/css'></LINK>
			</HEAD>
			
			<BODY BGCOLOR=WHITE>
			<TABLE BORDER=0 WIDTH=100% HEIGHT=70% ALIGN=CENTER VALIGN=CENTER CELLPADDING=0 CELLSPACING=0><TR>
				<TD ALIGN=CENTER VALIGN=CENTER>";
					
					//<IMG SRC='" . TEMPLATE_BASE_DIR . "images/header_text_" . IMAGE_HEADER_01 . ".gif'>
					// INSERT VISIBLE TABLE
					echo "<TABLE BORDER=0 CELLPADDING=1 CELLSPACING=1 BGCOLOR=". COLOR_GRAY .">
						<TR><TD BGCOLOR=". COLOR_BACKGROUND ." STYLE='border:solid 777777 1px;'><!-- COULD NOT GET BGCOLOR 555555 TO WORK ON PC -->
							<TABLE BORDER=0 WIDTH=500 CELLPADDING=4 CELLSPACING=0 RULES=NONE BGCOLOR=FFFFFF STYLE='padding:20px'>
								<TR>
									<TD ALIGN=CENTER STYLE='padding-bottom:20px;'>
										<IMG SRC='" . TEMPLATE_BASE_DIR . "images/header_text_" . IMAGE_HEADER_01 . ".gif'></TD>
								</TR><TR>
									<TD ALIGN=LEFT VALIGN=CENTER STYLE='padding-left:80px;color:777777;'>
										<I>". ${redirect}['redirecting'] ."</I>
											". TRANSPARENT ."</TD>
								</TR><TR>
									<TD ALIGN=CENTER VALIGN=BOTTOM>
										<FONT COLOR=RED><B><I><BIG>". ${redirect}['message'] ."</BIG></I></B></FONT>
											</TD>
								</TR><TR>
									<TD ALIGN=RIGHT VALIGN=TOP STYLE='padding-top:10px;padding-right:80px;'>". TRANSPARENT ."
										<A HREF='". ${redirect}['url'] ."'><I>(". ${redirect}['anchor'] .")</I></A>
											</FONT></TD>
								</TR><TR>
									<TD HEIGHT=40></TD>
								</TR>
							</TABLE>
						</TD>
					</TR></TABLE>
				</TD>
			</TR></TABLE>
			
			</BODY>
			</HTML>";
			
		} else {
			echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=". ${redirect}['url'] ."'>".
				"$redirect['message']<BR>".
				"<A HREF='". ${redirect}['url'] ."'>". ${redirect}['anchor'] ."</A>";
			
		}
		
		
	}
	
	if ( $alert && $disabled ) {
		
		$div = "----------------------------\n";
		
		mail(EMAIL_EMERGENCY,"DEMESSI! - ". ${_SERVER}['HTTP_HOST'],$alert);
		mail("admin@demessi.com",
			"POTENTIAL ATTACK!!",
			$alert .
			$div .
				"USER_ID --> ". USER_ID ."\n". 
				"USER_EMAIL --> ". USER_EMAIL ."\n". 
				"USER_FIRSTNAME --> ". USER_FIRSTNAME ."\n". 
				"USER_LASTNAME --> ". USER_LASTNAME ."\n". 
				"DOMAIN --> ". DOMAIN ."\n". 
			$div ."\$sql -->\n\n". 
				$sql ."\n\n". 
			$div ."\$_SERVER -->\n\n". 
				var_export($_SERVER,1) ."\n\n".
			$div ."debug_backtrace() -->\n\n". 
				var_export(debug_backtrace(),1) ."\n\n".
			$div ."\$_REQUEST -->\n\n". 
				var_export($_REQUEST,1) ."\n\n".
			$div ."\$_SESSION -->\n\n". 
				var_export($_SESSION,1) ."");
	}
	
	exit();
	
	
}
/**** END FUNCTION ****/






/*		function config_die($messsage) {
	
	
	
	echo "<HTML>
		<HEAD>
			<TITLE>". DOMAIN ." - Undergoing Maintenance!</TITLE>
			<META HTTP-EQUIV='refresh' CONTENT='". (int) ${redirect}['timer'] .";URL=". ${redirect}['url'] ."'>
			<LINK REL=stylesheet HREF='" . TEMPLATE_DOMAIN . "styles.css' TYPE='text/css'></LINK>
		</HEAD>
	<BODY>
		<TABLE BORDER=0 WIDTH=100% HEIGHT=70% CELLPADDING=0 CELLSPACING=0>
			<TR>
				<TD ALIGN=CENTER VALIGN=CENTER>
					
					<IMG WIDTH=1 HEIGHT=1 SRC='" . TEMPLATE_DOMAIN . "images/header_text_" . IMAGE_HEADER_01 . ".gif'><P>
					
					
					
					</TD>
			</TR>
		</TABLE>
	</BODY>";
	
}
/**** END FUNCTION ****/






/*		function config_ XXX() {
	
}
/**** END FUNCTION ****/



?>
