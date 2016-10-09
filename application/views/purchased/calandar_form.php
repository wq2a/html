<?php 	$this->load->view('purchased/home');
		$year = date('Y');
		$curr = array();
		$previous = array();
		foreach($records->result() as $item)
		{
			$y = substr($item->createtime,0,4);
			$m = substr($item->createtime,6,2);
			if($year == $y)
			{
				if(!isset($curr[$m]))
					$curr[$m] = '';
				$curr[$m] .= '<a href="'.base_url().'index.php/purchased/searchitems2/'.$item->supplier.'/null">'.$item->supplier.'</a><br/>';
			}else{
				if(!isset($previous[$m]))
					$previous[$m] = '';
				$sql = 'select * from purchase_order_items where order_id='.$item->order_id.' limit 3';
				$query = $this->db->query($sql);
				foreach($query->result() as $ii)
				{
					$previous[$m] .= '<img src="'.$ii->image.'" width="80px" height="80px"></img><span> </span>';
				}
				
				$previous[$m] .= '<h5><a href="'.base_url().'index.php/purchased/searchitems2/'.$item->supplier.'/null">'.$item->supplier.'</a><small>'.$y.'</small></h5>金额: '.$item->order_total.'元<hr>';

			}
		}


		echo '<table class="table table-striped" ><thead><th>'.date('m').'月</th><th>'.$year.'</th><th>历史采购记录</th></thead><tbody>';
		for($x = 1;$x<=31;$x++)
		{
			if($x<10)
				$x = '0'.$x;
			if(!isset($curr[strval($x)]) && !isset($previous[strval($x)]))
			{
				continue;	
			}
			echo '<tr>';
			echo '<td>'.$x.'日</td><td>'.(isset($curr[strval($x)])?$curr[strval($x)]:'').'</td><td>'.(isset($previous[strval($x)])?$previous[strval($x)]:'').'</td>';
			echo '</tr>';
		}
/*		foreach($records->result() as $item)
		{
			echo '<tr>';
			echo '<td>'.$index.'</td><td><a href="'.base_url().'index.php/purchased/searchitems2/'.$item->supplier.'/null">'.$item->supplier.'</a></td><td>'.$item->createtime.'</td>';
			echo '</tr>';

			$index++;
		}
*/		echo '</tbody></table>';
?>
</div>
</div>
</div>
