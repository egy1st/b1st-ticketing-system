<?php
class settings_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function getSettings($name)
	{
		$where['name'] = $name;
		$q =  $this->db->where($where)->get($this->db->dbprefix.'settings')->row();
		return $q;
	}

	public function getOption($name)
	{
		//$where['option_name'] = $name;
		//$this->db->set_dbprefix(WP_TABLE_PREFIX);
		//$q =  $this->db->where($where)->get('options')->row();
		//$this->db->set_dbprefix(TABLE_PREFIX);
		$q = "B1ST" ;
		return $q;
	}

	public function update($data,$where)
	{
		$q = $this->db->where($where)->update($this->db->dbprefix.'settings',$data);
		if(!empty($q))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
}
