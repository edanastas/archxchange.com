<?php

// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if ( !defined('ACCESS') ) die(ERROR_MESSAGE);
//define("ACCESS", ACCESS_PUBLIC); // ACCESS_WEBMASTER, ACCESS_ADMINISTRATOR, ACCESS_MANAGER, ACCESS_PUBLIC


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
define("TITLE","Welcome to ". DOMAIN); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");



echo '<style type="text/css" media="screen">
<!--//


//-->
</style>';

/*
startList = function() {
	if (document.all&&document.getElementById) {
		navigationRoot = document.getElementById("navigation");
		for (i=0; i<navigationRoot.childNodes.length; i++) {
			node = navigationRoot.childNodes[i];
			if (node.nodeName=="LI") {
				node.onmouseover=function() {
					this.className+=" over";
				}
				node.onmouseout=function() {
					this.className=this.className.replace(" over", "");
				}
			}
		}
	}
}
*/
echo '<script type="text/javascript">
<!--//



window.onload=startList;

//-->
</script>';

/*
*/

////////// LIST CATEGORIES
//////////////////////////////////////////////////
$sql = "SELECT c.category,  c.category_id, count(p.category_id) as count 
	FROM template_projects p 
	LEFT JOIN template_categories c ON p.category_id = c.category_id 
	WHERE p.domain_id = '". DOMAIN_ID ."' 
	GROUP BY p.category_id
	ORDER BY c.category";

if ( !$query = mysqli_query($db, $sql) ) {
	echo mysqli_error($db);
} else {
	/*
	echo "<div id='categoryTitle'></div>";
	
	echo "<div id='categoryList'>
		<ul>";
		*/
		while ($category = mysqli_fetch_assoc($query)) {
			
			if ({$_GET['category_id'] == ${category}['category_id'] ? ${category}['category'] : null ) 
				$selected_category = ${category}['category'];
			
			$portfolio_links[] = "<li><a href='portfolio.php?category_id=". ${category}['category_id'] ."'>". ${category}['category'] ."</a></li>";
			
			/*echo "<li>
				<a href='portfolio.php?category_id=". ${category}['category_id'] ."'". 
					({$_GET['category_id'] == ${category}['category_id'] ? " class='categoryListSelected'" : null ) .">". 
					${category}['category'] ." [". ${category}['category_id'] ."] - ". ${category}['count'] ."</a>
			</li>";*/
		}
		
		/*echo "</ul>
	</div>";*/
	
	
	
}



echo "<div id='header'>
	<div id='levelOneNav'>
		<ul id='navigation'>
			<li><a href='./'>home</a></li>
			<li>
				<a href='portfolio.php'>portfolio</a>
				
				". '
				
				<ul>
					'. implode("",$portfolio_links) .'
				</ul>
				
				' . "
				
			</li>
			<li><a href='#'>Careers</a></li>
			<li><a href='#'>FTP</a></li>
			<li><a href='#'>Contacts</a></li>
			<li style='font-size:smaller;color:#333;width:100px;'>BSA Architects<br />501 Folsom Street<br />San Francisco CA 94105<br />415.281.4720</li>
		</ul>
	</div>
</div><p>";

if ( file_exists(ROOT_DIR ."images/logo.gif")) {
	echo "<div id='logo'><img border=0 src='". LOCAL_DOMAIN ."images/logo.gif'></div>";
}

////////// LIST PROJECTS
//////////////////////////////////////////////////
if ( ${_GET}['category_id'] ) {
	// get all the projects for the category
	$sql = "SELECT p.*, c.category, c.category_id 
		FROM template_projects p 
		LEFT JOIN template_categories c ON p.category_id = c.category_id 
		WHERE p.domain_id = '". DOMAIN_ID ."' 
			AND p.category_id = '". ${_GET}['category_id'] ."' 
		ORDER BY p.title";
	
	if ( !$query = mysqli_query($db, $sql) ) {
		echo mysqli_error($db);
	} else {
		
		echo "<div id='projectCategory'><h2>". $selected_category ."</h2></div>";
		//echo "<div id='projectDepartment'></div>";
		echo "<div id='projectList'>
			<ul>";
			
			while ($projects = mysqli_fetch_assoc($query)) {
				
				if ({$_GET['project_id'] == ${projects}['project_id'] ) $project = $projects;
				
				echo "<li>
					<a href='portfolio.php?category_id=". ${_GET}['category_id'] ."&project_id=". ${projects}['project_id'] ."'". 
						({$_GET['project_id'] == ${projects}['project_id'] ? " id='projectListSelected'" : null ) ." 
						accesskey='". ++$accesskey_index ."' class='key'>". 
						${projects}['title'] ."</a><!-- [". ${projects}['project_id'] ."]-->
				</li>";
				
				
			}
			
			echo "</ul>
		</div>";
		
	}
}



////////// PROJECT DETAILS
//////////////////////////////////////////////////
if ( ${_GET}['project_id'] ) {
	
	echo '
	<style type="text/css">
	<!--
		/*div#projectImages img {
			position:absolute;
			border:thin gray solid;
			clip: rect(10px, 80px, 80px, 10px);
			overflow:hidden;
		}
		
			position:relative;
			*/
		
		div#projectImages {
		}
	-->
	</style>';
	
	
	//dev_print($project);
	echo "<div id='projectDetails'>";
		echo "<div id='projectTitle'>". ${project}['title'] ."</div>";
		echo "<div id='projectText'>";
			echo "<div id='projectDescription'>". ${project}['design'] ."</div>";
			echo "<div id='projectSite'>". ${project}['site'] ."</div>";
			echo "<div id='projectConstruction'>". ${project}['construction'] ."</div>";
		echo "</div>";
	echo "</div>";
	
	
	
	
	////////// PROJECT IMAGES
	//////////////////////////////////////////////////
	$sql = "SELECT * FROM template_images 
		WHERE project_id = '". ${_GET}['project_id'] ."' 
		ORDER BY date DESC";
	
	if ( !$query = mysqli_query($db, $sql) ) {
		echo mysqli_error($db);
	} else {
		
		echo "<div id='projectImages'>";
			
			while ($images = mysqli_fetch_assoc($query)) {
				
				//dev_print($images);
				//echo "<div id='projectImageCaption'>". ${project}['caption'] ."</div>";
				//visibility:hidden;
				
				echo "<div id='wrapper'>\n<div id='projectImage_". ++$image_index ."' style='";
					if ( !$init ) $init = true; else echo "display:none;";
					echo "position:absolute;top:0px;left:0px;'>\n";
				echo "<a href='#'><img border='0' src='uploads/". ${images}['image_id'] .".png'></a>";
				echo "</div></div>";
				
				$image_links[] = "
					<a href='#' id='projectImageLink_". $image_index ."' onMouseOver=\"testImages('projectImage_". $image_index ."');\">". $image_index ."</a>";
				/*
				if ({$_GET['project_id'] == ${projects}['project_id'] ) $project = $projects;
				
				echo "<li>
					<a href='portfolio.php?category_id=". ${_GET}['category_id'] ."&project_id=". ${projects}['project_id'] ."'". 
						({$_GET['project_id'] == ${projects}['project'] ? " class='projectListSelected'" : null ) ." 
						accesskey='". ++$accesskey_index ."'>". 
						${projects}['title'] ." [". ${projects}['project_id'] ."]</a>
				</li>";
				*/
				
			}
			
			echo "</div>";
		
	}
	
	echo "<div id='projectImageLinks'>". (is_array($image_links)?implode("",$image_links):null) ."</div>";
	
}







/*

$sql = "SELECT p.*, c.category FROM template_projects p 
	LEFT JOIN template_categories c ON p.category_id = c.category_id 
	WHERE p.domain_id = '". DOMAIN_ID ."'
		ORDER BY c.category";
	//LEFT JOIN template_departments d ON p.department_id = d.department_id 
if ( !$query = mysqli_query($db, $sql) ) {
	echo mysqli_error($db);
} else {
	
	echo '
	<style type="text/css">
	<!--
		div.projectList {
		}
		
	-->
	</style>';

	
	echo "<div id='projectCategory'></div>";
	echo "<div id='projectDepartment'></div>";
	
	while ($info = mysqli_fetch_assoc($query)) {
		echo "<div class='projectList'>". ${info}['title'] ." ". ${info}['category'] ."</div>";
	}
}

*/

			/*
			background:#DDB600; // too goldish yellow
			margin: 0 30%;
			font-weight:bold;
			text-align:center;
			margin: 6 10%;
			color:#000;
			background:#FAD734;
			background:#eeeeee;
			border:thin solid gray;
			*/

////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
