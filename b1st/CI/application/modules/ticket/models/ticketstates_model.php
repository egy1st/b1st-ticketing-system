<?php
class ticketstates_model extends CI_Model
{
	public function __construct()
	{
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
          	//$this->load->library('session');
	}
    
	
	
	public function getTicketStates()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket_states");
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

	public function getTicketState($code)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket_states where code='".$code."'");
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
}
