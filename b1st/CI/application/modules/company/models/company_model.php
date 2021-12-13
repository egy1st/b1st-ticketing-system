<?php
class company_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addcompany($company_name,$company_website)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."company set company_name='".$company_name."',company_website='".$company_website."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listcompany($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."company",$limit,$offset);
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

	public function listCompanyCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."company");
		$count=$query->num_rows();
		return $count;
	}

	
	public function statuschange($companyid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."company where id='".$companyid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."company set status='".$newstatus."' where id='".$companyid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($companyid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."company where id='".$companyid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getcompany($companyid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."company where id='".$companyid."'");
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
	
	public function editcompany($id,$company_name)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."company set company_name='".$company_name."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function allcompany()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."company where status='1'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function hasTicket($companyid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket where company_id='".$companyid."' and status='1'");
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
