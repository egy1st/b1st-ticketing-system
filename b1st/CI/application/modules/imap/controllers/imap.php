<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imap extends MX_Controller {


	public function __construct()
	{
		B1st_authenticate();
		B1st_selectbacklanguage();
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->helper('opswat');
		$this->load->helper('akismet');
		$this->load->model('imap_model');

	}

	public function get()
	{
		$z = $this->getSubject($_REQUEST['id']);
		echo $z;
	}
	public $result = array();
	public function getSubject($id)
	{
		if($this->imap_model->emailExists($id))
		{

			$edata = $this->imap_model->getEmail($id);
			$edata = $edata[0];
			$txt = (B1st_check_already_posted($edata->eid)) ? "<strong class='scanthreat'>[Posted]</strong>" : "";
			$string = substr($edata->subject,0,15).'...';
			$this->result['subject'] = '<a href="javascript:void(0)" onclick="getBody('.$edata->eid.')" title="'.$edata->subject.'" >'. $string.'</a>&nbsp;'.$txt;

			$this->result['eid'] = $edata->eid;
			$this->result['status'] = 0;
			return json_encode($this->result);
		}
		else
		{

			$settings = (array)B1st_getSettingsValue('imapsetting');


			$config['login']= $settings['login'];
			$config['pass']=$settings['pass'];
			$config['host']=$settings['host'];
			$config['port']=$settings['port'];
			$config['service_flags'] = $settings['service_flags'];
			$config['mailbox'] = $settings['mailbox'];

			$this->load->library('peeker', $config);
			

			$e = $this->peeker->get_message($id);

			$txt = (B1st_check_already_posted($id)) ? "<strong class='scanthreat has-tip' title=\"Already posted as ticket\" >[P]</strong>" : "";
			
			$subject = $e->get_subject();
			$body = $this->getEmailBody($id);

			$idata['eid'] = $id;
			$idata['subject'] = $subject;
			$idata['body'] = $body['body'];
			$idata['deleted'] = 0;

			$this->imap_model->insertEmail($idata);
			$string = (strlen($subject) > 15) ? substr($subject,0,15).'...' : $subject ;
			$this->result['subject'] = '<a href="javascript:void(0)" onclick="getBody('.$id.')">'.$string.''.$txt.'</a><button class="has-tip" title="Detete Email" type="button" onclick="deleteEmail('.$id.',this);" ><i class="fa fa-trash"></i></button>';
				$this->result['id'] = $id;
				$this->result['status'] = true;

			$this->peeker->close();

			return json_encode($this->result);
		}

	}

	public function getTotal()
	{

		/*
	$settings = (array)B1st_getSettingsValue('imapsetting');	
$config['login']='b1st@mygoldensoft.com';
$config['pass']='13121971';
$config['host']='mail.mygoldensoft.com';
$config['port']='143';
$config['service_flags'] = '/imap/notls'; 
$this->load->library('peeker', $config);

//$this->peeker->set_search('SUBJECT "'.$settings['subject'].'"');


if ($this->peeker->message_waiting())
{
	assert (1==4);
echo 'Message count:' . $this->peeker->get_message_count();
}
else
{
	assert(1==5);
echo 'No messages waiting.';
}

$this->peeker->close();

// tell the story of the connection
print_r($this->peeker->trace());

exit;
*/


		$settings = (array)B1st_getSettingsValue('imapsetting');


		$config['login']= $settings['login'];
		$config['pass']=$settings['pass'];
		$config['host']=$settings['host'];
		$config['port']=$settings['port'];
		$config['service_flags'] = $settings['service_flags'];
		$config['mailbox'] = $settings['mailbox'];

		$this->load->library('peeker', $config);
		
		if (isset($settings['subject']) && $settings['subject'] != "" )
			{
	
				//echo "hi 1";
				$this->peeker->set_search('SUBJECT "'.$settings['subject'].'"');
				$c = $this->peeker->search_and_count_messages();
				$ids =$this->peeker->get_ids_from_search();
				$this->peeker->close();
				$deletedIDs = $this->imap_model->getDeletedMailId();
				
				$IDS = array();
				foreach($ids as $id)
				{
					if(in_array($id,$deletedIDs))
					continue;
					else
					$IDS[] = $id;
				}
			} else if ($this->peeker->message_waiting())
				{
					
								
				$ids=$this->peeker->get_message_count();
				//echo "hi 2 " . $ids;
					
				$this->peeker->close();
				$deletedIDs = $this->imap_model->getDeletedMailId();
						
				$IDS = array();
				for ($id = 1 ; $id <= $ids ; $id++ )
				{
					if(in_array($id,$deletedIDs))
					continue;
					else
					$IDS[] = $id;
				}
			}
			
		
		$data['count'] = count($IDS);
		$data['ids'] = $IDS;
		//var_dump($deletedIDs);

		echo json_encode($data);
	
	
	}


	public function index()
	{	
		$data['emails'] = $this->imap_model->getAllEmails();
 		$this->load->view('imap',$data);
	}

	function getbody($id)
	{
		$settings = (array)B1st_getSettingsValue('imapsetting');


		$config['login']= $settings['login'];
		$config['pass']=$settings['pass'];
		$config['host']=$settings['host'];
		$config['port']=$settings['port'];
		$config['service_flags'] = $settings['service_flags'];
		$config['mailbox'] = $settings['mailbox'];

		$this->load->library('peeker', $config);
		$e = $this->peeker->get_message($id);
	    $subject = $e->get_subject();

		if($e->has_attachment())
		{
			$e->save_all_attachments(TICKET_PLUGIN_PATH."/tmp/");
		}
		$parts = $e->get_parts_array();
		$data['file'] = "";
		$data['ano'] = 0;
		if(!empty($parts))
		{
			$html = "<ul>";
			$n = 0;
			foreach ($parts as $part)
			{
				$filename = $part->get_filename();
				$txt = "";
				$chkopswat=B1st_fetchmod('opswat');
				if($chkopswat==1)
				{
					$scan = B1st_OPSWAT_scan_file(TICKET_PLUGIN_PATH."/tmp/".$filename);
					if(!empty($scan))
					{
						$report = B1st_OPSWAT_scan_report($scan['rest_ip'],$scan['data_id']);
	
						if($report)
						{
							$txt = "";
						}
						else
						{
							$txt = "[<span class='scanthreat'>Virus detected!</span>]";
						}
					}
				}
				$html .= '<li><a href="'.TICKET_PLUGIN_URL.'CI/index.php/imap/download/'.$filename.'">'.$filename.'</a>
					<input type="hidden" name="attachment[]" value="'.$filename.'">
						'.$txt.'
						</li>';
				$n++;
			}

			$html .= "</ul>";
			$data["file"] =  $html;
			$data['ano'] = $n;
		}

		$email = $e->get_from();

		if(strpos ($email, '<') !== false)
		{
		    $from3 = explode ('<', $email);
		    $from4 = explode ('>', $from3[1]);
		    $from = $from4[0];
		}
		else
		{
		    $from = $email;
		}
		$data['email'] = $from;

		$html = $e->get_plain();
		$html = strip_tags($html);
		$data['body'] = $html;
		$data['subject'] = $subject;
		$this->peeker->close();
		
		$chkakismet=B1st_fetchmod('akismet');
		
		if($chkakismet==1)
		{
							
				// Load array with comment data.
				$akismet_data = array(
				  'author' => 'admin',
				  'email' => $from,
				  'website' => TICKET_PLUGIN_URL,
				  'body' => $html,
				  'permalink' => '',
				);
	
			$settings = (array)B1st_getSettingsValue('akismet');
	
	
			$akismet = new Akismet(TICKET_PLUGIN_URL, $settings['api_key'], $akismet_data); 
				
				if($akismet->errorsExist()) {
					//echo "Oops! Problem connecting to the Akismet server!";
				  } else {
					if($akismet->isSpam()) {
						// mark comment as spam
						$data['spam'] = "<strong class='scanthreat'>[Spam]</strong>";
					  
					 
					} else {
					  // This is good ham! Let's keep it!
					  $data['spam'] = "";
					  
					}
				
				  }
		}
		

		echo json_encode($data);
	}

	function getEmailBody($id)
	{
		$settings = (array)B1st_getSettingsValue('imapsetting');


		$config['login']= $settings['login'];
		$config['pass']=$settings['pass'];
		$config['host']=$settings['host'];
		$config['port']=$settings['port'];
		$config['service_flags'] = $settings['service_flags'];
		$config['mailbox'] = $settings['mailbox'];

		$this->load->library('peeker', $config);
		$e = $this->peeker->get_message($id);

		if($e->has_attachment())
		{
			$e->save_all_attachments(TICKET_PLUGIN_PATH."/tmp/");
		}
		$parts = $e->get_parts_array();
		$data['file'] = "";
		$data['ano'] = 0;
		if(!empty($parts))
		{
			$html = "<ul>";
			$n = 0;
			foreach ($parts as $part)
			{
				$filename = $part->get_filename();
				$txt = "";
				$chkopswat=B1st_fetchmod('opswat');
				if($chkopswat==1)
				{
					$scan = B1st_OPSWAT_scan_file(TICKET_PLUGIN_PATH."/tmp/".$filename);
					if(!empty($scan))
					{
						$report = B1st_OPSWAT_scan_report($scan['rest_ip'],$scan['data_id']);
	
						if($report)
						{
							$txt = "";
						}
						else
						{
							$txt = "[<span class='scanthreat'>Virus detected!</span>]";
						}
					}
				}
				$html .= '<li><a href="'.TICKET_PLUGIN_URL.'CI/index.php/imap/download/'.$filename.'">'.$filename.'</a>
					<input type="hidden" name="attachment[]" value="'.$filename.'">
						'.$txt.'
						</li>';
				$n++;
			}

			$html .= "</ul>";
			$data["file"] =  $html;
			$data['ano'] = $n;
		}

		$email = $e->get_from();

		if(strpos ($email, '<') !== false)
		{
		    $from3 = explode ('<', $email);
		    $from4 = explode ('>', $from3[1]);
		    $from = $from4[0];
		}
		else
		{
		    $from = $email;
		}
		$data['email'] = $from;

		$html = $e->get_plain();
		$html = strip_tags($html);
		$data['body'] = $html;
		$this->peeker->close();
		
		$chkakismet=B1st_fetchmod('akismet');
		
		if($chkakismet==1)
		{
			$data['spam'] = "<strong class='scanok'>[OK]</strong>";
	
							
				
				// Load array with comment data.
				$akismet_data = array(
				  'author' => 'admin',
				  'email' => $from,
				  'website' => TICKET_PLUGIN_URL,
				  'body' => $html,
				  'permalink' => '',
				);
	
			$settings = (array)B1st_getSettingsValue('akismet');
		
			$akismet = new Akismet(TICKET_PLUGIN_URL, $settings['api_key'], $akismet_data); 
				
				if($akismet->errorsExist()) {
					//echo "Oops! Problem connecting to the Akismet server!";
				  } else {
					if($akismet->isSpam()) {
						// mark comment as spam
						$data['spam'] = "<strong class='scanthreat'>[Spam]</strong>";
					  
					 
					} else {
					  // This is good ham! Let's keep it!
					  $data['spam'] = "";
					  
					}
				
				  }
		}
			


		return $data;
	}

	public function download($filename)
	{
		$d = file_get_contents(TICKET_PLUGIN_PATH."/tmp/".$filename);
		force_download($filename,$d);

	}

	public function deleteEmail($id)
	{
		$where['eid'] = $id;
		if($this->imap_model->deleteEmail($where))
		{
			echo "ok";
			return;
		}

		echo "error";
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
