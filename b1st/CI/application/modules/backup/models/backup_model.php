<?php
class backup_model extends CI_Model
{
	public $path = TICKET_PLUGIN_PATH;
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
            $this->load->dbforge();
                
          	//$this->load->library('session');
	}

	public function doBackup($data)
	{
		$tables = array("ticket","product","department","company","faq","ticket_priority","privilege_group","privileges","ticket_reply","ticket_states","ticket_users","settings","attachments","temp_file","ticket_register_types","ticket_rating","chatsession","kb_cat","knowledgebasemod","language","admin_ticket_assignment","ticket_backup","moduletables","emails","tweets","responder_time_duration");

		switch($data['backup_type'])
		{
			case "data":
				$tables = array("ticket","product","department","company","faq","ticket_priority","privilege_group","privileges","ticket_reply","ticket_states","ticket_users","attachments","temp_file","theme","ticket_register_types","ticket_rating","chatsession","kb_cat","knowledgebasemod","language","admin_ticket_assignment","ticket_backup","moduletables","emails","tweets","responder_time_duration");
			break;
			case "config" :
				$tables = array("settings","ticket_backup");
			break;

			case "all":
			default:
				$tables = array("ticket","product","department","company","faq","ticket_priority","privilege_group","privileges","ticket_reply","ticket_states","ticket_users","settings","attachments","temp_file","ticket_register_types","ticket_rating","chatsession","kb_cat","knowledgebasemod","language","admin_ticket_assignment","ticket_backup","moduletables","emails","tweets","responder_time_duration");
			break;
		}
		
		$this->db->insert($this->db->dbprefix."ticket_backup",$data);
		
		$tables_array = preg_filter('/^/', B1st_getDbPrefix(), $tables);

		 $this->load->dbutil();
	    
	    $prefs = array(
	            'tables'      => $tables_array,  // Array of tables to backup.
	            'ignore'      => array(),           // List of tables to omit from the backup
	            'format'      => 'txt',             // gzip, zip, txt
	            'filename'    => $data['backup_name'].'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
	            'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
	            'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
	            'newline'     => "\n"               // Newline character used in backup file
	          );

	    $backup =& $this->dbutil->backup($prefs);
	    write_file($this->path.'/backup/'.$data['backup_name'].'.sql', $backup);
	    $queryTxt =  read_file($this->path.'/backup/'.$data['backup_name'].'.sql');
	    $query = preg_replace("/".B1st_getDbPrefix()."/","PREFIX_",$queryTxt);
		write_file($this->path.'/backup/'.$data['backup_name'].'.sql', $query);
	}
    
	public function dropTables($tables_array)
	{
			$dropsql="DROP TABLE IF EXISTS ";
		foreach($tables_array as $table)
		{
		 $this->db->simple_query($dropsql.$table);
		}
	}

	public function restoreBackup($name)
	{
		 $name = urldecode($name);
	     $queryTxt =  read_file($name);
		 
		$query = preg_replace("/#\s+.*?\s+\#/ms","",$queryTxt);
		
		 $query = preg_replace("/PREFIX_/",B1st_getDbPrefix(),$query);
		 $a = explode(';',$query);
		 /*echo '<pre>';
		 print_r($a);
		 exit;*/
		foreach($a as $q)
		{
		  $q = trim($q);
		  if(!empty($q))
		 	$r = $this->db->query($q);
		
		}

	}	
}
