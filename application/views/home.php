<script type="text/javascript" src="<?php echo base_url(); ?>public/js/image_fade.js"></script>
<div class="my_div1" style="width:100%;">
<!--
<div class="my_div1" style="100%;margin-top:30px;margin-bottom:20px;">
<?php
foreach($quote->result() as $item)
{
	
	echo '<div style="position:relative;float:left;width:100%;">
	<div style="position:relative;float:left;width:7%;">
	<img class="my_img_ss" src="'.$item->authorLogo.'" ></img></div>
	<div style="position:relative;float:left;width:90%;">
	<span class="my_h3">'.$item->quoteEng.'<span></div>
	</div>';
}
?>
</div>
-->


<!--左侧内容页-->
<div class="my_div1" style="position:relative;float:left;width:25%;height:auto;">
<span class="my_h2" >热卖</span>
<?php
foreach($d3->result() as $item)
{
	echo '<div class="my_div1" style="margin-bottom:20px;margin-top:20px;"><img class="my_img_m" src="'.$item->image.'" style="margin-left:auto;margin-right:auto;display: block;"></img>';
	
	echo '<span class="my_h3" style="text-align:center;display:block;margin:10px;padding-left:10px;padding-right:10px;">'.$item->name.'</span></div>';
}

?>
</div>

<!--中部及右侧内容页-->
<div class="my_div1" style="width:75%;height:auto;float:right;">
<div class="my_div_m" style="height:750px;">
<span class="my_h2">新品</span>
<?php
foreach($d2->result() as $item)
{
	echo '<div style="position:relative;float:left;width:100%;">
	<div style="position:relative;float:left;width:25%;">
	<img class="my_img_s" src="'.$item->image.'" ></img></div>
	<div style="position:relative;float:left;width:75%;">
	<span class="my_h3">'.$item->name.'<span></div>
	</div>';
}

?>

</div>


<div class="my_div_r" style="height:750px;">


<ul class="slideshow" style="border:1px solid #d5d5d5;margin-top:25px;"><!--border-top-right-radius: 2em;-->
<?php
$index=0;
foreach($d3->result() as $item)
{

if($index==0)
{
	echo '<li class="show"><img src="'.$item->image.'" style="width:100%;height:auto;"
	alt="'.$item->name.'"></img></li>';
}
else
{
	echo '<li ><img src="'.$item->image.'" style="width:100%;height:auto;"
	alt="'.$item->name.'"></img></li>';
}
$index++;
}
?>
</ul>

<div style="width:100%;height:320px;border:1px solid #d5d5d5;margin-top:25px;">
</div>

</div>

<div class="my_div_bar">
<span style="color:#0099ff;font: 70px/1.5 'Bizon', arial, sans-serif;padding-left:20px;letter-spacing:30px;">ZAKKA</span>
</div>

<!--Zakka-->
<div class="my_div_m" >
<span class="my_h2" >Zakka<span style="border:none;font: 12px 'Microsoft YaHei',sans-serif;"> 源自日语的“zak-ka”（杂货）或“各种物品”</span></span>
<?php
foreach($d3->result() as $item)
{
	echo '<img class="my_img_m" src="'.$item->image.'" style="margin-left:2px;margin-right:2px;"></img>';
}
?>
</div>

<div class="my_div_r1" style="height:500px;margin-top:30px;">

</div>

<div class="my_div_bar"><!--background-image: url(http://img0.etsystatic.com/site-assets/homepage-carousel/Knobbly.jpg);">-->

<span style="color:#0099ff;font: 70px/1.5 'Bizon', arial, sans-serif;padding-left:20px;letter-spacing:30px;">HANDMADE</span>
</div>

<!--Zakka-->
<div class="my_div_m" >
<span class="my_h2" >手工<span style="border:none;font: 12px 'Microsoft YaHei',sans-serif;"> </span></span>
<?php
foreach($d4->result() as $item)
{
	echo '<img class="my_img_m" src="'.$item->image.'" style="margin-left:2px;margin-right:2px;"></img>';
}
?>
</div>

<div class="my_div_r1" style="height:380px;margin-top:30px;border:none;">
<?php
foreach($d7->result() as $item)
{
	echo '<div style="position:relative;float:left;width:100%;">
	<div style="position:relative;float:left;width:25%;">
	<img class="my_img_s" src="'.$item->image.'" ></img></div>
	<div style="position:relative;float:left;width:75%;">
	<span class="my_h3">'.$item->title.'<span></div>
	</div>';
}
?>
</div>

<div class="my_div_bar" style="height:100px;">
</div>

<div class="my_div_bar" >

</div>

<!--Zakka-->
<div class="my_div_m" >
<span class="my_h2" >收纳<span style="border:none;font: 12px 'Microsoft YaHei',sans-serif;"> </span></span>
<?php
foreach($d4->result() as $item)
{
	echo '<img class="my_img_m" src="'.$item->image.'" style="margin-left:2px;margin-right:2px;"></img>';
}
?>
</div>


<div class="my_div_r1" style="height:380px;margin-top:30px;">

</div>

<div class="my_div_bar" style="height:200px;">

</div>

</div>


</div>
