<?php $this->load->view('system/home');?>
<div class="row featurette">
	<div class="col-md-3">
		<h2 class="featurette-heading">Alipay</h2>
		<?php if(isset($error)) {echo $error;}?>
		<?php echo form_open_multipart('system/do_upload');?>
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
	</div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-6">
    	<img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>public/analysis/alipay.png"></img>
    	<img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>public/analysis/alipay_customer_avg.png"></img>
    	<img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>public/analysis/alipay_datetime.png"></img>
    </div>
    <div class="col-md-6">
    	<img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>public/analysis/alipay_month_avg.png"></img>
    	<img class="featurette-image img-responsive center-block" src="<?php echo base_url(); ?>public/analysis/alipay_buyer.png"></img>
    </div>
</div>

<script>
document.getElementById('upfile').onchange = function () {
    var label = this.value.replace(/\\/g, '/').replace(/.*\//, '');
    document.getElementById('fn').innerHTML = label;
};
</script>
</form>