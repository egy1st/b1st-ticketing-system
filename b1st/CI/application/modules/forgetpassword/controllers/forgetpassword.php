<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class forgetpassword extends MX_Controller {

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
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('forgetpassword_model');
		@session_start();
	}
	
	public function index()
	{
		$this->load->view('forgetpassword');
	}

	public function checkuser()
	{
		$unname = $this->input->post('username');
		if($unname === $_SESSION['username'])
		{
			$data['status'] = 1;
			$data['msg'] = '';
		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = '<p>Enter Your Username !!</p>';
		}

		echo json_encode($data);
	}

	public function changepassword()
	{
		$pass = $this->input->post('npassword');
		$cpass = $this->input->post('cpassword');
		if($pass == $cpass)
		{
			$udata['password'] = $this->dibyariaz_encrypt->encode($pass);
			$where['id'] = $_SESSION['userid'];

			if($this->forgetpassword_model->changepassword($udata,$where))
			{
				$data['status'] = 1;
			$data['msg'] = '
			    <div class="isa_success" style="width: 80%;">
         			Password changed successfully !!
    			</div>';
			}
			else
			{
				$data['status'] = 0;
			$data['msg'] = '
			    <div class="isa_error" style="width: 80%;">
         			Error changing password !!
    			</div>';
			}
		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = '
			    <div class="isa_error" style="width: 80%;">
         			Password did not match !!
    			</div>';
		}

		echo json_encode($data);
	}

	public function dologin()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->login();
		}
		else
		{
			$data['username'] = $this->input->post('username');
			$data['admin'] = 1;
			$data['status'] = 1;
			//$data['password'] = $this->dibyariaz_encrypt->encode($this->input->post('password'));
			
			$l = $this->login_model->login($data);
			//echo "<pre>";
			//print_r($l);
			//echo "</pre>";die;
			if(!empty($l))
			{
				$_SESSION['userid'] = $l[0]->id;
				$_SESSION['username'] = $l[0]->username;
				$_SESSION['email'] = $l[0]->email;
				$_SESSION['name'] = $l[0]->firstname." ".$l[0]->lastname;
				$_SESSION['privilege_group_id'] = $l[0]->privilege_group_id;

				echo "<script>window.parent.location.href='".WPADMINURL."index.php?page=b1st-ticket'</script>";
			}
			else
			{
			$_SESSION['login_error'] = '<p>Invalid username/password combination</p>';
			$this->login();
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
