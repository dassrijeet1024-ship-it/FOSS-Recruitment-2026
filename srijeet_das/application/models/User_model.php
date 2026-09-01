<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
Class User_model extends CI_Model
{
	function get_user($uid)
	{
		$this->db->select('
			user.*,
			account.*,
		');
		$this->db->join('account', 'account.aid=user.su');
		$this->db->where('user.uid',$uid);
		$query=$this->db->get('user');
		log_message('error', 'query '.$this->db->last_query());
		return $query->row_array();
	}

	function user_list($su="", $user_status="")
	{
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['user']);
		if(in_array('List',$acp) && !in_array('List_all',$acp))
		{
			$this->db->where('user.inserted_by', $logged_in['uid']);
		}
		
		$this->db->distinct();
		$this->db->select('
			user.*,
			account.*,
		');
		if ($su!="")
		{
			$this->db->where('user.su',$su);
		}
		if ($user_status!="")
		{
			$this->db->where('user.user_status',$user_status);
		}
		//$this->db->where('user.uid !=',$logged_in['uid']);
		$this->db->order_by('user.uid','asc');
		$this->db->join('account', 'account.aid=user.su');
		
		$this->db->group_by('user.uid');
		$query=$this->db->get('user');
		//echo $this->db->last_query();
		return $query->result_array();
	}
	
	public function is_username_taken($username)
	{
		if(strpos($username, '@') !== false)
		{
			$this->db->where('email', $username);
		}
		else
		{
			$this->db->where('mobile', $username);
		}
		$query = $this->db->get('user');
		
		//log_message('error', $this->db->last_query());
		
		return $query->num_rows() > 0;
	}

	function insert_user()
	{
		$logged_in=$this->session->userdata('logged_in');

		$userdata=array(
			'name'=>strtoupper($this->input->post('name')),
			'address'=>strtoupper($this->input->post('address')),
			'email'=>$this->input->post('email'),
			'gender'=>$this->input->post('gender') ?? '',
			'mobile'=>$this->input->post('mobile'),
			'password'=>encrypt($this->input->post('password')),
			'picture'=>$this->input->post('picture') ?? '',
			'su'=>$this->input->post('su'),
			'inserted_by'=>$logged_in['uid'],
			'registered_date'=>strtotime(date("d-m-Y")),
			'verify_code'=>'0',
			'validation_date'=>strtotime(date("d-m-Y")),
			'user_status'=>$this->input->post('user_status'),
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
	function update_user($uid)
	{
		$logged_in=$this->session->userdata('logged_in');
		$udata = $this->get_user($uid);

		$userdata=array(
			'name'=>strtoupper($this->input->post('name')),
			'address'=>strtoupper($this->input->post('address')) ?? '',
			'email'=>$this->input->post('email'),
			'gender'=>$this->input->post('gender') ?? '',
			'mobile'=>$this->input->post('mobile'),
			'password'=>encrypt($this->input->post('password')),
			'su'=>$this->input->post('su'),
			'inserted_by'=>$logged_in['uid'],
			'registered_date'=>strtotime(date("Y-m-d")),
			'verify_code'=>'0',
			'validation_date'=>strtotime(date("Y-m-d")),
			'user_status'=>$this->input->post('user_status'),
		);
		
		$this->load->helper('upload');
		if (!empty($_FILES['picture'])) 
		{
			$upload_picture = upload_file('picture', 'user/picture/', 300,200);
			if ($upload_picture['status'])
			{
				unlink('./uploads/user/picture/'.$udata['picture']);
				$userdata['picture'] = $upload_picture['data']['file_name'];
			}
		}
		else
		{
			$userdata['picture'] = $udata['picture'];
		}
				
		$this->db->where('uid',$uid);
		if($this->db->update('user',$userdata))
		{
			$this->cache->delete('view_user_' . $uid);
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function update_myaccount()
	{
		$logged_in=$this->session->userdata('logged_in');
		
		$udata = $this->get_user($logged_in['uid']);
		//print_r($udata);die;
		
		$userdata=array(
			'name'=>strtoupper($this->input->post('name')),
			'address'=>strtoupper($this->input->post('address')),
			'password'=>encrypt($this->input->post('password')),
			'email'=>$this->input->post('email'),
			'mobile'=>$this->input->post('mobile'),
			'gender'=>$this->input->post('gender') ?? '',
		);
		
		if (!empty($_FILES['picture'])) 
		{
			$upload_picture = upload_file('picture', 'user/picture/', 300,200);
			if ($upload_picture['status'])
			{
				unlink('./uploads/user/picture/'.$udata['picture']);
				$userdata['picture'] = $upload_picture['data']['file_name'];
			}
		}
		else
		{
			$userdata['picture'] = $udata['picture'];
		}

		$this->db->where('uid',$logged_in['uid']);
		if($this->db->update('user',$userdata))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function remove_user($uid)
	{
		$this->db->where('uid', $uid);
		if($this->db->delete('user'))
		{
			$this->cache->delete('view_user_' . $uid);
			
			return true;
		}
		else
		{
			return false;
		}
	}

	function status_users($su, $status="")
	{
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['user']);
		if(in_array('List',$acp) && !in_array('List_all',$acp))
		{
			$this->db->where('inserted_by',$logged_in['uid']);
		}
		$this->db->where('su',$su);
		if ($status != "")
		{
			$this->db->where('user_status',$status);
		}
		$query=$this->db->get('user');
		//echo $this->db->last_query();
		return $query->num_rows();
	}

	function get_expiry($gid)
	{
		$this->db->where('gid',$gid);
		$query=$this->db->get('group');
		$gr=$query->row_array();
		if($gr['valid_for_days']!='0')
		{
			$nod=$gr['valid_for_days'];
			return date('Y-m-d',(time()+($nod*24*60*60)));
		}
		else
		{
			return date('Y-m-d',(time()+(10*365*24*60*60))); 
		}
	}
	
	function update_status($uid, $status)
	{
		return $this->db->where('uid', $uid)->update('user', ['user_status' => $status]);
	}

}

?>
