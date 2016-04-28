function receiveData(requestID,xmlHttp)
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		if(requestID==REGISTER_REQUEST){

			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['success']=='1'){
				loginState(data,1);
				//$('#registerlayout').hide(1);
			}else{
				document.getElementById('registeralert').innerHTML=data['alert'];
				$("#registeralert").animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 2000);
			}
			
		}else if(requestID==LOGIN_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['success']=='1'){
				loginState(data,1);
				//$('#loginlayout').hide(1);
			}else{
				document.getElementById('loginalert').innerHTML=data['alert'];
				$("#loginalert").animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 2000);
			}
		}else if(requestID==LOGOUT_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['success']=='1'){
				loginState(data,0);
				
			}
		}else if(requestID==USERNAMECHECK_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['alert']!=null&&data['alert']!=''){
				document.getElementById('realUserName').value='';
				document.getElementById('registeralert').innerHTML=data['alert'];
				$("#registeralert").animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 2000);
			}
		}else if(requestID==ADMINLOGIN_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			//document.getElementById('loginalert').innerHTML=xmlHttp.responseText;
			
			if(data['success']=='2'){
				if(data['url']!=null&&data['url']!=''){
					window.location.href=data['url'];
				}
			}else if(data['success']=='1'){
				if(data['alert']!=null&&data['alert']!=''){
					document.getElementById('loginalert').innerHTML=data['alert'];
					$("#loginalert").animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 2000);
				}
			}else{
				if(data['alert']!=null&&data['alert']!=''){
					document.getElementById('loginalert').innerHTML=data['alert'];
					$("#loginalert").animate({opacity: 1.0}, 1).animate({opacity: 0.0}, 2000);
				}
			}
		}else if(requestID==TOPQUOTE_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['quoteEng']!=null&&data['quoteEng']!=''){
				document.getElementById('topquote').innerHTML=data['quoteEng'];
				document.getElementById('topquoteauthor').innerHTML=data['authorName']+':  ';
			}
		
		//document.getElementById('topquote').innerHTML=xmlHttp.responseText;
		}else if(requestID==QUOTE_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['size']!=null&&data['size']!='0'){
				var quote='';
				var size=data['size'];
				for(var index=0;index<size;index++){
					var quoteEng='quoteEng'+index;
					var authorName='authorName'+index;
					if(data[quoteEng]!=null&&data[quoteEng]!=''&&data[authorName]!=null&&data[authorName]!=''){
						if(data[quoteEng].length<300){
						quote+='<div class="quotetext">'+data[quoteEng]+'<span class="quoteauthor">'+data[authorName]+'</span></div>';
						}
					}
				}
				$("#quoteleft").animate({opacity: 0.0}, 300,function(){
					document.getElementById('quoteleft').innerHTML=quote;
				}).animate({opacity: 1.0}, 500);			
			}
		}else if(requestID==QUOTELEFT_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['size']!=null&&data['size']!='0'){
				var quote='';
				var size=data['size'];
				for(var index=0;index<size;index++){
					var quoteEng='quoteEng'+index;
					var authorName='authorName'+index;
					if(data[quoteEng]!=null&&data[quoteEng]!=''&&data[authorName]!=null&&data[authorName]!=''){
						if(data[quoteEng].length<300){
						quote+='<div class="quotetext">'+data[quoteEng]+'<span class="quoteauthor">'+data[authorName]+'</span></div>';
						}
					}
				}
				$("#quotel").animate({opacity: 0.0}, 300,function(){
					document.getElementById('quotel').innerHTML=quote;
				}).animate({opacity: 1.0}, 500);			
			}
		}else if(requestID==QUOTERIGHT_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['size']!=null&&data['size']!='0'){
				var quote='';
				var size=data['size'];
				for(var index=0;index<size;index++){
					var quoteEng='quoteEng'+index;
					var authorName='authorName'+index;
					if(data[quoteEng]!=null&&data[quoteEng]!=''&&data[authorName]!=null&&data[authorName]!=''){
						if(data[quoteEng].length<300){
						quote+='<div class="quotetext">'+data[quoteEng]+'<span class="quoteauthor">'+data[authorName]+'</span></div>';
						}
					}
				}
				$("#quoter").animate({opacity: 0.0}, 300,function(){
					document.getElementById('quoter').innerHTML=quote;
				}).animate({opacity: 1.0}, 500);			
			}
		}else if(requestID==QUOTECENTER_REQUEST){
			var data = JSON && JSON.parse(xmlHttp.responseText) || $.parseJSON(xmlHttp.responseText);
			if(data['size']!=null&&data['size']!='0'){
				var quote='';
				var size=data['size'];
				for(var index=0;index<size;index++){
					var quoteEng='quoteEng'+index;
					var authorName='authorName'+index;
					if(data[quoteEng]!=null&&data[quoteEng]!=''&&data[authorName]!=null&&data[authorName]!=''){
						if(data[quoteEng].length<300){
						quote+='<div class="quotetext">'+data[quoteEng]+'<span class="quoteauthor">'+data[authorName]+'</span></div>';
						}
					}
				}
				$("#quotec").animate({opacity: 0.0}, 300,function(){
					document.getElementById('quotec').innerHTML=quote;
				}).animate({opacity: 1.0}, 500);			
			}
		}
	}
}

function loginState(data,state){

	switch(state)
	{
	case 0:
		$('#userinfotext').animate({height:'=0px'},1).hide(1);
		$('#loginlayout').animate({opacity: 1.0}, 1).show(1);
	break;
	case 1:
		document.getElementById('userNameText').innerHTML = "Welcome " + data['userName'];
		$('#userinfotext').show(1).animate({height:'=20px'},300);
	break;
	}
	$('#registerlayout').hide(1);
	$('#loginlayout').hide(1);
	removeValues();
}



function removeValues(){
	document.getElementById('userName').value='';
	document.getElementById('password').value='';
	document.getElementById('realUserName').value='';
	document.getElementById('realPassword').value='';
	document.getElementById('realEmail').value='';
	
}