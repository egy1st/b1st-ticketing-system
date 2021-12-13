<?php
class chat_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addchat($toid,$fromid,$chatrow)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."chatsession set to_userid='".$toid."',from_userid='".$fromid."',chat='".$chatrow."',create_date='".date('Y-m-d H:i:s')."'");
		if(!empty($query))
		{
			//echo '<script type="text/javascript">play_sound();</script>';
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getchatall($toid,$fromid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."chatsession where (to_userid='".$toid."' and from_userid='".$fromid."' and date(create_date)='".date('Y-m-d')."') or (to_userid='".$fromid."' and from_userid='".$toid."' and date(create_date)='".date('Y-m-d')."')");
		if(!empty($query))
		{
			$res=$query->result();
			return $res;
		}
		else
		{
			return "";
		}
	}
	
	public function getpopup($toid)
	{
		$query=$this->db->query("select id,from_userid from ".$this->db->dbprefix."chatsession where to_userid='".$toid."' and seen='0'");
		if(!empty($query))
		{
			$res=$query->result();
			if(!empty($res))
			{
				foreach($res as $reslist)
				{
					$chatid=$reslist->id;
					$nq=$this->db->query("update ".$this->db->dbprefix."chatsession set seen='1' where id='".$chatid."'");
				}
			}
			return $res;
			
		}
		else
		{
			return "";
		}
	}
	
	public function getuserlist($userid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket_users where id='".$userid."' and status='1'");
		if(!empty($query))
		{
			return $query->row();
		}
		else
		{
			return "";
		}
	}
	
	public function getchatticket($toid,$fromid,$todaysdate)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."chatsession where (to_userid='".$toid."' and from_userid='".$fromid."' and date(create_date)='".$todaysdate."') or (to_userid='".$fromid."' and from_userid='".$toid."' and date(create_date)='".$todaysdate."')");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getusem($toid,$fromid,$sessionuserid,$todaysdate)
	{
		$sql="select distinct(us.email) from ".$this->db->dbprefix."ticket_users us,".$this->db->dbprefix."chatsession ch where (ch.to_userid='".$toid."' and ch.from_userid='".$fromid."' and date(ch.create_date)='".$todaysdate."' and ch.to_userid=us.id and ch.to_userid!='".$sessionuserid."') or (ch.to_userid='".$fromid."' and ch.from_userid='".$toid."' and date(ch.create_date)='".$todaysdate."' and ch.from_userid=us.id and ch.from_userid!='".$sessionuserid."')";
		$query=$this->db->query($sql);
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
