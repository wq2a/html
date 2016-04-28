<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-xs-6 col-sm-3 col-md-3 sidebar-offcanvas" id="sidebar">
          	<div class="list-group">
          		<a href="#" onclick="jump('<?php echo base_url()?>index.php/purchased/allorder')" value="搜索" class="list-group-item <?php if(isset($pageTag)&&$pageTag=='all')echo ' active';?>">所 有 订 单</a>
            	<!--<a href="<php echo base_url()?>index.php/purchased/searchbysupplier" class="list-group-item">按 供 应 商</a>-->
            	<a href="<?php echo base_url()?>index.php/purchased/allreturn" class="list-group-item <?php if(isset($pageTag)&&$pageTag=='allreturn')echo ' active';?>">所 有 退 货</a>
            	<!--<a href="<php echo base_url()?>index.php/purchased/needpurchaseitems" class="list-group-item">所 有 补 货</a>-->
            	<!--<a href="<php echo base_url()?>index.php/purchased/ali" class="list-group-item">新 增 采 购 单</a>-->
          	</div>
            <hr>
            <div class="list-group">
                <a href="#" onclick="jump('<?php echo base_url()?>index.php/purchased/purchaseitems')" value="搜索" class="list-group-item <?php if(isset($pageTag)&&$pageTag=='myorderitem')echo ' active';?>">采 货 系 统</a>
                <a href="#" onclick="jump('<?php echo base_url()?>index.php/purchased/myorder')" value="搜索" class="list-group-item <?php if(isset($pageTag)&&$pageTag=='myorder')echo ' active';?>">采 购 单</a>
            </div>
		</div>

        <div class="col-xs-12 col-sm-9">
                <div class="row visible-xs">
        		<p class="pull-right visible-xs">
                    <span class="glyphicon glyphicon-console" data-toggle="offcanvas"></span>
                </p>
                </div>
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
							echo '<a class="my_a" href="'.base_url().'index.php/purchased/searchitems/'.$keys->word.'">'.$keys->word.'</a>';
						}?>
            	</div>

				<div class="form-group">
        			<div class="row">
        			<div class="col-xs-4">
            			<input type="text" class="form-control" id="search_order_id" placeholder="订单号" >
            		</div>
            		<div class="col-xs-4">
            			<input type="text" class="form-control" id="search_order_supplier" placeholder="供应商名称" >
            		</div>
            		<button type="button" class="btn btn-primary" onclick="searchorder()" value="搜索">订单搜索</button>
            		</div>
            	</div>

<script>
function searchitem()
{
	var itemname = encodeURI(document.getElementById('itemname2').value);
	var search_order_supplier = encodeURI(document.getElementById('search_order_supplier2').value);
	
		var url = '<?php echo base_url() ?>index.php/purchased/searchitems2/'+((search_order_supplier=='')?'null':search_order_supplier)+'/'+((itemname=='')?'null':itemname);
		window.location.href = url;
	
}

function searchorder()
{
	var search_order_id = document.getElementById('search_order_id').value;
	var search_order_supplier = encodeURI(document.getElementById('search_order_supplier').value);

	var url = '<?php echo base_url() ?>index.php/purchased/searchorder/'+((search_order_id=='')?'null':search_order_id)+'/'+
	((search_order_supplier=='')?'null':search_order_supplier);
	window.location.href = url;
	
}
</script>

