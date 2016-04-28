<?php 	$this->load->view('purchased/home');
		$indextemp=0;
		
		foreach($query->result() as $item)
		{
			if($indextemp==0)
			{
				//echo '<button type="button" class="btn btn-success" onclick="jump('."'".base_url().'index.php/purchased/orderconfirm/'.$item->order_id."'".')" >确认收货（不缺货）</button>'.
				echo '<div><h3>'.$item->supplier.'</h3><p>订单号:'.$item->order_id.' 日期:'
				.substr($item->createtime,0,4).'年'.substr($item->createtime,4,2).'月'.substr($item->createtime,6,2).'日</p></div><hr style="margin-bottom:5px;">';

				echo '<div class="row" style="margin-bottom:8px;"><button type="button" class="btn btn-success col-md-offset-10" 
				data-toggle="modal" data-target="#myModal" data-submit="try_'
	.$order_id.'" onclick="submit(this)">下一步<span class="glyphicon glyphicon-chevron-right"></span></button></div>';
			}

			if($indextemp%3 == 0){
				echo '<div class="row">';
			}

			$indextemp++;

			echo '<div class="col-sm-6 col-md-4"><div class="thumbnail ">
			<div class="carousel-inner">
			<img src="'.$item->image.'" class="img-thumbnail" style="border: 0 none;box-shadow: none;"/>
			<h1 class="carousel-caption text-info" style="color:#000000;">#'.$indextemp.'</h1>
			</div>
			<p style="margin-bottom:2px;">'
			.$item->name.
			'</p><p style="margin:0px;"><span class="glyphicon glyphicon-yen">'.(($item->cost)/100).
			'<span >/<span class="glyphicon glyphicon-yen">'.(2.4*($item->cost)/100).
			
			'</span><span class="text-default">  数量:'.$item->quantity.$item->unit.
			'</span></p>
			
			<div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">缺:</span>
			<input class="edit form-control" id="lack_'.$item->item_index.'" type="number" data-edit="lack_'.$item->item_index.'" value="'.$item->lack_quantity.'" onchange="input_change(this)" 
			style="'.($item->lack_quantity>0?'background:#c00000;color:#ffffff;':'background:#ffffff;color:#000000;').'"></input><span class="input-group-addon">'.$item->unit.'</span><span class="input-group-btn">
        	<button class="btn btn-default" id="'.$item->item_index.'" type="button" onclick="checker(this)">不缺</button>
      </span></div>
			
			<div class="input-group"><span class="input-group-addon">破:</span>
			<input class="edit form-control" type="number" data-edit="broken_'.$item->item_index.'" value="'.$item->broken_quantity.'" onchange="input_change(this)" 
			style="'.($item->broken_quantity>0?'background:#c00000;color:#ffffff;':'background:#ffffff;color:#000000;').'"></input><span class="input-group-addon">'.$item->unit.'</span></div></div></div>';
			
			if($indextemp%3 == 0){
				echo '</div>';
			}
		}
?>


</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">退 货</h4>
      </div>
      <div class="modal-body">
      	<div id="result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
        <button type="button" class="btn btn-success" onclick="jump('<?php echo base_url().'index.php/purchased/orderconfirm/'.$item->order_id;?>')" >不缺货</button>
    
      </div>
    </div>
  </div>
</div>

<script>

	function checker(id)
	{
		var name = 'lack_'+id.getAttribute('id');
		var attr = document.getElementById(name).getAttribute('disabled');
		if (attr == 'true'){
			document.getElementById(name).removeAttribute("disabled");
			id.textContent = "不缺";
			id.setAttribute("class","btn btn-default");
		}else{
			document.getElementById(name).setAttribute("disabled",true);
			document.getElementById(name).value = 0;
			id.textContent = "解锁";
			input_change(document.getElementById(name));
			id.setAttribute("class","btn btn-success");
		}
		
	}

	function submit(id)
	{
		var form_data = {
		ajax:'1',
		name:id.getAttribute('data-submit'),
		};
		$.ajax({
		url:'<?php echo base_url() ?>index.php/purchased/returnsubmit',
		type:'POST',
		data:form_data,
		success:function(msg){
			var result = document.getElementById('result');
			result.innerHTML = msg;
		}
		});
		return false;
	}

	function input_change(id)
	{
		var form_data = {
		ajax:'1',
		name:id.getAttribute('data-edit'),
		value:id.value
		};
		$.ajax({
		url:'<?php echo base_url() ?>index.php/purchased/returnedit',
		type:'POST',
		data:form_data,
		success:function(msg){
			//alert(msg);
			if(msg=='成功')
			{
				if(id.value!=0){
					id.style.background='#c00000';
					id.style.color="#ffffff";
				}else{
					id.style.background='#ffffff';
					id.style.color="#000000";
				}
			}
			else
			{
				alert('操作失败，请稍后再试');
				id.value = 0;
			}
			
		}
		});
		return false;
	}
</script>
