<?php 
Class Home extends MY_Controller{

// 首页默认
function index()
{	
	/*
	// 加载frontpage model, 获取所需数据
	$this->load->model('Frontpage_model');
	
	// 获取数据列表
	$data['newitems'] = $this->Frontpage_model->get_itemsbytype('新品',9);
	$data['hot'] = $this->Frontpage_model->get_itemsbytype('热卖',12);
	$data['best'] = $this->Frontpage_model->get_itemsbytype('推荐',12);
	$data['book'] = $this->Frontpage_model->get_randombooks(8);
	
	// 加载页面
	$data['main_containt'] = 'home/homepage';
	$this->load->view('includes/template',$data);
	*/
	$data['main_containt'] = 'home/homepagev2';
	$this->load->view('includes/template',$data);

}

// 跳转至英伦页面板块
function europe()
{
	$data['main_containt'] = 'home/europe';
	$this->load->view('includes/template',$data);
}

function zakka()
{
	$this->load->library('pagination');

	$config['base_url'] = base_url().'/index.php/home/zakka';
	$config['total_rows'] = $this->db->get('zakka')->num_rows();
	$config['per_page'] = 48;
	$config['num_links'] = 20;
	$config['full_tag_open'] = '<div id="pagination">';
	$config['full_tag_close'] = '</div>';
	$this->pagination->initialize($config);
		
	$data['records'] = $this->db->get('zakka', $config['per_page'], $this->uri->segment(3));
		
	$data['main_containt'] = 'home/zakka';
	$this->load->view('includes/template',$data);
}

}
?>