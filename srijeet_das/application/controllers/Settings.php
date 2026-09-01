<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
		
		$data['tabs']=$this->Settings_model->settingTabs();
		$data['settings']=$this->Settings_model->basicSetting();
		
		$data['title']=$this->lang->line('settings');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('setting/setting',$data);
		$this->load->view('footer',$data);
	}
	
	public function update()
	{
		if($this->Settings_model->updateSetting())
		{
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')."</div>");
		}
		else
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')."</div>");
		}
		redirect('settings', 'refresh');
	}

}