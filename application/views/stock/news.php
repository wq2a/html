<?php $this->load->view('stock/home');?>
<div style="width:50%">

<?php
foreach($records->result() as $item){
	echo '<a class="my_h3 my_a" style="width:100%;color:#000000;font-size:16px;" href="'.$item->url.'" target="_blank">';
	echo $item->news;
	echo '</a><br/>';
}
?>
<div style="position:relative;float:left;margin-bottom:10px;margin-top:10px;">
<?php echo $this->pagination->create_links();?>
</div>
</div>

<script>

	
</script>