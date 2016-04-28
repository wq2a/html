<?php

class People_model extends CI_Model{

	function exists($people_id)
	{
		$this->db->from('people');
		$this->db->where('people_id',$people_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	/*Gets all people*/
	function get_all()
	{
		$this->db->from('people');
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Gets information about a person as an array.
	*/
	function get_info($people_id)
	{
		$query = $this->db->get_where('people', array('people_id' => $people_id), 1);
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//create object with empty properties.
			$fields = $this->db->list_fields('people');
			$person_obj = new stdClass;
			
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}
	
	/*
	Get people with specific ids
	*/
	function get_multiple_info($people_ids)
	{
		$this->db->from('people');
		$this->db->where_in('people_id',$people_ids);
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Inserts or updates a person
	*/
	function save(&$person_data,$people_id=false)
	{		
		if (!$people_id or !$this->exists($people_id))
		{
			if ($this->db->insert('people',$person_data))
			{
				$person_data['people_id']=$this->db->insert_id();
				return true;
			}
			
			return false;
		}
		
		$this->db->where('people_id', $people_id);
		return $this->db->update('people',$person_data);
	}
	
	/*
	Deletes one Person (doesn't actually do anything)
	*/
	function delete($people_id)
	{
		return true;; 
	}
	
	/*
	Deletes a list of people (doesn't actually do anything)
	*/
	function delete_list($people_ids)
	{	
		return true;	
 	}

}