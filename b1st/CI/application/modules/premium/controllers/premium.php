<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class premium extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		B1st_selectbacklanguage();
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('premium_model');
	}
	
	public function index()
	{
		B1st_authenticate();
		$this->load->view('premium');
	}
	
	public function mod()
	{
		@session_start();
		$modchk=$this->input->post('modchk');
		$modname=$this->input->post('modname');
		$modupd=$this->premium_model->setmod($modchk,$modname);
		if($modname=="faq")
		{
			$modnn="FAQ";
		}
		if($modname=="backup")
		{
			$modnn="Backup";
		}
		if($modname=="chat")
		{
			$modnn="Chat";
		}
		if($modname=="opswat")
		{
			$modnn="OPSWAT";
		}
		if($modname=="akismet")
		{
			$modnn="AKISMET";
		}
		if($modname=="statistics")
		{
			$modnn="Statistics";
		}
		if($modname=="rating")
		{
			$modnn="Rating";
		}
		if($modname=="mob_ver")
		{
			$modnn="Mobile Verification";
		}
		if($modname=="email_mod")
		{
			$modnn="Email Ticket";
		}
		if($modname=="response_time")
		{
			$modnn="Response Time";
		}
		if($modname=="knowledge_base_cat")
		{
			$modnn="Knowledge Base Module";
		}
		if($modname=="twitter")
		{
			$modnn="Twitter";
		}
		if($modchk==1)
		{
			$_SESSION['SUCCESS_MSG']=$modnn." Module deactivated successfully";
		}
		if($modchk!=1)
		{
			$_SESSION['SUCCESS_MSG']=$modnn." Module activated successfully";
		}
		echo $modupd;
	}
	
	public function modinstall()
	{
		@session_start();
		$modname=$this->input->post('modname');
		$functype=$this->input->post('functype');
		if($functype=="install")
		{
			//code for install
			$modupd=$this->premium_model->modInstall($modname);
		}
		if($functype=="uninstall")
		{
			//code for uninstall
			$modupd=$this->premium_model->modUnInstall($modname);
		}
		if($modname=="faq")
		{
			$modnn="FAQ";
		}
		if($modname=="backup")
		{
			$modnn="Backup";
		}
		if($modname=="chat")
		{
			$modnn="Chat";
		}
		if($modname=="opswat")
		{
			$modnn="OPSWAT";
		}
		if($modname=="akismet")
		{
			$modnn="AKISMET";
		}
		if($modname=="statistics")
		{
			$modnn="Statistics";
		}
		if($modname=="rating")
		{
			$modnn="Rating";
		}
		if($modname=="mob_ver")
		{
			$modnn="Mobile Verification";
		}
		if($modname=="email_mod")
		{
			$modnn="Email Ticket";
		}
		if($modname=="response_time")
		{
			$modnn="Response Time";
		}
		if($modname=="knowledge_base_cat")
		{
			$modnn="Knowledge Base Module";
		}
		if($modname=="twitter")
		{
			$modnn="Twitter";
		}
		if($functype=="install")
		{
			$_SESSION['SUCCESS_MSG']=$modnn." Module installed successfully";
		}
		if($functype=="uninstall")
		{
			$_SESSION['SUCCESS_MSG']=$modnn." Module uninstalled successfully";
		}
		echo $modupd;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
