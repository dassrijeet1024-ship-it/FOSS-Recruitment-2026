<?php
defined('BASEPATH') or exit('No direct script access allowed');

function send_mail($data)
{
	$CI =&get_instance();

	$config = array(
		'protocol'  => $CI->config->item('email_protocol'),
		'smtp_host' => $CI->config->item('smtp_hostname'),
		'smtp_port' => $CI->config->item('smtp_port'),
		'smtp_user' => $CI->config->item('smtp_username'),
		'smtp_pass' => $CI->config->item('smtp_password'),
		'smtp_crypto' => $CI->config->item('smtp_crypto'),
		'mailtype'  => $CI->config->item('smtp_mailtype'),
		'charset'   => 'utf-8',
		'wordwrap'  => TRUE,
		'newline'   => "\r\n",
		'crlf'      => "\r\n",
	);
	
	//print_r($config);die;

	$CI->load->library('email');
	$CI->email->initialize($config);
	
	$templateData = [
        'title' => $data['title'],
        'message' => $data['message'],
    ];
	
	$message = $CI->load->view('email_template', $templateData, TRUE);

	$CI->email->set_mailtype($CI->config->item('smtp_mailtype'));
	$CI->email->from($CI->config->item('smtp_username'), $CI->config->item('app_name'));
	$CI->email->reply_to('no_reply@techno.co.in', 'NO-REPLY');
	$CI->email->to($data['toemail'], $data['toname']);
	
	$CI->email->subject($data['subject']);
	$CI->email->message($message);
	
	if (!empty($data['cc']))
	{
		$CI->email->cc($data['cc']);
	}
	if (!empty($data['attachment']))
	{
		$CI->email->attach($data['attachment']);
	}
	
	if ($CI->email->send()) 
	{
		//echo "pass".time();
		//var_dump($CI->email);//die;
		return true;
	} 
	else 
	{
		//echo "fail".time();
		print_r($CI->email->print_debugger());die;
		return false;
	}
	

}
	