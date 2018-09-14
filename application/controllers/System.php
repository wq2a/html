<?php 
require_once ("Secure_area.php");    
Class System extends Secure_area{
    
    function __Construct()
    {
        parent::__construct();
        $data['navigation'] = get_class();
        $this->load->vars($data);
    }
    
    function index()
    {
        $data['main_containt'] = 'system/home';
        $this->load->view('includes/template',$data);
    }
    
    function news()
    {
        $data['main_containt'] = 'system/news';
        $this->load->view('includes/template',$data);
    }
    
    function analysis()
    {
        $data['main_containt'] = 'system/analysis';
        $data['error'] = '';
        $this->load->view('includes/template',$data);
    }

    function import()
    {
        $data['main_containt'] = 'system/import';
        $this->load->view('includes/template',$data);
    }

    function do_upload()
    {
        $config['upload_path'] = './uploads/alipay';
        $config['allowed_types'] = 'txt';//'*';//'gif|jpg|png';
        //$config['max_size']    = '100';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';

        $this->load->library('upload', $config);
        $data['main_containt'] = 'system/analysis';

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('includes/template',$data);
        }
        else
        {
            $data['error'] = '';
            $this->load->view('includes/template',$data);
        }
    }

    function do_upload_order()
    {
        $config['upload_path'] = './uploads/alipay';
        $config['allowed_types'] = 'txt';//'*';//'gif|jpg|png';
        //$config['max_size']    = '100';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';

        $this->load->library('upload', $config);
        $data['main_containt'] = 'system/import';
        
        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('includes/template',$data);
        }
        else
        {
            $data['error'] = '';
            $upload_data = $this->upload->data(); 
              $data['filename'] =  $upload_data['file_name'];
            $this->load->view('includes/template',$data);
        }
    }

    function do_upload_order_html()
    {
        $config['upload_path'] = './uploads/alipay/html';
        $config['allowed_types'] = 'html';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $data['main_containt'] = 'system/import';
        
        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('includes/template',$data);
        }
        else
        {
            $data['error'] = '';
            $upload_data = $this->upload->data(); 
            $data['filename'] =  $upload_data['file_name'];
            $output = shell_exec("private/python/ali_import/parsehtml.py < uploads/alipay/html/" . $data['filename'] . " 2>&1");

            $pattern = '/.*\.txt/';
            if(!preg_match($pattern, $output)){
                $output = shell_exec("private/python/ali_import/parsehtml2.py < uploads/alipay/html/" . $data['filename'] . " 2>&1");
            }
            if(preg_match($pattern, $output)){
                $fn = trim("uploads/alipay/" . $output, " \t\r\n");
                $data['fn'] = trim($output," \t\r\n");
                $data['error'] .= $fn;
                $order = fopen($fn, 'r');
                if($order) {
                    $first = true;
                    while($line = fgets($order)) {
                        // $data['error'] .= $line;
                        $item = explode(",", $line);
                        if(!$first && count($item) == 4) {
                            $data['error'] .= $line;
                        }else if(count($item) == 6){
                            $data['error'] .= '<h6>'.$item[0].'<span>$'.$item[1].' '.$item[2]. $item[3] .$item[4]. '</span></h1><a href="'.$item[5].'"><img src="'.$item[4].'"/></a><br/>';

                        }
                        $first = false;
                    }
                }
                fclose($order);
            }
            $this->load->view('includes/template',$data);
        }
    }


    function socket($filename)
    {

        $address = '127.0.0.1';
        $port = 9900;
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $result = socket_connect($socket, $address, $port);

        $in = "ALIORDER,".$filename."\r\n";

        socket_write($socket, $in, strlen($in));

        $data['error'] = socket_read($socket,1024,PHP_NORMAL_READ);
        socket_close($socket);

        $data['main_containt'] = 'system/import';
        $this->load->view('includes/template',$data);
    }

    function employee()
    {
        $this->db->from('employee');
        $this->db->join('people','employee.people_id = people.people_id');
        $data['employees'] = $this->db->get();
        $data['main_containt'] = 'system/employee';
        $this->load->view('includes/template',$data);
    }
    
    function addemployee()
    {
        $this->load->helper('security');
        $this->db->trans_start();
        $person_data = array(
            'first_name' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname')
        );
        
        $this->db->insert('people',$person_data);
        
        $people_id = $this->db->insert_id();
        
        $employee_data = array(
            'people_id' => $people_id,
            'username' => $this->input->post('username'),
            'password' => do_hash($this->input->post('password'), 'md5')
        );
        
        $this->db->insert('employee',$employee_data);
        $this->db->trans_complete();
        redirect('system/employee');
    }
    
    function delemployee($people_id)
    {
        $this->db->trans_start();
        $this->db->where('people_id',$people_id);
        $this->db->delete('employee');
        $this->db->where('people_id',$people_id);
        $this->db->delete('people');
        $this->db->trans_complete();
        redirect('system/employee');
    }
    
    function key()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url().'index.php/system/key';
        $this->db->where('delete !=',2);
        $config['total_rows'] = $this->db->get('item_keys')->num_rows();
        $config['per_page'] = 600;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul class="pagination" id="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        $this->db->where('delete !=',2);
        $data['records'] = $this->db->get('item_keys', $config['per_page'], $this->uri->segment(3));
        
        $data['main_containt'] = 'system/key';
        $this->load->view('includes/template',$data);
    }

function keyedit()
{
    if($this->input->post('ajax')=='1')
    {
        $success=false;
        
        $pieces = explode("_", $this->input->post('name'));
            
        if($pieces[0]=='key'){
            $update_data = array(
                'delete' => 1
            );
            $this->db->where('key_id',$pieces[1]);
            $success = $this->db->update('item_keys',$update_data);
            
            if($success)
            {
                echo $pieces[0];
            }
            
        }else if ($pieces[0]=='del'){
            $update_data = array(
                'delete' => 2
            );
            $this->db->where('key_id',$pieces[1]);
            $success = $this->db->update('item_keys',$update_data);
            
            if($success)
            {
                echo $pieces[0];
            }
            
        }
        if($success)
        {
            echo '成功';
        }
            
    }
}

    function item()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url().'/index.php/system/item';
        $this->db->join('news_list','items.item_id = news_list.news_item_id','left');
        $config['total_rows'] = $this->db->get('items')->num_rows();
        $config['per_page'] = 50;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        $this->db->join('news_list','items.item_id = news_list.news_item_id','left');
        $data['records'] = $this->db->get('items', $config['per_page'], $this->uri->segment(3));
        
        $data['main_containt'] = 'system/item';
        $this->load->view('includes/template',$data);
    }
    
    
function itemedit()
{
    if($this->input->post('ajax')=='1')
    {
        $success=false;
        
        $pieces = explode("_", $this->input->post('name'));
            
        if($pieces[0]=='price')
        {
            $update_data = array(
                'price' => $this->input->post('value')
            );
            $this->db->where('item_id',$pieces[1]);
            
            $success = $this->db->update('items',$update_data);
        }
        else if($pieces[0]=='shortname')        
        {
            $update_data = array(
                'short_name' => $this->input->post('value')
            );
            $this->db->where('item_id',$pieces[1]);
            
            $success = $this->db->update('items',$update_data);
        }else if($pieces[0]=='best'||$pieces[0]=='hot'||$pieces[0]=='new'){
            $this->db->where('news_item_id',$pieces[1]);
            $tempdata = $this->db->get('news_list');
            $type='';
            $touchtype='';
            if($pieces[0]=='best')
            {
                $touchtype = '推荐';
            }
            else if($pieces[0]=='hot')
            {
                $touchtype = '热卖';
            }
            else if($pieces[0]=='new')
            {
                $touchtype = '新品';
            }
            foreach($tempdata->result() as $item)
            {
                $type = $item->type;
            }
            if($type=='')
            {
                $this->load->helper('date');
                $time = now();
                
                $update_data = array(
                    'type' => $touchtype,
                    'news_id' => $time,
                    'news_item_id' => $pieces[1]
                );
                $success = $this->db->insert('news_list',$update_data);
            }
            else if(strpos($type,$pieces[0])!==false)
            {
                echo '已';
            }
            else
            {
                $update_data = array(
                    'type' => $type.$touchtype
                );
                $this->db->where('news_item_id',$pieces[1]);
                $success = $this->db->update('news_list',$update_data);
            }
            if($success)
            {
                echo $pieces[0];
            }
            
        }
        if($success)
        {
            echo '成功';
        }
            
    }
}
    
    function initprice()
    {
        $update_data = array(
            'price' => ''
        );
                
        $success = $this->db->update('items',$update_data);
        
        if($success)
        {
            redirect('sale');
        }
    }
    
    function initreturn()
    {
        $update_data = array(
            'lack_quantity' => '',
            'broken_quantity' => ''
        );
                
        $success1 = $this->db->update('purchase_order_items',$update_data);
        
        $update_data = array(
            'is_return' => '0'
        );
                
        $success2 = $this->db->update('purchase_order',$update_data);
        
        if($success1&&$success2)
        {
            redirect('purchased');
        }
    }
    
    function initbuy()
    {
        $update_data = array(
            'buy_quantity' => ''
        );
                
        $success = $this->db->update('items',$update_data);
        
        if($success)
        {
            redirect('purchased');
        }
    }
    
    function addnews()
    {
        if($this->input->post('news_title')!='')
        {
            $this->load->helper('date');
            $time = now();
            $data = array(
                'title' => $this->input->post('news_title'),
                'image' => $this->input->post('image'),
                'type' => $this->input->post('type'),
                'news_id' => $time
            );

            $this->db->insert('news_list', $data);
            
            $data = array(
                'title' => $this->input->post('news_title'),
                'images' => $this->input->post('images'),
                'type' => $this->input->post('type'),
                'link' => $this->input->post('link'),
                'news_id' => $time,
                'detail' => $this->input->post('detail')
            );
            $this->db->insert('news_detail', $data);
        }
        
        redirect('system/news');

    
    }
    
}
