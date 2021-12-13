<?php
class premium_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
	
	public function checkstatusmodule($modulename)
	{
		$query=$this->db->query("select status from ".$this->db->dbprefix."moduletables where name='".$modulename."'");
		if(!empty($query))
		{
			$res=$query->row();
			return $res->status;
		}
		else
		{
			return "";
		}
	}
	
	public function checkinstallmodule($modulename)
	{
		$query=$this->db->query("select install_status from ".$this->db->dbprefix."moduletables where name='".$modulename."'");
		if(!empty($query))
		{
			$res=$query->row();
			return $res->install_status;
		}
		else
		{
			return "";
		}
	}
	
	public function setmod($modchk,$modname)
	{
		if($modchk==1)
		{
			$newmod=0;
		}
		else
		{
			$newmod=1;
		}
		$query=$this->db->query("update ".$this->db->dbprefix."moduletables set status='".$newmod."' where name='".$modname."'");

		if($modname=="product" && $newmod == 0)
		{
			if(!empty($query))
			{
				$query=$this->db->query("update ".$this->db->dbprefix."moduletables set status='0' where name='knowledge_base_cat'");
				$query=$this->db->query("update ".$this->db->dbprefix."moduletables set status='0' where name='faq'");
			}
		}

		if($modname=="knowledge_base_cat")
		{
			if(!empty($query))
			{
				$query=$this->db->query("update ".$this->db->dbprefix."moduletables set status='".$newmod."' where name='knowledge_base'");
			}
		}
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function modInstall($modname)
	{
		if($modname=="knowledge_base_cat")
		{
			$qq=$this->db->query("update ".$this->db->dbprefix."moduletables set install_status='1' where name='knowledge_base'");
			if(!empty($qq))
			{
				$query=$this->db->query("update ".$this->db->dbprefix."moduletables set install_status='1' where name='knowledge_base_cat'");
			}
		}
		else
		{
			$query=$this->db->query("update ".$this->db->dbprefix."moduletables set install_status='1' where name='".$modname."'");
		}
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function modUnInstall($modname)
	{
		if($modname=="knowledge_base_cat")
		{
			$qq=$this->db->query("update ".$this->db->dbprefix."moduletables set install_status='0',status='0' where name='knowledge_base'");
			if(!empty($qq))
			{
				$query=$this->db->query("update ".$this->db->dbprefix."moduletables set install_status='0',status='0' where name='knowledge_base_cat'");
			}
		}
		else
		{
			$query=$this->db->query("update ".$this->db->dbprefix."moduletables set install_status='0',status='0' where name='".$modname."'");
		}
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
}
