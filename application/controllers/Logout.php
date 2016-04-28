<?php 

Class Logout extends MY_Controller{

function index()
{
	$this->load->model('Employee_model');
	$this->Employee_model->logout();
}

}