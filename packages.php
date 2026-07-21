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
define("TITLE","Registration"); // PAGE TITLE


// DATABASE /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 4.0


// HTML /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 10.0

////////// HEADER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_header.php");


// style='height:100%;vertical-align:middle;'

//include(TEMPLATE_BASE_DIR . "_includes/inc_login.php");

////////// START BODY
/////////////////////////////////////////////////////////////////////////////////////
echo "<BR><BR><BR><BR><TABLE BORDER=0 BORDERCOLOR=orange ALIGN=CENTER WIDTH=650 CELLPADDING=1 CELLSPACING=0 RULES=NONE>";
echo "<FORM ACTION=register.php METHOD=POST>";

?>



<script language='javascript' type='text/javascript'>
<!--

var selectedPackage = null;
var previousPackage = null;

var packages = [
	{name:'starter'},
	{name:'office'},
	{name:'primier'}
];



function selectPackage(packageRef) {
	
	selectedPackage = packageRef; // set selected package
	
	document.getElementById(packageRef + "Radio").checked = true;
	
	
	// deselect the previous packages background
	
	//if (selectedPackage) document.getElementById(selectedPackage).style.background = "white";
	
	document.getElementById(packageRef).style.background = "#FFED6F";
	document.getElementById("selectedPackageText").innerHTML = "CURRENTLY SELECTED PACKAGE &#187 <b style='color:red;background-color:white;border:solid 1px #B7A000;padding:4px;'>" + packageRef +"<\/b>";
	
	//document.getElementById("packageDetails").innerHTML = "selectedPackage --> "+selectedPackage +" and --> "+packageRef;
	
	//alert("previousPackage --> "+previousPackage);
	if ( previousPackage ) document.getElementById(previousPackage).style.background = "white";
	previousPackage = packageRef; // set selected package
}

function togglePackages() {
	
	for (var p=0; p<packages.length; p++) {
		if ( packages[p].name ) {
			//alert("you done it --> "+packages[p].name);
			
			// check if package selected
			
			// change selected package text
			
			// change visibility of package details
			
			
		}
	}
}


function toggleOn(packageRef) {
	
	if ( selectedPackage ) {
		document.getElementById(selectedPackage+"Details").style.visibility = "hidden";
	}
	
	
	//var p = document.getElementById(packageRef);
	document.getElementById(packageRef).style.background = (packageRef == selectedPackage ? "#FEF5B2" : "beige");//	FFED6F
	document.getElementById(packageRef+"Details").style.visibility = "visible";
	
	
	//alert("packageRef --> "+packageRef);
	/*if ( previousPackage != packageRef ) {
		//document.getElementById(previousPackage+"Details").style.visibility = "hidden";
		alert("previousPackage --> "+previousPackage);
	}
	
	previousPackage = packageRef;
	*/
	//document.getElementById("starterDetails").style.visibility = (packageRef == selectedPackage ? "visible" : "hidden");
	//document.getElementById("officeDetails").style.visibility = (packageRef == selectedPackage ? "visible" : "hidden");
	//document.getElementById("premierDetails").style.visibility = (packageRef == selectedPackage ? "visible" : "hidden");
	
	
	
	/*for (i=0; i<packages.length; i++) {
		if ( packages[i].name == selectedPackage ) {
			//alert("you done it --> "+packages[p].name);
			
			// check if package selected
			
			// change selected package text
			
			// change visibility of package details
			
			document.getElementById(packages[i].name+"Details").style.visibility = "visible";
			
		} else {
			document.getElementById(packages[i].name+"Details").style.visibility = "hidden";
		}
	}*/
	
}


function toggleOff(packageRef) {
	document.getElementById(packageRef).style.background = (packageRef == selectedPackage ? "#FFED6F" : "white");
	if (packageRef != selectedPackage) {
		document.getElementById(packageRef+"Details").style.visibility = "hidden";
		document.getElementById(selectedPackage+"Details").style.visibility = "visible";
	}
	
}

// -->
</script>




<tr>
	<td colspan=3>
		<!--<img src='images/axc_promotion_01.png' class='packageSale'>-->
		<h3 style='color:#333333;padding:15px;border:dotted gray 1px;background-color:lightgray;text-align:center;' id='selectedPackageText'>CLICK BELOW TO SELECT A PACKAGE</h3></td>
</tr><tr>
	
	<td valign=center height=200 width=30% style='' >
		<div class='packagesBoxes' id='starter' onmouseover='toggleOn("starter");' onmouseout='toggleOff("starter");' onclick='selectPackage("starter");'>
			<h1 style='margin:auto;'>DESIGN<br />STARTER</h1><p>
			<div class=''>
				<h3>$600<br /> <nobr>Licensing & Setup</nobr><br />
				$30/month</h3>
			</div>
			<div class='packagesRadio'><input type=radio name=package value='starter' id='starterRadio'> click to select</div>
		</div>
	</td>
	
	<td valign=center height=200 width=30% style=''>
		<div class='packagesBoxes' id='office' onmouseover='toggleOn("office");' onmouseout='toggleOff("office");' onclick='selectPackage("office");'>
			<h1>DESIGN<br />OFFICE</h1><p>
			<div class=''>
				<h3><nobr><strike>$2400</strike> $2000</nobr> <nobr>Licensing & Setup</nobr><br />
				$50/month</h3>
			</div>
			<div class='packagesRadio'><input type=radio name=package value='office' id='officeRadio'> click to select</div>
		</div>
	</td>
	
	<td valign=center height=200 width=30% style=''>
		<div class='packagesBoxes' id='premier' onmouseover='toggleOn("premier");' onmouseout='toggleOff("premier");' onclick='selectPackage("premier");'>
			<h1>PREMIER<br />DESIGN<br />OFFICE</h1><p>
			<div class=''>
				<h3><nobr><strike>$3600</strike> $3000</nobr> <nobr>Licensing & Setup</nobr><br />
				$100/month</h3>
			</div>
			<div class='packagesRadio'><input type=radio name=package value='premier' id='premierRadio'> click to select</div>
		</div>
	</td>
	
</tr><!--<tr>
	<td height=200 colspan=3><h3 style='height:100%;padding:10px;border:solid gray 1px;background-color:white;text-align:center;vertical-align:middle;display:block;' id='packageDetails'>Package Details</h3></td>
</tr>--><tr style=''>
	<td colspan=3>
		<div class='packageDetailsBox' style=''>
			
			<div id='starterInit' class='packageDetails' style='visibility:visible;text-align:center;'>
				<h2>Select a Package Above</h2>
				<h3 style='color:gray;'>or click here to compare all three packages with each other. Obviously this part is not done yet, but there will be a link that will expland a matrix of the three plans.</h3>
				<br>
				
			</div>
			
			
			<div id='starterDetails' class='packageDetails'>
				<h2>Design Starter Package Details</h2>
				<h3>The Design Starter is for small to mid size offices with fewer projects or which would like to test the marketing benefits of having projects immediately available for potential clients to access.</h3>
				<br>
				
				<table border=0 bordercolor=lightgreen align=center cellpadding=4>
					<tr>
						<td valign=top width=33%>
							<h3 class='packageFeatures'>Features</h3>
							<ul class='packageFeatures'>
								<li>max 12 projects</li>
								<li>max 3 images / project</li>
								<li>custom style sheet</li>
								<li>or select from 5 style sheet templates</li>
							</ul>
						</td><td valign=top width=33%>
							<h3 class='packageFeatures'>Web Site / Administration</h3>
							<ul class='packageFeatures'>
								<li>client manager</li>
								<li>about us manager</li>
								<li>image logo manager</li>
								<li>contact us form</li>
							</ul>
						</td><td valign=top width=33%>
							<h3 class='packageFeatures'>Hosting</h3>
							<ul class='packageFeatures'>
								<!--<li>100MB of storage capacity</li>-->
								<li>2GB of Bandwidth</li>
								<li>unlimited email addresses</li>
								<li>unlimited email forwarders</li>
							</ul>
						</td>
					</tr>
				</table>
				<div class='packagePromotion'>
					<h2>SAVE $400 ON SETUP AND LICENSING FEES<br />
					<small>with initial sign up for the Office account on registration</small></h2>
					<small style='color:gray;'>(otherwise there will be a $1800 configuration and licensing fee when upgrading from the Starter to the Office package)</small>
					</div>
				
				<div class='packageContinue'><input type=submit name=continue value='Continue...'></div>
			</div>
			
			
			<div id='officeDetails' class='packageDetails' style=''>
				<h2>Design Office Package Details</h2>
				<h3>The Design Office is for offices that require a broad range of projects to be available online to potential clients.</h3>
				<br>
				
				<table border=0 bordercolor=lightgreen align=center cellpadding=4>
					<tr>
						<td valign=top width=33%>
							<h3 class='packageFeatures'>Features</h3>
							<ul class='packageFeatures'>
								<li>max 36 projects</li>
								<li>max 10 images / project</li>
								<li>max 5 construction images / project</li>
								<li>custom style sheet</li>
								<li>or select from 10 style sheet templates</li>
							</ul>
						</td><td valign=top width=33%>
							<h3 class='packageFeatures'>Web Site / Administration</h3>
							<ul class='packageFeatures'>
								<li>client manager</li>
								<li>about us manager</li>
								<li>image logo manager</li>
								<li>publications manager</li>
								<li>awards manager</li>
								<li>categories (landscape, architecture, interiors, etc.)</li>
								<li>project types / departments</li>
								<li>project backup</li>
								<li>site map</li>
								<li>project list</li>
								<li>career and job positions manager</li>
							</ul>
						</td><td valign=top width=33%>
							<h3 class='packageFeatures'>Hosting</h3>
							<ul class='packageFeatures'>
								<!--<li>1000MB of storage capacity</li>-->
								<li>5GB of Bandwidth</li>
								<li>unlimited email addresses</li>
								<li>unlimited email forwarders</li>
							</ul>
						</td>
					</tr>
				</table>
				
				<div class='packagePromotion'>
					<h2>SAVE $600 ON SETUP AND LICENSING FEES<br />
					<small>with initial sign up for the Premier account on registration</small></h2>
					<small style='color:gray;'>(otherwise there will be a $1200 configuration and licensing fee when upgrading from the Office to the Premier package)</small>
					</div>
				
				<div class='packageContinue'><input type=submit name=continue value='Continue...'></div>
			</div>
			
			
			<div id='premierDetails' class='packageDetails' style=''>
				<h2>Premier Design Package Details</h2>
				<h3>The Premier Design Package is designed for larger offices that have a large number of projects. ArchXchange is a great way to give anyone the ability to update and manage the website instantaneously.</h3>
				<br>
				
				<table border=0 bordercolor=lightgreen align=center cellpadding=4>
					<tr>
						<td valign=top width=33%>
							<h3 class='packageFeatures'>Features</h3>
							<ul class='packageFeatures'>
								<li>unlimited projects</li>
								<li>unlimited images / project</li>
								<li>unlimited construction images / project</li>
								<li>custom style sheet</li>
								<li>all available style sheet templates</li>
							</ul>
						</td><td valign=top width=33%>
							<h3 class='packageFeatures'>Web Site / Administration</h3>
							<ul class='packageFeatures'>
								<li>employee profile manager</li>
								<li>media / video manager</li>
								<li>office reports manager</li>
								<li>consultant manager</li>
								<li>office location manager</li>
							</ul>
						</td><td valign=top width=33%>
							<h3 class='packageFeatures'>Hosting</h3>
							<ul class='packageFeatures'>
								<li>5000MB of storage capacity</li>
								<li>10GB of Bandwidth</li>
								<li>unlimited email addresses</li>
								<li>unlimited email forwarders</li>
							</ul>
						</td>
					</tr>
				</table>
				
				<div class='packagePromotion'>
					<h2>SAVE 10% ON SETUP AND LICENSING FEES<br />
					<small>with full payment of the annual fee up front (after 30 day trial period)</small></h2>
					<small style='color:gray;'></small>
					</div>
				
				<div class='packageContinue'><input type=submit name=continue value='Continue...'></div>
			</div>
			
			
		</div>
	</td>
</tr><!--<tr>
	<td align=center colspan=3>
		<div style=''><input type=submit name=continue value='Continue...'></div></td>
</tr>-->


<?php

/////////////////////////////////////////////////////////////////////////////////////
////////// END BODY
//echo form_table_end();
echo "</TABLE>";
echo "</FORM>";






////////// CHECK VARIABLES
/////////////////////////////////////////////////////////////////////////////////////
//-- echo "<B>\$error</B><BR>"; dev_print($error);
//-- echo "<B>\$_REQUEST</B><BR>"; dev_print($_REQUEST);



////////// FOOTER
/////////////////////////////////////////////////////////////////////////////////////
include(TEMPLATE_BASE_DIR . "_includes/inc_footer.php");

?>
