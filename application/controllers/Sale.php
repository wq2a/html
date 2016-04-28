<?php
require_once ("Secure_area.php");
Class Sale extends Secure_area{

function __Construct()
{
	parent::__construct();
	$data['navigation'] = get_class();
	$this->load->vars($data);
	$data['key_words'] = $this->db->get('search_words');
	$this->load->vars($data);
}

function index()
{
	$this->allorder();
	//$data['main_containt'] = 'sale/home';
	//$this->load->view('includes/template',$data);
}

	// 搜索并订购商品
	function searchitems($item_name)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/index.php/sale/searchitems/'.$item_name;
		$this->db->like('name',$item_name);
		$config['total_rows'] = $this->db->get('items')->num_rows();
		
		$config['per_page'] = 50;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$this->db->like('name',$item_name);
		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(4));
		
		$data['main_containt'] = 'sale/manageitemsprices';
		$this->load->view('includes/template',$data);
	}
	
	// 搜索并订购商品
	function searchitems2($item_supplier,$item_name)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/sale/searchitems2/'.$item_supplier.'/'.$item_name;
		if($item_supplier!=''&&$item_supplier!='null'){
			$this->db->like('supplier',$item_supplier);
		}
		if($item_name!=''&&$item_name!='null'){
			$this->db->like('name',$item_name);
		}
		$config['total_rows'] = $this->db->get('items')->num_rows();
		$config['per_page'] = 50;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		if($item_supplier!=''&&$item_supplier!='null'){
			$this->db->like('supplier',$item_supplier);
		}
		if($item_name!=''&&$item_name!='null'){
			$this->db->like('name',$item_name);
		}		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(5));
		
		$data['main_containt'] = 'sale/manageitemsprices';
		$this->load->view('includes/template',$data);
	}

// 订购商品
	function manageitemsprices()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/sale/manageitemsprices';
		$config['total_rows'] = $this->db->get('items')->num_rows();
		$config['per_page'] = 50;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'sale/manageitemsprices';
		$this->load->view('includes/template',$data);
	}

function priceedit()
{
	if($this->input->post('ajax')=='1')
	{
		$success=false;
		
		$pieces = explode("_", $this->input->post('name'));
			
		if($pieces[0]=='price')
		{
			$update_data = array(
				'price' => $this->input->post('value')
			);
			$this->db->where('item_id',$pieces[1]);
			
			$success = $this->db->update('items',$update_data);
		}			
		if($success)
		{
			echo '成功';
		}
			
	}
}

// 所有采购订单
function allorder()
{
	$this->load->library('pagination');
	$config['base_url'] = base_url().'/index.php/sale/allorder';
	$config['total_rows'] = $this->db->get('purchase_order')->num_rows();
	$config['per_page'] = 10;
	$config['num_links'] = 20;
	$config['full_tag_open'] = '<div id="pagination">';
	$config['full_tag_close'] = '</div>';
	$this->pagination->initialize($config);
		
	$this->db->order_by("createtime", "desc");
	$data['records'] = $this->db->get('purchase_order', $config['per_page'], $this->uri->segment(3));
	
	$data['main_containt'] = 'sale/allorder_form';
	$this->load->view('includes/template',$data);
}

// 搜索订单
	function searchorder($order_id,$order_supplier)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/sale/searchorder/'.$order_id.'/'.$order_supplier;
		if($order_id!='null'&&$order_id!='')
		{
			$this->db->like('order_id',$order_id);
		}
		
		if($order_supplier!='null'&&$order_supplier!='')
		{
			$this->db->like('supplier',$order_supplier);
		}
		
		$config['total_rows'] = $this->db->get('purchase_order')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		if($order_id!='null'&&$order_id!='')
		{
			$this->db->like('order_id',$order_id);
		}
		
		if($order_supplier!='null'&&$order_supplier!='')
		{
			$this->db->like('supplier',$order_supplier);
		}
		$this->db->order_by("createtime", "desc");
		$data['records'] = $this->db->get('purchase_order', $config['per_page'], $this->uri->segment(5));
		
		$data['main_containt'] = 'sale/allorder_form';
		$this->load->view('includes/template',$data);
	}

// 定价 订单详细页
function orderdetail($order_id)
	{
		$this->db->where('order_id',$order_id);
		$this->db->join('items', 'purchase_order_items.name = items.name and purchase_order_items.cost = items.cost');
		$data['query'] = $this->db->get('purchase_order_items');
		
		$data['order_id'] = $order_id;
		$data['main_containt'] = 'sale/orderdetail_form';
		$this->load->view('includes/template',$data);
	}
	
	
function searchbysupplier()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/sale/searchbysupplier';
		$config['total_rows'] = $this->db->get('supplier')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$data['records'] = $this->db->get('supplier', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'sale/searchbysupplier_form';
		$this->load->view('includes/template',$data);
	}
	
	function searchbysupplierlist($supplier)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/sale/searchbysupplierlist/'.$supplier;
		$this->db->where('supplier',$supplier);
		$config['total_rows'] = $this->db->get('purchase_order')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$this->db->order_by("createtime", "desc");
		$this->db->where('supplier',$supplier);
		$data['records'] = $this->db->get('purchase_order', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'sale/allorder_form';
		$this->load->view('includes/template',$data);
	}

}



?>