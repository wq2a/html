<?php 	$this->load->view('purchased/home');
		echo '<table class="table table-striped" ><tbody>';
		//date.timezone = America/New_York;
		date_default_timezone_set('Asia/Chongqing');
		foreach($records->result() as $item)
		{
			$this->db->select('*');
			$this->db->from('myorder_item');
			$this->db->where('myorder_item.order_id',$item->myorder_id);
			$this->db->join('myorder', 'myorder.myorder_id = myorder_item.order_id');
			$this->db->limit(3);
			$query = $this->db->get();
			
			echo '<tr>';
			echo '<div class="row"><span class="col-xs-9 col-sm-9 col-md-9" style="margin-bottom:8px;">';
			
			echo '<span style="margin-right:10px;"><span>'.$item->duedate.'天内  </span>采购单:'.$item->myorder_id
			.'  </span><span>'.(date('Y年m月d日',$item->createtime)).
			'</span><a id="ordertitle" href="'.base_url().'index.php/purchased/myorderdetail/'.$item->myorder_id.'" style="color:#c00000;margin-left:5px;"> 明细 <span class="glyphicon glyphicon-chevron-right"></span></a>';
			echo '</span><span class="myorderd col-xs-3 col-sm-3 col-md-3 glyphicon glyphicon-trash text-right" data-id="'.$item->myorder_id.'" data-toggle="modal" data-target=".bs-example-modal-sm"></span></div>';
			echo '<div class="row">';

			foreach($query->result() as $subitem)
			{
				echo '<div class="col-xs-12 col-sm-4 col-md-4">
     					<img src="'.$subitem->image.'" width="80" height="80" style="position:relative;float:left;border:1px solid #999999;margin-right:5px;">
						<div id="ordertitlelist" style="font-size:13px;">'
								.$subitem->name.'<br/><span style="color:#c00000;">￥'.(($subitem->cost)/100).'</span> 
							</div></div>';
			}
			echo '</tr>';
			echo '<div style="margin-top:10px;"><span class="glyphicon glyphicon-user text-info">'.$item->username.':</span><br/>'.$item->comment.'</div>';
			echo '<hr style="margin-bottom:8px;">';
		}
		echo '</tbody></table>';
		echo $this->pagination->create_links();
?>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
  	 <div class="modal-content">
  	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">删除</h4>
    </div>
    <div class="modal-body">
     	是否删除采购单?
    </div>
    <div class="modal-footer">
    	 <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
        <button id="orderidd" type="button" class="btn btn-danger" onclick="deleteMyOrder(this)">删 除</button>
    </div>
</div>
  </div>
</div>



</div>
</div>
</div>






<script>
$(document).on("click", ".myorderd", function () {
     var myid = $(this).data('id');
     document.getElementById('orderidd').setAttribute("data-id",myid);
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});

function deleteMyOrder(id)
{
		var form_data = {
			ajax:'1',
			myorder_id:id.getAttribute('data-id')
		};
		$.ajax({
		url:'<?php echo base_url() ?>index.php/purchased/deletemyorder',
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
