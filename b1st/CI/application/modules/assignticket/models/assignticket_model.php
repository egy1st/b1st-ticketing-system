<?php
class assignticket_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$tquery)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."ticket set ticket_no='".$ticket_name."',userid='".$userid."',subject='".$subject."',customer='".$customer."',query='".$tquery."',company_id='".$company_id."',department_id='".$department_id."',product_id='".$product_id."',priorty='".$priorty."',create_date='".date('Y-m-d H:i:s')."',modified_date='".date('Y-m-d H:i:s')."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

	public function assignTicket($data)
	{
		return $this->db->insert($this->db->dbprefix.'admin_ticket_assignment',$data);
	}

	public function B1st_checkTicketAssignment($ticket_id)
	{
		$count = $this->db->where('ticket_id',$ticket_id)->get($this->db->dbprefix.'admin_ticket_assignment')->num_rows();
		
		if($count > 0)
		{
			return false;
		}

		return true;
	}

	public function getassigninfo($where)
	{
		return $this->db->where($where)->get($this->db->dbprefix.'admin_ticket_assignment')->row();
	}

	public function transferTicketTo($ticketid,$adminid)
	{
		if(!$this->B1st_checkTicketAssignment($ticketid))
		{
			$udata['admin_id'] = $adminid;
			return $this->db->where('ticket_id',$ticketid)->update($this->db->dbprefix.'admin_ticket_assignment',$udata);
		}
		return "";
	}
	
	public function listticket($options, $limit, $offset = 0)
	{
		//$query=$this->db->get($this->db->dbprefix."ticket",$limit,$offset);
		$this->db->select($this->db->dbprefix."ticket.*,".$this->db->dbprefix."department.department_name,".$this->db->dbprefix."ticket_priority.priority_name,".$this->db->dbprefix."ticket_priority.priority_color")
						->from($this->db->dbprefix."ticket");
						
		if(!empty($options['ticketid']))
		{
			$this->db->where(array('ticket_no'=>$options['ticketid']));
		}
		
		if(!empty($options['email']))
		{
			$this->db->where(array('customer'=>$options['email']));
		}
		
		if(!empty($options['text_part']))
		{
			$this->db->where(array('subject like '=>$options['text_part']."%"));
		}
		
		if(!empty($options['priority']))
		{
			$this->db->where(array('priorty'=>$options['priority']));
		}
		
		if(!empty($options['department']))
		{
			$this->db->where(array('department_id'=>$options['department']));
		}
		
		if(!empty($options['product']))
		{
			$this->db->where(array('product_id'=>$options['product']));
		}
		
		if(!empty($options['state']))
		{
			$this->db->where(array('state'=>$options['state']));
		}
		
		$this->db->join($this->db->dbprefix."department",$this->db->dbprefix."ticket.department_id=".$this->db->dbprefix."department.id");
		$this->db->join($this->db->dbprefix."ticket_priority",$this->db->dbprefix."ticket.priorty=".$this->db->dbprefix."ticket_priority.id");
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
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

	public function listTicketCount($options)
	{
				$query=$this->db->select($this->db->dbprefix."ticket.*,".$this->db->dbprefix."department.department_name,".$this->db->dbprefix."ticket_priority.priority_name,".$this->db->dbprefix."ticket_priority.priority_color")
						->from($this->db->dbprefix."ticket")
			            ->join($this->db->dbprefix."department",$this->db->dbprefix."ticket.department_id=".$this->db->dbprefix."department.id")
			            ->join($this->db->dbprefix."ticket_priority",$this->db->dbprefix."ticket.priorty=".$this->db->dbprefix."ticket_priority.id")
			            ->get();
		$count=$query->num_rows();
		return $count;
	}

	public function listTicketFull()
	{
				$query=$this->db->select($this->db->dbprefix."ticket.*,".$this->db->dbprefix."department.department_name,".$this->db->dbprefix."ticket_priority.priority_name,".$this->db->dbprefix."ticket_priority.priority_color")
						->where($this->db->dbprefix."ticket.status",'1')
						->from($this->db->dbprefix."ticket")
			            ->join($this->db->dbprefix."department",$this->db->dbprefix."ticket.department_id=".$this->db->dbprefix."department.id")
			            ->join($this->db->dbprefix."ticket_priority",$this->db->dbprefix."ticket.priorty=".$this->db->dbprefix."ticket_priority.id")
			            ->get();
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

		public function listUserTicket($data)
	{ 
	$where[$this->db->dbprefix."ticket.userid"] = $data['userid'];
				$query=$this->db->select($this->db->dbprefix."ticket.*,".$this->db->dbprefix."department.department_name,".$this->db->dbprefix."ticket_priority.priority_name,".$this->db->dbprefix."ticket_priority.priority_color")
						->where($this->db->dbprefix."ticket.status",'1')
						->where($where)
						->from($this->db->dbprefix."ticket")
			            ->join($this->db->dbprefix."department",$this->db->dbprefix."ticket.department_id=".$this->db->dbprefix."department.id")
			            ->join($this->db->dbprefix."ticket_priority",$this->db->dbprefix."ticket.priorty=".$this->db->dbprefix."ticket_priority.id")
			            ->get();
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
	
	
	public function statuschange($ticketid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."ticket where id='".$ticketid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."ticket set status='".$newstatus."' where id='".$ticketid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($ticketid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."ticket where id='".$ticketid."'");
		$query2=$this->db->query("delete from ".$this->db->dbprefix."ticket_reply where ticket_id='".$ticketid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getticket($ticketid)
	{
		//$query=$this->db->query("select * from ".$this->db->dbprefix."ticket where id='".$ticketid."'");
		 $query=$this->db->select($this->db->dbprefix."ticket.*,".$this->db->dbprefix."department.department_name,".$this->db->dbprefix."ticket_priority.priority_name,".$this->db->dbprefix."ticket_priority.priority_color")
						->from($this->db->dbprefix."ticket")
						->where($this->db->dbprefix."ticket.id",$ticketid)
			            ->join($this->db->dbprefix."department",$this->db->dbprefix."ticket.department_id=".$this->db->dbprefix."department.id")
			            ->join($this->db->dbprefix."ticket_priority",$this->db->dbprefix."ticket.priorty=".$this->db->dbprefix."ticket_priority.id")
			            ->get();

		$det=$query->row();
/*echo '<pre>';
		print_r($det);
exit;*/
		if(!empty($det))
		{
			return $det;
		}
		else
		{
			return "";
		}
	}
	
	public function editticket($id,$ticket_name,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$state,$tquery)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."ticket set ticket_no='".$ticket_name."',subject='".$subject."',customer='".$customer."',query='".$tquery."',company_id='".$company_id."',department_id='".$department_id."',product_id='".$product_id."',priorty='".$priorty."',state='".$state."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

	public function update($data,$where)
	{
		$query = $this->db->where($where)->update($this->db->dbprefix.'ticket',$data);

		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

	public function insertReply($data)
	{
		$query = $this->db->insert($this->db->dbprefix."ticket_reply",$data);
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

	public function getTicketChain($id)
	{
		$query = $this->db->select($this->db->dbprefix."ticket.*,".$this->db->dbprefix."ticket_reply.*")
						   ->where($this->db->dbprefix."ticket_reply.ticket_id",$id)
						   ->from($this->db->dbprefix."ticket")
						   ->join($this->db->dbprefix."ticket_reply",$this->db->dbprefix."ticket.id=".$this->db->dbprefix."ticket_reply.ticket_id")
						   ->order_by('date','asc')
						   ->get()
						   ->result();
		if(!empty($query))
		{
			return $query;
		}
		else
		{
			return "";
		}
	}
	
	public function uploadAttachmentTemp($filename,$sessionid)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."temp_file set filename='".$filename."',session_id='".$sessionid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function showfilename($sessionid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."temp_file where session_id='".$sessionid."'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function deletetemp($fileid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."temp_file where id='".$fileid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getTicketAttachment($ticketid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."attachments where ticket_id='".$ticketid."'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function insndel($ins,$val)
	{
		$qone=$this->db->query("insert into ".$this->db->dbprefix."attachments set ticket_id='".$ins."',filename='".$val."'");
		
		if(!empty($qone))
		{
			$qtwo=$this->db->query("delete from ".$this->db->dbprefix."temp_file where filename='".$val."'");
			if(!empty($qtwo))
			{
				return 1;
			}
		}
	}
	
	public function checkassignedticket($ticketid,$userid)
	{
		$sql="select * from ".$this->db->dbprefix."admin_ticket_assignment where admin_id='".$userid."' and ticket_id='".$ticketid."'";
		$query=$this->db->query($sql);
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
