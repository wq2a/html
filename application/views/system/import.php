<?php $this->load->view('system/home');?>

<hr class="featurette-divider">

<div class="row featurette">
	<div class="col-md-3">
		<h2 class="featurette-heading">Ali 订单</h2>
		<?php if(isset($error)) {echo $error;}?>
		<?php echo form_open_multipart('system/do_upload_order');?>
		<div class="input-group">
			<span class="input-group-addon" id="fn"></span>
			<span class="btn btn-default btn-file form-control">
			<input type="file" name="userfile" id="upfile">
			<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></input>
			</span>
			<span class="input-group-btn">
			<input type="submit" class="btn btn-default btn-file" value="上传" />
			</span>
		</div>
		<hr class="featurette-divider">

		<?php if(isset($filename)) {
			echo '<h2 class="featurette-heading">订单: '.$filename.' 已提交</h2>';
			echo '<a class="btn btn-primary" onclick="jump(\''.base_url().'index.php/system/socket/'.$filename.'\')">激活</a>';
		}?>
	</div>
</div>

<!--
<div class="row featurette">
	<php if(isset($out)) {echo $out;}?>
    <textarea class="form-control" rows="24" style="resize:none"></textarea>
    <hr class="featurette-divider">
    <span class="btn btn-primary">Send</span>
    <a class="btn btn-primary" onclick="jump('<php echo base_url()?>index.php/system/socket')">Test</a>
</div>
-->

<script>
document.getElementById('upfile').onchange = function () {
    var label = this.value.replace(/\\/g, '/').replace(/.*\//, '');
    document.getElementById('fn').innerHTML = label;
};
</script>