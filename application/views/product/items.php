<?php 	$this->load->view('product/home');
		$indextemp=0;
		foreach($records->result() as $item)
		{
			if($indextemp%6==0){
				echo '<div class="row">';
			}
			$indextemp++;

			echo '<div class="col-sm-6 col-md-2"><div class="thumbnail">
			<div class="carousel-inner">
			<img src="'.$item->image.'" class="img-thumbnail" style="border: 0 none;box-shadow: none;">


			<h1 class="glyphicon glyphicon-star-empty carousel-caption"  data-id="'.$item->item_id.'" data-link="'.$item->image.'" data-name="'.$item->name.'" data-supplier="'.$item->supplier.'" 
			data-cost="'.$item->cost.'" onclick="addCart(this)"></h1>

			</div>
				<p class="carousel-caption">'.($item->cost*2.4/100).'</p>
				<span class="input-group">
  				<span class="input-group-addon" id="sizing-addon2">零售价</span>

				<input class="form-control" aria-describedby="sizing-addon2" type="number" step="0.01" data-edit="price_'.$item->item_id.'" value="'.$item->price.'" onchange="input_change(this)" 
				style="'.($item->price>0?'background:#ffffff;color:#c00000;':'background:#ffffff;color:#000000;').'">

				</span>

			</div></div>';
			
			if($indextemp%6==0){
				echo '</div>';
			}
		}
		echo '<hr>';
		echo $this->pagination->create_links();
?>
<script>
function addCart(id)
{
		var form_data = {
			ajax:'1',
			productID:id.getAttribute('data-id'),
			name:id.getAttribute('data-name'),
			link:id.getAttribute('data-link'),
			supplier:id.getAttribute('data-supplier'),
			cost:id.getAttribute('data-cost')
		};
		$.ajax({
		url:'<?php echo base_url() ?>index.php/product/addcart',
		type:'POST',
		data:form_data,
		success:function(msg){
			//alert(msg);
			if(msg==0)
			{
				
				document.getElementById("carttag").innerHTML = '';
				
			}
			else
			{
				document.getElementById("carttag").innerHTML = msg;
				//id.textContent = "已添加";
				//id.style.background='#ffffff';
				id.style.color="#ffff00";
				id.removeAttribute("onclick");
				//id.setAttribute("class","glyphicon glyphicon-star carousel-caption");
				
			}
			
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
