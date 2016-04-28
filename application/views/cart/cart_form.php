<?php $this->load->view('cart/home');

$max = sizeof($records);
echo '<div class="row">';
echo '<div class="col-md-2">';
if($max>0){
	echo '<button class="btn btn-success" data-toggle="modal" data-target="#myModal">确认订单</button>';
}else{
	echo '<button class="btn btn-default" disabled>确认订单</button>';
}
echo '</div>';

//echo '<div class="col-md-2 col-md-offset-8"><button class="btn btn-success" data-toggle="modal" data-target="#myModalPIC" >添加</button></div>';

echo '</div><hr>';

$indextemp = 0;
foreach($records as $item)
{
	if($indextemp%4==0){
		echo '<div class="row">';
	}
	$indextemp++;

	echo '<div id="cart'.$item['rowid'].'" class="col-sm-6 col-md-3"><div class="thumbnail">
		<img src="'.$item['options']['link'].'" class="img-thumbnail" style="border: 0 none;box-shadow: none;">
		<div class="caption" style="font-size:12px;"><p style="margin:0px;">'.$item['options']['item'].'</p><p style="margin:0px;">'
			.$item['options']['supplier'].'</p><p class="glyphicon glyphicon-yen" style="margin:0px;">'.($item['price']/100).'
			</p><br/><button class="btn btn-danger" style="font-size:12px;" data-rowid="'.$item['rowid'].'" onclick="deleteCart(this)">删除</botton></div></div></div>';
			
	if($indextemp%4==0){
		echo '</div>';
	}
}
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">采 购</h4>
      </div>
      <div class="modal-body">
      	<textarea class="form-control" rows="5" id="comments"></textarea>
      	<hr>
      	<div class="input-group">
      	<span class="input-group-addon">采购限时:</span>
      	<select class="form-control" id="duedate">
    		<option>7</option>
    		<option>3</option>
    		<option>5</option>
    		<option>10</option>
    		<option>20</option>
    		<option>30</option>
    		<option>60</option>
  		</select>
  		<span class="input-group-addon">天内</span>
  		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
        <button type="button" class="btn btn-success" onclick="order(this)">确 认</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal 
<div class="modal fade" id="myModalPIC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添 加</h4>
      </div>
      <div class="modal-body">
      	<textarea class="form-control" rows="5" id="comments_pic"></textarea>
      	<input type="file" accept="image/*" onchange="picChange(event)"/>
      	<canvas id="capturedPhoto" ></canvas>     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
        <button type="button" class="btn btn-success" >确 认</button>
      </div>
    </div>
  </div>
</div>
</div>
-->
<script>
function picChange(evt){ 
//bring selected photo in
//get files captured through input
var fileInput = evt.target.files;
if(fileInput.length>0){
//get the file
var windowURL = window.URL || window.webkitURL; 
var picURL = windowURL.createObjectURL(fileInput[0]);
var photoCanvas = document.getElementById("capturedPhoto");
var ctx = photoCanvas.getContext("2d");
var photo = new Image();
photo.onload = function(){
  //draw photo into canvas when ready
  ctx.drawImage(photo, 0, 0, 500, 400);
};
photo.src = picURL;
//release object url
windowURL.revokeObjectURL(picURL);
}

}



function deleteCart(id)
{
		var form_data = {
			ajax:'1',
			rowid:id.getAttribute('data-rowid')
		};
		$.ajax({
		url:'<?php echo base_url() ?>index.php/cart/deletecart',
		type:'POST',
		data:form_data,
		success:function(msg){
			//alert(msg);
			if(msg=='成功')
			{
				//location.reload();
				document.getElementById('cart'+id.getAttribute('data-rowid')).innerHTML = "";
				//id.textContent = "已删除";
			}
			else
			{
				alert('操作失败，请稍后再试');
			}
			
		}
		});
		return false;
}
function order(id)
{
		var form_data = {
			ajax:'1',
			comments:""+document.getElementById("comments").value,
			duedate:""+document.getElementById("duedate").value
		};
		$.ajax({
		url:'<?php echo base_url() ?>index.php/cart/order',
		type:'POST',
		data:form_data,
		success:function(msg){
			//alert(msg);
			if(msg=='成功')
			{
				location.reload();
			}
			else
			{
				alert('操作失败，请稍后再试');
			}
			
		}
		});
		return false;
}
</script>
