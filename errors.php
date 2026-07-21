<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", NULL); // see config.php for settings

define("TEMPLATE_BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(TEMPLATE_BASE_DIR . "config.php"); // _functions/fnc.php



// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0



// VARIABLES ////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
//define("TITLE","ERROR MANAGER"); // PAGE TITLE
$mode = "7"; ${header}['mode'] = $mode; ////////// MODE guest(0) member(1) admin(7-9)

if ( ${_POST}['CHANGE_SETTINGS'] ) {
	${_SESSION}['limit'] = ${_POST}['limit'];
	${_SESSION}['saved'] = ${_POST}['saved'];
}

// LEVEL COLOR CODING KEY
$level = array("lightgray","EEFF93","FFBF1A","FF6F09","FF2A00");
$border = "solid gray 1px";
$border_left = "border-left:$border;border-top:$border;border-bottom:$border;padding-left:6px;";
$border_right = "border-right:$border;border-top:$border;border-bottom:$border;padding-right:6px;";

$divider = "<TR>
		<TD></TD>
		<TD COLSPAN=2 STYLE='padding-bottom:4px;'>
			<HR SIZE=1 COLOR=DDDDDD></TD>
	</TR>";

if ( is_array($_POST['error']) ) {
	foreach ( array_keys($_POST['error']) AS $sql_error_id ) {
		$sql_error_ids[] .= "template_errors.error_id = '". $sql_error_id ."'";
	}
	
	//$sql_errors = implode(" OR ", $sql_error_ids) ." LIMIT ". count($_POST['error'];
	
}



// MODIFY DATABASES /////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( ${_POST}['DELETE'] ) {
	
	$sql = "DELETE FROM template_errors WHERE error_id = '". ${_POST}['CRYPT_REF_ID'] ."' LIMIT 1";
	if ( !mysqli_query($db, $sql) ) {
		
		error("could not delete error log entry",$sql,NULL);
	}
} elseif ( ${_POST}['DELETE_SELECTED'] || ${_POST}['SAVE_SELECTED'] || ${_POST}['UNSAVE_SELECTED'] ) {
	
	if ( ${_POST}['DELETE_SELECTED'] ) {
		$action = "DELETE FROM";
		//$sql = "DELETE FROM template_errors WHERE ". implode(" OR ", $sql_error_ids) ." LIMIT ". count($_POST['error']);
	} else {
		$action = "UPDATE";
		
		$set = " SET saved = ". ( ${_POST}['SAVE_SELECTED'] ? 1 : "NULL" );
		//$sql = "UPDATE template_errors SET saved = 1 WHERE ". implode(" OR ", $sql_error_ids) ." LIMIT ". count($_POST['error']);
	}
	
	if ( is_array($sql_error_ids) ) {
		$sql = $action ." template_errors ". $set ." WHERE ". implode(" OR ", $sql_error_ids) ." LIMIT ". count($_POST['error']);
		if ( !mysqli_query($db, $sql) ) {
			error("could not delete error log entry",$sql,NULL);
		}
	}
	
} elseif ( ${_POST}['DELETE_ALL'] && ${_POST}['CRYPT_REF_ID'] ) {
	
	//$query
	//$_POST['error_id']
	
	$query = mysqli_query($db, "SELECT * FROM template_errors 
		WHERE error_id = '". ${_POST}['CRYPT_REF_ID'] ."' LIMIT 1");
	
	if ( $info = mysqli_fetch_assoc($query) ) {
		$sql = "DELETE FROM template_errors WHERE file = '". ${info}['file'] ."' AND line = '". ${info}['line'] ."' AND saved IS NULL";
		if ( !mysqli_query($db, $sql) ) {
			error("there was an error trying to delete all errors like error_id ". ${_POST}['CRYPT_REF_ID'],$sql,NULL);
		}
	}
	
}


// HTML /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");



echo "<TABLE ALIGN=LEFT BORDER=0 CELLPADDING=4 CELLSPACING=0 WIDTH='100%'>
	<TR><TD>";

  
echo "<SCRIPT LANGUAGE=\"javascript\">
<!--
function CheckAll() {
count = document.errors.elements.length;
	for (i=0; i < count; i++) {
		if(document.errors.elements[i].checked == 1) {
			document.errors.elements[i].checked = 0;
		} else {
			document.errors.elements[i].checked = 1;
		}
	}
}
-->
</SCRIPT>";

////////// CHECK VARS 
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

$query = mysqli_query($db, "SELECT template_errors.*, template_errors.error AS message,
	DATE_FORMAT(template_errors.stamp,'%W - %b. %d - %r') AS stamp 
	FROM template_errors 
	WHERE 1 ".
	( ${_GET}['CRYPT_REF_ID'] ? "AND template_errors.error_id = '". ${_GET}['CRYPT_REF_ID'] ."'" : NULL ) .
		//( ${_POST}['error'] ? " WHERE ". implode(" OR ", $sql_error_ids) ." LIMIT ". count($_POST['error']) : NULL ) ) ." ".
	( ${_SESSION}['saved'] ? "AND saved IS NOT NULL " : "AND saved IS NULL " ) .
	"ORDER BY template_errors.error_id DESC LIMIT ". ( ${_SESSION}['limit'] ? ${_SESSION}['limit'] : 10 ));

echo "<META HTTP-EQUIV='REFRESH' CONTENT='". (60*15) ."; URL=" . ${_SERVER}['PHP_SELF'] . "'>";



echo "<TABLE BORDER=0 BORDERCOLOR=olive ALIGN=CENTER WIDTH=98% CELLPADDING=4 CELLSPACING=0>";


if ( ${_GET}['CRYPT_REF_ID'] ) {
	
	if ( !$info = mysqli_fetch_assoc($query) ) {
		echo mysqli_error($db);
	}
	
	// TITLE
	echo "<TR>
		<TD></TD>
		<TD VALIGN=CENTER HEIGHT=40 COLSPAN=2 STYLE='padding:10px;'><B>ERROR DETAILS</B></TD>
	</TR>";
	
	// ERROR DETAILS
	echo "<TR>
		<TD></TD>
		<TD COLSPAN=2 STYLE='padding-left:0px;padding-bottom:6px;'>";
		
		echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0>
			<TR>";
				foreach ( $level AS $bgkey => $bgcolor ) {
					echo "<TD ALIGN=CENTER VALIGN=CENTER WIDTH=40 HEIGHT=15 STYLE='background-color:". $bgcolor .";". 
						( $bgkey == ${info}['level'] ? "border:solid black 2px;" : "border:solid white 2px;" ) ."'></TD>"; //". (int) $bgkey ."
				}
			echo "</TR>
		</TABLE>";
		
		echo "</TD>
	</TR>";
	
	/*
	<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>error_id</TD>
		<TD>{$info['error_id']</TD>
		<TD>{$info['stamp']</TD>
	</TR>
	*/
	echo "<TR>
		<TD ALIGN=RIGHT> 
			</TD>
		<TD STYLE='". $border_left ."background-color:". COLOR_GRAY_LIGHT .";'>
			<B>{$info['error_id']</B></TD>
		<TD ALIGN=RIGHT STYLE='". $border_right ."background-color:". COLOR_GRAY_LIGHT .";'>
			${info}['stamp']</TD>
	</TR>";
	
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>user</TD>
		<TD COLSPAN=2>{$info['user_id']</TD>
	</TR>";
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>domain</TD>
		<TD>{$info['domain']</TD>
	</TR>";
	
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>reference</TD>
		<TD COLSPAN=2>
			file: ${info}['file'] [". ${info}['line'] ."] &#160 / &#160 
			filename: ". ({$info['filename'] ? ${info}['filename'] : "- - - -" ) ." &#160 / &#160 
			function: ". ${info}['fnc'] ."()</TD>
	</TR>";
	
	echo $divider;
	
	/*
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>user_id</TD>
		<TD>{$info['user_id']</TD>
	</TR>";
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>function</TD>
		<TD>". ${info}['fnc'] ."()</TD>
	</TR>";
	*/
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>error</TD>
		<TD COLSPAN=2>". nl2br({$info['message']) ."</TD>
	</TR>";
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>mysql_error</TD>
		<TD COLSPAN=2>". nl2br({$info['error_mysql']) ."</TD>
	</TR>";
	
	
	$rows = ceil(strlen({$info['sql'])/40);
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>sql</TD>
		<TD CLASS='TextGrayDark' COLSPAN=2>
			<TEXTAREA ROWS=". ($rows > 40 ? 40 : $rows) ." STYLE='width:100%;'>". ${info}['sql'] ."</TEXTAREA>
		</TD>
	</TR>";
	
	if ( ${info}['mysql'] ) {
		
		echo "<TR>
			<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>mysql_error</TD>
			<TD COLSPAN=2 STYLE='color:red;'><B>". ${info}['mysql'] ."</B></TD>
		</TR>";
	}
	
	echo $divider;
	
	$sql = "SELECT * FROM template_errors WHERE file = '". ${info}['file'] ."' AND line = '". ${info}['line'] ."' AND saved IS NULL";
	$query = mysqli_query($db, $sql);
	$total_errors = mysqli_num_rows($query);
	if ( $total_errors > 1 ) {
		${insert}['delete_all'] = "<INPUT TYPE=SUBMIT NAME=DELETE_ALL VALUE='DELETE ALL $total_errors UNSAVED ERRORS'>";
	}
	
	echo "<TR>
		<TD></TD>
		<TD>
			<FORM ACTION='". ${_SERVER}['PHP_SELF'] ."' METHOD=POST>
			<INPUT TYPE=HIDDEN NAME=". CRYPT_REF_ID ." VALUE='". ${_GET}['CRYPT_REF_ID'] ."'> 
			<INPUT TYPE=SUBMIT NAME=DELETE VALUE='DELETE ERROR'> &#160 
			<INPUT TYPE=SUBMIT NAME=CANCEL VALUE='CANCEL'></TD>
		<TD ALIGN=RIGHT STYLE='padding-right:40px;'>".
			${insert}['delete_all'] .
			"</FORM></TD>
	</TR>";
	
	
	echo $divider;
	
	foreach( array("debug","posted","server","requested","session") AS $var ) {
		
		/*
		echo "<TR>
			<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>". $var ."</TD>
			<TD COLSPAN=2 ALIGN=LEFT><SMALL>". dev_print(unserialize($info[$var])) ."</SMALL></TD>
		</TR>";
		*/
		
		$rows = substr_count($info[$var],"\n");
		echo "<TR>
			<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>". $var ."</TD>
			<TD COLSPAN=2>
				<TEXTAREA ROWS=". ($rows > 40 ? 40 : $rows) ." STYLE='width:100%;'>". $info[$var] ."</TEXTAREA>
			</TD>
		</TR>";
	}
	
	/*
			<TD COLSPAN=2><SMALL><TT>". preg_replace("/  /i","&#160",nl2br($info[$var])) ."</TT></SMALL></TD>
			
			
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>session</TD>
		<TD COLSPAN=2><SMALL>". nl2br({$info['session']) ."</SMALL></TD>
	</TR>";
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>requested</TD>
		<TD COLSPAN=2><SMALL>". nl2br({$info['requested']) ."</SMALL></TD>
	</TR>";
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>posted</TD>
		<TD COLSPAN=2><SMALL>". nl2br({$info['posted']) ."</SMALL></TD>
	</TR>";
	
	echo "<TR>
		<TD ALIGN=RIGHT VALIGN=TOP CLASS='TextGrayDark'>server</TD>
		<TD COLSPAN=2><SMALL>". nl2br({$info['server']) ."</SMALL></TD>
	</TR>";
	*/
	
	/*
	echo "<TR>
		<TD></TD>
		<TD VALIGN=CENTER HEIGHT=40 COLSPAN=2>";
		
		//dev_print($info);
		
		echo "</TD>
	</TR>";
	*/
	
	
	
	
} else {
	
	
	
	${insert}['submit'] = "<TR>
		<TD></TD>
		<TD VALIGN=CENTER HEIGHT=40>". 
			( ${_SESSION}['saved'] ? 
				"<INPUT TYPE=SUBMIT NAME=UNSAVE_SELECTED VALUE='UNSAVE SELECTED'>" : 
				"<INPUT TYPE=SUBMIT NAME=SAVE_SELECTED VALUE='SAVE SELECTED'>") .
			" &#160 &#160 <INPUT TYPE='button' onclick='CheckAll()' VALUE='TOGGLE CHECKS'>
			<!--<INPUT TYPE=SUBMIT NAME=VIEW VALUE='VIEW SELECTED'>--></TD>
		<TD ALIGN=RIGHT STYLE='padding-right:40px;'>". 
			( ${_SESSION}['saved'] && $disabled ? NULL : 
				"<INPUT TYPE=SUBMIT NAME=DELETE_SELECTED VALUE='DELETE SELECTED'>") .
			"</TD>
	</TR>";
	
	
	
	// TITLE
	echo "<TR>
		<TD></TD>
		<TD VALIGN=CENTER HEIGHT=40 COLSPAN=2><B>ERROR LOG</B></TD>
	</TR>";
	
	
	// DISPLAY COUNT SETTING
	echo "<TR>
		<TD></TD>
		<TD VALIGN=CENTER HEIGHT=40 COLSPAN=2>
			<FORM ACTION='". ${_SERVER}['PHP_SELF'] ."' METHOD=POST>
			<SELECT NAME=limit onchange=submit()> ";
				
				foreach ( array(10,20,50,100) AS $display ) {
					echo "<OPTION VALUE='$display'". ( ${_SESSION}['limit'] == $display ? " SELECTED" : NULL ) .">$display</OPTION>";
				}
				
			echo "</SELECT> &#160 
				<INPUT TYPE=CHECKBOX NAME=saved VALUE=1 onclick=submit()". ( ${_SESSION}['saved'] ? " CHECKED" : NULL ) ."> check to view saved errors
				<INPUT TYPE=HIDDEN NAME=CHANGE_SETTINGS VALUE=1>
			</FORM></TD>
	</TR>";
	
	
	if ( mysqli_num_rows($query) > 0 ) {
		
		// START FORM
		echo "<FORM ACTION=". ${_SERVER}['PHP_SELF'] ." NAME=errors METHOD=POST>";
		
		echo ${insert}['submit'];
		
		while ( $info = mysqli_fetch_assoc($query) ) {
			// CLASS='TextGrayDark'
			
			
			echo "<TR>
				<TD ALIGN=RIGHT STYLE='background-color:". $level[(int) ${info}['level']] .";'> 
					<INPUT TYPE=CHECKBOX NAME=error[{$info['error_id']]></TD>
				<TD STYLE='". $border_left ."background-color:". COLOR_GRAY_LIGHT .";'>
					${info}['error_id'] - ${info}['file'] ({$info['line'])</TD>
				<TD ALIGN=RIGHT STYLE='". $border_right ."background-color:". COLOR_GRAY_LIGHT .";'>
					${info}['stamp']</TD>
			</TR><TR>
				<TD></TD>
				<TD COLSPAN=2>
					<A HREF='". ${_SERVER}['PHP_SELF'] ."?". CRYPT_REF_ID ."={$info['error_id']}'>{$info['message']</A></TD>
			</TR>";
			
			/*
			echo "<TR>
				<TD>
					<INPUT TYPE=CHECKBOX NAME=error[{$info['error_id']]></TD>
				<TD COLSPAN=2>
					<A HREF='". ${_SERVER}['PHP_SELF'] ."?". CRYPT_REF_ID ."={$info['error_id']}'>{$info['error_id'] - ${info}['message']</A></TD>
			</TR><TR CLASS='TextGrayDark'>
				<TD ALIGN=RIGHT></TD>
				<TD>{$info['file'] ({$info['line'])</TD>
				<TD ALIGN=RIGHT>{$info['stamp']</TD>
			</TR>";
			*/
			
			if ( ${info}['sql'] ) {
				$rows = ceil(strlen({$info['sql'])/40);
				echo "<TR>
					<TD></TD>
					<TD COLSPAN=2 CLASS='TextGray'>
						<TEXTAREA ROWS=". ($rows > 40 ? 40 : $rows) ." STYLE='width:100%;'>". ${info}['sql'] ."</TEXTAREA></TD>
				</TR>";
			}
			
			if ( ${info}['mysql'] ) {
				
				echo "<TR>
					<TD></TD>
					<TD COLSPAN=2 STYLE='color:red;'>". ${info}['mysql'] ."</TD>
				</TR>";
			}
			
			
			echo "<TR>
				<TD></TD>
				<TD COLSPAN=2 STYLE='padding-bottom:4px;'>
					<!-- <HR SIZE=1> --></TD>
			</TR>";
			
		}
		
		echo ${insert}['submit'];
		
	} else {
		
		echo "<TR>
			<TD></TD>
			<TD COLSPAN=2 STYLE='padding-bottom:4px;'>
				THERE ARE NO ". ( ${_SESSION}['saved'] ? "SAVED" : NULL ) ." ERRORS</TD>
		</TR>";
	}
	
}




echo "</FORM>";
echo "</TABLE>";



echo "</TD></TR>
</TABLE>";
////////// TABLE (BODY)
/////////////////////////////////////////////////////////////////////////////////////






////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
