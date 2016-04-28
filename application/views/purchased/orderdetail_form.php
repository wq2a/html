<?php $this->load->view('purchased/home');?>
<?php
		
		foreach($query->result() as $item)
		{
			echo '<br>
			<img src="'.$item->image.'" width="80" height="80">
			<span>'.$item->name.' '.$item->cost.' '.$item->quantity.'</span>
			</br>';
		
		}
		
?>
