<?php $this->load->view('system/home');
	echo '<hr class="featurette-divider">';
	$index = 0;
		foreach($records->result() as $item)
		{
			if($index%6 == 0){
				echo '<div class="row">';
			}
			$index++;
			echo '<div class="col-xs-2 col-md-2">';
			echo '<span>'.$item->name.'</span>';
			echo '<a data-edit="key_'.$item->key_id.'" onclick="input_change(this)" style="margin-left:5px;';
			
			if($item->delete==1){
				echo 'color:#c00000;" disabled';
			}else{
				echo 'color:#d5d5d5;"';
			}
			echo '>Switch</a>';

			echo '<a data-edit="del_'.$item->key_id.'" onclick="input_change(this)" style="margin-left:5px;">Delete</a>';
			echo '</div>';

			if($index%6 == 0){
				echo '</div >';
			}
		}
	 echo $this->pagination->create_links();?>

<script>

	function input_change(id)
	{
		var form_data = {
		ajax:'1',
		name:id.getAttribute('data-edit'),
		value:id.value
		};
		$.ajax({
		url:'<?php echo base_url() ?>index.php/system/keyedit',
		type:'POST',
		data:form_data,
		success:function(msg){
			if(msg=='key成功'){
				id.disabled=true;
				id.style.color="#c00000";
			}else if(msg=='del成功'){
				id.disabled=true;
				id.style.color="#c00000";
			}
			else
			{
				alert('操作失败，请稍后再试');
				id.value = 0;
			}
		}
		});
		return false;
	}
</script>