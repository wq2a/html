<?php 	$this->load->view('purchased/home');
		echo '<table class="table table-striped" ><thead><th>#</th><th>供应商</th><th>总金额</th><th>笔数</th><th>平均</th></thead><tbody>';
		$index = 1;
		$sum = 0;
		$quantity = 0;
		foreach($records->result() as $item)
		{
			$sum += $item->total;
			$quantity += $item->number;
			echo '<tr>';
			echo '<td>'.$index.'</td><td><a href="'.base_url().'index.php/purchased/searchitems2/'.$item->supplier.'/null">'.$item->supplier.'</a></td><td>'.intval($item->total).'</td><td>'.$item->number.'</td><td>'.intval($item->average).'</td>';
			echo '</tr>';

			$index++;
		}
		echo '</tbody></table>';
//		echo '<hr><h3>总计:'.intval($sum).'元, 笔数:'.$quantity.', 平均:'.intval($sum/$quantity).'元</h3>'
?>
</div>
</div>
</div>
