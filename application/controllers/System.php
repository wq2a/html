<?php 
require_once ("Secure_area.php");	
Class System extends Secure_area{
	
	function __Construct()
	{
		parent::__construct();
		$data['navigation'] = get_class();
		$this->load->vars($data);
	}
	
	function index()
	{
		$data['main_containt'] = 'system/home';
		$this->load->view('includes/template',$data);
	}
	
	function news()
	{
		$data['main_containt'] = 'system/news';
		$this->load->view('includes/template',$data);
	}
	
	function employee()
	{
		$this->db->from('employee');
		$this->db->join('people','employee.people_id = people.people_id');
		$data['employees'] = $this->db->get();
		$data['main_containt'] = 'system/employee';
		$this->load->view('includes/template',$data);
	}
	
	function addemployee()
	{
		$this->load->helper('security');
		$this->db->trans_start();
		$person_data = array(
			'first_name' => $this->input->post('firstname'),
			'last_name' => $this->input->post('lastname')
		);
		
		$this->db->insert('people',$person_data);
		
		$people_id = $this->db->insert_id();
		
		$employee_data = array(
			'people_id' => $people_id,
			'username' => $this->input->post('username'),
			'password' => do_hash($this->input->post('password'), 'md5')
		);
		
		$this->db->insert('employee',$employee_data);
		$this->db->trans_complete();
		redirect('system/employee');
	}
	
	function delemployee($people_id)
	{
		$this->db->trans_start();
		$this->db->where('people_id',$people_id);
		$this->db->delete('employee');
		$this->db->where('people_id',$people_id);
		$this->db->delete('people');
		$this->db->trans_complete();
		redirect('system/employee');
	}
	
	function item()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url().'/index.php/system/item';
		$this->db->join('news_list','items.item_id = news_list.news_item_id','left');
		$config['total_rows'] = $this->db->get('items')->num_rows();
		$config['per_page'] = 50;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		$this->db->join('news_list','items.item_id = news_list.news_item_id','left');
		$data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(3));
		
		$data['main_containt'] = 'system/item';
		$this->load->view('includes/template',$data);
	}
	
	
function itemedit()
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
		else if($pieces[0]=='shortname')		
		{
			$update_data = array(
				'short_name' => $this->input->post('value')
			);
			$this->db->where('item_id',$pieces[1]);
			
			$success = $this->db->update('items',$update_data);
		}else if($pieces[0]=='best'||$pieces[0]=='hot'||$pieces[0]=='new'){
			$this->db->where('news_item_id',$pieces[1]);
			$tempdata = $this->db->get('news_list');
			$type='';
			$touchtype='';
			if($pieces[0]=='best')
			{
				$touchtype = '推荐';
			}
			else if($pieces[0]=='hot')
			{
				$touchtype = '热卖';
			}
			else if($pieces[0]=='new')
			{
				$touchtype = '新品';
			}
			foreach($tempdata->result() as $item)
			{
				$type = $item->type;
			}
			if($type=='')
			{
				$this->load->helper('date');
				$time = now();
				
				$update_data = array(
					'type' => $touchtype,
					'news_id' => $time,
					'news_item_id' => $pieces[1]
				);
				$success = $this->db->insert('news_list',$update_data);
			}
			else if(strpos($type,$pieces[0])!==false)
			{
				echo '已';
			}
			else
			{
				$update_data = array(
					'type' => $type.$touchtype
				);
				$this->db->where('news_item_id',$pieces[1]);
				$success = $this->db->update('news_list',$update_data);
			}
			if($success)
			{
				echo $pieces[0];
			}
			
		}
		if($success)
		{
			echo '成功';
		}
			
	}
}
	
	function initprice()
	{
		$update_data = array(
			'price' => ''
		);
				
		$success = $this->db->update('items',$update_data);
		
		if($success)
		{
			redirect('sale');
		}
	}
	
	function initreturn()
	{
		$update_data = array(
			'lack_quantity' => '',
			'broken_quantity' => ''
		);
				
		$success1 = $this->db->update('purchase_order_items',$update_data);
		
		$update_data = array(
			'is_return' => '0'
		);
				
		$success2 = $this->db->update('purchase_order',$update_data);
		
		if($success1&&$success2)
		{
			redirect('purchased');
		}
	}
	
	function initbuy()
	{
		$update_data = array(
			'buy_quantity' => ''
		);
				
		$success = $this->db->update('items',$update_data);
		
		if($success)
		{
			redirect('purchased');
		}
	}
	
	function addnews()
	{
		if($this->input->post('news_title')!='')
		{
			$this->load->helper('date');
			$time = now();
			$data = array(
				'title' => $this->input->post('news_title'),
				'image' => $this->input->post('image'),
				'type' => $this->input->post('type'),
				'news_id' => $time
			);

			$this->db->insert('news_list', $data);
			
			$data = array(
				'title' => $this->input->post('news_title'),
				'images' => $this->input->post('images'),
				'type' => $this->input->post('type'),
				'link' => $this->input->post('link'),
				'news_id' => $time,
				'detail' => $this->input->post('detail')
			);
			$this->db->insert('news_detail', $data);
		}
		
		redirect('system/news');

	
	}
	
}