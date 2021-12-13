<?php
class theme_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addtheme($data)
	{
		//$query=$this->db->query("insert into ".$this->db->dbprefix."theme set theme_name='".$theme_name."'");
		$query = $this->db->insert($this->db->dbprefix."theme",$data);
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listtheme($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."theme",$limit,$offset);
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
		$query=$this->db->get($this->db->dbprefix."theme");
		$count=$query->num_rows();
		return $count;
	}

	
	public function statuschange($themeid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."theme where id='".$themeid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."theme set status='".$newstatus."' where id='".$themeid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function themechange($themeid)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."theme set set_default='0' where id<>'".$themeid."'");
		if(!empty($query))
		{
			$query1=$this->db->query("update ".$this->db->dbprefix."theme set set_default='1' where id='".$themeid."'");
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

	public function themechangefront($themeid)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."theme set front_set_default='0' where id<>'".$themeid."'");
		if(!empty($query))
		{
			$query1=$this->db->query("update ".$this->db->dbprefix."theme set front_set_default='1' where id='".$themeid."'");
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

	public function themechangedefaultfront()
	{
		$query=$this->db->query("update ".$this->db->dbprefix."theme set front_set_default='0'");
		if(!empty($query))
		{
				return 1;
		}
		else
		{
			return "";
		}
	}

	public function themechangedefaultback()
	{
		$query=$this->db->query("update ".$this->db->dbprefix."theme set set_default='0'");
		if(!empty($query))
		{
				return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($themeid)
	{
		$fquery=$this->db->query("select theme_name from ".$this->db->dbprefix."theme where id='".$themeid."'");
		
		$det=$fquery->row();
		
		$theme_name=$det->theme_name;
		
		if(!empty($theme_name))
		{
			$csspath= APPPATH.'../assets/css/'.$theme_name.'style.css';
			$csspath1= APPPATH.'../assets/css/'.$theme_name.'chat_style.css';
			unlink($csspath);
			unlink($csspath1);

			$csspath= APPPATH.'../assets/css/'.$theme_name.'front_style.css';
			$csspath1= APPPATH.'../assets/css/'.$theme_name.'front_chat_style.css';
			unlink($csspath);
			unlink($csspath1);
		}
		
		$query=$this->db->query("delete from ".$this->db->dbprefix."theme where id='".$themeid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function B1st_getTheme($themeid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."theme where id='".$themeid."'");
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
	
	public function edittheme($data,$where,$themeid)
	{
		$fquery=$this->db->query("select theme_name from ".$this->db->dbprefix."theme where id='".$themeid."'");
		
		$det=$fquery->row();
		
		$theme_name=$det->theme_name;
		
		if(!empty($theme_name) and $theme_name!=$data['theme_name'])
		{
			
			$csspath= APPPATH.'../assets/css/'.$theme_name.'style.css';
			unlink($csspath);
			
			$csspathchat= APPPATH.'../assets/css/'.$theme_name.'chat_style.css';
			unlink($csspathchat);

			$csspath= APPPATH.'../assets/css/'.$theme_name.'front_style.css';
			unlink($csspath);
			
			$csspathchat= APPPATH.'../assets/css/'.$theme_name.'front_chat_style.css';
			unlink($csspathchat);

		}
		//$query=$this->db->query("update ".$this->db->dbprefix."theme set theme_name='".$theme_name."' where id='".$id."'");
		$query = $this->db->where($where)->update($this->db->dbprefix."theme",$data);
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function alltheme()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."theme where status='1'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getThemeshow()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."theme where set_default='1'");
		if(!empty($query))
		{
			return $query->row();
		}
		else
		{
			return "";
		}
	}
	
	public function getFrontThemeshow()
	{
		
		$query=$this->db->query("select * from ".$this->db->dbprefix."theme where front_set_default='1'");
		
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
