<?php 	$this->load->view('purchased/home');
		echo '<table class="table table-striped" ><tbody>';
		foreach($records->result() as $item)
		{
			$this->db->select('*');
			$this->db->from('purchase_order_items');
			$this->db->where('purchase_order_items.order_id',$item->order_id);
			$this->db->join('purchase_order', 'purchase_order.order_id = purchase_order_items.order_id');
			$this->db->limit(3);
			$query = $this->db->get();
			
			echo '<tr>';
			echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom:8px;">';
			if($item->is_return==0)
			{
				echo '<span class="label label-default">未核对</span>';
			}
			else if($item->is_return==1)
			{
				echo '<span class="label label-danger">有退货</span>';
			}else{
				echo '<span class="label label-success">已完成</span>';
			}
			
			echo '<span id="ordertitle" style="margin-left:5px;">订单号:'.$item->order_id.'<a style="margin-left:5px;margin-right:5px;" href="'.$item->link.'">'.$item->supplier.'</a>'
			.substr($item->createtime,0,4).'年'.substr($item->createtime,4,2).'月'.substr($item->createtime,6,2).'日'.//.$item->createtime.
			'</span><a id="ordertitle" href="'.base_url().'index.php/purchased/returnorderdetail/'.$item->order_id.'" style="color:#c00000;margin-left:5px;"> 明细 <span class="glyphicon glyphicon-chevron-right"></span></a>';
			echo '</div></div>';

			echo '<div class="row">';
			foreach($query->result() as $subitem)
			{
				echo '<div class="col-xs-12 col-sm-4 col-md-4">
     						<a href="'.$subitem->i_link.'">
								<img src="'.$subitem->image.'" width="80" height="80" style="position:relative;float:left;border:1px solid #999999;margin-right:5px;">
							</a>
							<div id="ordertitlelist" style="font-size:13px;">'
								.$subitem->name.'<br/><span style="color:#c00000;">￥'.(($subitem->cost)/100).'/￥'.(2.4*($subitem->cost)/100).'</span>  数量：'.$subitem->quantity.
							'</div></div>';
			}
			echo '</tr>';
			echo '<hr style="margin-bottom:8px;">';
		}
		echo '</tbody></table>';
		echo $this->pagination->create_links();
?>
</div>
</div>
</div>
