<?php $this->load->view('purchased/home');?>

<?php
		foreach($records->result() as $item)
		{
			$this->db->select('*');
			$this->db->from('purchase_order_items');
			$this->db->where('purchase_order_items.order_id',$item->order_id);
			$this->db->join('purchase_order', 'purchase_order.order_id = purchase_order_items.order_id');
			$this->db->limit(5);
			$query = $this->db->get();
			echo '<br><a href="'.base_url().'/index.php/purchased/orderdetail/'.$item->order_id.'">'.$item->order_id.' '.$item->supplier.' '.$item->createtime;
			echo anchor('purchased/returnorderdetail/'.$item->order_id,'破损少货报告');
			echo '</a></br>';
			
			foreach($query->result() as $subitem)
			{
				echo '<br><img src="'.$subitem->image.'"  width="80" height="80">'.$subitem->name.'</br>'; 
			}
		}
		echo $this->pagination->create_links();

?>
