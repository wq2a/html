<?php
    require_once ("Secure_area.php");
    Class Cart extends Secure_area{
    
    function __Construct()
    {
        parent::__construct();
        $data['navigation'] = get_class();
        $data['key_words'] = $this->db->get('search_words');
        $this->load->vars($data);
    }
    
    function index()
    {
        $data['records'] = $this->cart->contents();
        $data['main_containt'] = 'cart/cart_form';
        $this->load->view('includes/template',$data);
    }

    function order()
    {
        $records = $this->cart->contents();
        $order_data = array();
        $order_data['createtime'] = ''.time();
        $order_data['username'] = $this->session->userdata('username');
        $order_data['comment'] = $this->input->post('comments');
        $order_data['duedate'] = $this->input->post('duedate');
        $this->db->insert('myorder', $order_data);

        $insert_id = $this->db->insert_id();

        $item_data = array();
        $html = '';
        foreach($records as $item)
        {
            $temp = array();
            $temp['order_id'] = $insert_id;
            $temp['item_id'] = $item['id'];
            $temp['name'] = $item['options']['item'];
            $temp['image'] = $item['options']['link'];
            $temp['cost'] = $item['price'];
            $temp['quantity'] = 1;
            $temp['supplier'] = $item['options']['supplier'];
            $html .= '<img src="'.$temp['image'].'"/></br>';
            array_push($item_data,$temp);
        }
        $this->db->insert_batch('myorder_item', $item_data);
        $this->cart->destroy();
        $to = 'TO: 516885872@qq.com';
        $from = 'From: qianw3@gmail.com';
        $subject = 'Subject: New Order';

        $this->execInBackground('ssmtp 516885872@qq.com < application/controllers/email.conf');

        echo '成功';
    }

    function deletecart()
    {
        if($this->input->post('ajax')=='1')
        {
            $success=false;
            
            $data = array(
               'rowid'      => $this->input->post('rowid'),
               'qty'    => 0
            );
            
            $this->cart->update($data);
            $success = true;
            if($success)
            {
                echo '成功';
            }
        }
    }

    function execInBackground($cmd) {
        exec($cmd . ' > /dev/null &');
    }
}

?>
