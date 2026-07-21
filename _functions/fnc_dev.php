<?php



function dev_print($arr) {
	
	static $i = 0; $i++;
		echo "<DIV STYLE='padding:10px;'>";
		if ( is_array($arr) ) foreach($arr as $key => $val) {
			switch (gettype($val)) {
				case "array":
					echo "<a href=\"javascript:void()\" 
						onclick=\"javascript: document.getElementById('_tree$i').style.display = ( document.getElementById('_tree$i').style.display == 'none' ? 'block' : 'none')\">". htmlspecialchars($key) ."</a> ";
					//echo "<a href=\"#\" onclick=\"document.getElementById('_tree$i').style.display = 'block';\">". htmlspecialchars($key) ."</a> ";
					//echo " <a href=\"#\" onclick=\"document.getElementById('_tree$i').style.display = 'none';\"> close</a>";
					echo "<br />";
					echo "<DIV id=\"_tree$i\" style=\"display:none;padding-left:10px;background-color:#EEFF93;\">";
					echo dev_print($val);
					echo "</DIV>";
					break;
				case "integer":
					echo "<b>".htmlspecialchars($key)."</b> => <i>".htmlspecialchars($val)."</i><br />";
					break;
				case "double":
					echo "<b>".htmlspecialchars($key)."</b> => <i>".htmlspecialchars($val)."</i><br />";
					break;
				case "boolean":
					echo "<b>".htmlspecialchars($key)."</b> => ";
					if ($val) {
						echo "true";
					} else {
					echo "false";
					}
					echo "<br />";
					break;
				case "string":
					echo "<b>".htmlspecialchars($key)."</b> => <code>".htmlspecialchars($val)."</code><br />";
					break;
					default:
					echo "<b>".htmlspecialchars($key)."</b> => ".gettype($val)."<br />";
					break;
			}
		}
	echo "</DIV>";
}
/**** END FUNCTION ****/





		function dev($var,$name=NULL) { // PRINTS THE VALUE OF A VARIABLE OR ARRAY
	
	//global $$var;
	
	if ( is_array($$var) ) {
		echo "$var --> " . dev_print($$var) . "<P>";
	} else {
		//echo "\$$var --> " . eval( "echo " . $$var . ";") . "<P>";
		echo "\$$var --> " . $$var . "<P>";
	}
}
/**** END FUNCTION ****/






function dev_print_array_old($arr) {
if ( $arr ) {
	foreach ( $arr AS $key => $value ) {
		if ( !is_int( $key ) ) {
			
			
			if ( is_array($value) ) {
				foreach ( $value AS $key1 => $value1 ) {
					//if ( !is_int( $key ) ) {
						echo " - $key1 ($key) => $value1<BR>";
					//}
				}
			} else {
				echo "$key => $value<BR>";
			}
		}
	}
}
}
/**** END FUNCTION ****/







/*		function dev_temp($array) {
	if ( is_array($array) ) {
		foreach($array as $key=>$value) {
			if(is_array($value)) {
				echo "<li>$key:<blockquote>";
				dev_temp($value);
				echo "</blockquote>";
			} elseif(is_object($value)) {
				echo "<li>Object:<blockquote>";
				dev_temp($value);
				echo "</blockquote>";
			} else {
				echo "<li>[" . $key . "] " . $value;
			}
		}
	}
}
/**** END FUNCTION ****/






?>
