<?php
	require_once ("Secure_area.php");
	Class Purchased extends Secure_area{
	
	function __Construct()
	{
		parent::__construct();
		$data['navigation'] = get_class();
		$data['key_words'] = $this->db->get('search_words');
		$this->load->vars($data);
	}
	
	function index()
	{
		$this->allorder();
	}
	
	function ordersearch()
	{
		$data['main_containt'] = 'purchased/ordersearch_form';
		$this->load->view('includes/template',$data);
	}
	
	function searchbysupplier()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/purchased/searchbysupplier';
		$config['total_rows'] = $this->db->get('supplier')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$data['records'] = $this->db->get('supplier', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'purchased/searchbysupplier_form';
		$this->load->view('includes/template',$data);
	}
	
	function searchbysupplierlist($supplier)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/Purchased/searchbysupplierlist/'.$supplier;
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
		
		$data['main_containt'] = 'purchased/allorder_form';
		$this->load->view('includes/template',$data);
	}
	
	function newpurchaseorder()
	{
		$data['main_containt'] = 'purchased/newpurchaseorder';
		$this->load->view('includes/template',$data);
	}
	
	function do_excel_import()
	{
		if ($_FILES['file_path']['error']!=UPLOAD_ERR_OK)
		{
			$msg = $this->lang->line('items_excel_import_failed');
			echo json_encode( array('success'=>false,'message'=>$msg) );
			return;
		}
		else
		{
			$this->load->library('myspreadsheetexcelreader');
			$this->myspreadsheetexcelreader->store_extended_info = false;
			$success = $this->myspreadsheetexcelreader->read($_FILES['file_path']['tmp_name']);
			
			$rowCount = $this->myspreadsheetexcelreader->rowcount(0);
			if($rowCount > 2){
				for($i = 3; $i<=$rowCount; $i++){
					echo $this->myspreadsheetexcelreader->val($i, 'B');
				}
			}
		}
	}
	


	// 所有采购订单
	function allorder()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/Purchased/allorder';
		$config['total_rows'] = $this->db->get('purchase_order')->num_rows();
		$config['per_page'] = 10;
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
		
		$this->db->order_by("createtime", "desc");
		$data['records'] = $this->db->get('purchase_order', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'purchased/allorder_form';
		$data['pageTag'] = 'all';
		$this->load->view('includes/template',$data);
	}

	// 所有采购订单
	function myorder()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/Purchased/myorder';
		$this->db->where('deleted',0);
		$num = $this->db->count_all_results('myorder');
		$config['total_rows'] = $num;//$this->db->get('myorder')->num_rows();
		$config['per_page'] = 10;
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
		$this->db->where('deleted',0);
		$this->db->order_by("createtime", "desc");
		

		$data['records'] = $this->db->get('myorder', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'purchased/myorder_form';
		$data['pageTag'] = 'myorder';
		$this->load->view('includes/template',$data);
	}
	
	// 订单详情
	function orderdetail($order_id)
	{
		$this->db->where('order_id',$order_id);
		$data['query'] = $this->db->get('purchase_order_items');
		$data['order_id'] = $order_id;
		$data['main_containt'] = 'purchased/orderdetail_form';
		$this->load->view('includes/template',$data);
	}
	
	// 破损退货管理
	function returnorder()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/Purchased/returnorder';
		$config['total_rows'] = $this->db->get('purchase_order')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$this->db->order_by("createtime", "desc");
		$data['records'] = $this->db->get('purchase_order', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'purchased/returnorder_form';
		$this->load->view('includes/template',$data);
	}
	
	// 破损退货订单详细页
	function returnorderdetail($order_id)
	{
		$this->db->where('order_id',$order_id);
		//$this->db->join('items', 'purchase_order_items.name = items.name and purchase_order_items.cost = items.cost');
		$data['query'] = $this->db->get('purchase_order_items');
		
		$data['order_id'] = $order_id;
		$data['main_containt'] = 'purchased/returnorderdetail_form';
		$this->load->view('includes/template',$data);
	}

	// 采购单详细页
	function myorderdetail($order_id)
	{
		$this->db->where('order_id',$order_id);
		$data['query'] = $this->db->get('myorder_item');
		$data['order_id'] = $order_id;
		$data['pageTag'] = 'myorder';
		$data['main_containt'] = 'purchased/myorderdetail_form';
		$this->load->view('includes/template',$data);
	}
	
	// 所有退货订单列表
	function allreturn()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/purchased/allreturn';
		$this->db->where('is_return',1);
		$config['total_rows'] = $this->db->get('purchase_order')->num_rows();
		$config['per_page'] = 10;
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

		$this->db->where('is_return',1);
		$this->db->order_by("createtime", "desc");
		$data['records'] = $this->db->get('purchase_order', $config['per_page'], $this->uri->segment(3));
		
		$data['pageTag'] = 'allreturn';

		$data['main_containt'] = 'purchased/allreturn_form';
		$this->load->view('includes/template',$data);
	}
	
	function search($order_id,$supplier,$item_name)
	{
		if($order_id!='null')
		{
			$this->db->like('order_id',$order_id);
		}
		if($supplier!='null')
		{
			$this->db->like('supplier',$supplier);
		
		}
		if($item_name!='null')
		{
			$this->db->like('name',$item_name);
		}
		
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/purchaseorder/search/'.$order_id.'/'.$supplier.'/'.$item_name;
		$config['total_rows'] = $this->db->get('purchase_order_items')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		//$this->db->order_by("createtime", "desc"); 
		$this->db->join('purchase_order', 'purchase_order.order_id = purchase_order_items.order_id');
		$data['records'] = $this->db->get('purchase_order_items', $config['per_page'], $this->uri->segment(6));
		
		
		$data['main_containt'] = 'purchase_order_search_form';
		$this->load->view('includes/template',$data);
		//echo $order_id.$supplier.$item_name;
	}
	
	function returnedit()
	{
		if($this->input->post('ajax')=='1')
		{
			//echo $this->input->post('name').' '.$this->input->post('value');
			$success=false;
			
			$pieces = explode("_", $this->input->post('name'));
			
			if($pieces[0]=='lack'||$pieces[0]=='broken')
			{
				$update_data = array(
					$pieces[0].'_quantity' => $this->input->post('value')
				);
				$this->db->where('item_index',$pieces[1]);
				
				$success = $this->db->update('purchase_order_items',$update_data);
			}
			/*else if($pieces[0]=='price')
			{
			
				$update_data = array(
					'price' => $this->input->post('value')
				);
				$this->db->where('item_id',$pieces[1]);
			
				$success = $this->db->update('items',$update_data);
			}*/
			
			if($success)
			{
				echo '成功';
			}
			
		}
	}
	
	function returnsubmit()
	{
		if($this->input->post('ajax')=='1')
		{
			//echo $this->input->post('name').' '.$this->input->post('value');
			$success=false;
			
			$pieces = explode("_", $this->input->post('name'));
			
			if($pieces[0]=='try')
			{
				
				$update_data = array(
					$pieces[0].'_quantity' => $this->input->post('value')
				);
				$this->db->where('order_id',$pieces[1]);
				$query = $this->db->get('purchase_order_items');
				
				$sum = 0;
				$comment = '';
				$supplier = '';
				$date = '';
				
				foreach($query->result() as $item)
				{
					if($item->lack_quantity!=0||$item->broken_quantity!=0)
					{
						$comment = $comment.'<div class="row">';
						$comment = $comment.'<img class="col-md-3" src="'.$item->image.'" >';
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
						
						$comment = $comment.'</div><hr>';
						
						$supplier = $item->supplier;
						
						$date = $item->createtime;
					}
				}
				//$comment = $comment.'<div id="ordertitle">'.$pieces[1].'  '.$supplier.'  '.substr($date,0,4).'年'.substr($date,4,2).'月'.substr($date,6,2).'日'.'</div>';
				$comment = $comment.'<div id="ordertitle" style="font-size:20px;">合计：<span style="color:#c00000;">'.($sum/100).'元</span></div>';
				if($sum==0){
					$comment = $comment.'<br><a name="loginButton" class="btn btn-default" disabled>确 认</a></br>';
				
				}else{
					$comment = $comment.'<br><a name="loginButton" class="btn btn-danger" href="'.base_url().'/index.php/purchased/returnconfirm/'.$pieces[1].'" >确 认</a></br>';
				
				}
				
				echo $comment;
								
			}else if($pieces[0]=='submit'){
				
			}

		}
	}
	
	function returnconfirm($order_id)
	{
		$update_data = array(
					'is_return' => 1
		);
		$this->db->where('order_id',$order_id);
		$success = $this->db->update('purchase_order',$update_data);
		if($success)
		{
			
			redirect('purchased');
		}
	}
	
	function orderconfirm($order_id)
	{
		$update_data = array(
					'is_return' => 2
		);
		$this->db->where('order_id',$order_id);
		$success = $this->db->update('purchase_order',$update_data);
		if($success)
		{	
			redirect('purchased');
		}
	}
	
	// 订购商品
	function purchaseitems()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/purchased/purchaseitems';
		$config['total_rows'] = $this->db->get('items')->num_rows();
		$config['per_page'] = 30;
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
		$data['main_containt'] = 'purchased/purchaseitems';
		$this->load->view('includes/template',$data);
	}
	
	// 需要订购的商品
	function needpurchaseitems()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/purchased/needpurchaseitems';
		$this->db->where('buy_quantity>',0);
		$config['total_rows'] = $this->db->get('items')->num_rows();
		$config['per_page'] = 50;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		$this->db->where('buy_quantity>',0);
		$this->db->order_by('supplier');
		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'purchased/purchaseitems';
		$this->load->view('includes/template',$data);
	}
	
	// 搜索并订购商品
	function searchitems($item_name)
	{
		$this->load->library('pagination');
		
		$name = urldecode($item_name);

		$config['base_url'] = base_url().'/index.php/purchased/searchitems/'.$name;
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
		
		$data['main_containt'] = 'purchased/purchaseitems';
		$this->load->view('includes/template',$data);
	}
	
	// 搜索并订购商品
	function searchitems2($item_supplier,$item_name)
	{
		$this->load->library('pagination');

		$item_name = urldecode($item_name);
		$item_supplier = urldecode($item_supplier);

		$config['base_url'] = base_url().'/index.php/purchased/searchitems2/'.$item_supplier.'/'.$item_name;
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
		
		$data['main_containt'] = 'purchased/purchaseitems';
		$this->load->view('includes/template',$data);
	}
	
	// 搜索订单
	function searchorder($order_id,$order_supplier)
	{
		$this->load->library('pagination');


		$order_supplier = urldecode($order_supplier);

		$config['base_url'] = base_url().'/index.php/Purchased/searchorder/'.$order_id.'/'.$order_supplier;
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
		//$this->db->order_by("createtime", "desc");
		$data['records'] = $this->db->get('purchase_order', $config['per_page'], $this->uri->segment(5));
		
		$data['main_containt'] = 'purchased/allorder_form';
		$this->load->view('includes/template',$data);
	}
	
	function buyedit()
	{
		if($this->input->post('ajax')=='1')
		{
			//echo $this->input->post('name').' '.$this->input->post('value');
			$success=false;
			
			$pieces = explode("_", $this->input->post('name'));
			
			if($pieces[0]=='buy')
			{
				$update_data = array(
					$pieces[0].'_quantity' => $this->input->post('value')
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

	function deletemyorder()
	{
		if($this->input->post('ajax')=='1')
		{
			$update_data = array(
					'deleted' => 1
			);
			$this->db->where('myorder_id',$this->input->post('myorder_id'));
			$success = $this->db->update('myorder',$update_data);
			if($success)
			{	
				//redirect('purchased');
				echo '成功';
			}
		}
	}
}

?>
