<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		if($this->db->database =='')
		{
			redirect('install');	
		}
	}
	
	public function index()
	{	
		if(!$this->session->userdata('logged_in'))
		{
			redirect('user/login');
		}
	}

	public function user_list($su="", $user_status="")
	{
		if ($su!="")
		{
			$su = decrypt(base64_decode($su));
		}
		if ($user_status!="")
		{
			$user_status = decrypt(base64_decode($user_status));
		}
		
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('List',$user_p) && !in_array('List_all',$user_p))
		{
			exit($this->lang->line('permission_denied'));
		}
		
		$data['user_list']=$this->User_model->user_list($su,$user_status);
		
		$data['title']=$user_status.' '.$this->lang->line('user_list');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/user_list',$data);
		$this->load->view('footer',$data);
	}
	
	public function add_user()
	{
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Add',$user_p)){
			exit($this->lang->line('permission_denied'));
		}

		$data['account_list']=$this->Account_model->account_list($this->lang->line('active'));
		
		$data['title']=$this->lang->line('add_user');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/add_user',$data);
		$this->load->view('footer',$data);
	}
	public function insert_user()
	{
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Add',$user_p)){
			exit($this->lang->line('permission_denied'));
		}
		
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|is_unique[user.email]',
			array(
				'valid_email' => 'Please enter a valid %s.',
				'is_unique'  => 'This %s is already registered. Please use a different email.'
			)
		);
		$this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'trim|required|numeric|min_length[10]|max_length[10]|is_unique[user.mobile]',
			array(
				'is_unique'  => 'This %s is already registered. Please use a different email.'
			)
		);
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
		$this->form_validation->set_rules('su', $this->lang->line('account'), 'trim|required');
		$this->form_validation->set_rules('user_status', $this->lang->line('status'), 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()."</div>");
			redirect('user/add_user/'.base64_encode(encrypt($this->input->post('su'))));
		}
		else
		{
			if($this->User_model->insert_user())
			{
				$uid = $this->session->flashdata('insert_id');
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')."</div>");
				redirect('user/user_list', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')."</div>");
				redirect('user/add_user/'.base64_encode(encrypt($this->input->post('su'))));
			}
		}
	}
	
	public function edit_user($uid)
	{
		$uid = decrypt(base64_decode($uid));
		
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Edit',$user_p))
		{
			exit($this->lang->line('permission_denied'));
		}

		$data['result']=$this->User_model->get_user($uid);
		$data['result']['password']=decrypt($data['result']['password']);

		$data['account_list']=$this->Account_model->account_list($this->lang->line('active'));

		$data['title']=$this->lang->line('edit_user');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/edit_user',$data);
		$this->load->view('footer',$data);
	}
	public function update_user($uid)
	{
		$uid = decrypt(base64_decode($uid));
		
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Edit',$user_p)){
			exit($this->lang->line('permission_denied'));
		}

		$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
		$this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'trim|required|callback_unique_mobile['.$uid.']');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|callback_unique_email['.$uid.']');
		
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
		$this->form_validation->set_rules('su', $this->lang->line('account'), 'trim|required');
		$this->form_validation->set_rules('user_status', $this->lang->line('status'), 'trim|required');
		
		//print_r($_POST);exit;
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()."</div>");
			redirect('user/edit_user/'.base64_encode(encrypt($uid)));
		}
		else
		{
			if($this->User_model->update_user($uid))
			{
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')."</div>");
				redirect('user/user_list', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')."</div>");
				redirect('user/edit_user/'.base64_encode(encrypt($uid)));
			}
		}       
	}
	
	public function view_user($uid)
	{
		$uid = decrypt(base64_decode($uid));
		
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('View',$user_p))
		{
			exit($this->lang->line('permission_denied'));
		}
		
		$data['user']=$this->User_model->get_user($uid);
		
		$data['title']=$this->lang->line('view_user');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/view_user',$data);
		$this->load->view('footer',$data);
	}
	
	public function myaccount()
	{
		$logged_in=$this->session->userdata('logged_in'); //print_r($logged_in);
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Myaccount',$user_p))
		{
			exit($this->lang->line('permission_denied'));
		}
	
		$data['user']=$this->User_model->get_user($logged_in['uid']); //print_r($data['result']);
		$data['user']['password']=decrypt($data['user']['password']);

		$data['title']=$this->lang->line('myaccount');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/myaccount',$data);
		$this->load->view('footer',$data);
	}

	public function update_myaccount()
	{
		$logged_in=$this->session->userdata('logged_in'); //print_r($logged_in);
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Myaccount',$user_p))
		{
			exit($this->lang->line('permission_denied'));
		}
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
		$this->form_validation->set_rules('address', $this->lang->line('address'), 'trim|required');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_unique_email['.$logged_in["uid"].']',
			['unique_email' => 'The %s is already in use.']
		);
		$this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'trim|required|numeric|min_length[10]|max_length[10]|callback_unique_mobile['.$logged_in["uid"].']',
			['unique_mobile' => 'The %s is already in use.']
		);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
			redirect('user/myaccount');
		}
		else
		{
			if($this->User_model->update_myaccount($logged_in['uid']))
			{
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
				redirect('user/dashboard');
			}
			else
			{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
				redirect('user/myaccount');
			}
		}       
	}
	
	public function check_username_exists()
	{
		$exists = '';
		$username = $this->input->post('username');
		log_message('error', $username);
		if ($this->User_model->is_username_taken($username))
		{
			$exists = 'available';
		}
		else
		{
			$exists = 'taken';
		}
		echo $exists;
	}
	
	public function unique_mobile($mobile="", $uid="") 
	{
		if ($mobile=="" && $uid=="")
		{
			$uid = $this->input->post('uid');
			$mobile = $this->input->post('mobile');
		}
		
		$this->db->where('mobile', $mobile);
		$this->db->where('uid !=', $uid);
		$query = $this->db->get('user');
		log_message('error', $this->db->last_query());
		
		$exists = '';
		if ($query->num_rows() > 0) 
		{
			$exists = 'taken';
			$this->form_validation->set_message('unique_mobile', $this->lang->line('mobile_in_use'));
			echo $exists;
			return false;
		}
		else 
		{
			$exists = 'available';
			echo $exists;
			return true;
		}
	}
	public function unique_email($email="", $uid="") 
	{
		if ($email=="" && $uid=="")
		{
			$uid = $this->input->post('uid');
			$email = $this->input->post('email');
		}
		
		$this->db->where('email', $email);
		$this->db->where('uid !=', $uid);
		$query = $this->db->get('user');
		log_message('error', $this->db->last_query());
		
		$exists = '';
		if ($query->num_rows() > 0) 
		{
			$exists = 'taken';
			$this->form_validation->set_message('unique_email', $this->lang->line('email_in_use'));
			echo $exists;
			return false;
		}
		else 
		{
			$exists = 'available';
			echo $exists;
			return true;
		}
	}
	
	public function pre_remove_user($uid)
	{
		$uid = decrypt(base64_decode($uid));
		
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Remove',$user_p)){
			exit($this->lang->line('permission_denied'));
		}
		
		if($uid=='1')
		{
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('permission_denied')."</div>");
			redirect('user/user_list', 'refresh');
		}
		
		$data['uid']=$uid;
		$data['user_list']=$this->User_model->user_list("",$this->lang->line('active'));
		
		$data['title']=$this->lang->line('remove_user');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/pre_remove_user',$data);
		$this->load->view('footer',$data);
	}
	
	public function remove_user($uid)
	{
		$uid = decrypt(base64_decode($uid));
		
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['user']);
		if(!in_array('Remove',$user_p)){
			exit($this->lang->line('permission_denied'));
		}
		if($uid=='1'){
			exit($this->lang->line('permission_denied'));
		}
		
		$muid=$this->input->post('muid');
		$this->db->query("UPDATE survey_residential SET uid='$muid' WHERE uid='$uid'");
		$this->db->query("UPDATE survey_commercial SET uid='$muid' WHERE uid='$uid'");
		$this->db->query("UPDATE survey_other SET uid='$muid' WHERE uid='$uid'");
		
		if($this->User_model->remove_user($uid))
		{
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_removed_successfully')." </div>");
		}
		else
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove_data')." </div>");
		}
		redirect('user/user_list', 'refresh');
	}
	
	public function update_status()
	{
		$uid = decrypt(base64_decode($this->input->post('uid')));
		$status = $this->input->post('status');
		$update = $this->User_model->update_status($uid, $status);
		//log_message('error', $uid.$status);
		
		if ($status == $this->lang->line('active'))
		{
			$status = $this->lang->line('online');
		}
		else
		{
			$status = $this->lang->line('offline');
		}
	
		echo json_encode([
			'uid' => $uid,
			'status' => $status,
			'success' => $update
		]);
	}
}