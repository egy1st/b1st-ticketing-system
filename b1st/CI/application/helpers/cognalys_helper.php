 <?php
 function B1st_getMobileNo($appid,$accesstoken,$no)
{
    $a = file_get_contents("https://www.cognalys.com/api/v1/otp/?app_id=".$appid."&access_token=".$accesstoken."&mobile=".$no);
    $array = (array)json_decode($a);

    $errors = "";
    
    if($array['status'] == "failed")
    {
        foreach($array['errors'] as $key=>$val)
        {
            $errors .= $val."<br/>";
        }
        $array['error_msg'] = $errors; 
    }

    return $array; 
}

function B1st_VerifyMobile($appid,$accesstoken,$keymatch,$otp)
{
    $a = file_get_contents("https://www.cognalys.com/api/v1/otp/confirm/?app_id=".$appid."&access_token=".$accesstoken."&keymatch=".$keymatch."&otp=".$otp);
    $array = (array)json_decode($a);
    $errors = "";
    if($array['status'] == "failed")
    {
        foreach($array['errors'] as $key=>$val)
        {
            $errors .= $val."<br/>";
        }
        $array['error_msg'] = $errors; 
    }

    return $array;
}