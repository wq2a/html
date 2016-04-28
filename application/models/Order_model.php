<?php

class Order_model extends CI_Model{

	function exists($order_id)
	{
		$this->db->where('order_id',$order_id);
		$query = $this->db->get('purchase_order');
		return ($query->num_rows()==1);
	}
	
	function add_order_items($order_data)
	{
		$this->db->where('name',$order_data['name']);
		$this->db->where('cost',$order_data['cost']);
		$item_query = $this->db->get('items');
		$inventory_data = array(
			'trans_inventory'=>$order_data['quantity'],
			'trans_date'=>$order_data['createtime']
		);
		$quantity_temp = $order_data['quantity'];
		if($item_query->num_rows()>0)
		{
			foreach($item_query->result() as $item)
			{
				$order_data['item_id'] = $item->item_id;
				$order_data['quantity'] = $order_data['quantity']+($item->quantity);
			}
		}
		else
		{
			$item_data = array(
				'name'=>$order_data['name'],
				'image'=>$order_data['image'],
				'cost'=>$order_data['cost'],
				'quantity'=>$order_data['quantity'],
				'unit'=>$order_data['unit'],
				'supplier'=>$order_data['supplier']
			);
			$this->db->insert('items',$item_data);
			$order_data['item_id'] = $this->db->insert_id();
			
		}
		//$this->db->insert('purchase_order_items', $order_data);
		$inventory_data['item_id'] = $order_data['item_id'];
		$this->db->insert('inventory', $inventory_data);
		$order_data['quantity'] = $quantity_temp;
		$this->db->insert('purchase_order_items', $order_data);
	}
	
	function add_order($order_data)
	{
		$p_order_data = array(
			'order_id'=>$order_data['order_id'],
			'supplier'=>$order_data['supplier'],
			'createtime'=>$order_data['createtime']
		);
		$this->db->insert('purchase_order', $p_order_data);
		$this->db->where('name',$order_data['supplier']);
		$supplier = $this->db->get('supplier');
		if($supplier->num_rows()<1)
		{
			$supplier_data = array(
				'name'=>$order_data['supplier']
			);
			$this->db->insert('supplier', $supplier_data);
		}
	}
}