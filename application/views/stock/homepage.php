<?php $this->load->view('stock/home');?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jqplot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.canvasAxisLabelRenderer.min.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.json2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.categoryAxisRenderer.min.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.ohlcRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.highlighter.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/jquery.jqplot.min.css" />


<div style="width:100%">

<div style="width:100%;position:relative;float:left;margin-top:10px;margin-bottom:10px;">
<input type="text" name="q" class="my_input" id="search_stock" placeholder="股票代码/股票名称" maxlength="200" data-autocomplete-disabled="false"
style="width:28%;" value="<?php if(isset($s)){echo $s;}?>"/></input>

<button type="button" class="my_button" onclick="searchstock(this)" value="搜索">股票搜索</button>

</div>


<div style="width:100%;position:relative;float:left;background:#c00000;color:#ffffff;">
<div class="my_h3 stocktablec" style="width:15%;font-size:18px;color:#ffffff;">股票名称</div>
<div class="my_h3 stocktablec" style="width:15%;font-size:18px;color:#ffffff;">历史最高</div>
<div class="my_h3 stocktablec" style="width:15%;font-size:18px;color:#ffffff;">历史最低</div>
<div class="my_h3 stocktablec" style="font-size:18px;color:#ffffff;">现价</div>
<div class="my_h3 stocktablec" style="font-size:18px;color:#ffffff;">跌幅</div>
<div class="my_h3 stocktablec" style="font-size:18px;color:#ffffff;">涨幅</div>
<div class="my_h3 stocktablec" style="font-size:18px;color:#ffffff;">价位</div>
</div>
<?php
$index=0;
foreach($records->result() as $item){
	
	if($item->close!=0){
		// set row background
		$color='#FFF8DC';
		if($index%2==0){
			$color='#DCDCDC';
		}
		$index++;
		
		echo '<div style="width:100%;position:relative;float:left;margin-bottom:1px;background:'.$color.';">';
		$code = $item->code;
		$name = str_replace('中国','<span style="color:#c00000;">中国</span>',$item->name);
		$increase = number_format((100*($item->close-$item->lowest)/$item->lowest), 2, '.', '');
		$decrease = number_format((100*($item->highest-$item->close)/$item->highest), 2, '.', '');
		
		echo '<div class="my_h3 stocktablec" style="width:15%;font: 18px/1.8 \'Microsoft YaHei\',sans-serif;">'.$name;
		if($item->mystock==1){
			echo '<span style="font:12px/1.5 \'Microsoft YaHei\',sans-serif;color:#ffffff;background:#c00000;padding:2px;border-radius:5px;margin-left:2px;">自选</span>';
		}
		echo '<br/><span style="font:15px/1.2 \'Microsoft YaHei\',sans-serif;">'.$code.'</span>';
		if($item->mystock==0){
			echo '<a class="my_h3 my_a" style="color:#555555;" data-code="'.$item->code.'" data-codetype="'.$item->codetype.'" 
			data-mystock="'.$item->mystock.'" onclick="myStock(this)">+</a>';//onclick="deleteCode(this)
		}else{
			echo '<a class="my_h3 my_a" style="color:#555555;" data-code="'.$item->code.'" data-codetype="'.$item->codetype.'" 
			data-mystock="'.$item->mystock.'" onclick="myStock(this)">-</a>';
		}
		
		echo '</div>';		
		
		
		echo '<div class="my_h3 stocktablec" style="width:15%;font-size:18px;">'.number_format((float)$item->highest, 2, '.', '').'</div>';
		echo '<div class="my_h3 stocktablec" style="width:15%;font-size:18px;">'.number_format((float)$item->lowest, 2, '.', '').'</div>';
		echo '<div class="my_h3 stocktablec" style="font-size:18px;">'.number_format((float)$item->close, 2, '.', '').'</div>';
		echo '<div class="my_h3 stocktablec" style="font-size:18px;color:#006600;">-'.$decrease.'%</div>';
		echo '<div class="my_h3 stocktablec" style="font-size:18px;color:#c00000;">+'.$increase.'%</div>';
		//echo '<a class="my_h3 stocktablec" style="width:5%;font-size:18px;" data-code="'.$item->code.'" data-codetype="'.$item->codetype.'" onclick="deleteCode(this)" >删除</a><br/>';//
		
		if(($item->highest-$item->lowest)!=0){
			echo '<div class="my_h3 stocktablec" style="width:10%;height:20px;margin-top:8px;">
			<span class="my_h3 stocktablec" style="width:'.(100*($item->highest-$item->close)/($item->highest-$item->lowest)).'%;height:100%;background:#006600;"></span>
			
			<span class="my_h3 stocktablec" style="width:'.(100*($item->close-$item->lowest)/($item->highest-$item->lowest)).'%;height:100%;background:#c00000;"></span>
			</div>';
		}
		echo '<a class="my_h3 my_a" style="position:relative;float:left;" href="http://yanbao.stock.hexun.com/yb_'.$code.'.shtml" target="_blank">
		研报</a>';
		
		if($item->codetype=='ss'){
			echo '<a class="my_h3 my_a" style="position:relative;float:left;" data-src="http://image.sinajs.cn/newchart/daily/n/sh'.$code.'.gif" data-code="kline'.$code.$item->codetype.'" 
			data-code2="kline2'.$code.$item->codetype.'" data-c="'.$code.'" data-t="'.$item->codetype.'" onclick="kline(this)">
			K线</a>';
		}else{
			echo '<a class="my_h3 my_a" style="position:relative;float:left;" data-src="http://image.sinajs.cn/newchart/daily/n/sz'.$code.'.gif" data-code="kline'.$code.$item->codetype.'" 
			data-code2="kline2'.$code.$item->codetype.'" data-c="'.$code.'" data-t="'.$item->codetype.'" onclick="kline(this)">
			K线</a>';
		}
		echo '<a class="my_h3 my_a" style="position:relative;float:left;" data-c="'.$code.'" data-t="'.$item->codetype.'" data-code="analysis'.$code.$item->codetype.'" onclick="analysis(this)">
			分析</a>';
		
		echo '<div id="kline'.$code.$item->codetype.'" style="width:100%;"></div>';
		echo '<div id="kline2'.$code.$item->codetype.'" style="width:100%;"></div>';
		echo '<div id="analysis'.$code.$item->codetype.'" style="width:98%;margin-top:50px;margin-bottom:50px;"></div>';
		echo '</div>';
	}
	
}
?>
<div style="position:relative;float:left;margin-bottom:10px;margin-top:10px;">
<?php echo $this->pagination->create_links();?>
</div>
</div>

<script>
	function deleteCode(id)
	{
		var form_data = {
		ajax:'1',
		code:id.getAttribute('data-code'),
		codetype:id.getAttribute('data-codetype')
		
		};
		$.ajax({
		url:'<?php echo base_url() ?>/index.php/stock/delete',
		type:'POST',
		data:form_data,
		success:function(msg){
			//alert(msg);
			location.reload();
			if(msg=='成功')
			{

			}
			else
			{
				/*
				alert('操作失败，请稍后再试');
				id.value = 0;
				*/
			}
			
		}
		});
		return false;
	}
	
	function kline(id)
	{
		var codet = id.getAttribute('data-code');
		var codet2 = id.getAttribute('data-code2');
		var codesrc = id.getAttribute('data-src');
		var result = document.getElementById(codet);
		result.innerHTML = "<a data-code="+codet+" onclick=\"ckline(this)\"><img src="+codesrc+" ></img></a>";
		
		/*
		var code = id.getAttribute('data-c');
		var codetype = id.getAttribute('data-t');
		
		
		var jsonurl = "<?php echo base_url() ?>index.php/stock/stock_kline/"+code+'/'+codetype;
		
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET",jsonurl,false);
		xmlhttp.send();
		var t1 = xmlhttp.responseText.split(';');
		var t = [[]];
		var size = t.length;
		for(var index=0;index<size;index++){
			var t2 = (t1[index]).split(',');
			for(var i=0;i<4;i++){
				t[index][i] = t2[i];
				result.innerHTML += t[index][i];
			}
		}
		
		t[0][0] = '07/06/2009';
		t[0][1] = 140.67;
		t[0][2] = 143.56;
		t[0][3] = 132.88;
		t[0][4] = 142.44;
		
		var t = [['07/06/2009', 138.7, 139.68, 135.18, 135.4],
					['06/29/2009', 143.46, 144.66, 139.79, 140.02],
['06/22/2009', 140.67, 143.56, 132.88, 142.44],
['06/15/2009', 136.01, 139.5, 134.53, 139.48]]
		
		var plot3 = $.jqplot(codet2,[t],{
			seriesDefaults:{yaxis:'y2axis'},
			axes: {
				xaxis: {
					renderer:$.jqplot.DateAxisRenderer,
					
					tickOptions:{formatString:'%b %e'}, 
					min: "09-01-2008",
					max: "06-22-2010",
					tickInterval: "6 weeks",
				},
				y2axis: {
					tickOptions:{formatString:'$%d'}
				}
			},
			// To make a candle stick chart, set the "candleStick" option to true.
			series: [
			{
				renderer:$.jqplot.OHLCRenderer, 
				rendererOptions:{ candleStick:true }
			}
			],
			highlighter: {
				show: true,
				showMarker:false,
				tooltipAxes: 'xy',
				yvalues: 4,
				formatString:'<table class="jqplot-highlighter"> \
				<tr><td>date:</td><td>%s</td></tr> \
				<tr><td>open:</td><td>%s</td></tr> \
				<tr><td>hi:</td><td>%s</td></tr> \
				<tr><td>low:</td><td>%s</td></tr> \
				<tr><td>close:</td><td>%s</td></tr></table>'
			}
		});*/
		
		return false;
	}
	function analysis(id)
	{
		var codet = id.getAttribute('data-code');
		var code = id.getAttribute('data-c');
		var codetype = id.getAttribute('data-t');
		
		var ajaxDataRenderer = function(url, plot, options) {
			var ret = null;
			$.ajax({
				async: false,
				url: url,
				dataType:"json",
				success: function(data) {
					ret = data;
				}
			});
			return ret;
		};
		//var jsonurl = "stock/stock_analysis/"+code+'/'+codetype;
		var jsonurl = "<?php echo base_url() ?>index.php/stock/stock_analysis/"+code+'/'+codetype;
		var plot2 = $.jqplot(codet, jsonurl,{
			title: "历史涨跌幅曲线",
			dataRenderer: ajaxDataRenderer,
			dataRendererOptions: {
				unusedOptionalUrl: jsonurl
			},
			series:[ {
				pointLabels: { show:true },
				//lineWidth:2, 
				markerOptions: { style:'dimaond' }
				}, 
				{
				//showLine:false,
				pointLabels: { show:true },
				markerOptions: { style:"circle" }
				//markerOptions: { size: 7, style:"x" }
				}, 
				{
				//showLine:false,
				pointLabels: { show:true },
				markerOptions: { style:"filledSquare", size:10 }
				//markerOptions: { size: 7, style:"x" }
				}
			],
			
			/*
			seriesDefaults: { 
				showMarker:false,
				pointLabels: { show:true } 
			},*/
			axes: {
              xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
				tickOptions: {
					formatString: '%d/%m'
				}
              },
              yaxis: {
                tickOptions:{
                  formatString: "%#.2f",
				  min:0,
				  max:600
                }
              }
			}
		
		});		
		return false;
	}
	
	function ckline(id)
	{
		var codet = id.getAttribute('data-code');
		//var codesrc = id.getAttribute('data-src');
		var result = document.getElementById(codet);
		result.innerHTML = "";
		return false;
	}
	
	function searchstock(id)
	{
		var search_stock = document.getElementById('search_stock').value;
		var url = '<?php echo base_url() ?>index.php/stock/searchstock/'+((search_stock=='')?'s_null':'s_'+search_stock);
		window.location.href = url;
	}
	
	function myStock(id)
	{
		var form_data = {
		ajax:'1',
		code:id.getAttribute('data-code'),
		codetype:id.getAttribute('data-codetype'),
		mystock:id.getAttribute('data-mystock')
		};
		$.ajax({
		url:'<?php echo base_url() ?>/index.php/stock/mystock',
		type:'POST',
		data:form_data,
		success:function(msg){
			//alert(msg);
			location.reload();
			if(msg=='成功')
			{

			}
			else
			{
				/*
				alert('操作失败，请稍后再试');
				id.value = 0;
				*/
			}
			
		}
		});
		return false;
	}
	
	
	
</script>