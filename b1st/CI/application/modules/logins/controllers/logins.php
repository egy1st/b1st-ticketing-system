<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logins extends MX_Controller {

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
		$this->load->model('login_model');
		@session_start();
	}
	
	public function login()
	{
		$this->load->view('login');
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

				echo "<script>window.parent.location.href='".WPADMINURL."index.php/ticket'</script>";
			}
			else
			{
			$_SESSION['login_error'] = '<p>Invalid username/password combination</p>';
			$this->login();
			}
		}
	}

	public function logout()
	{
		$url = $_SESSION['referer_url'];
		$adminid=$_SESSION['userid'];
		$this->login_model->adminlogout($adminid);
		unset($_SESSION['userid']);
		unset($_SESSION['email']);
		//session_unset();
		session_destroy();
		echo "<script>window.location.href='".TICKET_PLUGIN_URL."CI/index.php/logins/login'</script>";
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
