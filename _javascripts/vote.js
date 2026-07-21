
var urlBase = "ajax_vote.php?";

//http://www.dynamicajax.com/fr/AJAX_Hello_World-271_290_322.html

//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest(); //Not IE
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP"); //IE
	} else {
		//Display your error message here. 
		//and inform the user they might want to upgrade
		//their browser.
		alert("Your browser doesn't support the XmlHttpRequest object.  Better upgrade to Firefox.");
	}
}

//Get our browser specific XmlHttpRequest object.
var receiveReq = getXmlHttpRequestObject();


var req;

function apple_getXmlHttpRequestObject() {
	// branch for native XMLHttpRequest object
	if(window.XMLHttpRequest) {
		try {
			req = new XMLHttpRequest();
		} catch(e) {
			req = false;
		}
	// branch for IE/Windows ActiveX version
	} else if(window.ActiveXObject) {
	   	try {
			req = new ActiveXObject("Msxml2.XMLHTTP");
	  	} catch(e) {
			try {
		  		req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {
		  		req = false;
			}
		}
	}
	
}


//////////////////////////////////////////////////

function loadXMLDoc(url) {
	req = false;
	
	apple_getXmlHttpRequestObject();
	
	if (req) {
		req.onreadystatechange = processReqChange;
		req.open("GET", url, true);
		req.send("");
	} else {
		alert('req NOT set');
	}
}



function processReqChange() {
	// only if req shows "loaded"
	if (req.readyState == 4) {
		// only if "OK"
		//alert('only if OK --> OK');
		if (req.status == 200) {
			// ...processing statements go here...
			//alert(req.responseText);
			
			
		} else {
			alert("There was a problem retrieving the XML data:\n" +
				req.statusText);
		}
	} //else alert('loading...');
}

function processVote(id,vote,ref_id,type,user_id,project_id,direction)  {
	loadXMLDoc('ajax_vote.php?vote='+ vote +'&ref_id='+ ref_id +'&type='+ type +'&user_id='+ user_id +'&project_id='+ project_id +'&direction='+ direction);
	//document.getElementById('current-rating_'+ ref_id).style.width = vote +'px';
	//alert('ajax_vote.php?vote='+ vote +'&ref_id='+ ref_id +'&type='+ type +'&user_id='+ user_id +'&project_id='+ project_id +'&consecutive='+ consecutive);
	document.getElementById(type +'_nav_'+ ref_id).style.color = '#DD424E';
	document.getElementById(type +'_nav_'+ ref_id).style.padding = '5px 5px 5px 10px';
	document.getElementById(type +'_nav_'+ ref_id).innerHTML = 'Thanks for your input... Every vote counts!';
	//". $type ."_nav_". $info['projects_'. $type .'_id'] ."
	
}


function imageRotate(direction,ref_id) {
	
	//alert('direction is '+ direction +' ['+ ref_id +']');
	
	loadXMLDoc('ajax_rotate.php?direction='+ direction +'&ref_id='+ ref_id);
	
	//var objImg = document.images['image_'+ ref_id];
	
	tmp = new Date();
	tmp = "?"+ tmp.getTime()
	//document.getElementById('image_'+ ref_id).src = './_uploads/'+ ref_id +'.png'+ tmp;
	document.images['image_'+ ref_id].src = './_uploads/'+ ref_id +'.png'+ tmp;
	//alert('./_uploads/'+ ref_id +'.png'+ tmp)
	
	document.getElementById('image_'+ ref_id).style.display = 'none';
	document.getElementById('image_'+ ref_id).style.display = '';
	
}














