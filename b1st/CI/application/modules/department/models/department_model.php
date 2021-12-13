<?php
class department_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function adddepartment($department_name)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."department set department_name='".$department_name."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listdepartment($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."department",$limit,$offset);
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
	
	public function listDepartmentCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."department");
		$count=$query->num_rows();
		return $count;
	}

	public function statuschange($departmentid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."department where id='".$departmentid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."department set status='".$newstatus."' where id='".$departmentid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($departmentid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."department where id='".$departmentid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getdepartment($departmentid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."department where id='".$departmentid."'");
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
	
	public function editdepartment($id,$department_name)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."department set department_name='".$department_name."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function alldepartment()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."department where status='1'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function hasTicket($departmentid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket where department_id='".$departmentid."' and status='1'");
		if(!empty($query))
		{
			return $query->num_rows();
		}
		else
		{
			return "";
		}
	}
}
