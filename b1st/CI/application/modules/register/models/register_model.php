<?php
class register_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function login($where)
	{
		$query = $this->db->select('*')
				->where($where)
				->where(array('admin'=>0))
				->get($this->db->dbprefix.'ticket_users');
		if($query->num_rows() == 1)
		{
			$res=$query->result();
			
			/***********
			 * code for
			 * making user
			 * online
			 * after login starts
			 * Author: Dibya Mitra
			 ********************/
			
			$userid=$res[0]->id;
			$upd=$this->db->query("update ".$this->db->dbprefix."ticket_users set online_status='1' where id='".$userid."'");
			
			/***********
			 * code for
			 * making user
			 * online
			 * after login ends
			 * Author: Dibya Mitra
			 ********************/

			$pass=$res[0]->password;

			if($this->dibyariaz_encrypt->decode($pass)==$this->input->post('password'))
			{
				return $res;
			}
			else
			{
				return "";
			}
		}
		else
		{
			return "";
		}
	}

	public function B1st_getRegisterType()
	{
		return $this->db->get($this->db->dbprefix.'ticket_register_types')->result();
	}
	
	/**************
	 * function for
	 * changing user
	 * offline
	 * while logout starts
	 * Author:Dibya Mitra
	 *******************/
	
	public function logout($userid)
	{
		$upd=$this->db->query("update ".$this->db->dbprefix."ticket_users set online_status='0' where id='".$userid."'");
		if(!empty($upd))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	/**************
	 * function for
	 * changing user
	 * offline
	 * while logout ends
	 * Author:Dibya Mitra
	 *******************/
}
