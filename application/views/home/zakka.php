<?php $this->load->view('home/home')?>
<div class="my_div1" style="width:100%;">

<?php
foreach($records->result() as $item){
	echo '<div class="my_div1" 
	style="margin-bottom:25px;margin-top:15px;width:32%;margin-left:1%;height:260px;float:right;border:1px solid #d5d5d5;">
	<img class="my_img_m" src="'.$item->url.'" style="border:none;margin-left:auto;margin-right:auto;width:90%;height:80%;margin-top:5%;display: block;"></img>';
	
	echo '<span class="my_h3" style="color:#555555;opacity:0.5;position:absolute;bottom:0px;text-align:center;display:block;padding-left:10px;padding-right:10px;">'.$item->name.'
	</span></div>';
	
}

?>
<div style="position:relative;float:left;margin-bottom:10px;margin-top:10px;">
<?php echo $this->pagination->create_links();?>
</div>
<!--
<img style="width:100%;height:auto;position:relative;float:left;" src="http://socialfinance.ca/wp-content/uploads/2013/08/london-banner.jpg">
<img>
-->

</div>
