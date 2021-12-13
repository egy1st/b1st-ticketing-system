<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class language extends MX_Controller {

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
		B1st_authenticate();
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('language_model');
	
	}
	
	public function index()
	{
		B1st_selectbacklanguage();
		$ppage=$this->input->post('perpage');
		if(!empty($ppage))
		{	
			$_SESSION['perpage'] = $ppage;
			//$this->session->set_userdata('perpage',$this->input->post('perpage'));
		}
		//echo $this->session->userdata('perpage');
		if(!empty($_SESSION['perpage']))
		{
			$noPage = $_SESSION['perpage'];
		}
		else
		{
			$noPage = "";
		}

	    $this->load->library('pagination');

		$options = array(
			'orderBy'=> 'DESC'
		);
		 $settings = (array)B1st_getSettingsValue('pagination');

		#pagination start
		
		$perPage =(!empty($noPage)) ? $noPage : $settings['active'];
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/language/index';
		$config['total_rows'] = $this->language_model->listthemeCount($options);
		$config['per_page'] = $perPage;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagi_box"><ul class="pagi_main">';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open']    = '<li class="no_b">';
		$config['next_tag_close']   = '</li>';
		$config['prev_link']        = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open']    = '<li>';
		$config['prev_tag_close']   = '</li>';
		$config['cur_tag_open'] = '<li><a class="sect" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        #pagination end
        $data['noPage'] = $perPage;
		$languagedet=$this->language_model->listtheme($options,$perPage,$this->uri->segment(3));
		$data['languagedet']=$languagedet;
		$this->load->view('languagelist',$data);
	}
	
	public function languagechange($languageid)
	{
		B1st_selectbacklanguage();
		$chk=$this->language_model->languagechange($languageid);
		if(!empty($chk))
		{
			//$_SESSION['SUCCESS_MSG']=$this->lang->line("Language set as default successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/language");
		}
	}
	
	public function languagechangeback($languageid)
	{
		B1st_selectbacklanguage();
		$chk=$this->language_model->languagechangeback($languageid);
		if(!empty($chk))
		{
			//$_SESSION['SUCCESS_MSG']=$this->lang->line("Language set as default successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/language");
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
