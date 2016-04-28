<?php $this->load->view('system/home');
	//echo $json_result;
	$result = json_decode($json_result);
	echo $result->orderListResult->totalCount;
	//echo $result->orderListResult->realPrePageSize;
	//echo $result->orderListResult->count;
	//$orderListResult = json_decode(($result->orderListResult));
	//$modelList = json_decode($orderListResult->modelList);
	foreach($result->orderListResult->modelList as $order)
	{
		echo '订单号：'.$order->tbId;
		echo $order->sellerCompanyName.$order->sellerName.$order->sellerMemberId.'<br/>';
		echo $order->paidCarriage.'<br/>';
		echo $order->gmtCreate;
		//echo $order->gmtGoodsReceived;
		//echo $order->gmtGoodsSend;
		foreach($order->orderEntries as $item)
		{
			echo 'productName'.$item->productName;
			//echo 'actualConfirmProductFee'.$item->actualConfirmProductFee;
			echo 'unitPrice'.$item->unitPrice;
			echo 'amount'.$item->amount;
			echo 'quantity'.$item->quantity;
			//echo 'specId'.isset($item->specId)?$item->specId:'';
			echo 'productPics'.
			'<img src="http://img.china.alibaba.com:80/img/order/trading'.$item->productPic.'"></img><br/>';
		}
	}
?>