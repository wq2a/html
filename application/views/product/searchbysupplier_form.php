<?php $this->load->view('purchased/home');?>
<!--
<php
		foreach($records->result() as $item)
		{
			$this->db->select('*');
			$this->db->from('purchase_order_items');
			$this->db->where('purchase_order_items.supplier',$item->name);
			$this->db->join('supplier', 'supplier.name = purchase_order_items.supplier');
			$this->db->limit(4);
			$query = $this->db->get();
			echo '<br><a href="'.base_url().'/index.php/purchased/searchbysupplierlist/'.$item->name.'">'.$item->name;
			
			echo '</a></br><br>';
			
			foreach($query->result() as $subitem)
			{
				echo '<img src="'.$subitem->image.'" width="80" height="80">'; 
			}
			echo '</br>';
		}
		echo $this->pagination->create_links();

?>
-->
<div style="position:relative;float:left;margin-top:20px;width:100%;">
<div class="rectangle_4w" style="padding-left:5px;padding-right:5px;background:#555555;">供 应 商 分 类<span class="white_triangle"></span></div>
<div style="font-size:1em;position:absolute;top:50%;margin-top:-4px;right:-4px;">
<?php echo $this->pagination->create_links();?>
</div>


</div>
<div style="position:relative;float:left;width:100%;border-top:1px solid #555555;">
<?php
		
		foreach($records->result() as $item)
		{
			$this->db->select('*');
			$this->db->from('purchase_order_items');
			$this->db->where('purchase_order_items.supplier',$item->name);
			$this->db->join('supplier', 'supplier.name = purchase_order_items.supplier');
			$this->db->limit(3);
			$query = $this->db->get();
			//.$item->order_id.' '.$item->supplier.' '.$item->createtime
			echo '<div style="margin-top:15px;border-bottom:2px solid #555555;width:100%;"><a id="ordertitle" href="'.base_url().'/index.php/purchased/searchbysupplierlist/'.$item->name.'" style="color:#555555;">'.$item->name.'<span style="color:#c00000;"> 进入>></span></a></div>';
			echo '<table style="width:100%;margin-top:10px;margin-bottom:10px;"><tr>';
			foreach($query->result() as $subitem)
			{
			
				echo '<div style="position:relative;float:left;width:33%;height:auto;margin-top:10px;">
			<img src="'.$subitem->image.'" width="80" height="80" style="position:relative;float:left;border:1px solid #999999;">
			<div id="ordertitlelist" style="width:65%;font-size:13px;">'
			.$subitem->name.'<br/><span style="color:#c00000;">￥'.(($subitem->cost)/100).'/￥'.(2.4*($subitem->cost)/100).'</span></div></div>';
			/*
			//transparent
			echo '<td align=center style="position:relative;"><img src="'.$subitem->image.'" style="width:180px;height:240px;border:1px solid #999999;"></img>
			<div id="item_name" style="background:#999999;">'.$subitem->name.'</div></td>';
			*/	
			}
			echo '</tr></table>';
		}
?>

<div style="position:relative;float:right;margin-top:10px;margin-bottom:10px;">
<?php echo $this->pagination->create_links();?>
</div>
</div>
