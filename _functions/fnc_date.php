<?php



/*		function date_drop($event, $return_day, $return_month, $return_year) { // 1.1
//////////  MONTH
//////////////////////////////////////////////////////////////////////
echo "<TABLE VALIGN=CENTER BORDER=0 CELLPADDING=0 CELLSPACING=0><TR>\n
		<TD NOWRAP>\n";
		
if (!$return_month) { ////////// CHECK IF THE MONTH IS SELECTED
	$no_month_selected = "<OPTION VALUE='' SELECTED DISABLED READONLY>month</OPTIONS>\n";
} else {
	$month_selected[$return_month] = " SELECTED";
}

echo "<SELECT NAME=month$event>";
echo "<OPTION VALUE=01$month_selected[01]>January</OPTIONS>\n";
echo "<OPTION VALUE=02$month_selected[02]>February</OPTIONS>\n";
echo "<OPTION VALUE=03$month_selected[03]>March</OPTIONS>\n";
echo "<OPTION VALUE=04$month_selected[04]>April</OPTIONS>\n";
echo "<OPTION VALUE=05$month_selected[05]>May</OPTIONS>\n";
echo "<OPTION VALUE=06$month_selected[06]>June</OPTIONS>\n";
//if (!$return_month) { $no_month_selected = " SELECTED"; }
echo "$no_month_selected";
echo "<OPTION VALUE=07$month_selected[07]>July</OPTIONS>\n";
echo "<OPTION VALUE=08$month_selected[08]>August</OPTIONS>\n";
echo "<OPTION VALUE=09$month_selected[09]>September</OPTIONS>\n";
echo "<OPTION VALUE=10$month_selected[10]>October</OPTIONS>\n";
echo "<OPTION VALUE=11$month_selected[11]>November</OPTIONS>\n";
echo "<OPTION VALUE=12$month_selected[12]>December</OPTIONS>\n";
echo "</SELECT>&nbsp";



//////////  DAY
//////////////////////////////////////////////////////////////////////
$day = 1;
echo "\n<SELECT NAME=day$event>\n";
	if (!$return_day) { ////////// CHECK IF THE DAY IS SELECTED
		$no_day_selected = "<OPTION VALUE='' SELECTED DISABLED READONLY>day</OPTION>\n";
	} else {
		$day_selected[$return_day] = " SELECTED";
	}
	//while ($day < 10) {
	//	$day = "0" . $day;
	//	echo "<OPTION VALUE=$day$day_selected[$day]>$day</OPTION>\n";
	//	$day++;
	//}
	
	while ($day <= 31) {
		
		if ($day < 10) { $day = "0" . $day; }
		
		echo "<OPTION VALUE=$day$day_selected[$day]>$day</OPTION>\n";
		if ($day == 15 && $no_day_selected) {
			echo "$no_day_selected";
		}
		$day++;
	}
echo "</SELECT>&nbsp";



//////////  YEAR
//////////////////////////////////////////////////////////////////////
	if (!$return_year) { ////////// CHECK IF THE DAY IS SELECTED
		$no_year_selected = "<OPTION VALUE='' SELECTED DISABLED READONLY>year</OPTION>\n";
	} else {
		$year_selected[$return_year] = " SELECTED";
	}
	
	$drop_year = date("Y");
	
echo "<SELECT NAME=year$event>\n";
	
	for ($y = 1; $y <= 100; $y++) {
		echo "<OPTION VALUE=$drop_year$year_selected[$drop_year]>$drop_year</OPTION>\n";
		if ($y == 20 && $no_year_selected) { ////////// SET THE DROP-DOWN TO 20 YERAS AGO
			echo "$no_year_selected";
		}
		$drop_year--;
	}
	
echo "</SELECT>&nbsp</TD>
</TR></TABLE>";
//mail(ADMIN_EMAIL, "INVALID FUNCTION", "FUNCTION HAS BEEN RUN (date_drop)", "From: $_SERVER[PHP_SELF]");
}
/**** END FUNCTION ****/



		function date_return_drop($event, $return_year, $return_month, $return_day, $options) { // 1.1
		
//////////  MONTH
//////////////////////////////////////////////////////////////////////
$return .= "<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR>\n
		<TD>\n";

if (!$return_month || $return_month == "00" ) { ////////// CHECK IF THE MONTH IS SELECTED
	$no_month_selected = "<OPTION VALUE='' SELECTED>" . trans("month") . "</OPTIONS>\n";
} else {
	$month_selected[$return_month] = " SELECTED";
	$no_month_selected = "<OPTION VALUE=''>--------</OPTIONS>\n";
}

$return .= "<SELECT NAME=" . $event . "[month]>";
//$return .= "<OPTION VALUE=01$month_selected[01]>January</OPTIONS>\n";
$return .= "<OPTION VALUE=01$month_selected[01]>" . ucfirst(trans("january")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=02$month_selected[02]>" . ucfirst(trans("february")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=03$month_selected[03]>" . ucfirst(trans("march")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=04$month_selected[04]>" . ucfirst(trans("april")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=05$month_selected[05]>" . ucfirst(trans("may")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=06$month_selected[06]>" . ucfirst(trans("june")) . "</OPTIONS>\n";
//if (!$return_month) { $no_month_selected = " SELECTED"; }
$return .= "$no_month_selected";
$return .= "<OPTION VALUE=07$month_selected[07]>" . ucfirst(trans("july")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=08$month_selected[08]>" . ucfirst(trans("august")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=09$month_selected[09]>" . ucfirst(trans("september")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=10$month_selected[10]>" . ucfirst(trans("october")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=11$month_selected[11]>" . ucfirst(trans("november")) . "</OPTIONS>\n";
$return .= "<OPTION VALUE=12$month_selected[12]>" . ucfirst(trans("december")) . "</OPTIONS>\n";
$return .= "</SELECT>&nbsp";



//////////  DAY
//////////////////////////////////////////////////////////////////////
$day = 1;
$return .= "\n<SELECT NAME=" . $event . "[day]>\n";
	if (!$return_day|| $return_day == "00" ) { ////////// CHECK IF THE DAY IS SELECTED
		$no_day_selected = "<OPTION VALUE='' SELECTED>" . trans("day") . "</OPTION>\n";
	} else {
		$day_selected[$return_day] = " SELECTED";
		$no_day_selected = "<OPTION VALUE=''>--</OPTION>\n";
	}
	/*while ($day < 10) {
		$day = "0" . $day;
		$return .= "<OPTION VALUE=$day$day_selected[$day]>$day</OPTION>\n";
		$day++;
	}*/
	
	while ($day <= 31) {
		
		if ($day < 10) { $day = "0" . $day; }
		
		$return .= "<OPTION VALUE=$day$day_selected[$day]>$day</OPTION>\n";
		if ($day == 15 && $no_day_selected) {
			$return .= "$no_day_selected";
		}
		$day++;
	}
$return .= "</SELECT>&nbsp";



//////////  YEAR
//////////////////////////////////////////////////////////////////////
	if (!$return_year|| $return_year == "0000" ) { ////////// CHECK IF THE DAY IS SELECTED
		$no_year_selected = "<OPTION VALUE='' SELECTED>" . trans("year") . "</OPTION>\n";
	} else {
		$year_selected[$return_year] = " SELECTED";
		$no_year_selected = "<OPTION VALUE=''>----</OPTION>\n";
	}
	
	if ( $options[limit] ) {
		$drop_year = (date("Y") - $options[limit]);
	} else {
		$drop_year = date("Y");
	}
	
	if (isset( $options[location] )) {
		$location = $options[location];
	} else {
		$location = 20;
	}
	
$return .= "<SELECT NAME=" . $event . "[year]>\n";
	
	for ($y = 1; $y <= 100; $y++) {
		$return .= "<OPTION VALUE=$drop_year$year_selected[$drop_year]>$drop_year</OPTION>\n";
		if ($y == $location && $no_year_selected) { ////////// SET THE DROP-DOWN TO 20 YERAS AGO
			$return .= "$no_year_selected";
		}
		$drop_year--;
	}
	
$return .= "</SELECT>&nbsp</TD>
</TR></TABLE>";
return $return;
}
/**** END FUNCTION ****/



		function date_format_custom($date, $options) { // 2.1 //  FIRST ARRAY VARIABLE IS THE SEPARATOR

if ( !is_array($date) ) {
	if ( preg_match("/-/i", $date) ) {
		$format = explode("-", $date);
		$date = NULL;
		$date[year] = $format[0];
		$date[month] = $format[1];
		$date[day] = $format[2];
	}
} else {
	if ( !$date[year] ) { $date[year] = "0000"; }
	if ( !$date[month] ) { $date[month] = "00"; }
	if ( !$date[day] ) { $date[day] = "00"; }
}

if ( !$options[0] ) {
	$options[0] = "-";
}

$return = $date;
$return[db] = $date[year] . "-" . $date[month] . "-" . $date[day];
$return[eu] = $date[day] . $options[0] . $date[month] . $options[0] . $date[year];
$return[us] = $date[month] . $options[0] . $date[day] . $options[0] . $date[year];


return $return;
}
/**** END FUNCTION ****/



/*		function date_format($date, $separator) { // 2.1
if ( preg_match("/-/i", $date) ) {
	$format = explode("-", $date);
	$year = $format[0];
	$month = $format[1];
	$day = $format[2];
} else {
	$year = substr($date, 0, 4);
	$month = substr($date, 4, 2);
	$day = substr($date, 6, 2);
}

$new_date = $month.$separator.$day.$separator.$year;

return $new_date;
}
/**** END FUNCTION ****/



		function date_split($date) { // 2.2 USE THIS ONE
if ( preg_match("/-/i", $date) ) {
	$format = explode("-", $date);
	$d[year] = $format[0];
	$d[month] = $format[1];
	$d[day] = $format[2];
} else {
	$d[year] = substr($date, 0, 4);
	$d[month] = substr($date, 4, 2);
	$d[day] = substr($date, 6, 2);
}

/*$d[year] = substr($date, 0, 4);
$d[month] = substr($date, 5, 2);
$d[day] = substr($date, 8, 2);*/

return $d;
}
/**** END FUNCTION ****/



		function date_segment($date,$segment) { 
$d = date_split($date);
return $d[$segment];
}
/**** END FUNCTION ****/





		function date_drop_short($event, $return_month, $return_day, $option) { // 1.1
//////////  MONTH
//////////////////////////////////////////////////////////////////////
$return .= "<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR>\n
		<TD>\n";


if ( $option == 1 ) { ////////// DISPLAY 00
	$select_month = "<OPTION VALUE=''>ALL YEAR</OPTIONS>\n";
	$select_day = "0";
} else {
	$select_day = "1";
}

/*if ($return_month) { ////////// CHECK WHICH MONTH IS SELECTED
	$month_selected[$return_month] = " SELECTED";
}*/

if (!$return_day && !$option) { ////////// CHECK IF THE MONTH IS SELECTED
	$no_month_selected = "<OPTION VALUE='' SELECTED>month</OPTIONS>\n";
} else {
	$month_selected[$return_month] = " SELECTED";
}

$return .= "<SELECT NAME=month$event>";
$return .= "$select_month\n";
$return .= "<OPTION VALUE=01$month_selected[01]>January</OPTIONS>\n";
$return .= "<OPTION VALUE=02$month_selected[02]>February</OPTIONS>\n";
$return .= "<OPTION VALUE=03$month_selected[03]>March</OPTIONS>\n";
$return .= "<OPTION VALUE=04$month_selected[04]>April</OPTIONS>\n";
$return .= "<OPTION VALUE=05$month_selected[05]>May</OPTIONS>\n";
$return .= "<OPTION VALUE=06$month_selected[06]>June</OPTIONS>\n";
//if (!$return_month) { $no_month_selected = " SELECTED"; }
$return .= "$no_month_selected";
$return .= "<OPTION VALUE=07$month_selected[07]>July</OPTIONS>\n";
$return .= "<OPTION VALUE=08$month_selected[08]>August</OPTIONS>\n";
$return .= "<OPTION VALUE=09$month_selected[09]>September</OPTIONS>\n";
$return .= "<OPTION VALUE=10$month_selected[10]>October</OPTIONS>\n";
$return .= "<OPTION VALUE=11$month_selected[11]>November</OPTIONS>\n";
$return .= "<OPTION VALUE=12$month_selected[12]>December</OPTIONS>\n";
$return .= "</SELECT>&nbsp";


//////////  DAY
//////////////////////////////////////////////////////////////////////
$day = "$select_day"; ////////// WHERE DAYS START FROM (0 OR 1)
$return .= "\n<SELECT NAME=day$event>\n";
	if (!$return_day && !$option) { ////////// CHECK IF THE DAY IS SELECTED
		//if ( $option == 1 ) { ////////// DISPLAY 00
		//	$select_day = "<OPTION VALUE='00'>00</OPTIONS>\n";
		//} else {
			$no_day_selected = "<OPTION VALUE='' SELECTED>day</OPTION>\n";
		//}
	} else {
		$day_selected[$return_day] = " SELECTED";
	}
	
	/*if ($return_day) { ////////// CHECK WHICH DAY IS SELECTED
		$day_selected[$return_day] = " SELECTED";
	}*/
	
	$return .= "$select_day\n";
	
	while ($day <= 31) {
		
		if ($day < 10) { $day = "0" . $day; }
		
		$return .= "<OPTION VALUE=$day$day_selected[$day]>$day</OPTION>\n";
		if ($day == 15 && $no_day_selected) {
			$return .= "$no_day_selected";
		}
		$day++;
	}

$return .= "</SELECT>&nbsp</TD>
</TR></TABLE>";
return $return;
}
/**** END FUNCTION ****/





		function return_week($event,$first_month,$first_day,$first_year,$day_diff) {
		
	$return .= "<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR><TD>
		<SELECT NAME=$event STYLE='padding-right:10px;width:200px;' " . html_onchange() . ">
			<OPTION VALUE='' STYLE='color:CCC;'>Select a Week</OPTION>\n";
				
				if ( date(n) == 12 ) {
					$last_year = date(Y)+1;
				} else {
					$last_year = $first_year;
				}
						
				$find_week_day = date("D", mktime(0, 0, 0, $first_month, $first_day, $first_year));
							
				if ( $find_week_day == "Tue" ) { $day_mon = $first_day+6; }
				if ( $find_week_day == "Wed" ) { $day_mon = $first_day+5; }
				if ( $find_week_day == "Thu" ) { $day_mon = $first_day+4; }
				if ( $find_week_day == "Fri" ) { $day_mon = $first_day+3; }
				if ( $find_week_day == "Sat" ) { $day_mon = $first_day+2; }
				if ( $find_week_day == "Sun" ) { $day_mon = $first_day+1; }
				if ( $find_week_day == "Mon" ) { $day_mon = $first_day+0; }
							
				$month_mon = $first_month;
				$year_mon = $first_year;
												
				while ( $year_mon <= $last_year ) {
								
					while ( $month_mon <= 12 ) {
		
						$last_day = strftime("%d", mktime(0,0,0,$month_mon+1,0,$year_mon));
			
						while ( $day_mon <= $last_day ) {
					
							++$count_day;
			
							if ( strlen($month_mon) == 1 ) { $month_mon = "0" . $month_mon; } else { $month_mon = $month_mon; }
							if ( strlen($day_mon) == 1 ) { $day_mon = "0" . $day_mon; } else { $day_mon = $day_mon; }						
			
							if ( $count_day == 1 ) {
								$first_date_week = $month_mon . " / " . $day_mon . " / " .  $year_mon;
							} elseif ( $count_day == $day_diff ) {
								$last_date_week = $month_mon . " / " . $day_mon . " / " .  $year_mon;
								$week = $first_date_week . " - " . $last_date_week;
								$return .= "<OPTION VALUE='" . $week . "'" .
													return_match($_POST[$event],$week,"SELECTED") . ">
													$week
												</OPTION>\n";									
							} elseif ( $count_day == 7 ) {
								$count_day = 0;
							}
																																					
							$day_mon++;
					
						}
				
						if ( $day_mon == $last_day+1 ) {
							$day_mon = 1;
						}
						$month_mon++;							
			
					}
			
					if ( $month_mon == 13 ) {
						$month_mon = 1;
					}						
					$year_mon++;
		
				}
			$return .= "</SELECT>
		</TD>
	</TR></TABLE>";
		
		return $return;
	
}
		/**** END FUNCTION ****/





		function date_month($event,$return_month) {
		
//////////  MONTH
//////////////////////////////////////////////////////////////////////

if (!$return_month || $return_month == "00" ) { ////////// CHECK IF THE MONTH IS SELECTED
	$no_month_selected = "<OPTION VALUE='' SELECTED>" . trans("month") . "</OPTIONS>\n";
} else {
	$month_selected[$return_month] = " SELECTED";
	$no_month_selected = "<OPTION VALUE=''>--------</OPTIONS>\n";
}

$return .= "<SELECT NAME=" . $event . "[month]>";
//$return .= "<OPTION VALUE=01$month_selected[01]>January</OPTIONS>\n";
$return .= "<OPTION VALUE=01$month_selected[01]>" . ucfirst(trans("january")) . " (1)</OPTIONS>\n";
$return .= "<OPTION VALUE=02$month_selected[02]>" . ucfirst(trans("february")) . " (2)</OPTIONS>\n";
$return .= "<OPTION VALUE=03$month_selected[03]>" . ucfirst(trans("march")) . " (3)</OPTIONS>\n";
$return .= "<OPTION VALUE=04$month_selected[04]>" . ucfirst(trans("april")) . " (4)</OPTIONS>\n";
$return .= "<OPTION VALUE=05$month_selected[05]>" . ucfirst(trans("may")) . " (5)</OPTIONS>\n";
$return .= "<OPTION VALUE=06$month_selected[06]>" . ucfirst(trans("june")) . " (6)</OPTIONS>\n";
//if (!$return_month) { $no_month_selected = " SELECTED"; }
$return .= "$no_month_selected";
$return .= "<OPTION VALUE=07$month_selected[07]>" . ucfirst(trans("july")) . " (7)</OPTIONS>\n";
$return .= "<OPTION VALUE=08$month_selected[08]>" . ucfirst(trans("august")) . " (8)</OPTIONS>\n";
$return .= "<OPTION VALUE=09$month_selected[09]>" . ucfirst(trans("september")) . " (9)</OPTIONS>\n";
$return .= "<OPTION VALUE=10$month_selected[10]>" . ucfirst(trans("october")) . " (10)</OPTIONS>\n";
$return .= "<OPTION VALUE=11$month_selected[11]>" . ucfirst(trans("november")) . " (11)</OPTIONS>\n";
$return .= "<OPTION VALUE=12$month_selected[12]>" . ucfirst(trans("december")) . " (12)</OPTIONS>\n";
$return .= "</SELECT>&nbsp";

		
	return $return;
	
}
/**** END FUNCTION ****/






		function date_year($event,$return_year) {
		
//////////  YEAR
//////////////////////////////////////////////////////////////////////
	if (!$return_year|| $return_year == "0000" ) { ////////// CHECK IF THE DAY IS SELECTED
		$no_year_selected = "<OPTION VALUE='' SELECTED>" . trans("year") . "</OPTION>\n";
	} else {
		$year_selected[$return_year] = " SELECTED";
		$no_year_selected = "<OPTION VALUE=''>----</OPTION>\n";
	}
	
	
	//if ( $options[limit] ) {
	//	$drop_year = (date("Y") - $options[limit] );
	//} else {
		$drop_year = date("Y");
	//}
	
	//if (isset( $options[location] )) {
	//	$location = $options[location];
	//} else {
	//	$location = 20;
	//}
	
$return .= "<SELECT NAME=" . $event . "[year]>\n";
	
	
	$return .= $no_year_selected;
	
	for ($y = 1; $y <= 12; $y++) {
		$return .= "<OPTION VALUE=$drop_year$year_selected[$drop_year]>$drop_year</OPTION>\n";
		/*if ($y == $location && $no_year_selected) { ////////// SET THE DROP-DOWN TO 20 YERAS AGO
			$return .= "$no_year_selected";
		}*/
		$drop_year++;
	}
	
$return .= "</SELECT>";
		
	return $return;
	
}
/**** END FUNCTION ****/



?>