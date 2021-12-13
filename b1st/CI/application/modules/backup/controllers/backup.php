<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class backup extends MX_Controller {

	public $path = TICKET_PLUGIN_PATH;

	public function __construct()
	{
		B1st_authenticate();
		B1st_selectbacklanguage();
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->model('backup_model');
	}
	
	public function index()
	{
		$data['backups'] = B1st_getFileList($this->path.'/backup/');

		$this->load->view('backuplist',$data);
	}
	
	public function doBackup()
	{
/*		echo '<pre>';
		print_r($_POST);*/

		$this->form_validation->set_rules('backup_name', 'Backup Name', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('backup_description', 'Backup Description', 'trim|required|xss_clean');
		$this->form_validation->set_rules('backup_type', 'Backup Type', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			$data['msg'] ='
			    <div class="isa_error" style="width: 80%;">
         			'.validation_errors().'
    			</div>';
    		$data['status'] = 0;
			
		}
		else
		{
			$idata['backup_name'] = $this->input->post('backup_name');
			//$idata['backup_description'] = $this->input->post('backup_description');
			$idata['backup_type'] = $this->input->post('backup_type');
			$idata['creation_date'] = date('Y-m-d H:i:s');

					$this->backup_model->doBackup($idata);
					$_SESSION['SUCCESS_MSG']="Backup added successfully";
		//redirect(TICKET_PLUGIN_URL."CI/index.php/backup/index");


			$data['msg'] = '
			    <div class="isa_success" style="width: 80%;">
         			Backup successful !!
    			</div>';
    		$data['status'] = 1;
		}

		echo json_encode($data);
		exit;
	}

	public function backupConfirm()
	{
		echo $this->load->view('backupconfirm',true);
	}
	
	
	public function deletebackup($name)
	{
		    $name= urldecode($name);
			unlink($this->path.'/backup/'.$name);
			$_SESSION['SUCCESS_MSG']="Backup deleted successfully";
			redirect(TICKET_PLUGIN_URL."CI/index.php/backup/index");
		
	}

	public function downloadbackup($file,$type=1)
	{
		$this->load->library('zip');
		$file = urldecode($file);
		if($type == 1)
		{
			$this->zip->read_file(TICKET_PLUGIN_PATH.'/backup/'.$file);
			//$this->zip->read_dir(TICKET_PLUGIN_PATH.'/CI/assets/attachments/',false);
 

			$this->zip->archive(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip');

			ob_end_clean(); 
			$this->zip->download($file.'.zip');

			chmod(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip',0777);
			unlink(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip');
		}

		//download all backups in folder
		if($type == 2)
		{
	
			$zfiles = B1st_getFileList(TICKET_PLUGIN_PATH.'/backup/');

			if(!empty($zfiles))
			{
				foreach($zfiles as $f)
				{
					$this->zip->read_file(TICKET_PLUGIN_PATH.'/backup/'.$f['name']);
				}
			}
			else
			{
				return;
			}
			
 			$file = date('d-m-Y_His');

			$this->zip->archive(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip');

			chmod(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip',0777);
			ob_end_clean(); 
			$this->zip->download($file.'.zip');

			chmod(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip',0777);
			unlink(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip');
		}

		if($type == 3)
		{

			$zfiles = B1st_getFileList(TICKET_PLUGIN_PATH.'/CI/assets/attachments/',false);

			if(!empty($zfiles))
			{
				foreach($zfiles as $f)
				{
					if($f['name'] != '.' && $f['name'] != '..')
						$this->zip->read_file(TICKET_PLUGIN_PATH.'/CI/assets/attachments/'.$f['name']);
				}
			}
			else
			{
				return;
			}
			
 			$file = 'attachment_'.date('d-m-Y_His');

			$this->zip->archive(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip');

			chmod(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip',0777);
			ob_end_clean(); 
			$this->zip->download($file.'.zip');

			chmod(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip',0777);
			unlink(TICKET_PLUGIN_PATH.'/tmp/'.$file.'.zip');
		}
		 
	}

	public function restorebackup($name)
	{
		$tables = array("ticket","product","department","company","faq","ticket_priority","privilege_group","privileges","ticket_reply","ticket_states","ticket_users","settings","attachments","temp_file","ticket_register_types","ticket_rating","chatsession","kb_cat","knowledgebasemod","language","admin_ticket_assignment","ticket_backup","moduletables","emails","tweets","responder_time_duration");

		$tables_array = preg_filter('/^/', B1st_getDbPrefix(), $tables);
	
		//$this->backup_model->dropTables($tables_array);
		$this->backup_model->restoreBackup($this->path.'/backup/'.$name);
		$_SESSION['SUCCESS_MSG']="Backup restored successfully";
		redirect(TICKET_PLUGIN_URL."CI/index.php/backup/index");

	}

	public function restorebackupFromFile()
	{
		$type=$this->input->post("restore_type");
		$this->load->library('upload');
		$config['upload_path'] = TICKET_PLUGIN_PATH.'/tmp/';
		$config['allowed_types'] = 'zip';
		$config['overwrite'] = TRUE;


		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('restore_file'))
		{
			$data['status'] = 0;
			$data['msg'] = '<div class="isa_error" style="width: 80%;">
			'.$this->upload->display_errors().'</div>';
		}
		else
		{
			$udata = $this->upload->data();

		$zip = new ZipArchive;
		$file = $udata['full_path'];
		
		$defchk=false;
		$filearr=explode(".",$file);
		//echo "<pre>";
		//print_r($filearr);
		//echo "</pre>";die;
		$regex = "/[sql]+ \d+/";
		if(!empty($filearr))
		{
			foreach($filearr as $vfil)
			{
				if (preg_match("/sql/",$vfil))
				{
					$defchk=true;
				}
			}
		}
	
	chmod($file,0777);
	$res = $zip->open($file,ZIPARCHIVE::CREATE);
	if ( $res === TRUE) {
		 if($type == "attachment")
		 {
		 	//chmod(TICKET_PLUGIN_PATH.'/CI/assets/attachments',0777);
		 	$zip->extractTo(TICKET_PLUGIN_PATH.'/CI/assets/attachments/');
		 	$data['msg'] = '<div class="isa_success" style="width: 80%;">
			Attachments uploaded successfully !!
			</div>';

			$_SESSION['SUCCESS_MSG']="Attachments uploaded successfully !!";
		 }
		 else
		 {
		 	//chmod(TICKET_PLUGIN_PATH.'/tmp/../backup',0777);
			if($defchk==true)
			{
				$zip->extractTo(TICKET_PLUGIN_PATH.'/tmp/../backup/');
				$data['msg'] = '<div class="isa_success" style="width: 80%;">
				Backup uploaded successfully !!
				</div>';
				$_SESSION['SUCCESS_MSG']="Backup uploaded successfully !!";
			}
			else
			{
				$data['msg'] = '<div class="isa_error" style="width: 80%;">
				Wrong format uploaded !!
				</div>';
				$_SESSION['ERROR_MSG']="Wrong format uploaded !!";
			}
	     }
	     $zip->close();

	     $data['status'] = 1;
			
	}
	else
	{
		switch($res){
            case ZipArchive::ER_EXISTS:
                $ErrMsg = "File already exists.";
                break;

            case ZipArchive::ER_INCONS:
                $ErrMsg = "Zip archive inconsistent.";
                break;
               
            case ZipArchive::ER_MEMORY:
                $ErrMsg = "Malloc failure.";
                break;
               
            case ZipArchive::ER_NOENT:
                $ErrMsg = "No such file.";
                break;
               
            case ZipArchive::ER_NOZIP:
                $ErrMsg = "Not a zip archive.";
                break;
               
            case ZipArchive::ER_OPEN:
                $ErrMsg = "Can't open file.";
                break;
               
            case ZipArchive::ER_READ:
                $ErrMsg = "Read error.";
                break;
               
            case ZipArchive::ER_SEEK:
                $ErrMsg = "Seek error.";
                break;
           
            default:
                $ErrMsg = "Unknow error";
                break;
               
           
        }
		$data['status'] = 0;
			$data['msg'] = '<div class="isa_error" style="width: 80%;">
			'.$ErrMsg.'
			</div>';
	}
		}

		echo json_encode($data);
	}
	
}


