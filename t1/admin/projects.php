<?php


// ACCESS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 1.0
if ( !defined('ACCESS') ) die(ERROR_MESSAGE);


// SESSION //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 2.0


// VARIABLES ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 3.0
//define("TITLE","PAGE TITLE"); // PAGE TITLE
if ( ${_GET}['CRYPT_REF_ID'] ) {
	/*
	LEFT JOIN template_departments td ON td.department_id = tp.department_id 
	*/
	
	$sql = "SELECT * FROM template_projects tp 
	LEFT JOIN template_categories tc ON tc.category_id = tp.category_id 
	LEFT JOIN template_contacts tca ON tca.contact_id = tp.architect_id 
	WHERE 1 
		AND tp.domain_id = '". DOMAIN_ID."'";
	$query = mysqli_query($db, $sql);
	$edit = mysqli_fetch_assoc($query);
	
}

// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_header_admin.php");

echo "
<style type='text/css'>
	<!--
	
	.productSearchContainer {
		/*
		margin:2px;
		border:0px solid pink;
		*/
		
		width:auto;
		padding:10px;
		
	}
	
	.productSearchHeader {
		/*
		border:1px solid gray;
		*/
		
		padding:5px;
		background-color:#7FACD2;
		color:#fff;
		
	}
	
	td {
		padding-left:5px;
		padding-right:5px;
		
	}
	
	.productSearch {
		/*
		background-color:#004c91;
		background-color:#71ACE2;
		border:1px solid gray;
		*/
		
		padding:6px;
		background-color:#eee;
		
	}
	
	-->
</style>";


echo "<div class='productSearchContainer'>
	<div class='productSearchHeader'>Product List Filters</div>
	
	<form action='' method=get>
	<div class='productSearch' style='font-size:small;'>
		";
			
			echo "<span style='padding:4px;'>category: <select name=category_id onchange='submit();' class='compact'>
				<option value=''>-- ALL --</option>";
			$sql = query_domain('template_categories');
			$query = mysqli_query($db, $sql);
			while ( $info = mysqli_fetch_assoc($query) ) {
				echo "<option value='". ${info}['category_id'] ."'".
					({$_GET['category_id'] == ${info}['category_id'] ? " SELECTED" : NULL) .">". ${info}['category'] ."</option>";
			}
			echo "</select></span> ";
			
			
			echo "<span style='padding:4px;'>architect: <select name=architect_id onchange='submit();' style='font-size:xx-small;'>
				<option value=''>-- ALL --</option>";
			//$sql = query_domain('template_contacts');
			$sql = "SELECT * FROM template_contacts 
				WHERE (domain_id IS NULL 
						OR domain_id = '". DOMAIN_ID ."') 
					AND type = 'architect'";
			$query = mysqli_query($db, $sql);
			while ( $info = mysqli_fetch_assoc($query) ) {
				echo "<option value='". ${info}['contact_id'] ."'".
					({$_GET['architect_id'] == ${info}['contact_id'] ? " SELECTED" : NULL) .">". ${info}['contact'] ."</option>";
			}
			echo "</select></span> ";
			
			echo "<br />";
			
			echo "<span style='padding:4px;'>
				id: <input type=text name=". CRYPT_REF_ID ." ". form_value("project id",{$_GET['CRYPT_REF_ID']) ." size=15>
			</span> ";
			
			echo "<span style='padding:4px;'>
				title: <input type=text name=title ". form_value("title",{$_GET['title']) ." size=15>
			</span> ";
			
			echo "<span style='padding:4px;'>
				description: <input type=text name=description ". form_value("description",{$_GET['description']) ." size=15>
				<input type=submit name=search value='Search'>
			</span> ";
			
		echo "
	</div>
	</form>";
	

////////// FILTER LIST
/////////////////////////////////////////////////////////////////////////////////////
if ( ${_GET}['category_id'] ) $filter .= " AND tc.category_id = '". ${_GET}['category_id'] ."' ";
if ( ${_GET}['architect_id'] ) $filter .= " AND tca.contact_id = '". ${_GET}['architect_id'] ."' ";
if ( ${_GET}['CRYPT_REF_ID'] && is_numeric({$_GET['CRYPT_REF_ID']) ) $filter .= " AND tp.project_id = '". ${_GET}['CRYPT_REF_ID'] ."' ";
if ( ${_GET}['title'] && ${_GET}['title'] != "title" ) $filter .= " AND tp.title LIKE '". ( strlen({$_GET['title']) > 1 ? "%" : null ) . ${_GET}['title'] ."%' ";
if ( ${_GET}['description'] && ${_GET}['description'] != "description" ) $filter .= " AND CONCAT(tp.site, tp.design, tp.construction) LIKE '%" . ${_GET}['description'] ."%' ";


//	LEFT JOIN template_departments td ON td.department_id = tp.department_id 

$sql = "SELECT * FROM template_projects tp 
	LEFT JOIN template_categories tc ON tc.category_id = tp.category_id 
	LEFT JOIN template_contacts tca ON tca.contact_id = tp.architect_id 
	WHERE 1 
		AND tp.domain_id = '". DOMAIN_ID."'";

// if ( $filter ) echo nl2br($sql); // check sql query

if ( !$query = mysqli_query($db, $sql. $filter) ) {
	echo mysqli_error($db);
} else {
	
	$num_rows = mysqli_num_rows($query);
	if ( $num_rows < 1 ) {
	
		echo "<h2></h2><div id='nifty'>NO RESULTS FOUND (listing all projects...)</div>";
		
		$query = mysqli_query($db, $sql);
		
	}
	
	echo "<table border=0 width=100% cellpadding=2 cellspacing=2 bgcolor='#ffffff' class='test'>
		<tr class='productSearchHeader'>
			<td align=center>ID</td>
			<td>Title</td>
			<td>Architect</td>
			<td>Department</td>
			<td>Category</td>
			<td>Date</td>
		</tr>";
	
	
	while ($info = mysqli_fetch_assoc($query)) {
		//{$info['title']<br />
		echo "<tr bgcolor='#". return_alternate("ffffff","eeeeee") ."'>
			<td align=center>". ${info}['project_id'] ."</td>
			<td><a href='project.php?". CRYPT_REF_ID ."=". ${info}['project_id'] ."' title='". ${info}['design'] ."'>". ${info}['title'] ."</a></td>
			<td>". ${info}['contact'] ."</td>
			<td>". ${info}['department'] ."</td>
			<td>". ${info}['category'] ."</td>
			<td>". ${info}['date_started'] ."</td>
		</tr>";
	}
	
	echo "</table>";
	
}

echo "</div>";


////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR ."_includes/inc_footer.php");

?>
