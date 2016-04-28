<?php
class Secure_area extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();	
		$this->load->model('Employee_model');
		if(!$this->Employee_model->is_logged_in())
		{
			redirect('login');
		}
	}
}
?>