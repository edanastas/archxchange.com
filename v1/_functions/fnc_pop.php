<?php



		function pop_window($window) {
if ( !{$window['width'] ) { ${window}['width'] = 450; }
if ( !{$window['height'] ) { ${window}['height'] = 250; }
if ( !{$window['target'] ) { ${window}['target'] = "_SELF"; }
if ( !{$window['anchor'] ) { ${window}['anchor'] = "click here"; }
//if ( !{$window['href'] ) { ${window}['href'] = "help.php?faq_id=10#FAQ"; }
if ( !{$window['href'] ) { ${window}['href'] = "index.php"; }

//if ( ${window}['css_class'] ) { ${window}['css_class'] = " CLASS='" . ${window}['css_class'] . "'"; }
//if ( ${window}['css_style'] ) { ${window}['css_style'] = " STYLE='" . ${window}['css_style'] . "'"; }

return "<A HREF=\"javascript:OpenWin('" . ${window}['href'] . "','" . ${window}['target'] . "','" . ${window}['width'] . "','" . ${window}['height'] . "');\" " . ${window}['css_class'] . " " . ${window}['css_style'] . ">" . ${window}['anchor'] . "</A>";

}
/**** END FUNCTION ****/




		function pop_faq($anchor, $faq_id) {
if ( !$anchor ) { $anchor = "click here"; }
return "<A HREF=\"javascript:OpenWin('help.php?faq_id=$faq_id#FAQ','HELP','450','250');\"><NOBR>$anchor</NOBR></A>";

}
/**** END FUNCTION ****/




/*		function pop_image($src,$options=NULL) {
	
	list($width, $height) = getimagesize($src);
	if ( !{$options['target'] ) ${options}['target'] = basename($src); //"POP_IMAGE";
	if ( !{$options['margin'] ) ${options}['margin'] = (preg_match("/Firefox|Safari/i",$_SERVER['HTTP_USER_AGENT']) ? 1 : 20 );
	
	
	if ( $src ) {
		return pop_window(
			array(
				"anchor"=>image_insert($src,$options),
				"target"=>{$options['target'],
				"href"=>$src, 
				"style"=>"margin:0px;", 
				"width"=>ceil($width + ${options}['margin']), 
				"height"=>ceil($height + ${options}['margin'])
			)
		);
	}
	
}
/**** END FUNCTION ****/




/*		function pop_xxx() {

}
/**** END FUNCTION ****/



?>
