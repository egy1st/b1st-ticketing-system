<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MX_Controller {

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
		$this->load->model('product_model');
		
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
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/product/index';
		$config['total_rows'] = $this->product_model->listProductCount($options);
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
		$productdet=$this->product_model->listproduct($options,$perPage,$this->uri->segment(3));
		$data['productdet']=$productdet;
		$this->load->view('productlist',$data);
	}
	
	public function add()
	{
		$this->load->view('productaddform');
	}
	
	public function insert()
	{
		$product_name=$this->input->post('product_name');
		
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique['.B1st_getDbPrefix().'product.product_name]');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$ins=$this->product_model->addproduct($product_name);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Product added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/product");
			}
		}
	}
	
	public function statuschange($productid)
	{
		$chk=$this->product_model->statuschange($productid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/product");
		}
	}
	
	public function deleteproduct($productid)
	{
		$delchk=$this->product_model->hasTicket($productid);
		
		if(!empty($delchk) and $delchk!=0)
		{
			$_SESSION['ERROR_MSG']=$this->lang->line("This Product cannot be deleted because already ticket assigned under this");
			redirect(TICKET_PLUGIN_URL."CI/index.php/product");
		}
		
		$chk=$this->product_model->delete($productid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Product deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/product");
		}
	}
	
	public function edit($productid)
	{
		$det=$this->product_model->getproduct($productid);
		$data['det']=$det;
		$this->load->view('producteditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		$product_name=$this->input->post('product_name');
		
		if(strtolower($this->input->post('product_name'))!=strtolower($this->input->post('old_product_name')))
		{
			$this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique['.B1st_getDbPrefix().'product.product_name]');
		}
		else
		{
			$this->form_validation->set_rules('product_name', 'Product Name', 'required');
		}
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$upd=$this->product_model->editproduct($id,$product_name);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Product updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again.");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/product");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */