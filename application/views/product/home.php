<div class="container">
	<div class="row">
        <div class="col-xs-12 col-sm-12">
        		<div class="form-group">
        			<div class="row">
        			<div class="col-xs-4">
            			<input type="text" class="form-control" id="search_order_supplier2" placeholder="供应商名称" >
            		</div>
            		<div class="col-xs-4">
            			<input type="text" class="form-control" id="itemname2" placeholder="商品名称" >
            		</div>
            		<button type="button" class="btn btn-primary" onclick="searchitem()" value="搜索">商品搜索</button>
            		</div>
            		<span class="my_instruction">热门搜索：</span>
					<?php 	foreach($key_words->result() as $keys){
							echo '<a class="my_a" href="'.base_url().'index.php/product/searchitems/'.$keys->word.'">'.$keys->word.'</a>';
						}?>
            	</div>


<script>
function searchitem()
{
	var itemname = encodeURI(document.getElementById('itemname2').value);
	var search_order_supplier = encodeURI(document.getElementById('search_order_supplier2').value);
	
		var url = '<?php echo base_url() ?>index.php/product/searchitems2/'+((search_order_supplier=='')?'null':search_order_supplier)+'/'+((itemname=='')?'null':itemname);
		window.location.href = url;
	
}
</script>

