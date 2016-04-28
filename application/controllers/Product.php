<?php
	require_once ("Secure_area.php");
	Class Product extends Secure_area{
	
	function __Construct()
	{
		parent::__construct();
		$data['navigation'] = get_class();
		$data['key_words'] = $this->db->get('search_words');
		$this->load->vars($data);
	}
	
	function index()
	{
		$this->items();
	}
	
	// 订购商品
	function items()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/index.php/product/items';
		$config['total_rows'] = $this->db->get('items')->num_rows();
		$config['per_page'] = 60;
		$config['num_links'] = 8;

		$config['full_tag_open'] = '<ul class="pagination" id="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$this->db->order_by("item_id", "desc");
		
		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(3));
		$data['pageTag'] = 'myorderitem';
		$data['main_containt'] = 'product/items';
		$this->load->view('includes/template',$data);
	}
	
	// 搜索并订购商品
	function searchitems($item_name)
	{
		$this->load->library('pagination');
		
		$name = urldecode($item_name);

		$config['base_url'] = base_url().'/index.php/product/searchitems/'.$name;
		$this->db->like('name',$name);
		$config['total_rows'] = $this->db->get('items')->num_rows();
		
		$config['per_page'] = 60;
		$config['num_links'] = 8;

		$config['full_tag_open'] = '<ul class="pagination" id="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$this->db->order_by("item_id", "desc");
		$this->db->like('name',$name);
		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(4));
		
		$data['main_containt'] = 'product/items';
		$this->load->view('includes/template',$data);
	}
	
	// 搜索并订购商品
	function searchitems2($item_supplier,$item_name)
	{
		$this->load->library('pagination');

		$item_name = urldecode($item_name);
		$item_supplier = urldecode($item_supplier);

		$config['base_url'] = base_url().'/index.php/product/searchitems2/'.$item_supplier.'/'.$item_name;
		if($item_supplier!=''&&$item_supplier!='null'){
			$this->db->like('supplier',$item_supplier);
		}
		if($item_name!=''&&$item_name!='null'){
			$this->db->like('name',$item_name);
		}
		$config['total_rows'] = $this->db->get('items')->num_rows();
		
		$config['per_page'] = 60;
		$config['num_links'] = 8;

		$config['full_tag_open'] = '<ul class="pagination" id="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		if($item_supplier!=''&&$item_supplier!='null'){
			$this->db->like('supplier',$item_supplier);
		}
		if($item_name!=''&&$item_name!='null'){
			$this->db->like('name',$item_name);
		}
		//$this->db->order_by("item_id", "desc");
		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(5));
		
		$data['main_containt'] = 'product/items';
		$this->load->view('includes/template',$data);
	}

	function addcart()
	{
		if($this->input->post('ajax')=='1')
		{
			$data = array(
               'id'      => $this->input->post('productID'),
               'price'   => $this->input->post('cost'),
               'name'    => $this->input->post('productID'),
               'qty'	=> 1,
               'options' => array('supplier' => $this->input->post('supplier'), 'link' => $this->input->post('link'),'item'=>$this->input->post('name'))
            );
			$this->cart->insert($data);
			echo $this->cart->total_items();
		}
	}
}

?>
