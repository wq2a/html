/**
 * Ajax Common Interface
 * author: Wanjiang
 * date: 5/8/2014
 */
var xmlHttp

/**
 * GET HTTP Request
 * date: 5/8/2014
 */
function ajaxFunction(controller,elementID)
{
	ajaxFunction(controller,elementID,'');

}

/**
 * GET HTTP Request
 * date: 5/20/2014
 */
function ajaxFunction(controller,errElementID,successElementID)
{
	ajaxFunction(controller,errElementID,successElementID,'');
}

/**
 * GET HTTP Request
 * date: 5/20/2014
 */
function ajaxFunction(controller,errElementID,successElementID,hideElementID)
{
	ajaxFunction(controller,errElementID,successElementID,hideElementID,'');
}

/**
 * GET HTTP Request
 * date: 5/20/2014
 */
function ajaxFunction(controller,errElementID,successElementID,hideElementID,showElementID)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	var url = controller;
	
	xmlHttp.onreadystatechange = function() { handleStateChange(xmlHttp,errElementID,successElementID,hideElementID,showElementID);};
	
	xmlHttp.open("GET",url,true)
	
	xmlHttp.send(null)
}

/**
 * POST HTTP Request: for image upload
 * date: 5/15/2014
 */
function ajaxUploadFileFunction(controller,file,elementID)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	var url = controller;//"http://127.0.0.1/nest_v1.0/login/check/"+value;
	
	xmlHttp.onreadystatechange = function() {handleStateChange(xmlHttp,elementID,'','','');};
	
	if(file["size"]<5000000){
		var formData = new FormData();
		formData.append('file', file);
		xmlHttp.open("POST",url,true);
		//xmlHttp.open('POST', this.options.action);
		//xmlHttp.setRequestHeader("Content-type", "multipart/form-data");
		//xmlHttp.setRequestHeader("X-File-Name", file.fileName);
		//xmlHttp.setRequestHeader("X-File-Size", file.fileSize);
		//xmlHttp.setRequestHeader("X-File-Type", file.type);
		xmlHttp.send(formData);
	}else{
		document.getElementById(elementID).innerHTML="超出大小"+file["size"];
	}
	
	
}

/**
 * POST HTTP Request: for image upload
 * date: 5/15/2014
 */
function ajaxPostFunction(controller,paramaters,elementID)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	var url = controller;
	
	xmlHttp.onreadystatechange = function() {handleStateChange(xmlHttp,elementID,'');};
	
	if(paramaters["size"]<5000000){
		var formData = new FormData();
		formData.append('paramaters', paramaters);
		xmlHttp.open("POST",url,true);
		xmlHttp.send(formData);
	}else{
		document.getElementById(elementID).innerHTML="超出大小"+paramaters["size"];
	}
	
	
}

/**
 * handle the state change
 */
function handleStateChange(x,e,s,h,sh){

	if (x.readyState==4 || x.readyState=="complete")
	{ 
		var locationpattern='^(http)'
		
		var alertpattern='^(alert:)'
		
		var appendpattern='^(ahead:)'
		
		var loginsuccesspattern='^(loginsuccess:)';
		
		var logoutsuccesspattern='^(logoutsuccess:)';
		
		if(x.responseText.match(locationpattern)){
			// echo begin with 'http:',make document handle it as an address
			window.location.href=x.responseText
			
		}else if(x.responseText.match(alertpattern)){
			// echo begin with 'alert:',make document handle it as an alert
			var alertText =  x.responseText.replace(/alert:/,'');
			document.getElementById(e).innerHTML=alertText
			$("#"+e).animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 2000);
			
		}else if(x.responseText.match(appendpattern)){
			var appendText =  x.responseText.replace(/ahead:/,'');
			document.getElementById(e).innerHTML = appendText+document.getElementById(e).innerHTML;
		}else if(x.responseText.match(loginsuccesspattern)){
			var userNameText =  x.responseText.replace(/loginsuccess:/,'');
			
			document.getElementById(e).innerHTML='登录成功'
			$("#"+e).animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 300);
			document.getElementById(s).innerHTML=userNameText
			$("#"+h).hide(300);
			$("#"+sh).show(1);
		}else if(x.responseText.match(logoutsuccesspattern)){
			
			//document.getElementById(s).innerHTML=''
			$("#"+h).hide(1);
			$("#"+sh).animate({opacity: 1.0}, 1).show(300);
		}else{
			// echo begin with nothing,make document handle it as a text
			document.getElementById(e).innerHTML=x.responseText 
		}
		
	}
}

/**
 *
 */
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}catch (e){
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}



/*
xmlHttp.onreadystatechange=(function(x,e) {
	return function() {
		if (x.readyState==4 || x.readyState=="complete")
		{ 
			var locationpattern='^(http)'
			
			var alertpattern='^(用户名)'
			
			if(x.responseText.match(locationpattern)){
				
				window.location.href=x.responseText
				
			}else if(x.responseText.match(alertpattern)){
				document.getElementById(elementID).innerHTML=x.responseText
				$("#"+elementID).animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 2000);
				
			}else{
				document.getElementById(elementID).innerHTML=x.responseText 
			}
			
		} 
	}
})(xmlHttp,elementID);
*/



