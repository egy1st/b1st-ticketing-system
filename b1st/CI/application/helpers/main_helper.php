<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$timezone_str = B1st_get_timezone_string();
//date_default_timezone_set($timezone_str);

?>
<?php

function B1st_create_guid() {
    $microTime = microtime();
    list($a_dec, $a_sec) = explode(" ", $microTime);
    $dec_hex = dechex($a_dec * 1000000);
  
    B1st_ensure_length($dec_hex, 5);
    
    $guid = "";
    $guid .= $dec_hex;
    $guid .= B1st_create_guid_section(3);
    $guid .= '-';
    $guid .= B1st_create_guid_section(3);
    $guid .= '-';
    $guid .= B1st_create_guid_section(3);
    
    return $guid;
}

function B1st_ensure_length(&$string, $length) {
    $strlen = strlen($string);
    if ($strlen < $length) {
        $string = str_pad($string, $length, "0");
    } else if ($strlen > $length) {
        $string = substr($string, 0, $length);
    }
}

function B1st_create_guid_section($characters) {
    $return = "";
    for ($i = 0; $i < $characters; $i++) {
        $return .= dechex(mt_rand(0, 15));
    }
    return $return;
}

/********elapse time helper start********/
function B1st_smartdate($timestamp) {
    
    $timestamp = strtotime("$timestamp");
    $diff = time() - $timestamp;
 
    if ($diff <= 0) {
        return 'Now';
    }
    else if ($diff < 60) {
        return B1st_grammar_date(floor($diff), ' second(s) ago');
    }
    else if ($diff < 60*60) {
        return B1st_grammar_date(floor($diff/60), ' minute(s) ago');
    }
    else if ($diff < 60*60*24) {
        return B1st_grammar_date(floor($diff/(60*60)), ' hour(s) ago');
    }
    else if ($diff < 60*60*24*30) {
        return B1st_grammar_date(floor($diff/(60*60*24)), ' day(s) ago');
    }
    else if ($diff < 60*60*24*30*12) {
        return B1st_grammar_date(floor($diff/(60*60*24*30)), ' month(s) ago');
    }
    else {
        return B1st_grammar_date(floor($diff/(60*60*24*30*12)), ' year(s) ago');
    }
}

function B1st_smarttimestamp($diff)
{ 
    if ($diff <= 0)
    {
        return 'Instant';
    }
    else if ($diff < 60)
    {
        return B1st_grammar_date(floor($diff), ' Second(s)');
    }
    else if ($diff < 60*60)
    {
        return B1st_grammar_date(floor($diff/60), ' Minute(s)');
    }
    else if ($diff < 60*60*24)
    {
        return B1st_grammar_date(floor($diff/(60*60)), ' Hour(s)');
    }
    else if ($diff < 60*60*24*30)
    {
        return B1st_grammar_date(floor($diff/(60*60*24)), ' Day(s)');
    }
    else if ($diff < 60*60*24*30*12)
    {
        return B1st_grammar_date(floor($diff/(60*60*24*30)), ' Month(s)');
    }
    else
    {
        return B1st_grammar_date(floor($diff/(60*60*24*30*12)), ' Year(s)');
    }
}

function B1st_smartdate_new($timestamp) {
    //date_default_timezone_set('America/Los_Angeles'); by MAA
    $timestamp = strtotime("$timestamp");
    $diff = time() - $timestamp;
 
    if ($diff <= 0) {
        return 'Now';
    }
    else if ($diff < 60) {
        return B1st_grammar_date(floor($diff), ' second');
    }
    else if ($diff < 60*60) {
        return B1st_grammar_date(floor($diff/60), ' minute');
    }
    else if ($diff < 60*60*24) {
        return B1st_grammar_date(floor($diff/(60*60)), ' hour');
    }
    else if ($diff < 60*60*24*30) {
        return B1st_grammar_date(floor($diff/(60*60*24)), ' day');
    }
    else if ($diff < 60*60*24*30*12) {
        return B1st_grammar_date(floor($diff/(60*60*24*30)), ' month');
    }
    else {
        return B1st_grammar_date(floor($diff/(60*60*24*30*12)), ' year');
    }
}
 
 
function B1st_grammar_date($val, $sentence) {
    if ($val > 1) {
        return $val.str_replace('(s)', 's', $sentence);
    } else {
        return $val.str_replace('(s)', '', $sentence);
    }
}

/********elapse time helper end********/

function B1st_front_authenticate() {
    @session_start();
    $_SESSION['referer_url'] = @$_SERVER['HTTP_REFERER'];
    $CI = & get_instance();
    if(isset($_SESSION['c_userid']))
    {
        $current_userId= $_SESSION['c_userid'];
    }
    else
    {
        $current_userId= "";
    }
    if(isset($_SESSION['c_email']))
    {
        $current_userEmail= $_SESSION['c_email'];
    }
    else
    {
        $current_userEmail= "";
    }
    if (empty($current_userId) || empty($current_userEmail)) {
        //header("location: ".TICKET_PLUGIN_URL."CI/index.php/register/login.");
        echo "<script>window.location.href='".TICKET_PLUGIN_URL."CI/index.php/register/login'</script>";
        exit;
    }
    else
    {
      if(!empty($_SESSION['c_hash']))
      {
        $_SESSION['register_success'] = "Please verify your account !! <br> Verification code has been mailed to you.";
        echo "<script>window.location.href='".TICKET_PLUGIN_URL."CI/index.php/register/verify'</script>";
        exit;
      }
    }

  }

function B1st_authenticate() {
    @session_start();
    $_SESSION['referer_url'] = @$_SERVER['HTTP_REFERER'];
    $CI = & get_instance();
    if(isset($_SESSION['userid']))
    {
        $current_userId= $_SESSION['userid'];
    }
    else
    {
        $current_userId= "";
    }
    if(isset($_SESSION['email']))
    {
        $current_userEmail= $_SESSION['email'];
    }
    else
    {
        $current_userEmail= "";
    }
    if (empty($current_userId) || empty($current_userEmail)) {
        //header("location: ".TICKET_PLUGIN_URL."CI/index.php/logins/login.");
        echo "<script>window.location.href='".TICKET_PLUGIN_URL."CI/index.php/logins/login'</script>";
        exit;
    }
/*********close ticket after specific interval set by admin start***********/
    $settings = (array)B1st_getSettingsValue('ticket_auto_close');

    $t = $settings['number'];
    $l = $settings['type'];
    $val = $t.' '.$l;
    

    $CI->load->model('ticket/ticket_model');
    $r = $CI->ticket_model->listTicketFull();

    
  $time_format = array('second' => 0 ,'minute'=>1,'hour'=>2,'day'=>3,'month'=>4,'year'=>5);
  if(!empty($r))
  {
    foreach($r as $ticket)
    {
          $time_ellapse = B1st_smartdate_new($ticket->modified_date);
        
        if($time_ellapse != 'Now')
        {
            $arr = explode(' ',$time_ellapse);
           
            $number = $arr[0];
            $type = $arr[1];
            
            if( ($number > $t) and ($time_format[$type] >= $time_format[$l]))
            {
                $data['state'] = 'C';
                //$data['modified_date'] = date('Y-m-d H:i:s'); //By MAA
                $where['id'] = $ticket->id;
                $CI->ticket_model->update($data,$where);
                
                $userdet=B1st_getUserInfoById($ticket->userid);
		$useremail=$userdet->email;
		$firstname=$userdet->firstname;
		$lastname=$userdet->lastname;
                
                $messagebodyticket="Your Ticket ".$ticket->ticket_no." has been closed.";
		B1st_sendmail($useremail,$firstname,$lastname,"Ticketclosing mail for Ticket Number ".$ticket->ticket_no." : ",$messagebodyticket,"info@ticketingsystem.com");
            }
        }
    }
}
/*********close ticket after specific interval set by admin end***********/


/*********scheduled backup codes start***********/
 $diff_format = array('day'=>'%a','month'=>'%m','year'=>'%y');
    $settings = (array)B1st_getSettingsValue('scheduled_backup');

    $t = $settings['number'];
    $l = $settings['type'];
    $val = $t.' '.$l;
    $setdate = $settings['set_date'];

    $to = strtotime("+".$val,strtotime($setdate));
    $todate = date('Y-m-d',$to);

    $datetime1 = date('Y-m-d');
    $datetime2 = $todate;
    
    //echo $datetime1."==============".$datetime2;

    if($datetime1 >= $datetime2)
    {
      $CI->load->model('backup/backup_model');
      
      $idata['backup_name'] = date('Y-m-d_H:i:s');
      $idata['backup_description'] = "Auto Backup";
      $idata['backup_type'] = "all";
      $idata['creation_date'] = date('Y-m-d H:i:s');
     
      $r = $CI->backup_model->doBackup($idata);
      
      $CI->load->model('backup/settings_model');
      $data=array();
      $where=array();
      $data['number'] = $t;
      $data['type'] = $l;
      $data['set_date'] = date('Y-m-d');
      $chkupdata['value'] = json_encode($data); 
      $where['name'] = 'scheduled_backup';
      $CI->settings_model->update($chkupdata,$where);
    }
/*********scheduled backup codes end***********/    
}


function B1st_getTicketStates()
{
     $CI =& get_instance();
     $CI->load->model('ticket/ticketstates_model');
     return $CI->ticketstates_model->getTicketStates();
}

function B1st_getPrivileges()
{
     $CI =& get_instance();
     $CI->load->model('privilages_model');
     return $CI->privilages_model->getallprivilages();
}

function B1st_getPrivilegeGroups()
{
     $CI =& get_instance();
     $CI->load->model('privilagegroup/privilagegroup_model');
     return $CI->privilagegroup_model->allprivilagegroup();
}

function B1st_getPrivilegeGroupById($id,$field)
{
    if($id == 0)
    {
        return "Super admin";
    }
     $CI =& get_instance();
     $CI->load->model('privilagegroup/privilagegroup_model');
     return $CI->privilagegroup_model->getprivilagegroup($id)->$field;
}


function B1st_getDepartmentById($id,$field)
{
     $CI =& get_instance();
     $CI->load->model('department_model');
     return $CI->department_model->getdepartment($id)->$field;
}

function B1st_getProductById($id,$field)
{
     $CI =& get_instance();
     $CI->load->model('product_model');
     return $CI->product_model->getproduct($id)->$field;
}

function B1st_getTicketStateByCode($code,$field)
{
     $CI =& get_instance();
     $CI->load->model('ticket/ticketstates_model');
     return $CI->ticketstates_model->getTicketState($code)->$field;
}

function B1st_getSettingsValue($name)
{
     $CI =& get_instance();
     $CI->load->model('settings/settings_model');
     return json_decode($CI->settings_model->getSettings($name)->value);
}

function B1st_getDbPrefix()
{
   $CI =& get_instance();
   $CI->load->database();
   return $CI->db->dbprefix;
}

function B1st_getDbName()
{
   $CI =& get_instance();
   $CI->load->database();
   return $CI->db->database;
}

function B1st_getProducts()
{
    $CI =& get_instance();
    $CI->load->model('product/product_model');
    return $CI->product_model->allproduct();
}

function B1st_getDepartments()
{
    $CI =& get_instance();
    $CI->load->model('department/department_model');
    return $CI->department_model->alldepartment();
}

function B1st_getPriorties()
{
    $CI =& get_instance();
    $CI->load->model('ticketpriority/ticketpriority_model');
    return $CI->ticketpriority_model->allpriority();
}


function B1st_getFileList($dir,$flag = true) { 
// array to hold return value 
$retval = array(); 
// add trailing slash if missing
 if(substr($dir, -1) != "/") $dir .= "/"; 
 // open directory for reading 
 $d = new DirectoryIterator($dir) or die("getFileList: Failed opening directory $dir for reading"); 
   foreach($d as $fileinfo) { 
       // skip hidden files 
       if($flag)
          if($fileinfo->isDot() ||  $fileinfo->getExtension() !== 'sql') continue;
        else
          if($fileinfo->isDot()) continue;
       $retval[] = array( 
                          'name' => "{$fileinfo}", 
                          'type' => ($fileinfo->getType() == "dir") ? "dir" : ($fileinfo->getRealPath()), 
                          'size' => $fileinfo->getSize(),
                          'created' => $fileinfo->getCTime() 
                        ); 
    }
    
    return $retval; 
}

function B1st_getTheme()
{
    $CI =& get_instance();
    $CI->load->model('theme/theme_model');
    return $CI->theme_model->getThemeshow();
}

function B1st_getFrontTheme()
{
    $CI =& get_instance();
    $CI->load->model('theme/theme_model');
    return $CI->theme_model->getFrontThemeshow();
}

function B1st_random_color_part_hex() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function B1st_random_color_hexadecimal() {
    return B1st_random_color_part_hex() . B1st_random_color_part_hex() . B1st_random_color_part_hex();
}

function B1st_random_color_part_dec() {
    return str_pad( mt_rand( 0, 255 ), 2, '0', STR_PAD_LEFT);
}

function B1st_random_color_decimal() {
    return B1st_random_color_part_dec() .",". B1st_random_color_part_dec() .",". B1st_random_color_part_dec();
}

function B1st_getRegisterType()
{
    $CI =& get_instance();
    $CI->load->model('register/register_model');
    return $CI->register_model->getRegisterType();
}

function B1st_alreadyRated($userid,$ticketid)
{
    $CI =& get_instance();
    $CI->load->model('rating/rating_model');
    return $CI->rating_model->alreadyRated($userid,$ticketid);
}

function B1st_admin_check($id,$current_userid)
{
  $CI =& get_instance();
  $CI->load->model('users/users_model');
  $user = $CI->users_model->getuser(array('id'=>$id));
  $cuser = $CI->users_model->getuser(array('id'=>$current_userid));
  if($cuser->privilege_group_id === '1')
  {
    return true;
  }

  if($user->id == $current_userid)
  {
    return true;
  }
}

function B1st_check_privilege($userid,$pcode)
{
   $CI =& get_instance();
   $CI->load->model('users/users_model');
   $CI->load->model('privilagegroup/privilagegroup_model');
   $user = $CI->users_model->getuser(array('id'=>$userid));
   if(!empty($user))
    {
        /*   
       if($user->privilege_group_id == "0")
       {
        return true;
       }*/
    
       $userpiv =  $CI->privilagegroup_model->getprivilagegroup($user->privilege_group_id)->privileges;
       
       $pivlist = json_decode($userpiv);
       
       //echo "<pre>";
       //print_r($pivlist);
       //echo "</pre>";die;
       
       if(in_array($pcode,$pivlist))
       {
        return true;
       }
    }

   return false;
}

function B1st_getUserInfoById($id)
{
  $CI =& get_instance();
  $CI->load->model('users/users_model');
  $user = $CI->users_model->getuser(array('id'=>$id));
  return $user;
}

function B1st_checkTicketAssignment($ticketid)
{
  $CI =& get_instance();
  $CI->load->model('assignticket/assignticket_model');
  $where['ticket_id'] = $ticketid;
  $info = $CI->assignticket_model->getassigninfo($where);
  if(!empty($info))
  {
    return true;
  }
  return false;
}

function B1st_checkTicketAssignmentUser($ticketid)
{
  $CI =& get_instance();
  $CI->load->model('assignticket/assignticket_model');
  $where['ticket_id'] = $ticketid;
  $info = $CI->assignticket_model->getassigninfo($where);

  if(!empty($info))
  {
    return $info->admin_id;
  }
  return false;
}




function B1st_is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}

function B1st_hex2rgb($hex)
{
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3)
   {
    $r = hexdec(substr($hex,0,1).substr($hex,0,1));
    $g = hexdec(substr($hex,1,1).substr($hex,1,1));
    $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   }
   else
   {
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function B1st_rgb2hex($rgb)
{
   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}

function B1st_selectlanguage()
{
   $CI =& get_instance();
   $CI->load->model('language/language_model');
   $langdet=$CI->language_model->defaultlanguage();
   if(!empty($langdet))
   {
    $langcode=$langdet->language_code;
   }
   else
   {
    $langcode="eng";
   }
   $CI->lang->load($langcode);
}

function B1st_selectbacklanguage()
{
   $CI =& get_instance();
   $CI->load->model('language/language_model');
   $langdet=$CI->language_model->defaultbacklanguage();
   if(!empty($langdet))
   {
    $langcode=$langdet->language_code;
   }
   else
   {
    $langcode="eng";
   }
   $CI->lang->load($langcode);
}

function B1st_loadenglishlang()
{
 $CI =& get_instance();
 $CI->lang->load("eng"); 
}

function B1st_geturl()
{
  $CI =& get_instance();
  $segment=$CI->uri->segment(1);
  if(!empty($segment))
  {
    return $segment;
  }
  else
  {
    return "ticket";
  }
}

function B1st_check_already_posted($id,$flag=NULL)
{
    $CI =& get_instance();
    $CI->load->model('ticket/ticket_model');
    if(!empty($flag) && $flag === "tweet")
    {
            $data['tweet_id'] = $id;
            return $r = $CI->ticket_model->ticket_by_tweet($data);
    }
      $data['email_no'] = $id;
      return $r = $CI->ticket_model->ticket_by_mail($data);
}

function B1st_get_ip_address() {
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && B1st_validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (B1st_validate_ip($ip))
                    return $ip;
            }
        } else {
            if (B1st_validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && B1st_validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && B1st_validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && B1st_validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && B1st_validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function B1st_validate_ip($ip) {
    if (strtolower($ip) === 'unknown')
        return false;

    // generate ipv4 network address
    $ip = ip2long($ip);

    // if the ip is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1) {
        // make sure to get unsigned long representation of ip
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);
        // do private network range checking
        if ($ip >= 0 && $ip <= 50331647) return false;
        if ($ip >= 167772160 && $ip <= 184549375) return false;
        if ($ip >= 2130706432 && $ip <= 2147483647) return false;
        if ($ip >= 2851995648 && $ip <= 2852061183) return false;
        if ($ip >= 2886729728 && $ip <= 2887778303) return false;
        if ($ip >= 3221225984 && $ip <= 3221226239) return false;
        if ($ip >= 3232235520 && $ip <= 3232301055) return false;
        if ($ip >= 4294967040) return false;
    }
    return true;
}

function B1st_fetchmod($modname)
{
    $CI =& get_instance();
    $CI->load->model('premium/premium_model');
    $status=$CI->premium_model->checkstatusmodule($modname);
    return $status;
}

function B1st_fetchIns($modname)
{
    $CI =& get_instance();
    $CI->load->model('premium/premium_model');
    $status=$CI->premium_model->checkinstallmodule($modname);
    return $status;
}

function B1st_checkAdminTicketAssignment($ticketid,$userid)
{
    $CI =& get_instance();
    $CI->load->model('assignticket/assignticket_model');
    $status=$CI->assignticket_model->checkassignedticket($ticketid,$userid);
    return $status;
}

function B1st_getEmailCountInfo()
{
    $CI =& get_instance();
    $CI->load->model('imap/imap_model');
    $data['all']=$CI->imap_model->getAllEmailCount();
    $data['posted']=$CI->imap_model->getPostedEmailCount();
    $data['deleted']=$CI->imap_model->getDeleteEmailCount();
    return $data;
}

function B1st_getresponsetimedur($userid)
{
    $CI =& get_instance();
    $CI->load->model('users/users_model');
    $duration=$CI->users_model->getresponseduration($userid);
    if(!empty($duration))
    {
        return $duration;
    }
    else
    {
        return "";
    }
}

function B1st_getticketrating()
{
  $CI =& get_instance();
  $CI->load->model('users/users_model');
  $avgrate=$CI->users_model->showavgrate();
  if(!empty($avgrate))
  {
    return $avgrate;
  }
  else
  {
    return "";
  }
}

function B1st_getticketreplied($userid)
{
  $CI =& get_instance();
  $CI->load->model('users/users_model');
  $numrep=$CI->users_model->ticketrepliednum($userid);
  if(empty($numrep))
  {
    return "";
  }
  else
  {
    return $numrep;
  }
}

function B1st_getlowrate($userid)
{
  $CI =& get_instance();
  $CI->load->model('users/users_model');
  $lowrate=$CI->users_model->lowerrepliedticket($userid);
  if(!empty($lowrate))
  {
    return $lowrate;
  }
  else
  {
    return "";
  }
}

/*
get options value from the wp options table.
 */

function B1st_get_option($name)
{
     $CI =& get_instance();
     $CI->load->model('settings/settings_model');
     return "B1ST" ; // $CI->settings_model->getOption($name)->option_value;
}

/**
 * Returns the timezone string for a site, even if it's set to a UTC offset
 *
 * Adapted from http://www.php.net/manual/en/function.timezone-name-from-abbr.php#89155
 *
 * @return string valid PHP timezone string
 */
function B1st_get_timezone_string() {
 
    // if site timezone string exists, return it
    if ( $timezone = B1st_get_option( 'timezone_string' ) )
        return $timezone;
 
    // get UTC offset, if it isn't set then return UTC
    if ( 0 === ( $utc_offset = B1st_get_option( 'gmt_offset', 0 ) ) )
        return 'UTC';
 
    // adjust UTC offset from hours to seconds
    $utc_offset *= 3600;
 
    // attempt to guess the timezone string from the UTC offset
    if ( $timezone = timezone_name_from_abbr( '', $utc_offset, 0 ) ) {
        return $timezone;
    }
 
    // last try, guess timezone string manually
    $is_dst = date( 'I' );
 
    foreach ( timezone_abbreviations_list() as $abbr ) {
        foreach ( $abbr as $city ) {
            if ( $city['dst'] == $is_dst && $city['offset'] == $utc_offset )
                return $city['timezone_id'];
        }
    }
     
    // fallback to UTC
    return 'UTC';
}

?>