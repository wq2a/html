<?php 	$this->load->view('purchased/home');
		$indextemp=0;
		foreach($records->result() as $item)
		{
			if($indextemp%3==0){
				echo '<div class="row">';
			}
			$indextemp++;

			echo '<div class="col-sm-6 col-md-4"><div class="thumbnail">
			<img src="'.$item->image.'" class="img-thumbnail" style="border: 0 none;box-shadow: none;">
			<div class="caption" style="font-size:12px;"><p style="margin:0px;">'.$item->name.'</p><p style="margin:0px;"><a href="'.base_url().'index.php/purchased/searchitems2/'.$item->supplier.'/null">'
			.$item->supplier.'</p><p class="glyphicon glyphicon-yen" style="margin:0px;">'.(($item->cost)/100).'</a>
			</p><br/><button class="btn btn-default" style="font-size:12px;" 
			data-id="'.$item->item_id.'" data-link="'.$item->image.'" data-name="'.$item->name.'" data-supplier="'.$item->supplier.'" 
			data-cost="'.$item->cost.'" onclick="addCart(this)">加入购物车</botton></div></div></div>';
			
			if($indextemp%3==0){
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
		url:'<?php echo base_url() ?>index.php/purchased/addcart',
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
				id.textContent = "已添加";
				
			}
			
		}
		});
		return false;
}
</script>
