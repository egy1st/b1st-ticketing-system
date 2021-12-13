<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class assignticket extends MX_Controller {

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
		$this->load->helper('download');
		$this->load->model('assignticket_model');
		$this->load->model('users/users_model');
		$this->load->model('product/product_model');
		$this->load->model('department/department_model');
		$this->load->model('company/company_model');
		$this->load->model('ticketpriority/ticketpriority_model');
		
	}
	
	public function index()
	{
		if(!($this->input->post('ticket_id')))
		{
			$ticketid=$this->input->post('ticket_id');
		}
		
		if(!($this->input->post('email')))
		{
			$email=$this->input->post('email');
		}
		
		if(!($this->input->post('text_part')))
		{
			$text_part=$this->input->post('text_part');
		}
		
		if(!($this->input->post('priority')))
		{
			$priority=$this->input->post('priority');
		}
		
		if(!($this->input->post('department')))
		{
			$department=$this->input->post('department');
		}
		
		if(!($this->input->post('product')))
		{
			$product=$this->input->post('product');
		}
		
		if(!($this->input->post('state')))
		{
			$state=$this->input->post('state');
		}
		
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
		
		if(!empty($ticketid))
		{
			$options['ticketid']=$ticketid;
			$data['searchticketid']=$ticketid;
		}
		
		if(!empty($email))
		{
			$options['email']=$email;
			$data['searchemail']=$email;
		}
		
		if(!empty($text_part))
		{
			$options['text_part']=$text_part;
			$data['search_text_part']=$text_part;
		}
		
		if(!empty($priority))
		{
			$options['priority']=$priority;
			$data['search_priority']=$priority;
		}
		
		if(!empty($department))
		{
			$options['department']=$department;
			$data['search_department']=$department;
		}
		
		if(!empty($product))
		{
			$options['product']=$product;
			$data['search_product']=$product;
		}
		
		if(!empty($state))
		{
			$options['state']=$state;
			$data['search_state']=$state;
		}
		
		 $settings = (array)B1st_getSettingsValue('pagination');

		#pagination start
		
		$perPage =(!empty($noPage)) ? $noPage : $settings['active'];
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/ticket/index';
		$config['total_rows'] = $this->ticket_model->listTicketCount($options);
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
		$config['cur_tag_open'] = '<li><a class="sect" href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        #pagination end
        $data['noPage'] = $perPage;
		$ticketdet=$this->ticket_model->listticket($options,$perPage,$uriseg);
		$data['ticketdet']=$ticketdet;
		$data['users'] = $this->users_model->getAllAdmin();
		$this->load->view('ticketlist',$data);
	}

	public function transferTicket()
	{
		if(!($this->input->post('ticket_id')))
		{
			$ticketid=$this->input->post('ticket_id');
		}
		
		if(!($this->input->post('email')))
		{
			$email=$this->input->post('email');
		}
		
		if(!($this->input->post('text_part')))
		{
			$text_part=$this->input->post('text_part');
		}
		
		if(!($this->input->post('priority')))
		{
			$priority=$this->input->post('priority');
		}
		
		if(!($this->input->post('department')))
		{
			$department=$this->input->post('department');
		}
		
		if(!($this->input->post('product')))
		{
			$product=$this->input->post('product');
		}
		
		if(!($this->input->post('state')))
		{
			$state=$this->input->post('state');
		}
		
		
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
		
		if(!empty($ticketid))
		{
			$options['ticketid']=$ticketid;
			$data['searchticketid']=$ticketid;
		}
		
		if(!empty($email))
		{
			$options['email']=$email;
			$data['searchemail']=$email;
		}
		
		if(!empty($text_part))
		{
			$options['text_part']=$text_part;
			$data['search_text_part']=$text_part;
		}
		
		if(!empty($priority))
		{
			$options['priority']=$priority;
			$data['search_priority']=$priority;
		}
		
		if(!empty($department))
		{
			$options['department']=$department;
			$data['search_department']=$department;
		}
		
		if(!empty($product))
		{
			$options['product']=$product;
			$data['search_product']=$product;
		}
		
		if(!empty($state))
		{
			$options['state']=$state;
			$data['search_state']=$state;
		}
		
		 $settings = (array)B1st_getSettingsValue('pagination');

		#pagination start
		
		$perPage =(!empty($noPage)) ? $noPage : $settings['active'];
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/ticket/index';
		$config['total_rows'] = $this->ticket_model->listTicketCount($options);
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
		$config['cur_tag_open'] = '<li><a class="sect" href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		#pagination end
		$data['noPage'] = $perPage;
		$ticketdet=$this->ticket_model->listticket($options,$perPage,$uriseg);
		$data['ticketdet']=$ticketdet;
		$data['users'] = $this->users_model->getAllAdmin();
		$this->load->view('tickettransfer',$data);
	}


	public function ticketassign()
	{
		$data['admin_id'] = $this->input->post('admin_id');
		$data['ticket_id'] = $this->input->post('ticket_id');
		$check = $this->assignticket_model->B1st_checkTicketAssignment($data['ticket_id']);
		if($check)
		{
			$r = $this->assignticket_model->assignTicket($data);
			if($r)
			{
				$user = B1st_getUserInfoById($data['admin_id'] );
				$useremail=$user->email;
				
				$ticket=$this->ticket_model->getticket($data['ticket_id']);
				
				$ticket_name=$ticket->ticket_no;
				
				//$adminemail=B1st_getSettingsValue('adminemail');
				//$adminemail=$adminemail->email;
		$tsemail=B1st_getSettingsValue('tsemail');
		$tsemail=$tsemail->email;				
				
				$messagebody="<strong>Ticket Assignment : </strong><br>";
				$messagebody.="You have been assigned to the ticket number ".$ticket_name." by superadmin of Ticketing System. For further queries please contact with superadmin";
				
				B1st_sendmail($useremail,"","","Ticketing System : Ticket Number ".$ticket_name." has been assigned",$messagebody,$tsemail);

				$_SESSION['SUCCESS_MSG']= "Ticket No. <strong>{$ticket->ticket_no}</strong> assigned successfully to <strong>{$user->username}</strong>";
			}
		}
		else
		{
			$ndata['ticket_id'] = $data['ticket_id'];
			$info = $this->assignticket_model->getassigninfo($ndata);

			if(is_array($info))
			{
				$user = B1st_getUserInfoById($info[0]->admin_id);
				$ticket=$this->ticket_model->getticket($info[0]->ticket_id);
			}
			else
			{
				$user = B1st_getUserInfoById($info->admin_id);
				$ticket=$this->ticket_model->getticket($info->ticket_id);
			}
			$_SESSION['ERROR_MSG']= "Ticket No. <strong>{$ticket->ticket_no}</strong> already assigned to <strong>{$user->username}</strong>";
		}
		redirect(TICKET_PLUGIN_URL."CI/index.php/assignticket");
	}

	public function multiticketassign()
	{
		$data['admin_id'] = $this->input->post('admin_id');
		$tickets_str = $this->input->post('mticket_id');
		$tickets_arr = explode(',',$tickets_str);
		
		$tsemail=B1st_getSettingsValue('tsemail');
		$tsemail=$tsemail->email;

		foreach($tickets_arr as $ticket)
		{
			$data['ticket_id'] = $ticket;
			$check = $this->assignticket_model->B1st_checkTicketAssignment($data['ticket_id']);
			if($check)
			{
				$r = $this->assignticket_model->assignTicket($data);
				if($r)
				{
					$user = B1st_getUserInfoById($data['admin_id'] );
					$useremail=$user->email;
					$ticket=$this->ticket_model->getticket($data['ticket_id']);
					$ticket_name=$ticket->ticket_no;
					
					$messagebody="<strong>Ticket Assignment : </strong><br>";
					$messagebody.="You have been assigned to the ticket number ".$ticket_name." by superadmin of Ticketing System. For further queries please contact with superadmin";
				
					B1st_sendmail($useremail,"","","Ticketing System : Ticket Number ".$ticket_name." has been assigned",$messagebody,$tsemail);

					if(isset($_SESSION['SUCCESS_MSG']))
					{
					$_SESSION['SUCCESS_MSG'] .= "Ticket No. <strong>{$ticket->ticket_no}</strong> assigned successfully to <strong>{$user->username}</strong><br>";
					}
					else
					{
					   $_SESSION['SUCCESS_MSG'] = "Ticket No. <strong>{$ticket->ticket_no}</strong> assigned successfully to <strong>{$user->username}</strong><br>";
					}
				}
			}
			else
			{
				$ndata['ticket_id'] = $data['ticket_id'];
				$info = $this->assignticket_model->getassigninfo($ndata);
				$user = B1st_getUserInfoById($info->admin_id);
				$ticket=$this->ticket_model->getticket($info->ticket_id);

				if(isset($_SESSION['ERROR_MSG']))
				{
				$_SESSION['ERROR_MSG'] .= "Ticket No. <strong>{$ticket->ticket_no}</strong> already assigned to <strong>{$user->username}</strong><br>";
				}
				else
				{
					$_SESSION['ERROR_MSG'] = "Ticket No. <strong>{$ticket->ticket_no}</strong> already assigned to <strong>{$user->username}</strong><br>";
				}
			}
		}
		
		redirect(TICKET_PLUGIN_URL."CI/index.php/assignticket");
	}

	public function tickettransfer()
	{
		$data['admin_id'] = $this->input->post('admin_id');
		$data['ticket_id'] = $this->input->post('ticket_id');
		$check = $this->assignticket_model->B1st_checkTicketAssignment($data['ticket_id']);

		$tsemail=B1st_getSettingsValue('tsemail');
		$tsemail=$tsemail->email;

		if(!$check)
		{
			$ndata['ticket_id'] = $data['ticket_id'];
			$info = $this->assignticket_model->getassigninfo($ndata);

			$user_old = B1st_getUserInfoById($info->admin_id);
			//$ticket=$this->ticket_model->getticket($info[0]->ticket_id);

			$r = $this->assignticket_model->transferTicketTo($data['ticket_id'],$data['admin_id']);
			if($r)
			{
				$user = B1st_getUserInfoById($data['admin_id'] );
				$useremail=$user->email;
				$ticket=$this->ticket_model->getticket($data['ticket_id']);
				$ticket_name=$ticket->ticket_no;
				
				$messagebody="<strong>Ticket Transfer : </strong><br>";
				$messagebody.="You have been transferred to the ticket number ".$ticket_name." by superadmin of Ticketing System. For further queries please contact with superadmin";
				
				B1st_sendmail($useremail,"","","Ticketing System : Ticket Number ".$ticket_name." has been transferred",$messagebody,$tsemail);

				$_SESSION['SUCCESS_MSG']= "Ticket No. <strong>{$ticket->ticket_no}</strong> transfered successfully from <strong>{$user_old->username}</strong> to <strong>{$user->username}</strong>";
			}
		}

		redirect(TICKET_PLUGIN_URL."CI/index.php/assignticket/transferTicket");
	}

	public function multitickettransfer()
	{
		$data['admin_id'] = $this->input->post('admin_id');
		$tickets_str = $this->input->post('mticket_id');
		$tickets_arr = explode(',',$tickets_str);
		
				$tsemail=B1st_getSettingsValue('tsemail');
		$tsemail=$tsemail->email;

		foreach($tickets_arr as $ticket)
		{
			$data['ticket_id'] = $ticket;
			$check = $this->assignticket_model->B1st_checkTicketAssignment($data['ticket_id']);
			if(!$check)
			{
				$ndata['ticket_id'] = $data['ticket_id'];
				$info = $this->assignticket_model->getassigninfo($ndata);

			$user_old = B1st_getUserInfoById($info->admin_id);
			//$ticket=$this->ticket_model->getticket($info[0]->ticket_id);

			$r = $this->assignticket_model->transferTicketTo($data['ticket_id'],$data['admin_id']);
				if($r)
				{
					$user = B1st_getUserInfoById($data['admin_id'] );
					$useremail=$user->email;
					$ticket=$this->ticket_model->getticket($data['ticket_id']);
					$ticket_name=$ticket->ticket_no;
					
					$messagebody="<strong>Ticket Transfer : </strong><br>";
					$messagebody.="You have been transferred to the ticket number ".$ticket_name." by superadmin of Ticketing System. For further queries please contact with superadmin";
					
					B1st_sendmail($useremail,"","","Ticketing System : Ticket Number ".$ticket_name." has been transferred",$messagebody,$tsemail);

					if(isset($_SESSION['SUCCESS_MSG']))
					{
					$_SESSION['SUCCESS_MSG'] .= "Ticket No. <strong>{$ticket->ticket_no}</strong> transfered successfully from <strong>{$user_old->username}</strong> to <strong>{$user->username}</strong><br>";
					}
					else
					{
					   $_SESSION['SUCCESS_MSG'] = "Ticket No. <strong>{$ticket->ticket_no}</strong> transfered successfully from <strong>{$user_old->username}</strong> to <strong>{$user->username}</strong><br>";
					}
				}
			}
		}
		redirect(TICKET_PLUGIN_URL."CI/index.php/assignticket/transferTicket");
	}

	
	public function add()
	{
		$productdet=$this->product_model->allproduct();
		$data['productdet']=$productdet;
		$companydet=$this->company_model->allcompany();
		$data['companydet']=$companydet;
		$departmentdet=$this->department_model->alldepartment();
		$data['departmentdet']=$departmentdet;
		$prioritydet=$this->ticketpriority_model->allpriority();
		$data['prioritydet']=$prioritydet;
		$this->load->view('ticketaddform',$data);
	}
	
	public function insert()
	{
		$ticke_post_type = $this->input->post('front_post');
		if($ticke_post_type)
		{

		$this->form_validation->set_rules('ticket_no', 'Ticket No.', 'required');
		$this->form_validation->set_rules('front_post', 'Url', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');
		$this->form_validation->set_rules('department_id', 'Department', 'required');
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		$this->form_validation->set_rules('customer', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('priorty', 'Priority', 'required');
		$this->form_validation->set_rules('query', 'Query', 'required');

		$this->form_validation->set_message('required', 'Please enter %s !!');
		$this->form_validation->set_message('valid_email', 'Please enter a valid email address !!');

		if ($this->form_validation->run() == FALSE)
		{
			$_SESSION['message'] = validation_errors();
			//redirect($ticke_post_type);
			redirect(TICKET_PLUGIN_URL."CI/index.php/register/postTicket");		
		}
		else
		{
		/***********************frontend ticket submit******************************/
		$ticket_name=$this->input->post('ticket_no');
		$userid = $_SESSION['c_userid'];
		$subject=$this->input->post('subject');
		$customer=$this->input->post('customer');
		$department_id=$this->input->post('department_id');
		$product_id=$this->input->post('product_id');
		$company_id=$this->input->post('company_id');
		$priorty=$this->input->post('priorty');
		$query=$this->input->post('query');
		
		$tempfiles=$this->input->post('files');
		
		$attachmentpath= APPPATH.'../assets/attachments/';
		
		if(!empty($_FILES['fileupload']))
		{
			$file=$_FILES;
			
			$counter=count($_FILES['fileupload']['name']);
			$this->load->library('upload');
			
			$sessionid=$this->session->userdata['session_id'];
			
			
			for($i=0;$i<$counter;$i++)
			{
				$filename=$file['fileupload']['name'][$i];
				
				$imarr=explode(".",$filename);
				
				$ext=end($imarr);
				
				$_FILES['fileupload']['name']=$file['fileupload']['name'][$i];
				$_FILES['fileupload']['type']=$file['fileupload']['type'][$i];
				$_FILES['fileupload']['tmp_name']=$file['fileupload']['tmp_name'][$i];
				$_FILES['fileupload']['error']=$file['fileupload']['error'][$i];
				$_FILES['fileupload']['size']=$file['fileupload']['size'][$i];
				
				//if(in_array($ext,$allowedfiles))
				//{
					//$newfilename=time().".".$ext;
					//$mov=move_uploaded_file($filetmpname,$attachmentpath.$newfilename);
					//if(!empty($mov))
					//{
						//$res=$this->home_model->uploadAttachmentTemp($newfilename);
					//}
				//}
				
				$guid=B1st_create_guid();
				$guid=substr($guid,0,16);
				
				
				$config = array(
					'file_name' => $guid.".".$ext,
					'allowed_types' => 'jpg|jpeg|gif|png|doc|pdf',
					'upload_path' => APPPATH.'../assets/attachments',
					'max_size' => 2000
				);
				
				$this->upload->initialize($config);
				
				if (!$this->upload->do_upload('fileupload')) {
					 // return the error message and kill the script
					echo $this->upload->display_errors(); die();
				}
				else
				{
					$flag=1;
					$image_data = $this->upload->data();
					$upName=$image_data['file_name'];
				
					//$config = array(
						//'source_image' => $image_data['full_path'],
						//'new_image' => $this->new_gallery_path . '/thumbs',
						//'maintain_ration' => true,
						//'width' => 100,
						//'height' => 100
					//);
				
					//$this->load->library('image_lib', $config);
					//$this->image_lib->resize();
					
					$imagename=$image_data['file_name'];
					
					$this->ticket_model->uploadAttachmentTemp($imagename,$sessionid);
					
				}
				
				
				
				
			}
			$filedet=$this->ticket_model->showfilename($sessionid);
			$data['filedet']=$filedet;
			$this->load->view('tempfile',$data);
			return;
		}
		
		$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$query);
		if(!empty($ins))
		{
			if(!empty($tempfiles))
			{
				foreach($tempfiles as $val)
				{
					$getupd=$this->ticket_model->insndel($ins,$val);
				}
			}
			$_SESSION['message'] = "<strong>Ticket No. : ".$ticket_name."<br>We will get back to your query soon !!</strong>";
			//redirect($ticke_post_type);
			redirect(TICKET_PLUGIN_URL."CI/index.php/register/postTicket");	
			
		}

		/***********************frontend ticket submit******************************/
		}

			
		}

		$ticket_name=$this->input->post('ticket_no');
		$userid = $_SESSION['userid'];
		$subject=$this->input->post('subject');
		$customer=$this->input->post('customer');
		$department_id=$this->input->post('department_id');
		$product_id=$this->input->post('product_id');
		$company_id=$this->input->post('company_id');
		$priorty=$this->input->post('priorty');
		$query=$this->input->post('query');
		
		$tempfiles=$this->input->post('files');
		
		$attachmentpath= APPPATH.'../assets/attachments/';
		
		if(!empty($_FILES['fileupload']))
		{
			$file=$_FILES;
			
			$counter=count($_FILES['fileupload']['name']);
			$this->load->library('upload');
			
			$sessionid=$this->session->userdata['session_id'];
			
			
			for($i=0;$i<$counter;$i++)
			{
				$filename=$file['fileupload']['name'][$i];
				
				$imarr=explode(".",$filename);
				
				$ext=end($imarr);
				
				$_FILES['fileupload']['name']=$file['fileupload']['name'][$i];
				$_FILES['fileupload']['type']=$file['fileupload']['type'][$i];
				$_FILES['fileupload']['tmp_name']=$file['fileupload']['tmp_name'][$i];
				$_FILES['fileupload']['error']=$file['fileupload']['error'][$i];
				$_FILES['fileupload']['size']=$file['fileupload']['size'][$i];
				
				//if(in_array($ext,$allowedfiles))
				//{
					//$newfilename=time().".".$ext;
					//$mov=move_uploaded_file($filetmpname,$attachmentpath.$newfilename);
					//if(!empty($mov))
					//{
						//$res=$this->home_model->uploadAttachmentTemp($newfilename);
					//}
				//}
				
				$guid=B1st_create_guid();
				$guid=substr($guid,0,16);
				
				
				$config = array(
					'file_name' => $guid.".".$ext,
					'allowed_types' => 'jpg|jpeg|gif|png|doc|pdf',
					'upload_path' => APPPATH.'../assets/attachments',
					'max_size' => 2000
				);
				
				$this->upload->initialize($config);
				
				if (!$this->upload->do_upload('fileupload')) {
					 // return the error message and kill the script
					echo $this->upload->display_errors(); die();
				}
				else
				{
					$flag=1;
					$image_data = $this->upload->data();
					$upName=$image_data['file_name'];
				
					//$config = array(
						//'source_image' => $image_data['full_path'],
						//'new_image' => $this->new_gallery_path . '/thumbs',
						//'maintain_ration' => true,
						//'width' => 100,
						//'height' => 100
					//);
				
					//$this->load->library('image_lib', $config);
					//$this->image_lib->resize();
					
					$imagename=$image_data['file_name'];
					
					$this->ticket_model->uploadAttachmentTemp($imagename,$sessionid);
					
				}
				
				
				
				
			}
			$filedet=$this->ticket_model->showfilename($sessionid);
			$data['filedet']=$filedet;
			$this->load->view('tempfile',$data);
			return;
		}
		
		$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$query);
		if(!empty($ins))
		{
			if(!empty($tempfiles))
			{
				foreach($tempfiles as $val)
				{
					$getupd=$this->ticket_model->insndel($ins,$val);
				}
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
		}
	}

	public function ListTicket()
	{
		$ticketdet=$this->ticket_model->listTicketFull();
		$data['ticketdet']=$ticketdet;
		$this->load->view('list-ticket',$data);
	}
	
	public function statuschange($ticketid)
	{
		$chk=$this->ticket_model->statuschange($ticketid);
		if(!empty($chk))
		{
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
		}
	}
	
	public function deleteticket($ticketid)
	{
		$chk=$this->ticket_model->delete($ticketid);
		if(!empty($chk))
		{
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
		}
	}
	
	public function edit($ticketid)
	{
		$productdet=$this->product_model->allproduct();
		$data['productdet']=$productdet;
		$companydet=$this->company_model->allcompany();
		$data['companydet']=$companydet;
		$departmentdet=$this->department_model->alldepartment();
		$data['departmentdet']=$departmentdet;
		$prioritydet=$this->ticketpriority_model->allpriority();
		$data['prioritydet']=$prioritydet;
		$det=$this->ticket_model->getticket($ticketid);
		$data['det']=$det;
		$this->load->view('ticketeditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		$ticket_name=$this->input->post('ticket_name');
		$subject=$this->input->post('subject');
		$customer=$this->input->post('customer');
		$department_id=$this->input->post('department_id');
		$company_id=$this->input->post('company_id');
		$product_id=$this->input->post('product_id');
		$priorty=$this->input->post('priorty');
		$state=$this->input->post('state');
		$query=$this->input->post('query');
		
		$tempfiles=$this->input->post('files');
		
		$attachmentpath= APPPATH.'../assets/attachments/';
		
		if(!empty($_FILES['fileupload']))
		{
			$file=$_FILES;
			
			$counter=count($_FILES['fileupload']['name']);
			$this->load->library('upload');
			
			$sessionid=$this->session->userdata['session_id'];
			
			
			for($i=0;$i<$counter;$i++)
			{
				$filename=$file['fileupload']['name'][$i];
				
				$imarr=explode(".",$filename);
				
				$ext=end($imarr);
				
				$_FILES['fileupload']['name']=$file['fileupload']['name'][$i];
				$_FILES['fileupload']['type']=$file['fileupload']['type'][$i];
				$_FILES['fileupload']['tmp_name']=$file['fileupload']['tmp_name'][$i];
				$_FILES['fileupload']['error']=$file['fileupload']['error'][$i];
				$_FILES['fileupload']['size']=$file['fileupload']['size'][$i];
				
				//if(in_array($ext,$allowedfiles))
				//{
					//$newfilename=time().".".$ext;
					//$mov=move_uploaded_file($filetmpname,$attachmentpath.$newfilename);
					//if(!empty($mov))
					//{
						//$res=$this->home_model->uploadAttachmentTemp($newfilename);
					//}
				//}
				
				$guid=B1st_create_guid();
				$guid=substr($guid,0,16);
				
				
				$config = array(
					'file_name' => $guid.".".$ext,
					'allowed_types' => 'jpg|jpeg|gif|png|doc|pdf',
					'upload_path' => APPPATH.'../assets/attachments',
					'max_size' => 2000
				);
				
				$this->upload->initialize($config);
				
				if (!$this->upload->do_upload('fileupload')) {
					 // return the error message and kill the script
					echo $this->upload->display_errors(); die();
				}
				else
				{
					$flag=1;
					$image_data = $this->upload->data();
					$upName=$image_data['file_name'];
				
					//$config = array(
						//'source_image' => $image_data['full_path'],
						//'new_image' => $this->new_gallery_path . '/thumbs',
						//'maintain_ration' => true,
						//'width' => 100,
						//'height' => 100
					//);
				
					//$this->load->library('image_lib', $config);
					//$this->image_lib->resize();
					
					$imagename=$image_data['file_name'];
					
					$this->ticket_model->uploadAttachmentTemp($imagename,$sessionid);
					
				}
				
				
				
				
			}
			$filedet=$this->ticket_model->showfilename($sessionid);
			$data['filedet']=$filedet;
			$this->load->view('tempfile',$data);
			return;
		}
		
		$upd=$this->ticket_model->editticket($id,$ticket_name,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$state,$query);
		if(!empty($upd))
		{
			if(!empty($tempfiles))
			{
				foreach($tempfiles as $val)
				{
					$getupd=$this->ticket_model->insndel($id,$val);
				}
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
		}
	}

	public function viewTicket($ticketid)
	{
		$productdet=$this->product_model->allproduct();
		$data['productdet']=$productdet;
		$companydet=$this->company_model->allcompany();
		$data['companydet']=$companydet;
		$departmentdet=$this->department_model->alldepartment();
		$data['departmentdet']=$departmentdet;
		$prioritydet=$this->ticketpriority_model->allpriority();
		$data['prioritydet']=$prioritydet;
		$det=$this->ticket_model->getticket($ticketid);
		$data['det']=$det;
		$ticketattachment=$this->ticket_model->getTicketAttachment($ticketid);
		
		$data['ticketattachment']=$ticketattachment;
		$ticketChain = $this->ticket_model->getTicketChain($ticketid);
		$data['querychain']=$ticketChain;
		$this->load->view('ticketview',$data);
	}

	public function newviewTicket($ticketid)
	{
		$productdet=$this->product_model->allproduct();
		$data['productdet']=$productdet;
		$companydet=$this->company_model->allcompany();
		$data['companydet']=$companydet;
		$departmentdet=$this->department_model->alldepartment();
		$data['departmentdet']=$departmentdet;
		$prioritydet=$this->ticketpriority_model->allpriority();
		$data['prioritydet']=$prioritydet;
		$det=$this->ticket_model->getticket($ticketid);
		$data['ticketdetlist']=$det;
		$ticketattachment=$this->ticket_model->getTicketAttachment($ticketid);
		
		$data['ticketattachment']=$ticketattachment;
		$ticketChain = $this->ticket_model->getTicketChain($ticketid);
		$data['querychain']=$ticketChain;
		$this->load->view('newticketview',$data);
	}
	
	public function showfile($filename)
	{
		$attachmentpath= APPPATH.'../assets/attachments/';
		$filename=$attachmentpath.$filename;
		$data = file_get_contents($filename);
		$z=force_download($filename,$data);
	}

	public function reply()
	{

		$data['replier_id'] = $this->input->post('replier_id');
		$data['ticket_id'] = $this->input->post('ticket_id');
		$data['body'] = $this->input->post('reply_text');
		$data['replier'] = $this->input->post('replier');

		$data2['state'] = $this->input->post('state');
		$data2['modified_date'] = date("Y-m-d H:i:s");
		$where['id'] = $this->input->post('ticket_id');

		$upd2 = $this->ticket_model->update($data2,$where);
		$upd = $this->ticket_model->insertReply($data);
		if(!empty($upd))
		{	
			if($data['replier'] == 'admin')
			{
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket/newviewTicket/".$data['ticket_id']);
			}
			else
			{
			redirect(TICKET_PLUGIN_URL."CI/index.php/register/viewTicket/".$data['ticket_id']);
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
