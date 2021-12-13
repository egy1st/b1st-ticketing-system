<?php
class ticketpriority_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addpriority($data)
	{
		//$query=$this->db->query("insert into ".$this->db->dbprefix."ticket_priority set priority_name='".$priority_name."'");
		$query = $this->db->insert($this->db->dbprefix."ticket_priority",$data);
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listpriority($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."ticket_priority",$limit,$offset);
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

	public function listPriorityCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."ticket_priority");
		$count=$query->num_rows();
		return $count;
	}

	
	public function statuschange($priorityid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."ticket_priority where id='".$priorityid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."ticket_priority set status='".$newstatus."' where id='".$priorityid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($priorityid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."ticket_priority where id='".$priorityid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getpriority($priorityid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket_priority where id='".$priorityid."'");
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
	
	public function editpriority($data,$where)
	{
		//$query=$this->db->query("update ".$this->db->dbprefix."ticket_priority set priority_name='".$priority_name."' where id='".$id."'");
		$query = $this->db->where($where)->update($this->db->dbprefix."ticket_priority",$data);
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function allpriority()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket_priority where status='1'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function hasTicket($priorityid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket where priorty='".$priorityid."'");
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
