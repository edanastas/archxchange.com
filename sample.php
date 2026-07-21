<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", NULL); // see config.php for settings

define("TEMPLATE_BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(TEMPLATE_BASE_DIR . "config.php"); // _functions/fnc.php


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
define("TITLE","Form Function Demonstration"); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( $_POST ) {
	
	////////// PROCESS SUBSECTION POST DATA
	////////////////////////////////////////////////////////////////////////////////
	if ( ${_POST}['SUBMIT'] ) {
		
		// CHECK IF FIELD SUBMITTED
		if ( !$_POST['fieldname'] ) ${error}['fieldname'] = "please submit the fieldname";
		
		
		// CHECK ERROR FIELD
		if ( !$_POST['checkbox'] ) ${error}['checkbox'] = "please check the box";
		if ( !$_POST['style'] ) ${error}['style'] = "please submit a style";
		//if ( !$_POST['sample'] ) ${error}['sample'] = "please select an item from the menu";
		
		
		// CHECK IF manual FIELD SUBMITTED
		if ( !$_POST['manual'] || ${_POST}['manual'] == "enter your [something]" ) {
			// more complicated statements can go here
			${error}['manual'] = "please submit a manual test field";
		}
		
	}
	
	////////// PROCESS DB
	////////////////////////////////////////////////////////////////////////////////
	
	dev_print($error);
	////////// IF NO ERRORS -->
	if ( !$error ) {
		
		
		////////// MODIFY DATABASE
		$sql = "INSERT INTO `samples` SET 
			sample_id = NULL, 
			fieldname = '" . query_prep({$_POST['fieldname']}) . "', 
			error = '" . query_prep({$_POST['error']}) . "', 
			style = '" . query_prep({$_POST['style']}) . "', 
			checkbox = '" . query_prep({$_POST['checkbox']}) . "', 
			manual = '" . query_prep({$_POST['manual']}) . "', 
			menu = '" . query_prep({$_POST['menu']}) . "', 
			textarea = '" . query_prep({$_POST['textarea']}) . "'"; // INSERT SAMPLE
		if ( !mysqli_query($db, $sql) ) {
			${error}['error'] = "there was an error modifying the database";
			error($error['error']); // LOG ALL ERRORS
			
			echo mysqli_error($db);
		} else {
			$affected_rows = mysqli_affected_rows($db);
		}
		
	}
	
	// PRINT DATABASE SQL QUERIES FOR ERROR CHECKING
	echo $sql ."<p>";
	//-- 
	dev_print($_POST); // DEVELOPER ARRAY PRINT FUNCTION
	
	
}

// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
echo "<TABLE BORDER=0 ALIGN=CENTER WIDTH=100% CELLPADDING=2 CELLSPACING=0 RULES=NONE>";
//echo form_table_start();
echo "<FORM ACTION=" . ${_SERVER}['PHP_SELF'] . " METHOD=POST>";





//////// MAIN SECTION HEADING
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


////////// SUBSECTION HEADINGS
/////////////////////////////////////////////////////////////////////////////////////
	
	if ( $affected_rows > 0 ) {
		$insert_form[] = array("!",NULL,"CONGRADULATIONS YOU HAVE INSERTED ". $affected_rows ." NEW ENTRY TO THE DB"); // SUBTITLE
		
	}
	
	
	////////// TITLE NAME HERE
	$insert_form[] = array("-",NULL,"FORM FUNCTION SAMPLE DEMONSTRATION"); // SUBTITLE
	
	
	////////// SPACER
	$insert_form[] = array("-",NULL,5); // VERTICAL SPACER
	
	
	
	
////////// FORMATTED INPUT
/////////////////////////////////////////////////////////////////////////////////////

	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"This is a text note that can be placed anywhere. Usually used to describe the form item that comes next. Keep in mind that all these things can be adjusted from the main form function. If you want to make an overall formatting change to the whole website you can do it in one place and it can potentially change the layout of all the forms. Notice the padding on the right when you shrink your page. [_]"); // SUBTITLE
	
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"At the end of each type of form entry I put in the symbol that you use to get that sample in the funciton, like this one --> [_]"); // SUBTITLE
	
	////////// QUESTION
	$insert_form[] = array("?",NULL,"So, did you notice the padding [?]"); // SUBTITLE
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"by the way, that was a quesiton. Bolded and slightly indented. The color is set from the style sheet so customers can eventually upload their own styles for there website.");
	
	////////// TEXT NOTE (FULL WIDTH)
	$insert_form[] = array("~",NULL,"use a tilde (~) to span the text across both cells. [~]");
	
	
	////////// FIELDNAME
	$insert_form[] = array("fieldname", trans("fieldname"), // $field_name // WITH TRANSLATION FUNCTION
			// by the way, the translation function translates all text from english to any othe language in our database (tbd)
		array("TEXT",$edit['fieldname'],NULL,NULL), // ${input}['type'], ${input}['value'], ${input}['style'], ${input}['option']
		NULL,NULL,NULL); // $styles,$trailer,$options
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"by the way, that was a quesiton. Bolded and slightly indented.");
	
	////////// ALERT / CAUTION MESSAGE
	$insert_form[] = array("!",NULL,"alert message could go here [!]");
	
	////////// ALTERNATE MESSAGE
	$insert_form[] = array("*",NULL,"Alternate Message Text<P> We will probably customize this in the future to look more in synch with our website. Keep in mind you can use almost all the symbols of the keyboard to add a specific form element that you will use over and over again. [*]");
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL," This is what an error message would look like by only setting the variable \$error[<NAME OF VARIABLE HERE>]");
	
	${error}['error'] = "This is a custom error message, usually instructing the user what to do to eliminate it. <B>This is really the purpose behind this whole form function. It allows you to locate the error message right where the error is occurring.</B>";
	
	////////// FIELDNAME
	$insert_form[] = array("error", trans("error"),
		array("TEXT",$edit['error'],NULL,NULL),
		NULL,"OH! almost forgot about the trailer!",NULL); // $styles,$trailer,$options
	
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"the style option (you have to look at the code for this one), will let you customize any style element. But keep in mind, it is an array (ROW, CELL 1, CELL 2)");
	
	////////// STYLE EXAMPLE
	$insert_form[] = array("style", trans("style sample"),
		array("TEXT",$edit['style'],NULL,NULL),
		array(null,"background-color:lightgreen;","background-color:lightgreen;"),"optional",NULL); // $styles,$trailer,$options
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"But if you wanted to do that (example above) throughout the form we would just add an extra feature in the function to do it automatically.");
	
	////////// CHECKBOX
	$insert_form[] = array("checkbox", trans("checkbox"),
		array("CHECKBOX","1","1",({$_POST['checkbox']} ? " CHECKED":NULL)), // ${input}['type'], ${input}['value'], ${input}['style'], ${input}['option']
		NULL,NULL,NULL);
	
	// notice the predefined styles in the example above
	
	
	////////// TEXTARE
	$insert_form[] = array("textarea", trans("textarea"),
		array("TEXTAREA","this has a custom height to six rows, but the width throughout the form is constant via a style sheet setting which can be adjusted for the whole site.",NULL,"ROWS=6"), // ${input}['type'], ${input}['value'], ${input}['style'], ${input}['option']
		NULL,NULL,NULL);
	
	
	
////////// MANUAL INPUT
/////////////////////////////////////////////////////////////////////////////////////
	
	////////// TITLE
	$insert_form[] = array("-",NULL,"Manual Form Submission");
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"You can always submit a form field manually too. There are always a million different things you may want to submit into a form like this, so this manual input is the wildcard. You can add anything you want. However the fieldnames have to be unique otherwise the later one will overwrite the previous one.");
	
	////////// MANUAL FORM INPUT
	$insert_form[] = array("manual", trans("manual input"),
		"<INPUT NAME=manual TYPE=TEXT ". form_value("enter your [something]",{$_POST['manual']}) .">",
		NULL,"notice, no arrays in this code input value",NULL);
	
	
	////////////////////////////////////////////////////////////////////////////////
	
	${input}['sample'] = "<SELECT NAME=sample>";
	${input}['sample'] .= "<OPTION STYLE='color:CCC;' VALUE=''>SELECT</OPTION>";
	
	$query_samples = mysqli_query($db, "SELECT * FROM samples");
	while ( $results = mysqli_fetch_assoc($query_samples) ) {
		${input}['sample'] .= "<OPTION VALUE='" . ${results}['sample_id'] . "' " . // SAMPLES SELECT
			return_match($_POST['fieldname'], ${results}['fieldname'], "SELECTED") . ">" . ${results}['fieldname'] . " (" . ${results}['sample_id'] . ")</OPTION>";
	}
	
	${input}['sample'] .= "</SELECT>";
	
	////////// SAMPLE
	$insert_form[] = array("sample", trans("menu sample"), // $field_name
		${input}['sample'], // ${input}['type'], ${input}['value'], ${input}['style'], ${input}['option']
		NULL,NULL,NULL); // $styles,$trailer,$options
	
	
	
/////////////////////////////////////////////////////////////////////////////////////
	
	$insert_form[] = array("-",NULL,40); // VERTICAL SPACER
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"This is a 40 pixel spacer above this note. Just use the same as the title (first one), but put in a number instead of the title text.");
	
	////////// SUBMIT
	$insert_form[] = array("SUBMIT",NULL,
		"<INPUT TYPE=SUBMIT NAME=SUBMIT VALUE=SUBMIT> ", // ${input}['type'], ${input}['value'], ${input}['style'], ${input}['option']
		NULL,"click here to see the error handling and add to the db",NULL); // $styles,$trailer,$options
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"Please also pay close attention to how the database inserts are done as well. Try to follow that format.");
	
	
	$insert_form[] = array("-",NULL,10); // VERTICAL SPACER
	
	////////// TEXT NOTE
	$insert_form[] = array("_",NULL,"If you want multiple submit buttons next to eachother, then we have to do that manually.");
	
	
	$insert_form[] = array("-",NULL,40); // VERTICAL SPACER
	
////////// PROCESS FORM ARRAY
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// this element takes all the form values and formats them for the html table
	echo form_input($insert_form);
	
/////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////
////////// END BODY
echo form_table_end();
//echo "</TABLE>";
echo "</FORM>";






////////// CHECK VARIABLES
/////////////////////////////////////////////////////////////////////////////////////
//-- echo "<B>\$error</B><BR>"; dev_print($error);
//-- echo "<B>\$_REQUEST</B><BR>"; dev_print($_REQUEST);


////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
