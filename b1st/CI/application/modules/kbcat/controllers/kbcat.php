<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kbcat extends MX_Controller {

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
		$this->load->model('kbcat_model');
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
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/kbcat/index';
		$config['total_rows'] = $this->kbcat_model->listKbcatCount($options);
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
		$kbcatdet=$this->kbcat_model->listkbcat($options,$perPage,$uriseg);
		$data['kbcatdet']=$kbcatdet;
		$this->load->view('kbcatlist',$data);
	}
	
	public function add()
	{
		$this->load->view('kbcataddform');
	}
	
	public function insert()
	{	
		$this->form_validation->set_rules('category_name', 'Knowledge Base Category Name', 'required|is_unique['.B1st_getDbPrefix().'kb_cat.category_name]');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$category_name=$this->input->post('category_name');
			$ins=$this->kbcat_model->addkbcat($category_name);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Knowledge Base Category added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/kbcat");
			}
		}
	}
	
	public function statuschange($kbcatid)
	{
		$chk=$this->kbcat_model->statuschange($kbcatid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/kbcat");
		}
	}
	
	public function deletekbcat($kbcatid)
	{
		$delchk=$this->kbcat_model->hasKnowledgebase($kbcatid);
		
		if(!empty($delchk) and $delchk!=0)
		{
			$_SESSION['ERROR_MSG']=$this->lang->line("This Knowledge Base Category cannot be deleted because already a knowledge base assigned under this");
			redirect(TICKET_PLUGIN_URL."CI/index.php/kbcat");
		}
		
		$chk=$this->kbcat_model->delete($kbcatid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Knowledge Base Category deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/kbcat");
		}
	}
	
	public function edit($kbcatid)
	{
		$det=$this->kbcat_model->getkbcat($kbcatid);
		$data['det']=$det;
		$this->load->view('kbcateditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		if(strtolower($this->input->post('category_name'))!=strtolower($this->input->post('old_category_name')))
		{
			$this->form_validation->set_rules('category_name', 'Knowledge Base Category Name', 'required|is_unique['.B1st_getDbPrefix().'kb_cat.category_name]');
		}
		else
		{
			$this->form_validation->set_rules('category_name', 'Knowledge Base Category Name', 'required');
		}
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$id=$this->input->post('id');
			$category_name=$this->input->post('category_name');
			
			$upd=$this->kbcat_model->editkbcat($id,$category_name);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Knowledge Base Category updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/kbcat");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
