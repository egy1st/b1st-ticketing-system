<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends MX_Controller {

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
		$this->load->model('users_model');

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
		#pagination start
		$settings = (array)B1st_getSettingsValue('pagination');
		#pagination start
		$perPage =(!empty($noPage)) ? $noPage : $settings['active'];
		$config['base_url'] 		= TICKET_PLUGIN_URL.'CI/index.php/users/index';
		$config['total_rows'] 		= $this->users_model->listUserCount($options);
		$config['per_page'] 		= $perPage;
		$config["uri_segment"] 		= 3;
		$config['full_tag_open']	= '<div class="pagi_box"><ul class="pagi_main">';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['next_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open']    = '<li class="no_b">';
		$config['next_tag_close']   = '</li>';
		$config['prev_link']        = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open']    = '<li>';
		$config['prev_tag_close']   = '</li>';
		$config['cur_tag_open'] 	= '<li><a class="sect" href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open']	 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        #pagination end
        $data['noPage'] = $perPage;
		$usersdet=$this->users_model->listuser($options,$perPage,$uriseg);
		$data['userdet']=$usersdet;
		$this->load->view('userlist',$data);
	}

	public function clientList()
	{
		$perpage=$this->input->post('perpage');
		if(!empty($perpage))
		{	
			$_SESSION['perpage'] = $this->input->post('perpage');
			//$this->session->set_userdata('perpage',$this->input->post('perpage'));
		}
		//echo $this->session->userdata('perpage');
	   	 $noPage = @ $_SESSION['perpage'];
		
		$this->load->library('pagination');

		$options = array(
			'orderBy'=> 'DESC'
		);
		 $where['admin'] = 0;
		 $settings = (array)B1st_getSettingsValue('pagination');
		#pagination start
		$perPage =(!empty($noPage)) ? $noPage : $settings['active'];
		$config['base_url'] 		= TICKET_PLUGIN_URL.'CI/index.php/users/index';
		$config['total_rows'] 		= $this->users_model->listUserCount($options,$where);
		$config['per_page'] 		= $perPage;
		$config["uri_segment"] 		= 3;
		$config['full_tag_open']	= '<div class="pagi_box"><ul class="pagi_main">';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['next_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open']    = '<li class="no_b">';
		$config['next_tag_close']   = '</li>';
		$config['prev_link']        = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open']    = '<li>';
		$config['prev_tag_close']   = '</li>';
		$config['cur_tag_open'] 	= '<li><a class="sect" href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open']	 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        #pagination end
        $data['noPage'] = $perPage;
       
		$usersdet=$this->users_model->listuser($options,$perPage,$this->uri->segment(3),$where);
		$data['userdet']=$usersdet;
		$this->load->view('clientuserlist',$data);
	}

	public function add()
	{
		$this->load->view('useraddform');
	}

	public function insert()
	{

		$this->form_validation->set_rules('username', 'Username', 'required|is_unique['.B1st_getDbPrefix().'ticket_users.username]');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'numeric|is_unique['.B1st_getDbPrefix().'ticket_users.mobile]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Password', 'matches[password]');
		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique['.B1st_getDbPrefix().'ticket_users.email]');
		$this->form_validation->set_rules('privilege_group_id', 'User Group', 'required');

		$this->form_validation->set_message('is_unique', '%s already exists !!');
		$this->form_validation->set_message('required', 'Please enter %s !!');
		$this->form_validation->set_message('valid_email', 'Please enter a valid email address !!');
		$this->form_validation->set_message('matches', 'Password did not match !!');

		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{

		$data['username'] = $this->input->post('username');
		$data['firstname'] = $this->input->post('firstname');
		$data['lastname'] = $this->input->post('lastname');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile');
		$data['admin'] = 1;
		$data['creation_date'] = date('Y-m-d H:i:s');
		$data['modified_date'] = date('Y-m-d H:i:s');
		$data['password'] = $this->dibyariaz_encrypt->encode($this->input->post('password'));
		$data['privilege_group_id'] = $this->input->post('privilege_group_id');

		$r = $this->users_model->insert($data);
		if(!empty($r))
		{
			$_SESSION['SUCCESS_MSG']="User added successfully";
			redirect(TICKET_PLUGIN_URL."CI/index.php/users/index");
		}
	  }
	}

	public function statuschange($id)
	{
		$chk=$this->users_model->statuschange($id);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']="Status changed successfully";
			redirect(TICKET_PLUGIN_URL."CI/index.php/users");
		}
	}

	public function deleteuser($id)
	{
		$con=$this->users_model->checkassignment($id);
		if(!empty($con))
		{
			$_SESSION['ERROR_MSG']="This user cannot be deleted beacuse already ticket assigned";
			redirect(TICKET_PLUGIN_URL."CI/index.php/users");
		}
		$chk=$this->users_model->delete($id);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']="User deleted successfully";
			redirect(TICKET_PLUGIN_URL."CI/index.php/users");
		}
	}

	public function edit($id)
	{
		$data['id'] = $id;
		$det=$this->users_model->getuser($data);
		$data['det']=$det;
		$this->load->view('usereditform',$data);
	}

	public function update()
	{
		if(strtolower($this->input->post('username')) != strtolower($this->input->post('old_username')))
		{
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique['.B1st_getDbPrefix().'ticket_users.username]');
		}
		if(strtolower($this->input->post('mobile')) != strtolower($this->input->post('old_mobile')))
		{
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'numeric|is_unique['.B1st_getDbPrefix().'ticket_users.mobile]');
		}
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Password', 'matches[password]');
		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
		if($this->input->post('email') != $this->input->post('old_email'))
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique['.B1st_getDbPrefix().'ticket_users.email]');
		}
		$this->form_validation->set_rules('privilege_group_id', 'User Group', 'required');

		$this->form_validation->set_message('is_unique', '%s already exists !!');
		$this->form_validation->set_message('required', 'Please enter %s !!');
		$this->form_validation->set_message('valid_email', 'Please enter a valid email address !!');
		$this->form_validation->set_message('matches', 'Password did not match !!');

		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}
		else
		{
			$data['username'] = $this->input->post('username');
			$data['firstname'] = $this->input->post('firstname');
			$data['lastname'] = $this->input->post('lastname');
			$data['email'] = $this->input->post('email');
			$data['mobile'] = $this->input->post('mobile');
			$data['password'] = $this->dibyariaz_encrypt->encode($this->input->post('password'));
			$data['privilege_group_id'] = $this->input->post('privilege_group_id');
			$data['modified_date'] = date('Y-m-d H:i:s');

			$where['id'] = $this->input->post('id');
			$r = $this->users_model->update($data,$where);
			
			if(!empty($r))
			{
				$_SESSION['SUCCESS_MSG']="User updated successfully";
			}
			else
			{
				$_SESSION['ERROR_MSG']="Something went wrong! Please try again.";
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/users/index");
	   }
	}

	public function checkusername()
	{
		$return['status']= 'NO';
		$return['msg']= 'Username already exists !';
		$username =$this->input->post('username');
		$data['username'] = $username;
		$r = $this->users_model->checkusername($data);
		if($r)
		{
			$return['status']= 'OK';
			$return['msg']= 'valid !';
		}

		echo json_encode($return);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
