<?php 	$this->load->view('purchased/home');
		foreach($records->result() as $item)
		{
			$this->db->select('*');
			$this->db->from('purchase_order_items');
			$this->db->where('purchase_order_items.order_id',$item->order_id);
			$this->db->where('lack_quantity>',0);
			$this->db->or_where('broken_quantity>',0);
			$this->db->where('purchase_order_items.order_id',$item->order_id);
			$this->db->join('purchase_order', 'purchase_order.order_id = purchase_order_items.order_id');
			$query = $this->db->get();
			
			echo '<div style="margin-top:15px;width:100%;border-bottom:2px solid #555555;"><span id="ordertitle">订单号：'.$item->order_id.'  '.$item->supplier.'  '
			.substr($item->createtime,0,4).'年'.substr($item->createtime,4,2).'月'.substr($item->createtime,6,2).'日'.//.$item->createtime.
			'</span><a id="ordertitle" href="'.base_url().'index.php/purchased/returnorderdetail/'.$item->order_id.'" style="color:#c00000;"> 退货 >></a></div>';
			
			$sum = 0;
			$comment = '<div style="padding:20px;">';
			foreach($query->result() as $item)
			{

				if($item->lack_quantity!=0||$item->broken_quantity!=0)
				{
						$comment = $comment.'<div class="row">';
						$comment = $comment.'<img class="col-md-2" src="'.$item->image.'" >';
						$comment = $comment.'<span class="col-md-3">'.$item->name.'</span>';
						//$comment = $comment.$item->name;
						if($item->lack_quantity!=0)
						{
							$comment = $comment.'<span class="col-md-6" style="color:#c00000;">缺：'.(($item->cost)/100).'元*'.$item->lack_quantity.$item->unit.'='.((($item->cost)/100)*$item->lack_quantity).'元</span>';
						}
						
						if($item->broken_quantity!=0)
						{
							$comment = $comment.'<span class="col-md-6" style="color:#c00000;">破：('.(($item->cost)/100).'/2)元*'.$item->broken_quantity.$item->unit.'='.(((($item->cost)/100)/2)*$item->broken_quantity).'元</span>';
						}
						
						$sum = $sum + ($item->cost)*$item->lack_quantity + ($item->cost)/2*$item->broken_quantity;
						
						$comment = $comment.'</div><hr style="margin:5px;">';
				}
			}
			$comment = $comment.'<div id="ordertitle" style="font-size:20px;">退货合计：<span style="color:#c00000;">'.($sum/100).'元</span></div>';
				
			echo $comment.'</div>';		
		}
		echo $this->pagination->create_links();
?>
