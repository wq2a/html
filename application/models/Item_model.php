<?php
/*
* 商品表单
*/
Class Item_model extends CI_Model{

function exists($item_id)
{
	$this->db->from('items');
	$this->db->where('item_id',$item_id);
	$query = $this->db->get();
	return ($query->num_rows()==1);
}

function get_all($order_by)
{
	$this->db->from('items');
	$this->db->order_by("name", "asc");
	return $this->db->get();
}


}