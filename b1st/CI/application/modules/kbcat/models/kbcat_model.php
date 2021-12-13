<?php
class kbcat_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addkbcat($category_name)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."kb_cat set category_name='".$category_name."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listkbcat($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."kb_cat",$limit,$offset);
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

	public function listKbcatCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."kb_cat");
		$count=$query->num_rows();
		return $count;
	}

	
	public function statuschange($kbcatid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."kb_cat where id='".$kbcatid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."kb_cat set status='".$newstatus."' where id='".$kbcatid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($kbcatid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."kb_cat where id='".$kbcatid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getkbcat($kbcatid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."kb_cat where id='".$kbcatid."'");
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
	
	public function editkbcat($id,$category_name)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."kb_cat set category_name='".$category_name."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function allkbcat()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."kb_cat where status='1'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function hasKnowledgebase($kbcatid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."knowledgebasemod where category_id='".$kbcatid."' and status='1'");
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
