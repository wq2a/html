<?php $this->load->view('purchased/home');?>
<div>
<input type="text" id="orderid"></input>
<input type="text" id="supplier"></input>
<input type="text" id="itemname"></input>
<button type="button" onclick="search()">搜索</button>
</div>
<?php

		
		foreach($records->result() as $item)
		{
			echo '<br>'.$item->name.$item->order_id.' '.$item->supplier.' '.$item->createtime.'</br>'; 
		}

		echo $this->pagination->create_links();

?>

<script>
function search()
{
	var order_id = document.getElementById('orderid').value;
	var supplier = document.getElementById('supplier').value;
	var itemname = document.getElementById('itemname').value;
	var url = '<?php echo base_url() ?>index.php/Purchaseorder/search/'+
	((order_id=='')?'null':order_id)+'/'+((supplier=='')?'null':supplier)+'/'+((itemname=='')?'null':itemname);
	window.location.href = url;
}
</script>


