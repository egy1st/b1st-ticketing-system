<?php
class product_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addproduct($product_name)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."product set product_name='".$product_name."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listproduct($options, $limit, $offset = 0)
	{
		$query=$this->db->get($this->db->dbprefix."product",$limit,$offset);
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

	public function listProductCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."product");
		$count=$query->num_rows();
		return $count;
	}
	
	public function statuschange($productid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."product where id='".$productid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."product set status='".$newstatus."' where id='".$productid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($productid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."product where id='".$productid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getproduct($productid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."product where id='".$productid."'");
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
	
	public function editproduct($id,$product_name)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."product set product_name='".$product_name."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function allproduct($p=null)
	{
		$sql = "select * from ".$this->db->dbprefix."product where status='1'";
		if(!empty($p))
		{
			$p = urldecode($p);
			$p = base64_decode($p);
			$names = explode(',',$p);
			$p = '';
			foreach($names as $name)
			{
				$p .= "'".$name."',";
			}
			$p = rtrim($p,',');
			$sql .= " AND product_name in (".$p.")";
		}	
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function hasTicket($productid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."ticket where product_id='".$productid."' and status='1'");
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
