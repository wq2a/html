<?php 
Class Api extends CI_Controller{
	
	function index()
	{
		$this->db->limit(2);
		$items = $this->db->get('items',5,100);
		echo json_encode($items->result(), JSON_UNESCAPED_UNICODE);
	}
	
	function allitems($number,$page)
	{
		$items = $this->db->get('items',5,100);
		echo json_encode($items->result(), JSON_UNESCAPED_UNICODE);
	}
}
?>