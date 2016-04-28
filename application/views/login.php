<?php echo form_open('login/validate_credantials') ?>
<div id="container" style="width:100%;height:100%;text-align:center;">
	<div id="login_form row">
		<input name="userName"  id="userNamecc" value="" type="text" class="inputboxBlack" placeholder="用户名" style="display:none;"></input>
		<input name="password" id="passwordcc" value="" type="password" class="inputboxBlack" placeholder="密码" style="display:none;"></input>
		<div class="input-group col-lg-2 center-block">
			<div id="submit_button">
				<input type="text" name="username" class="form-control" placeholder="用户名">
				<input type="password" name="password" class="form-control" style="margin-top:10px;" placeholder="密码">
				<button class="btn btn-default" type="submit" name="loginButton" class="loginButton" style="margin-top:10px;">登 陆</button>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>


