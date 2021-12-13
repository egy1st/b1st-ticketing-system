<?php
class login_model extends CI_Model
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
		//$q=$this->db->query("show tables");
		//echo "<pre>";
		//print_r($q->result());
		//echo "</pre>";
		//die;
		
		$query = $this->db->select('*')
				->where($where)
				->get($this->db->dbprefix.'ticket_users');
				
		if($query->num_rows() == 1)
		{
			$res=$query->result();

			$pass=$res[0]->password;

			if($this->dibyariaz_encrypt->decode($pass)==$this->input->post('password'))
			{
				$adminid=$res[0]->id;
				$upd=$this->db->query("update ".$this->db->dbprefix."ticket_users set online_status='1' where id='".$adminid."'");
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
	
	public function adminlogout($adminid)
	{
		$upd=$this->db->query("update ".$this->db->dbprefix."ticket_users set online_status='0' where id='".$adminid."'");
		if(!empty($upd))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
}
