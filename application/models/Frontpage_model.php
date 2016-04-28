<?php

Class Frontpage_model extends CI_Model{

// 随机获取图书，num指数量
function get_randombooks($num)
{
	$bookID = rand()%(2001-$num);
	$this->db->where('bookID>',$bookID);
	$this->db->limit($num);
	return $this->db->get('books');
}

// 获取商品列表，按商品类别查询，num可控制获取数量
function get_itemsbytype($typename,$num)
{
	$this->db->like('type',$typename);
	$this->db->limit($num);
	$this->db->join('items','items.item_id = news_list.news_item_id');
	return $this->db->get('news_list');
}

// 获取商品列表，按商品名称查询，num可控制获取数量
function get_itemsbyname($name,$num)
{
	$this->db->like('name',$typename);
	$this->db->limit($num);
	$this->db->join('items','items.item_id = news_list.news_item_id');
	return $this->db->get('news_list');
}


}

?>