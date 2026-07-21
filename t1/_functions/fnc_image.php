<?php




/*		function image_upload_shopsomona($dst_dir, $dst_file, $max=640, $options=NULL) { // UPLOAD IMAGE WITH SPECIFIED SETTINGS
	
	
	// DIRECTORY
	if ( !$dst_dir ) ${error}['dst_dir'] = "please specify a directory to copy the image to";
	
	// FILE NAME
	if ( !$dst_file ) ${error}['dst_file'] = "please specify a file name for the image";
	
	// MAX DIMENSIONS (WIDTH / HEIGHT)
	//if ( !$max ) $max = 640;
	
	
	if ( $_FILES['upload_file'. ${options}['suffix']][name] ) {
	
		//dev_print($_FILES);
		
		set_time_limit(60); // SET TIMEOUT LIMIT IN CASE UPLOAD TAKES TOO LONG
		
		
		////////// CHECK IF JPG FORMAT 
		if ( !preg_match("/jpeg/i", $_FILES['upload_file'. ${options}['suffix']][type]) ) ${error}['image_type'] = "please use .jpg image file format";
		
		////////// CHECK IF FILE IS TOO BIG
		if ( $_FILES['upload_file'. ${options}['suffix']][size] > ($_POST['MAX_FILE_SIZE'] ? ${_POST}['MAX_FILE_SIZE'] : 2000000) ) {
			${error}['MAX_FILE_SIZE'] = "please use files under 2MB";
		}
		
		
		////////// UPLOAD FILE
		/////////////////////////////////////////////////////////////////////////////////////
		if ( !$error ) {
			
			
			////////// DEFINE SOURCE FILE
			$src_file = $_FILES['upload_file'. ${options}['suffix']][tmp_name];
			$dst_file = $dst_dir ."/". $dst_file . ".jpg";
			
			////////// CREATE SOURCE IMAGE REFERENCE
			if ( !$src_im = ImageCreateFromJpeg($src_file) ) {
				${error}['src_im'] = "Failed to upload the photo <B><I>" . $_FILES['upload_file'. ${options}['suffix']][name] . "</I></B>";
			}
			
			
			////////// GET SOURCE IMAGE DIMENSIONS
			//$src_w = imagesx($src_im) - 10;
			//$src_h = imagesy($src_im) - 10;
			
			$src_w = imagesx($src_im);
			$src_h = imagesy($src_im);
			
			
			////////// DESTINATION DIMENSIONS
			//$max = 640; // MAX IMAGE DIMENSION
			
			if ( $src_w >= $src_h && $src_w > $max ) {
					$factor = ($max / $src_w);
			} elseif ( $src_h > $src_w && $src_h > $max ) {
					$factor = ($max / $src_h);
			} else {
				$factor = 1;
			}
			
			//$dst_w = ceil($src_w * $factor);
			//$dst_h = ceil($src_h * $factor);
			$dst_w = ceil($src_w * $factor);
			$dst_h = ceil($src_h * $factor);
			
			$dst_x = 0;
			$dst_y = 0;
			$src_x = 0;
			$src_y = 0;
			
			////////// CREATE DESTINATION IMAGE (OUTPUT IMAGE)
			$dst_im = imagecreatetruecolor($dst_w, $dst_h); // DESTINATION IMAGE
			//$dst_im = imagecreate($dst_w, $dst_h); // DESTINATION IMAGE
			
			
			//echo "CREATING IMAGE FILE! ($dst_im, $src_im)<P>";
			
			////////// COPY IMAGE TO DESTINATION
			if ( !@imagecopyresized ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, ($dst_w + 1), ($dst_h + 1), ($src_w), ($src_h)) ) {
				$error[] = "Failed to upload the photo <B><I>" . $_FILES['upload_file'. ${options}['suffix']][name] . "</I></B>";
			}
			
			
			////////// CREATE THE IMAGE FILE
			if ( !ImageJpeg ($dst_im, $dst_file) ) {
				$error[] = "Failed to upload the photo <B><I>" . $_FILES['upload_file'. ${options}['suffix']][name] . "</I></B>";
			} else {
				//echo "CREATED IMAGE FILE! ($dst_im, $dst_file)<P>";
			}
			
			
			
			////////// DESTROY IMAGES
			ImageDestroy ($dst_im);
			ImageDestroy ($src_im);
			
		}
		
		
	} else {
		${error}['file'] = "please specify a file name for the image";
	}
	
	// SEND ERROR
	if ( $error ) return $error;
	
}
/**** END FUNCTION ****/





		function image_exists($src) { // CHECK IF REMOTE IMAGE EXISTS
	////////// CHECK IF IMAGE EXISTS
	if ( @fclose(@fopen($src, "r")) ) {
		return TRUE; // IMAGE EXISTS
	} else {
		return FALSE; // NO IMAGE EXISTS
	}
	
}
/**** END FUNCTION ****/





/*		function image_product($ref_id,$set_id,$options=NULL) { // CHECK IF PRODUCT IMAGE EXISTS
	
	////////// CHECK IF IMAGE EXISTS
	
	// PRODUCT IMAGE FILE
	$product_image_file = DEFAULT_ROOT_DIR ."images_products/". $ref_id .".jpg";
	$product_image_set_file = DEFAULT_ROOT_DIR ."images_swatch_set/". $set_id .".jpg";
	
	
	if ( $set_id && file_exists($product_image_set_file) ) { // IF PRODUCT IMAGE SWATCH SET EXISTS -->
		
		// DISPLAY PRODUCT IMAGE 
		// changed to return image to have more control 2005 09 06
		//$image = image_insert($product_image_set_file,$options);
		// RETURN PRODUCT IMAGE PATH
		return $product_image_set_file;
		
	} elseif ( file_exists($product_image_file) ) { // IF PRODUCT IMAGE EXISTS -->
		
		// DISPLAY PRODUCT IMAGE 
		// changed to return image to have more control 2005 09 06
		//$image = image_insert($product_image_file,$options);
		// RETURN PRODUCT IMAGE PATH
		return $product_image_file;
		
	} else { // GET FIRST AVAILABLE PRODUCT IMAGE FROM DIFFERENT SWATCH -->
		
		$sql = "SELECT * FROM products_swatch_sets WHERE ref_id = ". $ref_id ."";
		if ( !$query_sets = mysqli_query($db, $sql) ) {
			error("there was an error trying to acess the product swatch set",$sql,3);
		} else {
			
			// CHECK FOR SWATCH SET IMAGE
			while ( $set = mysqli_fetch_assoc($query_sets) ) {
				
				// SWATCH SET IMAGE FILE
				$product_set_image_file = DEFAULT_ROOT_DIR ."images_swatch_set/". ${set}['set_id'] .".jpg";
				
				if ( file_exists($product_set_image_file) ) {
					
					// DISPLAY PRODUCT IMAGE
					// changed to return image to have more control 2005 09 06
					//$image = image_insert($product_set_image_file,$options);
					//break;
					
					// RETURN PRODUCT IMAGE PATH
					return $product_set_image_file;
				}
			}
		}
	}
	
	//return $image;
	
}
/**** END FUNCTION ****/





/*		function image_insert($src,$options=NULL) { // CHECK IF REMOTE IMAGE EXISTS
	
	////////// CHECK IF IMAGE EXISTS
	if ( image_exists($src) ) {
		
		if ( ${options}['max'] && !preg_match("/WIDTH|HEIGHT/i",$options['html'])) {
			
			list($width, $height) = getimagesize($src);
			
			if ( $width >= $height || ${options}['width'] && !$options['height'] ) {
				${options}['html'] .= " WIDTH=". ${options}['max'];
			} else {
				${options}['html'] .= " HEIGHT=". ${options}['max'];
			}
		}
	
		return "<IMG BORDER=0 SRC='". $src ."' ". ${options}['html'] ." CLASS='". ${options}['class'] ."' STYLE='". ${options}['style'] ."'>";
	}
	
}
/**** END FUNCTION ****/





		function image_upload($src_file,$image_id,$options=NULL) { // CONVERT AND RENAME IMAGE USING IMAGEMAGICK CONVERT
	echo "HERE IN THE FNC!<P>";
	////////// CHECK IF IMAGE EXISTS
	$dst_file = $image_id .".png";
	//$dst_file_path = (LOCAL ? ROOT_DIR ."/uploads/" : "../uploads/");
	$dst_file_path = ROOT_DIR ."/uploads/";
	
	//chown($dst_file_path . $dst_file,'wheel');
	//chmod($dst_file_path . $dst_file,0777);
	//echo "chmod --> $dst_file_path$dst_file,0777<P>";
	$command = (LOCAL ? "/usr/local/bin/convert" : "convert") ." -resize 800x800'>' ". escapeshellarg($src_file) ." ". 
	escapeshellarg($dst_file_path . $dst_file);
	echo "COMMAND --> $command<P>";
	exec($command);
	
	//if ( file_exists($dst_file_path . $dst_file) ) {
		return true;
	//} else return false;
	
}
/**** END FUNCTION ****/





/*		function image_ xxxxxx($src,$options=NULL) { // DESCRIPTION OF FUNCTION HERE
	
	////////// TITLE
	return $return;
	
}
/**** END FUNCTION ****/




?>
