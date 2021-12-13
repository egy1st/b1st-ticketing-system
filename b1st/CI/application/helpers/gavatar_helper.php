<?php
function B1st_save_gravatar($email,$username, $s = 45, $r = 'pg')
{
	$defaultimage='mm';
	$url='http://www.gravatar.com/avatar/';
	if (empty($_SERVER['HTTPS'])) {
   		$url='https://secure.gravatar.com/avatar/';
   	}
	
	$url.=md5(strtolower(trim($email)));
	$url.="?s=$s&d=$defaultimage&r=$r";
	
	$path = TICKET_PLUGIN_PATH.'/CI/assets/photos/';
	//Get the file
	$content = file_get_contents($url);
	//Store in the filesystem.
	if(!is_writable($path))
	{
		chmod ($path,0777);
	}
	$fp = fopen($path.$username.'.png', "w");
	fwrite($fp, $content);
	fclose($fp);
}

function B1st_get_gravatar($username)
{
	return TICKET_PLUGIN_URL.'CI/assets/photos/'.$username.'.png';	
}

function B1st_getGravatar($email, $s = 45, $r = 'pg')
{
	$defaultimage='mm';
	$url='http://www.gravatar.com/avatar/';
	if (empty($_SERVER['HTTPS'])) {
   		$url='https://secure.gravatar.com/avatar/';
   	}
	
	$url.=md5(strtolower(trim($email)));
	$url.="?s=$s&d=$defaultimage&r=$r";

	return $url;	
}
?>
