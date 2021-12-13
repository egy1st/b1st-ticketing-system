<?php
class rating_model extends CI_Model
{
	public $path = TICKET_PLUGIN_PATH;
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();

                
          	//$this->load->library('session');
	}

	public function rate($data)
	{
		$this->db->insert($this->db->dbprefix.'ticket_rating',$data);
		$this->updateTotalrate($data);
		
	}


	public function updateTotalrate($data)
	{
		$where = array('ticket_id'=>$data['ticket_id']);
		$q = $this->db->where($where)->get($this->db->dbprefix.'ticket_rating');
		$results = $q->result();
		$totalRows = $q->num_rows();
		$total_rates = 0;
		if(!empty($results))
		{
			foreach($results as $result)
			{
				$total_rates += $result->rating;
			}

			$rating = round($total_rates/$totalRows,1);
			$udata['rating'] = $rating;
			$this->db->where(array('id'=>$data['ticket_id']))->update($this->db->dbprefix.'ticket',$udata);
		}
		
	}

  public function alreadyRated($userid,$ticketid)
  {
  	$data['user_id'] = $userid;
  	$data['ticket_id'] = $ticketid;

  	$q = $this->db->where($data)->get($this->db->dbprefix.'ticket_rating');
  	$n = $q->num_rows();
  	if($n >= 1)
  	{
  		return true;
  	}

  	return false;

  }

	
	
}
