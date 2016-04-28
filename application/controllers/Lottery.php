<?php
class Lottery Extends My_Controller{
	
	function __Construct()
	{
		parent::__construct();
		$data['navigation'] = get_class();
		$this->load->vars($data);
	}
	
	function index(){
		$this->db->order_by("kj_id", "desc");
		$this->db->limit(5);
		$data['kj'] = $this->db->get('kj');
		
		$this->db->order_by("kj_id", "desc");
		$kj_query = $this->db->get('kj');
		$index = 1;
		$sum = 0;
		$temp = '[[';
		$temp2 = '[[';
		foreach($kj_query->result() as $item){
			// analysis 1
			$sub=$item->red1+$item->red2+$item->red3+$item->red4+$item->red5+$item->red6;
			$sum+=$sub;
			switch($index){
				case 3:
					$temp .= '[7,'.($sum/$index).'],';
					break;
				case 7:
					$temp .= '[6,'.($sum/$index).'],';
					break;
				case 14:
					$temp .= '[5,'.($sum/$index).'],';
					break;
				case 28:
					$temp .= '[4,'.($sum/$index).'],';
					break;
				case 56:
					$temp .= '[3,'.($sum/$index).'],';
					break;
				case 112:
					$temp .= '[2,'.($sum/$index).'],';
					break;
			}
			
			// analysis 2
			$interval = 3;
			$number = 100;
			if($index<$number){
				$sum_t = 0;
				for($i=$index-1;$i<$index+$interval-1;$i++){
					$row = $kj_query->row($i);
					$sum_t += $row->red1+$row->red2+$row->red3+$row->red4+$row->red5+$row->red6;
				}
				$temp2 .= '['.$index.','.($sum_t/$interval).'],';
			}
			
			$index++;
		}
		$temp .= '[1,'.($sum/$index).'],';
		$temp .= ']]';
		$data['sum'] = str_replace('],]]',']]]',$temp);
		$temp2 .= ']]';
		$data['sum2'] = str_replace('],]]',']]]',$temp2);
		// 加载页面
		$data['main_containt'] = 'lottery/homepage';
		$this->load->view('includes/template',$data);
	}

	function home(){
		$this->index();
	}
	
	function kj_analysis($num)
	{
		$this->db->limit($num);
		$this->db->order_by("kj_id", "desc");
		$kj = $this->db->get('kj');
		$temp = '[[';
		foreach($kj->result() as $item){
			$temp .= '['.$item->kj_id.','.($item->red1+$item->red2+$item->red3+$item->red4+$item->red5+$item->red6).'],';
		}
		$temp .= ']]';
		echo str_replace('],]]',']]]',$temp);
	}
	
}