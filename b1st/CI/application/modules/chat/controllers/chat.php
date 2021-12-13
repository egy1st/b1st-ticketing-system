<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chat extends MX_Controller {

	public function __construct()
	{
		B1st_selectbacklanguage();
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('chat_model');
	}

	public function index()
	{
		$data['userlist']=B1st_getUserlistChat();
		$this->load->view('showchat',$data);
	}
	
	public function adminchat()
	{
		$data['adminlist']=B1st_getAdminlistChat();
		$this->load->view('showchatadmin',$data);
	}
	
	public function addchat()
	{
		$toid=$this->input->post('toid');
		$fromid=$this->input->post('fromid');
		$chatrow=$this->input->post('chatrow') . PHP_EOL;
		
		$data['toid']=$toid;
		$data['fromid']=$fromid;
		
		$data['fromemail']=B1st_getUserInfoById($fromid)->email;
		
		$data['chatrow']=$chatrow;
		
		$ins=$this->chat_model->addchat($toid,$fromid,$chatrow);
		
		if($ins)
		{
			$this->load->view('mechat',$data);
			
		}
	}
	
	public function getchatall()
	{
		$toid=$this->input->post('toid');
		$fromid=$this->input->post('fromid');
		
		$data['toid']=$toid;
		$data['fromid']=$fromid;
		
		$data['toemail']=B1st_getUserInfoById($toid)->email;
		$data['fromemail']=B1st_getUserInfoById($fromid)->email;
		
		$chatdet=$this->chat_model->getchatall($toid,$fromid);
		
		//echo "<pre>";
		//print_r($chatdet);
		//echo "</pre>";
		
		$data['chatdet']=$chatdet;
		$this->load->view('chatsession',$data);
	}
	
	public function chatpopup()
	{
		$toid=$this->input->post('toid');
		$getiddet=$this->chat_model->getpopup($toid);
		if(!empty($getiddet))
		{
			$iddet=array();
			foreach($getiddet as $idlist)
			{
				$iddet[]=$idlist->from_userid;
			}
		}
		else
		{
			$iddet="";
		}
		if(!empty($iddet))
		{
			echo json_encode($iddet);
		}
	}
	
	public function chatonoff($userid)
	{
		$userdet=$this->chat_model->getuserlist($userid);
		if(!empty($userdet))
		{
			$data['userdet']=$userdet;
			$this->load->view('useronoff',$data);
		}
	}
	
	public function chatonoffadmin($adminid)
	{
		$admindet=$this->chat_model->getuserlist($adminid);
		if(!empty($admindet))
		{
			$data['admindet']=$admindet;
			$this->load->view('adminonoff',$data);
		}
	}
	
	public function chatticket()
	{
		@session_start();
		$fetchid=$this->input->post('fetchid');
		$toid=$this->input->post('toid');
		$fromid=$this->input->post('fromid');
		$todaysdate=$this->input->post('todaysdate');
		
		$getchatarrtick=$this->chat_model->getchatticket($toid,$fromid,$todaysdate);
		
		$chat_array=array();
		
		if(!empty($getchatarrtick))
		{
			foreach($getchatarrtick as $getchatarrticklist)
			{
				$chat_array[]=$getchatarrticklist->chat;
			}
		}
		$sessionuserid=$_SESSION['userid'];
		$useremaildet=$this->chat_model->getusem($toid,$fromid,$sessionuserid,$todaysdate);
		$useremail=$useremaildet->email;
		$chatstr=implode(" ",$chat_array);
		$mainarr[0]=$chatstr;
		$mainarr[1]=$useremail;
		echo json_encode($mainarr);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
