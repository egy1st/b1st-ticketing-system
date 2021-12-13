<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rating extends MX_Controller {

	public $path = TICKET_PLUGIN_PATH;

	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->model('rating_model');
		@session_start();
	}
	
	public function rate()
	{
		$data['ticket_id'] = $this->input->post('idBox');
		$data['rating'] = $this->input->post('rate');
		$data['user_id'] = $_SESSION['c_userid'];

		$this->rating_model->rate($data);
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
