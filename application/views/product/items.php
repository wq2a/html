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
			data-cost="'.$item->cost.'" onclick="addCart(this)"></h1></div></div></div>';
			
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
</script>
