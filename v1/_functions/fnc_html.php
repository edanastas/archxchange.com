<?php




/*		function html_redirect($redirect) { // REDIRECTS WITH PRETTY MESSAGE
	
//$redirect = array("error" => $redirect_message, // ERROR MESSAGE
//	"timer" => "300", // TIMER BEFORE REDIRECTING
//	"url" => $redirect_url); // IF NO LOCATION SPECIFIED THEN GOES BACK ONE
//html_error($redirect);

if (!{$redirect['url']) {
	if ( preg_match("/" . preg_quote($_SERVER['HTTP_HOST'], "/") . "/i", ${_SERVER}['HTTP_REFERER']) ) { // IF NOT OUR WEBSITE --> DO NOT GO BACK ONE (GO TO HOME PAGE)
		${redirect}['url'] = "javascript:history.back(1)";
	} else {
		${redirect}['url'] = "http://" . ${_SERVER}['HTTP_HOST'] . "";
	}
}

if (!{$redirect['timer']) ${redirect}['timer'] = "0";

if (!{$redirect['redirecting']) {
	${redirect}['redirecting'] = "redirecting...";
} else {
	${redirect}['redirecting'] .= "...";
}



if ( !headers_sent() ) {
	echo "<HTML>
	<HEAD>
		<TITLE>" . TITLE . "</TITLE>
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
								<BIG><I>". ${redirect}['redirecting'] ."</I></BIG>
									". TRANSPARENT ."</TD>
						</TR><TR>
							<TD ALIGN=CENTER VALIGN=BOTTOM>
								<FONT COLOR=RED><B><I>". ${redirect}['message'] ."</I></B></FONT>
									</TD>
						</TR><TR>
							<TD ALIGN=RIGHT VALIGN=TOP STYLE='padding-top:10px;padding-right:80px;'>". TRANSPARENT ."
								<A HREF='". ${redirect}['url'] ."'><I>(click here to redirect manually)</I></A>
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
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=". ${redirect}['url'] ."'>
		<A HREF='". ${redirect}['url'] ."'>click here to redirect manually</A>";
	
}
exit();
}
/**** END FUNCTION ****/





		function html_redirect($redirect) {
	
	${redirect}['anchor'] = trans(344,1);
	config_die($redirect);

}
/**** END FUNCTION ****/





		function html_crop_text($text, $length, $end=NULL) {
//return 
if ( strlen($text) > $length ) {
	if ( $end == 1 ) {
		$end = "... (click for more)";
	//} elseif ( !isset($end) ) {
	} elseif ( $end == NULL ) {
		$end = "...";
	}
} else {
	$end = NULL;
}

//if ( $length && strlen($text) > $length ) {
	//return preg_replace("/^([\s\S]{1,$length})([\s\z]{1}[\s\S]*)/i", "$1" . $end, $text);
	//return preg_replace("/^([\s\S]{1,$length})([\s\S]*)/i", "$1" . $end, $text);
	return preg_replace("/^(.{0,$length})([\s]+|$)([\s\S]*)/i", "$1" . $end, $text);
//}

}
/**** END FUNCTION ****/





		function html_links($text, $target, $length) {
if ( !$target ) { $target = "_BLANK"; }

if ( $length && strlen($text) > $length ) {
	//$text = ereg_replace("^(.{1,$length})[ .,].*", "\\1", $text) . " ... (click for more) ";
	//$text = preg_replace("/^(.{1,$length})(\s{1})/", "$1 ... (click for more) ", $text);
	//$text = preg_replace("/^(.{1,$length})([ ].*)/", "$1 <B>... (click for more)</B> $2", $text);
	//$text = preg_replace("/^(.{1,$length})(\s{1}.*)/i", "$1 ... (click for more) ", $text);
	$text = preg_replace("/^([\s\S]{1,$length})(\s{1}[\s\S]*)/i", "$1 ... (click for more) ", $text);
}

//$tld = "com|net|org|ws|name|info|biz|tv"; // REPLACED WITH [a-z]{2,3}
//return nl2br( preg_replace(
return preg_replace(
		array (	"/(\s{1}|\A)(\w+\.)([a-z]{2,3})(\.)?(\s{1}|\Z)/i", // (_|^)something.www(_|$) // SHORT HAND URLS
				"/(\s{1}|\A)(ftp.)(\w+\.)([a-z]{2,3})(\.)?(\s{1}|\Z)/i", // (_|^)something.www(_| |. ) // ONLY DOMAIN NAME
				"/(\s{1}|\A)(\w+\.)(\w+\.)([a-z]{2,3})(\.)?(\s{1}|\Z)/i", // (_|^)something.www(_|$) // SHORT HAND URLS
				"/(ht|f)(tp)(s|7)?(:\/\/)?([\w+\.]+)([\w\.\/\=\?\,\;\-\_\~\!\@\#\$\%\+\&]*)/i", // FULL HTTP / FTP URL
				"/(\s{1}|\A)((\w)+\:)?([\w\.\_\-]+)(@)([\w\.]+)(\s{1}|\Z)/i"), // EMAIL ADDRESSES
				//"/(http://)([\w\.\_\-]+)(@)([\w\.\-]+)/i"), // EMAIL ADDRESSES
		array (	" http://www.$2$3 $4",
				" ftp://$2$3$4 ",
				" http://$2$3$4 ",
				" <A TARGET=$target HREF=\"$1$2$3$4$5$6\">$5</A> ",// - 1|$1| 2$2| 3|$3| 4|$4| 5|$5| 6|$6|
				" <A HREF=\"mailto:$4$5$6\">$4$5$6</A> "), 
				//"mailto://$2$3$4"), 
		$text);

//return $return;
}
/**** END FUNCTION ****/





		function html_onchange() {
//return " onchange=\"this.form.submit();\"";
return " onchange=\"submit();\"";
}
/**** END FUNCTION ****/





		function html_grid($content, $columns, $options) {
	
	// RETURN A TABLE $columns COLUMNS WIDE CONTAINING $content ARRAY VALUES
	if (!{$options['border']) { ${options}['border'] = " border=0"; } else { ${options}['border'] = " border=" . ${options}['border']; } // TABLE BORDER
	if (!$columns) { $columns = 1; }
	
	if (!{$options['align']) { ${options}['align'] = " align=center"; } else { ${options}['align'] = " align=" . ${options}['align']; } // TABLE ALIGN
	if ({$options['valign']) { ${options}['valign'] = " valign=" . ${options}['valign']; } // TABLE VALIGN
	
	if ({$options['cellpadding']) { ${options}['cellpadding'] = " cellpadding=" . ${options}['cellpadding']; } // CELLPADDING
	if ({$options['cellspacing']) { ${options}['cellspacing'] = " cellspacing=" . ${options}['cellspacing']; } // CELLSPACING
	if ({$options['width']) { ${options}['width'] = " width=" . ${options}['width']; } // TABLE WIDTH
	if ({$options['height']) { ${options}['height'] = " height=" . ${options}['height']; } // TABLE HEIGHT
	if ({$options['style']) { ${options}['style'] = " style='" . ${options}['style'] . "'"; } // STYLES
	
	$return = "<table" . ${options}['border'] . ${options}['align'] . ${options}['valign'] . ${options}['width'] . ${options}['cellspacing'] . ${options}['cellpadding'] . ${options}['style'] . ">
		<tr>";
	
	if ( is_array($content) ) {
		
		foreach($content AS $value) {
			
			if ( is_array($value) ) {
				//foreach ( $value AS $height => $title ) {
					
					//dev_print($value);
					foreach ( $value AS $title ) {
						$return .= "</TR><tr><td height=10>" . TRANSPARENT . "</td></tr>" . $title . "<TR>";
					}
					/*$return .= "</tr><tr>
						<td align=center height=" . ${value}['0'] . " colspan=" . $columns . "> (array)</td>
					</tr><tr><td height=10>" . TRANSPARENT . "</td></tr><tr>";*/
					
					$cell_count = NULL;
				//}
				
				
			} else {
				
				if ( ++$cell_count > $columns ) {
					$return .= "</tr><tr><td height=10>" . TRANSPARENT . "</td></tr><tr>";
					$cell_count = 1;
				}
				
				$return .= "<td align=center>" . $value . "</td>";
			}
		}
		
		// WRAP-UP CELLS
		for ($c = $cell_count; $c < $columns; $c++) {
			$return .= "<td width=" . (90/$columns) . "%></td>";
		}
		
	} else {
		$return = "NO RESULTS";
	}
	
	
	$return .= "</tr>
	</table>";
	
	return $return;
	
}
/**** END FUNCTION ****/





		function html_subtitle($title, $colspan, $options=NULL) { // $title, $colspan, $options
	/*
	outline: 1px solid red;
	background: #DDD;
	*/
	
	
// STYLE='padding-left:10px;padding-top:10px;padding-bottom:5px;'
	return "<TR>
		<TD ALIGN=CENTER COLSPAN=" . $colspan . " STYLE='padding-bottom:5px;'>
			<TABLE BORDER=0 WIDTH=100% CELLPADDING=2 CELLSPACING=0>
				<TR>
					<TD BGCOLOR=" . COLOR_NEUTRAL_LIGHT . " 
						STYLE='padding-left:20px;border:1px solid " . COLOR_NEUTRAL . ";'><B>" . $title . "</B></TD>
				</TR>
			</TABLE>
		</TD>
	</TR>";
}
/**** END FUNCTION ****/





		function html_pointer_box($location, $width, $offset, $content, $bg_color = NULL) { // $width, $offset, $content
	
	// STYLE='padding-left:10px;padding-top:10px;padding-bottom:5px;'
	if ( $location == 3 ) {
		$side = "top";
	} elseif ( $location == 1 ) {
		$side = "bottom";
		
	} else {
		$side = "top";
		//$side = "bottom";
		//$opposite_side = "bottom";
		//$pointer_side = "bottom";
		
	}
	
	if ( !$bg_color ) $bg_color = COLOR_BACKGROUND; // COLOR_NEUTRAL_LIGHT
	
	//temp_cartNotch.gif // background-repeat: repeat-x
	if ( $location ) {
		
		$pointer[$location] = "<TR BGCOLOR=#" . COLOR_BACKGROUND . ">
				<TD WIDTH=" . $offset . " HEIGHT=8 
					STYLE='background-image: url(" . TEMPLATE_DOMAIN . "images/pointer_bg.gif);
						background-repeat: repeat-x;
						background-position: " . $side . "'>" . TRANSPARENT . "</TD>
				<TD VALIGN=" . $side . " WIDTH=13 HEIGHT=8 BGCOLOR=#" . $bg_color . " 
					STYLE='background-image: url(" . TEMPLATE_DOMAIN . "images/pointer_" . $location . ".gif);
						background-repeat: repeat-x;
						background-position: " . $side . ";'></TD>
				<TD WIDTH=". ( $width - $offset - 13) ." HEIGHT=8 
					STYLE='background-image: url(" . TEMPLATE_DOMAIN . "images/pointer_bg.gif);
						background-repeat: repeat-x;
						background-position: " . $side . ";'>" . TRANSPARENT . "</TD>
			</TR>";
		
		//" . TRANSPARENT . "
		//<IMG WIDTH=". ( $width - $offset - 13) ." HEIGHT=1 SRC='" . TEMPLATE_DOMAIN . "images/transparent.gif'>
		//<IMG BORDER=0 SRC='" . TEMPLATE_DOMAIN . "images/pointer_" . $location . ".gif'>
		
		
		
							
		/*
		
		$pointer[$location] = "<TR>
				<TD STYLE='padding:0px;'>
					<IMG SRC='" . TEMPLATE_DOMAIN . "images/temp_cartNotch.gif'></TD>
			</TR>";
		
		$pointer[$location] = "<TR>
				<TD STYLE='padding:0px;'>
					<IMG SRC='" . TEMPLATE_DOMAIN . "images/temp_cartNotch.gif'></TD>
			</TR>";*/
		
	}/* elseif ( $location ) {
		$pointer[$location] = "<TR>
				<TD WIDTH=" . $offset . " STYLE='border-" . $side . ":1px solid " . COLOR_HIGHLIGHT . ";'>" . TRANSPARENT . "</TD>
				<TD WIDTH=30 STYLE='border-" . $side . ":1px solid " . COLOR_HIGHLIGHT . ";'>
					<IMG SRC='" . TEMPLATE_DOMAIN . "images/pointer_" . $location . ".gif'></TD>
				<TD STYLE='border-" . $side . ":1px solid " . COLOR_HIGHLIGHT . ";'>" . TRANSPARENT . "</TD>
			</TR>";
	}*/ else {
		${pointer}['3'] = "<TR>
				<TD WIDTH=" . $offset . " STYLE='border-" . $side . ":1px solid #" . COLOR_HIGHLIGHT . ";'>" . TRANSPARENT . "</TD>
			</TR>";
	}
	
	
	
	return "<TABLE BORDER=0 BORDERCOLOR=pink WIDTH=" . $width . " CELLPADDING=0 CELLSPACING=0 BGCOLOR=#" . $bg_color . ">
		" . ${pointer}['1'] . "<TR>
			<TD STYLE='border-" . $side . ":1px solid #" . COLOR_HIGHLIGHT . ";
				border-right:1px solid #" . COLOR_HIGHLIGHT . ";
				border-left:1px solid #" . COLOR_HIGHLIGHT . ";
				padding:6px;' CLASS='TextGrayDark' COLSPAN=3>" . 
				$content . "</TD>
		</TR>
		" . ${pointer}['3'] . "
	</TABLE>";
}
/**** END FUNCTION ****/





		function html_box($width, $title, $content, $footer = NULL) { // $width, $offset, $content
	
	if ( !$width ) { $width = 200; }
	if ( $footer ) {
		$footer = "<TR><TD ALIGN=RIGHT VALIGN=BOTTOM BGCOLOR=" . COLOR_BACKGROUND . " STYLE='padding:4px;' CLASS='TextGrayBlack'><B><SMALL>$footer</SMALL></B></TD></TR>";
	}
	
	return "<TABLE BORDER=0 WIDTH=" . $width . " CELLPADDING=0 CELLSPACING=1 BGCOLOR=" . COLOR_NEUTRAL_DARK . ">
		<TR>
			<TD BGCOLOR=" . COLOR_SECONDARY_LIGHT . " STYLE='padding:4px;' CLASS='TextGrayBlack'><B>" . 
				ucfirst($title) . "</B></TD>
		</TR><TR>
			<TD>
				<TABLE WIDTH=100% BGCOLOR=" . COLOR_BACKGROUND . " CELLPADDING=6 CELLSPACING=0>
					<TR>
						<TD><SMALL>" . 
							$content . "</SMALL></TD>
					</TR>" . $footer . "
				</TABLE>
			</TD>
		</TR></TABLE>";
}
/**** END FUNCTION ****/





		function html_title_text($text) { // 
	
	return "<B CLASS='colorSecondary'><BIG>" . $text . "</BIG></B>";
}
/**** END FUNCTION ****/







		function html_stages($steps, $current) {
	
	$size = 40;
	// STEPS, CURRENT, COLOR
	//

	$return .= "<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=6>
		<TR>";
	
	
	
	for($s = 1; $s < ($steps+1); $s++) {
		
		if ( $s == $current ) {
		
			//$size += $size*.4;
			//$display_size = $size;
			$size = 40;
			
			//$display = "<B STYLE='color:555555;'><BIG><BIG>$s</BIG></BIG></B>";
			$style = "color:FFFFFF;font-weight: bold;font-size:24px;background:" . 
				COLOR_SECONDARY_DARK . ";"; // border: 1px solid " . COLOR_SECONDARY_LIGHT . ";
			$bg = COLOR_GRAY_MEDIUM_DARK;
		} else {
		
			//$size = $size;
			$display_size = $size - 10;
			$size = 30;
			
			//$display = "<B STYLE='color:777777;'>$s</B>";
			$style = "color:999999;font-weight: bold;font-size:12px;background:" . 
				COLOR_SECONDARY_LIGHT . ";";
			$bg = COLOR_NEUTRAL;
			
		}
		
		
		$return .= "<TD>
			<TABLE BORDER=0 WIDTH=$size HEIGHT=$size CELLSPACING=2 CELLPADDING=0 BGCOLOR=" . $bg . ">
				<TR>
					<TD ALIGN=CENTER VALIGN=CENTER STYLE='$style'>" . 
						return_else( return_match($current,$s,TRUE), return_match($current,$s,$s),"<A HREF='checkout.php?" . CRYPT_STEP_ID . "=$s'>$s</A>" ) . "</TD>
				</TR>
			</TABLE>
		</TD>";
		
	}
	
	
	$return .= "</TR><TR>
			<TD HEIGHT=10 BGCOLOR=" . COLOR_BACKGROUND . ">" .  TRANSPARENT . "</TD>
		</TR>
	</TABLE>";
	
	/*return "<TABLE BORDER=0 WIDTH=$size HEIGHT=$size CELLSPACING=1 CELLPADDING=1 BGCOLOR=" . COLOR_GUIDE . ">
		<TR>
			<TD ALIGN=CENTER VALIGN=CENTER BGCOLOR=" . COLOR_SECONDARY_LIGHT . ">1</TD>
		</TR>
	</TABLE>";*/
	
	return $return;
	
}
/**** END FUNCTION ****/






		function html_table($content) { // 
	
	if ( is_array($content) ) {
		
		$cols = count($content, COUNT_RECURSIVE);
		
		$return .= "<TABLE BORDER=0 ALIGN=CENTER WIDTH=$size HEIGHT=$size CELLSPACING=2 CELLPADDING=2 BGCOLOR=" . COLOR_GUIDE . ">";
		
		foreach($content AS $row) {
			
			$return .= "<TR>";
			
			if ( is_array($row) ) {
				
				foreach($row AS $cell) {
					
					$return .= "<TD ALIGN=CENTER BGCOLOR=" . COLOR_BACKGROUND . ">$cell</TD>";
					
				}
				
			} else {
				$return .= "<TD ALIGN=CENTER BGCOLOR=" . COLOR_BACKGROUND . " COLSPAN=" . $cols . ">$row</TD>";
			}
			
			
			
			$return .= "</TR>";
			
		}
		
		$return .= "</TABLE>";
		
	}
	
	return $return;
}
/**** END FUNCTION ****/





	function html_query_string($string=NULL) { // SUBMIT STRING / ARRAY TO RETURN NEW QUERY STRING
		
		// ORGANIZE GET VARIABLES
		foreach( $_GET AS $key => $value ) {
			
			$return[] = $key . "=" . $value; // COMPILE INTO RETURN ARRAY
		}
		
		// ORGANIZE STRING VARIABLES
		if ( is_array($string) ) { // ARRAY FORMAT --> variable name (key) = variable value (value)
			
			foreach( $string AS $key => $value ) {
				
				$append[] = $key . "=" . $value; // COMPILE INTO RETURN ARRAY
			}
		} else {
			
			// REORGANIZE ARRAY
			foreach ( explode("&",$string) AS $string_vars ) {
				
				if ( $string_vars ) {
					
					$strings = explode("=",$string_vars);
					$append[] = ${strings}['0'] . "=" . ${strings}['1']; // COMPILE INTO RETURN ARRAY
				}
			}
		}
		
		return "?" . implode("&",array_merge($return,$append)); // GLUE ALL ARRAY VARS WITH "&"
}
/**** END FUNCTION ****/






		function html_default_table($options=null) { // 
	
	if (!{$options['border']) ${options}['border'] = 0;
	if (!{$options['width']) ${options}['width'] = "100%";
	if (!{$options['cellpadding']) ${options}['cellpadding'] = 2;
	if (!{$options['cellspacing']) ${options}['cellspacing'] = 1;
	//if (!{$options['bgcolor']) ${options}['bgcolor'] = "#cccccc";
	if (!{$options['class']) ${options}['class'] = "defaultTable";
	
	return "<table border='". ${options}['border'] ."' width='". ${options}['width'] ."' cellpadding='". ${options}['cellpadding'] ."' cellspacing='". ${options}['cellspacing'] ."' bgcolor='". ${options}['bgcolor'] ."' class='". ${options}['class'] ."'>";
}
/**** END FUNCTION ****/





		function html_table_start($options=NULL) {
	return "<TABLE BORDER=0 WIDTH=100 CELLPADDING=0 CELLSPACING=0>";
}
/**** END FUNCTION ****/





		function html_table_end() {
	return "</TABLE>";
}
/**** END FUNCTION ****/





		function html_drop_counter($identifier,$array_identifier,$selected,$max=10,$min=1,$interval,$alt=NULL,$options=NULL) { // RETURN DROP DOWN MENU
	// $alt = ALTERNATE MESSAGE AFTER COUNTER SUCH AS "days", etc.
	//echo "\$selected --> $selected<BR>";
	//if (!$selected ) $selected = $_REQUEST[$identifier][qty];
	
	if ( !$interval ) $interval = 1;
	
	$return = "<SELECT NAME=". $identifier . ($array_identifier ? "[". $array_identifier ."]" : NULL) ."". ({$options['auto'] ? " onchange=\"submit()\"" : NULL) .">";
	// COUNT DROP DOWN TO $max VALUE
	
	
	//if ( eval("return \$_POST[". $identifier ."]". ( $array_identifier ? "[". $array_identifier ."]" ) .";") )
	//if ( !$_POST[$identifier] ) $return .= "<OPTION VALUE=''>". ( !$alt ? "0" : $alt ) ."</OPTION>";
	
	
	
	for ($q = $min; $q <= $max; $q += $interval ) {
		$return .= "<OPTION VALUE='". $q ."'". ($selected == $q ? " SELECTED" : NULL) .">". $q ." ". $alt ."</OPTION>";
	}
	$return .= "</SELECT>";
	
	return $return;
}
/**** END FUNCTION ****/






		function html_strip($string) { // 
	//$search = array ("/<.+? >/i");
	//$replace = array ("");
	
	return preg_replace("/<.+?>/i","",$string); //<?
	
}
/**** END FUNCTION ****/






		function html_filters($options=NULL) { // 
	
	
	$return .= "<BR><BR>". trans(343) ."<P>
		<TABLE BORDER=0 ALIGN=CENTER WIDTH=140 HEIGHT=100% CELLPADDING=4 CELLSPACING=1 BGCOLOR=". COLOR_GRAY .">
			<TR><TD BGCOLOR=". COLOR_BACKGROUND .">";
	
	
				$return .= "<TABLE BORDER=0 ALIGN=CENTER WIDTH=90% HEIGHT=90% CELLPADDING=2 CELLSPACING=0>";
				
				$filters = array(
					"contentwatch.com"=>TEMPLATE_DOMAIN ."images/filter_contentwatch.gif",
					"netnanny.com"=>TEMPLATE_DOMAIN ."images/filter_netnanny.gif",
					"cyberpatrol.com"=>TEMPLATE_DOMAIN ."images/filter_cyberpatrol.gif",
					"cybersitter.com"=>TEMPLATE_DOMAIN ."images/filter_cybersitter.gif"
				);
				
				foreach($filters AS $filter => $logo) {
					
					if ( !{$options['display'] || ( ${options}['display'] && $count++ < ${options}['display'] ) ) {
						$return .= $divider ."<TR>
							<TD ALIGN=CENTER>
								<A TARGET=FILTERS HREF='http://www.". $filter ."'>
									<IMG BORDER=0 WIDTH=120 SRC='". $logo ."'></A></TD>
						</TR>";
						
						$divider = "<TR>
							<TD ALIGN=CENTER>
								<HR WIDTH=100% SIZE=1 COLOR=DDDDDD></TD>
						</TR>";
					}
				}
				
				$return .= "</TABLE>";
	
	$return .= "</TD></TR></TABLE>";
	
	return $return;
}
/**** END FUNCTION ****/






		function html_array_list($array,$separator="<BR>",$bullet=NULL) { // 
	
	$return = $bullet . implode($separator . $bullet, $array);
	
	return $return;
}
/**** END FUNCTION ****/






		function html_rank_bar($rank, $rank_total=10, $size=60, $align="LEFT", $options=NULL) { // CREATE A GRAPHIC BAR FOR RANKING
	
	if ( $rank ) {
		
		if ( !{$options['color'] ) ${options}['color'] = "#FFCB11"; // FFCB11 519BD4
		if ( !{$options['height'] ) ${options}['height'] = 5; // FFCB11 519BD4
		
		$rank_width = ($size * ($rank / $rank_total));
		
		${cell}['rank'] = "<TD WIDTH=". $rank_width ." BGCOLOR=". ${options}['color'] ."></TD>";
		${cell}['rank_background'] = "<TD WIDTH=". ($size - $rank_width) ." BGCOLOR=#C0C0C0></TD>";
		
		$return = "<TABLE BORDER=0 WIDTH=". $size ." HEIGHT=". ${options}['height'] ." BGCOLOR=#ADADAD CELLPADDING=0 CELLSPACING=1>
			<TR>
				". ( $align == "LEFT" ? ${cell}['rank'] . ${cell}['rank_background'] : ${cell}['rank_background'] . ${cell}['rank'] ) ."
			</TR>
		</TABLE>";
		
		return $return;
	}
	
}
/**** END FUNCTION ****/






/*		function html_ xxx($xxx) { // 
	
	return $return;
}
/**** END FUNCTION ****/









?>
