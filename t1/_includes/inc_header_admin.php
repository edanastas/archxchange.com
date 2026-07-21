<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if (!defined('ACCESS')) die(ERROR_MESSAGE);
/*if ( !defined('ACCESS') ) {
	
	$redirect_message = "There was an error accessing the page (" . __FILE__ . ").";
	$redirect_url = "http://" . DOMAIN . "";
	
	$error = array("error" => $redirect_message, // ERROR MESSAGE
		"timer" => "2", // TIMER BEFORE REDIRECTING
		"url" => $redirect_url); // IF NO LOCATION SPECIFIED THEN GOES BACK ONE
	html_error($error);

}*/


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0


////////// HTML HEAD
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_head.php");

foreach ( array("index"=>"./",
	"projects"=>"projects.php",
	"test"=>"test.php",
	"phpInfo"=>"phpinfo.php",
	"phpMyAdmin"=>(LOCAL ? "http://concord.local/phpMyAdmin-2.6.2/" : "http://www.archxchange.com:2082/3rdparty/phpMyAdmin/index.php")) AS $key => $value ) {
	//http://www.archxchange.com:2082/3rdparty/phpMyAdmin/index.php
	$links[] = "<a href='". $value ."' class='header'>". $key ."</a>";
}



////////// BODY
/////////////////////////////////////////////////////////////////////////////////////
//echo "<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>\n\n";
echo "<div id='header'>
	
<STYLE TYPE=\"text/css\">
	<!--
	
a.header,a.header:link,a.header:visited,a.header:active {
	/*
	text-transform:uppercase;
	background-color:white;
	font-weight:700;
	color:#5EA936;
	
	
	background-color:white;
	padding:0px 2px 1px 2px;
	text-decoration:underline;
	*/
	background-color:#004c91;
	color:#ffffff;
	text-decoration:none;
	padding:4px 12px 4px 12px;
}

a.header:hover {
	/*
	display:block;
	text-decoration:underline;
	color:white;
	padding:4px 12px 4px 12px;
	background-color:white;
	
	
	background-color:#2A6EAC;
	*/
	
	
	background-color:#ffffff;
	color:#004c91;
	text-decoration:none;
}

	div.headerNav {
		/*
		font-family:Zapf-Chancery,Cursive;
		padding-left:20px;
		padding-right:140px;
		border:dashed 1px gray;
		background:#E6E6E6;
		text-align:center;
		padding-left:80px;
		padding-right:80px;
		font-size:15px;
		font-weight:bold;
		line-height:1.1;
		height:20px;
		display:block;
		padding:10px;
		*/
		width:100%;
		background-color:#004c91;
		border:solid 1px gray;
		padding:5px 0px 5px 0px;
		
	}
	
	div.headerNavLocal {
		/*
		background-image: url('logo.png');
		*/
		background-image:url('". TEMPLATE_DOMAIN ."_images/bg_header_admin.gif');
		width:100%;
		height:100px;
		background-color:#fff;
		border-left:solid 1px gray;
		border-right:solid 1px gray;
		border-bottom:solid 1px gray;
		padding:0px;
		text-align:center;
		color:#999;
	}
	-->
</STYLE>

	<div class='headerNav'>". implode("",$links) ."</div>";

function local_admin_nav($links) {
	
	if ( is_array($links) ) {
		$return = "<table border=0 width=100% align=center bordercolor=pink cellpadding=2 cellspacing=0>
			<tr>";
			
			foreach ( $links AS $value ) {
				$return .= "<td align=center>
					<a href='". ${value}['url'] ."' style='' ". ({$value['onclick']}?"onclick=\"". ${value}['onclick'] ."\"":null) .">
						". ({$value['icon']} ? "<img height=30 border=0 src='". TEMPLATE_DOMAIN . ${value}['icon'] ."'>" : null) ."<br />
						". ${value}['anchor'] ."</a></td>";
			}
			
			$return .= "</tr>
		</table>";
	} else $return = "no array values sent";
	
	return $return;
	
}



echo "
<STYLE TYPE=\"text/css\">
	<!--
	
	-->
</STYLE>

	<div class='headerNavLocal'>
		<table border=0 width=100% height=100% bordercolor=orange cellpadding=0 cellspacing=0 background='". TEMPLATE_DOMAIN ."bg_header_admin.gif'>
			<tr>
				<td align=center width=33%>
					<h3 style='padding:4px;'>Project Management</h3>". 
					local_admin_nav(array(
						array(
							url=>"project.php",
							anchor=>"project info",
							icon=>"_images/icon_info.png"),
						array(
							url=>"project_images.php",
							anchor=>"images",
							icon=>"_images/icon_camera.png"),
						array(
							url=>"projects.php",
							anchor=>"project browser",
							icon=>"_images/icon_search.png")
					)) ."</td>
				<td align=center width=33% style='border-left:1px solid gray;border-right:1px solid gray;'>
					<h3 style='padding:4px;'>Website Setup</h3>". 
					
					local_admin_nav(array(
						array(
							url=>"departments.php",
							anchor=>"departments",
							icon=>"_images/icon_departments.png"),
						array(
							url=>"categories.php",
							anchor=>"categories",
							icon=>"_images/icon_report.png"),
						array(
							url=>"#", //contacts.php
							anchor=>"contacts",
							icon=>"_images/icon_account.png",
							//icon=>"_images/icon_contact_arrow_up.png",
							//onclick=>"new Effect.BlindDown('adminContacts');")
							//onclick=>"new Effect.SlideUpAndDown('adminSetup');")
							onclick=>"new Effect.BlindUp('adminSetup',{ afterFinish:Effect.BlindDown('adminContacts') });")
					))
					
					//position:absolute;top:0px;s
					
					."</td>
				<td align=center width=33%>
					<h3 style='padding:4px;'>Account Settings</h3>". 
					local_admin_nav(array(
						array(
							url=>"accounts.php",
							anchor=>"accounts",
							icon=>"_images/icon_team.png"),
						array(
							url=>"tickets.php",
							anchor=>"trouble tickets",
							icon=>"_images/icon_chat.png"),
						array(
							url=>"preferences.php",
							anchor=>"more...",
							icon=>"_images/icon_continue.png")
					)) ."</td>
			</tr>
		</table>
		
	</div>
	
	
	
</div>
<br />
<div id='content'>";

/*
". 
					local_navigation(array(
						array(
							url=>"departments.php",
							anchor=>"departments",
							icon=>"_images/icon_team.png")
					)) ."
					*/

////////// CONTINUE TO BODY -->

?>
