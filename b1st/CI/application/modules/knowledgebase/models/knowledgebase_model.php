<?php
class knowledgebase_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function addknowledgebase($topic,$content,$category_id,$product_id)
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix."knowledgebasemod set topic='".$topic."',content='".$content."',category_id='".$category_id."',product_id='".$product_id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function listknowledgebase($options, $limit, $offset = 0)
	{
		if(empty($offset))
		{
			$offset=0;
		}
		
		$where="";
		
		$category_id=$this->input->get('category_id');
		
		if(!empty($category_id))
		{
			$where.=" and kbcat.id='".$category_id."'";
		}
		
		$product_id=$this->input->get('product_id');
		
		if(!empty($product_id))
		{
			$where.=" and prod.id='".$product_id."'";
		}
		
		$topic=$this->input->get('topic');
		
		if(!empty($topic))
		{
			$where.=" and kb.topic like '".$topic."%'";
		}
		$query=$this->db->query("select kb.*,kbcat.category_name,prod.product_name from ".$this->db->dbprefix."knowledgebasemod kb,".$this->db->dbprefix."kb_cat kbcat,".$this->db->dbprefix."product prod where kb.category_id=kbcat.id and kb.product_id=prod.id ".$where." limit ".$offset.",".$limit);
		//$query=$this->db->get($this->db->dbprefix."knowledgebasemod",$limit,$offset);
		
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
	
	public function listknowledgebaseall()
	{
		$kb = array();
		$this->load->model('kbcat/kbcat_model');
		$categories = $this->kbcat_model->allkbcat();
		foreach($categories as $category)
		{
			$kb[$category->category_name] = $this->db->select('*')->from($this->db->dbprefix."knowledgebasemod")->join($this->db->dbprefix."product",$this->db->dbprefix."knowledgebasemod.product_id=".$this->db->dbprefix."product.id")->where('category_id',$category->id)->get()->result();
		}

		return $kb;
	}

	public function listfaqall($p=null)
	{
		$faq = array();
		$this->load->model('product/product_model');
		$products =$this->product_model->allproduct($p);
		foreach($products as $product)
		{
			$faq[$product->product_name] = $this->db->select('*')->from($this->db->dbprefix."faq")->join($this->db->dbprefix."product",$this->db->dbprefix."faq.product_id=".$this->db->dbprefix."product.id")->where('product_id',$product->id)->get()->result();
		}

		return $faq;
	}

	public function listKnowledgebaseCount($options)
	{
		$where="";
		
		if(!empty($options['category_id']))
		{
			$category_id=$options['category_id'];
			if(!empty($category_id))
			{
				$where." and kbcat.id='".$category_id."'";
			}
		}
		
		if(!empty($options['product_id']))
		{
			$product_id=$options['product_id'];
			if(!empty($product_id))
			{
				$where." and prod.id='".$product_id."'";
			}
		}
		
		if(!empty($options['topic']))
		{
			$topic=$options['topic'];
			if(!empty($topic))
			{
				$where." and kb.topic like '".$topic."%'";
			}
		}
		
		$query=$this->db->query("select kb.*,kbcat.category_name,prod.product_name from ".$this->db->dbprefix."knowledgebasemod kb,".$this->db->dbprefix."kb_cat kbcat,".$this->db->dbprefix."product prod where kb.category_id=kbcat.id and kb.product_id=prod.id ".$where);
		
		//$query=$this->db->get($this->db->dbprefix."knowledgebasemod");
		
		$count=$query->num_rows();
		return $count;
	}

	
	public function statuschange($knowledgebaseid)
	{
		$query_1=$this->db->query("select status from ".$this->db->dbprefix."knowledgebasemod where id='".$knowledgebaseid."'");
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
		$query=$this->db->query("update ".$this->db->dbprefix."knowledgebasemod set status='".$newstatus."' where id='".$knowledgebaseid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function delete($knowledgebaseid)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix."knowledgebasemod where id='".$knowledgebaseid."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getknowledgebase($knowledgebaseid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."knowledgebasemod where id='".$knowledgebaseid."'");
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
	
	public function editknowledgebase($id,$topic,$content,$category_id,$product_id)
	{
		$query=$this->db->query("update ".$this->db->dbprefix."knowledgebasemod set topic='".$topic."',content='".$content."',category_id='".$category_id."',product_id='".$product_id."' where id='".$id."'");
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function allknowledgebase()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."knowledgebasemod where status='1'");
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function checktopicunique($category_id,$product_id,$topic)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."knowledgebasemod where category_id='".$category_id."' and product_id='".$product_id."' and topic='".$topic."'");
		if(!empty($query))
		{
			return $query->num_rows();
		}
		else
		{
			return "";
		}
	}
	
	public function checktopicuniqueid($category_id,$product_id,$topic,$id)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix."knowledgebasemod where category_id='".$category_id."' and product_id='".$product_id."' and topic='".$topic."' and id<>'".$id."'");
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
