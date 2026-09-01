<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

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
		$acp=explode(',',$logged_in['settings']);
		if(!in_array('All',$acp))
		{
			exit($this->lang->line('permission_denied'));
		}
		$data['logged_in'] = $logged_in;
		$data['result']=$this->Account_model->account_list();

		$data['title']=$this->lang->line('account_list');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('account/account_list',$data);
		$this->load->view('footer',$data);
	}
	
	function add_account()
	{
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['settings']);
		if(!in_array('All',$acp))
		{
			exit($this->lang->line('permission_denied'));
		}
		$data['title']=$this->lang->line('add_account');
		$this->load->view('header',$data);
		$this->load->view('account/add_account',$data);
		$this->load->view('footer',$data);
	}
	
	function insert_account()
	{
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['settings']);
		if(!in_array('All',$acp))
		{
			exit($this->lang->line('permission_denied'));
		}
		$this->form_validation->set_rules('account', $this->lang->line('account'), 'trim|required|is_unique[account.account]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
			redirect('account/add_account/');
		}
		else
		{
			$data['account_id']=$this->Account_model->insert_account();
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')."</div>");
			redirect('account', 'refresh');
		}
	}

	function edit_account($account_id)
	{
		$account_id = decrypt(base64_decode($account_id));
		
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['settings']);
		if(!in_array('All',$acp))
		{
			exit($this->lang->line('permission_denied'));
		}
		$data['result']=$this->Account_model->get_account($account_id);
		
		$data['title']=$this->lang->line('edit_account');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('account/edit_account',$data);
		$this->load->view('footer',$data);
	}
	
	function update_account($account_id)
	{
		$account_id = decrypt(base64_decode($account_id));
		
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['settings']);
		if(!in_array('All',$acp))
		{
			exit($this->lang->line('permission_denied'));
		}
		$this->Account_model->update_account($account_id);
		$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')."</div>");
		redirect('account');
	}

	function remove_account($aid)
	{
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['settings']);
		if(!in_array('All',$acp))
		{
			exit($this->lang->line('permission_denied'));
		}
		$maid=$this->input->post('maid');
		$this->db->query("UPDATE user SET su='$maid' WHERE su='$aid'");
		if($this->Account_model->remove_account($aid))
		{
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
		}
		else
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
		}
		redirect('account', 'refresh');
	}

	public function pre_remove_account($aid)
	{
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['settings']);
		if(!in_array('All',$acp))
		{
			exit($this->lang->line('permission_denied'));
		}
		$data['aid']=$aid;
		$data['result']=$this->Account_model->account_list();
		$data['title']=$this->lang->line('remove_account');
		$this->load->view('header',$data);
		$this->load->view('account/pre_remove_account',$data);
		$this->load->view('footer',$data);
	}
	

}
