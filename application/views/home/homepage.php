<?php $this->load->view('home/home');?>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/image_fade.js"></script>


<!--左侧内容页-->
<div class="my_div1" style="position:relative;float:left;width:25%;height:auto;">

<!--英文书-->
<div class="my_div" style="height:auto;width:100%;margin-top:20px;margin-bottom:50px;position:relative;float:left;display:block;border:1px solid #d5d5d5;">
<?php

foreach($book->result() as $item)
{
	echo '<div class="my_div1" style="margin-bottom:20px;margin-top:5px;">';
	echo '<span class="my_h3" style="text-align:center;display:block;margin:10px;padding-left:10px;padding-right:10px;">'.$item->bookTitle.'</span>';

	echo '<img class="my_img_m" src="'.$item->coverUrl.'" style="width:50%;border:none;height:auto;margin-left:auto;margin-right:auto;display: block;"></img>';
	echo '<span class="my_h3" style="text-align:center;display:block;margin:10px;padding-left:10px;padding-right:10px;">'.(($item->author=='')?'':('by '.$item->author));

	echo '<span class="my_h3" style="text-align:center;display:block;margin:10px;padding-left:10px;padding-right:10px;">'.(($item->isbn=='')?'':('isbn:'.$item->isbn)).'</span></span>';

	echo '<span class="my_h3" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;text-align:center;display:block;margin:10px;padding-left:10px;padding-right:10px;">'.(($item->summary=='')?'':$item->summary).'</span></div>';

}

?>

</div>


</div>

<!--中部及右侧内容页-->
<div class="my_div1" style="width:75%;height:auto;float:right;">
<div class="my_div_m" style="height:1380px;">
<span class="my_h2" style="height:20px;"></span>
<?php
foreach($best->result() as $item)
{
	echo '<div style="position:relative;float:left;width:100%;margin-bottom:28px;">
	<div style="position:relative;float:left;width:25%;">
	<img class="my_img_s" src="'.$item->image.'" ></img></div>
	<div style="position:relative;float:left;width:75%;">
	<span class="my_h3">'.$item->name.'
	</span></div>
	
	</div>';
}

?>

</div>


<div class="my_div_r" style="height:1050px;">


<ul class="slideshow" style="border:1px solid #d5d5d5;margin-top:25px;"><!--border-top-right-radius: 2em;-->
<?php
$index=0;
foreach($best->result() as $item)
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

<div style="width:100%;height:320px;margin-top:25px;">
<span class="my_h2" style="color:#006600;">新品上市</span>

<?php
foreach($newitems->result() as $item)
{
	echo '<div style="position:relative;float:left;width:100%;margin-bottom:28px;">
	<div style="position:relative;float:left;width:25%;">
	<img class="my_img_s" src="'.$item->image.'" ></img>
	</div>
	<div style="position:relative;float:left;width:75%;">
	<span class="my_h3">'.$item->name.'
	</span>
	<span class="my_h3" style="position:absolute;border:1px solid #d5d5d5;bottom:0px;right:0px;color:#006600;padding-left:5px;padding-right:5px;">新品</span></div>
	</div>';
}

?>


</div>

</div>

<img class="my_div_bar" style="height:auto;border:none;" src="http://i60.tinypic.com/2qtwbx0.jpg"></img><!--http://thecutestblogontheblock.com/wp-content/uploads/2011/11/amber-road-BANNER-free-blog-fall-autumn-design-shabby-copy.png">-->


<div class="my_div1">
<div class="my_div_bar" style="border:none;height:auto;margin:0px;">
<span class="my_h2" >热卖商品</span>
</div>
<?php
foreach($hot->result() as $item)
{
	echo '<div class="my_div1" style="margin-bottom:15px;margin-top:15px;width:30%;margin-left:2%;height:260px;float:right;border:1px solid #d5d5d5;">
	<img class="my_img_m" src="'.$item->image.'" style="border:none;margin-left:auto;margin-right:auto;width:90%;height:80%;margin-top:5%;display: block;"></img>';
	
	echo '<span class="my_h3" style="color:#ffffff;background:#555555;opacity:0.5;position:absolute;bottom:0px;text-align:center;display:block;padding-left:10px;padding-right:10px;">'.$item->name.'
	</span></div>';
	//<span style="border:1px solid #d5d5d5;color:#c00000;padding-left:5px;padding-right:5px;">热卖</span>
}

?>
</div>





</div>





</div>
