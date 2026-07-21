<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
define("ACCESS", NULL); // see config.php for settings

define("TEMPLATE_BASE_DIR","./"); // WHERE IS THE BASE DIRECTORY?
require(TEMPLATE_BASE_DIR . "config.php"); // _functions/fnc.php


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0

// get the project information or forward back to the project search page
if ( ${_GET}['CRYPT_REF_ID'] ) {
	$sql = "SELECT * FROM projects p 
		LEFT JOIN projects_title pt ON p.project_id = pt.project_id 
		LEFT JOIN projects_location pl ON p.project_id = pl.project_id 
		WHERE p.project_id = '". ${_GET}['CRYPT_REF_ID'] ."'";
	
	$log[] = "\$sql --> ". $sql ."<P>";
	
	if ( !$query = mysqli_query($db, $sql) ) {
		error("there was a db error accessing the project information",$sql);
	} else {
		if ( mysqli_num_rows($query) < 1 ) {
			header("location:find.php");
		} else {
			$info = mysqli_fetch_assoc($query);
			$log[] = $info;
		}
	}
} else {
	header("location:find.php");
}


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
//define("TITLE","PAGE TITLE"); // PAGE TITLE

/*
$vars["description"]["sql"] = "	SELECT pd.*, u.firstname, u.lastname, u.user_id FROM projects_description pd 
	LEFT JOIN users u ON pd.user_id = u.user_id 
	WHERE pd.project_id = '". ${_GET}['CRYPT_REF_ID'] ."' ORDER BY pd.project_id ASC";

$vars["team"]["sql"] = "SELECT * FROM projects_team pt 
	LEFT JOIN professions p ON p.profession_id	 = pt.profession_id 
	WHERE pt.project_id = ". ${_GET}['CRYPT_REF_ID'] ." ORDER BY p.profession ASC";
	
*/

//$error['style'][] = "That style already exists for this project.";

function local_type($type) {
	
	global $error;
	
	$return = "<div style='margin-left:160px;'>";
	/*
	echo "<div id='projectTitle' style='margin-left:160px;background-color:#FAFBBB;'>
	<div><h1 style=''>". ${info}['title'] ."<a href='#' style='position:absolute;right:0px;' class='button'>+ Add New Title</a></h1></div>
	". local_type("title") ."
	</div>";
	*/
	
	$return .= ($type != "title-disabled" 
		? "<h2 style='padding:4px;'>". ucwords($type) ." Blog <a href='#' style='' class='button' 
		 	onclick=\"new Effect.toggle('add_". $type ."','slide'); return false;\"><img border=0 src='". TEMPLATE_BASE_DIR ."_images/icon_plus.gif'></a></h2>"
		: "<h2 style='padding:4px;'><a href='#' style='position:absolute;right:0px;' class='button' 
		 	onclick=\"new Effect.toggle('add_". $type ."','slide'); return false;\">+ Add New ". ucwords($type) ."</a></h2>");
		//($type != "title" ? "" : null);
	
	// ERRORS
	if ( is_array($error[$type]) ) {
		$return .= "<div id=error style='' class='error'>";
		//foreach($error AS $key => $value) {
		//	$return .= $value;
		//}
		$return .= implode("<br />",$error[$type]);
		$return .= "</div>";
	}
	
	
	///////////////// STOP!
	// THIS PART SHOULD BE CUSTOMIZED DEPENDING ON DATA TYPE
	///////////////////////////////////
	$return .= "<div id='add_". $type ."' ". ( $error[$type] ? null : "style='display:none;'") .">
		<div class='form'>
			<form name='". $type ."_form' method='post'>";
			
			///////////////// STOP!
			// THIS PART SHOULD BE CUSTOMIZED DEPENDING ON DATA TYPE
			///////////////////////////////////
			switch ( $type ) {
				case 'title':
					$return .= "<label>Project Title</label>
						<input type=text name='title' ". form_value("Project Title",$_POST['title']) ." style='width:200px;color:gray;'><p>
						<label></label>
						<input type=submit name='SUBMIT_TITLE' value='Submit New Project Title'><p>";
					break;
				
				case 'location':
					$return .= "<label></label>
						LOCATION FORM COMING SOON!<p>";
					break;
					
				case 'category':
					$return .= "<label>Building Category</label>
						<select id='category_id' name='category_id' onChange=\"check_extend_select(this,'Enter the Building Category(for example: Residential, Commercial, Museum, etc.)');formAltered();\">";
							$sql = "SELECT * FROM categories WHERE approved IS NOT NULL";
							$query = mysqli_query($db, $sql);
							while (  $category = mysqli_fetch_array($query) ) {
								$return .= "<option value='". ${category}['category_id'] ."' ". ($_POST['category_id'] == ${category}['category_id'] ? " SELECTED" : null) .">". ucwords($category['category']) ." [". ${category}['category_id'] ."]</option>";
							}
							$return .= "<option value=''>Add Building Category...</option>
						</select><p>
						<label></label>
						<input type='submit' name='SUBMIT_CATEGORY' value='Submit New Building Category'><p>";
					break;
					
				case 'style':
					$return .= "<label>Design Style</label>
						<select id='style_id' name='style_id' onChange=\"check_extend_select(this,'Enter the project style (for example: Minimalism, Romanesque Early Modern, Corporate Modern, etc.)');formAltered();\">";
							$sql = "SELECT * FROM styles WHERE approved IS NOT NULL";
							$query = mysqli_query($db, $sql);
							while (  $style = mysqli_fetch_array($query) ) {
								$return .= "<option value='". ${style}['style_id'] ."' ". ($_POST['style_id'] == ${style}['style_id'] ? " SELECTED" : null) .">". ucwords($style['style']) ." [". ${style}['style_id'] ."]</option>";
							}
							$return .= "<option value=''>Add Design Style...</option>
						</select><p>
						<label></label>
						<input type='submit' name='SUBMIT_STYLE' value='Submit New Design Style'><p>";
					break;
					
				case 'team':
					// add new comments form (hidden / slider) display:none;
					$return .= "<label>Member Name</label><input type='text' name='name' style='width:200px;'><p>
						<label>Profession</label>
						<select id='profession_id' name='profession_id' onChange=\"check_extend_select(this,'Enter the type of profession (for example: Architect, Landscape Architect, Contractor, etc.)');formAltered();\">";
							$sql = "SELECT * FROM professions WHERE approved IS NOT NULL";
							$query = mysqli_query($db, $sql);
							while (  $profession = mysqli_fetch_array($query) ) {
								$return .= "<option value='". ${profession}['profession_id'] ."' ". ($_POST['profession_id'] == ${profession}['profession_id'] ? " SELECTED" : null) .">". ucwords($profession['profession']) ." [". ${profession}['profession_id'] ."]</option>";
							}
							$return .= "<option value=''>Add Team Member...</option>
						</select><p>
						<label></label>
						<input type='checkbox' name='me'> <span>check here if this is you</span><p>
						<label></label>
						<input type='submit' name='SUBMIT_TEAM' value='Submit New Team Member'><p>";
					break;
		
				case 'description':
					$return .= "<label>Title</label>
						<input type=text name='description_title' ". form_value("Description Title",$_POST['title']) ." style='width:200px;color:gray;'><p>
						<label>Description</label>
						<textarea name='description' style='width:200px;' rows=4>". ( ${_POST}['description'] ? ${_POST}['description'] : null ) ."</textarea><p>
						<label></label>
						<input type=submit name='SUBMIT_DESCRIPTION' value='Submit New Description'><p>";
					break;
		
				case 'link':
					$return .= "<label>Link</label>
						<input type=text name='link_title' ". form_value("Link Title",$_POST['link_title']) ." style='width:200px;color:gray;'><p>
						<label>URL/Web Address</label>
						<textarea name='url' style='width:200px;' rows=4>". ( ${_POST}['url'] ? ${_POST}['url'] : null ) ."</textarea><p>
						<label></label>
						<input type=submit name='SUBMIT_LINK' value='Submit New Link'><p>";
					break;
			}
			$return .= "</form>
		</div>
	</div>";
	
	
	$return .= "<form name='". $type ."_form' method=post action='". ${_SERVER}['PHP_SELF'] ."". ($_SERVER['QUERY_STRING'] ? "?". ${_SERVER}['QUERY_STRING'] : NULL) ."'>";
	
	///////////////// STOP!
	// THIS PART SHOULD BE CUSTOMIZED DEPENDING ON DATA TYPE
	///////////////////////////////////
	switch ( $type ) {
		case 'title':
			$sql = "SELECT * FROM projects p 
				LEFT JOIN projects_title pt ON p.project_id = pt.project_id 
				WHERE p.project_id = '". ${_GET}['CRYPT_REF_ID'] ."' ORDER BY pt.title ASC";
			break;
		
		case 'location':
			$sql = "SELECT c.country_name, cz.zone_name, czm.metro_name, pl.city, pl.projects_location_id 
				FROM projects_location pl 
				LEFT JOIN countries c ON c.country_id = pl.country_id 
				LEFT JOIN countries_zones_metros czm ON czm.metro_id = pl.metro_id 
				LEFT JOIN countries_zones cz ON cz.zone_id = pl.zone_id 
				WHERE project_id = '". ${_GET}['CRYPT_REF_ID'] ."' ORDER BY pl.vote_yes DESC";
			break;
		
		case 'category':
			$sql = "SELECT * FROM projects_category pc 
				LEFT JOIN categories c ON c.category_id = pc.category_id 
				WHERE pc.project_id = ". ${_GET}['CRYPT_REF_ID'] ." ORDER BY c.category ASC";
			break;
		
		case 'style':
			$sql = "SELECT * FROM projects_style ps 
				LEFT JOIN styles s ON s.style_id = ps.style_id 
				WHERE ps.project_id = ". ${_GET}['CRYPT_REF_ID'] ." ORDER BY s.style ASC";
			break;
		
		case 'team':
			$sql = "SELECT * FROM projects_team pt 
				LEFT JOIN professions p ON p.profession_id = pt.profession_id 
				WHERE pt.project_id = ". ${_GET}['CRYPT_REF_ID'] ." ORDER BY p.profession ASC";
			break;
		
		case 'description':
			$sql = "SELECT pd.*, u.firstname, u.lastname, u.user_id FROM projects_description pd 
				LEFT JOIN users u ON pd.user_id = u.user_id 
				WHERE pd.project_id = '". ${_GET}['CRYPT_REF_ID'] ."' ORDER BY pd.project_id ASC";
			break;
		
		case 'link':
			$sql = "SELECT * FROM projects_link pl 
				WHERE pl.project_id = ". ${_GET}['CRYPT_REF_ID'] ." ORDER BY pl.vote_yes DESC";
			break;
		
		default:
			$sql = "";
			break;
	}
	
//	$log[] = "\$sql --> ". $sql ."<P>";

	/////////////////////////////////// END

	if ( !$query = mysqli_query($db, $sql) ) {
		error("there was an error trying retrieve the project info",$sql);
	} else {
		//$count = mysqli_num_rows($query);
		while ($info = mysqli_fetch_assoc($query)) {
			
			//background-color:white;border:solid 0px red;position:relative;padding:4px;margin:2px;
			$return .= "<div id='". $type ."_". $info['projects_'. $type .'_id'] ."' style='' class='module' 
				onmouseover=\"highlight('". $type ."','". $info['projects_'. $type .'_id'] ."',true);\" 
				onmouseout=\"highlight('". $type ."','". $info['projects_'. $type .'_id'] ."',false);\">";//;return false
				
			
				////////// VOTING SYSTEM (Is This Accurate? YES NO)
				//////////////////////////////////////////////////
				//z-index:200;
				if ( ${info}['user_id'] == USER_ID && $disabled ) {
					$return .= "<div id='". $type ."_nav_". $info['projects_'. $type .'_id'] ."' style='display:none;position:absolute;left:-1px;bottom:-1px;border:dotted 1px gray;padding:5px 5px 5px 10px;border-left:0px;border-bottom:0px;background-color:#FFFFFF;color:#717272;'>
						This is your post... Do you want to Edit it?</div>";
				} elseif ( ${info}['vote_ip'] == ${_SERVER}['REMOTE_ADDR'] ) { // if ip address has voted already
					$return .= "<div id='". $type ."_nav_". $info['projects_'. $type .'_id'] ."' style='display:none;position:absolute;left:-1px;bottom:-1px;border:dotted 1px gray;padding:5px 5px 5px 10px;border-left:0px;border-bottom:0px;background-color:#FFFFFF;color:#717272;'>
						Your opinion has been recorded</div>";
				} else {
					$return .= "<div id='". $type ."_nav_". $info['projects_'. $type .'_id'] ."' style='display:none;position:absolute;left:-1px;bottom:-1px;border:dotted 1px gray;padding:5px 1px 5px 10px;border-left:0px;border-bottom:0px;background-color:#FFFFFF;'>". //rating($info['projects_'. $type .'_id'],$info['vote_value']) .
						//display:none;position:absolute;left:-1px;bottom:-1px;z-index:200;border:dotted 1px gray;padding:5px;padding-right:0px;background-color:#FAFBDA;

							"Does this look accurate to you? ". //processVote(vote,ref_id,type,user_id,project_id,consecutive=null)
							"<a href='#". $info['projects_'. $type .'_id'] ."' onclick=\"processVote('','yes','". $info['projects_'. $type .'_id'] ."','". $type ."','". USER_ID ."','". ${info}['project_id'] ."','". ${info}['vote_direction'] ."');\" style='padding:4px;' class='button'>Yes</a>".
							//notification('your vote has been recorder!... not really, but it will be at some point');
							"<a href='#". $info['projects_'. $type .'_id'] ."' onclick=\"processVote('','no','". $info['projects_'. $type .'_id'] ."','". $type ."','". USER_ID ."','". ${info}['project_id'] ."','". ${info}['vote_direction'] ."');\" style='padding:4px;' class='button'>No</a>
					</div>";
				}
			
				///////////////// STOP!
				// THIS PART SHOULD BE CUSTOMIZED DEPENDING ON DATA TYPE
				///////////////////////////////////
				switch ( $type ) {
					
					case 'title':
						//dev_print($info);
						//$return .= "<h1 style=''>". ucwords($info['title']) ." [". ${info}['projects_title_id'] ."] </h1>";
						$return .= "<h1 style='padding:4px;background-color:#FAFBBB;'>". ucwords($info['title']) ."</h1>";
					break;
					
					case 'location':
						foreach ($info AS $key => $value) if ( $key != "projects_location_id" && $value ) $temp[$key] = $value;
						$return .= "". ucwords(implode(" > ",$temp)) ." [". ${info}['projects_location_id'] ."]";
					break;
					
					case 'category':
						$return .= ${info}['category'] ." [". ${info}['category_id'] ."]";
					break;
					
					case 'style':
						$return .= ${info}['style'] ." [". ${info}['style_id'] ."]";
					break;
					
					case 'team':
						$return .= "". ucwords($info['name']) ." [". ${info}['projects_team_id'] ."] <i>(". ${info}['profession'] .")</i>";
					break;
					
					case 'description':
						$return .= "<b>". ($info['title'] ? ${info}['title'] :"Discussion ". ${info}['projects_desription_id']) ."</b><br />".
							( strlen($info['description']) > 200 ? substr($info['description'],0,200) ."... " : ${info}['description'] ) ."<p>". 
							ucfirst($info['firstname']) ." ". ucfirst($info['lastname']) ." ". ${info}['stamp'] ."";
					break;
					
					case 'link':
						$return .= "<a href='". ${info}['url'] ."'>". ( ${info}['title'] ?$info['title'] : return_domain($info['title']) ) ."</a> [". ${info}['projects_link_id'] ."]";
					break;
				}
				
				/////////////////////////////////// END
				
				$return .= local_comments($type, $info['projects_'. $type .'_id']);
			
			$return .= "</div>";
			//dev_print($info);
		}
	}
	
	if ( $type == "link" ) {
		//$return .= "this is a test <a href='http://www.wikipedia.org/?chrysler building'>wiki link</a>";
	}
	
	$return .= "</form>";
	$return .= "</div>";
	return $return;
}

function local_type_id( $type ) {
	switch ($type) {
		case "title":
			return 1;
			break;
		case "location":
			return 2;
			break;
		case "category":
			return 3;
			break;
		case "style":
			return 4;
			break;
		case "team":
			return 5;
			break;
		case "description":
			return 6;
			break;
		case "link":
			return 7;
			break;
		default:
			return null;
			break;
	}
	//description 1
	//address 2
	//title 3
}

function local_comments($type, $id) { // types: title, category, location, team, description, style, etc.

	$return = "<div id='". $type ."_comments' style='text-align:right;padding:0px;border:dotted orange 0px;'>";//padding:0 10px 0px 20px;

		// comments
		$sql = "SELECT * FROM comments p 
			LEFT JOIN users u ON p.user_id = u.user_id 
			WHERE p.parent_id = '". $id ."' 
			AND p.type = '". local_type_id($type) ."' 
			ORDER BY p.stamp DESC";
		//echo "\$sql --> ".$sql ."<p>";
		$query_comments = mysqli_query($db, $sql);
		$comment_count = mysqli_num_rows($query_comments);

		// comments link
		$return .= "<a href='#' onclick=\"new Effect.toggle('". $type ."_comments_". $id ."','slide'); return false;\">
			comments (". ($comment_count + 0) .") | + add comments</a>";
			
			// add new comments form (hidden / slider)
			$return .= "<div id='". $type ."_comments_". $id ."' style='display:none;'><div>";
			
				// if comments exist 
				if ( $comment_count > 0 ) { // display existing comments

					//$return .= "<div id='' style='padding:0px;font-style:italic;border:solid thin gray;background-color:#eeeeee;'>";
					while ($comments = mysqli_fetch_assoc($query_comments)) {
						//$return .= $divider .
						//$return .= "<div style='". $divider ."padding:4px;background-color:#dddddd';color:#999999;text-align:right;text-weight:bold;'>". 
						//	ucwords(${comments}['firstname'] ." ". ${comments}['lastname']) ." - ". ${comments}['stamp'] ."</div>
						$return .= "<div style='padding:10px;'>". ${comments}['comment'] ."<br />". 
							ucwords(${comments}['firstname'] ." ". ${comments}['lastname']) ." - ". ${comments}['stamp'] ."</div>";
						//$divider = "<hr color='#eeeeee' width=90%>";
						$divider = "border-top:thin solid gray;";
						
					}
					//$return .= "</div>";
				}
			
				$return .= "<br />
					<form name='comments_form' method='post'>
					<textarea name='comment[". $type ."][". $id ."]' style='width:100%;' rows=3>". 
						( ${_POST}['comments'][$type][$id] ? ${_POST}['comments'][$type][$id] : null ) ."</textarea><br />
					<input type='submit' name='SUBMIT_COMMENT[". $type ."]' value='Submit Comment'>
					</form>
			</div>
		</div>";


	$return .= "</div>";
	return $return;
}


/*
{ // types: title, category, location, team, description, style, etc.

	$return = "<div id='". $type ."_comments' style='font-align:right;padding:0px;'>";//padding:0 10px 0px 20px;

		// comments
		$sql = "SELECT * FROM comments p 
			LEFT JOIN users u ON p.user_id = u.user_id 
			WHERE p.parent_id = '". $id ."' 
			AND p.type = '". local_type_id$type) ."' 
			ORDER BY p.stamp DESC";
		//echo "\$sql --> ".$sql ."<p>";
		$query_comments = mysqli_query($db, $sql);
		$comment_count = mysqli_num_rows($query_comments);

		// comments link
		$return .= "<a href='#' onclick=\"new Effect.toggle('". $type ."_comments_". $id ."','slide'); return false;\">
			comments (". ($comment_count + 0) .") | + add comments</a>";
			
			// add new comments form (hidden / slider)
			$return .= "<div id='". $type ."_comments_". $id ."' style='display:none;'>";
			
				// if comments exist 
				if ( $comment_count > 0 ) { // display existing comments

					$return .= "<div id='' style='padding:0px;text-style:italic;border:solid thin gray;background-color:#eeeeee;'>";
					while ($comments = mysqli_fetch_assoc($query_comments)) {
						//$return .= $divider .
						$return .= "<div style='". $divider ."padding:4px;background-color:#dddddd';color:#999999;text-align:right;text-weight:bold;'>". 
							ucwords(${comments}['firstname'] ." ". ${comments}['lastname']) ." - ". ${comments}['stamp'] ."</div>
						<div style='padding:10px;'>". ${comments}['comment'] ."</div>";
						//$divider = "<hr color='#eeeeee' width=90%>";
						$divider = "border-top:thin solid gray;";
						
					}
					$return .= "</div>";
				}
			
				$return .= "<div style=''>
					<textarea name='comment[". $type ."][". $id ."]' style='width:100%;' rows=3>". 
						( ${_POST}['comments'][$type][$id] ? ${_POST}['comments'][$type][$id] : null ) ."</textarea><br />
					<input type='submit' name='SUBMIT_COMMENT[". $type ."]' value='Submit Comment'>
				</div>
			</div>";


	$return .= "</div>";
	return $return;
}
*/


/* This function searches the database for matching professions
if submitted profession exists, it returns the existing prfession id
otherwise it creates the profession then returns the new id */
function local_return_profession_id($value) { // 
	if ( is_numeric($value) ) {
		// if the profession is an id number return the id
		return $value;
	} else {
		// insert into professions and then return the profession id
		// check if profession exists in db
		$sql = "SELECT profession_id FROM professions 
			WHERE profession LIKE '". trim(strtolower($value)) ."'";
		$query = mysqli_query($db, $sql);
		if ( $info = mysqli_fetch_assoc($query) ) {
			// return id
			return ${info}['profession_id'];
		} else {
			// insert into db and return new id
			$sql = "INSERT INTO professions SET
				profession = '". trim(strtolower(query_prep($value))) ."'";
			if ( !mysqli_query($db, $sql) ) {
				error("there was an error inserting the new profession into profession db",$sql,1);
				return false;
			} elseif ( $last_insert_id = mysqli_insert_id($db) ) {
				return $last_insert_id;
			} else {
				error("there was an error inserting the new profession into profession db",$sql,1);
				return false;
			}
		}
	}
}

/* This function searches the database for matching professions
if submitted profession exists, it returns the existing prfession id
otherwise it creates the profession then returns the new id */
function local_return_id($value,$table,$type) { // ([id/SUBMITTED VALUE]/categories/category)
	if ( is_numeric($value) ) {
		// if the profession/style/category is an id number return the id
		return $value;
	} else {
		// insert into profession/style/category and then return the profession/style/category id
		// check if profession/style/category exists in db
		$sql = "SELECT ". $type ."_id FROM ". $table ." 
			WHERE ". $type ." LIKE '". trim(strtolower($value)) ."'";
		$query = mysqli_query($db, $sql);
		if ( $info = mysqli_fetch_assoc($query) ) {
			// return id
			return $info[$type .'_id'];
		} else {
			// insert into db and return new id
			$sql = "INSERT INTO ". $table ." SET
				". $type ." = '". trim(strtolower(query_prep($value))) ."'";
			if ( !mysqli_query($db, $sql) ) {
				error("there was an error inserting the new ". $type ." into ". $table ." db",$sql,1);
				return false;
			} elseif ( $last_insert_id = mysqli_insert_id($db) ) {
				return $last_insert_id;
			} else {
				error("there was an error inserting the new ". $type ." into ". $table ." db",$sql,1);
				return false;
			}
		}
	}
}


////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0

////////// COMMENTS
////////////////////////////////////////
////////////////////////////////////////
if ( is_array($_POST['SUBMIT_COMMENT']) ) {
	
	list($comment_type) = array_keys($_POST['SUBMIT_COMMENT']);
	//$log[] = $comment_type;
	
	list($comment_parent_id) = array_keys($_POST['comment'][$comment_type]);
	$log[] = $comment_parent_id;
	
//	foreach( ${_POST}['comment'][$comment_type] AS $key => $value) {
		if	 ( ${_POST}['comment'][$comment_type][$comment_parent_id] ) {
			$sql = "INSERT INTO comments SET 
				parent_id = '". $comment_parent_id ."', 
				user_id = '". USER_ID ."', 
				type = '". local_type_id($comment_type) ."', 
				comment = '". query_prep($_POST['comment'][$comment_type][$comment_parent_id]) ."'";
			if ( !mysqli_query($db, $sql) ) {
				echo "error: ". mysqli_error($db) ."<p>";
				error("there was an error trying to insert the users comments for project_id: ". ${_GET}['CRYPT_REF_ID'] .", comment_type: ". $comment_type .", comment_parent_id: ". $comment_parent_id ."",$sql);
			} else {
				// inserted comment successfully
				// open the comments slider
			}
		}
//	}

////////// TITLE
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['SUBMIT_TITLE'] ) {
	
	// CHECK IF TITLE WAS SUBMITTED
	// query_check_duplicate();
	
	
	$sql = "INSERT INTO projects_title SET 
		title = '". query_prep($_POST['title']) ."', 
		project_id = '". ${_GET}['CRYPT_REF_ID'] ."', 
		user_id = '". USER_ID ."'";
	if ( !$query = mysqli_query($db, $sql) ) {
		error("there was an error adding a title to the project",$sql);
	} else {
		header("location:". ${_SERVER}['PHP_SELF'] ."". ($_SERVER['QUERY_STRING'] ? "?". ${_SERVER}['QUERY_STRING'] : NULL));
	}
	
////////// LOCATION
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['SUBMIT_LOCATION'] ) {
	
	echo "location processing not setup yet";
	
////////// CATEGORY
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['SUBMIT_CATEGORY'] ) {
	
	// CHECK IF EXACT category_id WAS SUBMITTED
	// get category_id
	if ( $category_id = local_return_id($_POST['category_id'],'categories','category') ) {
		
		// CHECK IF EXACT style_id WAS SUBMITTED
		$sql = "SELECT * FROM projects_category 
			WHERE category_id  = '". $category_id ."' 
				AND project_id = ". ${_GET}['CRYPT_REF_ID'] ."";
		$query = mysqli_query($db, $sql);
		if ( mysqli_num_rows($query) < 1 ) {
			// insert into the projects_category table
			$sql = "INSERT INTO projects_category SET 
				project_id = '". ${_GET}['CRYPT_REF_ID'] ."', 
				category_id = '". $category_id ."'";
			if ( !$query = mysqli_query($db, $sql) ) {
				${error}['category']['insert'] = "There was an error trying to insert the projects_category association.";
				error($error['category']['insert'],$sql,1);
			} else {
				// the category has been added
				// regenerate the project categories
			}
		}	 else {
			${error}['category'][] = "The category already exists for this project.";
		}
	}
	
////////// STYLES
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['SUBMIT_STYLE'] ) {
	

	// get style_id
	if ( $style_id = local_return_id($_POST['style_id'],'styles','style') ) {
		
		// CHECK IF EXACT style_id WAS SUBMITTED
		$sql = "SELECT * FROM projects_style 
			WHERE style_id  = '". $style_id ."' 
				AND project_id = ". ${_GET}['CRYPT_REF_ID'] ."";
		$query = mysqli_query($db, $sql);
		if ( mysqli_num_rows($query) < 1 ) {
			// insert into the projects_style table
			$sql = "INSERT INTO projects_style SET 
				project_id = '". ${_GET}['CRYPT_REF_ID'] ."', 
				style_id = '". $style_id ."'";
			if ( !$query = mysqli_query($db, $sql) ) {
				${error}['style']['insert'] = "there was an error trying to insert the projects_style association.";
				error($error['style']['insert'],$sql,1);
			} else {
				// the style has been added
				// regenerate the project styles
			}
		} else {
			${error}['style'][] = "The style already exists for this project.";
		}
		
	}
	
////////// TEAM
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['SUBMIT_TEAM'] ) {
	
	// CHECK IF EXACT profession_id / name COMBINATION HAS BEEN SUBMITTED
	
	// get profession_id
//	if ( $profession_id = local_return_profession_id($_POST['profession_id']) ) {
	if ( $profession_id = local_return_id($_POST['profession_id'],'professions','profession') ) {
		
		// insert into the projects_professions table
		$sql = "INSERT INTO projects_team SET 
			project_id = '". ${_GET}['CRYPT_REF_ID'] ."', 
			profession_id = '". $profession_id ."', 
			name = '". query_prep($_POST['name']) ."', 
			user_id = ". ($_POST['me'] && defined('USER_ID') ? "'". USER_ID ."'" : "NULL");
		if ( !$query = mysqli_query($db, $sql) ) {
			error("there was an error trying to insert the project profession association",$sql,1);
		} else {
			// the profession has been added
			// regenerate the project professions
		}
	}
	
////////// DESCRIPTION
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['SUBMIT_DESCRIPTION'] ) {
	
	$sql = "INSERT INTO projects_description SET 
		title = '". query_prep($_POST['description_title']) ."', 
		description = '". query_prep($_POST['description']) ."', 
		project_id = '". ${_GET}['CRYPT_REF_ID'] ."', 
		user_id = '". USER_ID ."'";
	
	$log[] = "\$sql --> ". $sql ."<P>";
	
	if ( !$query = mysqli_query($db, $sql) ) {
		error("there was an error adding a description to the project",$sql);
	} else {
		header("location:". ${_SERVER}['PHP_SELF'] ."". ($_SERVER['QUERY_STRING'] ? "?". ${_SERVER}['QUERY_STRING'] : NULL));
	}
	
////////// LINKS
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['SUBMIT_LINK'] ) {
	
	// CHECK IF EXACT url HAS BEEN SUBMITTED
	
	$sql = "INSERT INTO projects_link SET 
		title = '". query_prep($_POST['link_title']) ."', 
		url = '". query_prep($_POST['url']) ."', 
		project_id = '". ${_GET}['CRYPT_REF_ID'] ."', 
		user_id = '". USER_ID ."'";
	
	$log[] = "\$sql --> ". $sql ."<P>";
	
	if ( !$query = mysqli_query($db, $sql) ) {
		error("there was an error adding a link to the project",$sql);
	} else {
		header("location:". ${_SERVER}['PHP_SELF'] ."". ($_SERVER['QUERY_STRING'] ? "?". ${_SERVER}['QUERY_STRING'] : NULL));
	}
	
////////// IMAGE
////////////////////////////////////////
////////////////////////////////////////
} elseif ( ${_POST}['IMAGE_UPLOAD'] ) {
	
	if ( ${_FILES}['file'] ) {
		$sql = "INSERT INTO projects_image SET 
			user_id = '". USER_ID ."', 
			project_id = '". ${_GET}['CRYPT_REF_ID'] ."', 
			
			file_type = ". ($_FILES['file']['type'] ? "'". ${_FILES}['file']['type'] ."'" : "NULL") .",
			file_size = ". ($_FILES['file']['size'] ? "'". ${_FILES}['file']['size'] ."'" : "NULL") .",
			file_name = ". ($_FILES['file']['name'] ? "'". ${_FILES}['file']['name'] ."'" : "NULL") .",
			
			title = ". ($_POST['image_title_'. $key] ? "'". $_POST['image_title_'. $key] ."'" : 
				($_POST['title'] ? "'". ${_POST}['title'] ."'" : "NULL")) .",
			
			caption = ". ($_POST['image_caption_'. $key] ? "'". $_POST['image_caption_'. $key] ."'" : 
				($_POST['caption'] ? "'". ${_POST}['caption'] ."'" : "NULL")) .",
			
			date = ". ($_POST['date'] ? "'". ${_POST}['date'] ."'" : "NULL") ."";
		
		$log[] = $sql;
		
		if ( !mysqli_query($db, $sql) ) {
			
			$log[] = mysqli_error($db);
			
			//$error[] = "There was an error uploading file #". $key .". An administrator has been contacted to resolve the issues. If you need immediate assistance please submit a trouble ticket.";
			//error($error[$key],$sql,1);
		} elseif ( $last_insert_id = mysqli_insert_id($db) ) {
			
			// PROCESS THE FILE UPLOAD
			//$filename = "/Library/WebServer/Documents/ARCHXCHANGE/domain/uploads/". uniqid("") ."";
			//$filename = uniqid("")
			//$path = "/Library/WebServer/Documents/ARCHXCHANGE/domain/uploads/";
			//$log[] = move_uploaded_file($_FILES[$key][tmp_name], $path.$filename);
			
			// sudo chmod 1777 /tmp
			// http://meta.wikimedia.org/wiki/Running_MediaWiki_on_Mac_OS_X
			$file_uploaded = $last_insert_id .".png";
			$command = (LOCAL ? "/usr/local/bin/convert" : "convert") ." -resize 800x800'>' ". ${_FILES}['file']['tmp_name'] ." ". 
				(LOCAL ? TEMPLATE_BASE_DIR ."_uploads/" : "_uploads/") ."". $file_uploaded;
			//$command = "convert '". $_FILES[$key][tmp_name] ."' ../uploads/". $last_insert_id .".png";
			//$command = "convert ../uploads/". $file ." ../uploads/". $last_insert_id .".png";
			
			//$log[] = move_uploaded_file($_FILES[$key][tmp_name], "../uploads/". $file_uploaded);
			
			//exec($command, $output,1);
			exec($command);
			
			//dev_print($output);
			
			//if ( !exec($command, $output,1) ) {
				//$log[] = "OOPS! there was a problem uploading your file! --> ". $command;
				
			//} else 
			$log[] = "executed successfully --> ". $command;
			
			// check if file exists
			//$filename = '/path/to/foo.txt';
			$filename = TEMPLATE_BASE_DIR ."_uploads/". $file_uploaded;
			
			if (file_exists($filename)) {
				
				//header("location:project.php?". CRYPT_REF_ID ."=". ${_GET}['CRYPT_REF_ID']);
				$log[] = "location:project.php?". CRYPT_REF_ID ."=". ${_GET}['CRYPT_REF_ID'];
			} else {
				$sql = "DELETE FROM projects_image WHERE projects_image_id = '". $last_insert_id ."' AND project_id = '". ${_GET}['CRYPT_REF_ID'] ."' LIMIT 1";
				if (!mysqli_query($db, $sql)) error("there was an error removing a new image from the database because the new image file could not be uploaded",$sql,1);
			}
		}
	}
	
	//echo "uploading images";
	//dev_print($_POST); dev_print($_FILES); dev_print($log);
	
}


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////

echo "<style type=\"text/css\">
<!--
	.module {
		background-color:white;
		border:solid 0px red;
		position:relative;
		padding:6px;
	}
	
	.button {
		/*
		padding:4px;
		border:1px solid lightgray;
		border-right:solid thin gray;
		border-bottom:solid thin gray;
		background-color:beige;
		*/
		font-size:10px;
		font-weight:normal;
		font-size:10px;
	}
	
	.button_disabled {
		/*
		text-align:center;
		
		text-decoration:none;
		*/
		padding:4px;
		border:1px solid lightgray;
		border-right:solid thin gray;
		border-bottom:solid thin gray;
		background-color:beige;
		font-weight:normal;
		font-size:10px;
	}

		.buttonAlt {

			padding:4px;
			border:1px solid lightgray;
			border-right:solid thin gray;
			border-bottom:solid thin gray;
			background-color:beige;
			font-weight:normal;
			font-size:10px;
		}
	
	.form {
		padding:4px;
		background-color:beige;
		border:solid thin lightgray;
		border-right:solid thin gray;
		border-bottom:solid thin gray;
	}
	
	h2 {
		/*
		display:inline;
		margin-top:100px;
		*/
	}
-->
</style>";

//echo "USER_ID --> ". USER_ID ."<p>";

////////// TITLE OF PROJECT
//////////////////////////////////////////////////
$sql = "SELECT c.country_name, cz.zone_name, czm.metro_name, pl.city FROM projects_location pl 
	LEFT JOIN countries c ON c.country_id = pl.country_id 
	LEFT JOIN countries_zones_metros czm ON czm.metro_id = pl.metro_id 
	LEFT JOIN countries_zones cz ON cz.zone_id = pl.zone_id 
	WHERE project_id = '". ${_GET}['CRYPT_REF_ID'] ."'";
$query = mysqli_query($db, $sql);
while ( $loc = mysqli_fetch_assoc($query) ) {
	//dev_print($loc);
	$location = implode(" > ",$loc);
}

/*echo "<div id='projectTitle' style='margin-left:160px;background-color:#FAFBBB;'>
	
	<div><h1 style=''>". ${info}['title'] ."<a href='#' style='position:absolute;right:0px;' class='button'>+ Add New Title</a></h1></div>
	". local_type("title") ."
</div>";
*/
echo local_type("title");

////////// QUERY IMAGES
//////////////////////////////////////////////////
/*
	function hideRows(id) {
		document.getElementById(id).className = 'hiddenRow';
		document.getElementById('officeId').value = id;
	}
	function test() {
		getElementById('defaultOfficeId').checked=false;
	}
	
	onmouseover=\"showEditLink('image_". ${images}['projects_image_id'] ."')\"
	test('image_". ${images}['projects_image_id'] ."');
	
	document.getElementById('description_edit_". ${desc}['projects_description_id'] ."').style.display='block';document.getElementById('description_nav_". ${desc}['projects_description_id'] ."').style.display='block';document.getElementById('description_". ${desc}['projects_description_id'] ."').style.border='solid thin gray';
	
*/
echo "<script language='javascript' type='text/javascript'>
<!--

	function highlight(type,elem,flip) {
		
		//alert('test');
		
		if ( flip ) {
			
			//document.getElementById(elem).style.display='block';
			document.getElementById(type +'_nav_'+ elem).style.display='block';
			document.getElementById(type +'_'+ elem).style.border='dotted 1px gray';
			document.getElementById(type +'_'+ elem).style.padding='5px';
			document.getElementById(type +'_'+ elem).style.background='#EBEEEE';
			
			/*new Effect.SlideDown(type +'_comments_'+ elem);*/
		} else {
			
			document.getElementById(type +'_nav_'+ elem).style.display='none';
			document.getElementById(type +'_'+ elem).style.border='0px';
			document.getElementById(type +'_'+ elem).style.padding='6px';
			document.getElementById(type +'_'+ elem).style.background='#ffffff';
			
			/*new Effect.slideUp(type +'_comments_'+ elem);*/
		}
	}
	
	function notification(note) {
	
		alert((note ? note : 'This is not working yet, I have to figure out how to let users vote on each item so they can be removed after many people vote negatively.'));
	}
	
-->
</script>";

/*

		nCols = txtBox.cols;
		sVal = txtBox.value;
		nVal = sVal.length;
		nRowCnt = 1;
	function ResizeTextArea(elem) {
		
		txtBox = document.getElementById(elem);
		
		nCols = txtBox.cols;
		sVal = txtBox.value;
		nVal = sVal.length;
		nRowCnt = 1;
		
		alert('nCols -> '+ nCols);
		
		for (i=0;i<nVal;i++)
			{ if (sVal.charAt(i).charCodeAt(0) == 13) { nRowCnt +=1; } }
		
		if (nRowCnt < (nVal / nCols)) 
			{ nRowCnt = 1 + (nVal / nCols); }
			
		txtBox.rows = nRowCnt;
	}
	*/

echo "<style type=\"text/css\">
<!--
	div.row {
		clear: both;
		padding-top: 10px;
	}

	div.row span.label {
		float: left;
		width: 100px;
		text-align: right;
	}

	div.row span.form {
		float: right;
		width: 335px;
		text-align: left;
	}
	
	
	
	
	.form label, .form input, .form select {
		/*
		
		width: 150px;
		margin-bottom: 10px;
		*/
		margin:5px 0;
		display: block;
		float: left;
	}

	.form label {
		/*
		margin-top:10px;
		border:1px red dotted;
		*/
		margin-top:5px;
		text-align:right;
		width: 150px;
		padding-right:10px;
	}

	.form p {
		clear: both;
	}
	
	.form span {
		padding:5px;
	}
-->
</style>";


$sql = "SELECT * FROM projects_image WHERE project_id = '". ${_GET}['CRYPT_REF_ID'] ."'";
$query = mysqli_query($db, $sql);
while ( $images = mysqli_fetch_assoc($query) ) {
	$display_images .= "<div id='' style='padding:0px;margin-top:4px;border:solid gray thin;position:relative;' 
			onmouseover=\"document.getElementById('rotate_left_". ${images}['projects_image_id'] ."').style.display='block';document.getElementById('rotate_right_". ${images}['projects_image_id'] ."').style.display='block';\" 
			onmouseout=\"document.getElementById('rotate_left_". ${images}['projects_image_id'] ."').style.display='none';document.getElementById('rotate_right_". ${images}['projects_image_id'] ."').style.display='none';\">
		
		
		<!--
		document.getElementById('image_". ${images}['projects_image_id'] ."').style.display='block';
		document.getElementById('image_". ${images}['projects_image_id'] ."').style.display='none';
		
		<div id='image_". ${images}['projects_image_id'] ."' style='display:none;opacity:.6;border:1px solid gray;background-color:white;padding:3px;position:absolute;bottom:1px;right:0px;z-index:100;'>
			<a href='#' style='' onclick=\"notification('maybe this would be better if it were a different link, like DETAILS rather than edit. The only person who can edit this image will be the member that uploaded it.');\">edit image</a>
		</div>-->
		
		<div id='rotate_left_". ${images}['projects_image_id'] ."' style='display:none;opacity:.6;border:1px solid gray;background-color:white;padding:3px;position:absolute;left:0px;top:1px;z-index:101;'>
			<a href='#' style='' onclick=\"imageRotate(0,". ${images}['projects_image_id'] .");\">< rotate</a>
		</div>
		<div id='rotate_right_". ${images}['projects_image_id'] ."' style='display:none;opacity:.6;border:1px solid gray;background-color:white;padding:3px;position:absolute;right:0px;top:1px;z-index:101;'>
			<a href='#' style='' onclick=\"imageRotate(1,". ${images}['projects_image_id'] .");\">rotate ></a>
		</div>
		
		<a href='". TEMPLATE_BASE_DIR ."_uploads/". ${images}['projects_image_id'] .".png' style='' rel='lightbox[images]'>
			<img border=0 id='image_". ${images}['projects_image_id'] ."' name='image_". ${images}['projects_image_id'] ."' src='". TEMPLATE_BASE_DIR ."_uploads/". ${images}['projects_image_id'] .".png' style='width:100%;'>
		</a>
		
		
	</div>";
}

// IMAGE DIV
echo "<div id='images' style='position:absolute;width:140px;padding:4px;margin-top:0px;'>
	
	<div style='text-align:center;padding:6px;border:solid thin lightgray;border-right:solid thin gray;border-bottom:solid thin gray;background-color:beige;'>
		<a href='#' onclick=\"new Effect.toggle('upload_images','slide'); return false;\"><h3>Upload Image -></h3></a></div>
	". $display_images ."</div>";




///////// MAIN CONTENT DIV
//////////////////////////////////////////////////
echo "<div id='main' style=''>"; // START MAIN DIV --->

///////// IMAGE FORM
//////////////////////////////////////////////////
// add new comments form (hidden / slider) //
echo "<div id='upload_images' style='display:none;margin-left:160px;'>
	<div class='form'>
		<!--<h2>Upload Image</h2>-->
		<form name=uploadForm enctype='multipart/form-data' action='". ${_SERVER}['PHP_SELF'] . 
			($_SERVER['QUERY_STRING'] ? "?". ${_SERVER}['QUERY_STRING'] : NULL) ."' method=post>
		<input type=hidden name=MAX_FILE_SIZE value=5000000>
		<label>Image File</label>
		<input type=file name=file><p>
		
		<label>title</label>
		<input type=text name=title style='width:200px;'><p>
		
		<label>description / caption</label>
		<textarea name='caption' style='width:200px;' rows=3></textarea><p>
		
		<label>image tags / keywords</label>
		<input type=text name=tags style='width:200px;'><p>
		
		<label>date of photo</label>
		<script>DateInput('date',false,'YYYY-MM-DD')</script>
		
		<label></label>
		<input type='submit' name='IMAGE_UPLOAD' value='Upload Image'><p></form>
	</div>
</div>";

/*
///////// LOCATION / DIRECTIONS
//////////////////////////////////////////////////
echo "<h2 style='padding:4px;'>Location / Directions <a href='#' style='position:absolute;right:0px;' class='button'>+ Add New Location</a></h2>";

echo "<div id='' style='' class='module'>
	". $location ."
</div>";

///////// BUILDING CATEGORY
//////////////////////////////////////////////////
//////////////////////////////////////////////////
echo "<h2 style='padding:4px;'>Building Category
	<a href='#' style='position:absolute;right:0px;' class='button'>+ Add New Category</a></h2>";

echo "<div id='' style='' class='module'>
	Building Category content goes here (residential, commercial, institutional, etc.) 
</div>";

///////// STYLE
//////////////////////////////////////////////////
//////////////////////////////////////////////////
echo "<h2 style='padding:4px;'>Design Style <a href='#' style='position:absolute;right:0px;' class='button'>+ Add New Style</a></h2>";

echo "<div id='' style='' class='module'>
	drop down menu of Design Style (postmodern, contemporary, minimalist, etc.)
</div>";

*/



///////// PROJECT LOCATION
//////////////////////////////////////////////////
//////////////////////////////////////////////////
echo local_type("location");

echo local_type("category");
echo local_type("style");

///////// PROFESSIONAL DESIGN TEAM
//////////////////////////////////////////////////
//////////////////////////////////////////////////
echo local_type("team");



///////// DISCUSSION (DESCRIPTION)
//////////////////////////////////////////////////
//////////////////////////////////////////////////
echo local_type("description");


///////// REFERENCE LINKS
//////////////////////////////////////////////////
//////////////////////////////////////////////////
echo local_type("link");


echo "</div>"; // END MAIN DIV <---


//dev_print($_POST);
//dev_print($_FILES);
//dev_print($log);
//dev_print($_SESSION);

////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
