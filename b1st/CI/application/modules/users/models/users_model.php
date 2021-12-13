<?php
class users_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}

	public function listuser($options,$limit,$offset,$where=array('admin'=>1))
	{
		$query = $this->db->where($where)->get($this->db->dbprefix.'ticket_users',$limit,$offset);

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
    
	public function listUserCount($options,$where=array('admin'=>1))
	{
		return $this->db->where($where)->get($this->db->dbprefix.'ticket_users')->num_rows();
	}

	public function insert($data)
	{
		$query = $this->db->insert($this->db->dbprefix.'ticket_users',$data);
		if($query)
		{
			return true;
		}

		return "";	
	}

	public function statuschange($id)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."ticket_users where id='".$id."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."ticket_users set status='".$newstatus."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

	public function delete($id)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."ticket_users where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

	public function getuser($where)
	{
		return $this->db->where($where)->get($this->db->dbprefix.'ticket_users')->row();
	}

	public function update($data,$where)
	{
		$query = $this->db->where($where)->update($this->db->dbprefix.'ticket_users',$data);

		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

	public function checkusername($data)
	{
		$query = $this->db->select('*')->where($data)->get($this->db->dbprefix.'ticket_users');
		if($query->num_rows() == 0)
		{
			return true;
		}

		return false;

	}
	
	public function getAllUser()
	{
		$query=$this->db->select('*')->where('status = 1 and admin <> 1')->get($this->db->dbprefix.'ticket_users');
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getAllAdmin()
	{
		$query=$this->db->select('*')->where('status = 1 and admin = 1')->get($this->db->dbprefix.'ticket_users');
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function updrespondertime($diff,$userid)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."responder_time_duration set responder_time_duration='".$diff."',userid='".$userid."'");
		if(!empty($query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function checkassignment($userid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."admin_ticket_assignment where admin_id='".$userid."'");
		if(!empty($query))
		{
			return $query->num_rows();
		}
		else
		{
			return "";
		}
	}

	public function getresponseduration($userid)
	{
		$query=$this->db->query("select responder_time_duration from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' order by (currentdate) DESC");
		$r = $query->result();
		if(!empty($r))
		{
			$t = 0;
			$c = count($r);
			foreach($r as $rr)
			{
				$t += $rr->responder_time_duration;
			}
			
			return floor($t/$c);
		}
		else
		{
			return "";
		}
	}

	public function showavgrate()
	{
		$query=$this->db->query("select rating,ticket_id,user_id from ".$this->db->dbprefix."ticket_rating");
		if(!empty($query))
		{
			$dd=$query->result();
			$numrows=$query->num_rows();
			if(!empty($dd))
			{
				$totalrate=0;
				foreach($dd as $vv)
				{
					$totalrate=$totalrate+$vv->rating;
				}
				return $avgrate=ceil($totalrate/$numrows);
			}
		}
		else
		{
			return "";
		}
	}

	public function ticketrepliednum($userid)
	{
		$query=$this->db->query("select count(id) as repnum from ".$this->db->dbprefix."ticket_reply where replier='admin' and 
			replier_id='".$userid."' group by(ticket_id)");
		if(!empty($query))
		{
			$reply=$query->result();
			if(!empty($reply))
			{
				return count($reply);
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

	public function lowerrepliedticket($userid)
	{
		$query=$this->db->query("select count(tick.rating) as lowrate from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_reply rep where tick.id=rep.ticket_id and rep.replier='admin' and rep.replier_id='".$userid."' and tick.rating>0 and tick.rating<3 group by rep.ticket_id");
		if(!empty($query))
		{
			$lowrate=$query->row();
			if(!empty($lowrate))
			{
				return $lowrate->lowrate;
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
}
