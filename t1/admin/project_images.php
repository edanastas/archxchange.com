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


		function form_select($current,$default) { // sets the select value if vars match
	return ( $default && $current == $default ? " SELECTED" : NULL );
}
/**** END FUNCTION ****/

// 
function local_project_menu($name="project_id",$default_id=null) {
	$return = "<select name=". $name .">";
	
	//$sql = query_domain("template_projects");
	$sql = "SELECT * FROM template_projects WHERE domain_id = '". DOMAIN_ID ."'";
	$query = mysqli_query($db, $sql);
	while ( $projects = mysqli_fetch_assoc($query) ) {
		$return .= "<option value='". ${projects}['project_id'] ."' ". 
			(( $_POST[$name] ? $_POST[$name] : ( $default_id ? $default_id : ${_REQUEST}['CRYPT_REF_ID'])) == ${projects}['project_id'] ? " SELECTED" : NULL) .">". substr({$projects['title']},0,50) ."</option>";
	}
	$return .= "</select>";
	
	return $return;
}


// insert image type_id menu
function local_type_id_menu($prefix="type_id_",$index=null,$default_type_id=null,$options=null) {
	global $config;
	//$config['image']['types']
	$return = "<select name='". $prefix . $index ."'>". ({$options['optional']} ? "<option value=''>Select Type --></options>":null);
		if ( is_array($config['image']['types']) ) {
			foreach ($config['image']['types'] AS $key => $value) {
				if ( is_array($value)) {
					$return .= "<optgroup label='". $key ."'>";
					/*if ( $key == "photographers") {
						$sql = "select * from template_contacts where domain_id = '". DOMAIN_ID."' and type is not null";// and type = 'photographer'
						$query = mysqli_query($db, $sql);
						while ($info = mysqli_fetch_assoc($query)) {
							
							//$types[$info['type']][$info['contact_id']] = ${info}['contact'];
								//$types['photographers'][$info['contact_id']] = ${info}['contact'];
							
							$types[$info['type']] .= "<option value='". ${info}['contact_id'] ."'>". ucwords({$info['contact']}) ."</option>\n";
							
							if ( is_array($types) ) {
							
								//dev_print($types);
								
								foreach ($types AS $key => $value ) {
									
									if ( $key == "photographer" ) {
										//$menu['photographers'] = "<optgroup label='". $key ."s'>". $value ."</optgroup>";
										${menu}['photographers'] .= $value;
									} else {
										//$menu['others'] = "<optgroup label='". $key ."s'>". $value ."</optgroup>";
										${menu}['others'] .= $value;
									}
								}
							}
							
							$return .= ${menu}['photographers'] . ${menu}['others'];
							
							
						}
						
						
					} else {*/
						foreach ($value AS $key2 => $value2) {
							$return .= "<option value='". $key2 ."' ". 
								form_select($key2,$default_type_id) 
								.">". ucwords($value2) ." [". $key2 ."]</option>";
						}
					//}
					$return .= "</optgroup>";
				} else {
					$return .= "<option value='". $key ."' ". form_select($key,$default_type_id) .">". ucwords($value) ." [". $key ."]</option>";
				}
			}
		}
	$return .= "</select>";
	return $return;
}


// insert detail image form elements // background-color:#eee; background-image:url(\"". TEMPLATE_DOMAIN ."_images/bg_header_admin.gif\");
function local_form_image_details($index) {
	$return = "<a href='#' onclick=\"Effect.toggle('image_details_". $index ."', 'blind',{duration: 0.7});\" style=''>customize image information</a>
		<div id='wrapper'>
			<div id='image_details_". $index ."' style='display:none;margin-top:4px;'>
				<div style='padding:6px;border:1px outset gray;background-color:#eee;'>
					this image is a ". local_type_id_menu("type_id_",$index,null,array(optional=>1)) ." image<br />
					title <input type='text' name='image_title_". $index ."' style=''><br />
					caption<br /><textarea name='image_caption_". $index ."' style='width:100%;' rows='3'></textarea><br />
					<span class='highlight'>this image will be for</span> ". local_project_menu("project_id_". $index) ."<br />
					<script>DateInput('date_". $index ."',false)</script>
				</div>
			</div>
		</div>";
	return $return;
}


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0
if ( ${_POST}['BACK'] ) {
	header("location:project.php?". CRYPT_REF_ID ."=". ${_POST}['project_id']);
} elseif ( ${_POST}['ADD_IMAGES'] ) {
	
	
	if ( ${_FILES}['1']['name'] 
		|| ${_FILES}['2']['name'] 
		|| ${_FILES}['3']['name'] 
		|| ${_FILES}['4']['name'] 
		|| ${_FILES}['5']['name'] 
		|| ${_FILES}['6']['name'] ) {
		//dev_print($_FILES);
		
		// add to database
		foreach ( $_FILES AS $key => $file ) {
			
			//echo "$key => ". ${file}['name'] ."<br />";
			
			if ( ${file}['name'] ) {
				//echo "file for key $key exists inserting into db <p>";
				
				$sql = "INSERT INTO template_images SET 
					image_id = NULL, 
					domain_id = '". DOMAIN_ID ."', 
					project_id = ". ({$_POST['project_id']} ? "'". ${_POST}['project_id'] ."'" : 
						($_POST['project_id'] ? "'". ${_POST}['project_id'] ."'" : "NULL")) .",
					
					type_id = ". ($_POST['type_id_'. $key] ? "'". $_POST['type_id_'. $key] ."'" : 
						($_POST['type_id'] ? "'". ${_POST}['type_id'] ."'" : "NULL")) .",
					contact_id = ". ({$file['type']} ? "'". ${file}['type'] ."'" : "NULL") .",
					
					file_type = ". ({$file['type']} ? "'". ${file}['type'] ."'" : "NULL") .",
					file_size = ". ({$file['size']} ? "'". ${file}['size'] ."'" : "NULL") .",
					file_name = ". ({$file['name']} ? "'". ${file}['name'] ."'" : "NULL") .",
					
					title = ". ($_POST['image_title_'. $key] ? "'". $_POST['image_title_'. $key] ."'" : 
						($_POST['title'] ? "'". ${_POST}['title'] ."'" : "NULL")) .",
					
					caption = ". ($_POST['image_caption_'. $key] ? "'". $_POST['image_caption_'. $key] ."'" : 
						($_POST['caption'] ? "'". ${_POST}['caption'] ."'" : "NULL")) .",
					
					date = ". ($_POST['date_'. $key] ? "'". $_POST['date_'. $key] ."'" : 
						($_POST['date'] ? "'". ${_POST}['date'] ."'" : "NULL")) ."";
				
				$alert[] = $sql;
				
				
				if ( !mysqli_query($db, $sql) ) {
					
					$alert[] = mysqli_error($db);
					
					$error[$key] = "There was an error uploading file #". $key .". An administrator has been contacted to resolve the issues. If you need immediate assistance please submit a trouble ticket.";
					error($error[$key],$sql,1);
				} elseif ( $last_insert_id = mysqli_insert_id($db) ) {
					
					// PROCESS THE FILE UPLOAD
					//$filename = "/Library/WebServer/Documents/ARCHXCHANGE/domain/uploads/". uniqid("") ."";
					//$filename = uniqid("")
					//$path = "/Library/WebServer/Documents/ARCHXCHANGE/domain/uploads/";
					//$alert[] = move_uploaded_file($_FILES[$key][tmp_name], $path.$filename);
					
					// sudo chmod 1777 /tmp
					// http://meta.wikimedia.org/wiki/Running_MediaWiki_on_Mac_OS_X
					$file_uploaded = $last_insert_id .".png";
					$command = (LOCAL ? "/usr/local/bin/convert" : "convert") ." -resize 800x800'>' ". ${file}['tmp_name'] ." ". 
						(LOCAL ? ROOT_DIR ."uploads/" : "../uploads/") ."". $file_uploaded;
					//$command = "convert '". $_FILES[$key][tmp_name] ."' ../uploads/". $last_insert_id .".png";
					//$command = "convert ../uploads/". $file ." ../uploads/". $last_insert_id .".png";
					
					//$alert[] = move_uploaded_file($_FILES[$key][tmp_name], "../uploads/". $file_uploaded);
					
					//exec($command, $output,1);
					exec($command);
					
					//dev_print($output);
					
					//if ( !exec($command, $output,1) ) {
						//$alert[] = "OOPS! there was a problem uploading your file! --> ". $command;
						
					//} else 
					$alert[] = "executed successfully --> ". $command;
					
					// check if file exists
					//$filename = '/path/to/foo.txt';
					$filename = ROOT_DIR ."uploads/". $file_uploaded;
					
					
					if (file_exists($filename)) {
						header("location:project.php?". CRYPT_REF_ID ."=". ${_GET}['CRYPT_REF_ID']);
						$alert[] = "location:project.php?". CRYPT_REF_ID ."=". ${_GET}['CRYPT_REF_ID'];
					} else {
						$sql = "DELETE FROM template_images WHERE image_id = '". $last_insert_id ."' AND domain_id = '". DOMAIN_ID ."' LIMIT 1";
						if (!mysqli_query($db, $sql)) error("there was an error removing a new image from the database because the new image file could not be uploaded",$sql,1,null,"remove the image manually (". LOCAL_DOMAIN ."upload/". $file_uploaded .")");
					}
					
				}
				
			}
			
			
		}
		
	}
	
	
	
} elseif ( ${_POST}['UPDATE_IMAGE'] && ${_GET}['image_id'] ) { // 
	
	
	if ( ${_FILES}['update_image_file']['name'] ) {
		
		
		$alert[] = "image upload info --> ". ${_FILES}['update_image_file']['tmp_name'] .",". ${_GET}['image_id'] ."";
		if ( image_upload($_FILES['update_image_file']['tmp_name'],$_GET['image_id']) ) {
			$alert[] = "upload was successful!";
		}
	}
	
	$sql = "UPDATE template_images SET 
		project_id = ". ({$_POST['project_id']} ? "'". ${_POST}['project_id'] ."'" : "NULL") .",
		type_id = ". ({$_POST['type_id']} ? "'". ${_POST}['type_id'] ."'" : "NULL") .",
		contact_id = ". ({$_POST['contact_id']} ? "'". ${_POST}['contact_id'] ."'" : "NULL") .",
		title = ". ({$_POST['title']} ? "'". ${_POST}['title'] ."'" : "NULL") .",
		caption = ". ({$_POST['caption']} ? "'". ${_POST}['caption'] ."'" : "NULL") .",
		date = ". ({$_POST['date']} ? "'". ${_POST}['date'] ."'" : "NULL") ." 
		WHERE domain_id = '". DOMAIN_ID ."' AND image_id = '". ${_GET}['image_id'] ."' LIMIT 1";
	
	$alert[] = $sql;
	
	
	if ( !mysqli_query($db, $sql) ) {
		
		$alert[] = mysqli_error($db);
		
		${error}['SUBMIT'] = "There was an error updating your file information. An administrator has been contacted to resolve the issues. If you need immediate assistance please submit a trouble ticket.";
		error($error['SUBMIT'],$sql,1);
	} else {
		
		$alert[] = "location:project.php?". CRYPT_REF_ID ."=". ${_POST}['project_id'];
		//header("location:project.php?". CRYPT_REF_ID ."=". ${_POST}['project_id']);
		
	}
				
	
	
} elseif ( ${_POST}['DELETE_IMAGE'] ) {
	
	if ( !$_POST['delete_confirmation'] ) {
		${error}['DELETE'] = "Please confirm that you want to delete this image and all the image information associated with it (caption, date, etc.).";
		
		//$error['DELETE'] = "you are trying to delete ". ROOT_DIR ."/uploads/". ${_GET}['image_id'] .".png";
		
		
	} else {
		
		$sql = "DELETE FROM template_images 
			WHERE domain_id = '". DOMAIN_ID ."' AND image_id = '". ${_GET}['image_id'] ."' LIMIT 1";
		if ( !mysqli_query($db, $sql) ) {
			${error}['DELETE'] = "There was an error deleting this image. An administrator has been contacted to resolve the issues. If you need immediate assistance please submit a trouble ticket.";
			error($error['DELETE'],$sql,1);
		} else {
			$file_loc = ROOT_DIR ."/uploads/". ${_GET}['image_id'] .".png";
			if ( !unlink($file_loc) ) error("the file (". $file_loc .") could not be removed",3,null,"manually remove the file, the member was not informed of the error");
			header("location:project.php?". CRYPT_REF_ID ."=". ${_POST}['project_id']);
		}
	}
}


//dev_print($_POST);
//dev_print($alert);

// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_header_admin.php");

//echo "<H1>THIS IS THE PROJECT IMAGES MANAGER</H1>";


echo "<h2></h2><div id='nifty'>ToDo: Add link to open new window of images at full size.</div>";

/*
echo "<form enctype='multipart/form-data' method='post' action=''>
	<input name='file' type='file'> <input type='submit' value='Upload'>
</form>";

 onclick=\"new Effect.toggle('testFile','slide',{
		onComplete: function(){ alert('the effect is finished');
	}
	})\"
	
	onclick=\"new Element.toggle('testFile','slide',{
		duration: 10
	}); return true;\"
	
	border:solid gray 1px;
	
*/

echo "<STYLE TYPE=\"text/css\">
	<!--
		
		
		
	-->
</STYLE>

<script type=\"text/javascript\">
	<!--
	
	var p = ''
	var r
	var t
	
	function uploadingImages() {
		if ( document.getElementById('periodContainer').style.visibility == 'hidden' ) {
			document.getElementById('periodContainer').style.visibility = 'visible' }
		if ( p == '.....' ) { r = '' } else { r = p+'.' }
		p = r
		document.getElementById('periods').innerHTML = p;
		t = setTimeout(\"appendPeriods()\",500)
	}
	
	function testThis(elem) {
		//var justAVar = document.getElementById(elem);
		//document.getElementById(elem).value = '/Users/anastas/Desktop/ IMAGES/all_things_organic.png';
		//var testVar = justAVar.value;
		//var testVar = this.form.uploadForm.value;
		//testVar = document.uploadForm.1.value
		//alert(testVar);
	}
	
	-->
</script>

<div style='opacity:.7;background-color:black;border:4px solid gray;position:absolute;left:100px;top:300px;width:430px;visibility:hidden;' id='periodContainer'>
	<h2 style='opacity:1;padding:30px 50px;font-size:16pt;color:white;font-weight:normal;letter-spacing:.1em'>UPLOADING IMAGES<span id='periods'></span></h2></div>
";

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
//echo "<TABLE BORDER=0 BORDERCOLOR=PINK ALIGN=CENTER CELLPADDING=1 CELLSPACING=0 RULES=NONE>";
echo form_table_start();
//echo "<FORM ACTION=" . ${_SERVER}['PHP_SELF'] . " METHOD=POST>";




//////// MAIN SECTION HEADING
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


echo "<TABLE BORDER=0 BORDERCOLOR=orange ALIGN=CENTER width=100% CELLPADDING=3 CELLSPACING=0 RULSE=NONE>";
/*
echo "<FORM ACTION='". ${_SERVER}['PHP_SELF'] ."' METHOD=GET>";


	$insert_form[] = array("-",NULL,"Departments Manager"); // TITLE
	
	
	$insert_form[] = array("-",NULL,5); // SPACER
	
	////////// QUESTION
	$insert_form[] = array("?", NULL, "Would you like to edit an existing department?");
	////////// NOTE
	//$insert_form[] = array("_", NULL, "Select an existing department below to edit it.");
	
	//////////////////////////////////////////////////
	$sql = "SELECT * FROM template_departments WHERE domain_id = '". DOMAIN_ID ."'";
			//	ORDER BY department";
	$query = mysqli_query($db, $sql);
	if ( mysqli_num_rows($query) > 0 ) {
		
		${input}['department_id'] = "<SELECT NAME='". CRYPT_REF_ID ."' ". html_onchange() .">";
		
		// INSERT SELECT
		${input}['department_id'] .= "<OPTION VALUE=''>SELECT ---></OPTION>";
		
		while ( $info = mysqli_fetch_assoc($query) ) {
			
			//dev_print($info);
			// SELECTED
			if ( ${_GET}['CRYPT_REF_ID'] == ${info}['department_id'] ) {
				$edit = $info;
				
				if ( ${previous}['department_id'] ) ${adjacent}['previous'] = ${previous}['department_id'];
				$insert_next = TRUE;
				
			} elseif ( $insert_next && !$adjacent['next'] ) {
				${adjacent}['next'] = ${info}['department_id'];
			}
			
			
			${input}['department_id'] .= "<OPTION VALUE='". ${info}['department_id'] ."' ". 
				($_GET['CRYPT_REF_ID'] == ${info}['department_id'] ? " SELECTED" : NULL) .">". ucwords({$info['department']}) ." [". ${info}['department_id'] ."]</OPTION>";
			$previous = $info;
		}
		${input}['department_id'] .= "</SELECT>";
	}
	
	////////// EXISTING DEPARTMENTS
	$insert_form[] = array("department_id", "existing departments", 
		${input}['department_id'],
		NULL,NULL,NULL);
	
	
	if ( ${_GET}['CRYPT_REF_ID'] ) {
		////////// ADJACENT - NEXT / PREVIOUS
		$insert_form[] = array("adjacent", NULL, 
			($adjacent['previous'] ? 
				"<A HREF='". ${_SERVER}['PHP_SELF']."?". CRYPT_REF_ID ."=". ${adjacent}['previous'] ."'><SMALL><< PREVIOUS</SMALL></A>" : NULL) .
			($adjacent['previous'] && ${adjacent}['next'] ? " | " : NULL) .
			($adjacent['next'] ? 
				"<A HREF='". ${_SERVER}['PHP_SELF']."?". CRYPT_REF_ID ."=". ${adjacent}['next'] ."'><SMALL>NEXT >></SMALL></A>" : NULL),
			array(NULL,NULL,"padding-left:40px;"),NULL,NULL);
	}
	
	
	////////// PROCESS FORM ARRAY
	//////////////////////////////////////////////////

	echo form_input($insert_form); $insert_form = NULL;
	
	//////////////////////////////////////////////////
	
	
	
	////////// FORM
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	
	echo "</FORM>";
	
	*/
	
	echo "<FORM name=uploadForm enctype='multipart/form-data' ACTION='". ${_SERVER}['PHP_SELF'] . 
		($_SERVER['QUERY_STRING'] ? "?". ${_SERVER}['QUERY_STRING'] : NULL) ."' METHOD=post>
		<INPUT TYPE=HIDDEN NAME=MAX_FILE_SIZE VALUE=5000000>"; //  onSubmit=\"disableForm(this);\"
	
	
	////////// SUBTITLE
	$insert_form[] = array("-", NULL, "IMAGE MANAGER");
	
	
	if ( ${_GET}['image_id'] ) {
		
		////////// GET IMAGE INFORMATION
		//////////////////////////////////////////////////
		if ( ${_GET}['image_id'] ) {
			$sql = "SELECT * FROM template_images ti 
			WHERE ti.domain_id = '". DOMAIN_ID."' 
				AND ti.image_id = '". ${_GET}['image_id'] ."' LIMIT 1";
			$query = mysqli_query($db, $sql);
			$edit = mysqli_fetch_assoc($query);
		}
		
		
		////////// IMAGES
		$insert_form[] = array("image", null,
			"<IMG border=0 SRC='". LOCAL_DOMAIN ."/uploads/". ${edit}['image_id'] .".png' style='height:200px;'>",
			//pop_image("http://". DOMAIN ."/uploads/". ${edit}['image_id'] .".png"),
			//pop_image(ROOT_DIR ."domain/uploads/". ${edit}['image_id'] .".png"),
			NULL,NULL,array(value=>1));
		
		
		////////// QUESTISON
		$insert_form[] = array("?", NULL, "Would you like to change this image?");
		
		
		////////// FILES
		$insert_form[] = array("update_image_file", "update image",
			array("FILE",NULL,NULL,NULL),
			NULL,null,array(value=>1));
		
		////////// SUBTITLE
		$insert_form[] = array("_", NULL, "Edit Existing Image File Information");
		
		
	} else {
		
		
		////////// SUBTITLE
		$insert_form[] = array("_", NULL, "Select New Files to Upload");
		
		/*
		////////// FILES
		$insert_form[] = array("file_".++$file_index, $file_index .".",
			array("FILE",$edit["image_file_".$file_index],NULL,NULL),
			NULL,"<a href='#' onclick=\"Effect.toggle('image_details_". $file_index ."', 'blind',{duration: 0.5});\" style=''>customize image information</a>
	  
				<div id='wrapper'>
					<div id='image_details_". $file_index ."' style='display:none;padding:5px;border:1px outset lightgray;margin-top:4px;background-color:#eee;'>
						image type ". local_type_menu($file_index) ."<br />
						caption<br /><textarea name=image_caption_". $file_index ." style='width:100%;' rows=3></textarea><br />
						<script>DateInput('date_". $file_index ."',true)</script>
						
						
					</div>
				</div>
					",array(value=>1));
		
		"<a href='#' onclick=\"Effect.toggle('testFile', 'blind',{
				duration: 0.5
			});\" style='padding:4px;border:outset gray 1px;border-bottom-width:0px;position:relative;top:3px;z-index:100;'>this is the link</a>
				<div id='wrapper'>
					<div id='testFile' style='display:none;padding:5px;border:1px outset gray;margin-top:4px;height:100px;'>
						
						<input type=text name=file1>
						
					</div>
				</div>
					"
					*/
		
		////////// FILES
		//$insert_form[] = array(++$file_index, $file_index .".",
			//array("FILE",null,NULL,"id=\"testFile\""),
			//"<input type='file' name='1' id='testFile'>",
			//NULL,local_form_image_details($file_index),array(value=>1));
		////////// FILES
		$insert_form[] = array(++$file_index, $file_index .".",
			array("FILE",NULL,NULL,NULL),
			NULL,local_form_image_details($file_index),array(value=>1));
		////////// FILES
		$insert_form[] = array(++$file_index, $file_index .".",
			array("FILE",NULL,NULL,NULL),
			NULL,local_form_image_details($file_index),array(value=>1));
		////////// FILES
		$insert_form[] = array(++$file_index, $file_index .".",
			array("FILE",NULL,NULL,NULL),
			NULL,local_form_image_details($file_index),array(value=>1));
		////////// FILES
		$insert_form[] = array(++$file_index, $file_index .".",
			array("FILE",NULL,NULL,NULL),
			NULL,local_form_image_details($file_index),array(value=>1));
		////////// FILES
		$insert_form[] = array(++$file_index, $file_index .".",
			array("FILE",NULL,NULL,NULL),
			NULL,local_form_image_details($file_index),array(value=>1));
		
		
		////////// SPACER
		$insert_form[] = array("-", NULL, 10);
		
		////////// QUESTION
		//$insert_form[] = array("?", NULL, "<a href='#' onclick=\"testThis('imageCaption');\">test caption</a><a href='#' onclick=\"testThis('testFile');\">test file</a>");
		
		////////// QUESTION
		$insert_form[] = array("?", NULL, "Would you like to set the default settings for all of these images?");
		
		
		////////// SPACER
		$insert_form[] = array("_", NULL, "DEFAULT IMAGE INFORMATION");
		
	}
	
	////////// DEPARTMENT
	//$insert_form[] = array("tags", "tags", // $field_name // WITH TRANSLATION FUNCTION
	//	array("TEXT",$edit['department'],NULL,NULL), // ${input}['type'], ${input}['value'], ${input}['style'], ${input}['option']
	//	NULL,NULL,array(value=>1)); // $styles,$trailer,$options
	

	
	////////// IMAGE TITLE
	$insert_form[] = array("title", "title",
		array("TEXT",{$edit['title']},"","id='imageTitle'"),
		NULL,NULL,array(value=>1));
	
	////////// DEFAULT IMAGE TYPES
	$insert_form[] = array("project_id", "project",
		local_project_menu("project_id",$edit['project_id']),
		NULL,NULL,array(value=>1));
		
	
	
	////////// DEFAULT IMAGE TYPES
	$insert_form[] = array("type_id", "image type",
		local_type_id_menu($prefix="type_id",null,$edit['type_id']),
		NULL,NULL,array(value=>1));
	////////// IMAGE CAPTION
	$insert_form[] = array("caption", "caption",
		array("TEXTAREA",{$edit['caption']},NULL,"ROWS=5 id='imageCaption'"),
		NULL,NULL,array(value=>1));
	
	
	////////// INACTIVE CHECKBOX
	//$insert_form[] = array("inactive", NULL, 
	//	"<INPUT TYPE=CHECKBOX NAME=inactive VALUE=1 ". ({$edit['inactive']} ? " CHECKED" : NULL) ."> check to make department inactive",
	//	NULL,NULL,NULL);
	
	////////// DEFAULT DATE
	$insert_form[] = array("date", "date",
		"<script>DateInput('date',false,'YYYY-MM-DD'". ({$edit['date']} ? ",'". ${edit}['date'] ."'" : null) .")</script>",
		NULL,NULL,NULL);
	
	
	//////////////////////////////////////////////////
	/*if ( ${_GET}['CRYPT_REF_ID'] ) {
		${input}['submit'] = "<INPUT TYPE=SUBMIT NAME='CHANGE' VALUE='SUBMIT CHANGES'> 
			<INPUT TYPE=SUBMIT NAME='ADD' VALUE='ADD AS NEW'> ";
		
		${input}['delete'] = "<INPUT TYPE=SUBMIT NAME=DELETE VALUE='DELETE...'> 
			". ({$error['DELETE']} ? "<INPUT TYPE=CHECKBOX NAME=confirm_delete>check to confirm delete" : null);
		
	} else {*/
		//$input['submit'] = "<INPUT TYPE=SUBMIT NAME='ADD' VALUE='UPLOAD IMAGES' onClick=\"uploadingImages();return safeSubmit(this);\">"; // onMouseUp=\"this.disabled=true;\"
	//}
	
	if ( ${_GET}['image_id'] ) {
		
		${input}['SUBMIT'] = "<INPUT TYPE=SUBMIT NAME='UPDATE_IMAGE' VALUE='UPDATE IMAGE'>"; // onClick=\"safeSubmit(this);\"
		
		
		${input}['DELETE'] = "<INPUT TYPE=SUBMIT NAME='DELETE_IMAGE' VALUE='DELETE IMAGE...'> 
				<INPUT TYPE=CHECKBOX NAME='delete_confirmation'> check to confirm delete"; // onClick=\"safeSubmit(this);\"
		
	} else {
		${input}['SUBMIT'] = "<INPUT TYPE=SUBMIT NAME='ADD_IMAGES' VALUE='UPLOAD IMAGES' onClick=\"return uploadingImages();return safeSubmit(this);\">";
	}
	
	${input}['SUBMIT'] .= "<INPUT TYPE=SUBMIT NAME='BACK' VALUE='BACK'>";
	
	////////// SUBMIT
	$insert_form[] = array("SUBMIT", NULL,
		${input}['SUBMIT'],
		NULL,NULL,NULL);
	
	
	////////// DELETE
	$insert_form[] = array("DELETE", NULL,
		${input}['DELETE'],
		NULL,NULL,NULL);
	
	
////////// PROCESS FORM ARRAY
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

	echo form_input($insert_form);
	
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

echo "</FORM>";
echo "</TABLE>";

dev_print($_POST);
dev_print($_FILES);

////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_footer.php");

?>
