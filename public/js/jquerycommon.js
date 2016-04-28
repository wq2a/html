var count=0;

var speed = 40;

var toggle = true;
var toggleLock=false;

$(document).ready(function() {    

	var allD;
	
	var allR;
	
	var shinning;
	
	var ctimer;
	
	$('#lava_menu li a').click(function(){

		var btnName = $(this).attr('text');
		
		var showid;
		
		if(btnName=='文本数据'){
			showid = '#contnetdata';
		}else if(btnName=='CMS数据'){
			showid = '#cmsdata';
		}else if(btnName=='内容评审'){
			showid = '#rate';
		}else if(btnName=='数据表管理'){
			showid = '#tablemanagment';
		}else if(btnName=='会员管理'){
			showid = '#membermanagement';
		}else if(btnName=='系统维护'){
			showid = '#systemmanagment';
		}
		/*
		if(btnName=='CMS数据'){
			$('.content').hide(1,function(){
			    $(showid).show(1);
				$(showid).animate({top:'-=2000px'},1).animate({top:'+=2050px'},1);
			
			});
		}else{
			$('.content').hide(1,function(){
			
				$(showid).show(3000);
			
			});
		}*/
		
		$('.content').hide(1,function(){
			
			$(showid).show(1);
			
		});
	});
	
	//$("#Aggregation_block_red").click(function(){
		//$("#Aggregation_block_red").animate({opacity: 0.3}, 200);
		//$("#Aggregation_block_red").animate({opacity: 1.0}, 200);
		//for(var i = 0; i < 5; i++){
			//$("#Aggregation_block_red").animate({top:'100px'},"slow");
			//$("#Aggregation_block_red").animate({right:'5px'},"slow");
		//}
	//});
	/*
	$("#setlogo").toggle(function(){
		//$("#setlogo").animate({opacity: 0.3}, 500);
		//for(var i = 0; i < 5; i++){
		//$("#setlogo").animate({right:'21px'},30);
		//$("#setlogo").animate({right:'19px'},30);
		//}
		
			clearTimeout(allR);
			clearTimeout(allD);
			allD = setTimeout(appear(),1);
			shinning = setInterval('shinning()',5000);
		
		
		
	},function(){
		
			clearTimeout(allR);
			clearTimeout(allD);
			clearInterval(shinning);
			allR = setTimeout(disappear(),1);
		
		
		
	});*/
	
	$("#setlogo").click(function(){
		//$("#setlogo").animate({opacity: 0.3}, 500);
		//for(var i = 0; i < 5; i++){
		//$("#setlogo").animate({right:'21px'},30);
		//$("#setlogo").animate({right:'19px'},30);
		//}
		
		if(toggle&&!toggleLock){
			toggleLock = true;
			clearTimeout(allR);
			clearTimeout(allD);
			allD = setTimeout(appear(),1);
			shinning = setInterval('shinning()',5000);
			//ctimer = setInterval('ctimerf()',10);
			
		}else if(!toggleLock){
		
			toggleLock = true;
			clearTimeout(allR);
			clearTimeout(allD);
			clearInterval(shinning);
			//clearInterval(ctimer);
			allR = setTimeout(disappear(),1);
		
		}
		
	});
	
	$("#submit_return").click(function(){
		$("#registerlayout").animate({opacity: 0.0}, 200).hide(1,function(){
			//$("#registerlayout").hide(1);
			$("#loginlayout").show(1).animate({opacity: 1.0}, 200);
		});
	});
	
	$("#goto_register").click(function(){
		$("#loginlayout").animate({opacity: 0.0}, 200).hide(1,function(){
		
			$("#registerlayout").show(1).animate({opacity: 1.0}, 200);
		});
	});
	
	
	
	/*
	$("#setlogo").hover(
	function(){
		//$("#setlogo").animate({opacity: 0.3}, 500);
		for(var i = 0; i < 5; i++){
		$("#setlogo").animate({right:'21px'},30);
		$("#setlogo").animate({right:'19px'},30);
		}
		clearTimeout(allR);
		clearTimeout(allD);
		allD = setTimeout(allDisappearLeft(),1);
		
	},function(){
		//$("#setlogo").animate({opacity: 1.0}, 500);
		clearTimeout(allD);
		clearTimeout(allR);
		allR = setTimeout(allRecover(),1);
	});*/
	
});

function shinning(){

	$("#setlogo").animate({opacity: 0.5}, 200).animate({opacity: 1.0}, 200).animate({opacity: 0.5}, 200).animate({opacity: 1.0}, 200);
	
}

var currentTime = 0;

var testtime = 500;

var x = 0;

var y = 0;

function ctimerf(){

	/*
	if(currentTime%2==0&&(Math.floor(currentTime/10))%2==0){
	$("#test").animate({marginLeft:'+=50px'},testtime);
	}else if(currentTime%2==1&&(Math.floor(currentTime/10))%2==0){
	$("#test").animate({marginTop:'-=50px'},testtime);
	}else if(currentTime%2==0&&(Math.floor(currentTime/10))%2==1){
	$("#test").animate({marginLeft:'-=50px'},testtime);
	}else if(currentTime%2==1&&(Math.floor(currentTime/10))%2==1){
	$("#test").animate({marginTop:'+=50px'},testtime);
	}
	*/
	/*
	currentTime++;

	$("#test").animate({marginLeft:'+='+currentTime/100+'px',marginTop:'+='+Math.sin(currentTime/100)/3+'px'},10);
	*/


	/*
	$("#test").animate({marginLeft:'+=100px',marginTop:'+=20px'},1000).animate({marginLeft:'-=100px',marginTop:'-=20px'},1000);
	*/
	/*$("#test").animate({width:'-=20px',marginLeft:'+=20px',borderWidth:'-=20px',},500).animate({width:'+=20px',borderWidth:'+=20px',marginLeft:'-=20px',},500);
	*/
	//currentTime = 'eeeeee';//time();

	//$("#timeup").text(currentTime.toString(2)).animate({top:'-=15px',height:'+=15px'},500).animate({top:'+=15px',height:'-=15px'},500);
	//num = num + Math.floor((Math.random() * 2) + 0);;

	//$("#ctimer").text(num);//num.toString(2)

}

function appear(){
	$("#lava_menu,#bottomshadow").animate({top:'-=500px',},1);
	$("#setlogo").animate({height:'+='+speed+'px'},250);
	$("#setlogo").animate({top:'+='+speed+'px',height:'-='+speed+'px',},250);
	$("header").css("background-color", "#252525").animate({height:'+=600px'},300,function(){//.animate({opacity: 0.8},20)
		$("#main1").animate({opacity: 0.0}, 1).show(1).animate({opacity: 1.0}, 500);
		$("#leftline").animate({width:'+=80%'},200,function(){$("#rightline").animate({marginLeft:'-=80%',width:'+=80%',text:'+="1"'},200)});
		//.animate({width:'-=5%',marginLeft:'+=5%'},100).animate({width:'+=5%',marginLeft:'-=5%'},100)
		toggle = false;
		toggleLock = false;
	});
	/*
	var preTime = 0;
	
	var tempTime = 0;
	
	for(var index=1;index<51;index++){
	
		tempTime = Math.sqrt(0.00000000001*index);
		
		setTimeout($("header").animate({height:'+=10px',},(tempTime-preTime)*1000),preTime*1000);
		
		preTime=tempTime;
	
	}*/
	

	//$("#lava_menu").animate({top:'-=500px',},300);
	/*
	var speed = 560/showspeed;
	
	for(var i = 0; i < showspeed&&count<showspeed; i++){
		$("#setlogo").animate({height:'+='+speed+'px'},150);
		$("#setlogo").animate({top:'+='+speed+'px',height:'-='+speed+'px',},150);
		
		count=i;
		
		$("header").animate({
		height:'+='+speed+'px',},300);
	}
	
	$("#main1").show( 300*showspeed );
	*/

	//$("#Aggregation_top").animate({right:'-2000px'},500);
	//$("#homeimage1").animate({left:'-2000px'},500);
	/*
	$("#setlogo").animate({
	top:'+=50px',
	},300).animate({top:'-=5px'},100).animate({top:'+=5px'},100).animate({top:'-=5px'},100).animate({top:'+=5px'},30,
	function(){
		$("header").animate({
      
      height:'+=500px',
    
    },600,
	function(){
	  $("#main1").show( 1 )//.animate({height:'+=100px',width:'+=100px',}, 200)
	}
	);
	}
	);
	
	
	
	for(var i = 0; i < 27; i++){
	
		$("#setlogo").animate({top:'-=20px',height:'+=20px',},300);
		$("#setlogo").animate({height:'-=20px'},300);
		
	
	}
	*/
}

function disappear(){
	$("#main1").hide(1);
	$("#setlogo").animate({top:'-='+speed+'px',height:'+='+speed+'px',},100);
	$("#setlogo").animate({height:'-='+speed+'px'},100);
	$("header").animate({height:'-=600px',},300,function(){
	
		$("header").css("background-color", "#c00000").animate({opacity: 1.0},20);
		$("#lava_menu,#bottomshadow").animate({top:'+=500px',},1);
		$("#leftline").animate({width:'-=80%'},1);
		$("#rightline").animate({width:'-=80%',marginLeft:'+=80%'},1);
		toggle = true;
		toggleLock = false;
	});

	//$("#Aggregation_top").animate({right:'0px'},500);//,height:'222px',width:'950px'
	//$("#homeimage1").animate({left:'0px'},500);
	/*
	$("header").animate({
      
      height:'-=500px',
    
    },500);
	
	$("#main1").hide();
	*/
	//$("#lava_menu").animate({top:'+=500px',},300);
	/*
	var speed = 560/hidespeed;
	$("#main1").hide( 300*hidespeed);
	for(var i = hidespeed-1; i>= 0&&count>=0; i--){
	
		$("#setlogo").animate({top:'-='+speed+'px',height:'+='+speed+'px',},150);
		$("#setlogo").animate({height:'-='+speed+'px'},150);
		count=i;

		$("header").animate({
		height:'-='+speed+'px',
	
		},300,function(){
	
			
		})
	
	}*/
	
}

function adminhomejq(){
setInterval('adminaction()',5000);

}
var speedpercent = 10;

var leftboundery = 50;

var topboundery = 50;

var setlogoposition = 1;

var climbspeed = 250;

function adminaction(){
	$("#setlogofun").animate({opacity: 0.5}, 200).animate({opacity: 1.0}, 200).animate({opacity: 0.5}, 200).animate({opacity: 1.0}, 200);

	setlogoposition = Math.floor(Math.random() * 4) + 1;
	switch(setlogoposition){
	// down
	case 1:
	if(topboundery<100-speedpercent){
	$("#setlogofun").animate({height:'+='+speedpercent+'%'},climbspeed);
	$("#setlogofun").animate({top:'+='+speedpercent+'%',height:'-='+speedpercent+'%',},climbspeed);
	topboundery+=speedpercent;
	}
	break;
	// up
	case 2:
	if(topboundery>speedpercent){

	$("#setlogofun").animate({top:'-='+speedpercent+'%',height:'+='+speedpercent+'%'},climbspeed);
	$("#setlogofun").animate({height:'-='+speedpercent+'%'},climbspeed);
	topboundery-=speedpercent;
	}
	break;
	case 3:
	if(leftboundery<100-speedpercent){
	$("#setlogofun").animate({width:'+='+speedpercent+'%'},climbspeed);
	$("#setlogofun").animate({left:'+='+speedpercent+'%',width:'-='+speedpercent+'%',},climbspeed);
	leftboundery+=speedpercent;
	}
	break;
	case 4:
	if(leftboundery>speedpercent){

	$("#setlogofun").animate({left:'-='+speedpercent+'%',width:'+='+speedpercent+'%'},climbspeed);
	$("#setlogofun").animate({width:'-='+speedpercent+'%'},climbspeed);
	leftboundery-=speedpercent;
	}
	break;

	}

	/*
	if(Math.abs(topboundery-40)<=5&&Math.abs(leftboundery-40)<=5){

		$("#ballfun").animate({opacity: 0.5,width:'200px',height:'200px',top:'-=100px',left:'-=100px'}, 200)

	}*/
	//$("#buildingsfun").animate({height:'+='+100+'px',top:'-='+100+'px'},500);
	//$("#setlogofun").text('Top:'+$("#setlogofun").offset().top+'Left:'+$("#setlogofun").offset().left);

}

function getdistance(offset1,offset2){



}




