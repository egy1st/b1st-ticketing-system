<?php
class twitter_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}

	public function insertTweet($data)
	{
		$this->db->insert($this->db->dbprefix."tweets",$data);
	}

	public function tweetExists($eid)
	{
		$count = $this->db->where(array('tid'=>$eid))->get($this->db->dbprefix."tweets")->num_rows();

		if($count >= 1)
		{
			return true;
		}

		return false;
	}

	public function getAllTweets()
	{
		return $this->db->where(array('deleted'=>0))->get($this->db->dbprefix."tweets")->result();
	}

	public function getTweet($eid)
	{
		return $this->db->where(array('tid'=>$eid))->get($this->db->dbprefix."tweets")->result();
	}

	public function deleteTweet($where)
	{
		return $this->db->where($where)->update($this->db->dbprefix."tweets",array('deleted'=>1));
	}
    
}
