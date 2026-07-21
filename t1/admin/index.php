<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if ( !defined('ACCESS') ) die(ERROR_MESSAGE);



// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
////////// HEADER
define("TITLE","ADMIN: ". DOMAIN); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_header_admin.php");

echo "<H1>THIS IS THE ADMIN PAGE</H1>";
/*
$sql = "select * from users";
if ( !$query = mysqli_query($db, $sql) ) {
	echo mysqli_error($db);
} else {
	while ($info = mysqli_fetch_assoc($query)) {
		echo "{$info['firstname']}<P>";
	}
}
*/

		
		function local_navigation($title,$content,$width=400) {
	
	$colspan = 2;
	
	if ( count($content) > 0 ) {
		
		$return = "<TABLE BORDER=0 BORDERCOLOR=lightblue BGCOLOR=#CACABD WIDTH=". $width ." CELLPADDING=2 CELLSPACING=1>";
		
		if ( $title ) {
			$return .= "<TR>
				<TD BGCOLOR=#DDDDCC STYLE='color:black;'><B>". $title ."</B></TD>
			</TR>";
		}
		
		//dev_print($content);
		
		
		$return .= "<TR>
			<TD BGCOLOR=#FFFFFF STYLE='padding-bottom:20px;'>
				<TABLE BORDER=0 BORDERCOLOR=lightblue BGCOLOR=#FFFFFF WIDTH=100% CELLPADDING=0 CELLSPACING=0>";
		
		foreach( $content AS $value ) {
			
			
			if ( ${value}['0'] == "_" ) {
				
				if ( is_numeric($value['1']) ) { // VERTICAL SPACE
					$return .= "<TR>
						<TD COLSPAN=$colspan BGCOLOR=#FFFFFF HEIGHT=". ${value}['1'] ."></TD>
					</TR>";
					
				} else { // SUBTITLE
					
					// BE8000 275788 123351 72653A 5A5039
					
					$return .= "<TR>
						<TD COLSPAN=$colspan BGCOLOR=#FFFFFF STYLE='padding:10px;color:#5A5039;'><B>". ${value}['1'] ."</B></TD>
					</TR>";
				}
				
			//} elseif ( ${value}['0'] == "?" ) { // QUESTION
				
			} elseif ( ${value}['0'] == "~" ) { // text
				$return .= "<TR>
					<TD COLSPAN=$colspan BGCOLOR=#FFFFFF STYLE='padding:4px;color:#333333;'>". ${value}['1'] ."</TD>
				</TR>";
				
				
			} elseif ( ${value}['0'] == "-" ) {
				
				if ( is_numeric($value['1']) ) { // DIVIDER LINE (PERCENTAGE OF WIDTH)
					$return .= "<TR>
						<TD COLSPAN=$colspan BGCOLOR=#FFFFFF>
							<HR WIDTH=". ${value}['1'] ."% NOSHADE SIZE=1 COLOR=#DDDDDD></TD>
					</TR>";
					
				} else { // LIST LINK CONTENT
					
					
					//$temp = "<TD COLSPAN=1 BGCOLOR=#FFFFFF>". ${value}['1'] ."</TD>";
					
					$return .= "<TR>";
					
					$cell_count = NULL;
					
					foreach ( ${value}['1'] AS $features ) {
						
						if ( $cell_count == 2 ) {
							$cell_count = NULL;
							$return .= "</TR><TR>";
						}
						
						$return .= "<TD BGCOLOR=#FFFFFF WIDTH=50% COLSPAN=1 STYLE='padding-left:20px;'>
							<BIG><B>&#149</B></BIG> <A HREF='". ${features}['0'] ."'>". ${features}['1'] ."</A></TD>";
						
						$cell_count++;
					}
					
					$return .= "</TR>";
					
					//$return .= "<TR>
					//	<TD COLSPAN=1 BGCOLOR=#FFFFFF>". ${value}['1'] ."</TD>
					//</TR>";
					
					
				}
			}
			
			
		}
		$return .= "</TABLE>
				</TD>
			</TR>";
		
		
		$return .= "</TABLE>";
	}
	
	return $return;
	
}
	
	$nav[] = array("_","Product Management / Setup"); // SUBTITLE
	$nav[] = array("?","What would you like to do?"); // QUESTION
	$nav[] = array("-",array(	array("products/","<B>Product Index</B>"),
								array("products/products.php","Add Products"),
								array("categories.php","Categories"),
								array("features.php","Category Features"),
								array("swatches.php","Colors / Swatches"),
								array("materials.php","Materials"),
								array("bgcolors.php","BackGround Colors"),
								array("styles.php","Styles") )); // LIST LINK CONTENT
	$nav[] = array("-",98); // DIVIDER LINE (PERCENTAGE OF WIDTH)
	
	$nav[] = array("_","Website Configuration"); // SUBTITLE
	$nav[] = array("-",array(	array("accounts.php","Administrative Accounts"),
								array("","Assign Email addresses"),//emails.php
								array("","Activate / Deactivate Access"),//activation.php
								array("","Contact Administrator"),//contact.php
								array("policy.php","Website Policy") )); // LIST LINK CONTENT
	$nav[] = array("-",98); // DIVIDER LINE (PERCENTAGE OF WIDTH)
	
	$nav[] = array("_","Marketing"); // SUBTITLE
	$nav[] = array("-",array(	array("publications.php","Publications"),
								array("events.php","Events Gallery") )); // LIST LINK CONTENT
	$nav[] = array("-",98); // DIVIDER LINE (PERCENTAGE OF WIDTH)
	
	$nav[] = array("_","Website Development"); // SUBTITLE
	$nav[] = array("-",array(	array("comments.php","Website Comments"),
								array("questions.php","Questions"),
								array("todo.php","Todo List"),
								array("../phpMyAdmin","phpMyAdmin") )); // LIST LINK CONTENT
	
	//$website_management = local_navigation("Website Management",$nav); $nav = NULL;
	//echo "<br />". local_navigation("Website Management",$nav); $nav = NULL;
	
	if ( USER_STATUS >= 9 ) {
		
		$nav[] = array("_","Webmaster Administration"); // SUBTITLE
		$nav[] = array("-",array(	array("help_manager.php","Help Manager"),
									array("help_manager.php","phpinfo"),
									array("phpinfo.php","phpInfo") )); // LIST LINK CONTENT
		
	}
	
////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_footer.php");

?>
