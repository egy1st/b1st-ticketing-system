<?php
class privilages_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addprivilagegroup($company_name)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."company set company_name='".$company_name."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listprivilagegroup($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."privilege_group",$limit,$offset);
		$det=$query->result();
		if(!empty($det))
		{
			return $det;
		}
		else
		{
			return "";
		}
	}

	public function listPrivilagegroupCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."privilege_group");
		$count=$query->num_rows();
		return $count;
	}

	
	public function statuschange($privilagegroupid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."privilege_group where id='".$privilagegroupid."'");
		$det=$query_1->row();
		$status=$det->status;
		if($status==1)
		{
			$newstatus=0;
		}
		if($status==0)
		{
			$newstatus=1;
		}
		$query=$this->db->query("update ".$this->db->dbprefix."privilege_group set status='".$newstatus."' where id='".$privilagegroupid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($privilagegroupid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."privilege_group where id='".$privilagegroupid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getprivilagegroup($privilagegroupid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."privilege_group where id='".$privilagegroupid."'");
		$det=$query->row();
		if(!empty($det))
		{
			return $det;
		}
		else
		{
			return "";
		}
	}
	
	public function editprivilagegroup($id,$company_name)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."privilege_group set company_name='".$company_name."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getallprivilages()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."privileges where status='1'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
}
