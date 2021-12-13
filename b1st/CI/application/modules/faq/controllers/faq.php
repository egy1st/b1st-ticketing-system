<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faq extends MX_Controller {

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
		$this->load->model('faq_model');
		$this->load->model('product/product_model');
		$this->load->model('department/department_model');
		$this->load->model('company/company_model');

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
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/faq/index';
		$config['total_rows'] = $this->faq_model->listFaqCount($options);
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
		$faqdet=$this->faq_model->listfaq($options,$perPage,$uriseg);
		$data['faqdet']=$faqdet;
		$this->load->view('faqlist',$data);
	}
	
	public function add()
	{
		$productdet=$this->product_model->allproduct();
		$data['productdet']=$productdet;
		$this->load->view('faqaddform',$data);
	}
	
	public function insert()
	{
		$product_id=$this->input->post('product_id');
		$question=$this->input->post('question');
		$answer=$this->input->post('answer');
		
		$checkunique=$this->faq_model->checkunique($product_id,$question);
		
		$this->form_validation->set_rules('product_id', 'Product Name', 'required');
		
		if(!empty($checkunique))
		{
			$this->form_validation->set_rules('question', 'Question', 'required|is_unique['.B1st_getDbPrefix().'faq.question]');
		}
		else
		{
			$this->form_validation->set_rules('question', 'Question', 'required');
		}
		
		$this->form_validation->set_rules('answer', 'Answer', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$ins=$this->faq_model->addfaq($product_id,$question,$answer,$status);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("FAQ added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/faq");
			}
		}
	}
	
	public function statuschange($faqid)
	{
		$chk=$this->faq_model->statuschange($faqid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/faq");
		}
	}
	
	public function deletefaq($faqid)
	{
		$chk=$this->faq_model->delete($faqid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("FAQ deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/faq");
		}
	}
	
	public function edit($faqid)
	{
		$productdet=$this->product_model->allproduct();
		$data['productdet']=$productdet;
		$det=$this->faq_model->getfaq($faqid);
		$data['det']=$det;
		$this->load->view('faqeditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		$question=$this->input->post('question');
		$answer=$this->input->post('answer');
		$product_id=$this->input->post('product_id');
		
		$checkunique=$this->faq_model->checkuniqueid($product_id,$question,$id);
		
		$this->form_validation->set_rules('product_id', 'Product Name', 'required');
		
		if((strtolower($this->input->post('question'))!=strtolower($this->input->post('old_question'))))
		{
			if(!empty($checkunique))
			{
				$this->form_validation->set_rules('question', 'Question', 'required|is_unique['.B1st_getDbPrefix().'faq.question]');
			}
			else
			{
				$this->form_validation->set_rules('question', 'Question', 'required');
			}
		}
		else
		{
			if(!empty($checkunique))
			{
				$this->form_validation->set_rules('question', 'Question', 'required|is_unique['.B1st_getDbPrefix().'faq.question]');
			}
			else
			{
				$this->form_validation->set_rules('question', 'Question', 'required');
			}
		}
		
		$this->form_validation->set_rules('answer', 'Answer', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		
		else
		{
			$upd=$this->faq_model->editfaq($id,$question,$answer,$product_id);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("FAQ updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again.");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/faq");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
