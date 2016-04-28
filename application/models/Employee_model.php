<?php require_once ("People_model.php");

Class Employee_model extends People_model{



function e_save($employee_data,$employee_username)
{

	$this->db->where('username', $employee_username);

	$this->db->update('employee',$employee_data);

}

function get_employee_by_username($username)
{
	$this->db->where('username',$username);
	return $this->db->get('employee');

}

function validate()

{

	$this->db->where('username',$this->input->post('username'));

	$this->db->where('password',md5($this->input->post('password')));

	$query = $this->db->get('employee');

	if($query->num_rows() == 1)

	{

		return true;

	}

}

	

function is_logged_in()

{

	return $this->session->userdata('is_logged_in')!=false;

}

	

function logout()

{

	$this->session->sess_destroy();

	redirect('Home');

}





}





?>