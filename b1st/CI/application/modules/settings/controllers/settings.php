<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends MX_Controller {

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
		B1st_authenticate();
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('settings_model');
	
	}
	
	public function index()
	{
		$this->load->view('settinglist.php');
	}
	
	public function save()
	{
		$name = $this->input->post('setting_name');
		$mainvalue=$this->input->post($name);
		$tab = $this->input->post('tab');

		if($name=="pagination")
		{
			$_SESSION['perpage']="";
		}
		
		$value = json_encode($mainvalue);
		
		//echo "<pre>";
		//print_r($mainvalue);
		//echo "</pre>";
		//die;
		
		if(!empty($mainvalue))
		{
			$errorarr=array();
			foreach($mainvalue as $key=>$val)
			{
				$mainkey=ucwords(str_replace("_"," ",$key));
				
				if (ucwords($mainkey) == "Subject") continue;
				
				if(empty($val))
				{
					$errorarr[]=$mainkey;
				}
			}
		}
		
		if (!empty($errorarr))
		{
			$errorstr=implode(", ",$errorarr);
			$_SESSION['ERROR_MSG'] = $errorstr." cannot be blank";
			redirect(TICKET_PLUGIN_URL."CI/index.php/settings/index".$tab);
		}
		else
		{
			$data['value'] = $value;
			$where['name'] = $name;
	
			$ins = $this->settings_model->update($data,$where);
			if(!empty($ins))
			{
				$_SESSION['open_tab'] = $name;
				$_SESSION['SUCCESS_MSG'] = "Settings updated successfully";
				redirect(TICKET_PLUGIN_URL."CI/index.php/settings/index".$tab);
			}
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
