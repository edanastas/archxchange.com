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


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(BASE_DIR . "_includes/inc_header.php");


// style='height:100%;vertical-align:middle;'

//include(BASE_DIR . "_includes/inc_login.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
echo "<BR><BR><BR><BR><TABLE BORDER=0 BORDERCOLOR=orange ALIGN=CENTER WIDTH=650 CELLPADDING=0 CELLSPACING=0 RULES=NONE>";


?>

<tr>
	<td style='color:white;padding:15px;border:dotted black 1px;background-color:gray;text-align:center;'>
		<!--<img src='images/axc_promotion_01.png' class='packageSale'>-->
		<h2 style='color:white;'>Thank You for registering for our Hosting Services.</h2></h3> An email has been sent with a copy of the instructions listed below.</h3></td>
</tr><tr style=''>
	<td>
		<div style='padding:20px;'>
			<h2>Instructions</h2>
			<h3 style='color:gray;'>
				<ol style='padding-left:60px;'>
					<li class='spacer'>Continue to your registrars management website and set the DNS information as follows.
						<ul style='list-style:none;padding:10px;'>
							<li>DNS1: ns1.archxchange.com</li>
							<li>DNS2: ns2.archxchange.com</li>
						</ul>
						This will direct all internet traffic to our servers where your projects will be managed.
					</li>
					<li class='spacer'>Wait for the propagation of your domain. In some cases this can take a matter of minutes but in others it can take as long as 3 days. An ip address for your domain will be emailed to you once your account server allocation is setup (usually with 24 hours).</li>
					<li class='spacer'>Once the propagation has completed you will be able to login with the account information that you provided by logging into your account management with the following format http://www.[YOUR DOMAIN]/admin</li>
					<li class='spacer'>Once you have setup your account and begin to add your projects your potential clients can have access to your most updated projects immediately.</li>
					<li class='spacer'>You can continue your trial period of your account for 15 days.</li>
				</ol>
			</h3>
		</div>
	</td>
</tr><!--<tr>
	<td align=center colspan=3>
		<div style=''><input type=submit name=continue value='Continue...'></div></td>
</tr>-->


<?php

/////////////////////////////////////////////////////////////////////////////////////
////////// END BODY
//echo form_table_end();
echo "</TABLE>";
echo "</FORM>";






////////// CHECK VARIABLES
/////////////////////////////////////////////////////////////////////////////////////
//-- echo "<B>\$error</B><BR>"; dev_print($error);
//-- echo "<B>\$_REQUEST</B><BR>"; dev_print($_REQUEST);



////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(BASE_DIR . "_includes/inc_footer.php");

?>
