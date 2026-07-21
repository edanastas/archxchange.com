// ALTER SELECT MENU BY ADDING NEW OPTION
/*
This function can be added to the onChange of any select box
It makes the select box extensible - if the user chooses  the
last option (no matter what it is) then the user is prompted
to enter the new value. This is then added to
the drop-down and selected

To use it do
<SELECT onChange=\"check_extend_select(this)\" />
or
$optionbox->set_extra('onChange=\"check_extend_select(this)\"');
*/
// append prompt submission to menu select options --> first referenced in project.php form
function check_extend_select(select,prompt,value,check_trigger) {
	if (prompt==undefined) prompt='Please enter the desired value';
	if (value==undefined) value='';
	if (
		(check_trigger==undefined && select.selectedIndex==select.options.length-1) ||
		(check_trigger!=undefined && select.options[select.selectedIndex].value==check_trigger)
	) {
		new_value = window.prompt(prompt,value,prompt);
		// check to see if they actually provided a value
		if (new_value == null || new_value=='') {
			select.selectedIndex = 0;
		} else {
			if (check_trigger==undefined) {
				// add the new option in next-to-last on the list
				select.options[select.options.length] = new Option( select.options[select.options.length-1].text, select.options[select.options.length-1].value);
				select.options[select.options.length-2] = new Option(new_value +' [ADD]',new_value);
				select.selectedIndex = select.options.length-2;
			} else {
				// add the new option in at the very end
				select.options[select.options.length] = new Option(new_value,new_value);
				select.selectedIndex = select.options.length-1;
			}
		}
	}
}

// OPEN NEW SCALED WINDOW
function OpenWin(Loc,WinName,Width,Height) {
	var WinName = WinName 
	var WinInfo = "toolbar=no,scrollbars=yes,directories=no,resizable=yes,menubar=no,width=" + Width + ",height=" + Height + ",screenX=100,screenY=100,top=100,left=100 "
	window.open(Loc,WinName,WinInfo);
}

// SET CURSOR TO END OF TEXT INPUT
// first referenced in project.php form
function setCaretToEnd (control) {
	var length = control.value.length;
	if (control.createTextRange) {
		var range = control.createTextRange();
		range.collapse(false);
		range.select();
	} else if (control.setSelectionRange) {
		control.focus();
		control.setSelectionRange(length, length);
	}
	control.scrollTop = length;
}








// FORM CHANGES DISCARD CONFIRMATION FUNCTIONS
// the following function require confirmation before leaving and discarding form changes
var formAlteredFlag
// = true;
// first referenced on project.php 
function confirmDiscard(confirmNow) {
	//var formAlteredFlag;
	//alert(formAlteredFlag);
	
	if ( formAlteredFlag == true || confirmNow ) {
		//confirm('The form has not been submitted.\nDiscard your changes?');
		return window.confirm("The form has not been submitted. Discard your changes?");
	}
}



function formAltered() {
	formAlteredFlag = true;
	//var temp = formAlteredFlag; alert('was '+temp +' no is --> '+formAlteredFlag);
}



/* ------------------------------------------------------------------------------- 
		09/23/03 - jgould
		http://www.sandbox.paypal.com/js/pp_main.js
		Function for preventing multiple submit.
		It both submits the form and ensures the form can not be submit again
		by reassigning the funciton to a function that does nothing.
		It also disables the buttons (this part only works in IE).
		f - the form the buttons are in
		USAGE!: 
		if used on an entire form -->  onSubmit=\"return safeSubmit(this);\" // remove the form from this.form?
		if used on a specific button use -->  onClick=\"return safeSubmit(this.form);\"
------------------------------------------------------------------------------- */
function safeSubmit(elem) {
	if ( elem.value ) { // if submitted from current form element (not entire form)
		//alert('elem.value --> '+ elem.value);
		elem.value = 'PLEASE WAIT, PROCESSING...';
		
		f = document.forms[0];
		formLength = f.length;
		//alert('formLength --> '+ formLength);
	} else { // if checking all the form elements
		formLength = elem.elements.length;
		//alert('formLength --> '+ formLength);
	}
	
	for (i=1; i<formLength; i++) {
		if (f.elements[i].type == 'submit') {
			f.elements[i].disabled = true;
		}
	}
	
	f.submit();
	safeSubmit = blockIt;
	return false;
}


function confirmMetroProvince() {
	
	var province = document.getElementById('zone_id');
	var metro = document.getElementById('metro_id');
	
	if ( !IsNumeric(metro.value) ) {
		//var p = "Are you sure you want to add the New Metropolitan Area "+ metro.value +" to the province/state "+ province.options[province.selectedIndex].text;
		var p = "Please confirm that you are adding the New Metropolitan Area...\n\r   "+ metro.value +"\n\r...to the correct province/state ("+ province.options[province.selectedIndex].text +"). Click Cancel to return to the form or OK to continue.";
		
		var agree = confirm(p);
		if (agree) {
			return true;
		} else {
			
			return false;
		}
	}
}

// used first in confirmMetroProvince()
function IsNumeric(sText) {
	var ValidChars = "0123456789.";
	var IsNumber=true;
	var Char;
	
	for (i = 0; i < sText.length && IsNumber == true; i++) {
		Char = sText.charAt(i);
		if (ValidChars.indexOf(Char) == -1) {
			IsNumber = false;
		}
	}
	return IsNumber;
}


/*
startList = function() {
	if (document.all && document.getElementById) {
		navigationRoot = document.getElementById("navigation");
		var l = navigationRoot.childNodes.length;
		for (i=0; i<l; i++) {
			
			node = navigationRoot.childNodes[i];
			if (node.nodeName=="LI") {
				node.onmouseover=function() {
					this.className += " over";
					
				}
				node.onmouseout=function() {
					this.className = this.className.replace(" over", "");
				}
			}
		}
	}
}
*/

function testEffect(elem) {
	
	new Effect.Appear(elem,{fps:100,duration:.3,queue:'end'})
	//new Effect.SlideRightIntoView(elem)
	//new Effect.SlideRightIntoView(elem,{fps:100,duration:.2,queue:'end'})
}

var previousImage
var elem

function testImages(elem) {
	
	if ( !previousImage ) previousImage = 'projectImage_1';
	
	if ( previousImage != elem ) {
		
		//alert(previousImage);
		if ( previousImage != null ) {
			
			testEffect(elem)
			
			new Effect.Fade(previousImage,{fps:100,duration:.3,queue:'end'})
			/*
			new Effect.Fade(previousImage)
			new Effect.Shrink(previousImage)
			
			new Effect.SlideRightOutOfView(previousImage,{ 
					fps:100,
					afterFinish: testEffect(elem)
				}
			);
			
			
			
			
					duration:.2,
			,
					afterFinish: setTimeout('new Effect.SlideRightIntoView(elem)',1000)
			new Effect.SlideRightIntoView(elem,{
				fps:100,
				duration:.2,
				queue:'end'
				});
			
				queue:'front',
				limit: 1
				
			new Effect.SlideRightOutOfView(previousImage,{ 
				fps:100,
				duration:.2, 
				afterFinish: new Effect.SlideRightIntoView(elem,{queue:'end'})
			});
			
			new Effect.SlideRightIntoView(previousImage,{ 
				duration:.2, 
				transition: Effect.Transitions.reverse, 
				afterFinish: new Effect.SlideRightIntoView(elem)
			});
			*/
			
			//previousImage.style.display = "none";
			
		}/* else {
			new Effect.Appear(elem,{fps:100,duration:.3,queue:'end'})
			/*
			new Effect.SlideRightIntoView(elem,{ 
					fps:100,
					duration:2, 
					transition: Effect.Transitions.slowstop 
				}
			);
		}*/
	}
	
	
	previousImage = elem;
}


/* ------------------------------------------------------------------------------- 
		09/23/03 - jgould
		Dummy function that is used in conjunciton with safeSubmit(f) to prevent 
		multiple submits.
------------------------------------------------------------------------------- */
function blockIt(f) {
	return false;
}


function testAlert() {
	alert('this is a test');
}



/*******************************************************
FORMS
All code by Ryan Parman, unless otherwise noted.
(c) 1997-2003, Ryan Parman
http://www.skyzyx.com
Distributed according to SkyGPL 2.1, http://www.skyzyx.com/license/
*******************************************************/


/*******************************************************
ALLOW ONLY ONE SUBMISSION OF THE FORM
Attach an onload to the form tag.  Can use this.name.
*******************************************************/
/*function submitOnce(formName) {
	this.formName=(formName) ? formName:0;

	if (document.forms && document.getElementsByTagName)
	{
		var subFields=eval('document.forms["'+this.formName+'"].getElementsByTagName("input");');

		var subFieldsLen=subFields.length;
		for (k=0; k<subFieldsLen; k++)
		{
			if (subFields[k].getAttribute("type").toLowerCase() == "submit") subFields[k].disabled=true;
			if (subFields[k].getAttribute("type").toLowerCase() == "reset") subFields[k].disabled=true;
		}
	}
}

function disableForm(theform) {
	
	if (document.all || document.getElementById) {
	for (i = 0; i < theform.length; i++) {
	var tempobj = theform.elements[i];
	if (tempobj.type.toLowerCase() == "submit" || tempobj.type.toLowerCase() == "reset")
	tempobj.disabled = true;
}

*/













