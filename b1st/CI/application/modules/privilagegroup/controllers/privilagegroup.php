<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class privilagegroup extends MX_Controller {

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
		$this->load->model('privilagegroup_model');
		$this->load->model('privilages_model');
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
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/privilagegroup/index';
		$config['total_rows'] = $this->privilagegroup_model->listPrivilagegroupCount($options);
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
		$companydet=$this->privilagegroup_model->listPrivilagegroup($options,$perPage,$uriseg);
		$data['companydet']=$companydet;
		$this->load->view('privilagegrouplist',$data);
	}
	
	public function add()
	{

		$this->load->view('privilagegroupaddform');
	}
	
	public function insert()
	{
		
		$data['privilege_name'] = $this->input->post('privilagegroup_name');
		$data['description'] = $this->input->post('description');
		$data['privileges'] = json_encode($this->input->post('privilages'));
		
		$this->form_validation->set_rules('privilagegroup_name', 'Privilege Group Name', 'required|is_unique['.B1st_getDbPrefix().'privilege_group.privilege_name]');
		
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		$this->form_validation->set_rules('privilages', 'Privileges', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$ins=$this->privilagegroup_model->addprivilagegroup($data);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']="Privilege Group added successfully";
				redirect(TICKET_PLUGIN_URL."CI/index.php/privilagegroup");
			}
		}
	}
	
	public function statuschange($privilagegroupid)
	{
		$chk=$this->privilagegroup_model->statuschange($privilagegroupid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']="Status changed successfully";
			redirect(TICKET_PLUGIN_URL."CI/index.php/privilagegroup");
		}
	}
	
	public function deleteprivilagegroup($privilagegroupid)
	{
		$delchk=$this->privilagegroup_model->haveUser($privilagegroupid);
		if(!empty($delchk) and $delchk!=0)
		{
			$_SESSION['ERROR_MSG']="This Privilege Group cannot be deleted because already user assigned under this";
			redirect(TICKET_PLUGIN_URL."CI/index.php/privilagegroup");
		}
		$chk=$this->privilagegroup_model->delete($privilagegroupid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']="Privilege Group deleted successfully";
			redirect(TICKET_PLUGIN_URL."CI/index.php/privilagegroup");
		}
	}
	
	public function edit($privilagegroupid)
	{
		$det=$this->privilagegroup_model->getprivilagegroup($privilagegroupid);
		$data['det']=$det;
		$this->load->view('privilagegroupeditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		$where['id']=$id;
		
		$data['privilege_name'] = $this->input->post('privilagegroup_name');
		$data['description'] = $this->input->post('description');
		$data['privileges'] = json_encode($this->input->post('privilages'));
		
		if(strtolower($this->input->post('privilagegroup_name'))!=strtolower($this->input->post('old_privilagegroup_name')))
		{
			$this->form_validation->set_rules('privilagegroup_name', 'Privilege Group Name', 'required|is_unique['.B1st_getDbPrefix().'privilege_group.privilege_name]');
		}
		else
		{
			$this->form_validation->set_rules('privilagegroup_name', 'Privilege Group Name', 'required');
		}
		
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		$this->form_validation->set_rules('privilages', 'Privileges', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$upd=$this->privilagegroup_model->editprivilagegroup($data,$where);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']="Privilege Group updated successfully";
			}
			else
			{
				$_SESSION['ERROR_MSG']="Something went wrong! Please try again.";
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/privilagegroup");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
