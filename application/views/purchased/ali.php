<?php $this->load->view('purchased/home');
echo '<div class="my_div1" style="margin-top:20px;">';
echo '<button type="button" class="my_button" onclick="jump('."'".$aliauthurl."'".')">阿里巴巴登陆</button>';
echo '</div>';
echo '<div class="my_div1" style="margin-top:20px;margin-bottom:20px;">';
echo '<span class="my_h2">最新订单导入: </span>';
for($index=1;$index<10;$index++){
	echo '<button type="button" style="margin-right:10px;" class="my_button" 
	onclick="jump('."'".base_url().'index.php/purchased/addorder/'.($index)."')".'">'.(4*($index-1)+1).'-'.(4*($index-1)+4).'</button>';
}
echo '</div>';
echo '<br/>';
echo '<div class="my_h3">'.(isset($result)?$result:'').'</div>';

?>

<!--
<php $this->load->view('purchased/home');?>

<php
echo form_open_multipart('purchased/do_excel_import/',array('id'=>'item_form'));
?>
<b><a href="<php echo base_url(). '/public/'.'Import-PHPPOS.xls'; ?>">下载批量上传Excel模板</a></b>
<php echo form_label('File path:', 'name',array('class'=>'wide')); ?>
	<div class='form_field'>
	<php echo form_upload(array(
		'name'=>'file_path',
		'id'=>'file_path',
		'value'=>'')
	);?>
	</div>
<button type="button" class="my_button" id="submitf" name="submitf" value="上传"></button>

<php 
echo form_close();
?>
-->