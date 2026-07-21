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
//define("TITLE","PAGE TITLE"); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0

if ( $_FILES["file"] ) {
	
	dev_print($_FILES);
	
	// define the base image dir 
	$base_img_dir = "./upload/";
	
	// Allowed file types
	$allowed_types = array(
		'image/jpeg',
		'image/pjpeg',
		'image/png',
		'image/gif',
		'image/webp'
	);
	
	$allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
	
	$error = null;
	
	// Validate upload
	if ( $_FILES['file']['error'] !== UPLOAD_ERR_OK ) {
		$error = "Upload error code: " . $_FILES['file']['error'];
	}
	
	// Validate file size (max 10MB)
	if ( !$error && $_FILES['file']['size'] > 10485760 ) {
		$error = "File too large. Maximum 10MB allowed.";
	}
	
	// Validate MIME type
	if ( !$error ) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
		finfo_close($finfo);
		
		if ( !in_array($mime_type, $allowed_types) ) {
			$error = "Invalid file type: " . htmlspecialchars($mime_type) . ". Only images allowed.";
		}
	}
	
	// Validate extension
	if ( !$error ) {
		$ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
		if ( !in_array($ext, $allowed_extensions) ) {
			$error = "Invalid file extension. Allowed: " . implode(', ', $allowed_extensions);
		}
	}
	
	// Verify it's a real image
	if ( !$error ) {
		$imginfo = @getimagesize($_FILES['file']['tmp_name']);
		if ( !$imginfo ) {
			$error = "File is not a valid image.";
		}
	}
	
	if ( !$error ) {
		// generate unique id for use in filename
		$uniq = uniqid("");
		
		// new file name with safe extension
		$filename = $base_img_dir . $uniq . '.' . $ext;
		
		// move uploaded file to destination
		if ( move_uploaded_file($_FILES['file']['tmp_name'], $filename) ) {
			dev_print($imginfo);
			echo "\$filename --> " . htmlspecialchars($filename) . "<p>";
		} else {
			$error = "Failed to save uploaded file.";
		}
	}
	
	if ( $error ) {
		echo "<p style='color:red;'><b>Error:</b> " . htmlspecialchars($error) . "</p>";
	}
}




// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////


echo "<form enctype='multipart/form-data' method='post' action=''>
	<input name='file' type='file'> <input type='submit' value='Upload'>
</form>";

////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
