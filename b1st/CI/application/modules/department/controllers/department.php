<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class department extends MX_Controller {

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
		$this->load->model('department_model');
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
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/department/index';
		$config['total_rows'] = $this->department_model->listDepartmentCount($options);
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
		$departmentdet=$this->department_model->listdepartment($options,$perPage,$uriseg);
		$data['departmentdet']=$departmentdet;
		$this->load->view('departmentlist',$data);
	}
	
	public function add()
	{
		$this->load->view('departmentaddform');
	}
	
	public function insert()
	{
		$department_name=$this->input->post('department_name');
		$this->form_validation->set_rules('department_name', 'Department Name', 'required|is_unique['.B1st_getDbPrefix().'department.department_name]');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$ins=$this->department_model->adddepartment($department_name);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Department added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/department");
			}
		}
	}
	
	public function statuschange($departmentid)
	{
		$chk=$this->department_model->statuschange($departmentid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/department");
		}
	}
	
	public function deletedepartment($departmentid)
	{
		$delchk=$this->department_model->hasTicket($departmentid);
		
		if(!empty($delchk) and $delchk!=0)
		{
			$_SESSION['ERROR_MSG']=$this->lang->line("This Department cannot be deleted because ticket already assigned under this");
			redirect(TICKET_PLUGIN_URL."CI/index.php/department");
		}
		
		$chk=$this->department_model->delete($departmentid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Department deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/department");
		}
	}
	
	public function edit($departmentid)
	{
		$det=$this->department_model->getdepartment($departmentid);
		$data['det']=$det;
		$this->load->view('departmenteditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		
		$department_name=$this->input->post('department_name');
		
		if(strtolower($this->input->post('department_name'))!=strtolower($this->input->post('old_department_name')))
		{
			$this->form_validation->set_rules('department_name', 'Department Name', 'required|is_unique['.B1st_getDbPrefix().'department.department_name]');
		}
		else
		{
			$this->form_validation->set_rules('department_name', 'Department Name', 'required');
		}
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$upd=$this->department_model->editdepartment($id,$department_name);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Department updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/department");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
