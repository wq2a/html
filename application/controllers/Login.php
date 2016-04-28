<?php

class Login extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$data['navigation'] = get_class();
		$this->load->vars($data);
		$this->load->model('Employee_model');
		if($this->Employee_model->is_logged_in())
		{
			redirect('Home');
		}
	}

	function index()
	{
		$this->load->model('Employee_model');
		$data['is_logged_in'] = $this->Employee_model->is_logged_in();
		$data['main_containt'] = 'login';
		$this->load->view('includes/template',$data);
		$this->load->dbforge();
		//$this->create_table();
	}
	
	function validate_credantials()
	{
		$this->load->model('Employee_model');
		$query = $this->Employee_model->validate();
		if($query)
		{
			//echo 'Login:';
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('Home');
		}
		else
		{
			$this->index();
		}
	}
	
	// 临时建表函数
	function create_table()
	{
            /*
            // myorder
            $fields = array(
                  'myorder_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,  
                        'auto_increment' => TRUE
                  ),
                  'createtime' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255'
                  ),
                  'username' => array(
                        'type' =>'VARCHAR',
                        'constraint' => '255'
                  ),
                  'comment' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                  ),
                  'deleted' => array(
                        'type' => 'INT',
                        'constraint' => 1, 
                        'default' => 0
                  ),
                  'duedate' => array(
                        'type' => 'INT',
                        'constraint' => 8
                  )
                );
                        
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('myorder_id', TRUE);
            $this->dbforge->create_table('myorder',TRUE);

            
            // add myorder items table
            $fields = array(
                        'item_index' => array(
                              'type' => 'INT',
                                                 'constraint' => 11,  
                                                                         'auto_increment' => TRUE
                                          ),
                        'item_id' => array(
                              'type' => 'INT',
                              'constraint' => 11
                                          ),
                        'order_id' => array(
                              'type' => 'INT',
                              'constraint' => 11
                                          ),
                        'name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'image' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '255'
                                          ),
                        'cost' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
                        'quantity' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
                        'supplier' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'username' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'comment' => array(
                                                 'type' => 'TEXT',
                                                 'null' => TRUE
                                          )
                );
                        
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('item_index', TRUE);
            $this->dbforge->create_table('myorder_item',TRUE);

            
            

		
		// add people table
		$fields = array(
                        'people_id' => array(
												 'type' => 'INT',
                                                 'constraint' => 5, 
                                                 'unsigned' => TRUE,
                                                 'auto_increment' => TRUE
                                          ),
                        'first_name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'last_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                                 //'default' => 'King of Town',
                                          ),
                        'comment' => array(
                                                 'type' => 'TEXT',
                                                 'null' => TRUE
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('people_id', TRUE);
		$this->dbforge->create_table('people',TRUE);
	
		
		// add employee table
		$fields = array(
                        'people_id' => array(
												 'type' => 'INT',
                                                 'constraint' => 5,
												 'auto_increment' => TRUE,
                                                 'unsigned' => TRUE
                                          ),
                        'username' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '255'
                                          ),
                        'password' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '255'
                                                 //'default' => 'King of Town',
                                          ),
                        'deleted' => array(
                                                 'type' => 'INT',
												 'constraint' => 1, 
                                                 'null' => TRUE
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('people_id', TRUE);
		$this->dbforge->create_table('employee',TRUE);
		
		// add purchase order table
		$fields = array(
                        'order_id' => array(
												 'type' => 'VARCHAR',
                                                 'constraint' => '255'                                           
                                          ),
                        'createtime' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '255'
                                          ),
                        'supplier' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '255'
                                          ),
                        'comment' => array(
                                                 'type' => 'TEXT',
                                                 'null' => TRUE
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('order_id', TRUE);
		$this->dbforge->create_table('purchase_order',TRUE);
		
		// add items table
		$fields = array(
                        'item_id' => array(
												 'type' => 'INT',
                                                 'constraint' => 11,  
												 'auto_increment' => TRUE
                                          ),
                        'name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'image' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '255'
                                          ),
						'link' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '255'
                                          ),
						'category' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '255'
                                          ),
						'price' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'suggest_price' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'cost' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
			            'quantity' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'unit' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
						'supplier' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
						'reoder_level' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'is_serialized' => array(
                                                 'type' =>'INT',
                                                 'constraint' => 1
                                          ),
						'deleted' => array(
                                                 'type' =>'INT',
                                                 'constraint' => 1
                                          ),
                        'comment' => array(
                                                 'type' => 'TEXT',
                                                 'null' => TRUE
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('item_id', TRUE);
		$this->dbforge->create_table('items',TRUE);
		
		// add purchase_order_items table
		$fields = array(
                        'item_index' => array(
												 'type' => 'INT',
                                                 'constraint' => 11,  
												 'auto_increment' => TRUE
                                          ),
						'order_id' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),	
                        'name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'image' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '255'
                                          ),
						
						'cost' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						
			            'quantity' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'unit' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
						'supplier' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
						'createtime' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),				  
						
                        'comment' => array(
                                                 'type' => 'TEXT',
                                                 'null' => TRUE
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('item_index', TRUE);
		$this->dbforge->create_table('purchase_order_items',TRUE);
		
		// add inventory table
		$fields = array(
						'trans_id' => array(
												 'type' => 'INT',
                                                 'constraint' => 11,  
												 'auto_increment' => TRUE
                                          ),
                        'item_id' => array(
												 'type' => 'INT',
                                                 'constraint' => 11,  
                                          ),
                        'trans_user' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
						'trans_date' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'trans_inventory' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20'
                                          ),
                        'comment' => array(
                                                 'type' => 'TEXT',
                                                 'null' => TRUE
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('trans_id', TRUE);
		$this->dbforge->create_table('inventory',TRUE);
		
		// add supplier table
		$fields = array(
                        'supplier_id' => array(
												 'type' => 'INT',
                                                 'constraint' => 5,
												 'auto_increment' => TRUE,
                                                 'unsigned' => TRUE
                                          ),
                        'name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'deleted' => array(
                                                 'type' => 'INT',
												 'constraint' => 1, 
                                                 'null' => TRUE
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('supplier_id', TRUE);
		$this->dbforge->create_table('supplier',TRUE);
		
		*/
		/*
		// add search_words table
		$fields = array(
                        'id' => array(
												 'type' => 'INT',
                                                 'constraint' => 5,
												 'auto_increment' => TRUE,
                                                 'unsigned' => TRUE
                                          ),
                        'word' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20'
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('search_words',TRUE);
		
		
		// add news_list table
		$fields = array(
                        'title' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
						'image' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '255'
                                          ),
						'type' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'news_id' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'employee' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 5
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('news_id', TRUE);
		$this->dbforge->create_table('news_list',TRUE);
		
		// add news_detail table
		$fields = array(
                        'title' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100'
                                          ),
						'images' => array(
                                                 'type' => 'TEXT'
                                          ),
						'type' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'detail' => array(
                                                 'type' => 'TEXT'
										 ),
						'news_id' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'employee' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 5
                                          ),
						'link' => array(
                                                 'type' => 'TEXT'
                                          )
                );
				
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('news_id', TRUE);
		$this->dbforge->create_table('news_detail',TRUE);*/
		/*
		// add purchase_order_return table
		$fields = array(
						'item_index' => array(
												 'type' => 'INT',
                                                 'constraint' => 11,  

                                          ),
                        'order_id' => array(
												 'type' => 'INT',
                                                 'constraint' => 11,  
                                          ),
						'lack_quantity' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20'
                                          ),
						'broken_quantity' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20'
                                          )
                );
				
		$this->dbforge->add_field($fields);
		//$this->dbforge->add_key('trans_id', TRUE);
		$this->dbforge->create_table('purchase_order_return',TRUE);
		*/
	}
}