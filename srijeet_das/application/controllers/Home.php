<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
class Home extends CI_Controller {
    
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
		$data['title']=$this->lang->line('home');
		$this->load->view('header',$data);
		$this->load->view('navbar',$data);
		$this->load->view('banner',$data);
		$this->load->view('home/home',$data);
		$this->load->view('footer',$data);
	}
}