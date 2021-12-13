<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class company extends MX_Controller {

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
		B1st_selectbacklanguage();
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('company_model');
	}
	
	public function index()
	{

		$ppage=$this->input->post('perpage');
		$uriseg=$this->uri->segment(3);
		if(!empty($ppage))
		{
			$_SESSION['perpage'] = $this->input->post('perpage');
			$uriseg="";
			//$this->session->set_userdata('perpage',$this->input->post('perpage'));
		}
			//$this->session->set_userdata('perpage',$this->input->post('perpage'));
		//echo $this->session->userdata('perpage');
		$noPage = @$_SESSION['perpage'];
		
		$this->load->library('pagination');

		$options = array(
			'orderBy'=> 'DESC'
		);
		
		$settings = (array)B1st_getSettingsValue('pagination');

		#pagination start
		
		$perPage =(!empty($noPage)) ? $noPage : $settings['active'];
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/company/index';
		$config['total_rows'] = $this->company_model->listCompanyCount($options);
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
		$companydet=$this->company_model->listcompany($options,$perPage,$uriseg);
		$data['companydet']=$companydet;
		$this->load->view('companylist',$data);
	}
	
	public function add()
	{
		$this->load->view('companyaddform');
	}
	
	public function insert()
	{	
		$this->form_validation->set_rules('company_name', 'Company Name', 'required|is_unique['.B1st_getDbPrefix().'company.company_name]');
		$this->form_validation->set_rules('company_website', 'Company Website', 'required|valid_url_format|is_unique['.B1st_getDbPrefix().'company.company_website]');

		$this->form_validation->set_message('required', 'Please enter %s !!');
		$this->form_validation->set_message('valid_url_format', 'Please enter a valid %s url !!');
		//$this->form_validation->set_message('url_exists', '%s url does not exists!!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$company_name=$this->input->post('company_name');
			$website = $this->input->post('company_website');

			$ins=$this->company_model->addcompany($company_name,$website);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Company added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/company");
			}
		}
	}
	
	public function statuschange($companyid)
	{
		$chk=$this->company_model->statuschange($companyid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/company");
		}
	}
	
	public function deletecompany($companyid)
	{
		$delchk=$this->company_model->hasTicket($companyid);
		
		if(!empty($delchk) and $delchk!=0)
		{
			$_SESSION['ERROR_MSG']=$this->lang->line("This Company cannot be deleted because already a ticket assigned under this");
			redirect(TICKET_PLUGIN_URL."CI/index.php/company");
		}
		
		$chk=$this->company_model->delete($companyid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Company deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/company");
		}
	}
	
	public function edit($companyid)
	{
		$det=$this->company_model->getcompany($companyid);
		$data['det']=$det;
		$this->load->view('companyeditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		if(strtolower($this->input->post('company_name'))!=strtolower($this->input->post('old_company_name')))
		{
			$this->form_validation->set_rules('company_name', 'Company Name', 'required|is_unique['.B1st_getDbPrefix().'company.company_name]');
		}
		else
		{
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		}
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$id=$this->input->post('id');
			$company_name=$this->input->post('company_name');
			
			$upd=$this->company_model->editcompany($id,$company_name);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Company updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/company");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
