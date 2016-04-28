<?php $this->load->view('system/home');


		$indextemp=0;
		echo '<table style="width:100%;margin-top:10px;">';
		foreach($records->result() as $item)
		{
			if($indextemp%2==0){
				echo '<tr>';
			}
			echo '<td >';
			$indextemp++;
			echo '<div style="position:relative;float:left;width:100%;height:auto;margin-top:10px;">
			<img src="'.$item->image.'" width="80" height="80" style="position:relative;float:left;border:1px solid #999999;">
			<div id="ordertitlelist" style="width:42%;font-size:12px;">
			
			<textarea  class="edit" rows="3" type="text" data-edit="shortname_'.$item->item_id.'" onchange="input_change(this)">'.(($item->short_name=='')?$item->name:$item->short_name).'</textarea >
			
			
			<br/><a href="'.base_url().'index.php/sale/searchitems2/'.$item->supplier.'/null" class="my_a" style="color:#999999;margin-left:0px;padding-left:0px;">'.$item->supplier.'</a><br/><span style="color:#c00000;">￥'.(($item->cost)/100).'/￥'.(2.4*($item->cost)/100).'</span>  库存：'.$item->quantity.
			'</div><div id="ordertitlelist" style="width:33%;"><span  >零售价：</span>
			<input class="edit" type="number" step="0.01" data-edit="price_'.$item->item_id.'" value="'.$item->price.'" onchange="input_change(this)" 
			style="'.($item->price>0?'background:#ffffff;color:#c00000;':'background:#ffffff;color:#000000;').
			'font-size:18px;width:60px;"></input>元
			<div class="my_div1" style="margin-top:20px;">
			<button class="my_a" data-edit="best_'.$item->item_id.'" onclick="input_change(this)" style="background:#ffffff;margin:5px;border:1px solid #d5d5d5;padding:2px;'.(strpos($item->type,'推荐')!==false?'color:#c00000;" disabled':'color:#d5d5d5;"').'>推荐</button>
			<button class="my_a" data-edit="hot_'.$item->item_id.'" onclick="input_change(this)" style="background:#ffffff;margin:5px;border:1px solid #d5d5d5;padding:2px;'.(strpos($item->type,'热卖')!==false?'color:#c00000;" disabled':'color:#d5d5d5;"').'>热卖</button>
			<button class="my_a" data-edit="new_'.$item->item_id.'" onclick="input_change(this)" style="background:#ffffff;margin:5px;border:1px solid #d5d5d5;padding:2px;'.(strpos($item->type,'新品')!==false?'color:#006600;" disabled':'color:#d5d5d5;"').'>新品</button>
			
			</div></div></div>';
			echo '</td>';
			if($indextemp%2==0){
				echo '</tr>';
			}
		
		}
		echo '</table>';
?>
<div style="position:relative;float:left;margin-bottom:10px;margin-top:10px;">
<?php echo $this->pagination->create_links();?>
</div>


<script>

	function input_change(id)
	{
		var form_data = {
		ajax:'1',
		name:id.getAttribute('data-edit'),
		value:id.value
		};
		$.ajax({
		url:'<?php echo base_url() ?>/index.php/system/itemedit',
		type:'POST',
		data:form_data,
		success:function(msg){
			if(msg=='成功')
			{
				if(id.value>0){
					id.style.background='#ffffff';
					id.style.color="#c00000";
				}else{
					id.style.background='#ffffff';
					id.style.color="#000000";
				}
			}else if(msg=='best成功'||msg=='hot成功'){
				id.disabled=true;
				id.style.color="#c00000";
			}else if(msg=='new成功'){
				id.style.color="#006600";
			}else if(msg=='已成功'){
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