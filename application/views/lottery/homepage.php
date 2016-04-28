<?php $this->load->view('lottery/home');?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jqplot.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jqplot.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.canvasTextRenderer.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.canvasAxisLabelRenderer.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.json2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.pointLabels.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jqplot.categoryAxisRenderer.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/jquery.jqplot.min.css" />

<div style="width:100%">
<?php
//Left;
echo '<div class="my_div1" style="position:relative;float:left;width:30%;margin-top:10px;height:auto;">';
echo '<span class="my_h2" style="color:#006600;">双色球开奖</span>';
foreach($kj->result() as $item){
	echo '<div style="position:relative;float:left;width:95%;margin-left:5%;margin-bottom:10px;">';
	echo '<em class="my_h3">'.'第 '.$item->kj_id.' 期  '.date('m-d', $item->time).'<br/>'.'</em>';
	echo '<em class="smallRedball">'.$item->red1.'</em>';
	echo '<em class="smallRedball">'.$item->red2.'</em>';
	echo '<em class="smallRedball">'.$item->red3.'</em>';
	echo '<em class="smallRedball">'.$item->red4.'</em>';
	echo '<em class="smallRedball">'.$item->red5.'</em>';
	echo '<em class="smallRedball">'.$item->red6.'</em>';
	echo '<em class="smallBlueball">'.$item->blue.'</em>';
	echo '</div>';
}
echo '<span class="my_h2" style="color:#006600;margin-top:10px;">双色球计算器</span>';
echo '<div class="my_h3">33红球选择n个球(33选6组合数1107568)</div><input type="number" min="0" max="33" name="q" class="my_input" id="i_1" placeholder="33选n" maxlength="50" data-autocomplete-disabled="false"
style="width:28%;" onchange="c1(this)"></input><span id="c_1" class="my_h3"></span>';


echo '</div>';
?>


<input type="number" min="1" max="100" class="my_input" id="i_2" placeholder="红球和统计" maxlength="50" data-autocomplete-disabled="false"
style="width:18%;position:relative;float:right;" onchange="sum()"></input>
<div style="position:relative;float:left;width:70%">
<div id="chart1" style="height:auto; width:100%;"></div>
<div id="chart2" style="height:auto; width:100%;"></div>
<div id="chart3" style="height:auto; width:100%;"></div>
</div>

</div>

</div>
<script>
$(document).ready(function(){
	<?php  echo "var plot1 = $.jqplot ('chart2', ".$sum.");";?>
	<?php  echo "var plot1 = $.jqplot ('chart3', ".$sum2.",
	{
      title: '五期和平均', 
      seriesDefaults: {
        showMarker:false,
        pointLabels: {
          show: true,
          edgeTolerance: 5
        }},
      axes:{
        xaxis:{min:0,max:100}
      }
	}
	
	);";?>
  sum();
});
var plot2;
function sum()
{
	if (plot2) {
        plot2.destroy();
    }
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
	var v = document.getElementById('i_2').value;
	var jsonurl = "lottery/kj_analysis/";
	if(v<1||v>100){
		jsonurl += '10';
		v=10;
	}else{
		jsonurl += v;
	}
	plot2 = $.jqplot('chart1', jsonurl,{
		title: "红球和统计最新"+v+"期",
		dataRenderer: ajaxDataRenderer,
		dataRendererOptions: {
			unusedOptionalUrl: jsonurl
		},
		seriesDefaults: { 
        showMarker:false,
        pointLabels: { show:true } 
		}
		
	});
}

function c1(id)
{
	var v = document.getElementById('i_1').value;
	var r = 1;
	var r2 = 1;
	for(var index=0;index<v;index++){
		r*=(33-index);
		r2*=(index+1);
	}
	var result = document.getElementById('c_1');
	result.innerHTML = '组合数:'+parseInt(r/r2);
}
</script>