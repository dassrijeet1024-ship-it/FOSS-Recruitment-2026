<?php
Class Settings_model extends CI_Model
{
	function basicSetting()
	{
		//$query=$this->db->query(" select * from setting where status='Active' order by order_by asc");
		$this->db->where('status',$this->lang->line('active'));
		$query=$this->db->get('settings');
		$set=$query->result_array();
		$setting=array();
		foreach($set as $k => $val)
		{
			$setting[$val['setting_group_name']][$val['setting_name']]=array($val['setting_value'],$val['setting_description']); 
		}
		return $setting;
	}
 
	function settingTabs()
	{
		$query=$this->db->query("SELECT COUNT(setting_id) AS setting_id, setting_group_name FROM settings GROUP BY setting_group_name");
		$set=$query->result_array();
		$setting=array();
		foreach($set as $k => $val){
			$setting[]=$val['setting_group_name']; 
		}
		return $setting;
	}
 
	function updateSetting()
	{
		$error=0;
	 	foreach($_POST as $k => $val)
		{
			$this->db->where('setting_name',$k);
			if(!$this->db->update('settings',array('setting_value'=>$val))){
				$error+=1;
			}
		}
		if($error == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}
