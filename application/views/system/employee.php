<?php $this->load->view('system/home');

echo form_open('system/addemployee');
echo '<input class="my_button" class="my_input" type="submit"></input>
<input placeholder="姓" class="my_input" name="lastname" type="text" style="width:60%;position:relative;float:left;" ></input>
<input placeholder="名" class="my_input" name="firstname" type="text" style="width:60%;position:relative;float:left;" ></input>
<input placeholder="用户名" class="my_input" name="username" type="text" style="width:60%;position:relative;float:left;" ></input>
<input placeholder="密码" class="my_input" name="password" type="password" style="width:60%;position:relative;float:left;" ></input>';
echo form_close();



foreach($employees->result() as $employee)
{
	echo '<div class="my_div1">';
	echo '<span class="my_h3">姓：'.$employee->last_name.'</span>';
	echo '<span class="my_h3">名：'.$employee->first_name.'</span>';
	echo '<span class="my_h3">用户名：'.$employee->username.'</span>';
	
	echo '<a class="my_a" href="'.base_url().'index.php/system/delemployee/'.$employee->people_id.'">删除</a>';
	echo '</div>';
}

	

?>

