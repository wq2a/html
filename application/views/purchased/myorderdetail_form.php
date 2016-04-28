<?php 	$this->load->view('purchased/home');
		$indextemp=0;
		date_default_timezone_set('Asia/Chongqing');
		foreach($query->result() as $item)
		{
			if($indextemp==0)
			{
				echo '<div><h3>采购单号:'.$item->order_id.'</h3></div><hr style="margin-bottom:5px;">';
			}

			if($indextemp%3 == 0){
				echo '<div class="row">';
			}

			$indextemp++;

			echo '<div class="col-sm-6 col-md-4"><div class="thumbnail ">
			<div class="carousel-inner">
			<img src="'.$item->image.'" class="img-thumbnail" style="border: 0 none;box-shadow: none;"/>
			<h1 class="carousel-caption text-info" style="color:#000000;">#'.$indextemp.'</h1>
			</div>
			<p style="margin-bottom:2px;">'
			.$item->name.
			'</p>
			<p>'.$item->supplier.'</p><p style="margin:0px;"><span class="glyphicon glyphicon-yen">'.(($item->cost)/100).
			'</p></div></div>';
			
			if($indextemp%3 == 0){
				echo '</div>';
			}
		}
?>
