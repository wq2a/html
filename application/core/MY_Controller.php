<?php 

Class MY_Controller extends CI_Controller{

function __Construct()
{
	parent::__construct();
	$this->load->model('employee_model');
	$data['is_logged_in'] = $this->employee_model->is_logged_in();
	$data['navigation'] = 'Home';
	$this->load->vars($data);
}


}