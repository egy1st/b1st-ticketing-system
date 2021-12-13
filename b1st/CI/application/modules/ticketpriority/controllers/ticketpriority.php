<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ticketpriority extends MX_Controller {

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
		$this->load->model('ticketpriority_model');
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
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/ticketpriority/index';
		$config['total_rows'] = $this->ticketpriority_model->listPriorityCount($options);
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
		$prioritydet=$this->ticketpriority_model->listpriority($options,$perPage,$uriseg);
		$data['prioritydet']=$prioritydet;
		$this->load->view('prioritylist',$data);
	}
	
	public function add()
	{
		$this->load->view('priorityaddform');
	}
	
	public function insert()
	{
		$priority_name=$this->input->post('priority_name');
		$priority_color=$this->input->post('priority_color');

		$data['priority_name'] = $priority_name;
		$data['priority_color'] = $priority_color;
		
		$this->form_validation->set_rules('priority_name', 'Priority Name', 'required|is_unique['.B1st_getDbPrefix().'ticket_priority.priority_name]');
		
		$this->form_validation->set_rules('priority_color', 'Priority color', 'required|is_unique['.B1st_getDbPrefix().'ticket_priority.priority_color]|color_check');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		$this->form_validation->set_message('color_check', 'Invalid %s');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$ins=$this->ticketpriority_model->addpriority($data);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Priority added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/ticketpriority");
			}
		}
	}
	
	public function statuschange($priorityid)
	{
		$chk=$this->ticketpriority_model->statuschange($priorityid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticketpriority");
		}
	}
	
	public function deletepriority($priorityid)
	{
		$delchk=$this->ticketpriority_model->hasTicket($priorityid);
		//echo $delchk;die;
		if(!empty($delchk) and $delchk!=0)
		{
			$_SESSION['ERROR_MSG']=$this->lang->line("This priority can not be deleted. Because ticket already assigned under this");
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticketpriority");
		}
		$chk=$this->ticketpriority_model->delete($priorityid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Priority deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticketpriority");
		}
	}
	
	public function edit($companyid)
	{
		$det=$this->ticketpriority_model->getpriority($companyid);
		$data['det']=$det;
		$this->load->view('priorityeditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		$priority_name=$this->input->post('priority_name');
		$priority_color=$this->input->post('priority_color');

		$data['priority_name'] = $priority_name;
		$data['priority_color'] = $priority_color;
		$where['id'] = $id;
		
		if(strtolower($this->input->post('priority_name'))!=strtolower($this->input->post('old_priority_name')))
		{
			$this->form_validation->set_rules('priority_name', 'Priority Name', 'required|is_unique['.B1st_getDbPrefix().'ticket_priority.priority_name]');
		}
		else
		{
			$this->form_validation->set_rules('priority_name', 'Priority Name', 'required');
		}
		
		if($this->input->post('priority_color')!=$this->input->post('old_priority_color'))
		{
			$this->form_validation->set_rules('priority_color', 'Priority color', 'required|is_unique['.B1st_getDbPrefix().'ticket_priority.priority_color]|color_check');
		}
		else
		{
			$this->form_validation->set_rules('priority_color', 'Priority color', 'required|color_check');
		}
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		$this->form_validation->set_message('color_check', 'Invalid %s');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$upd=$this->ticketpriority_model->editpriority($data,$where);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Priority updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again.");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticketpriority");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
