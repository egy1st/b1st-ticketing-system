<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ticket extends MX_Controller {

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
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->helper('opswat');
		$this->load->helper('akismet');
		$this->load->helper('main');
		$this->load->model('ticket_model');
		$this->load->model('users/users_model');
		$this->load->model('product/product_model');
		$this->load->model('department/department_model');
		$this->load->model('company/company_model');
		$this->load->model('ticketpriority/ticketpriority_model');
		
	}
	
	public function index()
	{
		B1st_authenticate();
		$ticketid=$this->input->post('ticket_id');
		
		$email=$this->input->post('email');
		
		$text_part=$this->input->post('text_part');
		
		$priority=$this->input->post('priority');
		
		$department=$this->input->post('department');
		
		$product=$this->input->post('product');
		
		$state=$this->input->post('state');
		
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
		$this->load->view('ticketlist',$data);
	}
	
	public function add()
	{
		B1st_authenticate();
		$productdet=$this->product_model->allproduct();
		$data['productdet']=$productdet;
		$companydet=$this->company_model->allcompany();
		$data['companydet']=$companydet;
		$departmentdet=$this->department_model->alldepartment();
		$data['departmentdet']=$departmentdet;
		$prioritydet=$this->ticketpriority_model->allpriority();
		$data['prioritydet']=$prioritydet;
		$flag = $this->input->post('email_ticket');
		$chatflag = $this->input->post('chatsession');
		$twitterflag = $this->input->post('tweet_ticket');
		if(!empty($flag) or !empty($chatflag))
		{
			$data['email'] = $this->input->post('email');
			$data['subject'] = $this->input->post('emailsubject');
			if (!empty($chatflag))
			{
				$data['subject'] = $this->input->post('subject');
			}
			$data['query'] = $this->input->post('content');
			$data["email_no"] = $this->input->post('email_no');
			$attachments = $this->input->post('attachment');
			$chkopswat=B1st_fetchmod('opswat');
			if(!empty($attachments))
			{
				foreach($attachments as $attachment)
				{
					$arr = explode('.',$attachment);
					$ext = end($arr);
					$filename = B1st_create_guid().".".$ext; 
					$sessionid=$this->session->userdata['session_id'];
					$txt = "";
					if($chkopswat==0)
				      {
						  if(copy(TICKET_PLUGIN_PATH."/tmp/".$attachment,TICKET_PLUGIN_PATH."/CI/assets/attachments/".$filename))
								{
									$this->ticket_model->uploadAttachmentTemp($filename,$sessionid);
								}
					  }
					  else if($chkopswat==1)
					  {
						$scan = B1st_OPSWAT_scan_file(TICKET_PLUGIN_PATH."/tmp/".$attachment);
						if(!empty($scan))
						{
							$report = B1st_OPSWAT_scan_report($scan['rest_ip'],$scan['data_id']);

							if($report)
							{
								if(copy(TICKET_PLUGIN_PATH."/tmp/".$attachment,TICKET_PLUGIN_PATH."/CI/assets/attachments/".$filename))
								{
									$this->ticket_model->uploadAttachmentTemp($filename,$sessionid);
								}
							}
							else
							{
								if(isset($_SESSION['ERROR_MSG']))
								{
								$_SESSION['ERROR_MSG'] .= "File <strong>{$attachment}</strong> possible a threat could not be attached.<br>";
								}
								else
								{
									$_SESSION['ERROR_MSG'] = "File <strong>{$attachment}</strong> possible a threat could not be attached.<br>";
								}
							}
						}
					  }

				}

				$data['attachments']=$this->ticket_model->showfilename($sessionid);
			}
		}
		if(!empty($twitterflag))
		{
			$data['query'] = $this->input->post('content');
			$data["tweet_id"] = $this->input->post('tweet_id');
		}
		$this->load->view('ticketaddform',$data);
	}
	
	public function insert()
	{
		@session_start();
		$arr=B1st_getSettingsValue('ticket_attachment');
		$extensionallowed=$arr->extensions_allowed;
		$extensionallowed=str_replace(",","|",$extensionallowed);
		$max_upload=$arr->max_upload;
		
		$ticke_post_type = $this->input->post('front_post');
		if($ticke_post_type)
		{
			$this->form_validation->set_rules('ticket_no', 'Ticket No.', 'required');
			$this->form_validation->set_rules('front_post', 'Url', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$companychk=B1st_fetchmod('company');
			if($companychk==1)
			{
				$this->form_validation->set_rules('company_id', 'Company', 'required');
			}
			$this->form_validation->set_rules('department_id', 'Department', 'required');
			$prodchk=B1st_fetchmod('product');
			if($prodchk==1)
			{
				$this->form_validation->set_rules('product_id', 'Product', 'required');
			}
			$this->form_validation->set_rules('customer', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('priorty', 'Priority', 'required');
			$this->form_validation->set_rules('query', 'Query', 'required');
	
			$this->form_validation->set_message('required', 'Please enter %s !!');
			$this->form_validation->set_message('valid_email', 'Please enter a valid email address !!');
			if(!empty($_FILES['fileupload']))
			{
				$viewdet['status']=0;
				
				$file=$_FILES;
				
				$counter=count($_FILES['fileupload']['name']);
				
				$this->load->library('upload');
				
				$sessionid=$this->session->userdata['session_id'];
				
				if($counter<=$max_upload)
				{
					$uploadnum=$counter;
				}
				else
				{
					$uploadnum=$max_upload;
				}
				
				for($i=0;$i<$uploadnum;$i++)
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
						'allowed_types' => $extensionallowed,
						'upload_path' => APPPATH.'../assets/attachments',
						'max_size' => 2000
					);
					
					$this->upload->initialize($config);
					
					if (!$this->upload->do_upload('fileupload')) {
						 // return the error message and kill the script
						$viewdet['err']=$this->upload->display_errors();
						$viewdet['status']=0;
						echo json_encode($viewdet);
						return;
					}
					else
					{
						$flag=1;
						$image_data = $this->upload->data();
						$upName=$image_data['file_name'];
						$viewdet['status']=1;
					
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
				$chkopswat=B1st_fetchmod('opswat');
				$attachments = array();
				if(!empty($filedet))
				{
					foreach($filedet as &$file)
					{
						$file = (array)$file;
						if($chkopswat==1)
						{
							$scan = B1st_OPSWAT_scan_file(TICKET_PLUGIN_PATH."/CI/assets/attachments/".$file['filename']);
							if(!empty($scan))
							{
								$report = B1st_OPSWAT_scan_report($scan['rest_ip'],$scan['data_id']);

								if($report)
								{
									$file['scan'] = false;
									$attachments[] = $file;
								}
								else
								{
									$file['scan'] = true;
									$attachments[] = $file;
								}
							}
						}
						else
						{
							$file['scan'] = false;
							$attachments[] = $file;
						}
					}
				}

				$data['filedet']=$attachments;
				$viewdet['content']=$this->load->view('tempfile',$data,true);
				echo json_encode($viewdet);
				return;
			}
	
			if ($this->form_validation->run() == FALSE)
			{
				$_SESSION['message'] = validation_errors();
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
			
			$prodchk=B1st_fetchmod('product');
			if($prodchk==1)
			{
				$product_id=$this->input->post('product_id');
			}
			$companychk=B1st_fetchmod('company');
			if($companychk==1)
			{
				$company_id=$this->input->post('company_id');
			}
			$priorty=$this->input->post('priorty');
			$query=$this->input->post('query');
			$spam = 0;
		
			$chkakismet=B1st_fetchmod('akismet');
			if($chkakismet==1)
			{
				
				// Load array with comment data.
				$akismet_data = array(
				  'author' => 'admin',
				  'email' => $customer,
				  'website' => TICKET_PLUGIN_URL,
				  'body' => $query,
				  'permalink' => '',
				);

												
				$settings = (array)B1st_getSettingsValue('akismet');
	
				$akismet = new Akismet(TICKET_PLUGIN_URL, $settings['api_key'], $akismet_data); 
				
				if($akismet->errorsExist()) {
					//echo "Oops! Problem connecting to the Akismet server!";
				  } else {
					if($akismet->isSpam()) {
					 $spam = 1;
					  // mark comment as spam
					 
					} else {
					  //echo "This is good ham! Let's keep it!";
					  
					}
				  

				  }
			}  
			
			$userdet=B1st_getUserInfoById($userid);
			$useremail=$userdet->email;
			$firstname=$userdet->firstname;
			$lastname=$userdet->lastname;
			
			$tempfiles=$this->input->post('files');
			
			$attachmentpath= APPPATH.'../assets/attachments/';
			           
			$companychk=B1st_fetchmod('company');
			$prodchk=B1st_fetchmod('product');
			if($companychk==1 and $prodchk==1)
			{
				$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$query,NULL,$spam);
			}
			if($companychk!=1 and $prodchk==1)
			{
				$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,'',$department_id,$product_id,$priorty,$query,NULL,$spam);
			}
			if($companychk==1 and $prodchk!=1)
			{
				$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,'',$priorty,$query,NULL,$spam);
			}
			if($companychk!=1 and $prodchk!=1)
			{
				$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,'',$department_id,'',$priorty,$query,NULL,$spam);
			}
			if(!empty($ins))
			{
				
				if(!empty($tempfiles))
				{
					foreach($tempfiles as $val)
					{
						$getupd=$this->ticket_model->insndel($ins,$val);
					}
				}
				
				$adminemail=B1st_getSettingsValue('adminemail');
				$adminemail=$adminemail->email;
				
				$messagebody="<strong>Subject : </strong>".$subject."<br />";
				$messagebody.="<strong>From : </strong>".$customer."<br /><br />";
				$messagebody.="<strong>Query : </strong><br>";
				$messagebody.=$query;
				
						$tsemail=B1st_getSettingsValue('tsemail');
						$tsemail=$tsemail->email;

				B1st_sendmail($adminemail,"","","Ticketing System : New Ticket Posted (".$ticket_name."): ",$messagebody,$tsemail);
				
				$responsetimeobj=$this->ticket_model->getavgresponsetime();
				//echo "<pre>";
				//print_r($responsetimeobj);
				//echo "</pre>";
				$responsetime=$responsetimeobj->avgresponsetime;
				if(!empty($responsetime) or $responsetime==0)
				{
					$responsetime="5 Hours";
				}
				else
				{
					$responsetime=B1st_smarttimestamp($responsetime);
				}
			
				//code for auto responder
				$settings = (array)B1st_getSettingsValue('auto_responder');
				$checkset=$settings['type'];
				
				if($checkset==1)
				{
					$messagebodyticket="Your Ticket ".$ticket_name." has been received. You will receive feedback from us within ".$responsetime;

					B1st_sendmail($useremail,$firstname,$lastname,"Auto Responder for Ticket Number ".$ticket_name." : ",$messagebodyticket,$tsemail);
				}
				//code for auto responder
				
				$_SESSION['message'] = "<strong>Ticket No. : ".$ticket_name."<br>We will get back to your query soon !!</strong>";
				redirect($ticke_post_type);	
			}
			
			/***********************frontend ticket submit******************************/
			}
			
		}
		$ticket_name=$this->input->post('ticket_no');
		//$userid = $_SESSION['userid'];   by MAA
				
		$subject=$this->input->post('subject');
		$customer=$this->input->post('customer');
		$query_userid = $this->ticket_model->userid_by_email($customer) ;  // by MAA
		$userid = $query_userid->id ;   // by MAA
		$department_id=$this->input->post('department_id');
		$prodchk=B1st_fetchmod('product');
		if($prodchk==1)
		{
			$product_id=$this->input->post('product_id');
		}
		$companychk=B1st_fetchmod('company');
		if($companychk==1)
		{
			$company_id=$this->input->post('company_id');
		}
		$priorty=$this->input->post('priorty');
		$query=$this->input->post('query');
		$spam = 0;
		
		$chkakismet=B1st_fetchmod('akismet');
		if($chkakismet==1)
			{
				
				// Load array with comment data.
				$akismet_data = array(
				  'author' => 'admin',
				  'email' => $customer,
				  'website' => TICKET_PLUGIN_URL,
				  'body' => $query,
				  'permalink' => '',
				);

												
				$settings = (array)B1st_getSettingsValue('akismet');
	
				$akismet = new Akismet(TICKET_PLUGIN_URL, $settings['api_key'], $akismet_data); 
				
				if($akismet->errorsExist()) {
					//echo "Oops! Problem connecting to the Akismet server!";
				  } else {
					if($akismet->isSpam()) {
					 $spam = 1;
					  // mark comment as spam
					 
					} else {
					  //echo "This is good ham! Let's keep it!";
					  
					}
				  

				  }
			}  
		$tempfiles=$this->input->post('files');
		
		$attachmentpath= APPPATH.'../assets/attachments/';
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		
		$this->form_validation->set_rules('customer', 'Customer Email', 'required|valid_email');
		
		$this->form_validation->set_rules('department_id', 'Department Name', 'required');
		
		$prodchk=B1st_fetchmod('product');
		if($prodchk==1)
		{
			$this->form_validation->set_rules('product_id', 'Product Name', 'required');
		}
		
		$companychk=B1st_fetchmod('company');
		if($companychk==1)
		{
			$this->form_validation->set_rules('company_id', 'Company Name', 'required');
		}
		
		$this->form_validation->set_rules('priorty', 'Priority', 'required');
		
		$this->form_validation->set_rules('query', 'Query', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');

			if(!empty($_FILES['fileupload']))
			{
				$viewdet['status']=0;
				
				$file=$_FILES;
				
				$counter=count($_FILES['fileupload']['name']);

				$this->load->library('upload');
				
				$sessionid=$this->session->userdata['session_id'];
				
				if($counter<=$max_upload)
				{
					$uploadnum=$counter;
				}
				else
				{
					$uploadnum=$max_upload;
				}
				
				for($i=0;$i<$uploadnum;$i++)
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
						'allowed_types' => $extensionallowed,
						'upload_path' => APPPATH.'../assets/attachments',
						'max_size' => 2000
					);
					
					$this->upload->initialize($config);
					
					if (!$this->upload->do_upload('fileupload')) {
						 // return the error message and kill the script
						$viewdet['err']=$this->upload->display_errors();
						$viewdet['status']=0;
						echo json_encode($viewdet);
						return;
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
						$viewdet['status']=1;
						
					}
					
					
					
					
				}
				$filedet=$this->ticket_model->showfilename($sessionid);
				$chkopswat=B1st_fetchmod('opswat');
				$attachments = array();
				if(!empty($filedet))
				{
					foreach($filedet as &$file)
					{
						$file = (array)$file;
						if($chkopswat==1)
						{
							$scan = B1st_OPSWAT_scan_file(TICKET_PLUGIN_PATH."/CI/assets/attachments/".$file['filename']);
							if(!empty($scan))
							{
								$report = B1st_OPSWAT_scan_report($scan['rest_ip'],$scan['data_id']);
								
								if($report)
								{
									$file['scan'] = false; // by MAA inverse logic
									$attachments[] = $file;
								}
								else
								{
									$file['scan'] = true; // by MAA inverse logic
									$attachments[] = $file;
								}
							}
						}
						else
						{
							$file['scan'] = false;
							$attachments[] = $file;
						}
					}
				}
				$data['filedet']=$attachments;
				$viewdet['content']=$this->load->view('tempfile',$data,true);
				echo json_encode($viewdet);
				return;
			}

		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			//if ticket posted by email den insert email_no in database else NULL
			$emailno = $this->input->post("email_no");
			$t = $this->input->post("tweet_id");
			$tweet_id = (!empty($t)) ? $t : NULL;
			if(!empty($emailno))
			{
				$companychk=B1st_fetchmod('company');
				$prodchk=B1st_fetchmod('product');
				if($companychk==1 and $prodchk==1)
				{
					$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$query,$emailno,$spam,$tweet_id);
				}
				if($companychk!=1 and $prodchk==1)
				{
					$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,'',$department_id,$product_id,$priorty,$query,$emailno,$spam,$tweet_id);
				}
				if($companychk==1 and $prodchk!=1)
				{
					$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,'',$priorty,$query,$emailno,$spam,$tweet_id);
				}
				if($companychk!=1 and $prodchk!=1)
				{
					$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,'',$department_id,'',$priorty,$query,$emailno,$spam,$tweet_id);
				}
				
			}
			else
			{
				$ins=$this->ticket_model->addticket($ticket_name,$userid,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$query,NULL,$spam,$tweet_id);
			}
			if(!empty($ins))
			{
				if(!empty($tempfiles))
				{
					foreach($tempfiles as $val)
					{
						$getupd=$this->ticket_model->insndel($ins,$val);
					}
				}
				
				$adminemail=B1st_getSettingsValue('adminemail');
				$adminemail=$adminemail->email;
				
				$tsemail=B1st_getSettingsValue('tsemail');
				$tsemail=$tsemail->email;

				$messagebody="<strong>Subject : </strong>".$subject."<br />";
				$messagebody.="<strong>From : </strong>".$customer."<br /><br />";
				$messagebody.="<strong>Query : </strong><br>";
				$messagebody.=$query;
				
				B1st_sendmail($adminemail,"","","Ticketing System : New Ticket Posted : ",$messagebody,$tsemail);
				
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Ticket added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
			}
		}
	}

	public function ListTicket()
	{
		B1st_authenticate();
		$ticketdet=$this->ticket_model->listTicketFull();
		$data['ticketdet']=$ticketdet;
		$this->load->view('list-ticket',$data);
	}
	
	public function statuschange($ticketid)
	{
		B1st_authenticate();
		$chk=$this->ticket_model->statuschange($ticketid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
		}
	}
	
	public function deleteticket($ticketid)
	{
		B1st_authenticate();
		$chk=$this->ticket_model->delete($ticketid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Ticket deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
		}
	}
	
	public function edit($ticketid)
	{
		B1st_authenticate();
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
		@session_start();
		$arr=B1st_getSettingsValue('ticket_attachment');
		$extensionallowed=$arr->extensions_allowed;
		$extensionallowed=str_replace(",","|",$extensionallowed);
		$max_upload=$arr->max_upload;
		
		$id=$this->input->post('id');
		$ticket_name=$this->input->post('ticket_name');
		$subject=$this->input->post('subject');
		$customer=$this->input->post('customer');
		$department_id=$this->input->post('department_id');
		$companychk=B1st_fetchmod('company');
		if($companychk==1)
		{
			$company_id=$this->input->post('company_id');
		}
		$prodchk=B1st_fetchmod('product');
		if($prodchk==1)
		{
			$product_id=$this->input->post('product_id');
		}
		$priorty=$this->input->post('priorty');
		$state=$this->input->post('state');
		$query=$this->input->post('query');
		
		$modified_date=date('Y_m-d H:i:s');
		
		$tempfiles=$this->input->post('files');
		
		$attachmentpath= APPPATH.'../assets/attachments/';
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		
		$this->form_validation->set_rules('customer', 'Customer Email', 'required|valid_email');
		
		$this->form_validation->set_rules('department_id', 'Department Name', 'required');
		
		$prodchk=B1st_fetchmod('product');
		if($prodchk==1)
		{
			$this->form_validation->set_rules('product_id', 'Product Name', 'required');
		}
		
		$companychk=B1st_fetchmod('company');
		if($companychk==1)
		{
			$this->form_validation->set_rules('company_id', 'Company Name', 'required');
		}
		
		$this->form_validation->set_rules('priorty', 'Priority', 'required');
		
		$this->form_validation->set_rules('query', 'Query', 'required');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		if(!empty($_FILES['fileupload']))
		{
			$viewdet['status']=0;
			
			$file=$_FILES;
			
			$counter=count($_FILES['fileupload']['name']);
			$this->load->library('upload');
			
			$sessionid=$this->session->userdata['session_id'];
			
			if($counter<=$max_upload)
			{
				$uploadnum=$counter;
			}
			else
			{
				$uploadnum=$max_upload;
			}
			
			for($i=0;$i<$uploadnum;$i++)
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
					'allowed_types' => $extensionallowed,
					'upload_path' => APPPATH.'../assets/attachments',
					'max_size' => 2000
				);
				
				$this->upload->initialize($config);
				
				if (!$this->upload->do_upload('fileupload')) {
					 // return the error message and kill the script
					$viewdet['err']=$this->upload->display_errors();
					$viewdet['status']=0;
					echo json_encode($viewdet);
					return;
				}
				else
				{
					$viewdet['status']=1;
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
			$chkopswat=B1st_fetchmod('opswat');
			$attachments = array();
			if(!empty($filedet))
			{
				foreach($filedet as &$file)
				{
					$file = (array)$file;
					if($chkopswat==1)
					{
						$scan = B1st_OPSWAT_scan_file(TICKET_PLUGIN_PATH."/CI/assets/attachments/".$file['filename']);
						if(!empty($scan))
						{
							$report = B1st_OPSWAT_scan_report($scan['rest_ip'],$scan['data_id']);
	
							if($report)
							{
								$file['scan'] = false; // by MAA inverse logic
								$attachments[] = $file;
							}
							else
							{
								$file['scan'] = true; // by MAA inverse logic
								$attachments[] = $file;
							}
						}
					}
					else
					{
						$file['scan'] = "";
						$attachments[] = $file;
					}
				}
			}
			$data['filedet']=$attachments;
			$viewdet['content']=$this->load->view('tempfile',$data,true);
			echo json_encode($viewdet);
			return;
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$companychk=B1st_fetchmod('company');
			$prodchk=B1st_fetchmod('product');
			if($companychk==1 and $prodchk==1)
			{
				$upd=$this->ticket_model->editticket($id,$ticket_name,$subject,$customer,$company_id,$department_id,$product_id,$priorty,$state,$query,$modified_date);
			}
			if($companychk!=1 and $prodchk==1)
			{
				$upd=$this->ticket_model->editticket($id,$ticket_name,$subject,$customer,'',$department_id,$product_id,$priorty,$state,$query,$modified_date);
			}
			if($companychk==1 and $prodchk!=1)
			{
				$upd=$this->ticket_model->editticket($id,$ticket_name,$subject,$customer,$company_id,$department_id,'',$priorty,$state,$query,$modified_date);
			}
			if($companychk!=1 and $prodchk!=1)
			{
				$upd=$this->ticket_model->editticket($id,$ticket_name,$subject,$customer,'',$department_id,'',$priorty,$state,$query,$modified_date);
			}
			if(!empty($upd))
			{
				if(!empty($tempfiles))
				{
					foreach($tempfiles as $val)
					{
						$getupd=$this->ticket_model->insndel($id,$val);
					}
				}
				
				$adminemail=B1st_getSettingsValue('adminemail');
				$adminemail=$adminemail->email;
				
						$tsemail=B1st_getSettingsValue('tsemail');
		$tsemail=$tsemail->email;

				$messagebody="<strong>Subject : </strong>".$subject."<br />";
				$messagebody.="<strong>Query : </strong><br>";
				$messagebody.=$query;
				
				
				if($state=="C")
				{
					B1st_sendmail($adminemail,"","","Ticketing System : Ticket Number ".$ticket_name." has been closed",$messagebody,$tsemail);
					B1st_sendmail($customer,"","","Ticketing System : Ticket Number ".$ticket_name." has been closed",$messagebody,$tsemail);
				}
				else
				{
					B1st_sendmail($adminemail,"","","Ticketing System : Ticket Number ".$ticket_name." has been modified",$messagebody,$tsemail);
					B1st_sendmail($customer,"","","Ticketing System : Ticket Number ".$ticket_name." has been modified",$messagebody,$tsemail);
				}
				
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Ticket updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->l;ine("Something went wrong! Please try again");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket");
		}
	}

	public function viewTicket($ticketid)
	{
		B1st_authenticate();
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
		B1st_authenticate();
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
		$this->load->model('faq/faq_model');
		$data['faqs'] = $this->faq_model->listAllFaq($det->product_id);
		$this->load->view('newticketview',$data);
	}
	
	public function showfile($filename)
	{
		$t = $filename;
		B1st_authenticate();
		$attachmentpath= APPPATH.'../assets/attachments/';
		$filename=$attachmentpath.$filename;
		$data = file_get_contents($filename);
		ob_end_clean(); 
		$z=force_download($t,$data);
	}

	public function reply()
	{
		@session_start();
		$replierid = $this->input->post('replier_id');
		$userdet=B1st_getUserInfoById($replierid);
		//echo "<pre>";
		//print_r($userdet);
		//echo "</pre>";
		$ticketid = $this->input->post('ticket_id');
		$ticketdet=$this->ticket_model->getticket($ticketid);
		//echo "<pre>";
		//print_r($ticketdet);
		//echo "</pre>";
		$ticketpostdate=$ticketdet->create_date;
		$ticketmodifieddate=$ticketdet->modified_date;
		//die;
		$data['replier_id'] = $replierid;
		$data['ticket_id'] = $ticketid;
		$data['body'] = $this->input->post('reply_text');
		$data['replier'] = $this->input->post('replier');

		$data2['state'] = $this->input->post('state');
		$data2['modified_date'] = date("Y-m-d H:i:s");
		$where['id'] = $this->input->post('ticket_id');
		
		$this->form_validation->set_rules('reply_text', 'Reply', 'required');

		$this->form_validation->set_message('required', 'Please enter %s text!!');
 
		if($this->form_validation->run() == FALSE)
		{
			$_SESSION['reply_validation'] = validation_errors();
			if($data['replier'] == 'admin')
			{
			redirect(TICKET_PLUGIN_URL."CI/index.php/ticket/newviewTicket/".$data['ticket_id']);
			}
			else
			{
				redirect(TICKET_PLUGIN_URL."CI/index.php/register/viewTicket/".$data['ticket_id']);
			}
			exit;
		}

		$upd2 = $this->ticket_model->update($data2,$where);
		$upd = $this->ticket_model->insertReply($data);
		if(!empty($upd))
		{	
			if($data['replier'] == 'admin')
			{
				$respondertime=$userdet->responder_time_duration;
				$assigned=B1st_checkTicketAssignmentUser($data['ticket_id']);
				$assigneduserdet=B1st_getUserInfoById($assigned);
				$replieduserdet=B1st_getUserInfoById($data['replier_id']);
				
				$chkres=B1st_fetchmod('response_time');
				if($chkres==1)
				{
					$diff=strtotime($data2['modified_date'])-strtotime($ticketmodifieddate);
					if($respondertime=="")
					{
						$respondertime=$diff;
					}
					else
					{
						$respondertime=ceil(($respondertime+$diff)/2);
					}
					
					$this->users_model->updrespondertime($respondertime,$replierid);
				}
				
				$assignedemailid=$assigneduserdet->email;
				$repliedemailid=$replieduserdet->email;
				
				$adminemail=B1st_getSettingsValue('adminemail');
				$adminemail=$adminemail->email;

		$tsemail=B1st_getSettingsValue('tsemail');
		$tsemail=$tsemail->email;
				
				$messagebody="<strong>Reply to the Ticket : </strong><br />";
				$messagebody.="<strong>From : </strong>".$assignedemailid."<br /><br />";
				$messagebody.="<strong>Query : </strong><br>";
				$messagebody.=$data['body'];
				
				B1st_sendmail($repliedemailid,"","","Reply from the Ticketing System",$messagebody,$tsemail);
				
				redirect(TICKET_PLUGIN_URL."CI/index.php/ticket/newviewTicket/".$data['ticket_id']);
			}
			else
			{
				$assigned=B1st_checkTicketAssignmentUser($data['ticket_id']);
				$assigneduserdet=B1st_getUserInfoById($assigned);
				$replieduserdet=B1st_getUserInfoById($data['replier_id']);
				
				$assignedemailid=$assigneduserdet->email;
				$repliedemailid=$replieduserdet->email;
				
				$adminemail=B1st_getSettingsValue('adminemail');
				$adminemail=$adminemail->email;

		$tsemail=B1st_getSettingsValue('tsemail');
		$tsemail=$tsemail->email;
				
				$messagebody="<strong>Reply to the Ticket : </strong><br />";
				$messagebody.="<strong>From : </strong>".$repliedemailid."<br /><br />";
				$messagebody.="<strong>Query : </strong><br>";
				$messagebody.=$data['body'];
				
				B1st_sendmail($assignedemailid,"","","Reply from the Ticketing System",$messagebody,$tsemail);
				B1st_sendmail($adminemail,"","","Reply from the Ticketing System",$messagebody,$tsemail);
				
				redirect(TICKET_PLUGIN_URL."CI/index.php/register/viewTicket/".$data['ticket_id']);
			}
		}
	}
	
	
	
	
	public function deletetempfile()
	{
		@session_start();
		$fileid=$this->input->post('fileid');
		$flg=$this->ticket_model->deletetemp($fileid);
		if(!empty($flg))
		{
			echo 1;
		}
		else
		{
			echo "";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
