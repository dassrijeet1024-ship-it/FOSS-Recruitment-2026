<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
Class Account_model extends CI_Model
{
	function get_account($aid)
	{
		$this->db->where('aid',$aid);
		$query=$this->db->get('account');
		//echo $this->db->last_query();
		return $query->row_array();
	}

	function account_list($account_status="")
	{
		if ($account_status!="")
		{
			$this->db->where('account_status',$account_status);
		}
		$this->db->order_by('aid','asc');
		$query=$this->db->get('account');
		//echo $this->db->last_query();
		return $query->result_array();
	}
 
	function insert_account(){
 
		//print_r($_POST); die;
		$userdata=array(
			'account'=>$this->input->post('account'),
			'description'=>$this->input->post('description'),
			'account_status'=>$this->input->post('account_status')
		);
			
		if($this->input->post('settings')) {
			$userdata['settings']=$this->input->post('settings');
		} else {
			$userdata['settings']='';
		}
		if($this->input->post('user')){
			$userdata['user']=implode(',',$this->input->post('user'));
		}
			
		//print_r($userdata); exit;
		if ($this->db->insert('account',$userdata))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function update_account($aid){
	 
		$userdata=array(
			'account'=>strtoupper($this->input->post('account')),
			'description'=>$this->input->post('description'),
			'account_status'=>$this->input->post('account_status')
		);
		
		if($this->input->post('settings')){
			$userdata['settings']=$this->input->post('settings');
		}else{
			$userdata['settings']="";
		}
		if($this->input->post('user')){
			$userdata['user']=implode(',',$this->input->post('user'));
		}else{
			$userdata['user']="";
		}

		//print_r($userdata); exit;
		$this->db->where('aid',$aid);
		$this->db->update('account',$userdata);				
	}
	
	function remove_account($aid)
	{
		$this->db->where('aid',$aid);
		$this->db->delete('account');
		return true;
	}				
 
 }