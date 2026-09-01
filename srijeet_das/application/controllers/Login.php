<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

class Login extends CI_Controller {

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
		if($this->session->userdata('logged_in'))
		{
			redirect('dashboard');
		}
		$data['title']=$this->lang->line('user')." ".$this->lang->line('login');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/login',$data);
		$this->load->view('footer',$data);
	}
	public function verifylogin()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		
		$status=$this->Login_model->login($username, $password);

		if($status['status']=='1')
		{
			$user=$status['user'];
			$uid=$user['uid'];
			
			$this->session->set_userdata('logged_in', $user);
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('loggedin_successfully')."</div>");
			//print_r($status);exit;
			redirect('dashboard');
		}
		else
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$status['message']."</div>");
			redirect('login');
		}
	}

	public function register()
	{
		$data['title']=$this->lang->line('register');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/register',$data);
		$this->load->view('footer',$data);
	}
	public function insert_register()
	{
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
		$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()."</div>");
			redirect('register');
		}
		else
		{
			if($this->Login_model->insert_register())
			{
				$uid = $this->session->flashdata('insert_id');
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')."</div>");
				redirect('login', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')."</div>");
				redirect('register');
			}
		}
	}

	public function logout()
	{
		//log_message('error', $data);
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}
	
	public function forgot_password($username = "")
	{	
		if($this->input->post('username'))
		{
			$username=$this->input->post('username');

			if($this->Login_model->forgot_password($username))
			{
				$this->session->set_flashdata('message', "<div class='alert alert-success'>Password reset link is sent to your email</div>");
				redirect('login/forgot_password');
			}
			else
			{
				//$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('email_doesnot_exist')."</div>");
				redirect('login/forgot_password');
			}
		}

		$data['title']=$this->lang->line('forgot_password');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/forgot_password',$data);
		$this->load->view('footer',$data);
	}
	public function reset_password()
	{
		if($this->input->post('username'))
		{
			$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]{8,}$/]',
				array(
					'required' => 'You must provide a %s.',
					'min_length' => 'Your %s must be at least 8 characters long.',
					'regex_match' => 'Your %s must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.'
				)
			);
   			$this->form_validation->set_rules('confpassword', 'Confirm Password', 'trim|required|matches[password]');
			
			if ($this->form_validation->run() == FALSE)
   			{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()."</div>");
   				redirect('login/reset_password/');
   			}
   			else
   			{
   			    $new_password = encrypt($this->input->post('password'));
				$username = $this->input->post('username');

				if($this->Login_model->reset_password($username, $new_password))
				{
					$this->session->unset_userdata('ciphertext');
					
					$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')."</div>");
					redirect('login');
				}
				else
				{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')."</div>");
					redirect('login/reset_password/');
				}
   			}
		}

		if (!empty($this->input->get('code')))
		{
			$this->session->set_userdata('ciphertext', $this->input->get('code'));
		}
		$ciphertext = $this->session->userdata('ciphertext');
		$username = decrypt(base64_decode($ciphertext));

		$data['username'] = $username;
		$data['title']=$this->lang->line('reset_password');		
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('user/reset_password',$data);
		$this->load->view('footer',$data);
	}
}