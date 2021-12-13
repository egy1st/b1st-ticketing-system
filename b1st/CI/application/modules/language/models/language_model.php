<?php
class language_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
	
	public function listtheme($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."language",$limit,$offset);
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

	public function listthemeCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."language");
		$count=$query->num_rows();
		return $count;
	}
	
	public function languagechange($languageid)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."language set default_status='0' where id<>'".$languageid."'");
		if(!empty($query))
		{
			$query1=$this->db->query("update ".$this->db->dbprefix."language set default_status='1' where id='".$languageid."'");
			if(!empty($query1))
			{
				return 1;
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

	public function languagechangeback($languageid)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."language set back_default_status='0' where id<>'".$languageid."'");
		if(!empty($query))
		{
			$query1=$this->db->query("update ".$this->db->dbprefix."language set back_default_status='1' where id='".$languageid."'");
			if(!empty($query1))
			{
				return 1;
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
	
	public function defaultlanguage()
	{
		$query=$this->db->query("select language_code from ".$this->db->dbprefix."language where default_status='1'");
		if(!empty($query))
		{
			return $query->row();
		}
		else
		{
			return "";
		}
	}

	public function defaultbacklanguage()
	{
		$query=$this->db->query("select language_code from ".$this->db->dbprefix."language where back_default_status='1'");
		if(!empty($query))
		{
			return $query->row();
		}
		else
		{
			return "";
		}
	}
}
