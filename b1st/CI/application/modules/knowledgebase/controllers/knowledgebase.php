<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class knowledgebase extends MX_Controller {

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
		$this->load->model('knowledgebase_model');
		$this->load->model('kbcat/kbcat_model');
		$this->load->model('product/product_model');
	}
	
	public function index()
	{
		
		$category_id=$this->input->get('category_id');
		$product_id=$this->input->get('product_id');
		$topic=$this->input->get('topic');
		
		$data['category_id']=$category_id;
		$data['product_id']=$product_id;
		$data['topic']=$topic;

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
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/knowledgebase/index';
		$config['total_rows'] = $this->knowledgebase_model->listKnowledgebaseCount($options);
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
		$knowledgebasedet=$this->knowledgebase_model->listknowledgebase($options,$perPage,$uriseg);
		$data['knowledgebasedet']=$knowledgebasedet;
		
		$data['catdet']=$this->kbcat_model->allkbcat();
		$data['productdet']=$this->product_model->allproduct();
		
		$this->load->view('knowledgebaselist',$data);
	}
	
	public function add()
	{
		$data['catdet']=$this->kbcat_model->allkbcat();
		$data['productdet']=$this->product_model->allproduct();
		$this->load->view('knowledgebaseaddform',$data);
	}
	
	public function insert()
	{
		$topic=$this->input->post('topic');
		$content=$this->input->post('content');
		$category_id=$this->input->post('category_id');
		$product_id=$this->input->post('product_id');
			
		$checkunique=$this->knowledgebase_model->checktopicunique($category_id,$product_id,$topic);
		
		if(!empty($checkunique))
		{
			$this->form_validation->set_rules('topic', 'Topic', 'required|is_unique['.B1st_getDbPrefix().'knowledgebasemod.topic]');
		}
		else
		{
			$this->form_validation->set_rules('topic', 'Topic', 'required');
		}
		
		$this->form_validation->set_rules('content', 'Content', 'required');
		
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$ins=$this->knowledgebase_model->addknowledgebase($topic,$content,$category_id,$product_id);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Knowledge Base added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/knowledgebase");
			}
		}
	}
	
	public function statuschange($knowledgebaseid)
	{
		$chk=$this->knowledgebase_model->statuschange($knowledgebaseid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/knowledgebase");
		}
	}
	
	public function deleteknowledgebase($knowledgebaseid)
	{	
		$chk=$this->knowledgebase_model->delete($knowledgebaseid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Knowledge Base deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/knowledgebase");
		}
	}
	
	public function edit($knowledgebaseid)
	{
		$det=$this->knowledgebase_model->getknowledgebase($knowledgebaseid);
		$data['det']=$det;
		$data['catdet']=$this->kbcat_model->allkbcat();
		$data['productdet']=$this->product_model->allproduct();
		$this->load->view('knowledgebaseeditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		$topic=$this->input->post('topic');
		$content=$this->input->post('content');
		$category_id=$this->input->post('category_id');
		$product_id=$this->input->post('product_id');
		
		$checkunique=$this->knowledgebase_model->checktopicuniqueid($category_id,$product_id,$topic,$id);
		
		//if((strtolower($this->input->post('topic'))!=strtolower($this->input->post('old_topic'))))
		//{
			if(!empty($checkunique))
			{
				$this->form_validation->set_rules('topic', 'Topic', 'required|is_unique['.B1st_getDbPrefix().'knowledgebasemod.topic]');
			}
			else
			{
				$this->form_validation->set_rules('topic', 'Topic', 'required');
			}
		//}
		//else
		//{
			//if(!empty($checkunique))
			//{
				//$this->form_validation->set_rules('topic', 'Topic', 'required|is_unique['.B1st_getDbPrefix().'knowledgebasemod.topic]');
			//}
			//else
			//{
				//$this->form_validation->set_rules('topic', 'Topic', 'required');
			//}
		//}
		
		$this->form_validation->set_rules('content', 'Content', 'required');
		
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$id=$this->input->post('id');
			
			$upd=$this->knowledgebase_model->editknowledgebase($id,$topic,$content,$category_id,$product_id);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Knowledge Base updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/knowledgebase");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
