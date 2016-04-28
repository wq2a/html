var currentQuoteType='love';
var currentLeftQuoteType='love';
var currentLeftQuoteIndex='1';
var CURRENTLEFTQUOTE_COUNT='10';
var currentRightQuoteType='success';
var currentRightQuoteIndex='0';
var CURRENTRIGHTQUOTE_COUNT='10';
var currentCenterQuoteIndex='0';
var CURRENTCENTERQUOTE_COUNT='10';

// RequestID
var REGISTER_REQUEST=0;
var LOGIN_REQUEST=1;
var LOGOUT_REQUEST=2;
var USERNAMECHECK_REQUEST=3;
var ADMINLOGIN_REQUEST=4;
var ADMINREGISTER_REQUEST=5;
var ASMINLOGOUT_REQUEST=6;

var TOPQUOTE_REQUEST=7;
var QUOTE_REQUEST=8;
var QUOTELEFT_REQUEST=9;
var QUOTERIGHT_REQUEST=10;
var QUOTECENTER_REQUEST=11;

function sendPostR(url,requestID)
{
	var parametersArray = new Array();
	
	switch(parseInt(requestID)){
	case REGISTER_REQUEST:
		parametersArray['userName']=document.getElementById('realUserName').value;
		parametersArray['password']=document.getElementById('realPassword').value;
		parametersArray['email']=document.getElementById('realEmail').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case LOGIN_REQUEST:
		parametersArray['userName']=document.getElementById('userName').value;
		parametersArray['password']=document.getElementById('password').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case USERNAMECHECK_REQUEST:
		parametersArray['userName']=document.getElementById('realUserName').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case ADMINLOGIN_REQUEST:
	case ADMINREGISTER_REQUEST:
		parametersArray['userName']=document.getElementById('userName').value;
		parametersArray['password']=document.getElementById('password').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case LOGOUT_REQUEST:
	case ASMINLOGOUT_REQUEST:
	case TOPQUOTE_REQUEST:
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case QUOTE_REQUEST:
		parametersArray['type']=currentQuoteType;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case QUOTELEFT_REQUEST:
		parametersArray['type']=currentLeftQuoteType;
		parametersArray['index']=currentLeftQuoteIndex;
		parametersArray['count']=CURRENTLEFTQUOTE_COUNT;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case QUOTERIGHT_REQUEST:
		parametersArray['type']=currentRightQuoteType;
		parametersArray['index']=currentRightQuoteIndex;
		parametersArray['count']=CURRENTRIGHTQUOTE_COUNT;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;
	case QUOTECENTER_REQUEST:
		parametersArray['type']=currentCenterQuoteType;
		parametersArray['index']=currentCenterQuoteIndex;
		parametersArray['count']=CURRENTCENTERQUOTE_COUNT;
		dataRequestPost(url,requestID,parametersArray,receiveData);
		break;

	}
	
	
}

/**
 * Ajax Base Request Interface
 * author: Wanjiang
 * date: 5/20/2014
 */
function dataRequestPost(url,requestID,parametersArray,callBackFunction)
{	
	var xmlHttp;
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	xmlHttp.onreadystatechange = function() { callBackFunction(requestID,xmlHttp);};
	var parameters = new FormData();
	for (var parameter in parametersArray) 
	{ 
		parameters.append(parameter, parametersArray[parameter]);
	}
	xmlHttp.open("POST",url,true);
	xmlHttp.send(parameters);
}



function GetXmlHttpObject()
{
	var xmlHttp;
	try
	{
		xmlHttp=new XMLHttpRequest();
	}catch (e){
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}


function formatStringToArray(formatString){
	var parametersArray = new Array();
	var elements = formatString.split('|||');
	for(var index=0;index<elements.length;index++){

		var element = elements[index].split('&&&');

		parametersArray[element[0]]=element[1];
	}
	return parametersArray;
}

/*
	if(requestID==REGISTER_REQUEST){
		parametersArray['userName']=document.getElementById('realUserName').value;
		parametersArray['password']=document.getElementById('realPassword').value;
		parametersArray['email']=document.getElementById('realEmail').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}else if(requestID==LOGIN_REQUEST){
		parametersArray['userName']=document.getElementById('userName').value;
		parametersArray['password']=document.getElementById('password').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}else if(requestID==LOGOUT_REQUEST){
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}else if(requestID==USERNAMECHECK_REQUEST){
		parametersArray['userName']=document.getElementById('realUserName').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}else if(requestID==ADMINLOGIN_REQUEST){
		parametersArray['userName']=document.getElementById('userName').value;
		parametersArray['password']=document.getElementById('password').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}else if(requestID==ADMINREGISTER_REQUEST){
		parametersArray['userName']=document.getElementById('userName').value;
		parametersArray['password']=document.getElementById('password').value;
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}else if(requestID==ASMINLOGOUT_REQUEST){
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}else if(requestID==TOPQUOTE_REQUEST){
		dataRequestPost(url,requestID,parametersArray,receiveData);
	}*/