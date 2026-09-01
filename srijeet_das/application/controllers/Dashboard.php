<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		if($this->db->database =='')
		{
			redirect('install');	
		}
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}

	public function index()
	{	
		$logged_in=$this->session->userdata('logged_in');
		
		if ($logged_in['valid_for'] != '0')
		{
			$validation_date = $logged_in['validation_date'];
			$valid_for_days = $logged_in['valid_for'];
			$data['expiry_date'] = date("d-m-Y",strtotime("+$valid_for_days days", $validation_date));
		}
		else
		{
			$data['expiry_date'] = "***";
		}
		
		$account_list = $this->Account_model->account_list($this->lang->line('active')); //print_r($account_list);
		$data['user'] = $this->User_model->get_user($logged_in['uid']);
		
		$users = [];
		foreach ($account_list as $key => $val)
		{
			$users[] = array(
				'su'=>$val['aid'],
				'account'=>$val['account'],
				'num_users'=>$this->User_model->status_users($val['aid']),
				'active_users'=>$this->User_model->status_users($val['aid'],$this->lang->line('active')),
				'inactive_users'=>$this->User_model->status_users($val['aid'],$this->lang->line('inactive')),
				'archive_users'=>$this->User_model->status_users($val['aid'],$this->lang->line('archive'))
			);
		}
		$data['result'] = $users;
		
		$data['title']=$this->lang->line('dashboard');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/dashboard',$data);
		$this->load->view('footer',$data);
	}
	
	
}