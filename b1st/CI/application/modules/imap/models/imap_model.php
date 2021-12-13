<?php
class imap_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}

	public function insertEmail($data)
	{
		$this->db->insert($this->db->dbprefix."emails",$data);
	}

	public function emailExists($eid)
	{
		$count = $this->db->where(array('eid'=>$eid))->get($this->db->dbprefix."emails")->num_rows();

		if($count >= 1)
		{
			return true;
		}

		return false;
	}

	public function getAllEmails()
	{
		return $this->db->where(array('deleted'=>0))->get($this->db->dbprefix."emails")->result();
	}

	public function getDeletedMailId()
	{
		$deleted = array();
		$rows = $this->db->where(array('deleted'=>1))->get($this->db->dbprefix."emails")->result();
		foreach($rows as $row)
		{
			$deleted[] = $row->eid;
		}

		return $deleted;
	}

	public function getEmail($eid)
	{
		return $this->db->where(array('eid'=>$eid))->get($this->db->dbprefix."emails")->result();
	}

	public function deleteEmail($where)
	{
		return $this->db->where($where)->update($this->db->dbprefix."emails",array('deleted'=>1));
	}

	public function getAllEmailCount()
	{
		return $this->db->where(array('deleted'=>0))->get($this->db->dbprefix."emails")->num_rows();
	}

	public function getDeleteEmailCount()
	{
		return $this->db->where(array('deleted'=>1))->get($this->db->dbprefix."emails")->num_rows();
	}

	public function getPostedEmailCount()
	{
		$this->db->select('*');
		$this->db->from($this->db->dbprefix."ticket");
		$this->db->join($this->db->dbprefix."emails", $this->db->dbprefix.'ticket.email_no = '.$this->db->dbprefix.'emails.eid');
		return $this->db->get()->num_rows();
	}
    
}
