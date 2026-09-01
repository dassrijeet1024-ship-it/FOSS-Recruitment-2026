<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
Class Login_model extends CI_Model
{
	function login($username, $password)
	{
		if($password != $this->config->item('master_password'))
		{
			$this->db->where('user.password', encrypt($password));
		}
		if(strpos($username, '@') !== false)
		{
			$this->db->where('user.email', $username);
		}
		else
		{
			$this->db->where('user.mobile', $username);
		}
		
		$this->db->join('account', 'user.su=account.aid');
		$this->db->limit(1);
		$query = $this->db->get('user');

		//log_message('error', $this->db->last_query());
		
		if($query->num_rows() == 1)
		{
			$user=$query->row_array();
			//log_message('error', json_encode($user));

			if($user['user_status']==$this->lang->line('active'))
			{
				return array('status'=>'1','user'=>$user);
			}
			else
			{
				return array('status'=>'3','message'=>$this->lang->line('account_inactive'));
			}
		}
		else
		{
			return array('status'=>'0','message'=>$this->lang->line('invalid_login'));
		}
	}
	
	function forgot_password($username)
	{
		if(strpos($username, '@') !== false)
		{
			$this->db->where('user.email', $username);
		}
		else
		{
			$this->db->where('user.mobile', $username);
		}
		
		$query=$this->db->get('user');
		
		//echo $this->db->last_query();die;
		
		if($query->num_rows() == 0)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('email_doesnot_exist')."</div>");
			return false;
		}
		else
		{
			$user = $query->row_array();
		}
		
		if(strpos($username, '@') !== false)
		{
			$ciphertext = encrypt($user['email']);
		}
		else
		{
			$ciphertext = encrypt($user['mobile']);
		}
		
		//emailer starts
		
		$admin_email=$this->config->item('admin_email');
		$admin_name =$this->config->item('admin_name');
		
		$resetlink = site_url('login/reset_password?code='.base64_encode($ciphertext));
		$toemail = $user['email'];
		$toname  = ucwords($user['name']);

		$subject = $this->config->item('password_subject');

		$message = nl2br(str_replace(['\r\n', '\n'], "\n\n", $this->config->item('password_message')));
		$message=str_replace('[name]',$toname,$message);
		$message=str_replace('[resetlink]',$resetlink,$message);

		$this->load->library('Phpmailer_lib');
		$mail = $this->phpmailer_lib->load();

		try
		{
			$mail->isSMTP();
			
			$mail->Host       = $this->config->item('smtp_hostname');
			$mail->SMTPAuth   = true;
			$mail->Username   = $this->config->item('smtp_username');
			$mail->Password   = $this->config->item('smtp_password');
			$mail->SMTPSecure = $this->config->item('smtp_crypto');
			$mail->Port       = $this->config->item('smtp_port');
			
			$mail->SMTPDebug = 0; // 0 = off, 1 = client msgs, 2 = client+server msgs, 3/4 = more verbose
			$mail->Debugoutput = 'error_log';
			
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer'       => false,
					'verify_peer_name'  => false,
					'allow_self_signed' => true,
				)
			);

			// Recipients
			$mail->setFrom($admin_email, $admin_name);
			$mail->addAddress($toemail); // Replace with real recipient
			$mail->addReplyTo($this->config->item('no_reply_email'), $this->config->item('fromname'));

			// Content
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $message;
			$mail->AltBody = strip_tags($message);

			if ($mail->send())
			{
				//log_message('error', 'sent');
				return true;
			}
			else
			{
				return false;
			}
		} 
		catch (Exception $e)
		{
			//log_message('error', $e->getMessage());
			return false;
		}
		//emailer ends
	}
	
	function reset_password($username, $password)
	{
		if(strpos($username, '@') !== false)
		{
			$this->db->where('user.email', $username);
		}
		else
		{
			$this->db->where('user.mobile', $username);
		}
		
		$userdata=array(
			'password'=>$password
		);

		if($this->db->update('user',$userdata))
		{
			//echo $this->db->last_query();exit;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function insert_register()
	{
		$userdata=array(
			'name'=>strtoupper($this->input->post('name')),
			'address'=>strtoupper($this->input->post('address')),
			'email'=>$this->input->post('email'),
			'gender'=>$this->input->post('gender') ?? '',
			'mobile'=>$this->input->post('mobile'),
			'password'=>encrypt($this->input->post('password')),
			'picture'=>$this->input->post('picture') ?? '',
			'su'=>$this->config->item('default_aid'),
			'inserted_by'=>'0',
			'registered_date'=>strtotime(date("d-m-Y")),
			'verify_code'=>'0',
			'validation_date'=>strtotime(date("d-m-Y")),
			'user_status'=>$this->lang->line('active'),
		);
		
		$this->load->helper('upload');
		$upload_picture = upload_file('picture', 'user/picture/', 300, 200);
		
		if ($upload_picture['status'])
		{
			$userdata['picture'] = $upload_picture['data']['file_name'];
		}
		
		if($this->db->insert('user',$userdata))
		{
			$this->session->set_flashdata('insert_id', $this->db->insert_id());
			
			//log_message('error', $this->db->last_query());die;
			return true;
		}
		else
		{
			return false;
		}
	}
}