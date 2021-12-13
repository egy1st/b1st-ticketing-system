<?php
class faq_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addfaq($product_id,$question,$answer,$status)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."faq set product_id='".$product_id."',question='".addslashes($question)."',answer='".addslashes($answer)."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listfaq($options, $limit, $offset = 0)
	{
		
		$query = $this->db->select($this->db->dbprefix."faq.*,".$this->db->dbprefix."product.product_name")
						  ->from($this->db->dbprefix."faq")
						  ->join($this->db->dbprefix."product",$this->db->dbprefix."faq.product_id=".$this->db->dbprefix."product.id")
						  ->limit($limit,$offset)
						  ->get();
		//$query=$this->db->query("select f.*,pr.product_name from ".$this->db->dbprefix."faq f,".$this->db->dbprefix."product pr where f.product_id=pr.id order by pr.product_name limit $limit,$offset");
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
	
	public function listAllFaq($productid)
	{
		if(!empty($productid))
		{
			$query = $this->db->select($this->db->dbprefix."faq.*,".$this->db->dbprefix."product.product_name")
						  ->from($this->db->dbprefix."faq")
						  ->join($this->db->dbprefix."product",$this->db->dbprefix."faq.product_id=".$this->db->dbprefix."product.id")
						  ->where("product.id",$productid)
						  ->get();
		}
		else
		{
			$query = $this->db->select($this->db->dbprefix."faq.*,".$this->db->dbprefix."product.product_name")
						  ->from($this->db->dbprefix."faq")
						  ->join($this->db->dbprefix."product",$this->db->dbprefix."faq.product_id=".$this->db->dbprefix."product.id")
						  ->get();
		}
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

	public function listFaqCount($options)
	{
		$query=$this->db->get($this->db->dbprefix."faq");
		$count=$query->num_rows();
		return $count;
	}

	public function statuschange($faqid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."faq where id='".$faqid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."faq set status='".$newstatus."' where id='".$faqid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($faqid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."faq where id='".$faqid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getfaq($faqid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."faq where id='".$faqid."'");
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
	
	public function editfaq($id,$question,$answer,$product_id)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."faq set product_id='".$product_id."',question='".addslashes($question)."',answer='".addslashes($answer)."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function checkunique($product_id,$question)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."faq where product_id='".$product_id."' and question='".$question."'");
		if(!empty($query))
		{
			return $query->num_rows();
		}
		else
		{
			return "";
		}
		
	}
	
	public function checkuniqueid($product_id,$question,$id)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."faq where product_id='".$product_id."' and question='".$question."' and id != '".$id."'");
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
